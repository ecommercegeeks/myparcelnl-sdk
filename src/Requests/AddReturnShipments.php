<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use EcommerceGeeks\MyparcelSdk\DTOs\Shipment;
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

    public function createDtoFromResponse(Response $response): array
    {
        return $response->json('data')['ids'] ?? [];
    }
}
