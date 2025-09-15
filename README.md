# Authenticate users from text file
Users are store in json text file in app storage directory

configuration
FILEAUTH_DISK - disk name where users file will be stored. Defaults to local
FILEAUTH_USERS_FILENAME - users file name. Defaults to fileauth-users.json

# Setup
Add provider to boostrap/providers file

```php
[
    Kasparsb\Auth\AuthServiceProvider::class,
]
```

Configure auth to user fileauth as users provider
File config/auth.php

```php
'providers' => [
    'users' => [
        'driver' => 'fileauth', // This is driver for users from file
    ],
]
```

Configure routes to use Laravel default auth middleware
```php

Route::group([
    'middleware' => 'auth',
], function(){
    Route::get('protected-area', ...)
});
```

# Login routes
Package defines named login/logout routes
- login /auth/login
- logout /auth/logout