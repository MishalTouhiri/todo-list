<?php

namespace App\Controller\Admin;

use App\Controller\Admin\TaskCrudController;
use App\Entity\Task;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        // إعادة التوجيه إلى صفحة المهام
        $adminUrlGenerator = $this->container->get(\EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(TaskCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('تطبيق قائمة المهام');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('لوحة التحكم', 'fa fa-home');
        yield MenuItem::linkToCrud('المهام', 'fas fa-tasks', Task::class);
    }
}
