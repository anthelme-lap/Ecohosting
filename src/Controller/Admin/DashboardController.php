<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('bundle/easyAdminBundle/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecohosting Main Blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');

        yield MenuItem::subMenu('Articles', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Post::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir', 'fas fa-eye', Post::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::subMenu('Catégories', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Catégories', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Commentaire', 'fas fa-comment')->setSubItems([
            MenuItem::linkToCrud('Voir les commentaires', 'fas fa-eye', Comment::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::subMenu('User', 'fas fa-users')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les User', 'fas fa-eye', User::class)->setAction(Crud::PAGE_INDEX)
        ]);
        yield MenuItem::subMenu('A propos', 'fas fa-comment')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', About::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir', 'fas fa-eye', About::class)->setAction(Crud::PAGE_INDEX)
        ]);
    
    
    }
}
