<?php

namespace App\Providers;

use App\Repositories\Wagon\EventRepository;
use App\Repositories\Wagon\EventRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $repos = [
            EventRepositoryInterface::class => EventRepository::class

        ];
        foreach ($repos as $index => $repo) {
            $this->app->bind($index, $repo);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
