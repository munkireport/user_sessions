<?php
return [
	/*
	|===============================================
	| User Sessions Events
	|===============================================
	|
	| User Sessions will log all events. To skip some events, set
	| the events that you want to skip to be false. By default the
	| module also saves historical data. To disable this, set the 
	| user_sessions_keep_historical key to false. 
	|
	*/
	'user_sessions_save_remote_ssh' => env('USER_SESSIONS_SAVE_REMOTE_SSH', true),
	'user_sessions_save_login' => env('USER_SESSIONS_SAVE_LOGIN', true),
	'user_sessions_save_logout' => env('USER_SESSIONS_SAVE_LOGOUT', true),
	'user_sessions_save_reboot' => env('USER_SESSIONS_SAVE_REBOOT', true),
	'user_sessions_save_shutdown' => env('USER_SESSIONS_SAVE_SHUTDOWN', true),
	'user_sessions_keep_historical' => env('USER_SESSIONS_KEEP_HISTORICAL', true),
	'user_sessions_unique_users_only' => env('USER_SESSIONS_UNIQUE_USERS_ONLY', false),
];
