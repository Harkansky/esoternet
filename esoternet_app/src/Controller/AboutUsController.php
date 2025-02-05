<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class AboutUsController extends AbstractController
{
    public function __construct(
    )
    {
    }

    #[Route(path: '/about-us', name: 'page_about_us')]
    public function home()
    {
        return $this->render('aboutUs/aboutUs.html.twig');
    }
}
