<?php

namespace App\Repositories\Wagon;

use App\Enums\UserTypeEnum;
use App\Filters\FuzzyFilter;
use App\Models\Wagon;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    public function __construct(Wagon $model)
    {
        parent::__construct($model);
    }

   public function getModel(): Wagon
   {
       return parent::getModel();
   }
    public function query(array $payload = []): Builder|QueryBuilder
    {
        $user=auth()->user();
        if($user->type->value===UserTypeEnum::ADMIN->value){
            return QueryBuilder::for(Wagon::query())
                ->with([])
                ->defaultSort('-id')
                ->allowedFilters([
                    AllowedFilter::custom('search', new FuzzyFilter())->default(Arr::get($payload, 'search'))->nullable(false),
                AllowedFilter::custom('a_search', new AdvanceFilter)->default(Arr::get($payload, 'a_search', []))->nullable(false),
                ]);
        }
        return QueryBuilder::for(Wagon::query())
            ->with([])
            ->defaultSort('-id')
            ->where('user_id', $user->id)
            ->allowedFilters([
                AllowedFilter::custom('search', new FuzzyFilter())->default(Arr::get($payload, 'search'))->nullable(false),
                AllowedFilter::custom('a_search', new AdvanceFilter)->default(Arr::get($payload, 'a_search', []))->nullable(false),
            ]);
    }
}
