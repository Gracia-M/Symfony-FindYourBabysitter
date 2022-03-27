<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Babysitter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BabysitterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', FileType::class)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('gender', TextType::class)
            ->add('location', TextType::class)
            ->add('description', TextType::class)
            ->add('isAvailable', ChoiceType::class)
            ->add('languages', ChoiceType::class, [
                'choices'=> LanguageType::class, [
                    'class'=> Language::class,
                    'choice_label'=> 'label'
                ]
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
