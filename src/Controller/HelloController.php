<?php

namespace App\Controller;

use App\Taxes\Calculator;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HelloController{
 
    // protected $logger;
     
    // public function __construct(LoggerInterface $logger) {
    //     $this->logger = $logger;
    // }

    /**
     * @Route("/hello/{nom}", name="hello")
     */

    public function hello($nom= 'world', LoggerInterface $logger, Calculator $calculor ) {

        $logger->error("Mon message error ");
        $tva = $calculor->calcul(100);
        dump($tva);
        return new Response("Hello $nom !"); 

    }

}