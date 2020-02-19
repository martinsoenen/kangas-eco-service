<?php

namespace App\Controller;

use App\Service\Panier\PanierService;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;

class AchatController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(PanierService $panierService)
    {
        return $this->render('achat/index.html.twig', [
            'controller_name' => 'AchatController',
            'items' => $panierService->getPanierComplet(),
            'total' => $panierService->getTotal()
        ]);
    }

    /**
     * @Route("/panier/paiement", name="panier_paiement")
     */
    public function paiement(PanierService $panierService)
    {
        $credentials = [
            'id' => 'Ae0q9Y6VL5tsv0vcBvzBMv3kjg7mM50yooD8C9u2nm1HmVa5pcCa9GH-Ov7swbpl1CHru_D2G_GXCQ4O',
            'secret' => 'EFN_usuuBumAEyMgasVcamuZCaimCZ7JJzCWqsFbYKZ08HhQ6y43jENMHLJrk8qHhYfQRzXnt2SBYVHI'
        ];
        $apiContext = new ApiContext(
            new OAuthTokenCredential($credentials['id'],$credentials['secret']
            )
        );

        // On construit notre appel à l'API PayPal

        $list = new ItemList();
        $totalPrice = 0;
        foreach ($panierService->getPanierComplet() as $product) {
            $item = (new Item())
                ->setName($product['product']->getNomProduit())
                ->setPrice(round($product['product']->getPrixUnitaireHT() * ( 1 + $product['product']->getTauxTVA()), 2))
                ->setCurrency('EUR')
                ->setQuantity($product['quantity']);
            $list->addItem($item);

            $totalPrice += ($product['quantity'] * round(($product['product']->getPrixUnitaireHT() * ( 1 + $product['product']->getTauxTVA())), 2));
        }

        $details = (new Details())
            ->setSubtotal($totalPrice);
//            TODO:Ajouter la TVA

        $amount = (new Amount())
            ->setTotal($totalPrice)
            ->setCurrency('EUR')
            ->setDetails($details);

        $transaction = (new Transaction())
            ->setItemList($list)
            ->setDescription('Achat sur le site Eco-Service')
            ->setAmount($amount);

        $payment = new Payment();
        $payment->setTransactions([$transaction]);
        $payment->setIntent('sale');
        $redirectUrls = (new RedirectUrls())
            ->setReturnUrl($this->generateUrl('panier_paiement', [], UrlGenerator::ABSOLUTE_URL))
            ->setCancelUrl($this->generateUrl('panier', [], UrlGenerator::ABSOLUTE_URL));
        $payment->setRedirectUrls($redirectUrls);
        $payment->setPayer((new Payer())->setPaymentMethod('paypal'));

        try {
            $payment->create($apiContext);
            header('Location: ' . $payment->getApprovalLink());
        } catch (\PayPal\Exception\PayPalConnectionException $e) {
            dump(json_decode($e->getData()));
        }

        return $this->render('achat/paiement.html.twig', [
            'controller_name' => 'AchatController',
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, PanierService $panierService)
    {
        $panierService->add($id);

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
