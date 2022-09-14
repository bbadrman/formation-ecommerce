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

    public function test(Request $request)
    {
        // php native :
        //     $age = 0;
        //     if(!empty($_GET["age"])){
        //        $age = $_GET["age"];
        //     }
        //    dd("Vous aver $age ans");

        // On implemente ce code par symfony
        //$request = Request::createFromGlobals();  // Objet Request qui contient get,post;;;
        $age = $request->attributes->get('age');
        return new Response("Vous avez $age ans!"); // response c comme print ou echo sur php

    }
}
