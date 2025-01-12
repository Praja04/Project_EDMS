<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DokumenModel;
use App\Models\RevisiModel;
use App\Models\PenomoranModel;
use App\Models\VerifikasiModel;
use App\Models\PengajuanRevisiModel;

class AdminController extends BaseController
{
    protected $dokumenModel;
    protected $revisiModel;
    protected $penomoranModel;
    protected $VerifikasiModel;
    protected $pengajuanModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
        $this->revisiModel = new RevisiModel();
        $this->penomoranModel = new PenomoranModel();
        $this->VerifikasiModel = new VerifikasiModel();
        $this->pengajuanModel = new PengajuanRevisiModel();
    }

    public function unverified()
    {
        $allowed_roles = ['admin','kasi'];
        $user_role = session()->get('role');
        
        if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }

        $data = [
            'data' => $this->dokumenModel->getUnverifiedDocuments(),

        ];
        //return $this->response->setJSON($data);
        return view('verifikasi/unverified', $data);
    }

    public function gethistoryRevisi($id_dokumen)
    {
        $allowed_roles = ['admin', 'kasi'];
        $user_role = session()->get('role');

        if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }
        // Mendapatkan data dokumen berdasarkan dokumen_id
        $dokumenData = $this->dokumenModel->find($id_dokumen);
        $data = [
            'data' => $this->revisiModel->getRevisiByDokumenId($id_dokumen),
            'dokumen' => $dokumenData
        ];
        //return $this->response->setJSON($data);
        return view('verifikasi/historyRevisi', $data);
    }

    public function accVerifikasi($id_revisi)
    {
        $data = [
            'status_verifikasi' => 'Verified',
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'keterangan_verifikasi' => 'Terverifikasi'
        ];
        $revisi = $this->revisiModel->where('revisi_id', $id_revisi)->first();
        $dokumen_id = $revisi['dokumen_id'];
        $verifikasi = $this->VerifikasiModel->where('dokumen_id', $dokumen_id)->first();
        $verifikasi_id = $verifikasi['verifikasi_id'];
        $result = $this->VerifikasiModel->update($verifikasi_id, $data);
        if ($revisi) {

            $data_revisi = [
                'status_revisi' => 'masspro',
                'status_verifikasi_revisi' => 'Verified'
            ];
            $this->revisiModel->update($id_revisi, $data_revisi);
        }
        // Buat respons JSON
        $response = array();
        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Verifikasi berhasil.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Gagal verifikasi.';
        }

        // Kembalikan respons sebagai JSON
        return $this->response->setJSON($response);
    }

    public function notaccVerifikasi()
    {
        $id_revisi = $this->request->getPost('revisi_id');
        $id_verifikasi = $this->request->getPost('verifikasi_id');

        $data = [
            'status_verifikasi' => 'Not Verified',
            'tanggal_verifikasi' => date('Y-m-d H:i:s'),
            'keterangan_verifikasi' => $this->request->getPost('feedback')
        ];

        $dokumen = [
            'status' => 'Not Verified',
        ];
        $revisi = $this->revisiModel->where('revisi_id', $id_revisi)->first();
        $dokumen_id = $revisi['dokumen_id'];
        $result = $this->VerifikasiModel->update($id_verifikasi, $data);

        $result2 = $this->dokumenModel->update($dokumen_id, $dokumen);
        $revisi = $this->VerifikasiModel->where('verifikasi_id', $id_verifikasi)->first();
        if ($revisi) {

            $data_revisi = [
                'status_revisi' => '-',
                'status_verifikasi_revisi' => 'ditolak'
            ];
            $this->revisiModel->update($id_revisi, $data_revisi);
        }
        // Buat respons JSON
        $response = array();
        if ($result && $result2) {
            $response['success'] = true;
            $response['message'] = 'Verifikasi ditolak.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Gagal verifikasi.';
        }
        // Kembalikan respons sebagai JSON
        return $this->response->setJSON($response);
    }


    public function logbook()
    {
        $allowed_roles = ['admin', 'kasi'];
        $user_role = session()->get('role');

        if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }
        $GetPdf = $this->revisiModel->showDistinct();
        $dataPdf['data'] = $GetPdf;
        //return $this->response->setJSON($dataPdf);
        return view('logbook/logbook', $dataPdf);
    }

    public function logbook_detail($id)
    {
        $allowed_roles = ['admin', 'kasi'];
        $user_role = session()->get('role');

        if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }
        $data['data'] = $this->revisiModel->showDistinctLogbookDetail($id);
        return view('logbook/logbook_detail', $data);
        //return $this->response->setJSON($data);
    }

    public function delete_dokumen($id_dokumen)
    {
        // Ambil data dokumen berdasarkan dokumen_id
        $dokumen = $this->dokumenModel->where('dokumen_id', $id_dokumen)->first();
        if (!$dokumen) {
            return $this->response->setJSON(['status' => false, 'message' => 'Dokumen tidak ditemukan.']);
        }

        // Hapus file dokumen jika ada
        // if (!empty($dokumen['file_path'])) {
        //     unlink(ROOTPATH . 'public/uploads/' . $dokumen['file_path']);
        // }

        // Hapus data di tabel Revisi
        $revisiList = $this->revisiModel->where('dokumen_id', $id_dokumen)->findAll();
        if (!empty($revisiList)) {
            foreach ($revisiList as $revisi) {
                if (!empty($revisi['file_revisi'])) {
                    unlink(ROOTPATH . 'public/uploads/revisi/' . $revisi['file_revisi']);
                }
            }
            $this->revisiModel->where('dokumen_id', $id_dokumen)->delete();
        }
        $penomoran_number = $dokumen['nomor_dokumen'];
        // Hapus data di tabel Penomoran
        $this->penomoranModel->where('nomor_drawing', $penomoran_number)->delete();

        // Hapus data di tabel Verifikasi jika ada
        $verifikasi = $this->VerifikasiModel->where('dokumen_id', $id_dokumen)->first();
        if ($verifikasi) {
            $this->VerifikasiModel->where('dokumen_id', $id_dokumen)->delete();
        }

        // Hapus data di tabel Pengajuan jika ada
        $pengajuan = $this->pengajuanModel->where('dokumen_id', $id_dokumen)->first();
        if ($pengajuan) {
            $this->pengajuanModel->where('dokumen_id', $id_dokumen)->delete();
        }

        // Hapus data di tabel Dokumen
        $this->dokumenModel->where('dokumen_id', $id_dokumen)->delete();

        // Return JSON response
        return $this->response->setJSON(['status' => true, 'message' => 'Dokumen dan semua data terkait berhasil dihapus.']);
    }


    public function delete_pengajuan($id_pengajuan)
    {
        // Ambil data pengajuan berdasarkan pengajuan_id
        $pengajuan = $this->pengajuanModel->where('pengajuan_id', $id_pengajuan)->first();
        if (!$pengajuan) {
            return $this->response->setJSON(['status' => false, 'message' => 'gagal menghapus pengajuan']);
        }
        // Hapus data di tabel Pengajuan
        $this->pengajuanModel->where('pengajuan_id', $id_pengajuan)->delete();
        //response setelah berhasil delete
        return $this->response->setJSON(['status' => true, 'message' => 'Berhasil dihapus']);
    }


    public function submit_pengajuan($id_dokumen)
    {
        $komentar = $this->request->getPost('komentar');
        $nama = session()->get('nama');
        $npk = session()->get('npk');

        $data = [
            'dokumen_id' => $id_dokumen,
            'user_id' => $npk,
            'pesan_pengajuan' => $komentar,
            'is_seen' => 0,
            'nama_pengaju' => $nama
        ];

        $this->pengajuanModel->save($data);
        return $this->response->setJSON(['status' => true, 'message' => 'Pengajuan berhasil disimpan']);
    }
}
