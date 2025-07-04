<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\UploadUserPhotoToDrive;

class DispatchPhotoUploadJobs extends Command
{
    protected $signature = 'drive:dispatch-user-photo-jobs';
    protected $description = 'Dispatch job upload foto user ke Google Drive';

    public function handle()
    {
        $users = User::whereNotNull('foto')->get();

        foreach ($users as $user) {
            UploadUserPhotoToDrive::dispatch($user);
            $this->info("Dispatched upload job for: {$user->nama}");
        }

        $this->info("Selesai dispatch semua job upload.");
    }
}
