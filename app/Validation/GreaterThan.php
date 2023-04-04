<?php

namespace App\Validation;

use App\Validation\Exceptions\AttributeException;
use App\Validation\Interfaces\Validation;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class GreaterThan implements Validation
{
    public function __construct(
        protected float $min
    ) {
    }

    public function validate(string $propertyName, mixed $value): mixed
    {
        if ($value <= $this->min) {
            throw new AttributeException("The property {$propertyName} must be greater than {$this->min}");
        }

        return $value;
    }
}
