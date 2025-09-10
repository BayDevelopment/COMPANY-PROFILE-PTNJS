<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ✅ Meta Description (gunakan hanya satu) -->
    <meta name="description" content="PT. Najwa Jaya Sukses adalah perusahaan terkemuka di serang, Banten, yang bergerak di bidang jasa pekerjaan contruction, scalfollding, insulatation, Electrical Panel." />

    <!-- ✅ Open Graph Meta Tags (untuk tampilan link di media sosial) -->
    <meta property="og:title" content="PT Najwa Jaya Sukses" />
    <meta property="og:url" content="https://njs.siramcilacap.org/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?= base_url('assets/img/jumbo_img.jpg') ?>" /> <!-- Ganti URL logo sesuai lokasi gambar -->

    <!-- ✅ Robots (jika website belum live) -->
    <meta name="robots" content="index, follow" /> <!-- Ubah ke "noindex, nofollow" hanya jika sedang dalam pengembangan -->

    <!-- ✅ Canonical URL -->
    <link rel="canonical" href="https://njs.siramcilacap.org//" />

    <!-- ✅ Tambahan Meta untuk SEO -->
    <meta name="keywords" content="konstruksi, mekanikal, elektrikal, kontraktor, Najwa Jaya Sukses, Bayu Albar Ladici" />
    <meta name="author" content="Bayu Albar Ladici" />

    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- link css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.default.min.css') ?>">

    <!-- icon -->
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">


    <!-- link sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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
</style>

