<?php

namespace Kasparsb\Auth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateUserCommand extends Command
{
    protected $signature = 'file-auth:create-user {email}';
    protected $description = 'Create user';

    public function handle()
    {
        $disk = Storage::disk(config('fileauth.disk'));

        $users = json_decode(
            $disk->get(config('fileauth.filename')),
            true
        );
        if (!is_array($users)) {
            $users = [];
        }

        $newUserEmail = $this->argument('email');

        if (isset($users[$newUserEmail])) {
            $this->error('User already exists');
            return;
        }

        $password = $this->ask('What will be user password');

        $users[$newUserEmail] = [
            'email' => $newUserEmail,
            'password' => $password,
            'caps' => [],
            'homeRoute' => '/',
        ];

        $disk->put(config('fileauth.filename'), json_encode($users));

        $this->info('User created');
    }
}
