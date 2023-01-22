<?php

namespace App\Dashboard\Crud;

use App\Dashboard\Filter\StatusFilter;
use App\Ticket\Entity\Ticket;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
class TicketCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ticket::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Zgłoszenie')
            ->setEntityLabelInPlural('Zgłoszenia')
            ->setDefaultSort(['id' => 'desc'])
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        yield FormField::addPanel('Zgłoszenia');
        yield IntegerField::new('id', 'ID')->onlyOnIndex();
        yield AssociationField::new('user', 'Użytkownik');
        yield TextField::new('topic', 'Temat');
        yield TextField::new('status', 'Status');
        yield TextField::new('description', 'Opis')->hideOnIndex();
        yield DateTimeField::new('created', 'Data utworzenia');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(StatusFilter::new('status'))
            ;
    }
}
