<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>

<div class="container py-4 fade-in">
    <!-- Title & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
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
            <li class="breadcrumb-item active text-dark">Edit</li>
        </ol>
    </div>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="<?= base_url('admin/pages/home') ?>" class="btn btn-gradient px-3 py-2 rounded-pill shadow-sm">
            <i class="fa-solid fa-angle-left me-2"></i> Kembali
        </a>
    </div>

    <?php if ($jumlahFast_model < 1): ?>
        <div class="text-center my-5">
            <img src="<?= base_url('/assets/img/img_empty.svg') ?>" alt="PT. Najwa Jaya Sukses"
                class="img-fluid mb-3" style="max-width:280px;">
            <p class="fw-semibold text-muted">Maaf, tidak ditemukan data saat ini!</p>
        </div>
    <?php else: ?>
        <?php foreach ($data_firstHome as $d_f): ?>
            <div class="card shadow-lg border-0 rounded-4 form-glass mb-4">
                <div class="card-body p-4">
                    <form action="<?= site_url('admin/pages/edit-home-first/' . $d_f['id_home_first']) ?>"
                        method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Upload Gambar About (tidak bisa form-floating) -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload Image About</label>

                            <?php if (!empty($d_f['image_about'])): ?>
                                <div class="mb-2">
                                    <img src="<?= base_url('assets/uploads/' . esc($d_f['image_about'])) ?>"
                                        alt="Preview" class="img-thumbnail rounded-4 shadow-sm"
                                        style="max-height: 200px; object-fit: cover;">
                                </div>
                            <?php endif; ?>

                            <div class="custom-file-upload modern-upload">
                                <input type="file"
                                    class="form-control d-none js-img-about"
                                    id="img_about_<?= esc($d_f['id_home_first']) ?>"
                                    name="image_about"
                                    accept="image/png, image/jpeg, image/jpg">
                                <label for="img_about_<?= esc($d_f['id_home_first']) ?>"
                                    class="upload-label upload-box js-upload-label">
                                    <i class="fa fa-cloud-upload-alt me-2"></i>
                                    <span class="file-name">Pilih Gambar</span>
                                </label>


                                <!-- Info default -->
                                <small class="text-muted d-block mt-2 file-info">
                                    <i class="fa fa-info-circle me-1"></i> PNG, JPG, JPEG | Maksimal 1 MB
                                </small>
                                <!-- Pesan error client-side -->
                                <span class="text-danger d-none file-error"></span>
                                <!-- Pesan error server-side (jika ada) -->
                                <span class="text-danger"><?= esc(session('errors')['image_about'] ?? '') ?></span>
                            </div>
                        </div>


                        <!-- Judul Jumbotron -->
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control"
                                id="judul_jumbotron_<?= esc($d_f['id_home_first']) ?>"
                                name="judul_jumbotron"
                                value="<?= esc($d_f['judul_jumbotron']) ?>"
                                placeholder="Judul Jumbotron" required>
                            <label for="judul_jumbotron_<?= esc($d_f['id_home_first']) ?>">Judul Jumbotron</label>
                        </div>

                        <!-- Paragraf Jumbotron -->
                        <div class="form-floating mb-4">
                            <textarea class="form-control"
                                id="paragraft_jumbotron_<?= esc($d_f['id_home_first']) ?>"
                                name="paragraft_jumbo"
                                style="height: 120px"
                                placeholder="Paragraf Jumbotron" required><?= esc($d_f['paragraft_jumbo']) ?></textarea>
                            <label for="paragraft_jumbotron_<?= esc($d_f['id_home_first']) ?>">Paragraf Jumbotron</label>
                        </div>

                        <!-- Judul About -->
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control"
                                id="judul_about_<?= esc($d_f['id_home_first']) ?>"
                                name="judul_about"
                                value="<?= esc($d_f['judul_about']) ?>"
                                placeholder="Judul About" required>
                            <label for="judul_about_<?= esc($d_f['id_home_first']) ?>">Judul About</label>
                        </div>

                        <!-- Paragraf About -->
                        <div class="form-floating mb-4">
                            <textarea class="form-control"
                                id="paragraft_about_<?= esc($d_f['id_home_first']) ?>"
                                name="paragraft_about"
                                style="height: 120px"
                                placeholder="Paragraf About"><?= esc($d_f['paragraft_about']) ?></textarea>
                            <label for="paragraft_about_<?= esc($d_f['id_home_first']) ?>">Paragraf About</label>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-gradient px-4 py-2 rounded-pill shadow-lg">
                                <i class="fa-solid fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Custom CSS -->
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

    .btn-gradient {
        background: linear-gradient(135deg, #ffe259, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 600;
        transition: .3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, .18);
        color: #fff;
    }

    .form-glass {
        background: rgba(255, 255, 255, .85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, .2);
    }

    /* Upload */
    .modern-upload .upload-box {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        border: 2px dashed #6c757d;
        border-radius: 12px;
        padding: 14px 18px;
        cursor: pointer;
        transition: all .3s ease;
        color: #6c757d;
        text-align: center;
    }

    .modern-upload .upload-box:hover {
        border-color: #d4ba34ff;
        color: #d4ba34ff;
        background: rgba(212, 186, 52, .06);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #d4ba34ff;
        box-shadow: 0 0 0 0.2rem rgba(212, 186, 52, .25);
    }
</style>

<!-- Script Validasi File (MIME + Size ≤ 1MB, hide/show info) -->
<script>
    document.querySelectorAll('.js-img-about').forEach(function(input) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];

            // ambil elemen terkait di wrapper yang sama
            const wrapper = e.target.closest('.custom-file-upload');
            const info = wrapper.querySelector('.file-info'); // <small> info default
            const error = wrapper.querySelector('.file-error'); // <span> pesan error
            const fileNameSpan = wrapper.querySelector('.file-name'); // span di dalam label

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
                    error.textContent = '';
                } else {
                    info.classList.add('d-none');
                    error.classList.remove('d-none');

                    if (!isValidExt) {
                        error.textContent = "Format file tidak valid. Gunakan PNG, JPG, atau JPEG.";
                    } else if (!isValidSize) {
                        error.textContent = "Ukuran file terlalu besar. Maksimal 1 MB.";
                    }

                    // reset input biar tidak terkirim
                    e.target.value = "";
                    fileNameSpan.textContent = "Pilih Gambar";
                }
            }
        });
    });
</script>


<?= $this->endSection() ?>