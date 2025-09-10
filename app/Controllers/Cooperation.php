<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\ModelCooperation;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class Cooperation extends BaseController
{
    protected $AboutModel;
    protected $ModelCooperation;

    public function __construct()
    {
        $this->AboutModel = new AboutModel();
        $this->ModelCooperation = new ModelCooperation();
    }

    public function index()
    {
        $data_about = $this->AboutModel->findAll();
        $data = [
            'title' => 'Cooperation | PT. Najwa Jaya Sukses',
            'page_title' => 'Cooperation',
            'translite' => 'Kerjasama',
            'typed' => "",
            'd_about' => $data_about
        ];

        return view('/pages/cooperation', $data);
    }

    public function aksi_cooperation()
    {
        // Set zona waktu
        date_default_timezone_set('Asia/Jakarta');

        // Validasi input
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_perusahaan' => [
                'label' => 'Nama Perusahaan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama perusahaan harus diisi.',
                ],
            ],
            'alamat_perusahaan' => [
                'label' => 'Alamat Perusahaan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat perusahaan harus diisi.',
                ],
            ],
            'penanggung_jawab' => [
                'label' => 'Penanggung Jawab',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama penanggung jawab harus diisi.',
                ],
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan harus diisi.',
                ],
            ],
            'telepon' => [
                'label' => 'Telepon',
                'rules' => 'required|regex_match[/^08[0-9]{6,12}$/]|numeric',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'regex_match' => 'Nomor telepon harus dimulai dengan 08 dan memiliki 8 hingga 12 digit angka.',
                    'numeric' => 'Nomor telepon hanya boleh berisi angka.',
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[tb_pengajuan_kerjasama.email]',
                'errors' => [
                    'required'    => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Email sudah terdaftar, silakan gunakan email lain.',
                ],
            ],
            'ruang_lingkup_kerjasama' => [
                'label' => 'Ruang Lingkup Kerjasama',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ruang lingkup kerja sama harus diisi.',
                ],
            ],
            'proposal' => [
                'label' => 'Proposal',
                'rules' => 'uploaded[proposal]|mime_in[proposal,application/pdf]|max_size[proposal,1024]',
                'errors' => [
                    'uploaded' => 'File proposal harus diunggah.',
                    'mime_in' => 'Proposal harus dalam format PDF.',
                    'max_size' => 'Ukuran proposal tidak boleh lebih dari 1MB.',
                ],
            ],
            'profil_perusahaan' => [
                'label' => 'Profil Perusahaan',
                'rules' => 'uploaded[profil_perusahaan]|mime_in[profil_perusahaan,application/pdf,image/jpeg,image/png]|max_size[profil_perusahaan,1024]',
                'errors' => [
                    'uploaded' => 'File profil perusahaan harus diunggah.',
                    'mime_in' => 'Profil perusahaan harus dalam format PDF, JPG, atau PNG.',
                    'max_size' => 'Ukuran profil perusahaan tidak boleh lebih dari 1MB.',
                ],
            ],
            'dokumen_npwp' => [
                'label' => 'Dokumen NPWP',
                'rules' => 'uploaded[dokumen_npwp]|mime_in[dokumen_npwp,application/pdf,image/jpeg,image/png]|max_size[dokumen_npwp,1024]',
                'errors' => [
                    'uploaded' => 'Dokumen NPWP harus diunggah.',
                    'mime_in' => 'Dokumen NPWP harus dalam format PDF, JPG, atau PNG.',
                    'max_size' => 'Ukuran dokumen NPWP tidak boleh lebih dari 1MB.',
                ],
            ],
            'surat_pernyataan' => [
                'label' => 'Surat Pernyataan',
                'rules' => 'uploaded[surat_pernyataan]|mime_in[surat_pernyataan,application/pdf]|max_size[surat_pernyataan,1024]',
                'errors' => [
                    'uploaded' => 'Surat pernyataan harus diunggah.',
                    'mime_in' => 'Surat pernyataan harus dalam format PDF.',
                    'max_size' => 'Ukuran surat pernyataan tidak boleh lebih dari 1MB.',
                ],
            ],
        ]);


        // Jalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = $this->ModelCooperation;

        // Simpan data jika validasi berhasil
        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat_perusahaan' => $this->request->getPost('alamat_perusahaan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'ruang_lingkup_kerjasama' => $this->request->getPost('ruang_lingkup_kerjasama'),
            'proposal' => $this->uploadFile('proposal'),
            'profil_perusahaan' => $this->uploadFile('profil_perusahaan'),
            'dokumen_npwp' => $this->uploadFile('dokumen_npwp'),
            'surat_pernyataan' => $this->uploadFile('surat_pernyataan'),
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status_pengajuan' => "Menunggu persetujuan",
        ];

        // Simpan ke database
        $model->insert($data);

        // Format nomor telepon klien agar sesuai dengan format internasional (hapus nol di depan dan tambahkan kode negara)
        $client_wa = preg_replace('/^0/', '62', $data['telepon']);

        // Pesan untuk Klien

        // Format tanggal pengajuan
        $tanggal_pengajuan = formatTanggalIndonesia(date('d-m-Y H:i'));

        // Pesan WhatsApp otomatis sesuai data yang dimasukkan
        $client_message = urlencode(
            "📢 *Pengajuan Kerja Sama* 📢\n\n" .
                "📌 *Nama Perusahaan:* " . $data['nama_perusahaan'] . "\n" .
                "👤 *Penanggung Jawab:* " . $data['penanggung_jawab'] . "\n" .
                "📎 *Jabatan:* " . $data['jabatan'] . "\n" .
                "📞 *Telepon:* " . $data['telepon'] . "\n" .
                "📄 *Ruang Lingkup:* " . $data['ruang_lingkup_kerjasama'] . "\n" .
                "📅 *Tanggal Pengajuan:* " . $tanggal_pengajuan . "\n\n" .
                "✅ Pengajuan Anda telah kami terima dan sedang diproses. Kami akan segera menghubungi Anda untuk langkah selanjutnya.\n\n" .
                "📌 *Salam,*\n" .
                "PT. Najwa Jaya Sukses"
        );


        // URL API WhatsApp (langsung kirim pesan)
        $client_whatsapp_url = "https://wa.me/$client_wa?text=$client_message&app_absent=0";

        // Simpan URL WhatsApp ke session flashdata
        session()->setFlashdata('wa_url', $client_whatsapp_url);

        return redirect()->to('/pages/cooperation')->with('sweet_success', 'Pengajuan Kerjasama Berhasil Dikirim.');
    }

    private function uploadFile($fieldName)
    {
        $file = $this->request->getFile($fieldName);

        if ($file->isValid() && !$file->hasMoved()) {
            // Ambil ekstensi, MIME, dan ukuran
            $ext   = strtolower($file->getExtension());
            $mime  = $file->getMimeType();
            $size  = $file->getSize(); // ukuran dalam byte

            // Batas ukuran maksimal 1 MB (1 * 1024 * 1024 byte)
            $maxSize = 1 * 1024 * 1024;

            if ($size > $maxSize) {
                throw new \RuntimeException("Ukuran file $fieldName tidak boleh lebih dari 1 MB.");
            }

            // Tentukan whitelist ekstensi
            $allowedTypes = [
                'proposal'         => ['pdf'],
                'profil_perusahaan' => ['pdf', 'jpg', 'jpeg', 'png'],
                'dokumen_npwp'     => ['pdf', 'jpg', 'jpeg', 'png'],
                'surat_pernyataan' => ['pdf'],
            ];

            if (!in_array($ext, $allowedTypes[$fieldName] ?? [])) {
                throw new \RuntimeException("File $fieldName tidak valid. Hanya boleh: " . implode(', ', $allowedTypes[$fieldName]));
            }

            // Cek MIME juga untuk double proteksi
            $allowedMimes = [
                'pdf'  => 'application/pdf',
                'jpg'  => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png'  => 'image/png',
            ];

            if (isset($allowedMimes[$ext]) && strpos($mime, $allowedMimes[$ext]) === false) {
                throw new \RuntimeException("MIME file $fieldName tidak sesuai.");
            }

            // Jika lolos validasi → simpan
            $newName = $file->getRandomName();
            $file->move('assets/uploads', $newName);
            return $newName;
        }

        return null;
    }



    public function edit_aksi_cooperation($id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $validation = \Config\Services::validation();

        $rules = [
            'nama_perusahaan' => [
                'label' => 'Nama Perusahaan',
                'rules' => 'required',
                'errors' => ['required' => 'Nama perusahaan harus diisi.'],
            ],
            'alamat_perusahaan' => [
                'label' => 'Alamat Perusahaan',
                'rules' => 'required',
                'errors' => ['required' => 'Alamat perusahaan harus diisi.'],
            ],
            'penanggung_jawab' => [
                'label' => 'Penanggung Jawab',
                'rules' => 'required',
                'errors' => ['required' => 'Nama penanggung jawab harus diisi.'],
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => ['required' => 'Jabatan harus diisi.'],
            ],
            'telepon' => [
                'label' => 'Telepon',
                'rules' => 'required|regex_match[/^08[0-9]{6,12}$/]|numeric',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi.',
                    'regex_match' => 'Nomor telepon harus dimulai dengan 08 dan memiliki 8 hingga 12 digit angka.',
                    'numeric' => 'Nomor telepon hanya boleh berisi angka.',
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                ],
            ],
            'ruang_lingkup_kerjasama' => [
                'label' => 'Ruang Lingkup Kerjasama',
                'rules' => 'required',
                'errors' => ['required' => 'Ruang lingkup kerja sama harus diisi.'],
            ],
        ];

        // cek status dari input
        $status = $this->request->getPost('status_pengajuan');

        // kalau status = Dibatalkan, tambahkan validasi alasan
        if ($status === 'Dibatalkan') {
            $rules['alasan'] = [
                'label' => 'Alasan',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Alasan pembatalan harus diisi.',
                    'min_length' => 'Alasan minimal 5 karakter.'
                ],
            ];
        }

        $validation->setRules($rules);


        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = $this->ModelCooperation;

        $status = $this->request->getPost('status_pengajuan');

        $data = [
            'nama_perusahaan'       => $this->request->getPost('nama_perusahaan'),
            'alamat_perusahaan'     => $this->request->getPost('alamat_perusahaan'),
            'penanggung_jawab'      => $this->request->getPost('penanggung_jawab'),
            'jabatan'               => $this->request->getPost('jabatan'),
            'telepon'               => $this->request->getPost('telepon'),
            'email'                 => $this->request->getPost('email'),
            'ruang_lingkup_kerjasama' => $this->request->getPost('ruang_lingkup_kerjasama'),
            'status_pengajuan'      => $status,
            'alasan'                => ($status === 'Dibatalkan')
                ? $this->request->getPost('alasan')
                : null,
            'updated_at'            => date('Y-m-d H:i:s'),
        ];


        $model->update($id, $data);

        return redirect()->to('admin/pages/cooperation')->with('sweet_success', 'Data Kerjasama berhasil diperbarui.');
    }


    public function hapus_aksi_cooperation($id)
    {
        // Ambil data kerja sama berdasarkan ID
        $cooperation = $this->ModelCooperation->find($id);

        if (!$cooperation) {
            return redirect()->back()->with('sweet_error', 'Data kerja sama tidak ditemukan.');
        }

        // Daftar nama file yang mau dicek & dihapus
        $fileFields = ['proposal', 'profil_perusahaan', 'dokumen_npwp', 'surat_pernyataan'];

        foreach ($fileFields as $field) {
            if (!empty($cooperation[$field])) {
                $filePath = 'assets/uploads/' . $cooperation[$field]; // atau sesuaikan path folder kamu
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Hapus data dari database
        $this->ModelCooperation->delete($id);

        return redirect()->to(base_url('admin/pages/cooperation'))->with('sweet_success', 'Data kerja sama dan semua file berhasil dihapus.');
    }








    public function exportPdf($id)
    {
        ini_set('memory_limit', '1024M'); // Tambah memori

        set_time_limit(300);

        $d_cooperation = $this->ModelCooperation->find($id);

        if (!$d_cooperation) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan');
        }

        // Load gambar dan ubah ke base64
        $path = FCPATH . 'assets/img/logo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // Dompdf setup
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);

        // Kirim ke view
        $html = view('admin/pages/pdf_template', [
            'd_cooperation' => $d_cooperation,
            'logoBase64' => $base64_logo
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Kerjasama_{$id}.pdf", ["Attachment" => false]);
    }
}
