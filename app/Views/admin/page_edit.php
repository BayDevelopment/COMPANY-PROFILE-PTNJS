<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>

<?php
// Guard kecil
$jabatan = $jabatan ?? '—';
$email   = $email   ?? '—';
$status  = strtolower($status ?? 'inactive');
$created = $created ?? null;
$updated = $updated ?? null;
$initial = mb_strtoupper(mb_substr(($jabatan ?: ($email ?: 'N')), 0, 1));
?>

<div class="container py-4 fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold text-warning mb-1">
                Profile
            </h2>
            <p class="text-muted mb-0"><?= esc($sub_judul) ?></p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active text-dark"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <div class="row g-4">
        <!-- Kiri: Kartu info -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="avatar-initial" aria-hidden="true"><?= esc($initial) ?></div>
                        <div>
                            <h5 class="text-capitalize fw-semibold mb-1"><?= esc($jabatan) ?></h5>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <a href="mailto:<?= esc($email) ?>" class="text-decoration-none">
                                    <i class="fa fa-envelope me-1"></i><?= esc($email) ?>
                                </a>
                                <button type="button" id="btn-copy-email" class="btn btn-sm btn-outline-secondary rounded-pill"
                                    data-email="<?= esc($email) ?>">
                                    <i class="fa fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php
                    $isActive  = ($status === 'active');
                    $badgeCls  = $isActive ? 'bg-success-subtle text-success border-success' : 'bg-danger-subtle text-danger border-danger';
                    $badgeIcon = $isActive ? 'fa-user-check' : 'fa-user-xmark';
                    $badgeText = $isActive ? 'Active' : 'In-Active';
                    ?>
                    <span class="badge rounded-pill px-3 py-2 border <?= $badgeCls ?>">
                        <i class="fa-solid <?= $badgeIcon ?> me-1"></i> <?= esc($badgeText) ?>
                    </span>

                    <div class="row g-3 mt-3">
                        <div class="col-6">
                            <h6 class="text-muted mb-1">Created</h6>
                            <div class="meta-tile p-3 rounded-3">
                                <div class="fw-semibold">
                                    <?= esc(function_exists('formatTanggalLengkapIndonesia') && $created ? formatTanggalLengkapIndonesia($created) : ($created ?? '—')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted mb-1">Updated</h6>
                            <div class="meta-tile p-3 rounded-3">
                                <div class="fw-semibold">
                                    <?= esc(function_exists('formatTanggalLengkapIndonesia') && $updated ? formatTanggalLengkapIndonesia($updated) : ($updated ?? '—')) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="<?= base_url('/admin/profile') ?>" class="btn btn-outline-secondary rounded-pill px-3">
                            <i class="fa-solid fa-angle-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Form edit email & password -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="<?= site_url('/admin/profile/edit') ?>" method="POST" novalidate>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                        <!-- Email -->
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control fc_native" id="email_address"
                                name="email" value="<?= esc($email) ?>" placeholder="nama@domain.com" required>
                            <label for="email_address">Email Address</label>
                            <div class="form-text">Kami tidak akan membagikan email Anda kepada orang lain.</div>
                        </div>

                        <!-- Password + toggle -->
                        <div class="form-floating mb-2 position-relative">
                            <input type="password" class="form-control fc_native pe-5" id="password"
                                name="password" placeholder="Password baru (opsional)"
                                minlength="8" autocomplete="new-password">
                            <label for="password">Password Baru (opsional)</label>

                            <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2 rounded-pill"
                                id="togglePassword" tabindex="-1" aria-label="Lihat/Sembunyikan Password">
                                <i class="fa-regular fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        <div class="form-text mb-3">
                            Minimal 8 karakter. Gunakan kombinasi huruf besar, kecil, angka, dan simbol.
                        </div>

                        <!-- Aksi -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-gradient rounded-pill px-4">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                            </button>
                            <a href="<?= base_url('/admin/profile') ?>" class="btn btn-outline-secondary rounded-pill px-3">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> <!--/row-->
</div>

<!-- Styles -->
<style>
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
        --brand-gold-glow: rgba(212, 186, 52, .25);
    }

    .form-control:focus,
    .form-select:focus {
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
        transition: .3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        color: #fff;
    }

    .avatar-initial {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(212, 186, 52, .12);
        color: #b3921a;
        font-weight: 800;
        font-size: 1.2rem;
        border: 2px solid rgba(212, 186, 52, .25);
    }

    .meta-tile {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .06);
        box-shadow: 0 1px 6px rgba(0, 0, 0, .05);
    }

    /* Subtle badge fallback */
    .bg-success-subtle {
        background: #eaf7ee;
    }

    .bg-danger-subtle {
        background: #fdebec;
    }

    .text-success {
        color: #198754 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .border-success {
        border-color: #ccead7 !important;
    }

    .border-danger {
        border-color: #f5c2c7 !important;
    }
</style>

<!-- Scripts -->
<script>
    (function() {
        // Copy email
        document.getElementById('btn-copy-email')?.addEventListener('click', async function() {
            const email = this.getAttribute('data-email') || '';
            try {
                await navigator.clipboard.writeText(email);
                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Disalin',
                        text: 'Email disalin ke clipboard',
                        timer: 1400,
                        showConfirmButton: false
                    });
                } else {
                    alert('Email disalin: ' + email);
                }
            } catch (e) {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Tidak dapat menyalin email'
                    });
                } else {
                    alert('Tidak dapat menyalin email');
                }
            }
        });

        // Toggle password
        const pwd = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        const ico = document.getElementById('toggleIcon');
        btn?.addEventListener('click', function() {
            if (!pwd) return;
            const show = pwd.type === 'password';
            pwd.type = show ? 'text' : 'password';
            ico.classList.toggle('fa-eye', !show);
            ico.classList.toggle('fa-eye-slash', show);
        });
    })();
</script>

<?= $this->endSection() ?>