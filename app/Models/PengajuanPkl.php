<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanPkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'nomor_surat',
        'nomor_handphone',
        'tempat_pkl',
        'tanggal_mulai',
        'tanggal_selesai',
        'alamat_tempat_pkl',
        'tujuan_surat',
        'pembimbing_pkl',
        'no_hp_pembimbing',
        'status',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Maksimal 5 kali pengajuan per mahasiswa
    public static function hasActive($userId)
    {
        return self::where('user_id', $userId)->count() >= 5;
    }
}