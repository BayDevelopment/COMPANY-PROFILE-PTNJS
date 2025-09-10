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
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        color: #fff;
    }

    /* Focus brand */
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

    /* Modern upload */
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
        background: rgba(212, 186, 52, .06);
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2 class="fw-bold text-warning">
            <?= esc($sub_judul) ?>
        </h2>
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
            <li class="breadcrumb-item active text-dark">Edit</li>
        </ol>
    </div>

    <div class="mb-3">
        <a href="<?= base_url('admin/pages/about') ?>" class="btn btn-gradient px-3 py-2 rounded-pill">
            <i class="fa-solid fa-angle-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/about/edit/') . esc($d_about_id['id_about']) ?>"
                method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Preview Gambar -->
                <div class="mb-4 text-center">
                    <img src="<?= base_url('/assets/uploads/') . esc($d_about_id['image_about']) ?>"
                        alt="PT. Najwa Jaya Sukses"
                        class="img-fluid rounded shadow" style="max-height: 220px; object-fit: cover;">
                </div>

                <!-- Upload Gambar (modern upload) -->
                <div class="mb-4">
                    <label for="img_about" class="form-label fw-semibold">Upload Image About (opsional)</label>
                    <div class="modern-upload">
                        <input type="file" id="img_about" name="image_about"
                            accept="image/png, image/jpeg, image/jpg" hidden>
                        <label for="img_about" class="upload-box" id="img_about_label">
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

                <!-- Judul About (form-floating) -->
                <div class="form-floating mb-4">
                    <input type="text" class="form-control"
                        id="judul_about"
                        name="judul_about"
                        value="<?= old('judul_about') ?? esc($d_about_id['judul_about']) ?>"
                        placeholder="Judul About" required>
                    <label for="judul_about">Judul About</label>
                </div>

                <!-- Title About (form-floating) -->
                <div class="form-floating mb-4">
                    <textarea class="form-control"
                        id="title_about"
                        name="title_about"
                        style="height: 140px"
                        placeholder="Title About"><?= old('title_about') ?? esc($d_about_id['title_about']) ?></textarea>
                    <label for="title_about">Title About</label>
                </div>

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

<!-- JS Validasi Upload (MIME + ≤1MB; reset jika salah) -->
<script>
    document.getElementById("img_about").addEventListener("change", function(e) {
        const file = e.target.files[0];
        const fileNameSpan = document.getElementById("file-name");
        const info = document.getElementById("file-info");
        const error = document.getElementById("file-error");

        if (file) {
            fileNameSpan.textContent = file.name;

            // validasi MIME
            const validMimes = ['image/png', 'image/jpg', 'image/jpeg'];
            const isMimeOk = validMimes.includes(file.type);

            // validasi ukuran <= 1MB
            const isSizeOk = file.size <= 1024 * 1024;

            if (isMimeOk && isSizeOk) {
                info.classList.remove('d-none');
                error.classList.add('d-none');
                error.textContent = '';
            } else {
                info.classList.add('d-none');
                error.classList.remove('d-none');
                error.textContent = !isMimeOk ?
                    'Format file tidak valid. Gunakan PNG, JPG, atau JPEG.' :
                    'Ukuran file terlalu besar. Maksimal 1 MB.';

                // reset input & label
                e.target.value = '';
                fileNameSpan.textContent = 'Klik untuk pilih gambar';
            }
        } else {
            // batal pilih
            fileNameSpan.textContent = 'Klik untuk pilih gambar';
            info.classList.remove('d-none');
            error.classList.add('d-none');
            error.textContent = '';
        }
    });
</script>

<?= $this->endSection() ?>