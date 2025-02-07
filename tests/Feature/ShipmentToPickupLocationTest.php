<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Feature;

use EcommerceGeeks\MyparcelSdk\DTOs\PickupLocation;
use EcommerceGeeks\MyparcelSdk\Enums\DeliveryType;
use EcommerceGeeks\MyparcelSdk\Requests\AddShipments;
use EcommerceGeeks\MyparcelSdk\Requests\DeleteShipments;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\PickupLocationFactory;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\ShipmentFactory;

describe('Shipments', function () {
    test("Delete any shipment", function () {
        $request = new DeleteShipments([203183234324957999]);
        $response = $this->send($request);
        expect($response->status())->toBe(204);
    });
    test('pickup point selection by location code', function () {
        $shipment = ShipmentFactory::create();
        $shipment->options->delivery_type = DeliveryType::Pickup;
        $locationCode = PickupLocationFactory::create()->location_code;
        $shipment->pickup = new PickupLocation(location_code: $locationCode);
        $ids = $this->send(new AddShipments([$shipment]))->dtoOrFail();
        $request = new DeleteShipments(array_column($ids, 'id'));
        $response = $this->send($request);
        expect($response->status())->toBe(204);
    });
    test('recipient address equals pickup location address', function(){
        $shipment = ShipmentFactory::create();
        $shipment->options->delivery_type = DeliveryType::Pickup;
        $pickup = PickupLocationFactory::create(['location_code'=>null]);
        $shipment->pickup = $pickup;
        $pickup->postal_code = '5652AE';
        $shipment->recipient->number = $pickup->number;
        $shipment->recipient->street = $pickup->street;
        $shipment->recipient->city = $pickup->city;
        $shipment->recipient->postal_code = $pickup->postal_code;
        $ids = $this->send(new AddShipments([$shipment]))->dtoOrFail();
        $response = $this->send(new DeleteShipments(array_column($ids, 'id')));
        expect($response->status())->toBe(204);
    });
});