<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\ServicesModel;
use App\Models\TypedModel;
use CodeIgniter\HTTP\ResponseInterface;

class Services extends BaseController
{
    protected $typedModel;
    protected $ModelServices;
    protected $AboutModel;
    public function __construct()
    {
        $this->typedModel = new TypedModel();
        $this->ModelServices = new ServicesModel();
        $this->AboutModel = new AboutModel();
    }
    public function index()
    {
        //
        $data_about = $this->AboutModel->findAll();
        $d_Services = $this->ModelServices->findAll();
        $d_getStatus = $this->ModelServices->getStatusServices();
        $data = [
            'title' => "Service's | PT. Najwa Jaya Sukses",
            'page_title' => "Service's",
            'typed' => json_encode(array_column($this->typedModel->findAll(), 'paragraft_jumbo')), // Gunakan $this->typedModel
            'd_services' => $d_Services,
            'd_status' => $d_getStatus,
            'd_about' => $data_about

        ];
        return view('/pages/services', $data);
    }

    public function detail_services($slug)
    {
        $data_about = $this->AboutModel->findAll();

        // detail data utama (bisa juga pakai method ini saja sebenarnya)
        $all_data_services = $this->ModelServices
            ->where('slug_services', $slug)
            ->first();

        if (!$all_data_services) {
            return redirect()->to(base_url('pages/services'))
                ->with('sweet_error', 'Data layanan tidak ditemukan atau slug tidak sesuai!');
        }

        // status untuk service ini saja
        $d_getStatus = $this->ModelServices->getStatusServiceBySlug($slug);

        $data = [
            'title'          => "Service's | PT. Najwa Jaya Sukses",
            'page_title'     => "Service's",
            'd_all_services' => $all_data_services,
            'd_status'       => $d_getStatus,    // berisi kolom "status"
            'd_about'        => $data_about
        ];

        return view('pages/detail_services', $data);
    }
}
