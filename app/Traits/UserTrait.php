<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    public static function getUserId(): string
    {
        $userId = Auth::id();

        return $userId;
    }
}