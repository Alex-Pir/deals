<?php

namespace Domain\Deal\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [

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
