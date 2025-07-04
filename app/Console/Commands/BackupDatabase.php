<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Backup DB, upload ke Google Drive, hapus file lokal';

    public function handle()
    {
        $filename = 'backup-' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $localPath = storage_path('app/backups/' . $filename);

        if (!file_exists(dirname($localPath))) {
            mkdir(dirname($localPath), 0755, true);
        }

        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_HOST'),
            env('DB_DATABASE'),
            $localPath
        );

        exec($command, $output, $result);

        if ($result !== 0 || !file_exists($localPath)) {
            $this->error('Gagal backup DB.');
            return;
        }

        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $service = new GoogleDrive($client);

        $fileMetadata = new DriveFile([
            'name' => $filename,
        ]);

        if ($folderId = env('GOOGLE_DRIVE_BACKUP_FOLDER_ID')) {
            $fileMetadata->setParents([$folderId]);
        }

        $file = $service->files->create($fileMetadata, [
            'data' => file_get_contents($localPath),
            'mimeType' => 'application/sql',
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);

        $service->permissions->create($file->id, new Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]));

        $url = "https://drive.google.com/uc?export=view&id={$file->id}";

        $this->info("✅ Backup berhasil dan diupload ke Drive:");
        $this->line($url);

        unlink($localPath);
        $this->warn("🧹 File lokal dihapus: $filename");
    }
}
