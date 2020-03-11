<?php

namespace App\Service\Panier;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService {

    protected $session;
    protected $produitRepository;

    public function __construct(SessionInterface $session, ProduitRepository $produitRepository) {
        $this->session = $session;
        $this->produitRepository = $produitRepository;
    }

    public function add(int $id) {
        $panier = $this->session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }

    public function remove(int $id) {
        $panier = $this->session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
    }

    public function getPanierComplet() : array {
        $panier = $this->session->get('panier', []);
        $panierWithData = [];

        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->produitRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $panierWithData;
    }

    public function getTotal() : float {
        $total = 0;

        foreach($this->getPanierComplet() as $item) {
            $total += $item['product']->getPrixUnitaireHT() * (1 + $item['product']->getTauxTVA()/100) * $item['quantity'];
        }

        return $total;
    }

    public function reset() {
        $panier = $this->session->get('panier', []);

        if(!empty($panier)) {
            unset($panier);
        }

        $this->session->set('panier', []);
    }
}