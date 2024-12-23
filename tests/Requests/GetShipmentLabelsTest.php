<?php

namespace EcommerceGeeks\MyparcelSdk\Tests\Requests;

use EcommerceGeeks\MyparcelSdk\Enums\Format;
use EcommerceGeeks\MyparcelSdk\Enums\LabelPosition;
use EcommerceGeeks\MyparcelSdk\Requests\GetShipmentLabels;

describe('GetShipmentLabels request', function () {
    
    test('endpoint is correctly resolved', function () {
        $request = new GetShipmentLabels([1, 2, 3]);
        expect($request->resolveEndpoint())->toBe('/shipment_labels/1;2;3');
    });

    test('default headers are set correctly', function () {
        $request = new GetShipmentLabels([1]);
        $headers = $request->defaultHeaders();

        expect($headers)->toHaveKey('Content-Type')
            ->and($headers['Content-Type'])->toBe('application/vnd.shipment+json;charset=UTF-8;version=1.1')
            ->and($headers)->toHaveKey('Accept')
            ->and($headers['Accept'])->toBe('application/pdf');
    });

    test('HTTP method is GET', function () {
        $request = new GetShipmentLabels([1]);
        expect($request->getMethod()->value)->toBe('GET');
    });

    test('query parameters are correctly set', function () {
        $request = new GetShipmentLabels([1, 2], Format::A4, LabelPosition::BottomRight);
        expect($request->query()->all())->toBe([
            'format' => Format::A4->value,
            'positions' => LabelPosition::BottomRight->value,
        ]);
    });
});
