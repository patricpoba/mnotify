<?php

namespace PatricPoba\Mnotify\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    protected static function getFacadeAccessor()
    {
    	// resolved from the service container
    	// it was put there by from ../MnotifyServiceProvider.php@register
        return 'mNotifySms';
    }
}
