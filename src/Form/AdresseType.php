<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,array(
                'label' =>false, 
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Nom de votre adresse (ex : Maison)',
                )))               
            ->add('numeroRue', IntegerType::class,array(
                'label' =>false,
                'required' => true,
                'attr' => array(
                     'placeholder' => 'Numéro de rue',
                ))) 
            ->add('typeRue', TextType::class,array(
                'label' =>false,
                'required' => true,
                'attr' => array(
                   'placeholder' => 'Type de rue', 
                )))
            ->add('nomRue', TextType::class,array(
                'label' =>false,
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Nom de la rue',
                ))) 
            ->add('CP', IntegerType::class,array(
                'label' =>false,
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Code postal',
                )))
            ->add('Ville', TextType::class,array(
                'label' =>false,
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Ville',
                )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
