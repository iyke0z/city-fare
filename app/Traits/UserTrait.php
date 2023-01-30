<?php

namespace App\Traits;

use App\Models\Log;

/**
 *
 */
trait UserTrait{
    public static function log_action($type, $user, $action, $actionby){
        $log = new Log();
        $log->type = $type;
        $log->user_id = $user;
        $log->action = $action;
        $log->acted_by = $actionby;
        $log->save();
    }
}


