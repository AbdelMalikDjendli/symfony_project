<?php

namespace App\Controller\Admin;

use App\Entity\Five;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FiveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Five::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
