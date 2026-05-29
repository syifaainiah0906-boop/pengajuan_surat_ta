<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPenelitian extends Model
{
    use HasFactory;

    // TAMBAHAN: Konstanta status (opsional, biar tidak typo)
    const STATUS_PENDING = 'pending';
    const STATUS_DISETUJUI = 'disetujui';
    const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'nomor_surat',
        'nomor_handphone',
        'tempat_penelitian',
        'alamat_tempat_penelitian',
        'tujuan_surat',
        'judul_ta',
        'pembimbing_ta',
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

    // TAMBAHAN: Helper cek pengajuan aktif
    public static function hasActive($userId)
{
   return self::where('user_id', $userId)->count() >= 5;
}
}