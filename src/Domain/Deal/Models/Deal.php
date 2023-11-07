<?php

namespace Domain\Deal\Models;

use Domain\Deal\Enums\Stage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Support\Casts\PriceCast;
use Support\ValueObjects\Price;

/**
 * @property int $deal_id
 * @property string $name
 * @property bool $closed
 * @property Stage $stage
 * @property Carbon $close_date
 * @property bool $is_new
 * @property Price $opportunity
 */
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

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->stage->humanValue()
        );
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'deal_id', 'deal_id');
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, 'deal_id', 'deal_id');
    }


}
