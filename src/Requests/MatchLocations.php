<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use EcommerceGeeks\MyparcelSdk\DTOs\Recipient;
use Saloon\Enums\Method;

class MatchLocations extends MyparcelRequest
{
    protected Method $method = Method::GET;

    public function __construct(
        public Recipient $recipient,
        public bool $strict = true,
    )
    {
    }

    public function defaultHeaders(): array
    {
        return ['Content-Type' => 'application/json;charset=utf-8'];
    }

    public function resolveEndpoint(): string
    {
        return '/locations/match' ;
    }

    protected function defaultQuery(): array
    {
        return [
            'strict' => $this->strict ? 'true' : 'false',
            'cc' => $this->recipient->cc,
            'city' => $this->recipient->city,
            'postal_code' => $this->recipient->postal_code,
            'street' => $this->recipient->street,
            'number' => $this->recipient->number,
        ];
    }
}