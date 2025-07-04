<?php

namespace App\Jobs;

use App\Mail\BackupSuccessMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Client as GoogleClient;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BackupDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
            Log::error('❌ Gagal backup database.');
            return;
        }

        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $service = new Drive($client);
        $fileMetadata = new DriveFile(['name' => $filename]);

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
        Mail::to('hmifsttmimalang@gmail.com')->send(new BackupSuccessMail($url));
        unlink($localPath);
    }
}
