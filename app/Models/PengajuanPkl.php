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
        'alamat_tempat_pkl',
        'tujuan_surat',
        'pembimbing_pkl',
        'no_hp_pembimbing',
        'status',
    ];
    protected $casts = [
    'tanggal_pengajuan' => 'datetime',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function hasActive($userId)
{
    $latest = self::where('user_id', $userId)
        ->latest()
        ->first();

    if (!$latest) {
        return false; // ⬅️ INI PENTING
    }

    return in_array($latest->status, ['pending', 'disetujui']);
}
}
