<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\Factories;

use EcommerceGeeks\MyparcelSdk\DTOs\Options;
use EcommerceGeeks\MyparcelSdk\Enums\PackageType;

class OptionsFactory extends Factory
{
    protected string $instanceClass = Options::class;
    protected function defaultAttributes(): array
    {
        return [
            "package_type"=> PackageType::Package,
            "only_recipient"=> $this->faker()->boolean(),
            "signature"=> $this->faker()->boolean(),
            "return"=> 0,
            "large_format"=> $this->faker()->boolean(),
            "label_description"=> $this->faker()->sentence(3),
            "age_check"=> $this->faker()->boolean()
        ];
    }
}