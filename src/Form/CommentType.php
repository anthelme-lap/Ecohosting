<?php

namespace App\Form;

use App\Entity\Comment;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'attr' => ['placeholder'=>'Nom*']
            ])
            ->add('email',EmailType::class,[
                'attr' => ['placeholder'=>'E-mail*']
            ])
            ->add('content',TextareaType::class,[
                'attr' => ['placeholder'=>'Votre commentaire']
            ])
            ->add('parent',HiddenType::class,[
                'mapped' => false,
            ])
            ->add('agree',CheckboxType::class,[
                'label' =>false,
                'constraints' =>[
                    new NotNull([
                        'message' => 'Veuillez cocher la case'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
