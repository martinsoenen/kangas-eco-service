<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class ContactDevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', TextType::class, array(
                'label' => 'Entreprise',
                'required' => true,
            ))
            ->add('nom', TextType::class, array(
                'label' => 'Nom et prénom du représentant',
                'required' => true,
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email de contact',
                'required' => true,
            ))
            ->add('tel')
            ->add('objets', TextareaType::class, array(
                'label' => 'Objets à collecter',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Indiquez ici les objets à venir chercher et leur quantité',
                ]
            ))
            ->add('poids', IntegerType::class, array(
                'label' => 'Poids de l\'objet',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Poids de l\'objet',
                ]
            ))
            ->add('taille', IntegerType::class, array(
                'label' => 'Taille de l\'objet',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Taille de l\'objet',
                ]
            ))
            ->add('image', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            "image/png",
                            "image/jpeg",
                            "image/jpg",
                            "image/gif",
                        ],
                        'mimeTypesMessage' => 'Uploadez un format d\'image valide (jpg, jped, png ou gif)'
                    ])
                ],
            ])
            ->add('adresse', TextType::class, array(
                'label' => 'Adresse de récupération de l\'objet',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Renseignez l\'adresse de récupération de l\'objet',
                ]
            ))
            ->add('cp', IntegerType::class, array(
                'label' => 'Code Postal',
                'required' => true,
            ))
            ->add('ville', TextType::class, array(
                'label' => 'Ville',
                'required' => true,
            ))
            ->add('date', DateType::class, array(
                'label' => 'Date de récupération de l\'objet',
                'required' => true,
            ))
            ->add('commentaire', TextareaType::class, array(
                'label' => 'Commentaire',
                'required' => false,
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Envoyer',
                'attr' => array('title' => 'Envoyer l\'email', 'class' => 'btn btn-outline-success'
                ),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
