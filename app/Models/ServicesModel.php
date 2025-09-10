<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ServicesModel extends Model
{
    protected $table            = 'tb_services';
    protected $primaryKey       = 'id_services';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['image_services', 'title_services', 'slug_services', 'deskripsi', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    public function getStatusServices()
    {
        return $this->select(" id_services, title_services, slug_services, deskripsi, image_services, created_at, updated_at, CASE WHEN created_at >= NOW() - INTERVAL 7 DAY THEN 'baru diupload' ELSE DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s') END AS status ")->orderBy('created_at', 'DESC')->findAll();
    }

    // ModelServices.php
    public function getStatusServiceBySlug(string $slug)
    {
        return $this->select("
        id_services, 
        title_services, 
        slug_services, 
        deskripsi, 
        image_services, 
        created_at, 
        updated_at, 
        CASE 
            WHEN created_at >= NOW() - INTERVAL 7 DAY 
            THEN 'baru diupload' 
            ELSE DATE_FORMAT(created_at, '%d-%m-%Y %H:%i:%s') 
        END AS status
    ")
            ->where('slug_services', $slug)
            ->first();
    }

    public function createSlug($slug)
    {
        $uuid = Uuid::uuid4()->toString(); // Generate UUID
        return url_title($slug . '-' . substr($uuid, 0, 8), '-', true);
    }
    public function countAllDataServices()
    {
        return $this->countAll();
    }
    public function getFilteredServices($status = null, $bulan = null, $tahun = null)
    {
        $builder = $this->select("
        id_services, 
        title_services, 
        slug_services, 
        deskripsi, 
        image_services, 
        created_at, 
        updated_at, 
        CASE 
            WHEN created_at >= NOW() - INTERVAL 7 DAY 
            THEN 'baru diupload' 
            ELSE 'lama' 
        END AS status
    ");

        // Filter status
        if ($status) {
            if ($status === 'baru diupload') {
                $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')));
            } elseif ($status === 'lama') {
                $builder->where('created_at <', date('Y-m-d H:i:s', strtotime('-7 days')));
            }
        }

        // Filter bulan
        if ($bulan) {
            $builder->where('MONTH(created_at)', $bulan);
        }

        // Filter tahun
        if ($tahun) {
            $builder->where('YEAR(created_at)', $tahun);
        }

        return $builder->orderBy('created_at', 'DESC')->findAll();
    }
}
