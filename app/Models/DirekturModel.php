<?php

namespace App\Models;

use CodeIgniter\Model;

class DirekturModel extends Model
{
    protected $table            = 'tb_direktur';
    protected $primaryKey       = 'id_direktur';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields  = ['nama', 'jabatan', 'email', 'no_hp', 'verified_handphone'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function hasAnotherActive(?int $excludeId = null): bool
    {
        $builder = $this->where('verified_handphone', 1);
        if ($excludeId !== null) {
            $builder->where('id_direktur !=', $excludeId);
        }
        return $builder->countAllResults() > 0;
    }

    public function getPublishedPhones(): array
    {
        return $this->where('verified_handphone', 1)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getFirstPublishedPhone(): ?array
    {
        return $this->where('verified_handphone', 1)->orderBy('created_at', 'DESC')->first();
    }
}
