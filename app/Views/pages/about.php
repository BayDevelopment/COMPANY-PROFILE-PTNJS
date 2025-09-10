<?= $this->extend('layouts/public') ?>

<?= $this->section('content_public') ?>

<style>
    :root {
        --radius: 16px;
        --shadow: 0 12px 32px rgba(16, 24, 40, .10);
        --shadow-lg: 0 18px 44px rgba(16, 24, 40, .14);
        --muted: #6c757d;
    }

    .page-wrap {
        padding: 56px 0 40px;
    }

    /* Page title */
    .cover_page_title {
        text-align: center;
        margin-top: 64px;
        margin-bottom: 10px;
    }

    .head-page-title {
        font-size: clamp(1.8rem, 2.8vw, 2.4rem);
        font-weight: 800;
        letter-spacing: .2px;
    }

    /* Hero image */
    .cover_img_head {
        margin: 16px auto 24px;
        max-width: 1080px;
    }

    .size_img_head {
        width: 100%;
        aspect-ratio: 16/7;
        object-fit: cover;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    /* Sub heading + paragraph */
    .title_two {
        font-weight: 700;
        font-size: 1.25rem;
        margin: 18px 0 8px;
        text-align: center;
    }

    .cover_paragraft_two {
        max-width: 920px;
        margin: 0 auto;
    }

    .paragraft_two {
        color: var(--muted);
        line-height: 1.7;
    }

    /* Section block */
    .section-block {
        margin-top: 40px;
        background: linear-gradient(180deg, #fff, #f8fafc);
        border: 1px solid #eef2f7;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 24px;
    }

    .section-block h6.title_two {
        margin: 0 0 12px;
    }

    /* Visi Misi */
    .tag-heading {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-weight: 700;
        margin: 14px 0 8px;
    }

    .visi,
    .misi {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .25rem .7rem;
        border-radius: 999px;
        background: rgba(13, 110, 253, .08);
        color: #0d6efd;
        font-weight: 700;
        font-size: .9rem;
    }

    .misi {
        background: rgba(255, 193, 7, .18);
        color: #b58102;
    }

    .misi-list {
        margin-top: 10px;
    }

    .misi-item {
        display: flex;
        gap: .6rem;
        align-items: flex-start;
        padding: .5rem .75rem;
        border-radius: 12px;
        border: 1px dashed #e9eef6;
        background: #fff;
        margin-bottom: .5rem;
    }

    .misi-item i {
        color: #FFD43B;
        margin-top: .25rem;
    }

    .misi-item p {
        margin: 0;
        color: var(--muted);
    }

    /* Empty state */
    .alert_about .card {
        border: 1px dashed #e9ecef;
        border-radius: var(--radius);
    }

    .cover_img_empty img {
        width: 220px;
        max-width: 60%;
        opacity: .9
    }

    .caption_img_empty {
        color: var(--muted);
        margin-top: .75rem;
        text-align: center
    }

    /* Partner */
    .section_partner {
        padding: 56px 0 8px;
    }

    .partner-title {
        text-align: center;
        font-weight: 800;
        margin-bottom: 1.25rem;
    }

    .partner-carousel .item {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px;
    }

    .img_owl_carousel {
        max-height: 60px;
        width: auto;
        filter: grayscale(100%);
        opacity: .85;
        transition: .25s ease;
    }

    .img_owl_carousel:hover {
        filter: grayscale(0);
        opacity: 1;
        transform: translateY(-2px);
    }

    /* Fade-up on view */
    .fade-up {
        opacity: 0;
        transform: translateY(14px);
        transition: all .55s ease;
    }

    .fade-up.in-view {
        opacity: 1;
        transform: none;
    }
</style>

<div class="container page-wrap">

    <!-- OPENING / ABOUT -->
    <section class="fade-up">
        <?php if (empty($d_about)): ?>
            <div class="alert_about">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="cover_img_empty">
                            <img src="<?= base_url('assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses" class="size_img_empty">
                        </div>
                        <h6 class="caption_img_empty">Maaf, Tidak ada data yang ditampilkan saat ini!</h6>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($d_about as $d_ab): ?>
                <div class="cover_page_title">
                    <div class="head-page-title"><?= esc($page_title) ?></div>
                </div>

                <div class="cover_img_head">
                    <img src="<?= base_url('/assets/uploads/') . esc($d_ab['image_about']) ?>" alt="PT. Najwa Jaya Sukses" class="size_img_head" loading="lazy">
                </div>

                <div class="title_two"><?= esc($d_ab['judul_about']) ?></div>
                <div class="cover_paragraft_two">
                    <p class="paragraft_two"><?= esc($d_ab['title_about']) ?></p>
                </div>
            <?php endforeach; ?>

            <!-- VISI & MISI -->
            <?php if (empty($d_visi)): ?>
                <div class="section-block">
                    <div class="text-center">
                        <div class="cover_img_empty">
                            <img src="<?= base_url('assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses">
                        </div>
                        <h6 class="caption_img_empty">Maaf, Tidak ada visi dan misi saat ini!</h6>
                    </div>
                </div>
            <?php else: ?>
                <section class="section-block fade-up">
                    <h6 class="title_two">Visi &amp; Misi</h6>

                    <!-- Visi -->
                    <div class="tag-heading"><span class="visi">Visi</span></div>
                    <?php foreach ($d_visi as $d_vs): ?>
                        <p class="paragraft_two"><?= esc($d_vs['visi']) ?></p>
                    <?php endforeach; ?>

                    <!-- Misi -->
                    <div class="tag-heading"><span class="misi">Misi</span></div>

                    <?php if (empty($d_misi)) : ?>
                        <div class="text-center">
                            <div class="cover_img_empty">
                                <img src="<?= base_url('assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses">
                            </div>
                            <h6 class="caption_img_empty">Maaf, Tidak ada misi saat ini!</h6>
                        </div>
                    <?php else: ?>
                        <div class="misi-list">
                            <?php foreach ($d_misi as $d_ms): ?>
                                <div class="misi-item">
                                    <i class="fa-solid fa-caret-right"></i>
                                    <p><?= esc($d_ms['misi']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

        <?php endif; ?>
    </section>

    <!-- OUR PARTNER -->
    <section class="section_partner fade-up">
        <h3 class="partner-title">Our Trusted Partners</h3>
        <div class="cover_owl_content">
            <div class="owl-carousel owl-theme partner-carousel">
                <div class="item">
                    <img src="<?= base_url('/assets/img/benua-partner.png') ?>" class="img_owl_carousel" alt="Benua Partner" loading="lazy">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/Econindo-partner.png') ?>" class="img_owl_carousel" alt="Econindo Partner" loading="lazy">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/fajar-partner.jpeg') ?>" class="img_owl_carousel" alt="Fajar Partner" loading="lazy">
                </div>
                <div class="item">
                    <img src="<?= base_url('/assets/img/spektrum-partner.jpg') ?>" class="img_owl_carousel" alt="Spektrum Partner" loading="lazy">
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Fade-up on view
    (function() {
        const els = document.querySelectorAll('.fade-up');
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in-view');
                    io.unobserve(e.target);
                }
            });
        }, {
            threshold: .14
        });
        els.forEach(el => io.observe(el));
    })();

    // Owl init (pastikan Owl sudah di-include di layout)
    $('.partner-carousel').owlCarousel({
        loop: true,
        margin: 18,
        autoplay: true,
        autoplayTimeout: 2500,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            992: {
                items: 5
            }
        }
    });
</script>

<?= $this->endSection() ?>