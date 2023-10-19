<?php

namespace Support\Client\DTOs;

use Illuminate\Support\Fluent;

/**
 * @property int $id
 * @property string $event_name
 * @property int $data_id
 */
class EventDTO extends Fluent
{
    public static function fromArray(array $fields): self
    {
        $self = new self();

        $self->id = $fields['ID'];
        $self->event_name = $fields['EVENT_NAME'];
        $self->data_id = $fields['EVENT_DATA']['FIELDS']['ID'];

        return $self;
    }
}
