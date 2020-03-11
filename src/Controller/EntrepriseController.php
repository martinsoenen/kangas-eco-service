<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactDevisType;

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
    public function devis(Request $request, \Swift_Mailer $mailer)
    {
        if($this->getUser()->getUtilisateurType()=="pro") {
            $user= $this->getUser();
            $form = $this->createForm(ContactDevisType::class);
            if($user != null)
            {
                $form->get('nom')->setData($user->getNom());
                $form->get('entreprise')->setData($user->getRaisonSociale());
                $form->get('email')->setData($user->getEmail());
                $form->get('tel')->setData($user->getTelephone());
            }

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $data = $form->getData();
                $message = (new \Swift_Message('Demande de devis par une entreprise'))
                    ->setTo('devis@kangas.fr')
                    ->setFrom($data['email'])
                    ->setBody('Message envoyé par ' . $data['nom'] . ', représentant l\'entreprise ' . $data['entreprise'] .
                        '<br/>Adresse d\'enlèvement : ' . $data['adresse'] . ' - ' . $data['cp'] . ' - ' . $data['ville'] .
                        '<br>Date d\'enlèvement : ' . date_format($data['date'], "Y/m/d") .
                        '<br/>Objets à collecter : ' . $data['objets'] .
                        '<br/>Poids de l\'objet à collecter : ' . $data['poids'] .
                        '<br/>Taille de l\'objet à collecter : ' . $data['taille'] .
                        '<br/>Image de l\'objet : ' . $data['image'] .
                        '<br/>Numéro de téléphone : ' . $data['tel'] .
                        '<br/>Commentaire supplémentaire : ' . $data['commentaire']
                        , 'text/html'
                    );

                $mailer->send($message);

                $this->addFlash('notice', 'Votre email a bien été envoyé. Nous vous répondrons au plus vite ');

                return $this->redirectToRoute('home');
            }
        }
        return $this->render('entreprise/devis.html.twig', [
            'controller_name' => 'EntrepriseController',
            'form' => $form->createView(),
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
