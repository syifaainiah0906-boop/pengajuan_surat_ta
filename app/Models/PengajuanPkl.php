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
        'tempat_pkl',
        'alamat_tempat_pkl',
        'tujuan_surat',
        'pembimbing_pkl',
        'no_hp_pembimbing',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
