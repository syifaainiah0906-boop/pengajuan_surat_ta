<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPenelitian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'nomor_surat',
        'tempat_penelitian',
        'alamat_tempat_penelitian',
        'tujuan_surat',
        'judul_ta',
        'pembimbing_ta',
        'no_hp_pembimbing',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
