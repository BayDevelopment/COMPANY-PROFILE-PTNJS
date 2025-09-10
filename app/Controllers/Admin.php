<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AboutModel;
use App\Models\AdminModel;
use App\Models\ContactModel;
use App\Models\DirekturModel;
use App\Models\HomeFirstModel;
use App\Models\ModelCooperation;
use App\Models\ModelMisi;
use App\Models\ModelVisi;
use App\Models\ProjectModel;
use App\Models\ServicesModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;
use Ramsey\Uuid\Uuid;

class Admin extends BaseController
{
    protected $AdminModel;
    protected $HomeFirstModel;
    protected $ServicesModel;
    protected $AboutModel;
    protected $VisiModel;
    protected $MisiModel;
    protected $ProjectModel;
    protected $ContactModel;
    protected $CooperationModel;
    protected $direkturModel;
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->HomeFirstModel = new HomeFirstModel();
        $this->ServicesModel = new ServicesModel();
        $this->AboutModel = new AboutModel();
        $this->VisiModel = new ModelVisi();
        $this->MisiModel = new ModelMisi();
        $this->ProjectModel = new ProjectModel();
        $this->ContactModel = new ContactModel();
        $this->CooperationModel = new ModelCooperation();
        $this->direkturModel = new DirekturModel();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session = session();

        // Cek apakah admin sudah login
        if (!$session->has('logged_in')) {
            return redirect()->to('/auth/login')->with('sweet_error', 'Anda harus login terlebih dahulu!');
        }

        // Ambil jabatan admin dari session
        $AdminJabatan = $session->get('jabatan');
        $d_cooperation = $this->CooperationModel->findAll();

        // ===================== COOPERATION =====================
        $data_per_tahun = $this->CooperationModel
            ->select('YEAR(created_at) as tahun, ruang_lingkup_kerjasama, COUNT(*) as jumlah')
            ->groupBy('YEAR(created_at), ruang_lingkup_kerjasama')
            ->orderBy('tahun', 'ASC')
            ->findAll();

        $labels = [];
        $jenis  = [];
        $dataJenis = [];

        foreach ($data_per_tahun as $row) {
            $tahun = $row['tahun'];
            $jns   = $row['ruang_lingkup_kerjasama'];

            if (!in_array($tahun, $labels)) {
                $labels[] = $tahun;
            }
            if (!in_array($jns, $jenis)) {
                $jenis[] = $jns;
            }

            $dataJenis[$jns][$tahun] = $row['jumlah'];
        }

        $datasets = [];
        $colors = [
            'MOU' => 'rgba(54,162,235,0.6)',
            'PKS' => 'rgba(255,99,132,0.6)',
            'Default' => 'rgba(153,102,255,0.6)'
        ];

        foreach ($jenis as $jns) {
            $dataTahun = [];
            foreach ($labels as $tahun) {
                $dataTahun[] = $dataJenis[$jns][$tahun] ?? 0; // jika tidak ada data, isi 0
            }

            $datasets[] = [
                'label' => $jns,
                'data'  => $dataTahun,
                'fill'  => false,
                'borderColor' => $colors[$jns] ?? $colors['Default'],
                'tension' => 0.3
            ];
        }


        // ===================== SERVICES =====================
        $data_services = $this->ServicesModel
            ->select('title_services, COUNT(*) as jumlah')
            ->groupBy('title_services')
            ->findAll();

        $serviceLabels = [];
        $serviceData   = [];

        foreach ($data_services as $row) {
            $serviceLabels[] = $row['title_services']; // misal: Mechanical Working, Electrical, Civil
            $serviceData[]   = $row['jumlah'];
        }

        $data = [
            'title'           => 'Dashboard Admin',
            'sub_judul'       => 'Dashboard',
            'jabatan'         => $AdminJabatan,
            'd_cooperation'   => $d_cooperation,
            'list_direktur' =>  $this->direkturModel->orderBy('created_at', 'DESC')->findAll(),

            // Cooperation chart
            'chart_labels'    => json_encode($labels),
            'chart_data'      => json_encode($datasets),

            // Services chart
            'services_labels' => json_encode($serviceLabels),
            'services_data'   => json_encode($serviceData),
        ];

