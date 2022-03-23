<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Babysitter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BabysitterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class)
            ->add('firstname', TextType::class )
            ->add('lastname', TextType::class )
            ->add('gender', TextType::class )
            ->add('location', TextType::class)
            ->add('description', TextareaType::class )
            ->add('languages', EntityType::class, [
                'class'=> Language::class,
                'choice_label' => 'label',
                'languagename'=> 'name',
                'multiple' => true,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Babysitter::class,
        ]);
    }
}
