<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        if(Crud::PAGE_EDIT == $pageName || Crud::PAGE_NEW == $pageName){
            return [
                'nickname',
                'nombre',
                'apellidos',
                'correo',
                ChoiceField::new('roles')->setChoices(['ADMIN' => 'ROLE_ADMIN', 'USER' => 'ROLE_USER'])->allowMultipleChoices()->autocomplete(),
            ];
        }

        return [
            'id',
            'nickname',
            'nombre',
            'apellidos',
            'correo',
            //ArrayField::new('roles'),
            BooleanField::new('Admin'),
        ];
    }
   
}
