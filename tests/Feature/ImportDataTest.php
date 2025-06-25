<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnggotaImport;
use App\Models\User;

it('can import anggota from excel', function () {
    Excel::fake();

    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    $file = UploadedFile::fake()->create('anggota.xlsx');

    $response = $this->post(route('admin.anggota.import'), [
        'file' => $file,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    Excel::assertImported('anggota.xlsx', function (AnggotaImport $import) {
        return true;
    });
});
