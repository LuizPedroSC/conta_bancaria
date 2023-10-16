<?php

namespace App\DTO;
// use Spatie\LaravelData\Data;

abstract class DTO
{
    public function toArray(array $atributos = []): array
    {
        if(count($atributos)){
            $array = [];
            foreach ($atributos as $atributo) {
                if (property_exists($this, $atributo)) {
                    $array[$atributo] = $this->$atributo;
                }
            }
            return $array;
        }
        return get_object_vars($this);
    }

    public function convertInteger($value){
        return intval($value);
    }
}