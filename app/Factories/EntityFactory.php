<?php

namespace App\Factories;

use App\Factories\Exceptions\PropertyException;

class EntityFactory
{
    public function __construct(
        protected string $className
    ) {
    }

    public function create(object $properties): object
    {
        $reflactionClass = new \ReflectionClass('App\Entities\\'.$this->className);
        $instanceClass = $reflactionClass->newInstance();

        foreach ($properties as $property => $value) {
            if (!$reflactionClass->hasProperty($property)) {
                throw new PropertyException("The property {$property} does not exist in the class {$this->className}");
            }

            $reflactionProperty = $reflactionClass->getProperty($property);

            foreach ($reflactionProperty->getAttributes() as $attribute) {
                if ([] === $attribute->getArguments()) {
                    throw new PropertyException("The property {$property} does not have a validation value");
                }

                $validatedValue = $attribute->newInstance()->validate($property, $value);
                $reflactionProperty->setAccessible(true);
                $reflactionProperty->setValue($instanceClass, $validatedValue);
            }
        }

        return $instanceClass;
    }
}
