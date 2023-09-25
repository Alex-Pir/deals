<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealCreateRequest;
use Domain\Deal\Actions\CreateDealAction;

class DealController extends Controller
{
    public function create(DealCreateRequest $request, CreateDealAction $action): void
    {
        $action->execute($request->validated()['FIELDS']['ID']);
    }

    public function patch(): void
    {

    }

    public function delete(): void
    {

    }
}
