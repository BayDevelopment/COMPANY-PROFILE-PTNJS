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
</style>
<div class="container py-4 fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h2 class="fw-bold text-warning"> Edit Misi</h2>
            <p class="text-muted">Perbarui data misi perusahaan dengan benar dan jelas</p>
        </div>
        <!-- Breadcrumb -->
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>" class="text-decoration-none text-dark"> <i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/pages/about/visimisi') ?>" class="text-decoration-none text-dark">Visi & Misi</a></li>
            <li class="breadcrumb-item active">Edit Misi</li>
        </ol>
    </div>

    <div class="mb-4">
        <a href="<?= base_url('admin/pages/about/visimisi') ?>" class="btn btn-gradient px-3 py-2 rounded-pill shadow-sm">
            <i class="fa-solid fa-angle-left me-2"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/about/visimisi/edit-misi/') . esc($d_misi['id_misi']) ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Textarea Misi -->
                <div class="mb-4">
                    <label for="misi" class="form-label fw-semibold">Misi <span class="text-danger">*</span></label>
                    <textarea class="form-control form-control-lg rounded-3 shadow-sm"
                        name="misi"
                        id="misi"
                        rows="5"
                        placeholder="Masukkan misi perusahaan dengan jelas..."
                        required><?= esc($d_misi['misi']) ?></textarea>
                    <div class="form-text text-muted mt-1">
                        Gunakan bahasa singkat, jelas, dan bermakna.
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-gradient btn-md rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>