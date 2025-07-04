<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\UploadUserPhotoToDrive;

class DispatchUploadUserPhotosCommand extends Command
{
    protected $signature = 'drive:dispatch-upload-user-photos';
    protected $description = 'Dispatch job UploadUserPhotoToDrive untuk setiap user yang memiliki foto';

    public function handle()
    {
        $users = User::whereNotNull('foto')->get();

        foreach ($users as $user) {
            UploadUserPhotoToDrive::dispatch($user)->onQueue('foto');
            $this->info("Job dispatch untuk {$user->nama} ({$user->nim})");
        }

        $this->info('✅ Semua job upload foto telah didispatch ke queue `foto`.');
    }
}
