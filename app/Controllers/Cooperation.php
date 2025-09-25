<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\DirekturModel;
use App\Models\ModelCooperation;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class Cooperation extends BaseController
{
    protected $AboutModel;
    protected $ModelCooperation;
    protected $ModelDirektur;

    public function __construct()
    {
        $this->AboutModel = new AboutModel();
        $this->ModelCooperation = new ModelCooperation();
        $this->ModelDirektur = new DirekturModel();
    }

    public function index()
    {
        $m_direktur = $this->ModelDirektur
            ->select('no_hp')
            ->orderBy('created_at', 'DESC')   // pakai created_at terbaru
            ->first();

        $data_about = $this->AboutModel->findAll();
        $data = [
            'title' => 'Cooperation | PT. Najwa Jaya Sukses',
            'page_title' => 'Cooperation',
            'translite' => 'Kerjasama',
            'typed' => "",
            'd_about' => $data_about,
            'd_direktur' => $m_direktur
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
            'dokumen_pendukung' => [
                'label' => 'Proposal',
                'rules' => 'uploaded[dokumen_pendukung]|mime_in[dokumen_pendukung,application/pdf]|max_size[dokumen_pendukung,1024]',
                'errors' => [
                    'uploaded' => 'File dokumen harus diunggah.',
                    'mime_in' => 'dokumen harus dalam format PDF.',
                    'max_size' => 'Ukuran dokumen tidak boleh lebih dari 1MB.',
                ],
            ]
        ]);


        // Jalankan validasi
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = $this->ModelCooperation;

        // === FIX: Ambil SATU nomor direktur terbaru & alias ke 'telepon' ===
        $direktur = $this->ModelDirektur
            ->select('no_hp AS telepon, created_at')
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$direktur || empty($direktur['telepon'])) {
            return redirect()->to('/pages/cooperation')
                ->with('sweet_warning', 'No telepon direktur belum disetting');
        }

        // Simpan data jika validasi berhasil
        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat_perusahaan' => $this->request->getPost('alamat_perusahaan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'jabatan' => $this->request->getPost('jabatan'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
            'ruang_lingkup_kerjasama' => $this->request->getPost('ruang_lingkup_kerjasama'),
            'dokumen_pendukung' => $this->uploadFile('dokumen_pendukung'),
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status_pengajuan' => "Menunggu persetujuan",
        ];

        // Simpan ke database
        $model->insert($data);

        // === FIX: Normalisasi nomor direktur ke format wa.me (internasional tanpa '+')
        $telepon_direktur = $direktur['telepon'];
        $digits = preg_replace('/\D+/', '', $telepon_direktur); // buang non-digit
        if (strpos($digits, '62') === 0) {
            $client_wa = $digits;
        } elseif (strpos($digits, '0') === 0) {
            $client_wa = '62' . substr($digits, 1);
        } else {
            $client_wa = '62' . $digits;
        }

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
                'dokumen_pendukung'         => ['pdf'],
            ];

            if (!in_array($ext, $allowedTypes[$fieldName] ?? [])) {
                throw new \RuntimeException("File $fieldName tidak valid. Hanya boleh: " . implode(', ', $allowedTypes[$fieldName]));
            }

            // Cek MIME juga untuk double proteksi
            $allowedMimes = [
                'pdf'  => 'application/pdf',
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
