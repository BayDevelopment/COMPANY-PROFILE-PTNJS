<?= $this->extend('layouts/t_login_admin') ?>
<?= $this->section('login_admin') ?>

<!-- Background Particles -->
<div id="particles-bg"></div>

<div class="auth-wrap d-flex align-items-center justify-content-center py-5 fade-in">
    <div class="auth-card card border-0 shadow-lg rounded-4 overflow-hidden">
        <!-- Header / Logo -->
        <div class="auth-header text-center p-4">
            <img src="<?= base_url('/assets/img/logo.jpg') ?>" alt="PT. Najwa Jaya Sukses" class="logo-auth mb-2">
            <h5 class="mb-1 fw-bold text-warning">Selamat Datang</h5>
            <p class="text-muted mb-0">Silakan masuk ke akun admin Anda.</p>
        </div>

        <div class="card-body p-4 pt-3">
            <form action="<?= site_url('/auth/login') ?>" method="POST" id="loginForm" novalidate>
                <?= csrf_field() ?>
                <!-- Email -->
                <div class="form-floating mb-3">
                    <input class="form-control fc_native" id="inputEmail" type="email" name="email"
                        placeholder="name@example.com" required autofocus>
                    <label for="inputEmail"><i class="fa-regular fa-envelope me-1"></i> Email address</label>
                    <div class="invalid-feedback">Mohon masukkan email yang valid.</div>
                </div>

                <!-- Password + toggle -->
                <div class="form-floating mb-2 position-relative">
                    <input class="form-control fc_native pe-5" id="inputPassword" type="password" name="password"
                        placeholder="Password" minlength="8" required>
                    <label for="inputPassword"><i class="fa-solid fa-key me-1"></i> Password</label>

                    <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2 rounded-pill"
                        id="togglePassword" tabindex="-1" aria-label="Lihat/Sembunyikan Password">
                        <i class="fa-regular fa-eye" id="toggleIcon"></i>
                    </button>
                    <div class="invalid-feedback">Password minimal 8 karakter.</div>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-2 mb-2">
                    <a class="small text-decoration-none" href="<?= base_url('/auth/lupa-password') ?>">
                        <i class="fa-regular fa-circle-question me-1"></i> Forgot Password?
                    </a>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2 pt-2">
                    <button class="btn-native-login btn-gradient" id="btnLogin" type="submit">
                        <span class="btn-label"><i class="fa-solid fa-right-to-bracket me-2"></i> Login</span>
                        <span class="btn-loading d-none"><i class="fa-solid fa-spinner fa-spin me-2"></i> Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    /* Animasi */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .fade-in {
        animation: fadeIn .8s ease-in-out;
    }

    :root {
        --brand-gold: #d4ba34ff;
        --brand-gold-hex: #d4ba34;
        --bg-soft: #f7f7fb;
    }

    /* particles background holder */
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



    .auth-card {
        max-width: 520px;
        width: 100%;
        background: #fff;
        border-radius: 18px;
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
        box-shadow: 0 0 0 .2rem rgba(212, 186, 52, .25) !important;
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
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    (function() {
        // Particles (hormati prefers-reduced-motion)
        if (!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
            const GOLD = getComputedStyle(document.documentElement).getPropertyValue('--brand-gold-hex').trim() || '#d4ba34';
            particlesJS('particles-bg', {
                particles: {
                    number: {
                        value: 60,
                        density: {
                            enable: true,
                            value_area: 900
                        }
                    },
                    color: {
                        value: GOLD
                    },
                    shape: {
                        type: 'circle'
                    },
                    opacity: {
                        value: 0.12
                    },
                    size: {
                        value: 3,
                        random: true
                    },
                    line_linked: {
                        enable: true,
                        distance: 140,
                        color: GOLD,
                        opacity: 0.18,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 1.25,
                        direction: 'none',
                        out_mode: 'out'
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: {
                            enable: true,
                            mode: 'grab'
                        },
                        resize: true
                    },
                    modes: {
                        grab: {
                            distance: 140,
                            line_linked: {
                                opacity: 0.25
                            }
                        }
                    }
                },
                retina_detect: true
            });
        }

        // Toggle password
        const pwd = document.getElementById('inputPassword');
        const tgl = document.getElementById('togglePassword');
        const ico = document.getElementById('toggleIcon');
        tgl?.addEventListener('click', function() {
            if (!pwd) return;
            const show = pwd.type === 'password';
            pwd.type = show ? 'text' : 'password';
            ico.classList.toggle('fa-eye', !show);
            ico.classList.toggle('fa-eye-slash', show);
        });

        // Client-side validation + loading state
        const form = document.getElementById('loginForm');
        const btn = document.getElementById('btnLogin');
        const label = btn?.querySelector('.btn-label');
        const loading = btn?.querySelector('.btn-loading');

        form?.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }
            if (label && loading) {
                label.classList.add('d-none');
                loading.classList.remove('d-none');
            }
            btn?.setAttribute('disabled', 'disabled');
        });

        // Trimming ringan email
        document.getElementById('inputEmail')?.addEventListener('input', function() {
            this.value = this.value.replace(/\s{2,}/g, ' ').trimStart();
        });
    })();
</script>

<?= $this->endSection() ?>