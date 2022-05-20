<?php

namespace App\Form;

use App\Entity\Chrono;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChronoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('heure', IntegerType::class, [
                'attr'=>[
                    'min' => 0,
                    'max' => 23
                ]
            ])
            ->add('minute', IntegerType::class, [
                'attr'=>[
                    'min' => 0,
                    'max' => 59
                ]
            ])
            ->add('seconde', IntegerType::class, [
                'attr'=>[
                    'min' => 0,
                    'max' => 59
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chrono::class,
        ]);
    }
}
