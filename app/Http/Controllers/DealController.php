<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealCreateRequest;
use App\Http\Requests\DealDeleteRequest;
use App\Http\Requests\DealPatchRequest;
use Domain\Deal\Actions\DealCreateAction;
use Support\Client\BaseClient;
use Support\Resources\EmptyResource;

class DealController extends Controller
{
    public function create(): void
    {
        //$action->execute($request->validated()['FIELDS']['ID']);

       file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logRequestAll.txt', print_r(request()->all(), true) . "\n", FILE_APPEND);
        BaseClient::getById(8);
    }

    public function patch(): void
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logDealId.txt', print_r(request()->all(), true) . "\n", FILE_APPEND);

    }

    public function delete(): void
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logDealIdDelete.txt', print_r(request()->all(), true) . "\n", FILE_APPEND);
    }
}
