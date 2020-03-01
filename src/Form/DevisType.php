<?php

namespace App\Form;

use App\Entity\Devis;
use App\Entity\ObjetCollecte;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quantite');
        $builder->add('CategorieCollecte');
        $builder->add('ObjectCollect');
        $builder->add('devis');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $categorieCollecte = $event->getData();
            $objectCollect = $event->getData();
            $form = $event->getForm();

            if (!$categorieCollecte || null === $categorieCollecte->getId() && (!$objectCollect || nul === $objectCollect))
                $form->add('name', TextType::class);
        });
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ObjetCollecte::class,
        ]);
    }
}
