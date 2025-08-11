<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use EcommerceGeeks\MyparcelSdk\DTOs\Shipment;
use EcommerceGeeks\MyparcelSdk\DTOs\ShipmentIdentifier;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Contracts\Body\HasBody;

/**
 * Creates the unrelated return shipment.
 *
 * @implements HasBody
 */
class AddReturnShipments extends MyparcelRequest implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param Shipment[] $shipments
     */
    public function __construct(
        public array $shipments,
    ) {}

    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/vnd.unrelated_return_shipment+json;version=1.1',
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/shipments';
    }

    protected function defaultBody(): array
    {
        return [
            'data' => [
                'return_shipments' => array_map(
                    fn(Shipment $shipment) => $shipment->toArray(),
                    $this->shipments
                )
            ]
        ];
    }

    /** @return ShipmentIdentifier[] */
    public function createDtoFromResponse(Response $response): array
    {
        $shipments = $response->json('data')['ids'] ?? [];
        return array_map(function(array $shipment) {
            return ShipmentIdentifier::fromObject((object) $shipment);
        }, $shipments);
    }
}
