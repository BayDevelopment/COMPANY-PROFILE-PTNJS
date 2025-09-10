<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\ModelMisi;
use App\Models\ModelVisi;
use CodeIgniter\HTTP\ResponseInterface;

class About extends BaseController
{
    protected $AboutModel;
    protected $VisiModel;
    protected $MisiModel;
    public function __construct()
    {
        $this->AboutModel = new AboutModel();
        $this->VisiModel = new ModelVisi();
        $this->MisiModel = new ModelMisi();
    }
    public function index()
    {
        //
        $data_about = $this->AboutModel->findAll();
        $d_visi = $this->VisiModel->findAll();
        $d_misi = $this->MisiModel->findAll();
        $data = [
            'title' => 'About | PT. Najwa Jaya Sukses',
            'page_title' => 'About',
            'typed' => "",
            'd_about' => $data_about,
            'd_visi' => $d_visi,
            'd_misi' => $d_misi,

        ];

        return view('/pages/about', $data);
    }
}
