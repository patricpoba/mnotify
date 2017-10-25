<?php

return [

	'sms_api_key'	=>	env('MNOTIFY_SMS_API_KEY', 'xxxxxxxxxxxxxxxx'),
	// up to 11 characters only
	'sender_id'	=>	env('MNOTIFY_SENDER_ID', env('APP_NAME'))
];
