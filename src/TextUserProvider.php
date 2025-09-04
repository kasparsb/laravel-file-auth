<?php

namespace Kasparsb\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class TextUserProvider implements UserProvider {

    /**
        'user@example.com' => [
            'email' => 'user@example.com',
            'password' => '',
            'caps' =>
                [], no caps
                '*', all caps
                ['invoices', 'sales',] selected caps
            'homeRoute' => '/', where user will be redirected after login
        ]

     */

    private $users = null;

    public function loadUsersFromFile() {
        if (is_null($this->users)) {
            $this->users = json_decode(
                Storage::disk(config('fileauth.disk'))
                    ->get(config('fileauth.filename')),
                true
            );

            if (!is_array($this->users)) {
                $this->users = [];
            }
        }

        return $this->users;
    }

    public function retrieveById($identifier) {
        $users = $this->loadUsersFromFile();

        return array_key_exists($identifier, $users) ? new User($users[$identifier]) : null;
    }

    public function retrieveByCredentials(array $credentials) {
        $users = $this->loadUsersFromFile();

        return array_key_exists($credentials['email'], $users) ? new User($users[$credentials['email']]) : null;
    }

    public function retrieveByToken($identifier, $token) {

    }

    public function updateRememberToken(Authenticatable $user, $token) {

    }

    public function validateCredentials(Authenticatable $user, array $credentials) {
        return $user->getAuthPassword() == $credentials['password'];
    }

    public function rehashPasswordIfRequired(Authenticatable $user, #[\SensitiveParameter] array $credentials, bool $force = false) {
    }
}
