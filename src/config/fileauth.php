<?php

return [
    'disk' => env('FILEAUTH_DISK', 'local'),
    'filename' => env('FILEAUTH_USERS_FILENAME', 'fileauth-users.json'),
    'publish_routes' => filter_var(env('FILEAUTH_PUBLISH_ROUTES', 'true'), FILTER_VALIDATE_BOOLEAN),
];