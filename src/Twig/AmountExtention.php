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
    public function amount($value, string $symbol = 'Dhs', string $decsep = ',', string $thousandsep = ''){
        //19229 => 192,29 Dhs
        $finalvalue = $value / 100;
        // 192.29
        $finalvalue = number_format($finalvalue, 2, $decsep, $thousandsep);
        // 192,29

        return $finalvalue . ' ' . $symbol;

    }
}