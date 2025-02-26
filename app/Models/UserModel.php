<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['nama', 'email', 'npk', 'role'];

    public function getAlldataUsers(){
        return $this->where('role','users')->findAll();
    }

}
