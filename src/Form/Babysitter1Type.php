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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class Babysitter1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('gender', TextType::class)
            ->add('location', TextType::class)
            ->add('description', TextareaType::class)
            ->add('isAvailable', CheckboxType::class)
            ->add('languages', EntityType::class, [
                'class'=> Language::class,
                'choice_label'=> 'label',
                'multiple'=> true,
                'expanded'=> false
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
