<?php

namespace App\Form;

use App\Entity\Babysitter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BabysitterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture', FileType::class, array ('label'=>'selectionner l\'image'))
            ->add('firstname', TextType::class )
            ->add('lastname', TextType::class )
            ->add('gender', TextType::class )
            ->add('location', TextType::class)
            ->add('description', TextareaType::class )
            ->add('isAvailable', CheckboxType::class)
            ->add('language', EntityType::class, [
                'class'=> Language::class,
                'choice_label' => 'label',
                'preferred choices'=> 'name',
                'multiple' => true,
                'expanded' => false
            ])
            // ->add('contracts', ContractType::class, [
            //     'class'=> Contract::class,
            //     'hour_start' => 'hourStartContract',
            //     'hour_end' => 'hourEndContract',
            //     'date_start' => 'dateStartContract',
            //     'date_end' => 'dateEndContract',
            //     'review' => 'hourStartContract',
            //     'multiple' => true,
            //     'expanded' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Babysitter::class,
        ]);
    }
}
