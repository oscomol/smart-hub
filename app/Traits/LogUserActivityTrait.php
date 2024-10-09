<?php

namespace App\Traits;

use App\Models\UserLog; 
use Illuminate\Support\Facades\Auth;

trait LogUserActivityTrait
{
    public function logActivity($activity)
    {
        UserLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->userType, 
            'activity' => $activity,
        ]);
    }
}
