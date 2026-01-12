<?php
namespace EcommerceGeeks\MyparcelSdk\Tests\Feature;

use EcommerceGeeks\MyparcelSdk\DTOs\SecondaryShipment;
use EcommerceGeeks\MyparcelSdk\DTOs\ShipmentIdentifier;
use EcommerceGeeks\MyparcelSdk\DTOs\TrackTrace;
use EcommerceGeeks\MyparcelSdk\Requests\AddShipments;
use EcommerceGeeks\MyparcelSdk\Requests\TrackShipments;
use EcommerceGeeks\MyparcelSdk\Requests\UpdateShipments;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\RecipientFactory;
use EcommerceGeeks\MyparcelSdk\Tests\Factories\ShipmentFactory;
use EcommerceGeeks\MyparcelSdk\Requests\GetShipmentLabels;

describe('Shipments', function () {
    test('shipment is created', function () {
        $extraAttributes = [
            'secondary_shipments' => [new SecondaryShipment],
        ];

        $shipmentData = ShipmentFactory::create($extraAttributes);
        $request = new AddShipments([$shipmentData]);

        /** @var ShipmentIdentifier[] $shipments */
        $shipments = $this->send($request)->dtoOrFail();

        expect($shipments)->toBeArray()->toHaveCount(1)
            ->and($shipments[0])->toBeInstanceOf(ShipmentIdentifier::class);

        $this->setShipmentId($shipments[0]->id);
    });
    test('shipment can be retrieved', function () {
        // TODO: implement test
    });
    test('shipment label is retrieved', function(){
        $request = new GetShipmentLabels([$this->getShipmentId()]);
        $response = $this->send($request);
        expect($response->status())->toBe(200)
            ->and($response->headers()->get('Content-Type'))->toBe('application/pdf');
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
            ->and($trackTrace)->toBeInstanceOf(TrackTrace::class)
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

    test('shipment with street_additional_info is created and printed on label', function () {
        $recipient = RecipientFactory::create([
            'street_additional_info' => 'Apartment 4B Floor 2',
        ]);

        $shipmentData = ShipmentFactory::create([
            'recipient' => $recipient,
            'reference_identifier' => 'STREET_ADD_INFO_TEST_' . time(),
        ]);

        // Verify the DTO includes street_additional_info
        $array = $shipmentData->toArray();
        expect($array['recipient']['street_additional_info'])->toBe('Apartment 4B Floor 2');

        // Create the shipment via API
        $request = new AddShipments([$shipmentData]);

        /** @var ShipmentIdentifier[] $shipments */
        $shipments = $this->send($request)->dtoOrFail();

        expect($shipments)->toBeArray()->toHaveCount(1)
            ->and($shipments[0])->toBeInstanceOf(ShipmentIdentifier::class)
            ->and($shipments[0]->id)->toBeInt();

        // Retrieve the label to verify it was created successfully
        $labelRequest = new GetShipmentLabels([$shipments[0]->id]);
        $labelResponse = $this->send($labelRequest);

        expect($labelResponse->status())->toBe(200)
            ->and($labelResponse->header('Content-Type'))->toBe('application/pdf');

        // Save label for manual inspection (check that street_additional_info appears on it)
        $labelPath = 'label_with_street_additional_info.pdf';
        file_put_contents($labelPath, $labelResponse->body());
        echo "\n\n=== Label saved to: {$labelPath} ===\n";
        echo "Please open this PDF and verify 'Apartment 4B Floor 2' appears on the label.\n";
        echo "Shipment ID: {$shipments[0]->id} - Remember to delete from MyParcel backend!\n\n";

        // Clean up - hide the shipment
        $hideRequest = new UpdateShipments([$shipments[0]->id], ['hidden' => 1]);
        $this->send($hideRequest);
    })->skip('Requires manual inspection of PDF label');
});

