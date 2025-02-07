<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\Factories;

use EcommerceGeeks\MyparcelSdk\DTOs\Recipient;

/**
 * @implements Factory<Recipient>
 */
class RecipientFactory extends Factory
{
    protected string $instanceClass = Recipient::class;

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