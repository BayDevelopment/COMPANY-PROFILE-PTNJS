<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<style>
    .btn-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        transform: translateY(-2px);
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
    }

    .btn-shiny {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: linear-gradient(135deg, #fae20dff, #fae20dff);
        color: #fff;
        padding: .6rem 1.2rem;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 600;
        border: 0;
        position: relative;
        overflow: hidden;
        transition: .25s ease;
        box-shadow: 0 10px 22px rgba(253, 237, 13, 0.32);
    }

    .btn-shiny::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .35), transparent);
        transform: translateX(-120%);
        transition: transform .6s ease;
    }

    .btn-shiny:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 34px rgba(253, 209, 13, 0.42);
        color: #fff;
    }

    .btn-shiny:hover::before {
        transform: translateX(120%);
    }
</style>
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold text-warning">Tambah Visi</h1>
            <p class="text-muted mb-0">Masukkan visi baru dengan jelas dan bermakna</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/about') ?>" class="text-decoration-none text-dark">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <div class="mb-4">
        <a href="<?= base_url('admin/pages/about/visimisi') ?>" class="btn btn-shiny px-3 py-2 rounded-pill shadow-sm">
            <i class="fa-solid fa-angle-left me-2"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/about/visimisi/tambah-visi') ?>" method="POST">
                <?= csrf_field() ?>

                <!-- Textarea Visi -->
                <div class="mb-4">
                    <label for="visi" class="form-label fw-semibold">Visi <span class="text-danger">*</span></label>
                    <textarea class="form-control form-control-lg rounded-3 shadow-sm"
                        id="visi"
                        name="visi"
                        rows="4"
                        placeholder="Masukkan visi anda di sini..." required></textarea>
                    <div class="form-text text-muted mt-1">
                        Gunakan kalimat singkat, jelas, dan bermakna.
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit"
                        class="btn btn-shiny btn-md rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-file-circle-plus"></i> Tambah Visi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>