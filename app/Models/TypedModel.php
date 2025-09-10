<?php

namespace App\Models;

use CodeIgniter\Model;

class TypedModel extends Model
{
    protected $table            = 'tb_home_first';
    protected $primaryKey       = 'id_home_first';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['paragraft_jumbo'];

}
