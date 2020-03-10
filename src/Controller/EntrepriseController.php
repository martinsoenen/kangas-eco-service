<?php

namespace App\Controller;

use App\Entity\CategorieCollecte;
use App\Entity\ObjetCollecte;
use App\Form\CategorieCollecteType;
use App\Form\ObjetCollecteType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise/services", name="entreprise_services")
     */
    public function services()
    {
        return $this->render('entreprise/services.html.twig', [
            'controller_name' => 'EntrepriseController',
        ]);
    }

    /**
     * @Route("/entreprise/devis", name="entreprise_devis")
     */
    public function devis(Request $request)
    {
        $form = $this->createForm(CategorieCollecteType::class)
            ->add('nom', EntityType::class, [
            'class' => CategorieCollecte::class,
            'choice_label' => 'nom',
            'label' => 'Catégorie collectés',
    ]);

        if ($request->isXmlHttpRequest()) {

            $categorie = $request->get('categorie');
            $form = $this->createForm(CategorieCollecteType::class)
                ->add('nom', EntityType::class, [
                    'class' => ObjetCollecte::class,
                    'choice_label' => 'nom',
                    'label' => 'Objets collectés',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('o')
                            ->where('o.CategorieCollecte = :val')
                            ->SetParameter('val', 'Electromenager');
              },
              ]);
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $categ = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categ);
            $entityManager->flush();
        }

        return $this->render('entreprise/devis.html.twig', [
            'controller_name' => 'EntrepriseController',
            //'objetCollectes' => $objetCollectes,
            'form' => $form->createView(),
            //'formObjet' => $formObjet->createView(),
        ]);
    }

    /**
     * @Route("/entreprise/contact", name="entreprise_contact")
     */
    public function contact()
    {
        return $this->render('entreprise/contact.html.twig', [
            'controller_name' => 'EntrepriseController',
        ]);
    }
}
