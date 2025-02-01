<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/order/{id}', name: 'order_show', requirements: ['id' => '\d+'])]
    public function show(Order $order): Response
    {
        if (!$order) {
            throw $this->createNotFoundException('Order not found');
        }

        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }
}
