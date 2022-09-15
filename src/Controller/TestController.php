<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    public function index()
    {
       dd("ca fonctionne bien");
       
    }
/**
 * Undocumented function
 *
 * @param Request $request
 * @param [type] $age
 * @return void
 * @Route("/test", name="test")
 */
    public function test(Request $request, $age)
    {
        // ajoute $age sur (Request $request, $age) et comment la ligne ci desu
        // $age = $request->attributes->get('age');
        return new Response("Vous avez $age ans!"); 

    }
    public function show(){
        return new Response("Vous avez 39 ans!"); 
    }
}
