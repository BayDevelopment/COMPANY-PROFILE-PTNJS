<?= $this->extend('layouts/public') ?>

<?= $this->section('content_public') ?>
<style>
    /* Animasi */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .fade-in {
        animation: fadeIn .8s ease-in-out;
    }

    @media screen and (min-width: 360px) and (max-width: 360px) {
        .judul_carousel {
            font-size: 16px;
        }

        .img_native {
            margin-top: 40px;
            width: 320px !important;
        }

        .card {
            margin-bottom: 10px;
        }

        .section_tree {
            margin-top: 420px;
        }

        .section_count_project {
            margin-top: 60px;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            border: none;
            box-shadow: none;
        }

        .judul_footer {
            margin-top: 40px;
        }

        .cover_judul_two {
            width: auto;
        }

        .paragraft_two {
            line-height: 1.9;
        }

        .text_services {
            line-height: 1.8;
        }

        .text_contact {
            font-size: 18px;
        }

        .active_native_outline {
            margin-top: 15px;
        }

        .iframe_native {
            width: 280px;
        }

        .card_cooperation {
            width: auto;
        }

        .fl_proposal::after {
            content: " (PDF - Maks 1MB)";
            font-weight: bold;
            color: red;
            margin-left: 5px;
            font-size: 10px;
            display: inline-block;
            vertical-align: middle;
        }

        .fl_perusahaan::after {
            content: " (PDF, JPG, JPEG, PNG - Maks 1MB)";
            font-weight: bold;
            color: red;
            margin-left: 5px;
            font-size: 10px;
            display: inline-block;
            vertical-align: middle;
        }

        .fl_dnpwp::after {
            content: " (PDF, JPG, JPEG, PNG - Maks 1MB)";
            font-weight: bold;
            color: red;
            margin-left: 5px;
            font-size: 10px;
            display: inline-block;
            vertical-align: middle;
        }

        .fl_sp::after {
            content: " (PDF - Maks 1MB)";
            font-weight: bold;
            color: red;
            margin-left: 5px;
            font-size: 10px;
            display: inline-block;
            vertical-align: middle;
        }
    }

    /* General */
    section {
        padding: 60px 0;
    }

    .judul_section {
        font-size: 1.6rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
    }

    /* About Us */
    .judul_col {
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .paragraft_native {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .img_native {
        border-radius: .75rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        width: 100%;
        object-fit: cover;
    }

    /* Card */
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        transition: transform .25s ease, box-shadow .25s ease;
        height: 100%;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, .1);
    }

    .card img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    /* Badge */
    .badge {
        font-size: .8rem;
    }

    /* Empty state */
    .cover_img_empty img {
        max-width: 200px;
        opacity: .8;
    }

    .caption_img_empty {
        margin-top: 1rem;
        color: #6c757d;
        font-weight: 500;
        text-align: center;
    }

    /* Buttons */
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
        transition: all .3s ease;
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
        transform: skewX(-20deg);
        transition: .5s;
    }

    .btn_a_native:hover::before {
        left: 130%;
    }

    .btn_a_native:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(253, 237, 13, 0.4);
        color: #fff;
    }

    .cover_link_native {
        text-align: center;
        margin-top: 2rem;
    }

    :root {
        --surface: #ffffff;
        --muted: #6c757d;
        --ring: rgba(253, 209, 13, 0.15);
        --shadow: 0 10px 30px rgba(16, 24, 40, .08);
        --shadow-lg: 0 16px 40px rgba(16, 24, 40, .12);
        --radius: 16px;
        --space: 72px;
    }

    /* Section wrapper */
    section.section-modern {
        padding: var(--space) 0;
    }

    .judul_section {
        font-weight: 800;
        letter-spacing: .2px;
        text-align: center;
        margin-bottom: 1rem;
    }

    .lead-muted {
        color: var(--muted);
        text-align: center;
        max-width: 840px;
        margin: 0 auto 2rem;
    }

    /* Empty state */
    .empty-modern {
        border: 1px dashed #e9ecef;
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        background: linear-gradient(180deg, #fafbff, transparent);
    }

    .empty-modern img {
        width: 220px;
        max-width: 60%;
        opacity: .9
    }

    .empty-modern h6 {
        color: var(--muted);
        margin-top: .75rem
    }

    /* Card modern */
    .card-modern {
        border: 0;
        border-radius: var(--radius);
        background: radial-gradient(1200px 600px at -10% -20%, rgba(13, 110, 253, .06), transparent),
            linear-gradient(180deg, #fff, #f9fafb);
        box-shadow: var(--shadow);
        overflow: hidden;
        height: 100%;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        position: relative;
    }

    .card-modern:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
    }

    .card-modern .card-body {
        padding: 1.25rem 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: .75rem
    }

    /* Image with aspect-ratio */
    .media-cover {
        position: relative;
    }

    .media-cover img {
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }

    /* Ribbon / badge */
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

    .meta {
        font-size: .875rem;
        color: var(--muted);
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    /* Clamp text */
    .clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Buttons – primary shiny + ghost */
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

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .55rem 1.1rem;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 600;
        border: 1px solid #d0d7e2;
        color: #fae20dff;
        background: #fff;
        transition: .25s ease;
    }

    .btn-ghost:hover {
        border-color: #fae20dff;
        box-shadow: 0 8px 18px var(--ring);
    }

    /* Animations */
    .fade-up {
        opacity: 0;
        transform: translateY(14px);
        transition: all .5s ease;
    }

    .fade-up.in-view {
        opacity: 1;
        transform: none;
    }

    /* Utilities */
    .text-brand {
        color: #fae20dff
    }

    .grid-gap {
        row-gap: 1.5rem;
    }
</style>
<div id="carouselExampleFade" class="carousel slide carousel-fade fade-in ">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="native_carousel"></div>
            <div class="carousel-caption ">
                <?php if (empty($d_home)): ?>
                    <div class="card">
                        <div class="card-body">
                            <span><i class="fa-solid fa-bell"></i></span> Maaf, Tidak ada data yang ditampilkan saat ini!
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($d_home as $d_h): ?>
                        <h5 class="judul_carousel">- <?= esc($d_h['judul_jumbotron']) ?> -</h5>
                        <p id="element"></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- SECTION ONE: ABOUT -->
<section class="section-modern fade-up">
    <div class="container">
        <?php if (empty($d_home)): ?>
            <div class="empty-modern">
                <img src="<?= base_url('assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses" loading="lazy">
                <h6>Maaf, Tidak ada data yang ditampilkan saat ini!</h6>
            </div>
        <?php else: ?>
            <?php foreach ($d_home as $d_h): ?>
                <div class="row align-items-center gy-4">
                    <div class="col-lg-7">
                        <h2 class="mb-2 fw-bold">About <span class="text-brand">Us</span></h2>
                        <p class="lead-muted text-start" style="max-width: 680px;">
                            <?= esc(substr($d_h['paragraft_about'], 0, 300) . '...') ?>
                        </p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="<?= base_url('/pages/about') ?>" class="btn-shiny">
                                <i class="fa-solid fa-circle-info"></i> Selengkapnya
                            </a>
                            <a href="<?= base_url('/contact') ?>" class="btn-ghost">
                                <i class="fa-solid fa-paper-plane"></i> Hubungi Kami
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card-modern">
                            <div class="media-cover">
                                <img src="/assets/uploads<?= '/' . esc($d_h['image_about']) ?>" alt="PT. Najwa Jaya Sukses" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- SECTION TWO: SERVICES -->
<section class="section-modern fade-up">
    <div class="container">
        <h2 class="judul_section">Our Best Services</h2>
        <p class="lead-muted">Solusi terintegrasi konstruksi, mekanikal, elektrikal—dengan standar mutu dan efisiensi tinggi.</p>

        <?php if (empty($d_services)): ?>
            <div class="empty-modern">
                <img src="<?= base_url('assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses" loading="lazy">
                <h6>Maaf, Tidak ada data yang ditampilkan saat ini!</h6>
            </div>
        <?php else: ?>
            <div class="row grid-gap">
                <?php foreach ($d_services as $d_s): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-modern h-100">
                            <?php if ($d_s['status'] === 'baru diupload'): ?>
                                <div class="ribbon"><i class="fa-solid fa-bolt me-1"></i><?= esc($d_s['status']) ?></div>
                            <?php endif; ?>
                            <div class="media-cover">
                                <img src="<?= base_url('/assets/uploads/' . esc($d_s['image_services'])) ?>" alt="<?= esc($d_s['title_services']) ?>" loading="lazy">
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 meta">
                                    <?php if ($d_s['status'] !== 'baru diupload'): ?>
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        <?= esc(formatTanggalIndonesia($d_s['created_at'])) ?>
                                    <?php else: ?>
                                        <i class="fa-solid fa-clock"></i> Baru diunggah
                                    <?php endif; ?>
                                </div>
                                <h5 class="mb-1 fw-bold clamp-2"><?= esc($d_s['title_services']) ?></h5>
                                <p class="mb-3 clamp-3"><?= esc($d_s['deskripsi']) ?></p>
                                <div>
                                    <a href="<?= base_url('/pages/services/detail/' . esc($d_s['slug_services'])) ?>" class="btn-shiny">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-4">
                <a href="/pages/services" class="btn-ghost">
                    Lihat Semua Layanan <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- SECTION THREE: PROJECTS -->
<section class="section-modern fade-up">
    <div class="container">
        <h2 class="judul_section">Our Project’s</h2>
        <p class="lead-muted">Beberapa proyek pilihan yang mencerminkan standar kualitas kami.</p>

        <?php if (empty($d_project)): ?>
            <div class="empty-modern">
                <img src="<?= base_url('assets/img/empty_data.png') ?>" alt="PT. Najwa Jaya Sukses" loading="lazy">
                <h6>Maaf, Tidak ada data yang ditampilkan saat ini!</h6>
            </div>
        <?php else: ?>
            <div class="row grid-gap">
                <?php foreach ($d_project as $d_p): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-modern h-100">
                            <div class="media-cover">
                                <img src="<?= '/assets/uploads/' . esc($d_p['gambar']) ?>" alt="<?= esc($d_p['name']) ?>" loading="lazy">
                            </div>
                            <div class="card-body">
                                <h5 class="mb-1 fw-bold clamp-2"><?= esc($d_p['name']) ?></h5>
                                <p class="mb-2 clamp-3"><?= esc($d_p['description']) ?></p>

                                <?php if ($d_p['status'] === 'pending'): ?>
                                    <span class="badge bg-secondary"><i class="fa-regular fa-clock me-1"></i> Pending</span>
                                <?php elseif ($d_p['status'] === 'in_progress'): ?>
                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-spinner me-1"></i> In Progress</span>
                                <?php elseif ($d_p['status'] === 'completed'): ?>
                                    <span class="badge bg-success"><i class="fa-solid fa-check me-1"></i> Completed</span>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-4">
                <a href="/pages/project" class="btn-ghost">
                    Lihat Selengkapnya <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- PROJECT COUNT (Modern) -->
<section class="section_count_project fade-up" id="count-container">
    <style>
        :root {
            --radius: 16px;
            --shadow: 0 14px 36px rgba(16, 24, 40, .12);
            --muted: #6c757d;
        }

        .section_count_project {
            padding: 64px 0;
            position: relative;
            background:
                radial-gradient(1200px 600px at -10% -20%, rgba(13, 110, 253, .10), transparent),
                linear-gradient(180deg, #ffffff, #f8fafc);
        }

        .count-wrapper {
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            background: rgba(255, 255, 255, .75);
            backdrop-filter: blur(8px);
            padding: 24px;
        }

        .judul_count {
            font-weight: 800;
            letter-spacing: .2px;
            margin: 0;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 14px;
            border-radius: 14px;
            padding: 16px 18px;
            background: linear-gradient(180deg, #fff, #f5f7fb);
            border: 1px solid #eef2f7;
            height: 100%;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 34px rgba(16, 24, 40, .12);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: radial-gradient(160% 160% at 30% 20%, #f6d43bff 0%, #f6d43bff 70%);
            color: #fff;
            box-shadow: 0 10px 20px rgba(253, 169, 13, 0.35);
            flex: 0 0 52px;
        }

        .count {
            font-size: clamp(1.75rem, 2.4vw, 2.2rem);
            font-weight: 800;
            line-height: 1;
        }

        .text_count {
            margin: 0;
            color: var(--muted);
            font-weight: 600;
            letter-spacing: .2px;
        }

        .stat-meta {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Fade-up */
        .fade-up {
            opacity: 0;
            transform: translateY(14px);
            transition: all .6s ease;
        }

        .fade-up.in-view {
            opacity: 1;
            transform: none;
        }
    </style>

    <div class="container">
        <div class="count-wrapper">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-lg-3">
                    <div class="cover_head_count">
                        <h6 class="judul_count">Project</h6>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                        <div class="stat-meta">
                            <div class="count">
                                <span id="count_client" data-target="120" data-suffix="+">0</span>
                            </div>
                            <h6 class="text_count">Client</h6>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-gauge-high"></i></div>
                        <div class="stat-meta">
                            <div class="count">
                                <span id="count_kualitas" data-target="98" data-suffix="%">0</span>
                            </div>
                            <h6 class="text_count">Kualitas</h6>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
                        <div class="stat-meta">
                            <div class="count">
                                <span id="count_project" data-target="250" data-suffix="+">0</span>
                            </div>
                            <h6 class="text_count">Project</h6>
                        </div>
                    </div>
                </div>
            </div><!-- /row -->
        </div>
    </div>

    <script>
        // Counter animation (reads data-target & data-suffix; falls back to current text)
        (function() {
            const easeOutCubic = t => 1 - Math.pow(1 - t, 3);
            const animate = (el, to, suffix = "", duration = 1400) => {
                const from = 0;
                const start = performance.now();
                const decimals = to % 1 !== 0 ? 1 : 0;

                const frame = now => {
                    const p = Math.min((now - start) / duration, 1);
                    const val = from + (to - from) * easeOutCubic(p);
                    el.textContent = val.toFixed(decimals) + suffix;
                    if (p < 1) requestAnimationFrame(frame);
                };
                requestAnimationFrame(frame);
            };

            const once = new WeakSet();
            const runCounters = root => {
                root.querySelectorAll('#count_client, #count_kualitas, #count_project').forEach(el => {
                    if (once.has(el)) return;
                    const targetAttr = el.getAttribute('data-target');
                    const suffix = el.getAttribute('data-suffix') || '';
                    let target = targetAttr ? parseFloat(targetAttr) : parseFloat(el.textContent) || 0;
                    animate(el, target, suffix);
                    once.add(el);
                });
            };

            // Intersection Observer: trigger when visible
            const container = document.getElementById('count-container');
            const io = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        container.classList.add('in-view');
                        runCounters(container);
                        io.unobserve(container);
                    }
                });
            }, {
                threshold: .18
            });
            io.observe(container);
        })();
    </script>
