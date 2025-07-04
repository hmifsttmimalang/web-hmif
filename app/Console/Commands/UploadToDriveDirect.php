<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

class UploadToDriveDirect extends Command
{
    protected $signature = 'drive:upload {file}';
    protected $description = 'Upload file langsung ke Google Drive pakai Google_Client';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: $filePath");
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

        $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
        if ($folderId) {
            $fileMetadata->setParents([$folderId]);
        }

        $content = file_get_contents($filePath);

        $file = $service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($filePath),
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink, webContentLink'
        ]);

        $this->info("File berhasil diupload ke Google Drive!");
        $this->line("ID: " . $file->id);
        $this->line("Link view: " . $file->webViewLink);
        $this->line("Link download: " . $file->webContentLink);
    }
}
