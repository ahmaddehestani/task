<?php

namespace App\Actions\Event;


use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateEventAction
{
    use AsAction;

    public function __construct(private readonly EventRepositoryInterface $repository)
    {
    }


    /**
     * @param Event $model
     * @param array{event_name:string,payload:array} $payload
     * @return Event
     */
    public function handle(Event $model, array $payload): Event
    {
        return DB::transaction(function () use ($model, $payload) {
            $model = $this->repository->update($model, $payload);
            cache::forget('events');
            return $model->fresh();
        });
    }
}
