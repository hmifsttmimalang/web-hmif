<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Google_Service_Drive_Permission;

class UploadToDriveDirect extends Command
{
    protected $signature = 'drive:upload {file}';
    protected $description = 'Upload file langsung ke Google Drive via Google API (manual test)';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("🚫 File tidak ditemukan: $filePath");
            return;
        }

        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $service = new Google_Service_Drive($client);

        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name' => basename($filePath),
        ]);

        if ($folderId = env('GOOGLE_DRIVE_FOLDER_ID')) {
            $fileMetadata->setParents([$folderId]);
        }

        $file = $service->files->create($fileMetadata, [
            'data' => file_get_contents($filePath),
            'mimeType' => mime_content_type($filePath),
            'uploadType' => 'multipart',
            'fields' => 'id, name, webViewLink, webContentLink',
        ]);

        $service->permissions->create($file->id, new Google_Service_Drive_Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]));

        $this->info("✅ File berhasil diupload ke Google Drive:");
        $this->line("🆔 ID: {$file->id}");
        $this->line("📎 Nama: {$file->name}");
        $this->line("🔗 View Link: https://drive.google.com/uc?export=view&id={$file->id}");
        $this->line("⬇️  Download: https://drive.google.com/uc?export=download&id={$file->id}");
    }
}
