<?php

namespace Support\Client\DTOs;

use Domain\Deal\Enums\Stage;
use Illuminate\Support\Fluent;

/**
 * @property int $deal_id
 * @property string $name
 * @property bool $closed
 * @property bool $close_date
 * @property bool $is_new
 * @property float $opportunity
 * @property Stage $stage
 */
class DealDTO extends Fluent
{
    public static function fromArray(array $deals): self
    {
        $self = new self();

        $self->deal_id = $deals['ID'];
        $self->name = $deals['TITLE'];
        $self->closed = $deals['CLOSED'] === 'Y';
        $self->close_date = $deals['CLOSEDATE'];
        $self->is_new = $deals['IS_NEW'] === 'Y';
        $self->opportunity = $deals['OPPORTUNITY'];
        $self->stage = Stage::from($deals['STAGE_ID']);

        return $self;
    }
}
