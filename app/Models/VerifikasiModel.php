<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifikasiModel extends Model
{
    protected $table = 'Verifikasi';
    protected $primaryKey = 'verifikasi_id';
    protected $allowedFields = [
        'dokumen_id',
        'status_verifikasi',
        'tanggal_verifikasi',
        'keterangan_verifikasi'
    ];

    public function getUnverifiedDocuments()
    {
        // Mengambil dokumen berstatus masspro tapi belum ada di tabel Verifikasi
        return $this->select('Dokumen.*')
            ->where('Dokumen.status', 'masspro')
            ->join('Verifikasi', 'Verifikasi.dokumen_id = Dokumen.dokumen_id', 'left')
            ->where('Verifikasi.dokumen_id', null) // Tidak ada entri di tabel Verifikasi
            ->findAll();
    }

}
