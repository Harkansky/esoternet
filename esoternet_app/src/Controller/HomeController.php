<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(
    )
    {
    }

    #[Route(path: '/', name: 'home')]
    public function home()
    {
        return $this->render('index.html.twig');
    }
}
