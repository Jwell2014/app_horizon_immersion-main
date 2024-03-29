<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Document;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType:: class, [
                'attr'=> [ 'class'=> 'form-control'],
            ])
            ->add('description',TextType:: class, [
                'attr'=> [ 'class'=> 'form-control'],
            ])
            ->add('contenu', FileType::class, [
                'mapped'=> false,
                'required'=> false,
                'attr'=> [ 'class'=> 'form-control'],
                'constraints'=> [

                    new File([
                        'mimeTypes'=> [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml',
                            "video/mpeg", "video/mp4", "video/quicktime", "video/x-ms-wmv", "video/x-msvideo", "video/x-flv"
                        ],
                        'mimeTypesMessage'=> 'Veuillez télécharger une image JPG ou PNG',


                    ]),
                ],
            ])
            ->add('date')
            ->add('category',EntityType::class, [
                'required'=> false,
                'class'=> Category::class,
                'attr'=> ['class'=> 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
