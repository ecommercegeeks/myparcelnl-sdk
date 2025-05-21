<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Feature;

use EcommerceGeeks\MyparcelSdk\Requests\AddShipments;
use EcommerceGeeks\MyparcelSdk\Requests\AddReturnShipments;
use EcommerceGeeks\MyparcelSdk\Requests\UpdateShipments;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\ShipmentFactory;

describe('Return Shipments', function () {
    test('unrelated return shipment is created using constructor', function () {
        // Create a return shipment without specifying a parent shipment
        $shipment = $this->send(new AddReturnShipments([ShipmentFactory::create()]))->dtoOrFail()[0];

        expect($shipment['id'])->toBeInt();

        // Note: We can't clean up return shipments because they don't have real shipment IDs
        dump('Remove shipment with ID ' . $shipment['id']);
    });
});
