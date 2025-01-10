<?php

namespace App\Controllers;

use App\Models\DokumenModel;
use App\Models\SubProsesModel;
use App\Models\TypeSubProsesModel;
use App\Models\PenomoranModel;
use PDO;

class DokumenController extends BaseController
{
    protected $dokumenModel;
    protected $subProsesModel;
    protected $typeSubModel;
    protected $penomoranModel;

    public function __construct()
    {
        $this->dokumenModel = new DokumenModel();
        $this->subProsesModel = new SubProsesModel();
        $this->typeSubModel = new TypeSubProsesModel();
        $this->penomoranModel = new PenomoranModel();
    }

    public function index()
    {
        // Periksa role user dari session
        if (!session()->get('is_login')) {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }
        // Reader hanya bisa melihat dokumen yang diverifikasi
        $data['dokumen'] = $this->dokumenModel->getVerifiedDocuments();


        return view('dokumen/view_drawing', $data);
    }

  


    //api
    public function getsubProses()
    {
        $Proses = $this->request->getGet('proses');

        if ($Proses) {
            $items = $this->subProsesModel->getItemSub($Proses);
            return $this->response->setJSON($items);
        }

        return $this->response->setJSON(['error' => 'data tidak ada']);
    }

    public function getTypeSub()
    {
        $typeSub = $this->request->getGet('typesub');
        if ($typeSub) {
            $items = $this->typeSubModel->getItemType($typeSub);
            return $this->response->setJSON($items);
        }

        return $this->response->setJSON(['error' => 'data tidak ada']);
    }

    public function getTypeSub2()
    {
        $subProses = $this->request->getGet('subProses');
        if ($subProses) {
            $items = $this->typeSubModel->getItemType2($subProses);
            return $this->response->setJSON($items);
        }

        return $this->response->setJSON(['error' => 'data tidak ada']);
    }



    public function generateNumber()
    {
        if (!session()->get('is_login') || session()->get('role') != 'uploader') {
            session()->setFlashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to(base_url('/')); // Ganti '/' dengan URL halaman yang sesuai
        }

        try {
            $nama = session()->get('nama');
            $user_id = session()->get('npk');

            // Ambil data dari AJAX
            $nama_file = $this->request->getPost('nama_file');
            $kategori = $this->request->getPost('kategori');
            $proses = $this->request->getPost('proses');
            $no_mesin = $this->request->getPost('no_mesin');
            $subProses = $this->request->getPost('sub_proses');
            $typeSub = $this->request->getPost('type_sub');

            $kategoriString = $this->request->getPost('kategori_string');
            // $type = $this->request->getPost('proses_string');
            $prosesString = $this->request->getPost('proses_string');
            $no_mesinString = $this->request->getPost('no_mesin_string');
            $subProsesString = $this->request->getPost('sub_proses_string');
            $typeSubString = $this->request->getPost('type_sub_string');

            // Validasi dan format nomor mesin
            $no_mesin = $this->formatNumber($no_mesin);
            $pdfnumber = '';
            // $pdfString = '';
            $checkNumber = "$kategori$proses/$subProses/$typeSub/00/$no_mesin";
            // Cek apakah data yang sama sudah ada di tabel
            $existingData = $this->penomoranModel->where([
                'nomor_drawing' => $checkNumber
            ])->first();
            if ($existingData) {
                $numberFound = false;
                for ($uniqueNum = 0; $uniqueNum < 100; $uniqueNum++) {
                    $uniqueNumPadded = str_pad($uniqueNum, 2, '0', STR_PAD_LEFT);
                    $number = "$kategori$proses/$subProses/$typeSub/$uniqueNumPadded/$no_mesin";
                    $string = "$kategoriString-$prosesString/$subProsesString/$typeSubString/$uniqueNumPadded/$no_mesinString";

                    // Periksa keberadaan nomor
                    if (!$this->penomoranModel->checkNumberExist($number)) {
                        $pdfnumber = $number;
                        $pdfString = $string;
                        $numberFound = true;
                        break;
                    }
                }

                if (!$numberFound) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Tidak dapat menghasilkan nomor yang unik. Coba lagi.'
                    ]);
                }

