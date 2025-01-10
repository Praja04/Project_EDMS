<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeSubProsesModel extends Model
{
    protected $table = 'Type_Sub_Proses';
    protected $primaryKey = 'type_sub_proses_id';
    protected $allowedFields = ['nama_type_sub_proses','no_type','sub_proses','proses'];

    public function getItemType($proses)
    {
        // Lakukan query untuk mengambil data ITEM berdasarkan nilai SUPPLIER 2024
        return $this->select('no_type , nama_type_sub_proses, proses,sub_proses')
        ->where('proses', $proses)
            ->findAll();
    }
    public function getItemType2($subProses)
    {
        // Lakukan query untuk mengambil data ITEM berdasarkan nilai SUPPLIER 2024
        return $this->select('no_type , nama_type_sub_proses, proses,sub_proses')
        ->where('sub_proses', $subProses)
            ->findAll();
    }
}
