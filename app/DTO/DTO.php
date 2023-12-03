<?php

namespace App\DTO;


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

    protected function extractValuesByKeys($array_values, $desiredKeys){
        return array_combine(
            $desiredKeys,
            array_map(function ($key) use ($array_values) {
                return $array_values[$key];
            }, $desiredKeys)
        );
    }

    protected function renameKeysArray($array, $map_keys){
        return array_combine(
            array_map(function ($key) use ($map_keys) {
                return isset($map_keys[$key]) ? $map_keys[$key] : $key;
            }, array_keys($array)),
            $array
        );
    }
}