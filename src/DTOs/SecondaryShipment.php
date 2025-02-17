<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class SecondaryShipment implements Arrayable
{
    use AttributesToArray;

    public function __construct(
        public ?string $reference_identifier = null,
        public ?int $id = null,
    )
    {
    }
}