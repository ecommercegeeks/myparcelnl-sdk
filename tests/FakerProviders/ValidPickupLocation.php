<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\FakerProviders;

use Faker\Provider\Base;

class ValidPickupLocation extends Base
{
    protected array $addresses =
        ['NL' => [
            [
                'postal_code' => '5642JA',
                'street' => 'Kanaaldijk-Noord',
                'city' => 'Eindhoven',
                'number' => '111',
                'location_name' => 'De Kadepost',
                'location_code' => '176517'
            ],
            [
                'postal_code' => '1012RR',
                'street' => 'Nieuwezijds Voorburgwal',
                'city' => 'Amterdam',
                'number' => '226',
                'location_name' => 'Albert Heijn',
                'location_code' => '257948'
            ],
        ]];
    public function validPickupLocation(string $iso2CountryCode = 'NL') : object {
        return (object) $this->generator->randomElement($this->addresses[$iso2CountryCode]);
    }
}