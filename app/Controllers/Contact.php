<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\ContactModel;
use App\Models\DirekturModel;
use CodeIgniter\HTTP\ResponseInterface;

class Contact extends BaseController
{
    protected $ContactModel;
    protected $AboutModel;
    protected $direkturModel;
    public function __construct()
    {
        $this->ContactModel = new ContactModel();
        $this->AboutModel = new AboutModel();
        $this->direkturModel = new DirekturModel();
    }
    public function index()
    {
        //
        $data_about = $this->AboutModel->findAll();
        $data = [
            'title' => 'Contact | PT. Najwa Jaya Sukses ',
            'page_title' => 'Contact',
            'typed' => '',
            'd_about' => $data_about
        ];
        return view('/pages/contact', $data);
    }

    public function tambah_contact_public()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi
        $rules = [
            'name' => [
                'rules'  => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required'   => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal {param} karakter.',
                    'max_length' => 'Nama maksimal {param} karakter.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|max_length[50]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'max_length'  => 'Email maksimal {param} karakter.',
                ],
            ],
            'message' => [
                'rules'  => 'required|min_length[5]',
                'errors' => [
                    'required'   => 'Pesan wajib diisi.',
                    'min_length' => 'Pesan minimal {param} karakter.',
                ],
            ],
        ];


        if ($this->validate($rules)) {

            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'message' => $this->request->getPost('message'),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->ContactModel->insert($data);

            return redirect()->to('/pages/contact')->with('sweet_success', 'Pesan berhasil dikirim!');
        } else {
            return redirect()->back()->withInput()->with('sweet_errors', $validation->getErrors());
        }
    }

    public function pesan_wa()
    {
        // Validasi input
        $rules = [
            'name' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'   => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal {param} karakter.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                ],
            ],
            'message' => [
                'rules'  => 'required|min_length[5]',
                'errors' => [
                    'required'   => 'Pesan wajib diisi.',
                    'min_length' => 'Pesan minimal {param} karakter.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_errors', $this->validator->getErrors());
        }

        // Ambil data form
        $name    = trim((string) $this->request->getPost('name'));
        $email   = trim((string) $this->request->getPost('email'));
        $message = trim((string) $this->request->getPost('message'));

        // Ambil nomor WA dari Direktur yang dipublikasikan (verified_handphone = 1)
        $dirModel = new DirekturModel();
        $dir = $dirModel->where('verified_handphone', 1)
            ->orderBy('updated_at', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$dir || empty($dir['no_hp'])) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'Nomor WhatsApp publik belum disetel.');
        }

        // Normalisasi nomor ke format 62xxxxxxxxx
        $waNumber = $this->normalizePhoneID($dir['no_hp']);
        if (!$waNumber) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'Format nomor WhatsApp tidak valid.');
        }

        // Format teks WA
        $text = "Halo PT. Najwa Jaya Sukses,\n"
            . "Saya menghubungi melalui website.\n\n"
            . "Nama: {$name}\n"
            . "Email: {$email}\n"
            . "Pesan:\n{$message}\n\n"
            . "(Terkirim dari halaman kontak)";

        // Build link wa.me
        $waLink = "https://wa.me/{$waNumber}?text=" . rawurlencode($text);

        // Redirect ke WhatsApp
        return redirect()->to($waLink);
    }

    /**
     * Normalisasi nomor Indonesia ke format internasional:
     *  "0812xxxx" -> "62812xxxx", "8xxxx" -> "628xxxx", "62xxxx" tetap.
     *  Hapus semua non-digit.
     */
    private function normalizePhoneID(?string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', (string)$phone);
        if ($digits === '') return null;

        if (strpos($digits, '62') === 0) {
            return $digits;
        }
        if ($digits[0] === '0') {
            return '62' . substr($digits, 1);
        }
        if ($digits[0] === '8') {
            return '62' . $digits;
        }
        // fallback: kembalikan digit (jika sudah intl non-ID)
        return $digits;
    }
}
