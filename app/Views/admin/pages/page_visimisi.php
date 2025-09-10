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

    .table thead th {
        background: linear-gradient(135deg, #ffe082, #ffca28);
        color: #444;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
</style>
<div class="container-fluid px-4 mb-3 fade-in">
    <!-- Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h2 class="fw-bold text-warning">Visi & Misi</h2>
            <p class="text-muted mb-0"><?= esc($sub_judul) ?></p>
        </div>

        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/about') ?>" class="text-decoration-none text-dark">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active text-dark"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <!-- Back button -->
    <div class="mb-4">
        <a href="<?= base_url('admin/pages/about') ?>" class="btn btn-gradient rounded-pill px-3">
            <i class="fa-solid fa-angle-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-12">
            <?php if (empty($d_visi) && empty($d_misi)): ?>
                <!-- Empty State -->
                <div class="text-center py-5 border rounded-4 shadow-sm bg-light">
                    <img src="/assets/img/empty_data.png" alt="Empty" class="mb-3" style="max-width:220px;">
                    <h5 class="fw-semibold text-muted mb-3">Belum ada data Visi & Misi</h5>
                    <a href="<?= base_url('admin/pages/about/visimisi/tambah-visi') ?>" class="btn btn-primary rounded-pill px-4">
                        <i class="fa-solid fa-plus me-2"></i> Tambah Visi
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty($d_visi)): ?>
                <!-- Card Visi -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header text-dark fw-bold rounded-top-4">
                        <i class="fa-solid fa-lightbulb me-2"></i> Visi
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:50px;">No</th>
                                        <th>Visi</th>
                                        <th style="width:200px;">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($d_visi as $dv): ?>
                                        <tr>
                                            <td><?= esc($no_visi++) ?>.</td>
                                            <td><?= esc($dv['visi']) ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/pages/about/misi/tambah/') . esc($dv['id_visi']) ?>"
                                                    class="btn btn-success btn-sm rounded-circle me-1" title="Tambah Misi">
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                                <a href="<?= base_url('admin/pages/about/visimisi/edit-visi/') . esc($dv['id_visi']) ?>"
                                                    class="btn btn-warning btn-sm rounded-circle me-1" title="Edit Visi">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <button onclick="confirmDeleteVisi(<?= esc($dv['id_visi']) ?>)"
                                                    class="btn btn-danger btn-sm rounded-circle" title="Hapus Visi">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($d_misi)): ?>
                <!-- Card Misi -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header text-dark fw-bold rounded-top-4">
                        <i class="fa-solid fa-bullseye me-2"></i> Misi
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:50px;">No</th>
                                        <th>Misi</th>
                                        <th style="width:200px;">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($d_misi as $dm): ?>
                                        <tr>
                                            <td><?= esc($no_misi++) ?>.</td>
                                            <td><?= esc($dm['misi']) ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/pages/about/visimisi/edit-misi/') . esc($dm['id_misi']) ?>"
                                                    class="btn btn-warning btn-sm rounded-circle me-1" title="Edit Misi">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <button onclick="confirmDeleteMisi(<?= esc($dm['id_misi']) ?>)"
                                                    class="btn btn-danger btn-sm rounded-circle" title="Hapus Misi">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function confirmDeleteVisi(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data visi yang dihapus tidak bisa dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/pages/about/visimisi/hapus-visi/') ?>" + id;
            }
        });
    }

    function confirmDeleteMisi(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data misi yang dihapus tidak bisa dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/pages/about/visimisi/hapus-misi/') ?>" + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>