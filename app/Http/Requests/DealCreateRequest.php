<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'FIELDS' => ['array', 'required'],
            'FIELDS.ID' => ['integer', 'required'],
        ];
    }
}
