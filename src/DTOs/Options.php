<?php
namespace EcommerceGeeks\MyparcelSdk\DTOs;
use EcommerceGeeks\MyparcelSdk\Contracts\Arrayable;
use EcommerceGeeks\MyparcelSdk\Enums\PackageType;
use EcommerceGeeks\MyparcelSdk\Traits\AttributesToArray;

class Options implements Arrayable
{
    use AttributesToArray;
    protected bool $convertBoolToInt = true;

    public function __construct(
        public ?PackageType $package_type = null,
        public ?bool $only_recipient = null,
        public ?bool $signature = null,
        public ?bool $return = null,
        public ?bool $large_format = null,
        public ?string $label_description = null,
        public ?bool $age_check = null
    )
    {
    }
}