<?php

namespace App\Controllers;

use App\Models\DokumenModel;
use App\Models\SubProsesModel;
use App\Models\TypeSubProsesModel;
use App\Models\PenomoranModel;
use App\Models\VerifikasiModel;
use App\Models\RevisiModel;
use App\Models\PengajuanRevisiModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UploaderController extends BaseController
{
    protected $dokumenModel;
    protected $subProsesModel;
    protected $typeSubModel;
    protected $penomoranModel;
    protected $verifikasiModel;
    protected $revisiModel;
    protected $pengajuanrevisiModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
        $this->subProsesModel = new SubProsesModel();
        $this->typeSubModel = new TypeSubProsesModel();
        $this->penomoranModel = new PenomoranModel();
        $this->verifikasiModel = new VerifikasiModel();
        $this->revisiModel = new RevisiModel();
        $this->pengajuanrevisiModel = new PengajuanRevisiModel();
    }
    public function halaman_penomoran()
    {
        $allowed_roles = ['uploader'];
        $user_role = session()->get('role');

        if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }
        $username['nama'] = session()->get('nama');
        return view('dokumen/form_penomoran', $username);
    }

    public function halaman_upload_drawing()
    {
        $allowed_roles = ['uploader'];
        $user_role = session()->get('role');
        $user_id = session()->get('npk');

        if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }
        // Ambil dokumen dengan status null dan file_path null
        $dokumenBelumUpload = $this->dokumenModel->getDokumenBelumUploadWithPenomoran($user_id);
        // return $this->response->setJSON($dokumenBelumUpload);
        // Tampilkan ke view
        return view('dokumen/upload_drawing', ['dokumen' => $dokumenBelumUpload]);
    }

    public function halaman_revisi_drawing()
    {
        $allowed_roles = ['uploader'];
        $user_role = session()->get('role');
        $user_id = session()->get('npk');
        if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman
            ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }
        $data = [
            'data' => $this->dokumenModel->getDokumenWithDetails($user_id)
        ];
        //return $this->response->setJSON($data);
        return view('revisi/halaman_revisi', $data);
    }

    public function halaman_detail_revisi($dokumen_id)
    {
        // $allowed_roles = ['uploader'];
        // $user_role = session()->get('role');
        // $user_id = session()->get('npk');
        // if (!session()->get('is_login') || !in_array($user_role, $allowed_roles)) {
        //     session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman
        //     ini.');
        //     return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        // }
        $data = [
            'data' => $this->revisiModel->getRevisiByDokumenId($dokumen_id),
            'dokumen' => $this->dokumenModel->getdokumenandpenomoran($dokumen_id)
        ];
        //return $this->response->setJSON($data);
        return view('revisi/detail_revisi', $data);
    }


    public function uploadPdf()
    {
        $idDokumen = $this->request->getPost('id_pdf');
        $file = $this->request->getFile('pdf_drawing');
        // Validasi input kosong atau null
        if (empty($file)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'file tidak boleh kosong.',
            ]);
        }
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();

            // Pindahkan ke folder utama
            $file->move(ROOTPATH . 'public/uploads', $newName);

            // Salin file ke folder revisi
            $sourcePath = ROOTPATH . 'public/uploads/' . $newName;
            $destinationPath = ROOTPATH . 'public/uploads/revisi/' . $newName;
            if (!copy($sourcePath, $destinationPath)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menyalin file ke folder revisi.',
                ]);
            }

            // Update path di database
            $this->dokumenModel->update($idDokumen, ['file_path' => $newName]);

            // Tambahkan data revisi ke database
            $data_revisi = [
                'dokumen_id' => $idDokumen,
                'keterangan_revisi' => 0,
                'file_revisi' => $newName,
                'status_revisi' => null,
                'status_verifikasi_revisi' => null,
            ];
            $this->revisiModel->save($data_revisi);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'PDF berhasil diupload.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal mengupload file.',
        ]);
    }


    // Untuk Update File yang Sudah Ada
    public function updatePdf($idDokumen)
    {
        // Cari data dokumen berdasarkan ID
        $existingPdf = $this->dokumenModel->find($idDokumen);
        if ($existingPdf) {
            $file = $this->request->getFile('pdf_drawing');

            if ($file->isValid() && !$file->hasMoved()) {
                // Path file lama
                $oldFilePath = ROOTPATH  . 'public/uploads/' . $existingPdf['file_path'];

                // Hapus file lama jika ada
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }

                // Simpan file baru
                $newName = $file->getRandomName();
                $file->move(ROOTPATH  . 'public/uploads', $newName);

                // Update path di database
                $this->dokumenModel->update($idDokumen, ['file_path' => $newName]);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'PDF berhasil diperbarui.',
                ]);
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memperbarui file.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Dokumen tidak ditemukan.',
        ]);
    }


    // Untuk Set Status "Masspro"
    public function setStatusMasspro($idDokumen)
    {
        $dokumen = $this->dokumenModel->find($idDokumen);
        $data = [
            'dokumen_id' => $idDokumen,
            'status_verifikasi' => null,
            'tanggal_verifikasi' => null,
            'keterangan' => null
        ];

        if ($dokumen && $dokumen['file_path'] !== null) {

            $this->dokumenModel->update($idDokumen, ['status' => 'masspro']);
            $this->verifikasiModel->save($data);
            $revisi = $this->revisiModel->where('dokumen_id', $idDokumen)->first();
            if ($revisi) {
                $id_revisi = $revisi['revisi_id'];
                $this->revisiModel->update($id_revisi, ['status_revisi' => 'masspro']);
            }
            return redirect()->back()->with('message', 'Status berhasil diubah menjadi Masspro.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah status. Pastikan file telah diupload.');
    }

    public function submit_revisi()
    {
        $idDokumen = $this->request->getPost('dokumen_id');
        $fileRevisi = $this->request->getFile('file_revisi');

        // Validasi input
        if (!$fileRevisi->isValid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'File revisi tidak valid atau belum diunggah.'
            ]);
        }

        // Cek revisi sebelumnya untuk dokumen ini dan ambil nilai keterangan_revisi yang ada
        $lastRevisi = $this->revisiModel->select('keterangan_revisi')
            ->where('dokumen_id', $idDokumen)
            ->orderBy('keterangan_revisi', 'DESC')
            ->first();

        // Tentukan keterangan_revisi berdasarkan revisi sebelumnya
        $keteranganRevisi = 0; // Default ke 0 untuk revisi pertama

        if ($lastRevisi) {
            // Jika revisi sebelumnya ada dengan keterangan_revisi = 0, revisi selanjutnya = 1
            if ($lastRevisi['keterangan_revisi'] == 0) {
                $keteranganRevisi = 1;
            } else {
                // Jika sudah ada revisi dengan keterangan_revisi > 0, revisi selanjutnya = keterangan_revisi + 1
                $keteranganRevisi = $lastRevisi['keterangan_revisi'] + 1;
            }
        }

        // Simpan file revisi
        $filePath = ROOTPATH . 'public/uploads/revisi/';
        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }
        $newFileName = $fileRevisi->getRandomName();
        $fileRevisi->move($filePath, $newFileName);

        // Persiapkan data untuk disimpan
        $data = [
            'dokumen_id' => $idDokumen,
            'keterangan_revisi' => $keteranganRevisi,
            'file_revisi' => $newFileName
        ];

        // Simpan ke database
        // $id_pengajuan = $this->pengajuanrevisiModel
        //     ->where('dokumen_id', $idDokumen)
        //     ->where('is_seen', 0)
        //     ->first();
        // $this->pengajuanrevisiModel->update($id_pengajuan['pengajuan_id'], ['is_seen' => 1]);
        $id_pengajuan = $this->pengajuanrevisiModel
        ->where('dokumen_id', $idDokumen)
        ->where('is_seen', 0)
        ->first();

        // Update jika pengajuan revisi ditemukan
        if ($id_pengajuan) {
            $this->pengajuanrevisiModel->update($id_pengajuan['pengajuan_id'], ['is_seen' => 1]);
        }
        $result = $this->revisiModel->save($data);

        // Buat respons JSON
        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Revisi berhasil disimpan.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Gagal menyimpan revisi.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function setmassproAgain($id_revisi)
    {
        // Ambil dokumen berdasarkan id_revisi
        $dokumen = $this->revisiModel->where('revisi_id', $id_revisi)->first();

        if ($dokumen) {
            $dokumen_id = $dokumen['dokumen_id'];

            // Cari semua data revisi yang memiliki dokumen_id yang sama
            $revisiList = $this->revisiModel->where('dokumen_id', $dokumen_id)->findAll();

            if ($revisiList) {
                // Update semua status_revisi dan status_verifikasi menjadi '-'
                foreach ($revisiList as $revisi) {
                    $this->revisiModel->update($revisi['revisi_id'], [
                        'status_revisi' => '-',
                        'status_verifikasi_revisi' => '-'
                    ]);
                }
            }

            // Ambil path file revisi dari dokumen yang sesuai
            $dokumen_path = $dokumen['file_revisi'];

            // Ambil data verifikasi berdasarkan dokumen_id
            $verifikasi = $this->verifikasiModel->where('dokumen_id', $dokumen_id)->first();

            if ($verifikasi) {
                $verifikasi_id = $verifikasi['verifikasi_id'];

                // Data untuk update tabel Dokumen
                $data_dokumen = [
                    //'status' => '',
                    'file_path' => $dokumen_path,
                ];

                // Data untuk update tabel Verifikasi
                $data_verifikasi = [
                    'status_verifikasi' => null,
                    'keterangan_verifikasi' => null,
                ];

                // Data untuk update tabel Revisi
                $data_revisi = [
                    'status_revisi' => 'masspro',
                    'status_verifikasi_revisi' => null
                ];

                // Update tabel Dokumen
                $this->dokumenModel->update($dokumen_id, $data_dokumen);

                // Update tabel Verifikasi
                $this->verifikasiModel->update($verifikasi_id, $data_verifikasi);

                // Update tabel Revisi untuk revisi tertentu
                $this->revisiModel->update($id_revisi, $data_revisi);

                // Kembalikan respons JSON
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui.',
                    'data' => [
                        'dokumen_id' => $dokumen_id,
                        'verifikasi_id' => $verifikasi_id,
                        'file_path' => $dokumen_path
                    ]
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data verifikasi tidak ditemukan.'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data dokumen tidak ditemukan.'
            ]);
        }
    }


    public function updatePdfRevisi($idRevisi)
    {
        // Cari data dokumen berdasarkan ID
        $existingPdf = $this->revisiModel->find($idRevisi);
        if ($existingPdf) {
            $file = $this->request->getFile('pdf_drawing');

            if ($file->isValid() && !$file->hasMoved()) {
                // Path file lama
                $oldFilePath = ROOTPATH  . 'public/uploads/revisi/' . $existingPdf['file_revisi'];

                // Hapus file lama jika ada
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }

                // Simpan file baru
                $newName = $file->getRandomName();
                $file->move(ROOTPATH  . 'public/uploads/revisi', $newName);

                // Update path di database
                $this->revisiModel->update($idRevisi, ['file_revisi' => $newName]);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'PDF berhasil diperbarui.',
                ]);
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal memperbarui file.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Dokumen tidak ditemukan.',
        ]);
    }
}
