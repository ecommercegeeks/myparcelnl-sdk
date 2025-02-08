<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Feature;
use EcommerceGeeks\MyparcelSdk\Requests\GetLocations;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\RecipientFactory;

describe('GetLocations', function () {
    test("Get valid location", function () {
        $recipient = RecipientFactory::create();

        $request = new GetLocations(
            postal_code: $recipient->postal_code,
            number: $recipient->number,
        );

        $response = $this->send($request);

        $locations = $response->dtoOrFail();

        expect($locations)->toHaveCount(1)
            ->and($locations[0])->toHaveKeys(['street', 'city']);
    });
    test("It doesn't return invalid location", function () {
        $recipient = RecipientFactory::create();

        $request = new GetLocations(
            postal_code: $recipient->postal_code,
            number: 9999999,
        );

        $response = $this->send($request);

        $locations = $response->dtoOrFail();

        expect($locations)->toHaveCount(0);
    });
});