<?= $this->extend('layouts/public') ?>

<?= $this->section('content_public') ?>

<style>
    /* ---- Utilities, look & feel ---- */
    .hero {
        background: radial-gradient(1200px 600px at 10% 10%, rgba(253, 189, 13, 0.12), transparent),
            linear-gradient(180deg, rgba(253, 189, 13, 0.12), transparent 60%);
        border-radius: 1.25rem;
        padding: 2.5rem 1.5rem;
    }

    .hero .title {
        font-weight: 800;
        letter-spacing: .3px;
    }

    .hero .subtitle {
        color: #6c757d;
        max-width: 820px;
    }

    .card-service {
        border: none;
        border-radius: 1.25rem;
        box-shadow: 0 10px 24px rgba(16, 24, 40, 0.06);
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
        height: 100%;
    }

    .card-service:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 36px rgba(16, 24, 40, 0.10);
    }

    .ratio-16x9 {
        aspect-ratio: 16/9;
        width: 100%;
        object-fit: cover;
    }

    .badge-float {
        position: absolute;
        top: .75rem;
        left: .75rem;
        z-index: 2;
        border-radius: 999px;
        padding: .4rem .7rem;
        box-shadow: 0 6px 14px rgba(13, 110, 253, .25);
    }

    .meta-time {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-size: .875rem;
        color: #6c757d;
    }

    .meta-time i {
        opacity: .8;
    }

    /* Empty state */
    .empty-state {
        border: 1px dashed #dee2e6;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        background: #f8f9fa;
    }

    .empty-state img {
        width: 220px;
        max-width: 60%;
        opacity: .85;
    }

    .empty-state h6 {
        margin-top: 1rem;
        color: #6c757d;
    }

    /* Partner carousel */
    .section_partner {
        margin-top: 3rem;
        padding: 2rem 0;
        border-top: 1px solid #f1f3f5;
    }

    .partner-title {
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .img_owl_carousel {
        filter: grayscale(100%);
        opacity: .8;
        transition: filter .25s ease, opacity .25s ease, transform .25s ease;
        max-height: 60px;
        width: auto;
        margin: 0 auto;
    }

    .owl-carousel .item {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .img_owl_carousel:hover {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.03);
    }

    /* Small helpers */
    .btn-soft-warning {
        background: rgba(253, 209, 13, 0.16);
        color: #1f1e1cff;
        border: none;
    }

    .btn-soft-warning:hover {
        background: rgba(253, 209, 13, 0.16);
        color: #1f1e1cff;
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

    .ribbon {
        position: absolute;
        top: .75rem;
        left: .75rem;
        z-index: 2;
        background: #fae20dff;
        color: #fff;
        padding: .35rem .7rem;
        border-radius: 999px;
        font-size: .8rem;
        box-shadow: 0 8px 18px rgba(253, 209, 13, 0.35);
    }
</style>

<div class="container my-4 my-md-5" style="margin-top: 50px;">

    <?php if (empty($d_all_services)): ?>
        <!-- EMPTY STATE -->
        <div class="empty-state">
            <img src="<?= base_url('/assets/img/empty_data.png') ?>" alt="Tidak ada data" loading="lazy">
            <h6>Maaf, tidak ada data yang ditampilkan saat ini!</h6>
            <div class="mt-3">
                <a href="<?= base_url('/') ?>" class="btn btn-soft-warning btn-sm px-3">
                    <i class="fa-solid fa-arrow-left-long me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>

    <?php else: ?>
        <!-- HERO / INTRO -->
        <section class="hero mb-4 mb-md-5 mt-5">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="title h2 mb-2"><?= esc($page_title) ?></div>
                    <p class="subtitle mb-0">
                        PT. Najwa Jaya Sukses menyediakan solusi terintegrasi di bidang konstruksi, mekanikal, elektrikal, dll
                        yang didukung oleh teknologi modern dan tenaga ahli berpengalaman. Kami berkomitmen menghadirkan layanan
                        terbaik dengan kualitas, efisiensi, dan keberlanjutan dalam setiap proyek.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('contact') ?>" class="btn btn-warning px-3">
                        <i class="fa-solid fa-paper-plane me-2"></i>Hubungi Kami
                    </a>
                    <a href="<?= base_url('pages/services') ?>" class="btn btn-soft-warning px-3">
                        <i class="fa-solid fa-list-check me-2"></i>Lihat Semua Layanan
                    </a>
                </div>
            </div>
        </section>


        <!-- SERVICE CARD -->
        <section class="section_content_services">
            <div class="row g-4">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card card-service position-relative">
                        <?php
                        // Fallback image jika kosong
                        $img = !empty($d_status['image_services'])
                            ? base_url('/assets/uploads/' . esc($d_status['image_services']))
                            : base_url('/assets/img/placeholder-16x9.jpg');
                        ?>
                        <?php if ($d_status['status'] === 'baru diupload'): ?>
                            <div class="ribbon"><i class="fa-solid fa-bolt me-1"></i><?= esc($d_status['status']) ?></div>
                        <?php endif; ?>
                        <img
                            src="<?= $img ?>"
                            class="ratio-16x9"
                            alt="<?= esc($d_status['title_services'] ?? 'Layanan') ?>"
                            loading="lazy">

                        <div class="card-body p-4">
                            <h3 class="h4 mb-2"><?= esc($d_status['title_services']) ?></h3>

                            <div class="mb-3">
                                <?php if (!empty($d_status['status']) && $d_status['status'] !== 'baru diupload'): ?>
                                    <span class="meta-time">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        <?= esc(formatTanggalIndonesia($d_status['created_at'])) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="meta-time">
                                        <i class="fa-solid fa-clock"></i>
                                        Baru diunggah dalam 7 hari terakhir
                                    </span>
                                <?php endif; ?>
                            </div>

                            <p class="mb-4">
                                <?= esc($d_status['deskripsi']) ?>
                            </p>

                            <div class="d-flex gap-2">
                                <a href="<?= base_url('pages/services') ?>" class="btn btn-shiny">
                                    <i class="fa-solid fa-angle-left me-2"></i>Kembali
                                </a>
                                <a href="<?= base_url('pages/contact') ?>" class="btn btn-shiny">
                                    <i class="fa-solid fa-phone me-2"></i>Konsultasi Gratis
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar kecil opsional: highlight atau info singkat -->
                <div class="col-12 col-lg-4">
                    <div class="card h-100" style="border-radius:1.25rem;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-shield-halved me-2"></i>Keunggulan Kami</h5>
                            <ul class="list-unstyled m-0">
                                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>Kualitas & ketepatan waktu</li>
                                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>Tim ahli berpengalaman</li>
                                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>Dukungan teknologi modern</li>
                                <li class="mb-2"><i class="fa-solid fa-check text-success me-2"></i>Layanan end-to-end</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- /row -->
        </section>
    <?php endif; ?>

    <!-- OUR PARTNER -->
    <section class="section_partner">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="partner-title m-0">Mitra Kami</h5>
            <div class="small text-muted">Dipercaya berbagai perusahaan</div>
        </div>
        <div class="cover_owl_content">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="<?= base_url('/assets/img/benua-partner.png') ?>" class="img_owl_carousel" alt="Benua Partner" loading="lazy">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/Econindo-partner.png') ?>" class="img_owl_carousel" alt="Econindo" loading="lazy">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/fajar-partner.jpeg') ?>" class="img_owl_carousel" alt="Fajar" loading="lazy">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/spektrum-partner.jpg') ?>" class="img_owl_carousel" alt="Spektrum" loading="lazy">
                </div>
            </div>
        </div>
    </section>

</div><!-- /container -->

<?= $this->endSection() ?>