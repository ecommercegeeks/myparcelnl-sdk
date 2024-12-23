<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\FakerProviders;

use Faker\Provider\Base;

class ValidAddress extends Base
{
    protected array $addresses =
        ['NL' => [
            [
                'city' => 'Eindhoven',
                'street' => 'Fellenoord',
                'number' => '15',
                'postal_code' => '5612AA'
            ],
            [
                'city' => 'Amsterdam',
                'street' => 'Kingsfordweg',
                'number' => '1',
                'postal_code' => '1043GN'
            ]
        ]];
    public function validAddress(string $iso2CountryCode = 'NL') : object {
        return (object) $this->generator->randomElement($this->addresses[$iso2CountryCode]);
    }
}