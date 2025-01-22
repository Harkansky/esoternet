<?php
// src/Controller/PaymentController.php

namespace App\Controller;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'payment')]
    public function index()
    {
        return $this->render('payment.html.twig', [
            'stripe_public_key' => $_ENV['STRIPE_TEST_PUBLIC_KEY'],
        ]);
    }

    #[Route('/create-payment-intent', name: 'create_payment_intent', methods: ['POST'])]
    public function createPaymentIntent()
    {
        Stripe::setApiKey($_ENV['STRIPE_TEST_SECRET_KEY']);
        $paymentIntent = PaymentIntent::create([
            'amount' => 2000, // Montant en centimes (ex. 20.00 EUR)
            'currency' => 'eur',
        ]);
        return new JsonResponse([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }
}
