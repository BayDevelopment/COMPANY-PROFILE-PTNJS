<?= $this->extend('layouts/public') ?>

<?= $this->section('content_public') ?>

<style>
    /* Section Head */
    .section_head {
        margin-top: 80px;
        /* jarak dari navbar */
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .head-page-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .text_services {
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Card Service */
    .card-service {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-service:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .1);
    }

    .card-service img {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .badge-new {
        position: absolute;
        top: 12px;
        left: 12px;
        border-radius: 50px;
        padding: .35rem .75rem;
        font-size: .8rem;
        box-shadow: 0 4px 10px rgba(13, 110, 253, .25);
    }

    .clock_old {
        font-size: .875rem;
        color: #6c757d;
        margin-bottom: .5rem;
    }

    .btn_a_public {
        background: #0d6efd;
        color: #fff;
        padding: .45rem 1.2rem;
        border-radius: 50px;
        transition: .25s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn_a_public:hover {
        background: #0b5ed7;
        color: #fff;
    }

    /* Empty State */
    .empty-state {
        margin-top: 100px;
        text-align: center;
        padding: 2rem;
    }

    .empty-state img {
        max-width: 200px;
        opacity: .85;
    }

    .caption_img_empty {
        margin-top: 1rem;
        color: #6c757d;
        font-weight: 500;
    }

    /* Partner */
    .section_partner {
        margin-top: 4rem;
        padding: 2rem 0;
        border-top: 1px solid #f1f3f5;
        text-align: center;
    }

    .section_partner h5 {
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .img_owl_carousel {
        max-height: 60px;
        filter: grayscale(100%);
        opacity: .8;
        transition: all .25s ease;
        margin: 0 auto;
    }

    .img_owl_carousel:hover {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.05);
    }

    /* Tombol Detail */
    .btn_a_native {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        background: linear-gradient(135deg, #fae20dff, #fae20dff);
        color: #fff;
        padding: .55rem 1.3rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: .9rem;
        text-decoration: none;
        transition: background .3s ease, box-shadow .3s ease, color .3s ease;
        /* transition cukup untuk warna/box-shadow saja, bukan all */
        position: relative;
        overflow: hidden;
    }

    .btn_a_native i {
        font-size: .85rem;
    }

    .btn_a_native::before {
        content: "";
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: rgba(255, 255, 255, .3);
        transition: left .5s;
        /* hanya animasi posisi left */
    }

    .btn_a_native:hover::before {
        left: 130%;
    }

    .btn_a_native:hover {
        box-shadow: 0 6px 16px rgba(253, 237, 13, 0.4);
        color: #fff;
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

<div class="container">

    <?php if (empty($d_services)): ?>
        <!-- EMPTY STATE -->
        <div class="empty-state">
            <img src="<?= base_url('/assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses">
            <h6 class="caption_img_empty">Maaf, Tidak ada data yang ditampilkan saat ini!</h6>
        </div>

    <?php else: ?>
        <!-- HERO / INTRO -->
        <section class="section_head">
            <div class="head-page-title">
                <?= esc($page_title) ?>
            </div>
            <p class="text_services">
                PT. Najwa Jaya Sukses menyediakan solusi terintegrasi di bidang konstruksi, mekanikal, elektrikal, Dll
                yang didukung oleh teknologi modern dan tenaga ahli berpengalaman. Kami berkomitmen untuk memberikan
                layanan terbaik dengan kualitas, efisiensi, dan keberlanjutan dalam setiap proyek yang kami kerjakan.
                Berikut adalah layanan-layanan unggulan yang kami tawarkan:
            </p>
        </section>

        <!-- LIST SERVICES -->
        <section class="section_content_services_detail">
            <div class="row g-4">
                <?php foreach ($d_status as $d_s): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-service position-relative">
                            <?php if ($d_s['status'] === 'baru diupload'): ?>
                                <div class="ribbon"><i class="fa-solid fa-bolt me-1"></i><?= esc($d_s['status']) ?></div>
                            <?php endif; ?>

                            <img src="<?= base_url('/assets/uploads/' . esc($d_s['image_services'])) ?>"
                                alt="<?= esc($d_s['title_services']) ?>">

                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <?php if (!empty($d_s['status']) && $d_s['status'] !== 'baru diupload'): ?>
                                        <span class="meta-time">
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?= esc(formatTanggalIndonesia($d_s['created_at'])) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="meta-time">
                                            <i class="fa-solid fa-clock"></i>
                                            Baru diunggah dalam 7 hari terakhir
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <h5 class="card-title mb-2"><?= esc($d_s['title_services']) ?></h5>
                                <p class="card-text text-truncate"><?= esc($d_s['deskripsi']) ?></p>

                                <div class="mt-3">
                                    <a class="btn btn-shiny"
                                        href="<?= base_url('/pages/services/detail/' . esc($d_s['slug_services'])) ?>">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- PARTNER -->
    <section class="section_partner">
        <h5>Mitra Kami</h5>
        <div class="cover_owl_content">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="<?= base_url('/assets/img/benua-partner.png') ?>" class="img_owl_carousel" alt="Benua Partner">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/Econindo-partner.png') ?>" class="img_owl_carousel" alt="Econindo">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/fajar-partner.jpeg') ?>" class="img_owl_carousel" alt="Fajar">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/spektrum-partner.jpg') ?>" class="img_owl_carousel" alt="Spektrum">
                </div>
            </div>
        </div>
    </section>

</div>

<?= $this->endSection() ?>