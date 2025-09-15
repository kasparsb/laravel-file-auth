<?php

namespace Kasparsb\Auth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ListUsersCommand extends Command
{
    protected $signature = 'fileauth:list-users';
    protected $description = 'List all users';

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

        dump($users);
    }
}
