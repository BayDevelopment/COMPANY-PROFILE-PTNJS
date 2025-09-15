<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #d4ba34ff;
        box-shadow: 0 0 0 0.2rem rgba(212, 186, 52, .25);
    }

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
<div class="container py-4 fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h2 class="fw-bold text-warning">Tambah Misi</h2>
            <p class="text-muted">Isi formulir di bawah ini untuk menambahkan misi baru perusahaan</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/about/visimisi') ?>" class="text-decoration-none text-dark">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <div class="mb-4">
        <a href="<?= base_url('admin/pages/about/visimisi') ?>" class="btn btn-shiny rounded-pill px-3">
            <i class="fa-solid fa-angle-left me-1"></i> Kembali
        </a>
    </div>
    <!-- Form Card -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/about/misi/tambah/') . esc($d_visi['id_visi']) ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" id="id_visi" name="id_visi" value="<?= esc($d_visi['id_visi']) ?>">

                <!-- Textarea Misi -->
                <div class="mb-4">
                    <label for="misi" class="form-label fw-semibold">Misi Perusahaan <span class="text-danger">*</span></label>
                    <textarea class="form-control form-control-lg rounded-3 shadow-sm"
                        id="misi"
                        rows="4"
                        name="misi"
                        placeholder="Masukkan misi perusahaan anda di sini..."
                        required></textarea>
                    <div class="form-text text-muted mt-1">
                        Tulis misi secara singkat, jelas, dan bermakna.
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-shiny btn-md rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-file-circle-plus"></i> Tambah Misi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>