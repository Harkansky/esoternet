<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('email'),
            ChoiceField::new('accountStatus')
                ->setChoices(UserAccountStatusEnum::cases())
                ->setFormType(\Symfony\Component\Form\Extension\Core\Type\EnumType::class)
                ->setFormTypeOption('class', UserAccountStatusEnum::class),
            ChoiceField::new('roles')
                ->setChoices([
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Banned' => 'ROLE_BANNED',
                ])
                ->allowMultipleChoices()
                ->renderAsBadges()
        ];
    }

}
