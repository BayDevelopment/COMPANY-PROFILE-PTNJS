<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<div class="container py-4 fade-in">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h2 class="fw-bold text-warning"><?= esc($sub_judul) ?></h2>
            <p class="text-muted mb-0">Edit data layanan dengan mudah</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/services') ?>" class="text-decoration-none text-secondary">
                    Services
                </a>
            </li>
            <li class="breadcrumb-item active text-dark">Edit</li>
        </ol>
    </div>

    <div class="mb-3">
        <a href="<?= base_url('admin/pages/services') ?>" class="btn btn-gradient px-3 py-2 rounded-pill">
            <i class="fa-solid fa-angle-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/services/edit/') . esc($service['slug_services']) ?>"
                method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Preview -->
                <div class="text-center mb-4">
                    <img src="<?= base_url('/assets/uploads/') . esc($service['image_services']) ?>"
                        alt="Preview"
                        class="img-thumbnail rounded-4 shadow-sm"
                        style="max-height: 220px; object-fit: cover;">
                </div>

                <!-- Upload Modern -->
                <div class="mb-4">
                    <label for="image_services" class="form-label fw-semibold">Upload Gambar Baru</label>
                    <div class="modern-upload">
                        <input type="file" id="image_services" name="image_services" accept="image/*" hidden>
                        <label for="image_services" class="upload-box">
                            <i class="fa fa-cloud-upload-alt fa-2x mb-2"></i>
                            <span id="file-name">Klik untuk pilih gambar</span>
                        </label>
                    </div>
                    <small class="text-muted d-block mt-2">
                        <i class="fa fa-info-circle me-1"></i> PNG, JPG, JPEG - Maks 1 MB
                    </small>
                </div>

                <!-- Title -->
                <div class="form-floating mb-4">
                    <input type="text"
                        class="form-control"
                        id="title"
                        name="title_services"
                        value="<?= esc($service['title_services']) ?>"
                        placeholder="Title" required>
                    <label for="title">Title Services</label>
                </div>

                <!-- Deskripsi -->
                <div class="form-floating mb-4">
                    <textarea class="form-control"
                        id="deskripsi"
                        name="deskripsi"
                        style="height: 120px;"
                        placeholder="Masukkan deskripsi layanan..."><?= esc($service['deskripsi']) ?></textarea>
                    <label for="deskripsi">Deskripsi</label>
                </div>

                <!-- Tombol -->
                <!-- Tombol -->
                <div class="text-end">
                    <button type="submit" class="btn btn-gradient px-3 py-2 rounded-pill">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Style Modern -->
<style>
    /* Animasi Fade In */
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

    .text-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .2);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        border: none;
        transition: all 0.3s ease;
        color: white;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        transform: translateY(-2px);
    }

    /* Upload */
    .modern-upload .upload-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed #6c757d;
        border-radius: 12px;
        padding: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        color: #6c757d;
    }

    .modern-upload .upload-box:hover {
        border-color: #d4ba34ff;
        color: #d4ba34ff;
        background: rgba(13, 110, 253, 0.05);
    }
</style>

<!-- Script Preview Nama File -->
<script>
    document.getElementById('image_services').addEventListener('change', function(e) {
        let fileName = e.target.files.length ? e.target.files[0].name : "Klik untuk pilih gambar";
        document.getElementById('file-name').textContent = fileName;
    });
</script>
<?= $this->endSection() ?>