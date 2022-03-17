<?php

namespace App\Form;

use App\Entity\Contract;
use App\Entity\Language;
use App\Entity\Babysitter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BabysitterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', TextType::class )
            ->add('firstname', TextType::class )
            ->add('lastname', TextType::class )
            ->add('gender', TextType::class )
            ->add('location', TextType::class)
            ->add('description', TextareaType::class )
            ->add('isAvailable', CheckboxType::class)
            ->add('languages', ChoiceType::class, [
                'preferred_choices' => [
                    'EN'=> 'Anglais',
                    'FR'=> 'Français',
                    'NL'=> 'Néerlandais',
                    'IT'=> 'Italien',
                    'ES'=> 'Espagnol'
                ],
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
