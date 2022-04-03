<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Contract;
use App\Entity\Babysitter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hourStartContract', DateTimeType::class)
            ->add('hourEndContract', DateTimeType::class)
            ->add('dateStartContract', DateType::class )
            ->add('dateEndContract', DateType::class )
            ->add('review', TextareaType::class)
            ->add('reviewDate', DateType::class )
            ->add('user', EntityType::class, [
                'class'=> User::class,
                'choice_label'=>'username'
                
            ])
            ->add('babysitter', EntityType::class, [
                'class'=> Babysitter::class,
                'choice_label'=>'id'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contract::class,
        ]);
    }
}
