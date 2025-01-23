<?php
namespace App\Controller;

use App\Entity\Pact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PactController extends AbstractController
{
    #[Route('/pact', name: 'pact_list')]
    public function list(EntityManagerInterface $em): Response
    {
        // Récupération des pactes
        $pacts = $em->getRepository(Pact::class)->findAll();

        return $this->render('pact/list.html.twig', [
            'pacts' => $pacts,
        ]);
    }
}
