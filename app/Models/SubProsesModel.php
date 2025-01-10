<?php

namespace App\Models;

use CodeIgniter\Model;

class SubProsesModel extends Model
{
    protected $table = 'Sub_Proses';
    protected $primaryKey = 'sub_proses_id';
    protected $allowedFields = ['nama_sub_proses','no_sub_proses','nama_sub_proses','proses'];

    public function getItemSub($Proses)
    {
        // Lakukan query untuk mengambil data ITEM berdasarkan nilai SUPPLIER 2024
        return $this->select('no_sub_proses , nama_sub_proses, proses')
        ->where('proses', $Proses)
            ->findAll();
    }
}
