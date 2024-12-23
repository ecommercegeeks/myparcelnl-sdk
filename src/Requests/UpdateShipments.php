<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use Psr\Http\Message\RequestInterface;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateShipments extends Request implements HasBody
{
    use HasJsonBody;
    protected Method $method = Method::PATCH;

    public function __construct(
        public array $ids,
        public array $options
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/shipments';
    }

    protected function defaultBody(): array
    {
        return ['data'=>
        ['shipments'=>array_map(function($id){
            return array_merge(['id'=>(int)$id], $this->options);
        }, $this->ids)]
        ];
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/vnd.shipment+json;charset=UTF-8;version=1.1',
        ];
    }
}