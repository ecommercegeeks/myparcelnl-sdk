<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Requests;

use EcommerceGeeks\MyparcelSdk\Requests\TrackShipments;

describe('TrackShipments request', function () {
    test('ids are included in uri', function () {
        $request = new TrackShipments([1, 2]);
        expect($request->resolveEndpoint())->toEndWith('1;2');
    });
});
