<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\Factories;

use EcommerceGeeks\MyparcelSdk\DTOs\Recipient;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\Factory;
use EcommerceGeeks\MyparcelSdk\Tests\FakerProviders\ValidAddress;

class RecipientFactory extends Factory
{
    protected string $instanceClass = Recipient::class;

    public function __construct()
    {
        $this->faker()->addProvider(new ValidAddress($this->faker()));
    }

    protected function defaultAttributes(): array
    {
        $address = $this->faker()->validAddress();

        return [
            'cc' => 'NL',
            'city' => $address->city,
            'street' => $address->street,
            'number' => $address->number,
            'postal_code' => $address->postal_code,
            'person' => $_ENV['NAME_PREFIX'] . $this->faker()->name()
        ];
    }
}