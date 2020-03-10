<?php

namespace App\Controller;

use App\Entity\CategorieCollecte;
use App\Entity\ObjetCollecte;
use App\Form\CategorieCollecteType;
use App\Form\ContactDevisType;
use App\Form\ContactGeneralType;
use App\Form\ObjetCollecteType;
use App\Repository\ObjetCollecteRepository;
use App\Repository\ProduitRepository;
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
    public function devis(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactDevisType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $message = (new \Swift_Message('Demande de devis par une entreprise'))
                ->setTo('devis@kangas.fr')
                ->setFrom($data['email'])
                ->setBody('Message envoyé par ' . $data['nom'] . ', représentant l\'entreprise ' . $data['entreprise'] .
                    '<br/>Adresse d\'enlèvement : ' . $data['rue'] . ' - ' . $data['cp'] . ' - ' . $data['ville'] .
                    '<br>Date d\'enlèvement : ' . date_format($data['date'],"Y/m/d") .
                    '<br/>Objets à collecter : ' . $data['produits'] .
                    '<br/>Commentaire supplémentaire : ' . $data['commentaire']
                    ,'text/html'
               );

            $mailer->send($message);

            $this->addFlash('notice', 'Votre email a bien été envoyé. Nous vous repondrons au plus vite ');

            return $this->redirectToRoute('home');
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
