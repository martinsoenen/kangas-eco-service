<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    /**
     * @Route("/entreprise/services", name="entreprise_services")
     */
    public function services()
    
    {
        if($this->getUser()->getUtilisateurType()=="pro" ){

            return $this->render('entreprise/services.html.twig', [
                'controller_name' => 'EntrepriseController',
            ]);

        }
        else{
            $this->addFlash('error', 'Vous avez un compte client. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/entreprise/devis", name="entreprise_devis")
     */
    public function devis()
    {
        if($this->getUser()->getUtilisateurType()=="pro" ){

            return $this->render('entreprise/devis.html.twig', [
                'controller_name' => 'EntrepriseController',
            ]);
        }else{
            $this->addFlash('error', 'Vous avez un compte client. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/entreprise/contact", name="entreprise_contact")
     */
    public function contact()
    {
        if($this->getUser()->getUtilisateurType()=="pro" ){

        return $this->render('entreprise/contact.html.twig', [
            'controller_name' => 'EntrepriseController',
        ]);

        }else{
            $this->addFlash('error', 'Vous avez un compte client. Accès refusé.');
            return $this->redirectToRoute('home');
        }
    }
}
