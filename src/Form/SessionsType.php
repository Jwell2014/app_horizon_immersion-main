<?php

namespace App\Form;

use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomDeSession')
            ->add('EtatDeSession', ChoiceType::class, [
                'choices' => [
                    'Non Démarré' => 'Non Démarré',
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                ],
                'expanded' => true,
                'attr' => ['class' => 'd-flex'],
                'label_attr' => ['class' => 'me-3'],
            ])
            ->add('NombreParticipants', ChoiceType::class, [
                'choices' => [
                    '8' => 8,
                    '10' => 10,
                    '12' => 12,
                ],
                'expanded' => true,
                'attr' => ['class' => 'd-flex'],
                'label_attr' => ['class' => 'me-3'],
            ])
            ->add('users', CollectionType::class, [
                'entry_type' => ParticipantsType::class,
                'label' => 'Participants',
                'entry_options' => ['label' => false, 'attr' => ['class'=> 'col-6 border-bottom border-2 border-danger mb-3']],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
