<?php

namespace App\EventDispatcher;

use Psr\Log\LoggerInterface;
use App\Event\PurchaseSuccessEvent;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PurchaseSuccessEmailSubscriber implements EventSubscriberInterface
{

    protected $logger;
    protected $mailer;
    protected $security;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer, Security $security){

        $this->logger = $logger;
        $this->mailer = $mailer;
        $this->security = $security;
    }

    public static function getSubscribedEvents(){
        return [
            'purchase.success' => 'sendSuccessEmail'
        ];
    }

    public function sendSuccessEmail(PurchaseSuccessEvent $purchaseSuccessEvent)
    {
        //1. récupérer l'utilisateur actuellement en ligne (pour connaitre son email grace a security)
        /** @var User */
        $currentUser = $this->security->getUser();
        //2. récupérer la commande (je la trouverai dans PurchaseSuccessEvent)
        $purchase = $purchaseSuccessEvent->getPurchase();
        //3. Ecrire le mail (nouveau TemplatedEmail)
        $email = new TemplatedEmail();
        $email->to(new Address($currentUser->getEmail(), $currentUser->getFullName()))
              ->from("contact@gmail.com")
              ->subject("Bravo, votre commande ({$purchase->getId()}) a bien été confirmée")
              ->htmlTemplate('emails/purchase_success.html.twig')
              ->context([
                'purchase' => $purchase,
                'user' => $currentUser
              ]);
        //4.Enovoyer l'email grace a MailerInterface
        $this->mailer->send($email);
        $this->logger->info("Email envoyé pour la commande n°" .$purchaseSuccessEvent->getPurchase()->getId());
    }
}