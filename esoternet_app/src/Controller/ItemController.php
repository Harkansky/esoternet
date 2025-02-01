<?php
namespace App\Controller;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    #[Route('/items', name: 'app_items')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $items = $entityManager->getRepository(Item::class)->findAll();

        return $this->render('item/index.html.twig', [
            'items' => $items,
        ]);
    }


}
