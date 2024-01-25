<?php
namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Contest;
use App\Form\AddressType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ContestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextareaField::new('description')->hideOnIndex()->setMaxLength(255),   
            TextField::new('city'),
            TextField::new('host'),
            DateTimeField::new('startDate'),
            DateTimeField::new('endDate'),
            BooleanField::new('isOnline'),
        ];
    }
}
