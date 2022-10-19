<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AmountExtention extends AbstractExtension {

    public function getFilters()
    {
        return [
            new TwigFilter('amount', [$this, 'amount'])
        ];
    }
    public function amount($value){
        //19229 => 192,29 Dhs
        $finalvalue = $value / 100;
        // 192.29
        $finalvalue = number_format($finalvalue, 2, ',', '');
        // 192,29

        return $finalvalue . ' Dhs';

    }
}