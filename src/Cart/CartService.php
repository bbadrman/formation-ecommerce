<?php

namespace App\Cart;

use App\Cart\CartItem;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{

    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }


    protected function getCart(): array {
        return $this->session->get('cart', []);
    }

    protected function saveCart(array $cart) {
        $this->session->set('cart', $cart);
    }

    

    public function add(int $id)
    {

        //1. retrouver le panier dans la session (sous form d'un tableau)
        //2. si il n'existe pas encore alors prendre un tableau vide 
        $cart = $this->getCart();

        // [12 => 4, 23=>3, 40=>1]
        //3. voir si le produit ($id) existe déjà dans le tableau 
        //4. Si c'est le cas, simplement augmenter la quantité
        //5. Sinon, ajouter le produit avec la quantité 1
        if (!array_key_exists($id, $cart)) {
            $cart[$id] = 0;
        }  
            $cart[$id]++;
        
        //6. Enregistrer le tableau mis à jour dans la session

        $this->saveCart($cart);
    }

    public function remove(int $id)
    {
        $cart = $this->getCart();
        unset($cart[$id]);

        $this->saveCart($cart);
    }

    public function decrement(int $id)
    {

        $cart = $this->getCart();
        if(!array_key_exists($id, $cart)){
            return;
        }

        // soit le produit est à 1 alors il faut simplement le supprimer
        if($cart[$id] === 1){
            $this->remove($id);
            return;
        }
        // soit le produit est à plus de 1, alors il faut décrémenter
        $cart[$id]--;
        $this->saveCart($cart);
    }

    // vider le panier apres la commande
    public function empty(){
        $this->saveCart([]);
    }
    
    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);
            if(!$product) {
                continue;
            }
            $total += $product->getPrice() * $qty;
        }
        return $total;
    }


    /**
     *
     * @return CartItem[]
     */
    public function getDetailcartItems(): array
    {

        $detailCart = [];


        foreach ($this->getCart() as $id => $qty) {
            $product = $this->productRepository->find($id);

            if(!$product) {
                continue;
            }
            $detailCart[] = new CartItem($product, $qty);
        }
        return $detailCart;
    }
}
