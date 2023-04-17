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

}
