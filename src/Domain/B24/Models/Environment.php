<?php

namespace Domain\B24\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    use HasFactory;

    protected $fillable = [
        'expires_in',
        'application_token',
        'refresh_token',
        'domain',
        'client_endpoint',
    ];
}
