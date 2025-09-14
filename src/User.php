<?php

namespace Kasparsb\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable {

    public function __construct($data) {
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->caps = $data['caps'];
        $this->homeRoute = $data['homeRoute'];
    }

    public function getAuthIdentifierName() {
        return 'email';
    }
    public function getAuthIdentifier() {
        return $this->email;
    }
    public function getAuthPasswordName() {
        return 'password';
    }
    public function getAuthPassword() {
        return $this->password;
    }
    public function getRememberToken() {

    }
    public function setRememberToken($value) {

    }
    public function getRememberTokenName() {

    }
}