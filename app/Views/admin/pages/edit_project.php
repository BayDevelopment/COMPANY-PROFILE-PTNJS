<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<div class="container py-4 fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h2 class="fw-bold text-warning"><?= esc($sub_judul) ?></h2>
            <p class="text-muted mb-0">Edit detail project dan simpan perubahan</p>
        </div>

        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/project') ?>" class="text-decoration-none text-secondary">
                    Project
                </a>
            </li>
            <li class="breadcrumb-item active text-dark">Edit</li>
        </ol>
    </div>

    <!-- Back Button -->
    <div class="mb-3">
        <a href="<?= base_url('admin/pages/project') ?>" class="btn btn-gradient px-3 py-2 rounded-pill">
            <i class="fa-solid fa-angle-left"></i> Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <form action="<?= site_url('admin/pages/project/edit/') . esc($data_project['id_project']) ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Upload Modern -->
                <div class="mb-4">
                    <label for="gambar" class="form-label fw-semibold">Upload Gambar Project (opsional)</label>

                    <?php if (!empty($data_project['gambar'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('assets/uploads/' . esc($data_project['gambar'])) ?>"
                                alt="Gambar saat ini"
                                class="img-thumbnail"
                                style="max-height:140px">
                        </div>
                    <?php endif; ?>

                    <div class="modern-upload">
                        <input type="file" id="gambar" name="gambar" accept="image/*" hidden>
                        <label for="gambar" class="upload-box">
                            <i class="fa fa-cloud-upload-alt fa-2x mb-2"></i>
                            <span id="file-name">Klik untuk pilih gambar (biarkan kosong jika tidak diganti)</span>
                        </label>
                    </div>

                    <!-- Info default -->
                    <small id="file-info" class="text-muted d-block mt-2">
                        <i class="fa fa-info-circle me-1"></i> PNG, JPG, JPEG - Maksimal 1 MB
                    </small>

                    <!-- Pesan error client-side -->
                    <span id="file-error" class="text-danger d-none"></span>
                    <!-- Pesan error server-side -->
                    <span class="text-danger"><?= esc(session('errors')['gambar'] ?? '') ?></span>
                </div>

                <!-- Nama Project -->
                <div class="form-floating mb-4">
                    <input type="text"
                        class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>"
                        id="name"
                        name="name"
                        value="<?= old('name') ?? esc($data_project['name']) ?>"
                        placeholder="Masukan nama project" required>
                    <label for="name">Nama Project</label>
                    <div class="invalid-feedback"><?= esc(session('errors')['name'] ?? '') ?></div>
                </div>

                <!-- Deskripsi -->
                <div class="form-floating mb-4">
                    <textarea class="form-control <?= session('errors.description') ? 'is-invalid' : '' ?>"
                        id="description"
                        name="description"
                        style="height: 120px;"
                        placeholder="Masukan deskripsi project..." required><?= old('description') ?? esc($data_project['description']) ?></textarea>
                    <label for="description">Deskripsi</label>
                    <div class="invalid-feedback"><?= esc(session('errors')['description'] ?? '') ?></div>
                </div>

                <!-- Tanggal Mulai -->
                <div class="form-floating mb-4">
                    <input type="date"
                        class="form-control <?= session('errors.start_date') ? 'is-invalid' : '' ?>"
                        id="start"
                        name="start_date"
                        value="<?= old('start_date') ?? esc($data_project['start_date']) ?>"
                        placeholder="Tanggal Mulai" required>
                    <label for="start">Tanggal Mulai</label>
                    <div class="invalid-feedback"><?= esc(session('errors')['start_date'] ?? '') ?></div>
                </div>

                <!-- Tanggal Selesai (opsional) -->
                <div class="form-floating mb-1">
                    <input type="date"
                        class="form-control <?= session('errors.end_date') ? 'is-invalid' : '' ?>"
                        id="end"
                        name="end_date"
                        value="<?= old('end_date') ?? esc($data_project['end_date']) ?>"
                        placeholder="Tanggal Selesai">
                    <label for="end">Tanggal Selesai</label>
                    <div class="invalid-feedback"><?= esc(session('errors')['end_date'] ?? '') ?></div>
                </div>
                <small class="text-muted d-block mb-3">
                    Kosongkan jika Anda belum tahu tanggal selesai.
                </small>

                <!-- Status -->
                <div class="form-floating mb-4">
                    <?php $selectedStatus = old('status') ?? $data_project['status']; ?>
                    <select class="form-select <?= session('errors.status') ? 'is-invalid' : '' ?>"
                        id="status" name="status" required>
                        <option value="" disabled>-- PILIH STATUS --</option>
                        <option value="pending" <?= $selectedStatus === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="in_progress" <?= $selectedStatus === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                        <option value="completed" <?= $selectedStatus === 'completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                    <label for="status">Status Project</label>
                    <div class="invalid-feedback"><?= esc(session('errors')['status'] ?? '') ?></div>
                </div>

                <!-- Tombol -->
                <div class="text-end">
                    <button type="submit" class="btn btn-gradient px-3 py-2 rounded-pill">
                        <i class="fa-solid fa-file-pen"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Style Modern -->
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

<!-- Script Validasi File -->
<script>
    document.getElementById('gambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const info = document.getElementById('file-info');
        const error = document.getElementById('file-error');
        const fileNameSpan = document.getElementById('file-name');

        if (!file) {
            fileNameSpan.textContent = "Klik untuk pilih gambar (biarkan kosong jika tidak diganti)";
            info.classList.remove('d-none');
            error.classList.add('d-none');
            error.textContent = "";
            return;
        }

        fileNameSpan.textContent = file.name;

        // Validasi MIME dan ukuran (<= 1MB)
        const validExt = ['image/png', 'image/jpg', 'image/jpeg'];
        const isValidExt = validExt.includes(file.type);
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
                alert("Ukuran file terlalu besar. Maksimal 1 MB."); // alert client-side
            }

            // reset input agar tidak terkirim
            e.target.value = "";
            fileNameSpan.textContent = "Klik untuk pilih gambar (biarkan kosong jika tidak diganti)";
        }
    });
</script>
<?= $this->endSection() ?>