<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Feature;

use EcommerceGeeks\MyparcelSdk\DTOs\SecondaryShipment;
use EcommerceGeeks\MyparcelSdk\DTOs\TrackTrace;
use EcommerceGeeks\MyparcelSdk\Requests\AddShipments;
use EcommerceGeeks\MyparcelSdk\Requests\TrackShipments;
use EcommerceGeeks\MyparcelSdk\Requests\UpdateShipments;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\ShipmentFactory;
use EcommerceGeeks\MyparcelSdk\Requests\GetShipmentLabels;

describe('Shipments', function () {
    test('shipment is created', function () {
        $extraAttributes = [
            'secondary_shipments' => [new SecondaryShipment],
        ];

        $shipmentData = ShipmentFactory::create($extraAttributes);
        $request = new AddShipments([$shipmentData]);

        $shipment = $this->send($request)->dtoOrFail()[0];

        $this->setShipmentId($shipment['id']);
        expect($shipment['id'])->toBeInt();
    });
    test('shipment can be retrieved', function () {
        // TODO: implement test
    });
    test('shipment label is retrieved', function(){
        $request = new GetShipmentLabels([$this->getShipmentId()]);
        $response = $this->send($request);
        expect($response->status())->toBe(200);
        expect($response->headers()->get('Content-Type'))->toBe('application/pdf');
        file_put_contents('label.pdf', $response->body());
        expect(mime_content_type('label.pdf'))->toBe('application/pdf');
        unlink('label.pdf');
    });
    test('shipment can be tracked', function () {
        $request = new TrackShipments([$this->getShipmentId()]);
        $response = $this->send($request);

        /** @var TrackTrace $trackTrace */
        $trackTrace = $response->dtoOrFail()[0];

        expect($response->status())->toBe(200)
            ->and($trackTrace->shipment_id)->toBe($this->getShipmentId())
            ->and($trackTrace->code)->not->toBeNull()
            ->and($trackTrace->description)->not->toBeNull()
            ->and($trackTrace->time)->not->toBeNull()
            ->and($trackTrace->link_tracktrace)->not->toBeNull();
    });
    test('shipment can be updated', function(){
        $request = new UpdateShipments([$this->getShipmentId()],['hidden'=>1]);
        $response = $this->send($request);
        expect($response->status())->toBe(204);
    });

    test('multiple shipment labels can be retrieved', function () {
        // Create two shipments
        $shipments = $this->send(new AddShipments([ShipmentFactory::create(), ShipmentFactory::create()]))->dtoOrFail();
        $shipmentIds = array_column($shipments, 'id');

        // Test basic label retrieval
        $request = new GetShipmentLabels($shipmentIds);
        $response = $this->send($request);
        expect($response->status())->toBe(200)
            ->and($response->body())->toBeString()
            ->and(strlen($response->body()))->toBeGreaterThan(0)
            ->and($response->header('Content-Type'))->toBe('application/pdf');

        // Clean up - hide the shipments
        $request = new UpdateShipments($shipmentIds, ['hidden' => 1]);
        $this->send($request);
    });
});

