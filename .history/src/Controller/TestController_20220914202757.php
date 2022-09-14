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
        

       dd("test fonctionne bien");
       
    }
} 