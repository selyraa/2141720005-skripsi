<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ConsultationScheduleStatusCast implements CastsAttributes
{
    protected $statuses = [
        0 => 'Pending',
        1 => 'Completed',
        2 => 'Cancelled',
    ];

    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return isset($this->statuses[$value]) ? $this->statuses[$value] : null;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        return isset($value) ? array_search($value, $this->statuses) : null;
    }
}
