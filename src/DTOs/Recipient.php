<?php

namespace EcommerceGeeks\MyparcelSdk\DTOs;

use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Contracts\CastsFromObject;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class Recipient implements Arrayable, CastsFromObject
{
    use AttributesToArray;

    /**
     * @param string $cc iso2 country code
     */
    public function __construct(
        public string $cc,
        public string $city,
        public string $street,
        public string $number,
        public string $postal_code,
        public ?string $person = null,
        public ?string $region = null,
        public ?string $phone = null,
        public ?string $email = null,
        public ?string $company = null,
        public ?string $number_suffix = null,
    )
    {
    }

    public static function fromObject(object $object): self
    {
        return new self(
            $object->cc,
            $object->city,
            $object->street,
            $object->number,
            $object->postal_code,
            $object->person,
            $object->region ?? null,
            $object->phone ?? null,
            $object->email ?? null,
            $object->company ?? null,
            $object->number_suffix ?? null,
        );
    }
}