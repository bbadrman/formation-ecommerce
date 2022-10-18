<?php

namespace App\EventDispatcher;

use Psr\Log\LoggerInterface;
use App\Event\ProductViewEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductViewEmailSubscriber implements EventSubscriberInterface
{
    protected $logger;
    protected $mailer;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer)
    {
     $this->logger = $logger; 
     $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            'product.view' => 'sendEmail'
        ];
    }

    public function sendEmail(ProductViewEvent $productViewEvent)
    {
        $email = new Email();
        $email->from(new Address("badr@gmail.com", "info de mon boutique"))
             ->to("bbadrman@gmail.com")
             ->text("un utilisateur est entrain de visite votre produit n°" .$productViewEvent->getProduct()->getId())
             ->html("<h1>un utilisateur est entrain de visite votre produit n° {$productViewEvent->getProduct()->getId()} </h1>")
             ->subject("Visiste du produit n°" .$productViewEvent->getProduct()->getId());
      
             $this->mailer->send($email);

       $this->logger->info("Email envoyé à l'admin pour le produit" .$productViewEvent->getProduct()->getID());
    }
}