<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Contracts\CastsFromObject;
use EcommerceGeeks\MyparcelSdk\Enums\Carrier;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class TrackTrace implements Arrayable, CastsFromObject
{
    use AttributesToArray;

    public function __construct(
        public int $shipment_id,
        public string $code,
        public string $description,
        public string $time,
        public string $link_tracktrace,
    )
    {
    }

    public static function fromObject(object $object) : self
    {
        return new self(
            shipment_id: $object->shipment_id,
            code: $object->code,
            description: $object->description,
            time: $object->time,
            link_tracktrace: $object->link_tracktrace,
        );
    }
}