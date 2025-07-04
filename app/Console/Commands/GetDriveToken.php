<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google_Client;

class GetDriveToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:drive-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengambil Refresh token Google Drive';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->setRedirectUri('urn:ietf:wg:oauth:2.0:oob');
        $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $authUrl = $client->createAuthUrl();
        $this->info("Buka URL ini di browser:");
        $this->line($authUrl);

        $code = $this->ask('Masukkan code dari Google');
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        if (isset($accessToken['refresh_token'])) {
            $this->info('Refresh Token:');
            $this->line($accessToken['refresh_token']);
        } else {
            $this->error('Refresh token tidak ditemukan.');
            $this->warn('Kemungkinan karena auth code sudah pernah dipakai atau token hanya diberikan sekali.');
        }
    }
}
