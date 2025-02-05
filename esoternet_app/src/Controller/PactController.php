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
        $pacts = $em->getRepository(Pact::class)->findAll();

        return $this->render('pact/list.html.twig', [
            'pacts' => $pacts,
        ]);
    }

    #[Route('/pact/{id}', name: 'pact_show', requirements: ['id' => '\d+'])]
    public function show(Pact $pact): Response
    {

        return $this->render('pact/show.html.twig', [
            'pact' => $pact,
        ]);
    }
}
