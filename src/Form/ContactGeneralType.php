<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactGeneralType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'required' => true,
            ))
            ->add('nom', TextType::class, array(
                'label' => 'Nom',
                'required' => true,
            ))
            ->add('prenom', TextType::class, array(
                'label' => 'Prénom',
                'required' => true,
            ))
            ->add('message', TextareaType::class, array(
                'label' => 'Message',
                'required' => true,
            ))
            ->add('conditions', CheckboxType::class)
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
