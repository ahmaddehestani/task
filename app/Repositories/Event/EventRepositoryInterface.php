<?php

namespace App\Repositories\Event;

use App\Models\Event;
use App\Repositories\BaseRepositoryInterface;

interface EventRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Event;
}
