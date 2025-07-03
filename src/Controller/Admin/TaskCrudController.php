<?php

namespace App\Controller\Admin;

use App\Entity\Task;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TaskCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Task::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('مهمة')
            ->setEntityLabelInPlural('المهام')
            ->setPageTitle('index', 'قائمة المهام')
            ->setPageTitle('new', 'إضافة مهمة جديدة')
            ->setPageTitle('edit', 'تعديل المهمة')
            ->setPageTitle('detail', 'تفاصيل المهمة')
            ->setDefaultSort(['createdAt' => 'DESC']) // ترتيب حسب تاريخ الإنشاء تنازلي
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setLabel('المعرف')->hideOnForm(),
            TextField::new('title')
                ->setLabel('العنوان')
                ->setRequired(true)
                ->setColumns(6),
            TextareaField::new('description')
                ->setLabel('الوصف')
                ->setRequired(false)
                ->setColumns(6)
                ->hideOnIndex(),
            BooleanField::new('isCompleted')
                ->setLabel('مكتملة')
                ->renderAsSwitch(false),
            // عرض تاريخ الإنشاء كنص مع التنسيق المناسب
            TextField::new('createdAtFormatted')
                ->setLabel('تاريخ الإنشاء')
                ->hideOnForm(),
        ];
    }
}
