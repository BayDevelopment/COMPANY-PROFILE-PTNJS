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
    }

    .card:hover {
        transform: translateY(-5px);
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

<div class="container fade-in">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold text-warning">Manajemen Services</h1>
            <p class="text-muted mb-0">Kelola data layanan dengan mudah</p>
        </div>
        <div>
            <a class="btn btn-shiny text-white fw-semibold shadow-sm rounded-pill px-3 me-2"
                href="<?= base_url('admin/pages/services/tambah') ?>" role="button">
                <i class="fa-solid fa-file-circle-plus"></i> Tambah
            </a>
            <a class="btn btn-shiny fw-semibold shadow-sm rounded-pill px-3"
                href="<?= base_url('admin/pages/services') ?>" role="button">
                <i class="fa-solid fa-repeat"></i> Reload
            </a>
        </div>
    </div>



    <!-- 🔎 Filter Section -->
    <form method="get" action="<?= base_url('admin/pages/services') ?>" class="row g-3 mb-4">
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="baru diupload" <?= (isset($_GET['status']) && $_GET['status'] == 'baru diupload') ? 'selected' : '' ?>>Baru diupload</option>
                <option value="lama" <?= (isset($_GET['status']) && $_GET['status'] == 'lama') ? 'selected' : '' ?>>Lama</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="bulan" class="form-select">
                <option value="">Semua Bulan</option>
                <?php
                $bulan = [
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember'
                ];
                foreach ($bulan as $key => $val): ?>
                    <option value="<?= $key ?>" <?= (isset($_GET['bulan']) && $_GET['bulan'] == $key) ? 'selected' : '' ?>><?= $val ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="tahun" class="form-select">
                <option value="">Semua Tahun</option>
                <?php
                $tahunSekarang = date('Y');
                for ($t = $tahunSekarang; $t >= 2020; $t--): ?>
                    <option value="<?= $t ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $t) ? 'selected' : '' ?>><?= $t ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-warning w-100"><i class="fa fa-search"></i> Cari</button>
        </div>
    </form>

    <section>
        <div class="row mb-3">
            <?php if ($count_services < 1): ?>
                <div class="text-center">
                    <img src="/assets/img/empty_data.png" alt="Data kosong" class="img-fluid" style="max-width:250px;">
                    <h6 class="text-muted mt-3">Maaf, Tidak ada data saat ini!</h6>
                </div>
            <?php else: ?>
                <?php foreach ($d_services_model as $d_services): ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card h-100">
                            <img src="<?= base_url('/assets/uploads/' . esc($d_services['image_services'])) ?>"
                                class="card-img-top"
                                alt="<?= esc($d_services['title_services']) ?>">
                            <div class="card-body">
                                <?php if ($d_services['status'] === "baru diupload") : ?>
                                    <span class="badge bg-primary mb-2"><i class="fa-solid fa-clock"></i> <?= esc($d_services['status']) ?></span>
                                <?php else: ?>
                                    <p class="small text-muted mb-2">
                                        <i class="fa-solid fa-clock-rotate-left"></i> <?= esc(formatTanggalIndonesia($d_services['created_at'])) ?>
                                    </p>
                                <?php endif; ?>

                                <h5 class="card-title"><?= esc($d_services['title_services']) ?></h5>
                                <p class="card-text text-truncate"><?= esc($d_services['deskripsi']) ?></p>

                                <div class="d-flex justify-content-between mt-3">
                                    <a class="btn btn-sm btn-shiny rounded-pill px-3" href="<?= base_url('admin/pages/services/edit/') . $d_services['slug_services'] ?>"><i class="fa-solid fa-pen"></i> Edit</a>
                                    <a class="btn btn-sm btn-shiny rounded-pill px-3" href="#" onclick="confirmDeleteServices(<?= $d_services['id_services'] ?>)"><i class="fa-solid fa-trash"></i> Hapus</a>
                                    <a class="btn btn-sm btn-shiny rounded-pill px-3" href="<?= base_url('admin/pages/services/detail/' . esc($d_services['slug_services'])) ?>"><i class="fa-solid fa-eye"></i> Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>