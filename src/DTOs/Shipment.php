<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Contracts\CastsFromObject;
use EcommerceGeeks\MyparcelSdk\Enums\Carrier;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class Shipment implements Arrayable, CastsFromObject
{
    use AttributesToArray;

    public function __construct(
        public Recipient $recipient,
        public Options $options,
        public ?Carrier $carrier,
        public ?string $reference_identifier = null,
        public ?int $id = null,
        public ?int $parent_id = null,
        public ?int $account_id = null,
        public ?int $shop_id = null,
        public ?int $shipment_type = null,
    )
    {
    }

    public static function fromObject(object $object) : self
    {
        return new self(
            Recipient::fromObject($object->recipient),
            new Options(),
            Carrier::from($object->carrier_id),
            $object->reference_identifier,
            $object->id,
            $object->parent_id,
            $object->account_id,
            $object->shop_id,
            $object->shipment_type,
        );
    }

}