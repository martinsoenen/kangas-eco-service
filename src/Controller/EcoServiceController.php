<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ContactGeneralType;


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
        return $this->render('eco_service/cgu.html.twig', [
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
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactGeneralType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
            $data = $form->getData();

             $message = (new \Swift_Message('Contact Eco-Service'))
                ->setTo('contact@kangas.fr')
                ->setFrom($data['email'])
                ->setBody(
                    'Message : ' . $data['message']. '<br>'.
                    'Envoyé par ' .$data['nom'] . $data['prenom']. '<br>'.
                    $data['email'],
                    'text/html'
                );
            
            $mailer->send($message);

            $this->addFlash('notice', 'Votre email a bien été envoyé. Nous vous repondrons au plus vite ');

            return $this->redirectToRoute('home');
        }

        return $this->render('eco_service/contact.html.twig', [
            'controller_name' => 'EcoServiceController',
            'form' => $form->createView(),
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
