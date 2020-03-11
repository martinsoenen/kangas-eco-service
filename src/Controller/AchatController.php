<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Service\Panier\PanierService;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;

class AchatController extends AbstractController
{
    protected $session;

    /**
     * @Route("/panier", name="panier")
     */
    public function index(PanierService $panierService)
    {
        if($this->getUser()!=null) {
            if($this->getUser()->getUtilisateurType()!="pro" ){
                return $this->render('achat/index.html.twig', [
                    'controller_name' => 'AchatController',
                    'items' => $panierService->getPanierComplet(),
                    'total' => $panierService->getTotal()
                ]);
            }
            else{
                $this->addFlash('error', 'Vous avez un compte entreprise. Accès refusé.');
                return $this->redirectToRoute('home');
            }
        }else{
        return $this->render('achat/index.html.twig', [
                    'controller_name' => 'AchatController',
                    'items' => $panierService->getPanierComplet(),
                    'total' => $panierService->getTotal()
                ]);
        }
    }

    /**
     * @Route("/panier/paiement", name="panier_paiement")
     */
    public function paiement(PanierService $panierService)
    {
        if($this->getUser()!=null) {
            if($this->getUser()->getUtilisateurType()!="pro"){
                $credentials = [
                    'id' => 'Ae0q9Y6VL5tsv0vcBvzBMv3kjg7mM50yooD8C9u2nm1HmVa5pcCa9GH-Ov7swbpl1CHru_D2G_GXCQ4O',
                    'secret' => 'EFN_usuuBumAEyMgasVcamuZCaimCZ7JJzCWqsFbYKZ08HhQ6y43jENMHLJrk8qHhYfQRzXnt2SBYVHI'
                ];
                $apiContext = new ApiContext(
                    new OAuthTokenCredential($credentials['id'], $credentials['secret']
                    )
                );

                // On construit notre appel à l'API PayPal

                $list = new ItemList();
                $totalPrice = 0;
                foreach ($panierService->getPanierComplet() as $product) {
                    $item = (new Item())
                        ->setName($product['product']->getNomProduit())
                        ->setPrice(round($product['product']->getPrixUnitaireHT() * (1 + $product['product']->getTauxTVA() / 100), 2))
                        ->setCurrency('EUR')
                        ->setQuantity($product['quantity']);
                    $list->addItem($item);

                    $totalPrice += ($product['quantity'] * round(($product['product']->getPrixUnitaireHT() * (1 + $product['product']->getTauxTVA() / 100)), 2));
                }
            }
            else {
                $this->addFlash('error', 'Vous avez un compte entreprise. Accès refusé.');
                return $this->redirectToRoute('home');
            }

            return $this->render('achat/showCommande.html.twig', [
                'controller_name' => 'AchatController',
            ]);
        }else{
            $this->addFlash('error', 'Veuillez vous connecter pour commander un article !');
            return $this->render('security/login.html.twig', [
                'controller_name' => 'AchatController',
            ]);
        }
    }

    /**
     * @Route("/panier/paiement_termine", name="panier_paiement_termine")
     */
    public function paiementTermine(Request $request, PanierService $panier)
    {
        ///////////// Exécution du paiement PayPal

        $credentials = [
            'id' => 'Ae0q9Y6VL5tsv0vcBvzBMv3kjg7mM50yooD8C9u2nm1HmVa5pcCa9GH-Ov7swbpl1CHru_D2G_GXCQ4O',
            'secret' => 'EFN_usuuBumAEyMgasVcamuZCaimCZ7JJzCWqsFbYKZ08HhQ6y43jENMHLJrk8qHhYfQRzXnt2SBYVHI'
        ];
        $apiContext = new ApiContext(
            new OAuthTokenCredential($credentials['id'],$credentials['secret']
            )
        );
        $payment = Payment::get($quantite = $request->get('paymentId'), $apiContext);

        $execution = (new PaymentExecution())
            ->setPayerId($request->get('PayerID'))
            ->setTransactions($payment->getTransactions());
        try {
            $payment->execute($execution, $apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $e) {
            dump(json_decode($e->getData()));
        }

        ///////////// Insertion de la commande en BDD

        $entityManager = $this->getDoctrine()->getManager();
        $commande = new Commande();

        $montantHT = 0;
        $montantTVA = 0;
        $nbArticles = 0;
        foreach($panier->getPanierComplet() as $item) {
            for ($i = 0;  $i < $item['quantity']; $i++) {
                $montantHT += $item['product']->getPrixUnitaireHT();
                $montantTVA += (($item['product']->getTauxTVA() / 100) * $item['product']->getPrixUnitaireHT());
                $nbArticles++;
                $commande->addProduit($item['product']);
            }
        }

        $adresse = $payment->getPayer()->getPayerInfo()->getShippingAddress();

        $commande->setDate(new \DateTime());
        $commande->setIsSend(0);
        $commande->setMontantHT($montantHT);
        $commande->setMontantTVA($montantTVA);
        $commande->setMontantTotalTTC($montantHT + $montantTVA);
        $commande->setNbArticles($nbArticles);
        $commande->setPayPalID($payment->id);
        $commande->setUser($this->getUser());
        $commande->setShippingAddr($adresse->getLine1() . '|' . $adresse->getLine2() . '|' . $adresse->getPostalCode() . '|' . $adresse->getCity());
        $entityManager->persist($commande);
        $entityManager->flush();

        ///////////// Réinitialisation du panier

        $panier->reset();

        return $this->render('achat/showCommande.html.twig', [
            'controller_name' => 'AchatController',
            'commande' => $commande,
            'adresse' => explode('|', $commande->getShippingAddr()),
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add", methods={"GET","HEAD"})
     */
    public function add(Request $request, $id, PanierService $panierService)
    {
        $quantite = $request->get('quantite');

        for ($i = 0; $i < $quantite; $i++) {
            $panierService->add($id);
        }

        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, PanierService $panierService)
    {
        $panierService->remove($id);

        return $this->redirectToRoute("panier");

    }
}
