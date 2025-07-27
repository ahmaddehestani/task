<?php

namespace App\Actions\Airport;

use App\Models\Airport;
use App\Repositories\Airport\AirportRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteEventAction
{
    use AsAction;

    public function __construct(public readonly AirportRepositoryInterface $repository)
    {
    }

    public function handle(Airport $airport): bool
    {
        return DB::transaction(function () use ($airport) {
            // todo check don't use in other table
            $airport->translations()->delete();
            cache::forget('airports');
            return $this->repository->delete($airport);
        });
    }
}
