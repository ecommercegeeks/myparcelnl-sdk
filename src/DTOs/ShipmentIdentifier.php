<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Contracts\CastsFromObject;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class ShipmentIdentifier implements Arrayable, CastsFromObject
{
    use AttributesToArray;

    public function __construct(
        public int $id,
        public ?string $reference_identifier = null,
    )
    {
    }

    public static function fromObject(object $object) : self
    {
        return new self(
            $object->id,
            $object->reference_identifier ?? null,
        );
    }
}