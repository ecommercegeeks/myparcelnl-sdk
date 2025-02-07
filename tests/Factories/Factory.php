<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Factories;

use EcommerceGeeks\MyparcelSdk\Tests\FakerProviders\ValidAddress;
use EcommerceGeeks\MyparcelSdk\Tests\FakerProviders\ValidPickupLocation;
use Faker\Factory as FakerFactory;
use Faker\Generator;

/**
 * @template TModel
 */
abstract class Factory
{
    protected string $instanceClass;

    private ?Generator $_faker = null;

    protected abstract function defaultAttributes() : array;

    /**
     * @return TModel
     */
    public static function create(array $attributes = []) : mixed {
        $factory = new static();
        return new $factory->instanceClass(...array_merge($factory->defaultAttributes(), $attributes));
    }

    protected function faker() : Generator
    {
        if(!$this->_faker){
            $this->_faker = FakerFactory::create();
            $this->_faker->addProvider(new ValidAddress($this->_faker));
            $this->_faker->addProvider(new ValidPickupLocation($this->_faker));
        }
        return $this->_faker;
    }
}
