<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Requests;

use EcommerceGeeks\MyparcelSdk\Requests\GetShipments;


describe('GetShipments request', function () {

    test('ids are included in uri', function () {
        $request = new GetShipments([1, 2]);
        expect($request->resolveEndpoint())->toEndWith('1;2');
    });

    test('ids are not mandatory', function(){
        $request = new GetShipments();
        expect($request->resolveEndpoint())->toBe('/shipments/');
    });

    test('retrieves shipments', function(){
        $request = new GetShipments();
        $response = $this->connect()->send($request);
        $shipments = $response->dtoOrFail();
        expect($shipments)->toBeArray();
    });
});
