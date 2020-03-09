<?php

namespace App\Form;

use App\Entity\CategorieCollecte;
use App\Entity\ObjetCollecte;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieCollecteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', EntityType::class, [
                'class' => CategorieCollecte::class,
                'choice_label' => 'nom',
                'label' => 'Catégorie',
                'multiple' => true,
            ])
            ->add('save', SubmitType::class, array('label' => 'Voir les objets de la catégorie sélectionné'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategorieCollecte::class,
        ]);
    }
}
