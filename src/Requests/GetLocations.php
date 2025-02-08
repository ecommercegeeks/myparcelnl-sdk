<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Response;

class GetLocations extends MyparcelRequest
{
    protected Method $method = Method::GET;

    /**
     * Currently only NL is supported
     */
    public function __construct(
        public string $postal_code,
        public string $number,
        public string $cc = 'NL'
    )
    {
    }

    public function defaultHeaders(): array
    {
        return ['Content-Type' => 'application/json;charset=utf-8'];
    }

    public function resolveEndpoint(): string
    {
        return '/locations' ;
    }

    protected function defaultQuery(): array
    {
        return [
            'cc' => $this->cc,
            'postal_code' => $this->postal_code,
            'number' => $this->number,
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        return $response->json('data')['locations'];
    }
}