<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>

<div class="container py-4 fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold text-warning mb-1">
                <i class="fa-solid fa-envelope-open-text me-2 text-warning"></i> <?= esc($sub_judul) ?>
            </h2>
            <p class="text-muted mb-0">Detail pesan masuk</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/contact') ?>" class="text-decoration-none text-secondary">
                    Contacts
                </a>
            </li>
            <li class="breadcrumb-item active text-dark"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <!-- Back -->
    <div class="mb-3">
        <a href="<?= base_url('admin/pages/contact') ?>" class="btn btn-gradient rounded-pill px-3">
            <i class="fa-solid fa-angle-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Content -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <!-- Header contact -->
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="avatar-initial" aria-hidden="true">
                            <?= esc(mb_strtoupper(mb_substr($d_contact['name'] ?? 'N', 0, 1))) ?>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fw-bold"><?= esc($d_contact['name']) ?></h5>
                            <div class="text-muted small d-flex align-items-center gap-2 flex-wrap">
                                <a href="mailto:<?= esc($d_contact['email']) ?>" class="text-decoration-none">
                                    <i class="fa fa-envelope me-1"></i><?= esc($d_contact['email']) ?>
                                </a>
                                <span class="vr mx-1 d-none d-sm-inline"></span>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill"
                                    id="btn-copy" data-email="<?= esc($d_contact['email']) ?>">
                                    <i class="fa fa-copy me-1"></i> Copy Email
                                </button>
                                <a href="mailto:<?= esc($d_contact['email']) ?>"
                                    class="btn btn-sm btn-outline-primary rounded-pill">
                                    <i class="fa fa-reply me-1"></i> Balas Email
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="message-box p-3 rounded-3">
                        <div class="d-flex">
                            <i class="fa-solid fa-quote-left me-2 mt-1"></i>
                            <p class="mb-0 lh-lg"><?= esc($d_contact['message']) ?></p>
                        </div>
                    </div>

                    <!-- Meta dates -->
                    <div class="row g-3 mt-4">
                        <div class="col-md-6">
                            <div class="meta-tile p-3 rounded-3">
                                <div class="text-muted small mb-1">
                                    <i class="fa-regular fa-calendar-plus me-1"></i> Tanggal Dibuat
                                </div>
                                <div class="fw-semibold">
                                    <?= esc(function_exists('formatTanggalIndonesia')
                                        ? formatTanggalIndonesia($d_contact['created_at'])
                                        : $d_contact['created_at']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="meta-tile p-3 rounded-3">
                                <div class="text-muted small mb-1">
                                    <i class="fa-regular fa-calendar-check me-1"></i> Tanggal Diubah
                                </div>
                                <div class="fw-semibold">
                                    <?= esc(function_exists('formatTanggalIndonesia')
                                        ? formatTanggalIndonesia($d_contact['updated_at'])
                                        : $d_contact['updated_at']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /card-body -->
            </div>
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

    /* Brand focus */
    :root {
        --brand-gold: #d4ba34ff;
        --brand-gold-glow: rgba(212, 186, 52, .25);
    }

    .btn-gradient {
        background: linear-gradient(135deg, var(--brand-gold), #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 600;
        transition: .3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, var(--brand-gold), #f3e69dff);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        color: #fff;
    }

    /* Avatar initial */
    .avatar-initial {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(212, 186, 52, .12);
        color: var(--brand-gold);
        font-weight: 800;
        font-size: 1.1rem;
        border: 2px solid rgba(212, 186, 52, .25);
    }

    /* Message box */
    .message-box {
        background: #faf9f6;
        border: 1px dashed rgba(0, 0, 0, .08);
    }

    /* Meta tiles */
    .meta-tile {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .06);
        box-shadow: 0 1px 6px rgba(0, 0, 0, .05);
    }
</style>

<!-- Scripts -->
<script>
    document.getElementById('btn-copy')?.addEventListener('click', async function() {
        const email = this.getAttribute('data-email');
        try {
            await navigator.clipboard.writeText(email);
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Disalin',
                    text: 'Email telah disalin ke clipboard',
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
</script>

<?= $this->endSection() ?>