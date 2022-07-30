<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            SlugField::new('slug')->setTargetFieldName('title')->hideOnIndex(),
            TextField::new('tag')->hideOnIndex(),
            AssociationField::new('fkcategory', 'Catégorie')->hideOnIndex(),
            ImageField::new('image')
                ->setRequired(false)
                ->setUploadDir('public/assets/images')
                ->setBasePath('assets/images'),
            TextEditorField::new('description', 'Description'),
        ];
    }
    
}
