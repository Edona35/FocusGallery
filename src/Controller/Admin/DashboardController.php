<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FocusGallery');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Main site','fa fa-home','app_home');
          yield MenuItem::section('Métier');

        yield MenuItem::linkTo(PhotoCrudController::class,'Photos', 'fa fa-image');

        yield MenuItem::linkTo(CategoryCrudController::class, 'Categories', 'fa fa-tags');
        yield MenuItem::section('Gestion utilisateurs');
         yield MenuItem::linkTo(UserCrudController::class, 'Utilisateur', 'fa fa-user');
    }

}