<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\Factories;

use EcommerceGeeks\MyparcelSdk\DTOs\Shipment;
use EcommerceGeeks\MyparcelSdk\Enums\Carrier;

class ShipmentFactory extends Factory
{
    protected string $instanceClass = Shipment::class;
    protected function defaultAttributes(): array
    {
        return [
            'reference_identifier' => $this->faker()->regexify('[A-Z0-9]{10}'),
            'recipient' => RecipientFactory::create(),
            'options' => OptionsFactory::create(),
            'carrier' => Carrier::PostNL
        ];
    }
}