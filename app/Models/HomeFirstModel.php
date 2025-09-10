<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeFirstModel extends Model
{
    protected $table            = 'tb_home_first';
    protected $primaryKey       = 'id_home_first';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['judul_jumbotron','paragraft_jumbo','judul_about','paragraft_about','image_about','created_at','updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';
}
