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
     * @Route("/CGU-CGV", name="CGU-CGV")
     */
    public function CGU()
    {
        return $this->render('eco_service/CGU.html.twig', [
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
}
