<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>

<div class="container fade-in">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
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
                <a href="<?= base_url('admin/pages/services') ?>" class="text-decoration-none text-secondary">
                    Services
                </a>
            </li>
            <li class="breadcrumb-item active text-dark">Detail</li>
        </ol>
    </div>

    <!-- Back Button -->
    <div class="mb-3">
        <a class="btn btn-gradient rounded-pill px-4 shadow-sm"
            href="<?= base_url('admin/pages/services') ?>">
            <i class="fa-solid fa-angle-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Content -->
    <div class="row g-4 mb-3">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="position-relative">
                    <img src="<?= base_url('assets/uploads/' . esc($slug_services['image_services'])) ?>"
                        class="w-100 img-fluid"
                        alt="PT. Najwa Jawa Sukses"
                        style="object-fit: cover; height: 350px;">
                    <span class="position-absolute top-0 end-0 m-3 badge bg-dark bg-opacity-50 text-white px-3 py-2 rounded-pill">
                        <?= esc($slug_services['title_services']) ?>
                    </span>
                </div>
                <div class="card-body">
                    <?php $d_status = reset($d_services_model); ?>
                    <?php if (!empty($d_status)): ?>
                        <?php if ($d_status['status'] === 'baru diupload'): ?>
                            <span class="badge rounded-pill bg-gradient px-3 py-2 mb-3"
                                style="background: linear-gradient(45deg, #007bff, #00c6ff);">
                                <i class="fa-solid fa-clock me-1"></i> <?= $d_status['status'] ?>
                            </span>
                        <?php else: ?>
                            <p class="text-muted small mb-3">
                                <i class="fa-solid fa-clock-rotate-left me-1"></i> <?= esc(formatTanggalLengkapIndonesia($d_status['created_at'])) ?>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <p class="lead lh-base"><?= esc($slug_services['deskripsi']) ?></p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="fa-solid fa-circle-info me-2 text-primary"></i> Informasi Tambahan
                </h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fa-solid fa-tag text-success me-2"></i> <strong>Kategori:</strong> Services</li>
                    <li class="mb-2"><i class="fa-solid fa-user text-info me-2"></i> <strong>Uploader:</strong> <span class="text-capitalize"><?= esc(session()->get('role')) ?></span></li>
                    <li><i class="fa-solid fa-calendar-days text-warning me-2"></i> <strong>Update:</strong> <?= esc(formatTanggalLengkapIndonesia($d_status['created_at'] ?? '-')) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Fade In Effect -->
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
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
    }

    .fade-in {
        animation: fadeIn 0.7s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?= $this->endSection() ?>