<body>
    <?php if (session()->getFlashdata('sweet_success')) : ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "success",
                title: "<?= session()->getFlashdata('sweet_success'); ?>"
            });
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('sweet_error')) : ?>
        <script>
            const ErrorToast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            ErrorToast.fire({
                icon: "error", // cocok dengan sweet_error
                title: "<?= session()->getFlashdata('sweet_error'); ?>"
            });
        </script>
    <?php endif; ?>



    <header>
        <!-- navbar desktop -->
        <nav class="navbar nav_desktop navbar-expand-lg bg-native fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="/assets/img/logo.jpg" alt="PT. Najwa Jaya Sukses" class="native_logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <?php if ($page_title == "Home"): ?>
                                <a class="nav-link active_native" aria-current="page" href="/">Home</a>
                            <?php else: ?>
                                <a class="nav-link font_native" aria-current="page" href="/">Home</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php if ($page_title == "About"): ?>
                                <a class="nav-link active_native" href="/pages/about">About</a>
                            <?php else: ?>
                                <a class="nav-link font_native" href="/pages/about">About</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php if ($page_title == "Service's"): ?>
                                <a class="nav-link active_native" href="/pages/services">Service's</a>
                            <?php else: ?>
                                <a class="nav-link font_native" href="/pages/services">Service's</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php if ($page_title == "Project's"): ?>
                                <a class="nav-link active_native" href="/pages/project">Project's</a>
                            <?php else: ?>
                                <a class="nav-link font_native" href="/pages/project">Project's</a>
                            <?php endif; ?>
                        </li>
                        <li class="nav-item">
                            <?php if ($page_title == "Contact"): ?>
                                <a class="nav-link active_native" href="/pages/contact">Contact</a>
                            <?php else: ?>
                                <a class="nav-link font_native" href="/pages/contact">Contact</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <?php if ($page_title == "Cooperation"): ?>
                                <a class="nav-link coo_active active_native_outline" aria-current="page" href="<?= base_url('/pages/cooperation') ?>">cooperation <span><i class="fa-solid fa-hands"></i></span></a>
                            <?php else: ?>
                                <a class="nav-link active_native_outline" aria-current="page" href="<?= base_url('/pages/cooperation') ?>">cooperation <span><i class="fa-solid fa-hands"></i></span></a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- navbar mobile -->
        <nav class="navbar nav_mobile bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/assets/img/logo.jpg" alt="PT. Najwa Jaya Sukses" class="native_logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <a class="navbar-brand" href="#">
                            <img src="/assets/img/logo.jpg" alt="Bootstrap" class="native_logo">
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <?php if ($page_title == "Home"): ?>
                                    <a class="nav-link active_native" aria-current="page" href="/">Home</a>
                                <?php else: ?>
                                    <a class="nav-link font_native" aria-current="page" href="/">Home</a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <?php if ($page_title == "About"): ?>
                                    <a class="nav-link active_native" href="/pages/about">About</a>
                                <?php else: ?>
                                    <a class="nav-link font_native" href="/pages/about">About</a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <?php if ($page_title == "Service's"): ?>
                                    <a class="nav-link active_native" href="/pages/services">Service's</a>
                                <?php else: ?>
                                    <a class="nav-link font_native" href="/pages/services">Service's</a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <?php if ($page_title == "Project's"): ?>
                                    <a class="nav-link active_native" href="/pages/project">Project's</a>
                                <?php else: ?>
                                    <a class="nav-link font_native" href="/pages/project">Project's</a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <?php if ($page_title == "Contact"): ?>
                                    <a class="nav-link active_native" href="/pages/contact">Contact</a>
                                <?php else: ?>
                                    <a class="nav-link font_native" href="/pages/contact">Contact</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <?php if ($page_title == "Cooperation"): ?>
                                    <a class="nav-link coo_active active_native_outline" aria-current="page" href="<?= base_url('/pages/cooperation') ?>">cooperation <span><i class="fa-solid fa-hands"></i></span></a>
                                <?php else: ?>
                                    <a class="nav-link active_native_outline" aria-current="page" href="<?= base_url('/pages/cooperation') ?>">cooperation <span><i class="fa-solid fa-hands"></i></span></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="fade-in">
        <section>
            <?= $this->renderSection('content_public') ?>
        </section>
        <section class="section_footer pt-5 pb-3">
            <style>
                .section_footer {
                    background-color: #f8f9fa;
                    /* warna terang agar teks hitam jelas */
                    color: #212529;
                }

                .native_footer_logo {
                    max-height: 60px;
                    margin-bottom: 1rem;
                }

                .paragraft_native {
                    font-size: .95rem;
                    line-height: 1.6;
                    color: #212529;
                }

                /* .btn_a_native {
                    display: inline-flex;
                    align-items: center;
                    gap: .4rem;
                    font-size: .85rem;
                    font-weight: 600;
                    color: #212529;
                    text-decoration: none;
                    border-bottom: 1px solid transparent;
                    transition: .25s;
                }

                .btn_a_native:hover {
                    border-color: #212529;
                } */
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

                .judul_footer {
                    font-weight: 700;
                    margin-bottom: 1rem;
                    font-size: 1.1rem;
                    border-left: 4px solid #212529;
                    padding-left: .5rem;
                }

                .native_link a,
                .native_location a {
                    color: #212529;
                    font-size: .95rem;
                    display: inline-flex;
                    align-items: center;
                    gap: .4rem;
                    transition: .25s;
                }

                .native_link a:hover,
                .native_location a:hover {
                    color: #000;
                    transform: translateX(4px);
                }

                .iframe_native {
                    width: 100%;
                    height: 200px;
                    border-radius: .75rem;
                    margin-top: .5rem;
                }

                .footer-bottom {
                    border-top: 1px solid #dee2e6;
                    margin-top: 2rem;
                    padding-top: 1rem;
                    text-align: center;
                }

                .footer-bottom p {
                    margin: 0;
                    font-size: .85rem;
                    color: #495057;
                }

                .footer-bottom a {
                    color: #000;
                    font-weight: 600;
                    text-decoration: none;
                }

                .footer-bottom a:hover {
                    text-decoration: underline;
                }
            </style>

            <div class="container">
                <div class="row gy-4">
                    <!-- Logo & About -->
                    <div class="col-lg-4">
                        <a href="#">
                            <img src="/assets/img/logo.png" alt="PT Najwa Jaya Sukses" class="native_footer_logo">
                        </a>

                        <?php if (empty($d_about)): ?>
                            <div class="alert alert-light small mt-2" role="alert">
                                <i class="fa-solid fa-bell me-1"></i> Tidak ada caption saat ini!
                            </div>
                        <?php else: ?>
                            <?php foreach ($d_about as $d_ab): ?>
                                <p class="paragraft_native mb-2">
                                    <?= esc(substr($d_ab['title_about'], 0, 50) . '...') ?>
                                </p>
                            <?php endforeach; ?>
                            <a href="/pages/about" class="btn-shiny">
                                Selengkapnya.. <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Links -->
                    <div class="col-lg-4">
                        <h6 class="judul_footer">Link's</h6>
                        <ul class="list-unstyled d-grid gap-2">
                            <li class="native_link">
                                <a href="<?= base_url('pages/about') ?>"><i class="fa-solid fa-caret-right"></i> About Us</a>
                            </li>
                            <li class="native_link">
                                <a href="<?= base_url('pages/services') ?>"><i class="fa-solid fa-caret-right"></i> Service's</a>
                            </li>
                            <li class="native_link">
                                <a href="<?= base_url('pages/project') ?>"><i class="fa-solid fa-caret-right"></i> Project's</a>
                            </li>
                            <li class="native_link">
                                <a href="<?= base_url('pages/contact') ?>"><i class="fa-solid fa-caret-right"></i> Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Location -->
                    <div class="col-lg-4">
                        <h6 class="judul_footer">Location</h6>
                        <ul class="list-unstyled">
                            <li class="native_location mb-3">
                                <a href="https://maps.app.goo.gl/QDGgELYZNaf1C2cy5" target="_blank">
                                    <i class="fa-solid fa-location-pin"></i>
                                    Jl. Penggoreng, RT./RW 006/002, Mangunreja, Kec. Puloampel, Kabupaten Serang, Banten 42455
                                </a>
                            </li>
                        </ul>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.7033449395067!2d106.06601767402051!3d-5.897230158047249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4195d2f0d0deb7%3A0x7d4654a95ed4aede!2sPT.%20NAJWA%20JAYA%20SUKSES!5e0!3m2!1sid!2sid!4v1737193284375!5m2!1sid!2sid"
                            class="iframe_native"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Footer bottom merged -->
                <div class="footer-bottom">
                    <p>Developed by <a href="https://id.linkedin.com/in/bayu-albar-ladici-637781273">Bayudev</a> – 2023</p>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script src="<?= base_url('/assets/js/typing.js') ?>"></script>
    <script src="<?= base_url('/assets/js/script.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/owl.carousel.min.js') ?>"></script>
    <script>
        var typedData = <?= $typed ?? "" ?>

        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true
                }
            }
        })
    </script>
</body>

</html>