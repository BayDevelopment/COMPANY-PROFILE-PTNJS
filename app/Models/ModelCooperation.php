<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCooperation extends Model
{
    protected $table            = 'tb_pengajuan_kerjasama';
    protected $primaryKey       = 'id_pengajuan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_perusahaan', 'alamat_perusahaan', 'penanggung_jawab', 'jabatan', 'telepon', 'email', 'ruang_lingkup_kerjasama', 'dokumen_pendukung', 'tanggal_pengajuan', 'status_pengajuan', 'alasan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';
}
