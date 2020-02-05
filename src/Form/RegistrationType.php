<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('emailConfirm', EmailType::class)
            ->add('civilite', ChoiceType::class, array(
                'label' => false,
                'placeholder' => 'Civilité',
                'choices' => array(
                    'Mr' => 'homme',
                    'Mme' => 'femme',
                ),
            ))
            ->add('password')
            ->add('passwordConfirm',TextType::class)
            ->add('nom')
            ->add('prenom')
            ->add('Adresse')
            ->add('raisonSociale')
            ->add('utilisateurType', ChoiceType::class, array(
                'label' => false,
                'placeholder' => 'Type de compte',
                'choices' => array(
                    'Particulier' => 'client',
                    'Professionnel' => 'pro',
                ),
            ))
            ->add('siret')
            ->add('telephone')
            ->add('fonctionRepresentant')
            ->add('conditions', CheckboxType::class)
            ->add('save', SubmitType::class, array(
                'attr' => ['class' => 'save'],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
