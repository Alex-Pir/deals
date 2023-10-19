<?php

namespace Support\Client\CRM;

use Illuminate\Http\Client\Response;
use Support\Client\BaseClient;
use Support\Client\DTOs\DealDTO;

class DealsClient extends BaseClient
{
    /**
     * @param array $filter
     * @return DealDTO[]
     */
    public static function list(array $filter): array
    {
        $response = static::call('crm.deal.list', [
            'filter' => $filter
        ])->json();

        if (!$response['result']) {
            return [];
        }

        return array_map(fn (array $deal) => DealDTO::fromArray($deal), $response['result']);
    }
}
