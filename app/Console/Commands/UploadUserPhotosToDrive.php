<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Storage;

class UploadUserPhotosToDrive extends Command
{
    protected $signature = 'drive:upload-user-photos';
    protected $description = 'Upload semua foto user ke Google Drive dan simpan link-nya ke database';

    public function handle()
    {
        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $drive = new GoogleDrive($client);
        $folderId = env('GOOGLE_DRIVE_FOLDER_ID');

        $users = User::whereNotNull('foto')->get();

        foreach ($users as $user) {
            $localPath = storage_path('app/public/' . $user->foto);

            if (!file_exists($localPath)) {
                $this->warn("Foto tidak ditemukan: {$user->foto}");
                continue;
            }

            $fileMetadata = new DriveFile([
                'name' => basename($localPath),
            ]);

            if ($folderId) {
                $fileMetadata->setParents([$folderId]);
            }

            $file = $drive->files->create($fileMetadata, [
                'data' => file_get_contents($localPath),
                'mimeType' => mime_content_type($localPath),
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]);

            // Generate public link
            $drive->permissions->create($file->id, new \Google\Service\Drive\Permission([
                'type' => 'anyone',
                'role' => 'reader',
            ]));

            $publicUrl = "https://drive.google.com/uc?export=view&id={$file->id}";

            $user->foto_url = $publicUrl;
            $user->save();

            $this->info("Uploaded {$user->foto} → {$publicUrl}");
        }

        $this->info('Selesai upload semua foto!');
    }
}
