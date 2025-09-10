<?= $this->extend('layouts/public') ?>

<?= $this->section('content_public') ?>
<style>
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

    .project-card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        background: #fff;
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-img-wrapper {
        height: 200px;
        overflow: hidden;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .project-card:hover .card-img-wrapper img {
        transform: scale(1.05);
    }

    .status-badge {
        font-size: 0.8rem;
        padding: 0.5em 0.75em;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
    }
</style>
<?php if (empty($d_project)): ?>
    <div class="alert_about">
        <div class="card">
            <div class="card-body">
                <div class="cover_img_empty">
                    <img src="<?= base_url('/assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses" class="size_img_empty">
                </div>
                <div class="cover_paragraft">
                    <h6 class="caption_img_empty">Maaf, Tidak ada data yang ditampilkan saat ini!</h6>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <section class="section_head">
        <div class="container">
            <div class="cover_page_title">
                <div class="head-page-title">
                    <?= esc($page_title) ?>
                </div>
                <p class="text_services">PT. Najwa Jaya Sukses, setiap proyek adalah langkah maju menuju solusi cerdas dan berkelanjutan, di mana kami menghadirkan inovasi, membangun masa depan, dan menciptakan pengalaman yang berdampak melalui kolaborasi, teknologi terkini, serta eksekusi yang sempurna, memastikan kualitas, efisiensi, dan hasil yang melampaui ekspektasi.</p>
            </div>
        </div>
    </section>

    <section class="section_content_services">
        <div class="container">
            <div class="row g-4">
                <?php foreach ($d_project as $d_p): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card project-card h-100 shadow-sm border-0">
                            <div class="card-img-wrapper">
                                <img src="<?= base_url('assets/uploads/' . esc($d_p['gambar'])) ?>"
                                    class="card-img-top"
                                    alt="<?= esc($d_p['name']) ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold mb-2"><?= esc($d_p['name']) ?></h5>
                                <p class="card-text text-muted small mb-3"><?= esc($d_p['description']) ?></p>

                                <!-- Status Badge -->
                                <?php if ($d_p['status'] === "pending"): ?>
                                    <span class="badge status-badge bg-primary-subtle text-primary">
                                        <i class="fa-solid fa-clock me-1"></i><?= esc($d_p['status']) ?>
                                    </span>
                                <?php elseif ($d_p['status'] === "in_progress"): ?>
                                    <span class="badge status-badge bg-warning-subtle text-warning">
                                        <i class="fa-solid fa-spinner me-1"></i><?= esc($d_p['status']) ?>
                                    </span>
                                <?php elseif ($d_p['status'] === "completed"): ?>
                                    <span class="badge status-badge bg-success-subtle text-success">
                                        <i class="fa-solid fa-check me-1"></i><?= esc($d_p['status']) ?>
                                    </span>
                                <?php endif; ?>

                                <!-- Detail -->
                                <div class="mt-3">
                                    <?php if ($d_p['status'] === "pending"): ?>
                                        <div class="alert alert-warning small mb-0 py-2" role="alert">
                                            <i class="fa-solid fa-bell me-1"></i> Menunggu persetujuan!
                                        </div>
                                    <?php else: ?>
                                        <div class="row text-muted small">
                                            <div class="col-12 mb-2">
                                                <strong>Tanggal Mulai:</strong><br>
                                                <span class="span_date"><?= esc(formatTanggalIndonesia($d_p['start_date'])) ?></span>
                                            </div>
                                            <div class="col-12">
                                                <strong>Tanggal Selesai:</strong><br>
                                                <span class="span_date"><?= esc(formatTanggalIndonesia($d_p['end_date'])) ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
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
<?php endif; ?>
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