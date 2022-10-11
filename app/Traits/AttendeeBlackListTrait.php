<?php

namespace App\Traits;

use App\Models\Blacklist;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Orchid\Support\Facades\Toast;

/**
 * Trait AttendeeBlackListTrait
 * @package App\Traits
 */
trait AttendeeBlackListTrait
{
    /**
     * @param int $blacklistId
     */
    public function removeBlacklist(Blacklist $blacklist)
    {
        $blacklist->delete();

        Toast::info(__('Client removed from blacklist.'));
    }
}
