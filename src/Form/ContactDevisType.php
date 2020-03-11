<?php

namespace App\Form;

use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class ContactDevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', TextType::class,array(
                'label' => 'Entreprise',
                'required' => true,
            ))
            ->add('nom', TextType::class,array(
                'label' => 'Nom et prénom du représentant',
                'required' => true,
            ))
            ->add('email', EmailType::class,array(
                'label' => 'Email de contact',
                'required' => true,
            ))
            ->add('tel')
            ->add('objets', TextareaType::class,array(
                'label' => 'Objets à collecter',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Indiquez ici les objets à venir chercher et leur quantité',
                ]
            ))
            ->add('poids', IntegerType::class,array(
                'label' => 'Poids de l\'objet',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Poids de l\'objet',
                ]
            ))
            ->add('rue', TextType::class,array(
                'label' => 'Rue',
                'required' => true,
            ))
            ->add('ville', TextType::class,array(
                'label' => 'Ville',
                'required' => true,
            ))
            ->add('cp', IntegerType::class,array(
                'label' => 'Code Postal',
                'required' => true,
            ))
            ->add('date', DateType::class,array(
                'label' => 'Date',
                'required' => true,
            ))
            ->add('commentaire', TextareaType::class,array(
                'label' => 'Commentaire',
                'required' => false,
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Envoyer',
                'attr' => array('title' => 'Envoyer l\'email' ,'class' => 'btn btn-outline-success'
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
