<?php

namespace Domain\B24\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id,
 * @property int $expires_in,
 * @property string $application_token,
 * @property string $refresh_token,
 * @property string $domain,
 * @property string $client_endpoint,
 */
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