                // Simpan data ke database
                $Penomorandrawing = [
                    'nomor_drawing' => $pdfnumber,
                    'keterangan_nomor_drawing' => $string,
                    'kategori' => $kategori,
                    'proses' => $proses,
                    'sub_proses_id' => $subProses,
                    'type_sub_proses_id' => $typeSub,
                    'nomor_mesin' => $no_mesin,
                    'nomor_urut' => $uniqueNumPadded,

                ];
                $this->penomoranModel->insert($Penomorandrawing);
                $dokumen = [
                    'user_id' => $user_id,
                    'nama_dokumen' => $nama_file,
                    'nomor_dokumen' => $pdfnumber,
                    'status' => null,
                    'file_path' => null,
                    'nama_penulis' => $nama
                ];
                $this->dokumenModel->insert($dokumen);
                // Simpan nomor di session
                session()->set('generated_number', $pdfnumber);
                // session()->set('generated_string', $pdfString);

                return $this->response->setJSON([
                    'status' => 'exists',
                    'message' => '<span style="color: red;"><strong>Data penomoran yang dimasukkan sama dengan data penomoran drawing sebelumnya.</strong></span>  Nomor berhasil digenerate: ' . $pdfnumber,
                    'generated_number' => $pdfnumber
                ]);

            } else {
                $numberFound = false;
                for ($uniqueNum = 0; $uniqueNum < 100; $uniqueNum++) {
                    $uniqueNumPadded = str_pad($uniqueNum, 2, '0', STR_PAD_LEFT);
                    $number = "$kategori$proses/$subProses/$typeSub/$uniqueNumPadded/$no_mesin";
                    $string = "$kategoriString-$prosesString/$subProsesString/$typeSubString/$uniqueNumPadded/$no_mesinString";

                    // Periksa keberadaan nomor
                    if (!$this->penomoranModel->checkNumberExist($number)) {
                        $pdfnumber = $number;
                        $pdfString = $string;
                        $numberFound = true;
                        break;
                    }
                }

                if (!$numberFound) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Tidak dapat menghasilkan nomor yang unik. Coba lagi.'
                    ]);
                }

                // Simpan data ke database
                $Penomorandrawing = [
                    'nomor_drawing' => $pdfnumber,
                    'keterangan_nomor_drawing' => $string,
                    'kategori' => $kategori,
                    'proses' => $proses,
                    'sub_proses_id' => $subProses,
                    'type_sub_proses_id' => $typeSub,
                    'nomor_mesin' => $no_mesin,
                    'nomor_urut' => $uniqueNumPadded,

                ];
                $this->penomoranModel->insert($Penomorandrawing);

                $dokumen = [
                    'user_id' => $user_id,
                    'nama_dokumen'=>$nama_file,
                    'nomor_dokumen' => $pdfnumber,
                    'status'=> null,
                    'file_path' => null,
                    'nama_penulis' => $nama
                ];
                $this->dokumenModel->insert($dokumen);
                // Simpan nomor di session
                session()->set('generated_number', $pdfnumber);
                // session()->set('generated_string', $pdfString);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Nomor berhasil digenerate: ' . $pdfnumber,
                    'generated_number' => $pdfnumber
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal generate nomor dokumen! Error: ' . $e->getMessage()
            ]);
        }
    }


    
    // Fungsi format nomor mesin
    private function formatNumber($number)
    {
        if (is_array($number)) {
            return str_pad(implode('', $number), 3, '0', STR_PAD_LEFT);
        } elseif (is_null($number)) {
            return str_pad('', 3, '0', STR_PAD_LEFT);
        }
        return str_pad($number, 3, '0', STR_PAD_LEFT);
    }


}
