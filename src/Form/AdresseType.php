<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',
            )
            ->add('numeroRue',
            )
            ->add('typeRue',
            )
            ->add('nomRue',
            )
            ->add('CP',
            )
            ->add('Ville',
            )
            ->add('AdresseType',
            )
            ->add('Utilisateur',
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
