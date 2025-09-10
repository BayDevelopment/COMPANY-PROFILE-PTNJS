<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    protected $AdminModel;
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
    }

    public function index()
    {
        //
        $data = [
            'title' => 'Login | PT. Najwa Jaya Sukses'
        ];

        // logika satu activity ( jika sudah login, maka tidak bisa kehalaman login jika belum logout)
        if (session()->get('logged_in')) {
            return redirect()->to('/admin/dashboard')->with('sweet_success', 'Anda sudah login!');
        }

        return view('/admin/login_admin.php', $data);
    }
    public function login_aksi()
    {
        $session = session();

        // Jika sudah login, redirect ke dashboard
        if ($session->get('logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        $AdminModel = new AdminModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validasi input
        if (empty($email) || empty($password)) {
            return redirect()->to('/auth/login')->with('sweet_error', 'Email dan password wajib diisi!');
        }


        if (strlen($password) < 6) {
            return redirect()->to('/auth/login')->with('sweet_error', 'Password minimal 6 karakter!');
        }

        // Cek user di database
        $admin = $AdminModel->where('email', $email)->first();

        if (!$admin) {
            return redirect()->to('/auth/login')->with('sweet_error', 'Email atau password anda salah!');
        }

        // Cek apakah akun aktif
        if ($admin['status'] != 'active') {
            return redirect()->to('/auth/login')->with('sweet_error', 'Akun sudah tidak aktif!');
        }

        // Cek apakah role admin
        if ($admin['role'] != 'admin') {
            return redirect()->to('/auth/login')->with('sweet_error', 'Tidak ada data yang Anda maksud!');
        }

        // Verifikasi password
        if (!password_verify($password, $admin['password'])) {
            return redirect()->to('/auth/login')->with('sweet_error', 'Login gagal, silakan coba lagi!');
        }

        // Set session
        $sessionData = [
            'id_admin'    => $admin['id_admin'],
            'nama'        => $admin['nama'],
            'email'       => $admin['email'],
            'no_hp'       => $admin['no_hp'],
            'role'        => $admin['role'],
            'jabatan'     => $admin['jabatan'],
            'alamat'      => $admin['alamat'],
            'created_at'  => $admin['created_at'],
            'updated_at'  => $admin['updated_at'],
            'status'      => $admin['status'],
            'logged_in'   => true,
            'login_time'  => time() // simpan waktu login
        ];
        $session->set($sessionData);
        $session->set('login_time', time()); // simpan waktu login pertama


        return redirect()->to('/admin/dashboard')->with('sweet_success', 'Selamat, Login berhasil!');
    }

    // logout admin 
    public function logout_admin()
    {
        // Simpan flashdata dalam cookie sebelum session dihancurkan
        setcookie("flash_logout", "Selamat, berhasil logout!", time() + 3, "/");

        // Hapus seluruh session
        session()->destroy();

        return redirect()->to('/auth/login');
    }

    public function lupa_password()
    {
        $data = [
            'title' => 'Lupa Password'
        ];
        return view('/admin/lupa_password', $data);
    }
    public function aksi_lupa_password()
    {
        date_default_timezone_set('Asia/Jakarta');

        $email = trim((string) $this->request->getPost('email'));

        // Cek email pemohon
        $user = $this->AdminModel->where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('sweet_error', 'Email tidak terdaftar.');
        }

        // Cari superadmin yang punya no_hp, pilih yang paling baru (created_at DESC)
        $admin = $this->AdminModel
            ->where('id_admin', 1)
            ->where('no_hp IS NOT NULL', null, false)
            ->where('no_hp !=', '')
            ->orderBy('created_at', 'DESC')
            ->first();

        // Fallback: admin lain yang punya no_hp, tetap pilih yang paling baru
        if (!$admin) {
            $admin = $this->AdminModel
                ->where('no_hp IS NOT NULL', null, false)
                ->where('no_hp !=', '')
                ->orderBy('created_at', 'DESC')
                ->first();
        }

        if (!$admin) {
            return redirect()->back()->with('sweet_error', 'Nomor WhatsApp admin belum disetel.');
        }

        $waPhone = $this->normalizeWaNumber($admin['no_hp'] ?? '');
        if (!$waPhone) {
            return redirect()->back()->with('sweet_error', 'Format nomor WhatsApp admin tidak valid.');
        }

        $waktu = date('Y-m-d H:i:s');
        $msg   = rawurlencode("🔐 Permintaan Lupa Password\nEmail: {$email}\nWaktu: {$waktu}");

        return redirect()->to("https://wa.me/{$waPhone}?text={$msg}");
    }

    private function normalizeWaNumber(string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', $phone ?? '');
        if ($digits === '') return null;

        if (strpos($digits, '62') === 0) return $digits;
        if ($digits[0] === '0') return '62' . substr($digits, 1);
        if ($digits[0] === '8') return '62' . $digits;
        return $digits; // fallback
    }
}
