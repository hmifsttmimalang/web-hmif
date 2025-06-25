<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRegistration extends Model
{
    use HasFactory;

    protected $table = 'member_registrations';
    protected $fillable = [
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'motivasi',
        'harapan',
        'bagi_waktu',
        'kontribusi',
        'minat',
        'minat_lainnya',
        'pengalaman_organisasi',
        'divisi',
        'link_portofolio',
        'file_portofolio',
        'skill',
        'ide',
        'solusi',
    ];

    protected $casts = [
        'minat' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
