<?php

declare(strict_types=1);

namespace App\Services\AdvancedSearchFields\Handlers;

use App\Enums\CargoWagonCountryTypeEnum;
use App\Enums\CargoWagonTypeEnum;
use App\Enums\TableUserFieldAdminConfirmedEnum;
use App\Enums\WagonOwnershipEnum;

class EventHandler extends BaseHandler
{
    public function handle(): array
    {

        return [
            $this->add("user.name", trans('general.advance_search.user_name'), self::INPUT),

        ];
    }
}
