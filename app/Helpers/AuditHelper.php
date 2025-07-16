<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditHelper
{
    public static function log($action, $module, $description = null)
    {
        AuditLog::create([
            'user_id'    => Auth::id(),
            'action'     => $action,
            'module'     => $module,
            'description'=> $description,
        ]);
    }
}