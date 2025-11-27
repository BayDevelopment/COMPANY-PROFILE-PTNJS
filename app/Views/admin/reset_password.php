<?= $this->extend('layouts/t_login_admin') ?>
<?= $this->section('login_admin') ?>

<div id="particles-bg"></div>
<div class="auth-wrap d-flex align-items-center justify-content-center py-5">
    <div class="auth-card card border-0 shadow-lg rounded-4 overflow-hidden">

        <!-- Header -->
        <div class="auth-header text-center p-4">
            <img src="<?= base_url('/assets/img/logo.jpg') ?>" alt="PT. Najwa Jaya Sukses" class="logo-auth mb-2">
            <h5 class="mb-1 fw-bold text-warning">Reset Password</h5>
            <p class="text-muted mb-0">Masukkan password baru Anda.</p>
        </div>

        <div class="card-body p-4 pt-3">
            <form action="<?= site_url('/auth/forgot-password/reset') ?>" method="POST" id="resetForm" novalidate>
                <?= csrf_field() ?>

                <input type="hidden" name="token" value="<?= $token ?>">

                <!-- Password Baru -->
                <div class="form-floating mb-3">
                    <input class="form-control fc_native" id="password" type="password" name="password"
                        placeholder="Password baru" required minlength="6">
                    <label for="password"><i class="fa-solid fa-lock me-1"></i> Password Baru</label>
                    <div class="invalid-feedback">Password minimal 6 karakter.</div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-floating mb-3">
                    <input class="form-control fc_native" id="confirmPassword" type="password" name="confirm_password"
                        placeholder="Konfirmasi password" required minlength="6">
                    <label for="confirmPassword"><i class="fa-solid fa-lock me-1"></i> Konfirmasi Password</label>
                    <div class="invalid-feedback">Konfirmasi password harus sama.</div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn-native-login btn-gradient" id="btnSubmit" type="submit">
                        <span class="btn-label"><i class="fa-solid fa-key me-2"></i> Reset Password</span>
                        <span class="btn-loading d-none"><i class="fa-solid fa-spinner fa-spin me-2"></i> Memproses...</span>
                    </button>

                    <a class="btn-native-login btn-gradient text-decoration-none text-center text-white"
                        href="<?= base_url('/auth/login') ?>" role="button">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Styles (dipertahankan) -->
<style>
    :root {
        --brand-gold: #d4ba34ff;
        --brand-gold-hex: #d4ba34;
    }

    #particles-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
    }

    .auth-wrap,
    .auth-card {
        position: relative;
        z-index: 1;
    }

    .auth-wrap {
        min-height: 100vh;
        background:
            radial-gradient(1200px 600px at -10% -20%, rgba(212, 186, 52, .08), transparent 60%),
            radial-gradient(800px 800px at 110% 10%, rgba(243, 230, 157, .12), transparent 60%),
            var(--bg-soft);
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .auth-card {
        max-width: 560px;
        width: 100%;
        background: #fff;
    }

    .auth-header {
        background: linear-gradient(135deg, #fff, #fff);
    }

    .logo-auth {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 999px;
        padding: .75rem 1rem;
        transition: .25s;
    }

    .btn-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
    }
</style>

<!-- Script -->
<script>
    (function() {
        const form = document.getElementById('resetForm');
        const pwd = document.getElementById('password');
        const cpwd = document.getElementById('confirmPassword');
        const btn = document.getElementById('btnSubmit');
        const label = btn.querySelector('.btn-label');
        const loading = btn.querySelector('.btn-loading');

        form.addEventListener('submit', function(e) {
            if (pwd.value !== cpwd.value) {
                e.preventDefault();
                cpwd.classList.add('is-invalid');
                return;
            }

            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            label.classList.add('d-none');
            loading.classList.remove('d-none');
            btn.setAttribute('disabled', 'disabled');
        });
    })();
</script>

<?= $this->endSection() ?>