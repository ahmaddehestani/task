<?php

declare(strict_types=1);

namespace App\Services\AdvancedSearchFields\Drivers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class EventDriver extends BaseDriver
{
    public function handle(Builder $query, array $values): Builder
    {
        $query = $this->filter($query, $values);
                $extra_filters = collect($values)->whereNotIn('column', $this->fillable_columns);
                foreach ($extra_filters as $item) {
                    if ($item['column'] === 'user.name') {
                        $query->whereHas('user', function (Builder $q) use ($item) {
                            $this->addQuery($q, Arr::set($item, 'column', 'name'));
                        });
                        break;
                    }
                }
        return $query;
    }
}
