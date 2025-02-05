<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class RitualController extends AbstractController
{
    public function __construct(
    )
    {
    }

    #[Route(path: '/Ritual', name: 'page_ritual')]
    public function home()
    {
        return $this->render('aboutUs/aboutUs.html.twig');
    }
}
