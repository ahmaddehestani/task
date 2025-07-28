<?php

namespace App\Actions\Event;


use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteEventAction
{
    use AsAction;

    public function __construct(private readonly EventRepositoryInterface $repository,)
    {
    }

    public function handle(Event $event): bool
    {
        return DB::transaction(function () use ($event) {
            // todo check don't use in other table

            cache::forget('events');
            return $this->repository->delete($event);
        });
    }
}
