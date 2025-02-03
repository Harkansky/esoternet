<?php
namespace App\Controller;


use App\Entity\Item;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    #[Route('/item/new', name: 'item_new')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $existingRituals = $form->get('existing_rituals')->getData();
            foreach ($existingRituals as $ritual) {
                $item->addRitualLink($ritual);
            }
            $newRituals = $form->get('newRituals')->getData();
            foreach ($newRituals as $ritual) {
                $item->addRitualLink($ritual);
            }
            $existingPacts = $form->get('existing_pacts')->getData();
            foreach ($existingPacts as $pact) {
                $item->addPactLink($pact);
            }
            $newPacts = $form->get('newPacts')->getData();
            $defaultEntity = $doctrine->getRepository(\App\Entity\Entity::class)->find(1);
            if (!$defaultEntity) {
                throw new \Exception("Aucune entité par défaut trouvée (ID 1).");
            }
            foreach ($newPacts as $pact) {
                if (null === $pact->getEntity()) {
                    $pact->setEntity($defaultEntity);
                }
                $item->addPactLink($pact);
            }

            if ($item->getDateAdded() === null) {
                $item->setDateAdded(new \DateTime());
            }

            $entityManager = $doctrine->getManager();
            $entityManager->persist($item);
            $entityManager->flush();

            $this->addFlash('success', 'Item créé avec succès.');
            return $this->redirectToRoute('item_show', ['id' => $item->getId()]);
        }

        return $this->render('item/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/item/{id}', name: 'item_show', requirements: ['id' => '\d+'])]
    public function show(Item $item): Response
    {
        return $this->render('item/show.html.twig', [
            'item' => $item,
        ]);
    }


}
