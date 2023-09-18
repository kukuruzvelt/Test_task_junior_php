<?php

namespace App\Abstract;

abstract class AbstractCompany
{
    abstract public function calculatePrice(int $weight);
}