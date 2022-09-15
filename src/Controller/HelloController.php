<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HelloController{


    /**
     * @Route("/hello/{nom}", name="hello")
     */

    public function hello($nom= 'world' ) {
   
        return new Response("Hello $nom !"); 

    }

}