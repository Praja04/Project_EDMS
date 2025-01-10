<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table = 'Dokumen';
    protected $primaryKey = 'dokumen_id';
    protected $allowedFields = [
        'user_id',
        'nama_dokumen',
        'nomor_dokumen',
        'status',
        'created_at',
        'file_path',
        'nama_penulis'
    ];

    public function getdokumenandpenomoran($dokumen_id)
    {
        return $this->select('Dokumen.*,Penomoran.*,Verifikasi.*')
            ->join('Penomoran', 'Penomoran.nomor_drawing = Dokumen.nomor_dokumen', 'left')
            ->join('Verifikasi', 'Verifikasi.dokumen_id = Dokumen.dokumen_id', 'left')
            ->where('Dokumen.dokumen_id', $dokumen_id)
            ->find();
    }
    public function getVerifiedDocuments()
    {
        // Mengambil dokumen yang status verifikasi sudah ditandai oleh admin
        return $this->select('Dokumen.*, Revisi.*, Verifikasi.status_verifikasi, Verifikasi.tanggal_verifikasi, Penomoran.*')
            ->join('Verifikasi', 'Verifikasi.dokumen_id = Dokumen.dokumen_id', 'inner')
            ->join('Revisi', 'Revisi.dokumen_id = Dokumen.dokumen_id', 'left')
            ->join('Penomoran', 'Penomoran.nomor_drawing = Dokumen.nomor_dokumen', 'left')
            ->where('Revisi.status_verifikasi_revisi', 'Verified')
            ->where('Verifikasi.status_verifikasi', 'Verified')
            ->findAll();
    }


    public function getDokumenBelumUploadWithPenomoran($userId)
    {
        return $this->select('Dokumen.*, Penomoran.*')
            ->join('Penomoran', 'Dokumen.nomor_dokumen = Penomoran.nomor_drawing', 'left')
            ->where([
                'Dokumen.status' => null,
                'Dokumen.user_id' => $userId
            ])
            ->findAll();
    }

    public function getUnverifiedDocuments()
    {
        //Mengambil dokumen berstatus masspro tapi belum ada di tabel Verifikasi
        return $this->select('Dokumen.*,Revisi.*,Verifikasi.verifikasi_id,Penomoran.*')
            ->where('Revisi.status_revisi', 'masspro')
            ->join('Verifikasi', 'Verifikasi.dokumen_id = Dokumen.dokumen_id', 'left')
            ->join('Revisi', 'Revisi.dokumen_id = Dokumen.dokumen_id', 'left')
            ->join('Penomoran', 'Penomoran.nomor_drawing = Dokumen.nomor_dokumen', 'left')
            ->where('Verifikasi.status_verifikasi', null) // Tidak ada entri di tabel Verifikasi
            ->findAll();
        
    }



    public function getDokumenWithDetails($user_id)
    {
        return $this->select('Dokumen.*,Revisi.*, Verifikasi.status_verifikasi, Verifikasi.tanggal_verifikasi, Verifikasi.keterangan_verifikasi, Penomoran.*, Pengajuan_Revisi.is_seen, Pengajuan_Revisi.pesan_pengajuan, Pengajuan_Revisi.pengajuan_id, Pengajuan_Revisi.nama_pengaju')
        ->join('Verifikasi', 'Verifikasi.dokumen_id = Dokumen.dokumen_id', 'left')
            ->join('Penomoran', 'Penomoran.nomor_drawing = Dokumen.nomor_dokumen', 'left')
            ->join('Pengajuan_Revisi', 'Pengajuan_Revisi.dokumen_id = Dokumen.dokumen_id AND Pengajuan_Revisi.is_seen = 0', 'left')
            ->join('Revisi', 'Revisi.dokumen_id = Dokumen.dokumen_id', 'left')
            ->where('Dokumen.status IS NOT NULL')
            ->where('Revisi.keterangan_revisi',0)
            ->where('Dokumen.user_id',$user_id)
            ->findAll();

        // return $this->select('Dokumen.*')
        // ->findAll();
    }
}
