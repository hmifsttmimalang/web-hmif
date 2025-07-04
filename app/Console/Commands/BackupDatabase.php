<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\BackupDatabaseJob;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Backup DB, upload ke Google Drive, hapus file lokal';

    public function handle()
    {
        BackupDatabaseJob::dispatch()->onQueue('backup');
        $this->info('Job backup database telah dikirim ke queue `backup`!');
    }
}
