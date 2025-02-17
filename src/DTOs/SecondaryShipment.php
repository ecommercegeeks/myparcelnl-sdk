<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

class SecondaryShipment
{
    public function __construct(
        public ?string $reference_identifier = null,
        public ?int $id = null,
    )
    {
    }

    public function serialize(): object
    {
        return (object) array_filter(get_object_vars($this), fn($value) => $value !== null);
    }
}