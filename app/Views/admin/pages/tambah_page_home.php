<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>

<style>
    /* Tombol */
    .btn-gradient {
        background: linear-gradient(135deg, #ffe259, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 500;
        transition: .3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #ffe259, #f3e69dff);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        color: #fff;
    }

    /* Focus brand (#d4ba34ff) */
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
    <!-- Judul & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold text-warning">
                <?= esc($sub_judul) ?>
            </h2>
            <p class="text-muted mb-0"><?= esc($sub_judul) ?></p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    Layout Home
                </a>
            </li>
            <li class="breadcrumb-item active text-dark">Tambah</li>
        </ol>
    </div>

    <!-- Tombol Kembali -->
    <div class="mb-3">
        <a href="<?= base_url('admin/pages/about') ?>" class="btn btn-shiny rounded-pill px-3">
            <i class="fa-solid fa-angle-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/tambah') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Upload Gambar (modern upload) -->
                <div class="mb-4">
                    <label for="img_about" class="form-label fw-semibold">Upload Gambar</label>
                    <div class="modern-upload">
                        <input type="file" id="img_about" name="image_about"
                            accept="image/png, image/jpeg, image/jpg" hidden required>
                        <label for="img_about" class="upload-box">
                            <i class="fa fa-cloud-upload-alt fa-2x mb-2"></i>
                            <span id="file-name">Klik untuk pilih gambar</span>
                        </label>
                    </div>
                    <small id="file-info" class="text-muted d-block mt-2">
                        <i class="fa fa-info-circle me-1"></i> PNG, JPG, JPEG | Maksimal 1 MB
                    </small>
                    <span id="file-error" class="text-danger d-none"></span>
                </div>

                <!-- Judul Jumbotron (form-floating) -->
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="judul_jumbotron"
                        name="judul_jumbotron"
                        value="<?= old('judul_jumbotron') ?>"
                        placeholder="Judul Jumbotron" required>
                    <label for="judul_jumbotron">Judul Jumbotron</label>
                </div>

                <!-- Paragraf Jumbotron (form-floating) -->
                <div class="form-floating mb-4">
                    <textarea class="form-control" id="paragraft_jumbotron"
                        name="paragraft_jumbo"
                        style="height: 120px"
                        placeholder="Paragraf Jumbotron" required><?= old('paragraft_jumbo') ?></textarea>
                    <label for="paragraft_jumbotron">Paragraf Jumbotron</label>
                </div>

                <!-- Judul About (form-floating) -->
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="judul_about"
                        name="judul_about"
                        value="<?= old('judul_about') ?>"
                        placeholder="Judul About" required>
                    <label for="judul_about">Judul About</label>
                </div>

                <!-- Paragraf About (form-floating) -->
                <div class="form-floating mb-4">
                    <textarea class="form-control" id="paragraft_about"
                        name="paragraft_about"
                        style="height: 120px"
                        placeholder="Paragraf About"><?= old('paragraft_about') ?></textarea>
                    <label for="paragraft_about">Paragraf About</label>
                </div>


                <!-- Tombol Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-shiny rounded-pill px-3">
                        <i class="fa-solid fa-file-arrow-down me-2"></i> Tambah Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS Validasi Upload (MIME + ≤1MB, reset jika salah) -->
<script>
    document.getElementById('img_about').addEventListener('change', function(e) {
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