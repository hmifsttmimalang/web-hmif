<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DeleteOldBackups extends Command
{
    protected $signature = 'backup:cleanup';
    protected $description = 'Hapus file backup database yang lebih dari 7 hari';

    public function handle()
    {
        $backupPath = storage_path('app/backups');

        if (!File::exists($backupPath)) {
            $this->warn("Folder backup tidak ditemukan: $backupPath");
            return;
        }

        $files = File::files($backupPath);
        $now = Carbon::now();
        $deleted = 0;

        foreach ($files as $file) {
            $modified = Carbon::createFromTimestamp($file->getMTime());

            if ($modified->diffInDays($now) > 7) {
                File::delete($file->getRealPath());
                $deleted++;
                $this->info("Dihapus: " . $file->getFilename());
            }
        }

        if ($deleted === 0) {
            $this->info("Tidak ada file yang dihapus.");
        } else {
            $this->info("Selesai. $deleted file backup lama dihapus.");
        }
    }
}
