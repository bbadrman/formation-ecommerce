<?php

namespace App\Taxes;


class Detector {

    

    public function detect(int $amount)
    {
         if($amount > 100){
         return true;
        }{
            return false;
        }
        
    } 

}