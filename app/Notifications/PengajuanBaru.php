<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PengajuanBaru extends Notification implements ShouldBroadcast
{
    use Queueable;

    protected $nama;
    protected $jenis;

    // 🔥 TERIMA DATA DARI CONTROLLER
    public function __construct($nama, $jenis)
    {
        $this->nama = $nama;
        $this->jenis = $jenis;
    }

    // 🔔 CHANNEL
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    // 💾 SIMPAN KE DATABASE
    public function toArray($notifiable)
    {
        return [
            'judul' => 'Pengajuan ' . $this->jenis,
            'pesan' => $this->nama . ' mengajukan ' . $this->jenis,
            'url'   => '/admin/verifikasi' // opsional redirect
        ];
    }

    // ⚡ REALTIME
    public function toBroadcast($notifiable)
    {
        return [
            'judul' => 'Pengajuan ' . $this->jenis,
            'pesan' => $this->nama . ' mengajukan ' . $this->jenis,
            'url'   => '/admin/verifikasi'
        ];
    }
}