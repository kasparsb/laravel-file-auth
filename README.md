# Authenticate users from text file
Users are stored in json text file in app storage directory. No need for database and DB table. You control your users but do not polute database with users table

Users are identified by email not ID

Users file can be easily shared between servers

## Configuration

File auth package publishes configuration file **config/fileauth.php**

In your **.env** config edit these parameters

**FILEAUTH_DISK** - disk name where users file will be stored. Defaults to local

**FILEAUTH_USERS_FILENAME** - users file name. Defaults to fileauth-users.json

**FILEAUTH_PUBLISH_ROUTES** - publish login/logout routes. Defaults to yes. You can disable this to load your own login/logout routes

**FILE_AUTH_LOGIN_VIEW_NAME** - name of the view for login page. Override it to use your own login page view

## Setup

Publish configuration file
```bash
php artisan vendor:publish --provider="Kasparsb\Auth\AuthServiceProvider" --force
```

Add **File auth** provider to boostrap/providers file

```php
[
    Kasparsb\Auth\AuthServiceProvider::class,
]
```

Configure auth to use File auth as users provider
File *config/auth.php*

```php
'providers' => [
    'users' => [
        'driver' => 'fileauth', // This is driver for users from file
    ],
]
```

Configure your protected routes to use Laravel default **auth** middleware
```php
Route::group([
    'middleware' => 'auth',
], function(){
    Route::get('protected-area', ...)
});
```

## Login routes

Package defines named routes like this
- login /auth/login
- logout /auth/logout

## CLI commands

List users
```bash
php artisan fileauth:list-users
```

Create user
```bash
php artisan fileauth:create-users {email}
```

Delete user
```bash
php artisan fileauth:delete-users {email}
```