<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class PickupLocation implements Arrayable
{
    use AttributesToArray;

    public function __construct(
        public ?string $postal_code = null,
        public ?string $street = null,
        public ?string $city = null,
        public ?string $number = null,
        public ?string $location_name = null,
        public ?string $location_code = null,
        public ?string $retail_network_id = null,
    ){}
}