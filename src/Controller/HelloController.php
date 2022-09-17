<?php

namespace App\Controller;

use App\Taxes\Calculator;
use App\Taxes\Detector;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HelloController{
 
    // protected $logger;
     
    // public function __construct(LoggerInterface $logger) {
    //     $this->logger = $logger;
    // }

    /**
     * @Route("/hello/{nom}", name="hello")
     */

    public function hello($nom= 'world', LoggerInterface $logger, Calculator $calculor, Slugify $slugify, Environment $twig, Detector $detector) {

        dump($detector->detect(102));
        dump($detector->detect(80));

     
        dump($twig);
        // $slugify = new Slugify();
        dump($slugify->slugify("hello words"));

        $logger->error("Mon message error ");

        $tva = $calculor->calcul(100);
        dump($tva);

        return new Response("Hello $nom !"); 

    }

}