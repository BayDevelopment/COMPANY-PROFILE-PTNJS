<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= esc($title) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('/assets/css/styles.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* === Sticky Footer Layout === */
        html,
        body {
            height: 100%;
        }

        body.sb-nav-fixed {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #layoutSidenav {
            flex: 1 0 auto;
            display: flex;
            min-height: 0;
        }

        #layoutSidenav_content {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #layoutSidenav_content>main {
            flex: 1 0 auto;
            padding-block: 12px 24px;
        }

        #layoutSidenav_content>footer {
            flex-shrink: 0;
        }

        /* === Spacing untuk gambar === */
        .img-spaced {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 20px auto;
            /* default desktop/laptop: spasi kecil */
        }

        @media (max-width: 575.98px) {
            .img-spaced {
                margin: 40px auto;
                /* di mobile: spasi lebih besar */
            }
        }

        /* Tambahan gaya */
        .span-native-njs {
            font-size: 1.3rem;
            font-weight: 700;
            background: linear-gradient(45deg, #c58a0aff, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- Topnav -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand align-items-center" href="<?= base_url('admin/dashboard') ?>">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="LOGO PT.NJS"
                width="40" height="40" class="ms-3 me-2 rounded-circle shadow-sm">
            <span class="span-native-njs" style="font-size:1.1rem;">NJS CORE</span>
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Sidebar -->
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="/admin/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <!-- Contoh pemakaian gambar -->
                <div class="col-lg-5 mb-4">
                    <img src="<?= base_url('assets/uploads/contoh.jpg') ?>"
                        alt="Contoh"
                        class="img_native img-spaced"
                        loading="lazy"
                        decoding="async">
                </div>

                <?= $this->renderSection('admin_dashboard') ?>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-lg-flex text-center text-md-center align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; PT. Najwa Jaya Sukses 2022</div>
                        <div><span>Developed by</span> <a href="https://id.linkedin.com/in/bayu-albar-ladici-637781273">Bayudev</a></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="<?= base_url('/assets/js/scripts.js') ?>"></script>
    <script src="<?= base_url('/assets/js/script.js') ?>"></script>
</body>

</html>