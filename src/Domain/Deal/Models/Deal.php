<?php

namespace Domain\Deal\Models;

use Domain\Deal\Enums\Stage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Casts\PriceCast;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'deal_id',
        'name',
        'closed',
        'close_date',
        'is_new',
        'opportunity',
        'stage',
    ];

    protected $casts = [
        'close_date' => 'datetime',
        'stage' => Stage::class,
        'opportunity' => PriceCast::class,
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'deal_id', 'deal_id');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, 'deal_id', 'deal_id');
    }
}
