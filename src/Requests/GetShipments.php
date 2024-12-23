<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use DateTime;
use EcommerceGeeks\MyparcelSdk\DTOs\Shipment;
use EcommerceGeeks\MyparcelSdk\Enums\ShipmentStatus;
use Saloon\Enums\Method;
use Saloon\Http\Response;

class GetShipments extends MyparcelRequest
{
    protected Method $method = Method::GET;

    public function __construct(
        protected array $ids = [],
        protected ?string $reference_identifier  = null,
        protected ?bool $dropoff_today = null,
        protected ?string $q = null,
        protected ?ShipmentStatus $status = null,
        protected ?DateTime $from = null,
        protected ?DateTime $to = null,
        protected ?string $sort = null,
        protected int $page = 1,
        protected int $size = 30,
    )
    {
    }

    /**
     * @return Shipment[]
     */
    public function createDtoFromResponse(Response $response): array
    {
        return array_map(fn($o) => Shipment::fromObject($o), $response->object()->data->shipments);
    }

    public function resolveEndpoint(): string
    {
        return '/shipments/' . implode(';', $this->ids);
    }
}