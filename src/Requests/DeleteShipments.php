<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use Saloon\Enums\Method;

class DeleteShipments extends MyparcelRequest
{
    protected Method $method = Method::DELETE;

    /**
     * @param int[] $ids
     */
    public function __construct(
        public array $ids
    )
    {
    }

    public function defaultHeaders(): array
    {
        return ['Content-Type' => 'application/json;charset=utf-8'];
    }

    public function resolveEndpoint(): string
    {
        return '/shipments/' . implode(';', $this->ids);
    }
}