</section>


<!-- PARTNER SECTION -->
<section class="section_partner fade-up">
    <style>
        .section_partner {
            padding: 64px 0;
            background: linear-gradient(180deg, #f8fafc, #ffffff);
            border-top: 1px solid #f1f3f5;
        }

        .section_partner h2 {
            text-align: center;
            font-weight: 800;
            margin-bottom: 2rem;
        }

        .partner-carousel .item {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .partner-card {
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(6px);
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(16, 24, 40, .06);
            padding: 12px 20px;
            transition: .3s ease;
        }

        .partner-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(16, 24, 40, .12);
        }

        .partner-card img {
            max-height: 60px;
            width: auto;
            filter: grayscale(100%);
            opacity: .85;
            transition: .3s ease;
        }

        .partner-card:hover img {
            filter: grayscale(0);
            opacity: 1;
        }
    </style>

    <script>
        // init OwlCarousel (pastikan owl js/css sudah dipanggil di layout)
        $('.partner-carousel').owlCarousel({
            loop: true,
            margin: 20,
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
    <div class="container">
        <h2>Our Trusted Partners</h2>
        <div class="cover_owl_content">
            <div class="owl-carousel owl-theme partner-carousel">
                <div class="item">
                    <div class="partner-card">
                        <img src="<?= base_url('/assets/img/benua-partner.png') ?>" alt="Benua Partner" loading="lazy">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-card">
                        <img src="<?= base_url('/assets/img/Econindo-partner.png') ?>" alt="Econindo Partner" loading="lazy">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-card">
                        <img src="<?= base_url('/assets/img/fajar-partner.jpeg') ?>" alt="Fajar Partner" loading="lazy">
                    </div>
                </div>
                <div class="item">
                    <div class="partner-card">
                        <img src="<?= base_url('/assets/img/spektrum-partner.jpg') ?>" alt="Spektrum Partner" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    // Fade-up on view
    const els = document.querySelectorAll('.fade-up');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('in-view');
                io.unobserve(e.target);
            }
        });
    }, {
        threshold: .12
    });
    els.forEach(el => io.observe(el));
</script>
<?= $this->endSection() ?>