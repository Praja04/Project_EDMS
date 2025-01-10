<?php

namespace App\Models;

use CodeIgniter\Model;

class PenomoranModel extends Model
{
    protected $table = 'Penomoran';
    protected $primaryKey = 'penomoran_id';
    protected $allowedFields = [
        'kategori',
        'proses',
        'sub_proses_id',
        'type_sub_proses_id',
        'nomor_urut',
        'nomor_mesin',
        'nomor_drawing',
        'keterangan_nomor_drawing'
    ];

     public function checkNumberExist($number)
    {
        return $this->where('nomor_drawing', $number)->countAllResults() > 0;
    }
}
