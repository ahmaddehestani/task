<?php

namespace App\Actions\Event;


use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Support\Arr;
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
            $userAgent = request()->header('User-Agent');
            $ipAddress = request()->ip();
            $platform = $this->detectPlatform($userAgent);
            $model = $this->repository->create([
                'user_id'=>auth()->user()->id,
                'event_name'=>Arr::get($payload,'payload'),
                'payload'=>Arr::get($payload,'payload',[]),
                'ip_address'=>$ipAddress,
                'user_agent'=>$userAgent,
                'platform'=>$platform,
            ]);
            cache::forget('events');
            return $model->fresh();
        });
    }
    private function detectPlatform($userAgent): string
    {
        if (str_contains($userAgent, 'Android')) {
            return 'android';
        } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
            return 'ios';
        } elseif (str_contains($userAgent, 'Windows')) {
            return 'windows';
        } elseif (str_contains($userAgent, 'Macintosh')) {
            return 'mac';
        } else {
            return 'web';
        }
    }
}
