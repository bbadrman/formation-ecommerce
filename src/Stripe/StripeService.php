<?php

namespace App\Stripe;

use App\Entity\Purchase;

class StripeService {

    protected $publicKey;
    protected $secretKey;

    public function __construct(string $publicKey, string $secretKey) {

        $this->publicKey = $publicKey;
        $this->secretKey = $secretKey;
    }

    public function getPublicKey(): string { 

        return $this->publicKey;
    }

    public function getPaymentIntent(Purchase $purchase){
        \Stripe\Stripe::setApiKey($this->secretKey);

        return \Stripe\PaymentIntent::create([
           'amount' => $purchase->getTotal(),
           'currency' => 'eur'
        ]);   
    }
}