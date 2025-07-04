<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DeleteOldBackups extends Command
{
    protected $signature = 'backup:cleanup';
    protected $description = 'Hapus file backup database yang berumur lebih dari 7 hari';

    public function handle()
    {
        $path = storage_path('app/backups');

        if (!File::exists($path)) {
            $this->warn("⚠️ Folder backup tidak ditemukan: $path");
            return;
        }

        $now = now();
        $deletedCount = 0;

        foreach (File::files($path) as $file) {
            $ageInDays = Carbon::createFromTimestamp($file->getMTime())->diffInDays($now);

            if ($ageInDays > 7) {
                File::delete($file->getRealPath());
                $this->info("🗑️ Dihapus: {$file->getFilename()} ($ageInDays hari)");
                $deletedCount++;
            }
        }

        $this->info(
            $deletedCount > 0
                ? "✅ $deletedCount file backup lama berhasil dihapus."
                : "✅ Tidak ada file yang perlu dihapus."
        );
    }
}
