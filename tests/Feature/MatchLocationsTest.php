<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Feature;

use EcommerceGeeks\MyparcelSdk\Requests\MatchLocations;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\RecipientFactory;

describe('MatchLocations', function () {
    test("Strictly matches an address", function () {
        $recipient = RecipientFactory::create([
            'cc'=>'BE',
            'city' => 'Brussel',
            'street' => 'Sint-Lazarusplein',
            'postal_code' => '1210',
            'number' => '2',
        ]);
        $request = new MatchLocations($recipient, true);
        $response = $this->send($request);
        expect($response->json('data.locations'))->toHaveCount(1)
            ->and($response->json('data.locations.0.match'))->toBe('complete');
    });
});