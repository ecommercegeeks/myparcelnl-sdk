<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Factories;

use Faker\Factory as FakerFactory;
use Faker\Generator;

abstract class Factory
{
    protected string $instanceClass;

    private ?Generator $_faker = null;

    protected abstract function defaultAttributes() : array;
    public static function create(array $attributes = []) : mixed {
        $factory = new static();
        return new $factory->instanceClass(...array_merge($factory->defaultAttributes(), $attributes));
    }

    protected function faker() : Generator
    {
        if(!$this->_faker){
            $this->_faker = FakerFactory::create();
        }
        return $this->_faker;
    }
}
