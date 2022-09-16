<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HelloController{
 
    protected $logger;
     
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    /**
     * @Route("/hello/{nom}", name="hello")
     */

    public function hello($nom= 'world' ) {

        $this->logger->error("Mon message error ");
        return new Response("Hello $nom !"); 

    }

}