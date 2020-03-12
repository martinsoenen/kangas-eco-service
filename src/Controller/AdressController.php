<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdressController extends AbstractController
{
    /**
     * @Route("/profil/adresse/{id}/edit", name="profil_adresse")
     */
    public function index(Request $request)
    {
        if($this->getUser() != null){
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if($this->getUser()->getUtilisateurType()!="pro"){
                
                $id = $request->get('id');

                $Adresse = $this->getDoctrine()
                                ->getRepository(Adresse::class)
                                ->find($id);

                $form = $this->createForm(AdresseType::class, $Adresse)
                        ->add('save', SubmitType::class, array(
                            'label' => 'Valider',
                            'attr' => array('title' => 'Valider les modifications' ,'class' => 'btn btn-outline-success'
                            ),
                        ))
                ;
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {  

                    $data = $form->getData();

                    $em = $this->getDoctrine()->getManager();
                            $em->persist($data);
                            $em->flush();
                    $this->addFlash('success', 'Votre adresse a été modifiée !');

                    return $this->redirectToRoute('profil_client');

                }
                
                return $this->render('adress/index.html.twig', [
                    'controller_name' => 'AdressController',
                    'form' => $form->createView(),
                ]);
            }
            else {
                return $this->redirectToRoute('profil_entreprise');
                }
        }
        else {
            return $this->redirectToRoute('security_login');
        }
    }

    /**
     * @Route("/profil/adresse/nouvelle", name="adresse_new")
     */

     public function new(Request $request)
    {
        if($this->getUser() != null){
            $UtilisateurId = $this->getUser()->getId();

            //Aiguillage particulier/entreprise
            if($this->getUser()->getUtilisateurType()!="pro"){

                
                $form = $this->createForm(AdresseType::class)
                        ->add('save', SubmitType::class, array(
                            'label' => 'Valider',
                            'attr' => array('title' => 'Valider les modifications' ,'class' => 'btn btn-outline-success'
                            ),
                        ))
                ;
                $form->handleRequest($request);


                if ($form->isSubmitted() && $form->isValid()) {  

                    $data = $form->getData();

                    $data->setUtilisateur($this->getUser());

                    $em = $this->getDoctrine()->getManager();
                            $em->persist($data);
                            $em->flush();
                    $this->addFlash('success', 'Votre adresse a bien été créée !');

                    return $this->redirectToRoute('profil_client');

                }
                
                return $this->render('adress/index.html.twig', [
                    'controller_name' => 'AdressController',
                    'form' => $form->createView(),
                ]);
            }
            else {
                return $this->redirectToRoute('profil_entreprise');
                }
        }
        else {
            return $this->redirectToRoute('security_login');
        }
    }
}
