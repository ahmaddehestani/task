<?php

namespace App\Actions\Event;


use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreEventAction
{
    use AsAction;

    public function __construct(private readonly EventRepositoryInterface $repository)
    {
    }

    public function handle(array $payload): Event
    {
        return DB::transaction(function () use ($payload) {

            $model = $this->repository->create($payload);
            cache::forget('events');
            return $model->fresh();
        });
    }
}
