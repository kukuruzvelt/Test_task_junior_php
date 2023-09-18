<?php

namespace App\Service;

use App\Abstract\AbstractCompany;

class PackGroup extends AbstractCompany
{

    public function calculatePrice(int $weight): int
    {
        return $weight;
    }
}