<?php

namespace App\Controller;

use App\Repository\PactRepository;
use App\Repository\RitualRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PdfController extends AbstractController
{
    #[Route('/pdf/{entityType}/{id}', name: 'pdf_generate')]
    public function generatePdf(
        string $entityType,
        int $id,
        PactRepository $pactRepository,
        RitualRepository $ritualRepository,
        SerializerInterface $serializer
    ): Response {
        switch ($entityType) {
            case 'pact':
                $entityData = $pactRepository->findPactForShow($id);
                break;
            case 'ritual':
                $entityData = $ritualRepository->findRitualForShow($id);
                break;
            default:
                throw $this->createNotFoundException("Type d'entité invalide : $entityType.");
        }
        if (!$entityData) {
            throw $this->createNotFoundException("Aucune donnée trouvée pour l'entité $entityType avec l'ID $id.");
        }
        $normalizedData = $serializer->normalize($entityData, null, ['groups' => 'pdf']);
        if (isset($normalizedData['dateAdded']) && $normalizedData['dateAdded'] instanceof \DateTimeInterface) {
            $normalizedData['dateAdded'] = $normalizedData['dateAdded']->format('d/m/Y');
        }
        $html = $this->renderView("pdf/{$entityType}.html.twig", [
            'entity' => $normalizedData
        ]);
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return new Response(
            $dompdf->output(),
            200,
            ['Content-Type' => 'application/pdf']
        );
    }
}
