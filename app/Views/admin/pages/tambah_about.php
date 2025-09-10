<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold text-warning mb-0"><?= esc($sub_judul) ?></h2>
            <p class="text-muted mb-0">Tambah data about dan isi dengan benar</p>
        </div>

        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/about') ?>" class="text-decoration-none text-secondary">
                    Layout About
                </a>
            </li>
            <li class="breadcrumb-item active text-dark">Tambah</li>
        </ol>
    </div>
    <div class="mb-3">
        <a class="btn btn-gradient mb-3 rounded-pill px-3"
            href="<?= base_url('admin/pages/about') ?>">
            <i class="fa-solid fa-angle-left me-1"></i> Kembali
        </a>
    </div>


    <!-- Card Form -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">


            <form action="<?= site_url('admin/pages/about/tambah') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Upload (modern upload) -->
                <div class="mb-4">
                    <label for="image_about" class="form-label fw-semibold">Upload Gambar</label>
                    <div class="modern-upload">
                        <input type="file" id="image_about" name="image_about"
                            accept="image/png, image/jpeg, image/jpg" hidden required>
                        <label for="image_about" class="upload-box">
                            <i class="fa fa-cloud-upload-alt fa-2x mb-2"></i>
                            <span id="file-name">Klik untuk pilih gambar</span>
                        </label>
                    </div>
                    <small id="file-info" class="text-muted d-block mt-2">
                        <i class="fa fa-info-circle me-1"></i> PNG, JPG, JPEG | Maksimal 1 MB
                    </small>
                    <span id="file-error" class="text-danger d-none"></span>
                    <span class="text-danger"><?= esc(session('errors')['image_about'] ?? '') ?></span>
                </div>

                <!-- Judul (form-floating) -->
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="judul_about"
                        name="judul_about" placeholder="Judul About"
                        value="<?= old('judul_about') ?>" required>
                    <label for="judul_about">Judul About</label>
                </div>

                <!-- Deskripsi/Title (form-floating) -->
                <div class="form-floating mb-4">
                    <textarea class="form-control" id="title_about" name="title_about"
                        style="height: 140px" placeholder="Deskripsi About"><?= old('title_about') ?></textarea>
                    <label for="title_about">Deskripsi About</label>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-gradient rounded-pill px-4">
                        <i class="fa-solid fa-file-circle-plus me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
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
        color: white;
        transition: all 0.3s ease;
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
        transition: all .3s ease;
        text-align: center;
        color: #6c757d;
    }

    .modern-upload .upload-box:hover {
        border-color: #d4ba34ff;
        color: #d4ba34ff;
        background: rgba(212, 186, 52, .05);
    }
</style>

<!-- JS Validasi Upload (MIME + ≤1MB; reset jika salah) -->
<script>
    document.getElementById('image_about').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const info = document.getElementById('file-info');
        const error = document.getElementById('file-error');
        const fileNameSpan = document.getElementById('file-name');

        if (file) {
            fileNameSpan.textContent = file.name;

            // validasi MIME
            const validExt = ['image/png', 'image/jpg', 'image/jpeg'];
            const isValidExt = validExt.includes(file.type);

            // validasi ukuran max 1 MB
            const isValidSize = file.size <= 1024 * 1024;

            if (isValidExt && isValidSize) {
                info.classList.remove('d-none');
                error.classList.add('d-none');
                error.textContent = "";
            } else {
                info.classList.add('d-none');
                error.classList.remove('d-none');

                if (!isValidExt) {
                    error.textContent = "Format file tidak valid. Gunakan PNG, JPG, atau JPEG.";
                } else if (!isValidSize) {
                    error.textContent = "Ukuran file terlalu besar. Maksimal 1 MB.";
                }

                // reset input biar tidak ikut terkirim
                e.target.value = "";
                fileNameSpan.textContent = "Klik untuk pilih gambar";
            }
        } else {
            // batal pilih
            fileNameSpan.textContent = "Klik untuk pilih gambar";
            info.classList.remove('d-none');
            error.classList.add('d-none');
            error.textContent = "";
        }
    });
</script>
<?= $this->endSection() ?>