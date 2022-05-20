<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $random = random_int(11111111, 99999999);
        $builder
            ->add('username', TextType::class, [
                'label' => false,
                'attr' => array(
                    'class'=> 'col-6',
                    'placeholder' => 'Participant'
                ),
            ])
            ->add('roles', HiddenType::class, array(
                'attr' => array(
                    'class' => 'form-control',
                    'required' => false,
                ),
                'data' => ['ROLE_PARTICIPANT'],
            ))



            ->add('password', TextType::class, [
                'label' => false,
                'attr' => array(
                    'class'=> 'col-6',
                    'placeholder' => 'Mot de passe'
                ),
                'data' => $random
            ])
        ;
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesAsArray) {
                    // transform the array to a string
                    return implode(', ', $rolesAsArray);
                },
                function ($rolesAsString) {
                    // transform the string back to an array
                    return explode(', ', $rolesAsString);
                }
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
