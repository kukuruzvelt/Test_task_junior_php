<?php

namespace App\Service;

use App\Abstract\AbstractCompany;

class CalculatePriceService
{
    public function calculate(AbstractCompany $classInstance, int $weight)
    {
        return $classInstance->calculatePrice($weight);
    }
}