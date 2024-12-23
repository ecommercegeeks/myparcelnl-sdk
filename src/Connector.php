<?php
namespace EcommerceGeeks\MyparcelSdk;

use Saloon\Http\Connector as SaloonConnector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class Connector extends SaloonConnector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    public function __construct(
        protected string $apiKey
    )
    {}



    public function resolveBaseUrl(): string
    {
        return 'https://api.myparcel.nl';
    }

    protected function defaultHeaders(): array
    {
        return [
            'User-Agent' => 'EcommerceGeeks SDK PHP',
            'Authorization' => 'bearer ' . base64_encode($this->apiKey),
        ];
    }
}