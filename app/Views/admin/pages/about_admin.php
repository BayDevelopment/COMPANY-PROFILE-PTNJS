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
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
    }

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
</style>
<div class="container py-4 fade-in">
    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-warning mb-0"><?= esc($sub_judul) ?></h2>
            <small class="text-muted"><?= esc($sub_judul) ?></small>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>" class="text-black text-decoration-none"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">About</li>
        </ol>
    </div>

    <!-- Action Buttons -->
    <div class="mb-4">
        <?php if ($count_d_about < 1): ?>
            <a href="<?= base_url('admin/pages/about/tambah') ?>" class="btn btn-gradient rounded-pill shadow-sm">
                <i class="fa-solid fa-circle-plus me-2"></i> Tambah
            </a>
        <?php else: ?>
            <?php foreach ($d_about as $d_link): ?>
                <button onclick="confirmDeleteAbout(<?= $d_link['id_about'] ?>)" class="btn btn-gradient rounded-pill shadow-sm me-2">
                    <i class="fa-solid fa-circle-xmark me-2"></i> Hapus
                </button>
                <a href="<?= base_url('admin/pages/about/edit/' . $d_link['id_about']) ?>" class="btn btn-gradient rounded-pill shadow-sm me-2">
                    <i class="fa-solid fa-pen me-2"></i> Edit
                </a>
                <a href="<?= base_url('admin/pages/about/visimisi') ?>" class="btn btn-gradient rounded-pill shadow-sm">
                    <i class="fa-solid fa-eye me-2"></i> Visi & Misi
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <?php if (empty($d_about)): ?>
        <div class="text-center py-5">
            <img src="<?= base_url('assets/img/empty_data.png') ?>" class="img-fluid mb-3" style="max-width:220px;" alt="No Data">
            <h6 class="text-muted">Maaf, Tidak ada data yang ditampilkan saat ini!</h6>
        </div>
    <?php else: ?>
        <?php foreach ($d_about as $d_abouts): ?>
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-5">
                            <img src="<?= base_url('assets/uploads/' . $d_abouts['image_about']) ?>"
                                class="img-fluid rounded shadow-sm"
                                alt="PT. Najwa Jaya Sukses">
                        </div>
                        <div class="col-md-7">
                            <h4 class="fw-bold text-dark"><?= esc($d_abouts['judul_about']) ?></h4>
                            <p class="text-muted"><?= esc($d_abouts['title_about']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Visi Misi Section -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="fw-bold text-warning mb-3">Visi & Misi</h4>

                <!-- Visi -->
                <h6 class="fw-semibold">Visi</h6>
                <?php if (empty($d_visi)): ?>
                    <div class="alert alert-warning">Maaf, Tidak ada data visi saat ini!</div>
                <?php else: ?>
                    <?php foreach ($d_visi as $d_v): ?>
                        <p class="text-muted"><?= esc($d_v['visi']) ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Misi -->
                <h6 class="fw-semibold mt-3">Misi</h6>
                <?php if (empty($d_misi)): ?>
                    <div class="alert alert-warning">Maaf, Tidak ada data misi saat ini!</div>
                <?php else: ?>
                    <ul class="list-unstyled">
                        <?php foreach ($d_misi as $d_m): ?>
                            <li class="mb-2">
                                <i class="fa-solid fa-caret-right text-warning me-2"></i> <?= esc($d_m['misi']) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>