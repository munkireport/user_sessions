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
	$conf['user_sessions_save_remote_ssh'] = TRUE,
	$conf['user_sessions_save_login'] = TRUE,
	$conf['user_sessions_save_logout'] = TRUE,
	$conf['user_sessions_save_reboot'] = TRUE,
	$conf['user_sessions_save_shutdown'] = TRUE,
	$conf['user_sessions_keep_historical'] = TRUE,
	$conf['user_sessions_unique_users_only'] = FALSE,
];
