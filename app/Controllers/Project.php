<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\ProjectModel;
use CodeIgniter\HTTP\ResponseInterface;

class Project extends BaseController
{
    protected $AboutModel;
    protected $ProjectModel;
    public function __construct()
    {
        $this->AboutModel = new AboutModel();
        $this->ProjectModel = new ProjectModel();
    }
    public function index()
    {
        //
        $data_about = $this->AboutModel->findAll();
        $d_Project = $this->ProjectModel->findAll();
        $data = [
            'title' => 'Project | PT. Najwa Jaya Sukses',
            'page_title' => "Project's",
            'typed' => "",
            'd_about' => $data_about,
            'd_project' => $d_Project
        ];

        return view('/pages/project', $data);
    }
}
