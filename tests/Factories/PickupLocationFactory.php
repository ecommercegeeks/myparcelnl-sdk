<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\Factories;

use EcommerceGeeks\MyparcelSdk\DTOs\PickupLocation;

/**
 * @implements Factory<PickupLocation>
 */
class PickupLocationFactory extends Factory
{
    protected string $instanceClass = PickupLocation::class;
    protected function defaultAttributes(): array
    {
        return (array) $this->faker()->validPickupLocation();
    }
}