        return view('/admin/dashboard_admin', $data);
    }


    public function aksi_tambah_direktur()
    {
        // // hanya terima POST
        // if ($this->request->getMethod() !== 'post') {
        //     return redirect()->to(route_to('admin_direktur'));
        // }

        $validation = \Config\Services::validation();

        $rules = [
            'nama'    => 'required|min_length[3]|max_length[120]',
            'jabatan' => 'required|max_length[80]',
            'email'   => 'required|valid_email|max_length[100]',
            'no_hp'   => 'required|min_length[8]|max_length[20]|is_unique[tb_direktur.no_hp]',
            'verified_handphone' => 'permit_empty|in_list[0,1]',
        ];
        $messages = [
            'nama' => [
                'required'   => 'Nama wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
                'max_length' => 'Nama terlalu panjang.',
            ],
            'jabatan' => [
                'required'   => 'Jabatan wajib diisi.',
                'max_length' => 'Jabatan terlalu panjang.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'max_length'  => 'Email terlalu panjang.',
            ],
            'no_hp' => [
                'required'   => 'No. HP wajib diisi.',
                'min_length' => 'No. HP terlalu pendek.',
                'max_length' => 'No. HP terlalu panjang.',
                'is_unique'  => 'No. HP sudah terdaftar.',
            ],
            'verified_handphone' => [
                'in_list' => 'Nilai publikasi tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('form_errors', $validation->getErrors())
                ->with('open_modal', 'add'); // buka lagi modal tambah
        }

        $email  = trim((string)$this->request->getPost('email'));
        $data = [
            'nama'               => trim((string)$this->request->getPost('nama')),
            'jabatan'            => trim((string)$this->request->getPost('jabatan')),
            'email'              => $email,
            'no_hp'              => trim((string)$this->request->getPost('no_hp')),
            'verified_handphone' => $this->request->getPost('verified_handphone') ? 1 : 0,
        ];

        $direkturModel = new \App\Models\DirekturModel();
        $adminModel    = new \App\Models\AdminModel();

        // === CEK EMAIL UNIK LINTAS TABEL (tb_admin & tb_direktur) ===
        // (case-insensitive biasanya sudah ditangani collation MySQL, tapi ini aman di level aplikasi)
        if ($email !== '') {
            $existsInAdmin    = $adminModel->where('email', $email)->countAllResults() > 0;
            $existsInDirektur = $direkturModel->where('email', $email)->countAllResults() > 0;
            if ($existsInAdmin || $existsInDirektur) {
                return redirect()->back()
                    ->withInput()
                    ->with('form_errors', ['email' => 'Email sudah digunakan oleh akun lain. Gunakan email berbeda.'])
                    ->with('open_modal', 'add')
                    ->with('sweet_warning', 'Email sudah terpakai.');
            }
        }

        // === Business rule: hanya 1 direktur boleh dipublikasikan ===
        if ($data['verified_handphone'] === 1) {
            $already = $direkturModel->where('verified_handphone', 1)->countAllResults();
            if ($already > 0) {
                return redirect()->back()
                    ->withInput()
                    ->with('form_errors', ['verified_handphone' => 'Hanya satu direktur boleh dipublikasikan. Nonaktifkan yang lain terlebih dahulu.'])
                    ->with('open_modal', 'add')
                    ->with('sweet_warning', 'Gagal: nomor publik sudah ada.');
            }
        }

        // === Simpan ===
        if (!$direkturModel->insert($data)) {
            $modelErrors = $direkturModel->errors();
            return redirect()->back()
                ->withInput()
                ->with('form_errors', $modelErrors ?: ['db' => 'Gagal menyimpan data.'])
                ->with('open_modal', 'add');
        }

        return redirect()->back()->with('sweet_success', 'Direktur berhasil ditambahkan.');
    }


    public function toggle($id)
    {
        $id = (int) $id;
        $row = $this->direkturModel->find($id);
        if (!$row) {
            return redirect()->back()->with('sweet_error', 'Direktur tidak ditemukan.');
        }

        $isActive = (int)($row['verified_handphone'] ?? 0) === 1;

        if ($isActive) {
            // matikan
            $this->direkturModel->update($id, ['verified_handphone' => 0]);
            return redirect()->back()->with('sweet_success', 'Nomor dihapus dari publik.');
        }

        // mau diaktifkan → pastikan belum ada direktur lain yang aktif
        if ($this->direkturModel->hasAnotherActive($id)) {
            return redirect()->back()->with(
                'sweet_warning',
                'Gagal: Hanya satu direktur boleh dipublikasikan. Nonaktifkan yang lain dulu.'
            );
        }

        $this->direkturModel->update($id, ['verified_handphone' => 1]);
        return redirect()->back()->with('sweet_success', 'Nomor dipublikasikan.');
    }

    public function direkturUpdate($id)
    {
        $id  = (int) $id;
        $row = $this->direkturModel->find($id);
        if (!$row) {
            return redirect()->back()->with('sweet_error', 'Direktur tidak ditemukan.');
        }

        $rules = [
            'nama'   => 'required|min_length[3]|max_length[120]',
            'jabatan' => 'required|max_length[80]',
            'email'  => 'required|valid_email|max_length[100]',
            'no_hp'  => 'required|min_length[8]|max_length[20]',
            'verified_handphone' => 'permit_empty|in_list[0,1]',
        ];
        $messages = [
            'nama' => [
                'required'   => 'Nama wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
                'max_length' => 'Nama terlalu panjang.',
            ],
            'jabatan' => [
                'required'   => 'Jabatan wajib diisi.',
                'max_length' => 'Jabatan terlalu panjang.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'max_length'  => 'Email terlalu panjang.',
            ],
            'no_hp' => [
                'required'   => 'No. HP wajib diisi.',
                'min_length' => 'No. HP terlalu pendek.',
                'max_length' => 'No. HP terlalu panjang.',
            ],
            'verified_handphone' => [
                'in_list' => 'Nilai publikasi tidak valid.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            // ⛔ AMBIL ERROR DARI $this->validator, BUKAN $validation
            return redirect()->to(route_to('admin_direktur'))
                ->withInput()
                ->with('form_errors_edit', $this->validator->getErrors())
                ->with('open_modal_edit_id', $id);
        }

        // Ambil input & rapikan
        $nama  = trim((string) $this->request->getPost('nama'));
        $jab   = trim((string) $this->request->getPost('jabatan'));
        $email = trim((string) $this->request->getPost('email'));
        $no_hp = trim((string) $this->request->getPost('no_hp'));
        $pub   = $this->request->getPost('verified_handphone') ? 1 : 0;

        // 1) Email tidak boleh sama dengan admin manapun
        $adminModel   = new \App\Models\AdminModel();
        $existsAdmin  = $adminModel->where('email', $email)->first();
        if ($existsAdmin) {
            return redirect()->to(route_to('admin_direktur'))
                ->withInput()
                ->with('form_errors_edit', ['email' => 'Email sudah dipakai oleh Admin.'])
                ->with('open_modal_edit_id', $id);
        }

        // 2) Email tidak boleh sama dengan direktur lain (exclude diri sendiri)
        $existsDirEmail = $this->direkturModel
            ->where('email', $email)
            ->where('id_direktur !=', $id)
            ->first();
        if ($existsDirEmail) {
            return redirect()->to(route_to('admin_direktur'))
                ->withInput()
                ->with('form_errors_edit', ['email' => 'Email sudah dipakai oleh Direktur lain.'])
                ->with('open_modal_edit_id', $id);
        }

        // 3) No HP unik pada direktur lain (exclude diri sendiri)
        $existsDirHp = $this->direkturModel
            ->where('no_hp', $no_hp)
            ->where('id_direktur !=', $id)
            ->first();
        if ($existsDirHp) {
            return redirect()->to(route_to('admin_direktur'))
                ->withInput()
                ->with('form_errors_edit', ['no_hp' => 'No. HP sudah digunakan oleh Direktur lain.'])
                ->with('open_modal_edit_id', $id);
        }

        // 4) Hanya satu direktur boleh dipublikasikan
        if ($pub === 1) {
            $another = $this->direkturModel
                ->where('verified_handphone', 1)
                ->where('id_direktur !=', $id)
                ->first();
            if ($another) {
                return redirect()->to(route_to('admin_direktur'))
                    ->withInput()
                    ->with('form_errors_edit', [
                        'verified_handphone' => 'Hanya satu direktur boleh dipublikasikan. Nonaktifkan yang lain terlebih dahulu.'
                    ])
                    ->with('open_modal_edit_id', $id);
            }
        }

        // Payload update
        $payload = [
            'nama'               => $nama,
            'jabatan'            => $jab,
            'email'              => $email,
            'no_hp'              => $no_hp,
            'verified_handphone' => $pub,
        ];

        // Eksekusi update
        if (!$this->direkturModel->update($id, $payload)) {
            $errs = $this->direkturModel->errors() ?: ['db' => 'Gagal memperbarui data.'];
            return redirect()->to(route_to('admin_direktur'))
                ->withInput()
                ->with('form_errors_edit', $errs)
                ->with('open_modal_edit_id', $id);
        }

        return redirect()->back()->with('sweet_success', 'Direktur berhasil diperbarui.');
    }


    public function direkturDelete($id)
    {
        $id  = (int) $id;
        $row = $this->direkturModel->find($id);

        if (!$row) {
            return redirect()->back()->with('sweet_error', 'Direktur tidak ditemukan.');
        }

        try {
            // Hapus
            $this->direkturModel->delete($id);
        } catch (DatabaseException $e) {
            // Jika ada constraint/relasi, tampilkan pesan ramah
            return redirect()->back()->with('sweet_error', 'Data tidak dapat dihapus. Pastikan tidak terhubung dengan data lain.');
        }

        // Info tambahan jika yang dihapus sedang dipublikasikan
        $note = ((int)($row['verified_handphone'] ?? 0) === 1)
            ? ' (Nomor publik ikut dinonaktifkan)'
            : '';

        return redirect()->back()->with('sweet_success', 'Direktur berhasil dihapus.' . $note);
    }


    // profile admin

    public function profile()
    {
        $session = session();
        // memanggil data dari database berdasarkan session login
        $AdminJabatan = $session->get('jabatan');
        $AdminEmail = $session->get('email');
        $AdminStatus = $session->get('status');
        $AdminCreate = $session->get('created_at');
        $AdminUpdate = $session->get('updated_at');

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Profile Admin',
            'sub_judul' => 'Profile',
            'jabatan' => $AdminJabatan,
            'email' => $AdminEmail,
            'status' => $AdminStatus,
            'created' => formatTanggalIndonesia($AdminCreate),
            'updated' => formatTanggalIndonesia($AdminUpdate)
        ];
        return view('/admin/profile_admin', $data);
    }

    public function page_edit_profile()
    {
        $session = session();
        // memanggil data dari database berdasarkan session login
        $AdminJabatan = $session->get('jabatan');
        $AdminEmail = $session->get('email');
        $AdminStatus = $session->get('status');
        $AdminCreate = $session->get('created_at');
        $AdminUpdate = $session->get('updated_at');

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Profile Admin',
            'sub_judul' => 'Profile',
            'jabatan' => $AdminJabatan,
            'email' => $AdminEmail,
            'status' => $AdminStatus,
            'created' => formatTanggalIndonesia($AdminCreate),
            'updated' => formatTanggalIndonesia($AdminUpdate)
        ];

        return view('/admin/page_edit', $data);
    }

    public function edit_profile()
    {
        $session     = session();
        $AdminModel  = new AdminModel();

        // Ambil ID user dari session
        $adminId = $session->get('id_admin');
        $admin   = $AdminModel->find($adminId);

        if (!$admin) {
            return redirect()->back()->with('sweet_error', 'User tidak ditemukan.');
        }

        // Ambil input dan rapikan spasi
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password'); // biarkan apa adanya untuk hitung panjang

        // Data yang akan diperbarui
        $data = [];

        // Update email hanya jika diisi & berbeda
        if ($email !== '' && $email !== $admin['email']) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('sweet_error', 'Email tidak valid!');
            }

            // Cek email unik (bukan milik admin lain)
            $existingUser = $AdminModel->where('email', $email)
                ->where('id_admin !=', $adminId)
                ->first();
            if ($existingUser) {
                return redirect()->back()->with('sweet_error', 'Email sudah digunakan oleh pengguna lain!');
            }

            $data['email'] = $email;
        }

        // Update password hanya jika diisi
        if ($password !== '') {
            if (strlen($password) < 8) { // <- minimal 8
                return redirect()->back()->with('sweet_error', 'Password minimal 8 karakter!');
            }

            // Hash password (gunakan Argon2id seperti kode Anda)
            $data['password'] = password_hash($password, PASSWORD_ARGON2ID);
        }

        // Lakukan update hanya jika ada perubahan
        if (!empty($data)) {
            $data['updated_at'] = date('Y-m-d H:i:s');

            if ($AdminModel->set($data)->where('id_admin', $adminId)->update()) {
                // Perbarui session jika email diubah
                if (isset($data['email'])) {
                    $session->set('email', $data['email']);
                    $session->set('updated_at', $data['updated_at']);
                }

                return redirect()->back()->with('sweet_success', 'Profil berhasil diperbarui.');
            } else {
                return redirect()->back()->with('sweet_error', 'Terjadi kesalahan saat memperbarui profil.');
            }
        }

        return redirect()->back()->with('sweet_warning', 'Tidak ada perubahan yang dilakukan.');
    }



    public function detail_profile()
    {
        $session = session();
        // memanggil data dari database berdasarkan session login
        $AdminNama = $session->get('nama');
        $AdminEmail = $session->get('email');
        $AdminNoHp = $session->get('no_hp');
        $AdminJabatan = $session->get('jabatan');
        $AdminAlamat = $session->get('alamat');
        $AdminStatus = $session->get('status');
        $AdminCreate = $session->get('created_at');
        $AdminUpdate = $session->get('updated_at');

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Profile Admin',
            'sub_judul' => 'Detail Profile',
            'nama' => $AdminNama,
            'no_hp' => $AdminNoHp,
            'alamat' => $AdminAlamat,
            'jabatan' => $AdminJabatan,
            'email' => $AdminEmail,
            'status' => $AdminStatus,
            'created' => formatTanggalIndonesia($AdminCreate),
            'updated' => formatTanggalIndonesia($AdminUpdate)
        ];

        return view('/admin/detail_profile', $data);
    }

    public function edit_detail_aksi()
    {
        $session = session();
        $AdminModel = new AdminModel();

        // **Ambil ID user dari session**
        $adminId = $session->get('id_admin');
        $admin = $AdminModel->find($adminId);

        if (!$admin) {
            return redirect()->back()->with('sweet_error', 'User tidak ditemukan.');
        }

        // **Ambil input dari form & sanitasi data**
        $nama   = trim(htmlspecialchars($this->request->getPost('nama'), ENT_QUOTES, 'UTF-8'));
        $no_hp  = trim(filter_var($this->request->getPost('no_hp'), FILTER_SANITIZE_NUMBER_INT));
        $alamat = trim(htmlspecialchars($this->request->getPost('alamat'), ENT_QUOTES, 'UTF-8'));

        // **Cek perubahan data & siapkan array update**
        $data = [];

        if (!empty($nama) && $nama !== $admin['nama']) {
            $data['nama'] = $nama;
        }
        if (!empty($no_hp) && $no_hp !== $admin['no_hp']) {
            if (!preg_match('/^08[0-9]{8,13}$/', $no_hp)) {
                return redirect()->back()->with('sweet_error', 'Nomor HP harus diawali dengan 08 dan terdiri dari 10-15 angka!');
            }
            $data['no_hp'] = $no_hp;
        }
        if (!empty($alamat) && $alamat !== $admin['alamat']) {
            $data['alamat'] = $alamat;
        }

        // **Jika ada perubahan, tambahkan updated_at**
        if (!empty($data)) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        // **Lakukan update hanya jika ada perubahan**
        if (!empty($data)) {
            if ($AdminModel->update($adminId, $data)) {
                // **Perbarui session hanya untuk field yang diubah**
                foreach ($data as $key => $value) {
                    $session->set($key, $value);
                }

                return redirect()->back()->with('sweet_success', 'Profil berhasil diperbarui.');
            } else {
                return redirect()->back()->with('sweet_error', 'Terjadi kesalahan saat memperbarui profil.');
            }
        } else {
            return redirect()->back()->with('sweet_warning', 'Tidak ada perubahan yang dilakukan.');
        }
    }


    // home setings
    public function home_admin()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // untuk menampilkan semua data
        $homeFast_model = $this->HomeFirstModel->findAll();

        // untuk menghitung jumlah yang ada di table
        $jumlahFast_model = $this->HomeFirstModel->countAll();

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Setting Home',
            'jabatan' => $AdminJabatan,
            'jumlahFast_model' => $jumlahFast_model,
            'data_firstHome' => $homeFast_model
        ];
        return view('admin/pages/home_admin', $data);
    }

    public function page_tambah_home()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // untuk menampilkan semua data
        $homeFast_model = $this->HomeFirstModel->findAll();

        // untuk menghitung jumlah yang ada di table
        $jumlahFast_model = $this->HomeFirstModel->countAll();

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Tambah Data',
            'jabatan' => $AdminJabatan,
            'jumlahFast_model' => $jumlahFast_model,
            'data_firstHome' => $homeFast_model
        ];
        return view('admin/pages/tambah_page_home', $data);
    }
    public function aksi_tambah_data()
    {
        $session = session();
        $HomeFirstModel = new HomeFirstModel();

        // ===== Guard #1: batasi hanya 1 data di tabel =====
        if ($HomeFirstModel->countAll() >= 1) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'Data sudah terisi, tidak dapat menambahkan lebih dari 1 data!');
        }

        // Ambil & sanitasi input
        $judul_jumbotron  = trim((string) $this->request->getPost('judul_jumbotron'));
        $paragraft_jumbo  = trim((string) $this->request->getPost('paragraft_jumbo'));
        $judul_about      = trim((string) $this->request->getPost('judul_about'));
        $paragraft_about  = trim((string) $this->request->getPost('paragraft_about'));

        // Validasi required
        if ($judul_jumbotron === '' || $paragraft_jumbo === '' || $judul_about === '' || $paragraft_about === '') {
            return redirect()->back()->withInput()->with('sweet_error', 'Semua field wajib diisi!');
        }

        // Upload Gambar (wajib)
        $gambar = $this->request->getFile('image_about');
        if (!$gambar || !$gambar->isValid() || $gambar->hasMoved()) {
            return redirect()->back()->withInput()->with('sweet_error', 'Gambar wajib diunggah!');
        }

        // Validasi MIME & ekstensi (manual)
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $allowedMimes      = ['image/jpeg', 'image/png'];

        $fileExt  = strtolower((string) $gambar->getClientExtension());
        // Deteksi MIME berbasis konten file (lebih aman). Fallback ke getMimeType()
        $detMime  = null;
        if (function_exists('finfo_open')) {
            $f = finfo_open(FILEINFO_MIME_TYPE);
            if ($f) {
                $detMime = finfo_file($f, $gambar->getTempName());
                finfo_close($f);
            }
        }
        $mimeType = $detMime ?: ($gambar->getMimeType() ?: $gambar->getClientMimeType());

        if (!in_array($fileExt, $allowedExtensions, true) || !in_array($mimeType, $allowedMimes, true)) {
            return redirect()->back()->withInput()->with('sweet_error', 'Format gambar harus JPG, JPEG, atau PNG!');
        }

        // Validasi ukuran ≤ 1MB
        if ($gambar->getSize() > 1024 * 1024) {
            return redirect()->back()->withInput()->with('sweet_error', 'Ukuran gambar maksimal 1MB!');
        }

        // ===== Guard #2: cek lagi sebelum benar-benar insert (kurangi race condition) =====
        if ($HomeFirstModel->countAll() >= 1) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'Data sudah terisi, tidak dapat menambahkan lebih dari 1 data!');
        }

        // Siapkan folder upload (public)
        $uploadPath = ROOTPATH . 'public/assets/uploads';
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0775, true) && !is_dir($uploadPath)) {
                return redirect()->back()->withInput()->with('sweet_error', 'Gagal membuat folder upload.');
            }
        }

        // Pindahkan file
        $newName = $gambar->getRandomName();
        $gambar->move($uploadPath, $newName);

        // Data simpan
        $data = [
            'judul_jumbotron' => $judul_jumbotron,
            'paragraft_jumbo' => $paragraft_jumbo,
            'judul_about'     => $judul_about,
            'paragraft_about' => $paragraft_about,
            'image_about'     => $newName,
            'created_at'      => date('Y-m-d H:i:s'),
        ];

        try {
            // ===== Guard #3 (opsional, paling ketat): cek tepat sebelum insert =====
            if ($HomeFirstModel->countAll() >= 1) {
                // Hapus file yang terlanjur dipindah
                @unlink($uploadPath . DIRECTORY_SEPARATOR . $newName);
                return redirect()->back()
                    ->withInput()
                    ->with('sweet_error', 'Data sudah terisi, tidak dapat menambahkan lebih dari 1 data!');
            }

            if ($HomeFirstModel->insert($data)) {
                return redirect()->to(base_url('admin/pages/home'))
                    ->with('sweet_success', 'Data berhasil ditambahkan.');
            }

            // Jika insert gagal
            @unlink($uploadPath . DIRECTORY_SEPARATOR . $newName);
            return redirect()->back()->withInput()->with('sweet_error', 'Terjadi kesalahan saat menyimpan data.');
        } catch (\Throwable $e) {
            // Bersihkan file jika gagal
            @unlink($uploadPath . DIRECTORY_SEPARATOR . $newName);
            log_message('error', 'Gagal insert data HomeFirst: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('sweet_error', 'Error sistem! Hubungi admin.');
        }
    }



    public function page_edit_home_first()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // untuk menampilkan semua data
        $homeFast_model = $this->HomeFirstModel->findAll();

        // untuk menghitung jumlah yang ada di table
        $jumlahFast_model = $this->HomeFirstModel->countAll();

        $data = [
            'title' => 'Edit Layout | Home',
            'sub_judul' => 'Edit Layout Home',
            'jabatan' => $AdminJabatan,
            'jumlahFast_model' => $jumlahFast_model,
            'data_firstHome' => $homeFast_model
        ];
        return view('admin/pages/edit_page_home', $data);
    }

    public function aksi_edit_home_first($id)
    {
        $session = session();
        $HomeFirstModel = new HomeFirstModel();

        // 🔒 Validasi ID hanya angka
        if (!ctype_digit((string)$id)) {
            return redirect()->back()->with('sweet_error', 'ID tidak valid!');
        }

        // Ambil data berdasarkan ID
        $homeFirst = $HomeFirstModel->find($id);
        if (!$homeFirst) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Ambil input dari form + sanitasi
        $judul_jumbotron = trim($this->request->getPost('judul_jumbotron'));
        $paragraft_jumbo = trim($this->request->getPost('paragraft_jumbo'));
        $judul_about    = trim($this->request->getPost('judul_about'));
        $paragraft_about = trim($this->request->getPost('paragraft_about'));

        // Validasi jika ada field kosong
        if (empty($judul_jumbotron) || empty($paragraft_jumbo) || empty($judul_about) || empty($paragraft_about)) {
            return redirect()->back()->with('sweet_error', 'Semua field wajib diisi!');
        }

        // Siapkan data update hanya jika berubah
        $data = [];
        if ($judul_jumbotron !== $homeFirst['judul_jumbotron']) {
            $data['judul_jumbotron'] = $judul_jumbotron;
        }
        if ($paragraft_jumbo !== $homeFirst['paragraft_jumbo']) {
            $data['paragraft_jumbo'] = $paragraft_jumbo;
        }
        if ($judul_about !== $homeFirst['judul_about']) {
            $data['judul_about'] = $judul_about;
        }
        if ($paragraft_about !== $homeFirst['paragraft_about']) {
            $data['paragraft_about'] = $paragraft_about;
        }

        // Jika data baru dibuat, tambahkan created_at
        if (empty($homeFirst['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        // 🔒 Upload Gambar (jika ada)
        $gambar = $this->request->getFile('image_about');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $allowedExtensions = ['png', 'jpg', 'jpeg'];
            $allowedMimeTypes  = ['image/png', 'image/jpeg'];

            $ext = strtolower($gambar->getClientExtension());
            $mimeType = $gambar->getMimeType();

            // Validasi extension + MIME
            if (!in_array($ext, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
                return redirect()->back()->with('sweet_error', 'Format gambar harus PNG atau JPG!');
            }

            // Validasi ukuran max 1MB
            if ($gambar->getSize() > 1024 * 1024) {
                return redirect()->back()->with('sweet_error', 'Ukuran gambar maksimal 1MB!');
            }

            // Buat nama file unik & pindahkan
            $newName = time() . '_' . bin2hex(random_bytes(5)) . '.' . $ext;
            $gambar->move(FCPATH . 'assets/uploads/', $newName);

            // Hapus gambar lama dengan keamanan
            if (!empty($homeFirst['image_about'])) {
                $oldImage = FCPATH . 'assets/uploads/' . basename($homeFirst['image_about']);
                if (is_file($oldImage)) {
                    @unlink($oldImage);
                }
            }

            $data['image_about'] = $newName;
        }

        // Jika ada perubahan, update + updated_at
        if (!empty($data)) {
            $data['updated_at'] = date('Y-m-d H:i:s');

            try {
                if ($HomeFirstModel->update($id, $data)) {
                    return redirect()->to(base_url('admin/pages/home'))
                        ->with('sweet_success', 'Data berhasil ditambahkan.');
                } else {
                    return redirect()->back()->with('sweet_error', 'Terjadi kesalahan saat update.');
                }
            } catch (\Exception $e) {
                log_message('error', 'Update HomeFirst Error: ' . $e->getMessage());
                return redirect()->back()->with('sweet_error', 'Terjadi error internal.');
            }
        }

        return redirect()->back()->with('sweet_warning', 'Tidak ada perubahan yang dilakukan.');
    }



    public function aksi_hapus_home_first($id)
    {
        $session = session();
        $HomeFirstModel = new HomeFirstModel();

        // **Ambil data berdasarkan ID**
        $homeFirst = $HomeFirstModel->find($id);

        if (!$homeFirst) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan!');
        }

        // **Hapus gambar jika ada**
        if (!empty($homeFirst['image_about'])) {
            $gambarPath = FCPATH . 'assets/uploads/' . $homeFirst['image_about']; // Path absolut

            // mengecek gambar dengan log message
            if (file_exists($gambarPath)) {
                if (unlink($gambarPath)) {
                    log_message('info', 'File gambar berhasil dihapus: ' . $gambarPath);
                } else {
                    log_message('error', 'Gagal menghapus file gambar: ' . $gambarPath);
                }
            } else {
                log_message('error', 'File gambar tidak ditemukan: ' . $gambarPath);
            }
        }

        // **Hapus data dari database**
        if ($HomeFirstModel->delete($id)) {
            return redirect()->back()->with('sweet_success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('sweet_error', 'Terjadi kesalahan saat menghapus data!');
        }
    }


    // services settings
    public function services_admin()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // Ambil parameter filter dari GET
        $status = $this->request->getGet('status');
        $bulan  = $this->request->getGet('bulan');
        $tahun  = $this->request->getGet('tahun');

        // Panggil model dengan filter
        $d_services_model = $this->ServicesModel->getFilteredServices($status, $bulan, $tahun);

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Setting Services',
            'jabatan' => $AdminJabatan,
            'd_services_model' => $d_services_model,
            'count_services' => count($d_services_model),
            'filter' => [
                'status' => $status,
                'bulan'  => $bulan,
                'tahun'  => $tahun
            ]
        ];
        return view('admin/pages/services_admin', $data);
    }


    public function detail_services($slug)
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // Ambil data layanan berdasarkan slug
        $data_service = $this->ServicesModel->where('slug_services', $slug)->first();

        // Jika data tidak ditemukan, redirect ke halaman daftar layanan dengan pesan error
        if (!$data_service) {
            return redirect()->to('admin/pages/services')->with('sweet_error', 'Layanan tidak ditemukan.');
        }

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Detail Services',
            'jabatan' => $AdminJabatan,
            'slug_services' => $data_service, // Mengirim data layanan yang ditemukan
            'd_services_model' => $this->ServicesModel->getStatusServices(),
            'count_d_services' => $this->ServicesModel->countAllDataServices()
        ];

        return view('admin/pages/detail_services', $data);
    }

    public function tambah_services()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Tambah Services',
            'jabatan' => $AdminJabatan
        ];
        return view('admin/pages/tambah_services', $data);
    }

    public function aksi_tambah_services()
    {
        // **Ambil input & buat slug**
        $title = esc($this->request->getPost('title_services'));
        $deskripsi = esc($this->request->getPost('deskripsi'));

        do {
            $uuid = Uuid::uuid4()->toString();
            $slug = url_title($title . '-' . $uuid, '-', true);
            $slugExists = $this->ServicesModel->where('slug_services', $slug)->first();
        } while ($slugExists);

        // **Upload Gambar**
        $gambar = $this->request->getFile('image_services');

        // **Validasi Input Secara Manual**
        if (empty($title) || strlen($title) < 3) {
            return redirect()->back()->withInput()->with('sweet_error', 'Judul minimal 3 karakter.');
        }

        if (empty($deskripsi) || strlen($deskripsi) < 10) {
            return redirect()->back()->withInput()->with('sweet_error', 'Deskripsi minimal 10 karakter.');
        }

        if (!$gambar || !$gambar->isValid() || $gambar->hasMoved()) {
            return redirect()->back()->withInput()->with('sweet_error', 'Gambar wajib diunggah!');
        }

        // **Validasi ekstensi file & MIME type**
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower($gambar->getClientExtension()); // Convert ke lowercase
        $mimeType = $gambar->getMimeType();
        $allowedMimeTypes = ['image/jpeg', 'image/png'];

        if (!in_array($fileExtension, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
            return redirect()->back()->withInput()->with('sweet_error', 'Format gambar harus JPG, JPEG, atau PNG!');
        }

        // **Validasi ukuran file (maksimal 1MB)**
        if ($gambar->getSize() > 1024 * 1024) { // 1MB
            return redirect()->back()->withInput()->with('sweet_error', 'Ukuran gambar maksimal 1MB!');
        }

        // **Buat nama file unik & pindahkan ke folder uploads/**
        $newName = $gambar->getRandomName();
        $gambar->move(FCPATH . 'assets/uploads/', $newName);

        // **Data untuk database**
        $data = [
            'title_services' => $title,
            'slug_services' => $slug,
            'deskripsi' => $deskripsi,
            'image_services' => $newName,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // **Simpan ke database**
        if ($this->ServicesModel->insert($data)) {
            return redirect()->to(base_url('admin/pages/services'))->with('sweet_success', 'Data berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('sweet_error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
    public function aksi_hapus_detail_services($id)
    {
        $session = session();
        $ServicesModel = new ServicesModel();

        // **Validasi ID**
        if (!is_numeric($id)) {
            return redirect()->back()->with('sweet_error', 'ID tidak valid.');
        }

        // **Cek apakah data dengan ID tersebut ada**
        $service = $ServicesModel->find($id);
        if (!$service) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan.');
        }

        // **Hapus gambar terkait jika ada**
        if (!empty($service['image_services'])) {
            $imagePath = realpath('assets/uploads/' . $service['image_services']);
            $uploadDir = realpath('assets/uploads/'); // Pastikan dalam direktori yang diizinkan

            if ($imagePath && strpos($imagePath, $uploadDir) === 0 && file_exists($imagePath)) {
                @unlink($imagePath); // Gunakan @unlink untuk menghindari error jika file berubah
            }
        }

        // **Hapus data dari database**
        if ($ServicesModel->delete($id)) {
            return redirect()->back()->with('sweet_success', 'Data berhasil dihapus.');
        } else {
            return redirect()->back()->with('sweet_error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function page_edit_services($slug)
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // Ambil data berdasarkan slug
        $d_services = $this->ServicesModel->where('slug_services', $slug)->first();

        if (!$d_services) {
            return redirect()->to(base_url('admin/pages/services'))->with('sweet_error', 'Data tidak ditemukan.');
        }


        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Edit Services',
            'jabatan' => $AdminJabatan,
            'service' => $d_services // Kirim data service ke view
        ];

        return view('admin/pages/edit_services', $data);
    }

    public function aksi_edit_services($slug)
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // Ambil data berdasarkan slug
        $service = $this->ServicesModel->where('slug_services', $slug)->first();

        if (!$service) {
            return redirect()->to(base_url('admin/pages/services'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Ambil input dari form dengan sanitasi tambahan
        $title = strip_tags(esc($this->request->getPost('title_services')));
        $deskripsi = strip_tags(esc($this->request->getPost('deskripsi')));
        $gambar = $this->request->getFile('image_services');

        // Buat slug baru berdasarkan title yang diedit
        do {
            $uuid = Uuid::uuid4()->toString();
            $newSlug = url_title($title . '-' . $uuid, '-', true);
            $slugExists = $this->ServicesModel->where('slug_services', $newSlug)->first();
        } while ($slugExists);

        // Validasi form tidak boleh kosong
        if (empty($title) || strlen($title) < 3) {
            return redirect()->back()->withInput()->with('sweet_error', 'Judul minimal 3 karakter.');
        }
        if (empty($deskripsi) || strlen($deskripsi) < 10) {
            return redirect()->back()->withInput()->with('sweet_error', 'Deskripsi minimal 10 karakter.');
        }

        // Gunakan gambar lama jika tidak ada gambar baru
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Validasi ekstensi file & MIME type
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower($gambar->getClientExtension());
            $mimeType = $gambar->getMimeType();
            $allowedMimeTypes = ['image/jpeg', 'image/png'];

            if (!in_array($fileExtension, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
                return redirect()->back()->withInput()->with('sweet_error', 'Format gambar harus JPG, JPEG, atau PNG!');
            }

            // Validasi ukuran file (maksimal 1MB)
            if ($gambar->getSize() > 1024 * 1024) {
                return redirect()->back()->withInput()->with('sweet_error', 'Ukuran gambar maksimal 1MB!');
            }

            // Hapus gambar lama jika ada dan file benar-benar tersedia
            $oldImagePath = FCPATH . 'assets/uploads/' . $service['image_services'];
            if (!empty($service['image_services']) && file_exists($oldImagePath) && is_file($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Simpan gambar baru
            $newName = $gambar->getRandomName();
            $gambar->move(FCPATH . 'assets/uploads/', $newName);
        } else {
            $newName = $service['image_services']; // Gunakan gambar lama jika tidak ada perubahan
        }

        // Update data di database berdasarkan slug
        $data = [
            'title_services' => $title,
            'slug_services' => $newSlug, // Update slug
            'deskripsi' => $deskripsi,
            'image_services' => $newName
        ];

        if ($this->ServicesModel->where('slug_services', $slug)->set($data)->update()) {
            return redirect()->to(base_url('admin/pages/services'))->with('sweet_success', 'Data berhasil diperbarui.');
            // return redirect()->back()->with('sweet_success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('sweet_error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function page_about()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $AboutModel = $this->AboutModel->findAll();
        $jum_AboutModel = count($AboutModel);
        $d_visi = $this->VisiModel->findAll();
        $d_misi = $this->MisiModel->findAll();


        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'About',
            'page_title' => 'About',
            'jabatan' => $AdminJabatan,
            'd_about' => $AboutModel,
            'count_d_about' => $jum_AboutModel,
            'd_visi' => $d_visi,
            'd_misi' => $d_misi,
        ];

        return view('admin/pages/about_admin', $data);
    }
    public function page_about_tambah()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Tambah About',
            'jabatan' => $AdminJabatan
        ];

        return view('admin/pages/tambah_about', $data);
    }
    public function aksi_tambah_about()
    {
        // **Cek apakah sudah ada data di database**
        $existingData = $this->AboutModel->countAll();

        if ($existingData >= 1) {
            return redirect()->back()->with('sweet_error', 'Hanya boleh menambahkan 1 data About.');
        }

        // **Ambil input**
        $judul = trim($this->request->getPost('judul_about'));
        $title = trim($this->request->getPost('title_about'));

        // **Validasi panjang input (minimal 10 karakter)**
        if (empty($judul) || strlen($judul) < 10) {
            return redirect()->back()->withInput()->with('sweet_error', 'Judul minimal 10 karakter.');
        }

        if (empty($title) || strlen($title) < 10) {
            return redirect()->back()->withInput()->with('sweet_error', 'Title minimal 10 karakter.');
        }

        // **Upload Gambar**
        $gambar = $this->request->getFile('image_about');

        if (!$gambar || !$gambar->isValid() || $gambar->hasMoved()) {
            return redirect()->back()->withInput()->with('sweet_error', 'Gambar wajib diunggah!');
        }

        // **Validasi ekstensi file & MIME type**
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower($gambar->getClientExtension());
        $mimeType = $gambar->getMimeType();
        $allowedMimeTypes = ['image/jpeg', 'image/png'];

        if (!in_array($fileExtension, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
            return redirect()->back()->withInput()->with('sweet_error', 'Format gambar harus JPG, JPEG, atau PNG!');
        }

        // **Validasi ukuran file (maksimal 1MB)**
        if ($gambar->getSize() > 1024 * 1024) { // 1MB
            return redirect()->back()->withInput()->with('sweet_error', 'Ukuran gambar maksimal 1MB!');
        }

        // **Buat nama file unik & pindahkan ke folder uploads/about/**
        $newName = $gambar->getRandomName();
        $gambar->move(FCPATH . 'assets/uploads', $newName);

        // **Data untuk database**
        $data = [
            'judul_about' => $judul,
            'title_about' => $title,
            'image_about' => $newName,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // **Simpan ke database**
        if ($this->AboutModel->insert($data)) {
            return redirect()->back()->with('sweet_success', 'Data berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('sweet_error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
    public function aksi_hapus_about($id)
    {
        $session = session();

        // **Ambil data berdasarkan ID**
        $AboutModel = $this->AboutModel->find($id);

        if (!$AboutModel) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan!');
        }

        // **Hapus gambar jika ada**
        if (!empty($AboutModel['image_about'])) {
            $gambarPath = FCPATH . 'assets/uploads/' . $AboutModel['image_about']; // Path absolut

            // mengecek gambar dengan log message
            if (file_exists($gambarPath)) {
                if (unlink($gambarPath)) {
                    log_message('info', 'File gambar berhasil dihapus: ' . $gambarPath);
                } else {
                    log_message('error', 'Gagal menghapus file gambar: ' . $gambarPath);
                }
            } else {
                log_message('error', 'File gambar tidak ditemukan: ' . $gambarPath);
            }
        }

        // **Hapus data dari database**
        if ($this->AboutModel->delete($id)) {
            return redirect()->back()->with('sweet_success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('sweet_error', 'Terjadi kesalahan saat menghapus data!');
        }
    }

    public function page_edit_about($id)
    {
        $session = session();
        $AboutModel = $this->AboutModel->find($id); // Perbaikan findAll() menjadi find()

        if (!$AboutModel) {
            return redirect()->to('/admin/pages/about')->with('sweet_error', 'Data tidak ditemukan');
        }

        $AdminJabatan = $session->get('jabatan');

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Edit About',
            'jabatan' => $AdminJabatan,
            'd_about_id' => $AboutModel
        ];

        return view('admin/pages/edit_about', $data);
    }

    public function aksi_edit_about($id)
    {
        // **Ambil data lama berdasarkan ID**
        $about = $this->AboutModel->find($id);

        if (!$about) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan.');
        }

        // **Ambil input dari form**
        $judul = trim($this->request->getPost('judul_about'));
        $title = trim($this->request->getPost('title_about'));

        // **Validasi panjang input (minimal 10 karakter)**
        if (empty($judul) || strlen($judul) < 10) {
            return redirect()->back()->withInput()->with('sweet_error', 'Judul minimal 10 karakter.');
        }

        if (empty($title) || strlen($title) < 10) {
            return redirect()->back()->withInput()->with('sweet_error', 'Title minimal 10 karakter.');
        }

        // **Upload Gambar (opsional, hanya jika user mengunggah gambar baru)**
        $gambar = $this->request->getFile('image_about');

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // **Validasi ekstensi file & MIME type**
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower($gambar->getClientExtension());
            $mimeType = $gambar->getMimeType();
            $allowedMimeTypes = ['image/jpeg', 'image/png'];

            if (!in_array($fileExtension, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
                return redirect()->back()->withInput()->with('sweet_error', 'Format gambar harus JPG, JPEG, atau PNG!');
            }

            // **Validasi ukuran file (maksimal 1MB)**
            if ($gambar->getSize() > 1024 * 1024) { // 1MB
                return redirect()->back()->withInput()->with('sweet_error', 'Ukuran gambar maksimal 1MB!');
            }

            // **Hapus gambar lama jika ada**
            if ($about['image_about'] && file_exists(FCPATH . 'assets/uploads/' . $about['image_about'])) {
                unlink(FCPATH . 'assets/uploads/' . $about['image_about']);
            }

            // **Buat nama file unik & pindahkan ke folder uploads/about/**
            $newName = $gambar->getRandomName();
            $gambar->move(FCPATH . 'assets/uploads', $newName);
        } else {
            // **Jika tidak ada gambar baru, gunakan gambar lama**
            $newName = $about['image_about'];
        }

        // **Data yang akan diperbarui**
        $data = [
            'judul_about' => $judul,
            'title_about' => $title,
            'image_about' => $newName,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // **Update data di database**
        if ($this->AboutModel->update($id, $data)) {
            return redirect()->to(base_url('admin/pages/about'))
                ->with('sweet_success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('sweet_error', 'Terjadi kesalahan saat mengupdate data.');
        }
    }

    // visi misi
    public function page_visimisi()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');
        $d_visi = $this->VisiModel->findAll();
        $d_misi = $this->MisiModel->findAll();

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Visi & Misi',
            'jabatan' => $AdminJabatan,
            'd_visi' => $d_visi,
            'd_misi' => $d_misi,
            'no_visi' => 1,
            'no_misi' => 1
        ];

        return view('admin/pages/page_visimisi', $data);
    }
    public function page_tambah_visi()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Tambah Visi',
            'jabatan' => $AdminJabatan
        ];

        return view('admin/pages/tambah_visi', $data);
    }

    public function aksi_page_tambah_visi()
    {
        // Ambil input dari form secara aman
        $visi = trim(htmlspecialchars(strip_tags($this->request->getVar('visi'))));

        // Cek apakah visi kosong
        if (empty($visi)) {
            return redirect()->back()->with('sweet_error', 'Visi tidak boleh kosong!');
        }

        // Hitung jumlah kata dalam visi
        $jumlahKata = str_word_count(preg_replace('/\s+/', ' ', $visi));

        if ($jumlahKata < 10) {
            return redirect()->back()->with('sweet_error', 'Visi minimal harus 10 kata! Saat ini hanya ' . $jumlahKata . ' kata.');
        }

        // Jika validasi sukses, simpan ke database
        $this->VisiModel->insert([
            'visi' => $visi
        ]);

        return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_success', 'Visi berhasil ditambahkan!');
    }


    public function page_edit_visi($id)
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $d_visi = $this->VisiModel->find($id);
        if (!$d_visi) {
            return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Edit Visi',
            'jabatan' => $AdminJabatan,
            'd_visi' => $d_visi
        ];

        return view('admin/pages/edit_visi', $data);
    }

    public function aksi_page_edit_visi($id)
    {
        // Cek apakah ID yang diberikan ada dalam database
        $edit_visi = $this->VisiModel->find($id);

        if (!$edit_visi) {
            return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Ambil input secara aman
        $visi = trim(strip_tags($this->request->getVar('visi')));

        // Pastikan visi tidak kosong
        if (empty($visi)) {
            return redirect()->back()->with('sweet_error', 'Visi tidak boleh kosong!');
        }

        // Hitung jumlah kata dalam visi (hindari spasi berlebih)
        $jumlahKata = str_word_count(preg_replace('/\s+/', ' ', $visi));

        if ($jumlahKata < 10) {
            return redirect()->back()->with('sweet_error', 'Visi minimal harus 10 kata! Saat ini hanya ' . $jumlahKata . ' kata.');
        }

        // Update data ke database
        $this->VisiModel->update($id, [
            'visi' => $visi
        ]);

        return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_success', 'Visi berhasil diperbarui!');
    }


    public function hapus_visi($id)
    {
        // Cek apakah ID visi ada di database
        $visi = $this->VisiModel->find($id);

        if (!$visi) {
            return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Hapus visi dari database
        $this->VisiModel->delete($id);

        return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_success', 'Visi berhasil dihapus!');
    }




    public function page_tambah_misi($id)
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $d_visi = $this->VisiModel->find($id);

        if (!$d_visi) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Tambah Misi',
            'jabatan' => $AdminJabatan,
            'd_visi' => $d_visi,
            'no_visi' => 1
        ];

        return view('admin/pages/tambah_misi', $data);
    }

    public function aksi_page_tambah_misi()
    {
        // Ambil input dari form
        $id_visi = $this->request->getPost('id_visi');
        $misi = trim(strip_tags($this->request->getPost('misi')));

        // Validasi manual: ID Visi harus berupa angka
        if (!ctype_digit($id_visi)) {
            return redirect()->back()->with('sweet_error', 'ID Visi harus berupa angka!');
        }

        // Pastikan ID Visi ada di database
        $visi = $this->VisiModel->find($id_visi);
        if (!$visi) {
            return redirect()->back()->with('sweet_error', 'ID Visi tidak ditemukan!');
        }

        // Pastikan misi tidak kosong
        if (empty($misi)) {
            return redirect()->back()->with('sweet_error', 'Misi tidak boleh kosong!');
        }

        // Hitung jumlah kata dalam misi
        $jumlahKata = str_word_count($misi);
        if ($jumlahKata < 10) {
            return redirect()->back()->with('sweet_error', 'Misi minimal harus 10 kata! Saat ini hanya ' . $jumlahKata . ' kata.');
        }

        // Jika validasi sukses, simpan ke database
        $this->MisiModel->insert([
            'id_visi' => $id_visi,
            'misi'    => $misi
        ]);

        return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_success', 'Misi berhasil ditambahkan!');
    }

    public function page_edit_misi($id)
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $d_misi = $this->MisiModel->find($id);
        if (!$d_misi) {
            return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Edit Visi',
            'jabatan' => $AdminJabatan,
            'd_misi' => $d_misi
        ];

        return view('admin/pages/edit_misi', $data);
    }

    public function aksi_page_edit_misi($id)
    {
        // Cek apakah ID yang diberikan ada dalam database
        $edit_misi = $this->MisiModel->find($id);

        if (!$edit_misi) {
            return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Ambil input secara aman
        $misi = trim(strip_tags($this->request->getVar('misi')));

        // Pastikan visi tidak kosong
        if (empty($misi)) {
            return redirect()->back()->with('sweet_error', 'Misi tidak boleh kosong!');
        }

        // Hitung jumlah kata dalam visi (hindari spasi berlebih)
        $jumlahKata = str_word_count(preg_replace('/\s+/', ' ', $misi));

        if ($jumlahKata < 10) {
            return redirect()->back()->with('sweet_error', 'Misi minimal harus 10 kata! Saat ini hanya ' . $jumlahKata . ' kata.');
        }

        // Update data ke database
        $this->MisiModel->update($id, [
            'misi' => $misi
        ]);

        return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_success', 'Misi berhasil diperbarui!');
    }

    public function hapus_misi($id)
    {
        $misi = $this->MisiModel->find($id);

        if (!$misi) {
            return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        $this->MisiModel->delete($id);

        return redirect()->to(base_url('admin/pages/about/visimisi'))->with('sweet_success', 'Misi berhasil dihapus!');
    }

    // Services

    public function page_projects()
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        // Ambil filter dari GET request
        $status = $this->request->getGet('status');
        $tahun  = $this->request->getGet('tahun');
        $mulai  = $this->request->getGet('mulai');
        $selesai = $this->request->getGet('selesai');

        // Query builder dasar
        $builder = $this->ProjectModel;

        // Filter status
        if (!empty($status)) {
            $builder = $builder->where('status', $status);
        }

        // Filter tahun
        if (!empty($tahun)) {
            $builder = $builder->where('YEAR(created_at)', $tahun);
        }

        // Filter tanggal mulai & selesai
        if (!empty($mulai) && !empty($selesai)) {
            $builder = $builder->where("DATE(created_at) >=", $mulai)
                ->where("DATE(created_at) <=", $selesai);
        }

        // Ambil hasil setelah difilter
        $d_project = $builder->findAll();

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Project',
            'jabatan' => $AdminJabatan,
            'count_projects' => count($d_project),
            'd_project' => $d_project,
            'filter' => [
                'status' => $status,
                'tahun'  => $tahun,
                'mulai'  => $mulai,
                'selesai' => $selesai
            ]
        ];

        return view('admin/pages/project_admin', $data);
    }


    public function page_tambah_project()
    {
        $session = session();

        $AdminJabatan = $session->get('jabatan');
        $count_project = count($this->ProjectModel->findAll());
        $d_project = $this->ProjectModel->findAll();

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Tambah Project',
            'jabatan' => $AdminJabatan,
            'count_projects' => $count_project,
            'd_project' => $d_project
        ];

        return view('admin/pages/tambah_project', $data);
    }
    public function aksi_tambah_project()
    {
        $validation = \Config\Services::validation();

        $validationRules = [
            'gambar' => [
                'rules'  => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,1024]',
                'errors' => [
                    'uploaded'  => 'Gambar wajib diunggah.',
                    'is_image'  => 'File yang diunggah harus berupa gambar.',
                    'mime_in'   => 'Format gambar yang diperbolehkan hanya JPG, JPEG, atau PNG.',
                    'max_size'  => 'Ukuran gambar tidak boleh lebih dari 1 MB.'
                ]
            ],
            'name' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Nama proyek wajib diisi.',
                    'max_length' => 'Nama proyek maksimal 100 karakter.'
                ]
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi proyek wajib diisi.'
                ]
            ],
            'start_date' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required'   => 'Tanggal mulai wajib diisi.',
                    'valid_date' => 'Format tanggal tidak valid.'
                ]
            ],
            'end_date' => [
                // opsional: boleh kosong
                'rules' => 'permit_empty|valid_date',
                'errors' => [
                    'valid_date' => 'Format tanggal tidak valid.'
                ]
            ],
            'status' => [
                'rules' => 'required|in_list[pending,in_progress,completed]',
                'errors' => [
                    'required' => 'Status proyek wajib dipilih.',
                    'in_list'  => 'Status proyek tidak valid.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            $errors = $validation->getErrors();

            // jika error karena size, kirim alert khusus
            if (isset($errors['gambar']) && stripos($errors['gambar'], '1 MB') !== false) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $errors)
                    ->with('sweet_error', 'Ukuran gambar tidak boleh lebih dari 1 MB.');
            }

            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // Ambil file & cek valid
        $fileGambar = $this->request->getFile('gambar');
        if (!$fileGambar || !$fileGambar->isValid()) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'File gambar tidak valid.');
        }

        // Defensive size check (> 1MB = 1024*1024)
        if ($fileGambar->getSize() > 1024 * 1024) {
            return redirect()->back()
                ->withInput()
                ->with('sweet_error', 'Ukuran gambar melebihi 1 MB. Silakan kompres atau pilih file lain.');
        }

        // Folder tujuan di public (agar bisa diakses via URL)
        $uploadPath = ROOTPATH . 'public/assets/uploads';
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0775, true) && !is_dir($uploadPath)) {
                return redirect()->back()
                    ->withInput()
                    ->with('sweet_error', 'Gagal membuat folder upload.');
            }
        }

        // Pindahkan file
        $gambarNama = $fileGambar->getRandomName();
        if (!$fileGambar->hasMoved()) {
            $fileGambar->move($uploadPath, $gambarNama);
        }

        // Status default pending jika kosong
        $status = $this->request->getPost('status') ?? 'pending';

        // Simpan data
        $data = [
            'gambar'      => $gambarNama, // simpan nama file saja
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date') ?: null, // null jika kosong
            'status'      => $status,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $this->ProjectModel->insert($data);

        return redirect()->to(base_url('admin/pages/project'))
            ->with('sweet_success', 'Project berhasil ditambahkan!');
    }




    public function page_edit_project($id)
    {
        $session = session();
        $AdminJabatan = $session->get('jabatan');

        $d_project = $this->ProjectModel->find($id);
        if (!$d_project) {
            return redirect()->to(base_url('admin/pages/project'))->with('sweet_error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Edit Project',
            'jabatan' => $AdminJabatan,
            'data_project' => $d_project
        ];
        return view('admin/pages/edit_project', $data);
    }

    public function aksi_edit_project($id)
    {
        // 1) Rules: gambar opsional saat edit
        $rules = [
            'gambar' => [
                'rules'  => 'permit_empty|is_image[gambar]|mime_in[gambar,image/jpeg,image/jpg,image/png]|max_size[gambar,1024]',
                'errors' => [
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'mime_in'  => 'Format yang diperbolehkan: JPG/JPEG/PNG.',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1 MB.'
                ]
            ],
            'name' => ['rules' => 'required|max_length[100]', 'errors' => [
                'required' => 'Nama proyek wajib diisi.',
                'max_length' => 'Nama proyek maksimal 100 karakter.'
            ]],
            'description' => ['rules' => 'required', 'errors' => ['required' => 'Deskripsi proyek wajib diisi.']],
            'start_date'  => ['rules' => 'required|valid_date', 'errors' => [
                'required' => 'Tanggal mulai wajib diisi.',
                'valid_date' => 'Format tanggal tidak valid.'
            ]],
            'end_date'    => ['rules' => 'permit_empty|valid_date', 'errors' => ['valid_date' => 'Format tanggal tidak valid.']],
            'status'      => ['rules' => 'required|in_list[pending,in_progress,completed]', 'errors' => [
                'required' => 'Status proyek wajib dipilih.',
                'in_list' => 'Status proyek tidak valid.'
            ]]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2) Ambil data proyek
        $project = $this->ProjectModel->find($id);
        if (!$project) {
            return redirect()->back()->with('sweet_error', 'Proyek tidak ditemukan.');
        }

        // 3) Simpan ke folder publik (sesuai base_url('assets/uploads/...'))
        $uploadPath = FCPATH . 'assets/uploads/';      // <-- gunakan FCPATH (public/)
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        $fileGambar = $this->request->getFile('gambar');
        $gambarNama = $project['gambar']; // default pakai yang lama

        // 4) Jika ada file baru
        if ($fileGambar && $fileGambar->isValid() && $fileGambar->getError() === UPLOAD_ERR_OK) {

            // (opsional) cek MIME berdasarkan konten
            if (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $detected = $finfo ? finfo_file($finfo, $fileGambar->getTempName()) : null;
                if ($finfo) finfo_close($finfo);
                if ($detected && !in_array($detected, ['image/jpeg', 'image/png'], true)) {
                    return redirect()->back()->withInput()
                        ->with('errors', ['gambar' => 'Format file tidak valid (JPG/PNG).']);
                }
            }

            // Hapus file lama jika ada
            if (!empty($project['gambar']) && is_file($uploadPath . $project['gambar'])) {
                @unlink($uploadPath . $project['gambar']);
            }

            // Simpan file baru
            $gambarNama = $fileGambar->getRandomName();
            $fileGambar->move($uploadPath, $gambarNama);
        }

        // 5) Update data lain
        $data = [
            'gambar'      => $gambarNama,
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date') ?: null,
            'status'      => $this->request->getPost('status'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        $this->ProjectModel->update($id, $data);

        return redirect()->to(site_url('admin/pages/project'))
            ->with('sweet_success', 'Project berhasil diperbarui!');
    }



    public function hapus_project($id)
    {
        // Ambil data proyek berdasarkan ID
        $project = $this->ProjectModel->find($id);

        if (!$project) {
            return redirect()->back()->with('sweet_error', 'Project tidak ditemukan.');
        }

        // Hapus gambar jika ada
        if ($project['gambar']) {
            $gambarPath = 'assets/uploads/' . $project['gambar'];
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        // Hapus proyek dari database
        $this->ProjectModel->delete($id);

        return redirect()->to(base_url('admin/pages/project'))->with('sweet_success', 'Project berhasil dihapus.');
    }


    public function page_contact()
    {
        $session = session();
        $DataJabatan = $session->get('jabatan');

        $d_contact = $this->ContactModel->findAll();
        $count_contact = count($this->ContactModel->findAll());

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Contact Us',
            'd_contact' => $d_contact,
            'count_contact' => $count_contact,
            'jabatan' => $DataJabatan
        ];

        return view('admin/pages/contact_admin', $data);
    }

    public function page_detail_contact($id)
    {
        $session = session();
        $DataJabatan = $session->get('jabatan');

        $d_contact = $this->ContactModel->find($id);
        if (!$d_contact) {
            return redirect()->back()->with('sweet_error', 'Contact tidak ditemukan.');
        }

        $data = [
            'title' => 'Layout | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Detail Contact',
            'd_contact' => $d_contact,
            'jabatan' => $DataJabatan
        ];
        return view('admin/pages/detail_contact', $data);
    }

    public function hapus_page_contact($id)
    {
        // Ambil data proyek berdasarkan ID
        $d_contact = $this->ContactModel->find($id);

        if (!$d_contact) {
            return redirect()->back()->with('sweet_error', 'Data tidak ditemukan.');
        }

        // Hapus proyek dari database
        $this->ContactModel->delete($id);

        return redirect()->to(base_url('admin/pages/contact'))->with('sweet_success', 'Contact berhasil dihapus.');
    }


    // cooperation
    public function page_cooperation()
    {
        $session = session();
        $DataJabatan = $session->get('jabatan');

        // ambil filter dari query string (?bulan=..&tahun=..&status=..)
        $bulan  = (int) $this->request->getGet('bulan');   // 1..12
        $tahun  = (int) $this->request->getGet('tahun');   // 2023, 2024, 2025, ...
        $status = $this->request->getGet('status');        // diproses|diterima|ditolak

        // pakai model + query builder
        $model = $this->CooperationModel;
        if ($bulan)  $model->where('MONTH(tanggal_pengajuan)', $bulan);
        if ($tahun)  $model->where('YEAR(tanggal_pengajuan)', $tahun);
        if ($status) $model->where('status_pengajuan', $status);

        $d_Cooperation = $model->findAll();

        return view('admin/pages/page_cooperation', [
            'title'         => 'Cooperation | PT. Najwa Jaya Sukses',
            'sub_judul'     => 'Cooperation',
            'd_cooperation' => $d_Cooperation,
            'jabatan'       => $DataJabatan,
            // kirim variabel filter ke view
            'bulan'         => $bulan,
            'tahun'         => $tahun,
            'status'        => $status,
        ]);
    }

    public function detail_page_cooperation($id)
    {
        $session = session();
        $DataJabatan = $session->get('jabatan');

        $d_Cooperation = $this->CooperationModel->find($id);
        if (!$d_Cooperation) {
            return redirect()->to('admin/pages/cooperation')->with('sweet_error', 'Cooperation tidak ditemukan.');
        }

        $data = [
            'title' => 'Cooperation | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Cooperation',
            'd_cooperation' => $d_Cooperation,
            'jabatan' => $DataJabatan
        ];
        return view('admin/pages/detail_cooperation', $data);
    }

    public function page_edit_cooperation($id)
    {
        $session = session();
        $DataJabatan = $session->get('jabatan');

        $d_Cooperation = $this->CooperationModel->find($id);
        if (!$d_Cooperation) {
            return redirect()->to('admin/pages/cooperation')->with('sweet_error', 'Cooperation tidak ditemukan.');
        }

        $data = [
            'title' => 'Cooperation | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Edit Cooperation',
            'd_cooperation' => $d_Cooperation,
            'jabatan' => $DataJabatan
        ];
        return view('admin/pages/edit_cooperation', $data);
    }

    public function page_tambah_cooperation()
    {
        $session = session();
        $DataJabatan = $session->get('jabatan');

        $data = [
            'title' => 'Tambah Kerjasama | PT. Najwa Jaya Sukses',
            'sub_judul' => 'Edit Cooperation',
            'jabatan' => $DataJabatan
        ];
        return view('admin/pages/tambah_cooperation', $data);
    }


    public function aksi_tambah_cooperation()
    {
        date_default_timezone_set('Asia/Jakarta');

        // if ($this->request->getMethod() !== 'post') {
        //     return redirect()->to(site_url('admin/pages/cooperation'));
        // }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_perusahaan' => ['label' => 'Nama Perusahaan', 'rules' => 'required'],
            'alamat_perusahaan' => ['label' => 'Alamat Perusahaan', 'rules' => 'required'],
            'penanggung_jawab' => ['label' => 'Penanggung Jawab', 'rules' => 'required'],
            'jabatan' => ['label' => 'Jabatan', 'rules' => 'required'],
            'telepon' => [
                'label' => 'Telepon',
                'rules' => 'required|regex_match[/^08[0-9]{6,12}$/]|numeric',
                'errors' => [
                    'regex_match' => 'Nomor telepon harus dimulai dengan 08 dan memiliki 8 hingga 12 digit angka.'
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[tb_pengajuan_kerjasama.email]',
                'errors' => ['is_unique' => 'Email sudah terdaftar, silakan gunakan email lain.']
            ],
            'ruang_lingkup_kerjasama' => ['label' => 'Ruang Lingkup Kerjasama', 'rules' => 'required'],
            // 1MB = 1024 KB (aturan CI4 pakai KB)
            'proposal' => [
                'label' => 'Proposal',
                'rules' => 'uploaded[proposal]|mime_in[proposal,application/pdf]|max_size[proposal,1024]',
                'errors' => [
                    'uploaded' => 'File proposal harus diunggah.',
                    'mime_in' => 'Proposal harus dalam format PDF.',
                    'max_size' => 'Ukuran proposal tidak boleh lebih dari 1MB.',
                ]
            ],
            'profil_perusahaan' => [
                'label' => 'Profil Perusahaan',
                'rules' => 'uploaded[profil_perusahaan]|mime_in[profil_perusahaan,application/pdf,image/jpeg,image/png]|max_size[profil_perusahaan,1024]',
            ],
            'dokumen_npwp' => [
                'label' => 'Dokumen NPWP',
                'rules' => 'uploaded[dokumen_npwp]|mime_in[dokumen_npwp,application/pdf,image/jpeg,image/png]|max_size[dokumen_npwp,1024]',
            ],
            'surat_pernyataan' => [
                'label' => 'Surat Pernyataan',
                'rules' => 'uploaded[surat_pernyataan]|mime_in[surat_pernyataan,application/pdf]|max_size[surat_pernyataan,1024]',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // ⛔ kirim sebagai errors, bukan sweet_success
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('sweet_error', 'Periksa kembali isian formulir Anda.');
        }

        // Build data + upload file
        try {
            $data = [
                'nama_perusahaan'         => trim((string)$this->request->getPost('nama_perusahaan')),
                'alamat_perusahaan'       => trim((string)$this->request->getPost('alamat_perusahaan')),
                'penanggung_jawab'        => trim((string)$this->request->getPost('penanggung_jawab')),
                'jabatan'                 => trim((string)$this->request->getPost('jabatan')),
                'telepon'                 => trim((string)$this->request->getPost('telepon')),
                'email'                   => trim((string)$this->request->getPost('email')),
                'ruang_lingkup_kerjasama' => trim((string)$this->request->getPost('ruang_lingkup_kerjasama')),
                'proposal'                => $this->uploadFile('proposal'),
                'profil_perusahaan'       => $this->uploadFile('profil_perusahaan'),
                'dokumen_npwp'            => $this->uploadFile('dokumen_npwp'),
                'surat_pernyataan'        => $this->uploadFile('surat_pernyataan'),
                'tanggal_pengajuan'       => date('Y-m-d H:i:s'),
                'status_pengajuan'        => 'Menunggu persetujuan',
            ];
        } catch (\Throwable $e) {
            // ⛔ gagal upload (termasuk >1MB) → tampilkan pesan error
            return redirect()->back()
                ->withInput()
                ->with('errors', ['upload' => $e->getMessage()])
                ->with('sweet_error', 'Gagal mengunggah berkas: ' . $e->getMessage());
        }

        // Simpan ke DB, cek error
        $insertId = $this->CooperationModel->insert($data, true);
        if ($insertId === false) {
            $modelErrors = $this->CooperationModel->errors();
            $dbError     = $this->CooperationModel->db->error();
            $msg = !empty($modelErrors) ? implode("\n", $modelErrors)
                : ($dbError['message'] ?? 'Gagal menyimpan data.');
            return redirect()->back()
                ->withInput()
                ->with('errors', ['insert' => $msg])
                ->with('sweet_error', 'Gagal menyimpan: ' . $msg);
        }

        // ✅ sukses
        return redirect()
            ->to(site_url('admin/pages/cooperation'))
            ->with('sweet_success', 'Pengajuan Kerjasama Berhasil Dikirim.');
    }

    private function uploadFile(string $fieldName): ?string
    {
        $file = $this->request->getFile($fieldName);

        // Tangani error bawaan PHP (mis. > upload_max_filesize)
        if (!$file || $file->getError() !== UPLOAD_ERR_OK) {
            // Kalau validasi sudah mewajibkan uploaded[..], seharusnya tidak masuk sini.
            // Tetap beri pesan yang informatif.
            $errCode = $file ? $file->getError() : null;
            if ($errCode === UPLOAD_ERR_INI_SIZE || $errCode === UPLOAD_ERR_FORM_SIZE) {
                throw new \RuntimeException("Ukuran file {$fieldName} melebihi batas server.");
            }
            throw new \RuntimeException("Upload {$fieldName} gagal.");
        }

        if (!$file->isValid() || $file->hasMoved()) {
            throw new \RuntimeException("File {$fieldName} tidak valid atau sudah dipindahkan.");
        }

        $ext  = strtolower($file->getExtension());
        $mime = $file->getMimeType();
        $size = $file->getSize(); // bytes

        // Batas 1MB (server-side tambahan)
        $maxSize = 1 * 1024 * 1024;
        if ($size > $maxSize) {
            throw new \RuntimeException("Ukuran file {$fieldName} tidak boleh lebih dari 1 MB.");
        }

        $allowedTypes = [
            'proposal'           => ['pdf'],
            'profil_perusahaan'  => ['pdf', 'jpg', 'jpeg', 'png'],
            'dokumen_npwp'       => ['pdf', 'jpg', 'jpeg', 'png'],
            'surat_pernyataan'   => ['pdf'],
        ];
        if (!in_array($ext, $allowedTypes[$fieldName] ?? [], true)) {
            throw new \RuntimeException("File {$fieldName} tidak valid. Hanya boleh: " . implode(', ', $allowedTypes[$fieldName] ?? []));
        }

        $allowedMimes = [
            'pdf'  => 'application/pdf',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
        ];
        if (isset($allowedMimes[$ext]) && strpos($mime, $allowedMimes[$ext]) === false) {
            throw new \RuntimeException("MIME file {$fieldName} tidak sesuai.");
        }

        // Pastikan folder tujuan ada & writable (public/assets/uploads)
        $targetDir = rtrim(FCPATH, '/\\') . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'uploads';
        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0775, true);
        }
        if (!is_writable($targetDir)) {
            throw new \RuntimeException("Folder upload tidak writable: assets/uploads");
        }

        $newName = $file->getRandomName();
        if (!$file->move($targetDir, $newName)) {
            throw new \RuntimeException("Gagal memindahkan file {$fieldName}.");
        }

        return $newName; // simpan nama relative
    }
}
