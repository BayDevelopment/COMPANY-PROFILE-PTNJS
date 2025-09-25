<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\DirekturModel;
use App\Models\HomeFirstModel;
use App\Models\ProjectModel;
use App\Models\ServicesModel;
use App\Models\TypedModel;

class Home extends BaseController
{
    protected $typedModel;
    protected $HomeFirst;
    protected $AboutModel;
    protected $ServicesModel;
    protected $ProjectModel;
    protected $DirekturModel;
    public function __construct()
    {
        $this->typedModel = new TypedModel();
        $this->HomeFirst = new HomeFirstModel();
        $this->AboutModel = new AboutModel();
        $this->ServicesModel = new ServicesModel();
        $this->ProjectModel = new ProjectModel();
        $this->DirekturModel = new DirekturModel();
    }
    public function index()
    {
        $m_direktur = $this->DirekturModel
            ->select('no_hp')
            ->orderBy('created_at', 'DESC')   // pakai created_at terbaru
            ->first();

        $d_FirstHome = $this->HomeFirst->findAll();
        $d_About = $this->AboutModel->findAll();
        $direktur = $m_direktur;
        $d_services = $this->ServicesModel->limit(3)->getStatusServices();
        $d_project = $this->ProjectModel->limit(3)->findAll();
        $data = [
            'title' => 'PT. Najwa Jaya Sukses',
            'page_title' => 'Home',
            'typed' => json_encode(array_column($this->typedModel->findAll(), 'paragraft_jumbo')), // Gunakan $this->typedModel
            'd_home' => $d_FirstHome,
            'd_about' => $d_About,
            'd_services' => $d_services,
            'd_project' => $d_project,
            'd_direktur' => $direktur
        ];
        return view('index', $data);
    }
}
