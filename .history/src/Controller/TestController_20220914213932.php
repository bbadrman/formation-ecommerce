<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController
{
    public function index()
    {
        var_dump("ca fonctionne bien");
        die();
    }

    public function test(Request $request, $age)
    {
        
        // $age = $request->attributes->get('age');
        return new Response("Vous avez $age ans!"); 

    }
}
