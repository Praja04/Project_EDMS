<?php

namespace App\Models;

use CodeIgniter\Model;

class RevisiModel extends Model
{
    protected $table = 'Revisi';
    protected $primaryKey = 'revisi_id';
    protected $allowedFields = [
        'dokumen_id',
        'tanggal_revisi',
        'keterangan_revisi',
        'file_revisi',
        'status_revisi',
        'status_verifikasi_revisi'
    ];


    public function showDistinct()
    {
        $this->select('Revisi.*, Dokumen.*, Penomoran.*, Pengajuan_Revisi.is_seen, Pengajuan_Revisi.pesan_pengajuan, Pengajuan_Revisi.pengajuan_id, Pengajuan_Revisi.nama_pengaju')
            ->join('Dokumen', 'Dokumen.dokumen_id = Revisi.dokumen_id', 'left')
            ->join('Penomoran', 'Penomoran.nomor_drawing = Dokumen.nomor_dokumen', 'left')
            ->join('Pengajuan_Revisi', 'Pengajuan_Revisi.dokumen_id = Dokumen.dokumen_id AND Pengajuan_Revisi.is_seen = 0', 'left') // Tambahkan kondisi pada join
            ->distinct()
            ->where('keterangan_revisi', 0)
            ->where('file_revisi IS NOT NULL', null, false) // Raw SQL untuk null check
            ->orderBy('tanggal_revisi', 'DESC');

        // Ambil semua data
        return $this->findAll();
    }


    public function showDistinctLogbookDetail($id_dokumen)
    {
        $this->select('Revisi.*, Dokumen.*, Penomoran.*')
            ->join('Dokumen', 'Dokumen.dokumen_id = Revisi.dokumen_id', 'left')
            ->join('Penomoran', 'Penomoran.nomor_drawing = Dokumen.nomor_dokumen', 'left')
            ->distinct()
            ->where('Revisi.dokumen_id', $id_dokumen)
            ->where('file_revisi IS NOT NULL', null, false) // Raw SQL untuk null check
            ->orderBy('keterangan_revisi', 'ASC');

        // Ambil semua data
        return $this->findAll();
    }

    public function getRevisiByDokumenId($dokumen_id)
    {
        // Mengambil semua data revisi berdasarkan dokumen_id
        return $this->where('dokumen_id', $dokumen_id)->findAll();
    }

    public function getUnverifiedDocuments()
    {
        // Mengambil dokumen berstatus masspro tapi belum ada di tabel Verifikasi
        return $this->select('Revisi.*,Penomoran.*,Verifikasi.verifikasi_id')
            ->where('Revisi.status', 'masspro')
            ->join('Verifikasi', 'Verifikasi.dokumen_id = Revisi.dokumen_id', 'left')
            ->join('Penomoran', 'Penomoran.nomor_drawing = Revisi.nomor_dokumen', 'left')
            ->where('Verifikasi.status_verifikasi', null) // Tidak ada entri di tabel Verifikasi
            ->findAll();
    }
}
