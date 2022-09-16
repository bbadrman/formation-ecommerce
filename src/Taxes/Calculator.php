<?php

namespace App\Taxes;

use Psr\Log\LoggerInterface;



class Calculator {

protected $logger;

public function __construct(LoggerInterface $logger)    {
    $this->logger = $logger;
    
}
    public function calcul(float $prix): float {
        $this->logger->info("un calcul a lieu : $prix");
        return $prix * (20/100);
    }
}