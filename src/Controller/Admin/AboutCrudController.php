<?php

namespace App\Controller\Admin;

use App\Entity\About;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AboutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return About::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titlemission', 'Titre Mission'),
            TextField::new('titlevision', 'Titre Vision'),
            ImageField::new('image1', 'Image 1')
                        ->setBasePath('assets/images')
                        ->setUploadDir('public/assets/images')
                        ->setRequired(false),
            ImageField::new('image2', 'Image 2')
                        ->setBasePath('assets/images')
                        ->setUploadDir('public/assets/images')
                        ->setRequired(false),
            ImageField::new('image3', 'Image 3')
                        ->setBasePath('assets/images')
                        ->setUploadDir('public/assets/images')
                        ->setRequired(false),
            ImageField::new('image4', 'Image 4')
                        ->setBasePath('assets/images')
                        ->setUploadDir('public/assets/images')
                        ->setRequired(false),
            TextEditorField::new('descriptionmission', 'Description Mission'),
            TextEditorField::new('descriptionvision', 'Description Vision'),
        ];
    }
 
}
