<?php

namespace EcommerceGeeks\MyparcelSdk\Traits;

use BackedEnum;
use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;

trait AttributesToArray
{
    protected array $ignoredProperties = [
        'convertBoolToInt',
        'dateFormat',
        'ignoredProperties'
    ];
    public function toArray() : array
    {
        $vars = get_object_vars($this);
        foreach ($this->ignoredProperties as $prop) {
            if(isset($vars[$prop])){
                unset($vars[$prop]);
            }
        }

        return $this->convertArray($vars);
    }

    /**
     * - Removes null values
     * - Calls toArray on Arrayable instance
     */
    protected function convertArray(array $input) : array
    {
        $vars = array_filter($input, fn($val) => $val !== null);
        return array_map(function($val){
            if(is_array($val)){
                return $this->convertArray($val);
            }
            if($val instanceof Arrayable){
                return $val->toArray();
            }
            if($val instanceof BackedEnum){
                return $val->value;
            }
            if($val instanceof \DateTime){
                return $this->dateTimeToString($val);
            }
            if(is_bool($val)){
                return $this->convertBool($val);
            }
            return $val;
        }, $vars);
    }

    protected function convertBool(bool $val) : bool | int
    {
        return property_exists($this, 'convertBoolToInt') && $this->convertBoolToInt ?
            (int) $val : $val;
    }

    protected function dateTimeToString(\DateTime $date) : string
    {
        $format = property_exists($this, 'dateFormat') ? $this->dateFormat : 'Y-m-d';
        return $date->format($format);
    }
}
