<?php

namespace App\Controller;

use App\Entity\CategorieCollecte;
use App\Entity\ObjetCollecte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function devis()
    {
        $objetCollectes = $this->getDoctrine()->getRepository(ObjetCollecte::class)->findAll();
        $categories = $this->getDoctrine()->getRepository(CategorieCollecte::class)->findAll();

        return $this->render('entreprise/devis.html.twig', [
            'controller_name' => 'EntrepriseController',
            'objetCollectes' => $objetCollectes,
            'categories' => $categories
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
