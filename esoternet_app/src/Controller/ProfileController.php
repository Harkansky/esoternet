<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    private ManagerRegistry $doctrine;
    private OrderRepository $orderRepository;
    
    public function __construct(ManagerRegistry $doctrine, OrderRepository $orderRepository)
    {
        $this->doctrine = $doctrine;
        $this->orderRepository = $orderRepository;
    }

    #[Route(path: '/profil', name: 'profile')]
    public function profile()
    {
        $user = $this->getUser();
        if (!$user) {
            throw new \Exception("Utilisateur non connecté.");
        }
        $userName = $user->getName();

        $orders = $this->orderRepository->findOrdersByUser($user);

        return $this->render('profile/profile.html.twig', [
            'user' => $userName,
            'orders' => $orders
        ]);
    }
}
