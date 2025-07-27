<?php

namespace App\Repositories\Wagon;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Wagon;

interface EventRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel(): Wagon;
}
