<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EcoServiceController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('eco_service/index.html.twig', [
            'controller_name' => 'EcoServiceController',
        ]);
    }

    /**
     * @Route("/cgu-cgv", name="cgu-cgv")
     */
    public function cgu()
    {
        return $this->render('eco_service/CGU.html.twig', [
            'controller_name' => 'EcoServiceController',
        ]);
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faq()
    {
        return $this->render('eco_service/faq.html.twig', [
            'controller_name' => 'EcoServiceController',
        ]);
    }
    
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('eco_service/contact.html.twig', [
            'controller_name' => 'EcoServiceController',
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     * @Route("/admin/index", name="admin_index")
     */
    public function admin_index()
    {
        return $this->render('eco_service/admin_index.html.twig', [
            'controller_name' => 'EcoServiceController',
        ]);
    }

    /**
     * @Route("/particulier", name="particulier")
     * @Route("/particulier/index", name="particulier_index")
     */
    public function particulier_index()
    {
        return $this->render('eco_service/particulier_index.html.twig',[
            'controller_name' => 'EcoServiceController',
        ]);
    }

    /**
     * @Route("/qui-sommes-nous", name="qui-sommes-nous")
     */
    public function qui_sommes_nous()
    {
        return $this->render('eco_service/qui_sommes_nous.html.twig', [
            'controller_name' => 'EcoServiceController',
        ]);
    }

    /**
     * @Route("/entreprise", name="entreprise")
     * @Route("/entreprise/index", name="entreprise_index")
     */
    public function entreprise_index()
    {
        return $this->render('eco_service/entreprise_index.html.twig', [
            'controller_name' => 'EcoServiceController',
        ]);
    }
}
