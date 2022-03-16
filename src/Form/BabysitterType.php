<?php

namespace App\Form;

use App\Entity\Babysitter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BabysitterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', FileType::class )
            ->add('firstname', TextType::class )
            ->add('lastname', TextType::class )
            ->add('gender', TextType::class )
            ->add('location', TextType::class)
            ->add('description', TextAreaType::class )
            ->add('isAvailable', CheckboxType::class)
            ->add('languages', EntityType::class, [
                'class'=> Language::class,
                'choice_label' => 'label',
                'choice_name' => 'name',
                'multiple' => true,
                'expanded' => false
            ])
            ->add('contracts', EntityType::class, [
                'class'=> Contract::class,
                'hour_start' => '$hourStartContract',
                'hour_end' => '$hourEndContract',
                'date_start' => '$dateStartContract',
                'date_end' => '$dateEndContract',
                'review' => '$hourStartContract',
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
