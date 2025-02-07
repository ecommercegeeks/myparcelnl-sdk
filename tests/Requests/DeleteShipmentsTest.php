<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Requests;

use EcommerceGeeks\MyparcelSdk\Requests\DeleteShipments;

describe('DeleteShipments request', function () {

    test('endpoint is correctly resolved', function () {
        $request = new DeleteShipments([1, 2, 3]);
        expect($request->resolveEndpoint())->toBe('/shipments/1;2;3');
    });
});