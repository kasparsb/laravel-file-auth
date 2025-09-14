<?php

namespace Kasparsb\Auth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteUserCommand extends Command
{
    protected $signature = 'file-auth:delete-user {email}';
    protected $description = 'Delete user';

    public function handle()
    {
        $disk = Storage::disk(config('fileauth.disk'));

        $users = json_decode(
            $disk->get(config('fileauth.filename')),
            true
        );

        $newUserEmail = $this->argument('email');

        if (!isset($users[$newUserEmail])) {
            $this->error('User does not exist');
            return;
        }

        unset($users[$newUserEmail]);

        $users = array_values($users);

        $disk->put(config('fileauth.filename'), json_encode($users));

        $this->info('User deleted');
    }
}
