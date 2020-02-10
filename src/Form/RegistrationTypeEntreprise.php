<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationTypeEntreprise extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('emailConfirm', EmailType::class)
            
            ->add('password', PasswordType::class)
            ->add('passwordConfirm',PasswordType::class)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('raisonSociale',TextType::class,array(
                'required' => true
            ))
            ->add('siret', IntegerType::class,array(
                'required' => true
            ))
            ->add('telephone')
            ->add('fonctionRepresentant',TextType::class,array(
                'required' => true
            ))
            ->add('conditions', CheckboxType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
