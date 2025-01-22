<?php
namespace App\Controller;


use App\Entity\Order;
use App\Form\PaymentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/order/payment', name: 'order_payment')]
    public function payment(Request $request): Response
    {
        // Créer une nouvelle commande (Order)
        $order = new Order();

        // Créer le formulaire PaymentType
        $form = $this->createForm(PaymentType::class, $order);

        // Gérer Compile Error: Cannot declare class OrderController, because the name is already in usela soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Logique pour traiter la commande (exemple : sauvegarde ou appel API)
            $this->addFlash('success', 'Votre paiement a été enregistré avec succès.');

            // Redirection après succès
            return $this->redirectToRoute('order_success'); // Créez cette route si nécessaire
        }

        // Rendre le formulaire dans le template Twig
        return $this->render('order/payment.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
