<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanRevisiModel extends Model
{
    protected $table = 'Pengajuan_Revisi';
    protected $primaryKey = 'pengajuan_id';
    protected $allowedFields = ['dokumen_id', 'user_id', 'pesan_pengajuan','is_seen','nama_pengaju'];
}
