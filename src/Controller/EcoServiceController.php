<?php

namespace App\Controller;

use App\Form\ContactGeneralType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        if ($this->getUser() != null) {
            $user = $this->getUser();
            $form->get('email')->setData($user->getEmail());
            $form->get('nom')->setData($user->getNom());
            $form->get('prenom')->setData($user->getPrenom());
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $message = (new \Swift_Message('Contact Eco-Service'))
                ->setTo('contact@kangas.fr')
                ->setFrom($data['email'])
                ->setBody(
                    'Bonjour, vous avez reçu un nouveau message via le formulaire de contact de votre site. '.'<br>'.
                    'Message : '.$data['message'].'<br>'.
                    'Envoyé par '.$data['nom'].$data['prenom'].'<br>'.
                    'Mail de contact de la personne : '.$data['email'],
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('success', 'Votre email a bien été envoyé. Nous vous répondrons au plus vite. ');

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
        if ($this->getUser() != null && $this->getUser()->getUtilisateurType() == "admin") {
            return $this->render('eco_service/admin_index.html.twig', [
                'controller_name' => 'EcoServiceController',
            ]);
        } else {
            $this->addFlash('error', 'Veuillez vous connecter en tant qu\'administrateur. Accès refusé.');
            return $this->redirectToRoute('security_login');
        }
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
