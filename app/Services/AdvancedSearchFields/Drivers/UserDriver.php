<?php

declare(strict_types=1);

namespace App\Services\AdvancedSearchFields\Drivers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class UserDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        $query = $this->filter($query, $values);
        return $query;
    }
}
