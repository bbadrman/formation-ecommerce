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

    public function hello($nom= 'world', Environment $twig) {

        $html = $twig->render('hello.html.twig', ['nom' => $nom]);
        return new Response($html); 

    }

} 