<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use EcommerceGeeks\MyparcelSdk\Enums\Format;
use EcommerceGeeks\MyparcelSdk\Enums\LabelPosition;
use Saloon\Enums\Method;
use Saloon\Http\Response;

class GetShipmentLabels extends MyparcelRequest
{
    protected Method $method = Method::GET;

    public function __construct(
        protected array $ids,
        protected ?Format $format = Format::A6,
        protected ?LabelPosition $positions = LabelPosition::TopLeft,
        protected bool $asLink = false
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/shipment_labels/' . implode(';', $this->ids);
    }

    public function defaultQuery(): array
    {
        return [
            'format' => $this->format?->value,
            'positions' => $this->positions?->value,
        ];
    }

    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/vnd.shipment+json;charset=UTF-8;version=1.1',
            'Accept' => 'application/pdf'
        ];
    }

    public function createDtoFromResponse(Response $response): string
    {
        return $response->body();
    }
}
