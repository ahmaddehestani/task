<?php

namespace App\Repositories\Event;


use App\Models\Event;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Event
   {
       return parent::getModel();
   }
    public function query(array $payload = []): Builder|QueryBuilder
    {
        return QueryBuilder::for(Event::query())
            ->with(['user'])
            ->defaultSort('-id')
            ->allowedFilters([
                AllowedFilter::custom('a_search', new AdvanceFilter)->default(Arr::get($payload, 'a_search', []))->nullable(false),
            ]);
    }
}
