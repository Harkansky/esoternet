<?php


namespace App\Controller;

use App\Entity\Entity;
use App\Entity\SuperiorEntity;
use App\Entity\MinorEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntityController extends AbstractController
{
    #[Route('/entity', name: 'entity_list')]
    public function list(EntityManagerInterface $em): Response
    {
        // Récupération des entités
        $entities = $em->getRepository(Entity::class)->findAll();
        $superiorEntities = $em->getRepository(SuperiorEntity::class)->findAll();
        $minorEntities = $em->getRepository(MinorEntity::class)->findAll();

        return $this->render('entity/list.html.twig', [
            'entities' => $entities,
            'superiorEntities' => $superiorEntities,
            'minorEntities' => $minorEntities,
        ]);
    }
}
