<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Contracts\CastsFromObject;
use EcommerceGeeks\MyparcelSdk\Enums\Carrier;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class Shipment implements Arrayable, CastsFromObject
{
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
        public ?PickupLocation $pickup = null,
        /** @var SecondaryShipment[]|null */
        public ?array $secondary_shipments = null,
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

    public function toArray(): array
    {
        $array = [
            'recipient' => $this->recipient->toArray(),
            'options' => $this->options->toArray(),
            'carrier' => $this->carrier?->value,
            'reference_identifier' => $this->reference_identifier,
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'account_id' => $this->account_id,
            'shop_id' => $this->shop_id,
            'shipment_type' => $this->shipment_type,
            'pickup' => $this->pickup?->toArray(),
            'secondary_shipments' => $this->secondary_shipments ? array_map(fn($shipment) => $shipment->serialize(), $this->secondary_shipments) : null,
        ];

        return array_filter($array, fn($value) => $value !== null);
    }
}