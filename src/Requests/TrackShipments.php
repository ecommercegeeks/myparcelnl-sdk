<?php

namespace EcommerceGeeks\MyparcelSdk\Requests;

use EcommerceGeeks\MyparcelSdk\DTOs\TrackTrace;
use EcommerceGeeks\MyparcelSdk\Enums\SortOrder;
use Saloon\Enums\Method;
use Saloon\Http\Response;

class TrackShipments extends MyparcelRequest
{
    protected Method $method = Method::GET;

    public function __construct(
        protected array $ids,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/tracktraces/' . implode(';', $this->ids);
    }

    /** @return TrackTrace[] */
    public function createDtoFromResponse(Response $response): array
    {
        $trackTraces = $response->json('data')['tracktraces'];
        return array_map(function(array $trackTraceData) {
            return TrackTrace::fromObject((object) $trackTraceData);
        }, $trackTraces);
    }
}
