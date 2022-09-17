<?php

namespace App\Taxes;


class Detector {

    private $seuil;

    public function __construct($seuil){
        $this->seuil = $seuil;
    }

    public function detect(int $amount)
    {
         if($amount > $this->seuil){
         return true;
        }{
            return false;
        }
        
    } 

}