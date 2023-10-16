<?php

namespace App\DTO;

class ValueDTO extends DTO
{
    private float $value;

    public function __construct(float $value){
        $this->setValue($value ?? 0);
    }

    public function setValue(float $value){
        $this->value = $value;
    }

    public function getValue():float{
        return $this->value;
    }

}