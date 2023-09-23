<?php

namespace Support\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class EmptyResource extends JsonResource
{
    public function toArray(Request $request): Response
    {
        return response()->json(['data' => null]);
    }
}
