<?php

namespace App\Entities;

use App\Validation\GreaterThan;
use App\Validation\LessThan;

class Payment
{
    #[GreaterThan(0), LessThan(13)]
    protected int $installments;

    #[GreaterThan(0)]
    protected float $amount;
}
