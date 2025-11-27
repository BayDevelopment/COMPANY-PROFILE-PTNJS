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
        $validation = session()->getFlashdata('validation') ?? \Config\Services::validation();
        $data = [
            'title' => 'Login | PT. Najwa Jaya Sukses',
            'validation' => $validation
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

    // lupa password
    public function lupa_password()
    {
        $validation = session()->getFlashdata('validation') ?? \Config\Services::validation();

        $data = [
            'title' => 'Lupa Password | PT. Najwa Jaya Sukses',
            'validation' => $validation
        ];
        return view('/admin/lupa_password', $data);
    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');

        $user = $this->AdminModel->where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('sweet_error', 'Email tidak ditemukan.');
        }

        // generate token
        $token   = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        // simpan token
        $this->AdminModel->update($user['id_admin'], [
            'reset_token'   => $token,
            'reset_expires' => $expires
        ]);

        // buat link reset
        $link = base_url('auth/forgot-password/' . $token);

        // kirim email
        $emailService = \Config\Services::email();
        $emailService->setFrom('byalbrldici@gmail.com', 'PT. Najwa Jaya Sukses');
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password');
        $emailService->setMessage("
        Klik link berikut untuk reset password:<br><br>
        <a href='$link'>$link</a><br><br>
        Link berlaku selama 30 menit.
    ");

        // WAJIB untuk Gmail
        $emailService->setNewline("\r\n");
        $emailService->setCRLF("\r\n");

        if (!$emailService->send()) {
            return redirect()->back()->with('sweet_error', $emailService->printDebugger());
        }

        return redirect()->back()->with('sweet_success', 'Link reset password telah dikirim ke email.');
    }

    public function resetPassword($token)
    {
        $user = $this->AdminModel->where('reset_token', $token)->first();

        if (!$user || strtotime($user['reset_expires']) < time()) {
            return redirect()->to('auth/forgot-password')->with('sweet_error', 'Token tidak valid atau sudah expired.');
        }

        return view('admin/reset_password', [
            'title' => 'Forgot Password | PT. Najwa Jaya Sukses',
            'token' => $token
        ]);
    }

    public function processResetPassword()
    {
        $token    = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        // ambil user berdasarkan token
        $user = $this->AdminModel->where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->to('auth/forgot-password')->with('sweet_error', 'Token invalid.');
        }

        // VALIDASI PASSWORD MINIMAL 6 KARAKTER
        $validate = $this->validate([
            'password' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'    => 'Password wajib diisi.',
                    'min_length'  => 'Password minimal 6 karakter.'
                ]
            ],

            'confirm_password' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi.',
                    'matches'  => 'Konfirmasi password harus sama dengan password.'
                ]
            ],
        ]);

        if (!$validate) {
            // simpan error untuk ditampilkan di view (SweetAlert)
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->getError('password'));
        }

        // update password
        $this->AdminModel->update($user['id_admin'], [
            'password'      => password_hash($password, PASSWORD_ARGON2ID),
            'reset_token'   => null,
            'reset_expires' => null
        ]);

        return redirect()->to('/auth/login')->with('sweet_success', 'Password berhasil direset.');
    }
}
