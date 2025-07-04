<?php

namespace App\Jobs;

use App\Models\User;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadUserPhotoToDrive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        if (!$this->user->foto) return;

        $localPath = storage_path('app/public/' . $this->user->foto);
        if (!file_exists($localPath)) return;

        $client = new GoogleClient();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));

        $drive = new GoogleDrive($client);

        $fileMetadata = new DriveFile([
            'name' => basename($localPath),
        ]);

        if ($folderId = env('GOOGLE_DRIVE_FOLDER_ID')) {
            $fileMetadata->setParents([$folderId]);
        }

        $file = $drive->files->create($fileMetadata, [
            'data' => file_get_contents($localPath),
            'mimeType' => mime_content_type($localPath),
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);

        $drive->permissions->create($file->id, new Permission([
            'type' => 'anyone',
            'role' => 'reader',
        ]));

        $url = "https://drive.google.com/uc?export=view&id={$file->id}";
        $this->user->foto_url = $url;
        $this->user->save();
    }
}
