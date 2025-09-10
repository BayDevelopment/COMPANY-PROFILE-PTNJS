<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>

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

    .card {
        box-shadow: rgba(250, 215, 17, 0.56) 1.95px 1.95px 2.6px;
        transition: transform 0.2s;
        border: none;
        border-radius: 14px;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        border: none;
        color: #fff !important;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d4ba34ff, #c7a600);
        transform: translateY(-2px);
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
    }
</style>

<div class="container fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold text-warning"> Manajemen Project</h1>
            <p class="text-muted mb-0">Kelola data project perusahaan dengan mudah</p>
        </div>
        <div>
            <a class="btn btn-gradient text-white fw-semibold shadow-sm rounded-pill px-3 me-2"
                href="<?= base_url('admin/pages/project/tambah') ?>" role="button">
                <i class="fa-solid fa-file-circle-plus"></i> Tambah
            </a>
            <a class="btn btn-dark fw-semibold shadow-sm rounded-pill px-3"
                href="<?= base_url('admin/pages/project') ?>" role="button">
                <i class="fa-solid fa-repeat"></i> Reload
            </a>
        </div>
    </div>
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="">-- Semua --</option>
                <option value="pending" <?= ($filter['status'] ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= ($filter['status'] ?? '') == 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="in_progress" <?= ($filter['status'] ?? '') == 'in_progress' ? 'selected' : '' ?>>Progress</option>
            </select>
        </div>

        <div class="col-md-2">
            <label>Tahun</label>
            <input type="number" name="tahun" value="<?= esc($filter['tahun'] ?? '') ?>" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="mulai" value="<?= esc($filter['mulai'] ?? '') ?>" class="form-control">
        </div>

        <div class="col-md-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="selesai" value="<?= esc($filter['selesai'] ?? '') ?>" class="form-control">
        </div>

        <div class="col-md-1 d-flex align-items-end">
            <button type="submit" class="btn btn-warning w-100">
                <i class="fa fa-filter"></i>
            </button>
        </div>
    </form>


    <!-- Data -->
    <section>
        <div class="row mb-3">
            <?php if ($count_projects < 1): ?>
                <div class="text-center">
                    <img src="/assets/img/empty_data.png" alt="Data kosong"
                        class="img-fluid" style="max-width:250px;">
                    <h6 class="text-muted mt-3">Maaf, Tidak ada data project saat ini!</h6>
                </div>
            <?php else: ?>
                <?php foreach ($d_project as $d_p): ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card h-100">
                            <img src="<?= base_url('assets/uploads/' . esc($d_p['gambar'])) ?>"
                                class="card-img-top"
                                alt="<?= esc($d_p['name']) ?>"
                                style="max-height:200px; object-fit:cover;">

                            <div class="card-body">
                                <!-- Status -->
                                <?php if ($d_p['status'] === "pending") : ?>
                                    <span class="badge bg-primary mb-2"><i class="fa-solid fa-clock"></i> Pending</span>
                                <?php elseif ($d_p['status'] === "in_progress") : ?>
                                    <span class="badge bg-warning mb-2"><i class="fa-solid fa-spinner"></i> In Progress</span>
                                <?php elseif ($d_p['status'] === "completed") : ?>
                                    <span class="badge bg-success mb-2"><i class="fa-solid fa-check"></i> Completed</span>
                                <?php endif; ?>

                                <!-- Nama & Deskripsi -->
                                <h5 class="card-title fw-bold"><?= esc($d_p['name']) ?></h5>
                                <p class="card-text text-truncate"><?= esc($d_p['description']) ?></p>

                                <!-- Info Tanggal -->
                                <?php if ($d_p['status'] === "pending") : ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <i class="fa-solid fa-bell"></i> Menunggu persetujuan!
                                    </div>
                                <?php else: ?>
                                    <div class="mt-3 small text-muted">
                                        <p class="mb-1"><i class="fa-solid fa-calendar-day"></i> Mulai:
                                            <span class="fw-semibold text-dark"><?= esc(formatTanggalIndonesia($d_p['start_date'])) ?></span>
                                        </p>
                                        <p class="mb-0"><i class="fa-solid fa-calendar-check"></i> Selesai:
                                            <span class="fw-semibold text-dark"><?= esc(formatTanggalIndonesia($d_p['end_date'])) ?></span>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <!-- Aksi -->
                                <div class="d-flex justify-content-between mt-4">
                                    <a class="btn btn-sm btn-gradient rounded-pill px-3"
                                        href="<?= base_url('admin/pages/project/edit/') . $d_p['id_project'] ?>">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <a class="btn btn-sm btn-gradient rounded-pill px-3"
                                        href="#" onclick="confirmDeleteProject(<?= $d_p['id_project'] ?>)">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</div>

<script>
    function confirmDeleteProject(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/pages/project/hapus/') ?>" + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>