User Sessions module
==============

Gathers logins, logout, shut downs, and reboots on the client computer

Configuration
-------

User Sessions module will by default log all events. To skip some events, set the events that you want to skip to be false. By default the module also saves historical data. To disable this, set the `user_sessions_keep_historical` key to false. The configuration can be set by adding them to the server environment variables or the `.env` file.

```
'user_sessions_save_remote_ssh' => env('USER_SESSIONS_SAVE_REMOTE_SSH', true),
'user_sessions_save_login' => env('USER_SESSIONS_SAVE_LOGIN', true),
'user_sessions_save_logout' => env('USER_SESSIONS_SAVE_LOGOUT', true),
'user_sessions_save_reboot' => env('USER_SESSIONS_SAVE_REBOOT', true),
'user_sessions_save_shutdown' => env('USER_SESSIONS_SAVE_SHUTDOWN', true),
'user_sessions_keep_historical' => env('USER_SESSIONS_KEEP_HISTORICAL', true),
'user_sessions_unique_users_only' => env('USER_SESSIONS_UNIQUE_USERS_ONLY', false),
```


Table Schema
-------

Database:
* event - varchar(255) - event type 
* time - int - UNIX time of event occurrence
* user - varchar(255) - user name associated with event
* ssh_remove - varchar(255) - IP address of the remote SSH user

Module by @tuxudo, script by @clburlison and @pudquick (frogor)
