<?php

namespace App\Service;

use App\Abstract\AbstractCompany;

class TransCompany extends AbstractCompany
{

    public function calculatePrice(int $weight): int
    {
        if ($weight <= 10) {
            return 20;
        } else
            return 100;
    }
}