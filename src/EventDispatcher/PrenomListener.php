<?php

namespace App\EventDispatcher;

use Symfony\Component\HttpKernel\Event\RequestEvent;


class PrenomListener {

    public function addPrenomToAttribute(RequestEvent $event){

        $event->getRequest()->attributes->set('prenom', 'badr');
         
    }
}