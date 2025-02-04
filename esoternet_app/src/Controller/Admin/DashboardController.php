<?php

namespace App\Controller\Admin;

use App\Entity\Entity;
use App\Entity\Religion;
use App\Entity\User;
use App\Entity\Material;
use App\Entity\Ritual;
use App\Entity\Target;
use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(EntityCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Esoternet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Entity', 'fa fa-users', Entity::class);
        yield MenuItem::linkToCrud('Religion', 'fa fa-cross', Religion::class);
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Material', 'fa fa-flask', Material::class);
        yield MenuItem::linkToCrud('Ritual', 'fa fa-magic', Ritual::class);
        yield MenuItem::linkToCrud('Target', 'fa fa-bullseye', Target::class);
        yield MenuItem::linkToCrud('Item', 'fa fa-cube', Item::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
