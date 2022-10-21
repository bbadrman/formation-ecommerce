<?php

namespace App\EventDispatcher;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PrenomSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'kernel.request' => 'addPrenomToAttribute', 

        ];
    }

    public function addPrenomToAttribute(RequestEvent $event)
    {

        $event->getRequest()->attributes->set('prenom', 'badr');
    }

    public function test1()
    {
        
    }
    public function test2()
    {
        
    }
}
