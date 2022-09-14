<?php

namespace App\Controller;

Class TestController 
{
    public function index()
    {
        var_dump("ca fonctionne bien");
        die();
    }

    public function test(){
        // php native :
    //     $age = 0;
    //     if(!empty($_GET["age"])){
    //        $age = $_GET["age"];
    //     }
    //    dd("Vous aver $age ans");
    $request = Request::createFromGlobals();
       
    }
} 