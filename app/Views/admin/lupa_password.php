<?= $this->extend('layouts/t_login_admin') ?>
<?= $this->section('login_admin') ?>
<div id="particles-bg"></div>
<div class="auth-wrap d-flex align-items-center justify-content-center py-5">
    <div class="auth-card card border-0 shadow-lg rounded-4 overflow-hidden">
        <!-- Header / Logo -->
        <div class="auth-header text-center p-4">
            <img src="<?= base_url('/assets/img/logo.jpg') ?>" alt="PT. Najwa Jaya Sukses" class="logo-auth mb-2">
            <h5 class="mb-1 fw-bold text-warning">Pemulihan Akun</h5>
            <p class="text-muted mb-0">Masukkan email yang udah terdaftar!</p>
        </div>

        <div class="card-body p-4 pt-3">
            <form action="<?= site_url('/auth/forgot-password') ?>" method="POST" novalidate id="forgotForm">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="form-floating mb-3">
                    <input class="form-control fc_native" id="inputEmail" type="email" name="email"
                        placeholder="name@example.com" required>
                    <label for="inputEmail"><i class="fa-regular fa-envelope me-1"></i> Email address</label>
                    <div class="invalid-feedback">Mohon masukkan email yang valid.</div>
                    <div class="form-text">Kami tidak akan membagikan email Anda kepada pihak lain.</div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button class="btn-native-login btn-gradient" id="btnSubmit" type="submit">
                        <span class="btn-label"><i class="fa-solid fa-unlock-keyhole me-2"></i> Lupa Password</span>
                        <span class="btn-loading d-none"><i class="fa-solid fa-spinner fa-spin me-2"></i> Mengirim...</span>
                    </button>

                    <a class="btn-native-login btn-gradient text-decoration-none" href="<?= base_url('/auth/login') ?>" role="button">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    :root {
        --brand-gold: #d4ba34ff;
        --brand-gold-hex: #d4ba34;
        /* tanpa alpha utk library */
    }

    /* canvas partikel fixed full-screen di belakang */
    #particles-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        /* biar klik tetap ke form */
    }

    /* pastikan konten di atas partikel */
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

    .form-control:focus {
        border-color: var(--brand-gold) !important;
        box-shadow: 0 0 0 .2rem var(--brand-gold-glow) !important;
        outline: 0;
    }

    .form-floating:focus-within label {
        color: var(--brand-gold);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 600;
        transition: .25s;
        border-radius: 999px;
        padding: .75rem 1rem;
    }

    .btn-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
        color: #fff;
    }

    .btn-native-login {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-native-login .btn-loading {
        letter-spacing: .2px;
    }
</style>

<!-- Scripts -->
<script>
    (function() {
        const form = document.getElementById('forgotForm');
        const email = document.getElementById('inputEmail');
        const btn = document.getElementById('btnSubmit');
        const label = btn?.querySelector('.btn-label');
        const loading = btn?.querySelector('.btn-loading');

        // HTML5 validation + kecilkan error UX
        form?.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }
            // Loading state
            if (label && loading) {
                label.classList.add('d-none');
                loading.classList.remove('d-none');
            }
            btn?.setAttribute('disabled', 'disabled');
            // biarkan submit berjalan (target _blank)
            setTimeout(() => { // fallback jika popup diblokir
                if (label && loading) {
                    label.classList.remove('d-none');
                    loading.classList.add('d-none');
                }
                btn?.removeAttribute('disabled');
            }, 3000);
        });

        // Optional: format ringan—trim spasi
        email?.addEventListener('input', function() {
            this.value = this.value.trimStart();
        });
    })();
</script>

<?= $this->endSection() ?>