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

    .form-control:focus,
    .form-select:focus {
        border-color: #d4ba34ff;
        box-shadow: 0 0 0 0.2rem rgba(212, 186, 52, .25);
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
        background: rgba(212, 186, 52, 0.05);
    }
</style>
<div class="container-fluid px-4 fade-in">
    <!-- Judul & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h2 class="fw-bold text-warning"><?= esc($sub_judul) ?></h2>
            <p class="text-muted mb-0">Tambah services baru dengan detail lengkap</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/services') ?>" class="text-decoration-none text-secondary">
                    Service's
                </a>
            </li>
            <li class="breadcrumb-item active text-dark">Tambah</li>
        </ol>
    </div>

    <div class="mb-3">
        <a href="<?= base_url('admin/pages/services') ?>" class="btn btn-gradient px-3 py-2 rounded-pill">
            <i class="fa-solid fa-angle-left"></i> Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/services/tambah') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Upload Modern -->
                <div class="mb-4">
                    <label for="image_services" class="form-label fw-semibold">Upload Gambar Project</label>
                    <div class="modern-upload">
                        <input type="file" id="image_services" name="image_services" accept="image/*" hidden required>
                        <label for="image_services" class="upload-box">
                            <i class="fa fa-cloud-upload-alt fa-2x mb-2"></i>
                            <span id="file-name">Klik untuk pilih gambar</span>
                        </label>
                    </div>

                    <!-- Info default -->
                    <small id="file-info" class="text-muted d-block mt-2">
                        <i class="fa fa-info-circle me-1"></i> PNG, JPG, JPEG - Maksimal 1 MB
                    </small>

                    <!-- Pesan error -->
                    <span id="file-error" class="text-danger d-none"></span>
                </div>

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">Title Services</label>
                    <input type="text" class="form-control" id="title" name="title_services" placeholder="Contoh: Mechanic" value="<?= old('title_services') ?>" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="4" name="deskripsi" placeholder="Masukan deskripsi services.."><?= old('deskripsi') ?></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-gradient rounded-pill px-4">
                        <i class="fa-solid fa-file-circle-plus me-2"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk menampilkan nama file -->
<script>
    document.getElementById('image_services').addEventListener('change', function(e) {
        let fileName = e.target.files.length ? e.target.files[0].name : "Klik untuk pilih gambar";
        document.getElementById('file-name').textContent = fileName;
    });

    // logika js file ekstensi dan ukuran
    document.getElementById('image_services').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const info = document.getElementById('file-info');
        const error = document.getElementById('file-error');
        const fileNameSpan = document.getElementById('file-name');

        if (file) {
            fileNameSpan.textContent = file.name;

            // validasi ekstensi
            const validExt = ['image/png', 'image/jpg', 'image/jpeg'];
            const isValidExt = validExt.includes(file.type);

            // validasi ukuran max 1 MB
            const isValidSize = file.size <= 1024 * 1024;

            if (isValidExt && isValidSize) {
                info.classList.remove('d-none');
                error.classList.add('d-none');
            } else {
                info.classList.add('d-none');
                error.classList.remove('d-none');
                if (!isValidExt) {
                    error.textContent = "Format file tidak valid. Gunakan PNG, JPG, atau JPEG.";
                } else if (!isValidSize) {
                    error.textContent = "Ukuran file terlalu besar. Maksimal 1 MB.";
                }
                e.target.value = ""; // reset file input biar kosong lagi
                fileNameSpan.textContent = "Klik untuk pilih gambar";
            }
        }
    });
</script>

<?= $this->endSection() ?>