<?php

declare(strict_types=1);

namespace App\Services\AdvancedSearchFields\Handlers;

use App\Enums\TableUserFieldAdminConfirmedEnum;
use App\Enums\UserTypeEnum;

class UserHandler extends BaseHandler
{
    public function handle(): array
    {
        return [
            $this->add('name', trans('advance_search.user.name'), self::NUMBER),
            $this->add('family', trans('advance_search.user.family'), self::INPUT),
            $this->add('mobile', trans('advance_search.user.mobile'), self::INPUT),
            $this->add('email', trans('advance_search.user.email'), self::INPUT),
            $this->add('created_at', trans('advance_search.user.created_at'), self::DATE),



        ];
    }
}
