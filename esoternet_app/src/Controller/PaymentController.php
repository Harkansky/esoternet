<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Item;
use App\Entity\User;
use App\Form\PaymentFormType;
use Doctrine\Persistence\ManagerRegistry;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/payment/{id}', name: 'app_payment', requirements: ['id' => '\d+'])]
    public function payment(Item $item, Request $request): Response
    {
        $form = $this->createForm(PaymentFormType::class, null, [
            'price' => $item->getPrice()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_payment_process', [
                'id' => $item->getId()
            ]);
        }

        return $this->render('payment/payment.html.twig', [
            'form' => $form->createView(),
            'item' => $item
        ]);
    }

    #[Route('/payment/process/{id}', name: 'app_payment_process', requirements: ['id' => '\d+'])]
    public function processPayment(Item $item): Response
    {
        Stripe::setApiKey($this->getParameter('stripe.secret_key'));

        $name = $item->getName() ?: 'Produit sans nom';
        $price = $item->getPrice() ?: 1000;

        // Création d'une session Stripe
        $session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $name,
                    ],
                    'unit_amount' => (int)($price * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            // En production, Stripe remplacera {CHECKOUT_SESSION_ID} par la vraie valeur.
            'success_url' => $this->generateUrl('app_payment_success', [
                'session_id' => '{CHECKOUT_SESSION_ID}',
                'item_id'    => $item->getId()
            ], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'metadata' => [
                'item_id' => $item->getId(),
            ],
        ]);

        return $this->redirect($session->url, 303);
    }

    #[Route('/payment/success', name: 'app_payment_success')]
    public function success(Request $request): Response
    {
        // Récupérer les paramètres depuis l'URL
        $sessionId = $request->query->get('session_id');
        $itemId    = $request->query->get('item_id');

        if (!$sessionId || !$itemId) {
            throw new \Exception("Session ID ou Item ID manquant");
        }

        // Détermine l'environnement (dev, test, prod)
        $env = $this->getParameter('kernel.environment');

        // Si en mode local (dev ou test) ou si le session_id n'est pas remplacé, on simule la session Stripe
        if ($env === 'dev' || $env === 'test' || $sessionId === '{CHECKOUT_SESSION_ID}') {
            $session = new \stdClass();
            $session->payment_status = 'paid';

            // Récupération de l'item pour la simulation
            $item = $this->doctrine->getRepository(Item::class)->find((int)$itemId);
            if (!$item) {
                throw $this->createNotFoundException('Item not found for simulation.');
            }
            $session->amount_total = (int)($item->getPrice() * 100);
            $session->currency = 'eur';
            // Simulation de la propriété line_items attendue par le template
            $session->line_items = [
                (object)[
                    'description' => $item->getName()
                ]
            ];
        } else {
            // En production, récupérer la session via l'API Stripe
            $stripe = new \Stripe\StripeClient($this->getParameter('stripe.secret_key'));
            try {
                $session = $stripe->checkout->sessions->retrieve($sessionId);
            } catch (\Exception $e) {
                throw new \Exception("Erreur lors de la récupération de la session Stripe: " . $e->getMessage());
            }
        }

        // Si le paiement a été validé, créer une commande (Order)
        if ($session->payment_status == 'paid') {
            $order = new Order();
            $order->setOrderDate(new \DateTime());
            $order->setTotalAmount($session->amount_total / 100);

            // Pour les tests, nous utilisons l'utilisateur avec l'ID 1
            $user = $this->doctrine->getRepository(User::class)->find(1);
            if (!$user) {
                throw new \Exception("User with id 1 not found.");
            }
            $order->setPurchaser($user);

            $item = $this->doctrine->getRepository(Item::class)->find((int)$itemId);
            if (!$item) {
                throw $this->createNotFoundException('Item not found.');
            }
            $order->addItem($item);

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            // Optionnel : envoi de l'email de confirmation
            // $this->sendConfirmationEmail($user, $order);

            return $this->render('payment/success.html.twig', [
                'session' => $session,
                'order'   => $order,
            ]);
        }

        return $this->redirectToRoute('app_payment_cancel');
    }

    #[Route('/payment/cancel', name: 'app_payment_cancel')]
    public function cancel(): Response
    {
        return $this->render('payment/cancel.html.twig');
    }

    private function sendConfirmationEmail(User $user, Order $order)
    {
        $mailer = $this->get('mailer');
        $message = (new \Swift_Message('Confirmation de votre commande'))
            ->setFrom('no-reply@tonsite.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView('emails/order_confirmation.html.twig', [
                    'order' => $order,
                ]),
                'text/html'
            );
        $mailer->send($message);
    }
}
