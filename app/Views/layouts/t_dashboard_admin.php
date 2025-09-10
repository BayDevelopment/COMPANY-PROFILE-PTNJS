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

    <!-- link datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <!-- icon -->
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">


    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .span-native-njs {
        font-size: 1.3rem;
        font-weight: 700;
        background: linear-gradient(45deg, #c58a0aff, #FFFFFF);
        /* kuning emas ke putih */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-fill-color: transparent;
        letter-spacing: 1px;
    }
</style>

<body class="sb-nav-fixed">

    <!-- alert -->
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
            const ToastError = Swal.mixin({
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

            ToastError.fire({
                icon: "error",
                title: "<?= session()->getFlashdata('sweet_error'); ?>"
            });
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('sweet_warning')) : ?>
        <script>
            const ToastWarning = Swal.mixin({
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

            ToastWarning.fire({
                icon: "error",
                title: "<?= session()->getFlashdata('sweet_warning'); ?>"
            });
        </script>
    <?php endif; ?>


    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand align-items-center" href="<?= base_url('admin/dashboard') ?>">
            <img src="<?= base_url('assets/img/logo.png') ?>"
                alt="LOGO PT.NJS"
                width="40"
                height="40"
                class="ms-3 me-2 rounded-circle shadow-sm">
            <span class="span-native-njs" style="font-size: 1.1rem;">NJS CORE</span>
        </a>


        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav mx-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <?php if ($sub_judul == 'Profile'): ?>
                            <a class="dropdown-item active_profile" href="/admin/profile"><span><i class="fa-solid fa-user"></i></span> Profile</a>
                        <?php else: ?>
                            <a class="dropdown-item " href="/admin/profile"><span><i class="fa-solid fa-user"></i></span> Profile</a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="/admin/logout"><span><i class="fa-solid fa-arrow-right-from-bracket"></i></span> Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <?php if ($sub_judul == 'Dashboard'): ?>
                            <a class="nav-link active_native" href="/admin/dashboard_admin">
                                <div class="sb-nav-link-icon active_native"><i class="fas fa-tachometer-alt "></i></div>
                                Dashboard
                            </a>
                        <?php else: ?>
                            <a class="nav-link " href="/admin/dashboard">
                                <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt "></i></div>
                                Dashboard
                            </a>
                        <?php endif; ?>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <?php if ($sub_judul == "Setting Home"): ?>
                                    <a class="nav-link active" href="<?= base_url('admin/pages/home') ?>">Home</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('admin/pages/home') ?>">Home</a>
                                <?php endif; ?>

                                <?php if ($sub_judul == "About"): ?>
                                    <a class="nav-link active_native" href="<?= base_url('admin/pages/about') ?>">About</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('admin/pages/about') ?>">About</a>
                                <?php endif; ?>

                                <?php if ($sub_judul == "Setting Services"): ?>
                                    <a class="nav-link active" href="<?= base_url('admin/pages/services') ?>">Service's</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('admin/pages/services') ?>">Service's</a>
                                <?php endif; ?>

                                <?php if ($sub_judul == "Project"): ?>
                                    <a class="nav-link active" href="<?= base_url('admin/pages/project') ?>">Project's</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('admin/pages/project') ?>">Project's</a>
                                <?php endif; ?>

                                <?php if ($sub_judul == "Contact Us"): ?>
                                    <a class="nav-link active" href="<?= base_url('admin/pages/contact') ?>">Contact</a>
                                <?php else: ?>
                                    <a class="nav-link" href="<?= base_url('admin/pages/contact') ?>">Contact</a>
                                <?php endif; ?>
                            </nav>
                        </div>
                        <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div> -->
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <?php if ($sub_judul == "Cooperation"): ?>
                            <a class="nav-link active" href="<?= base_url('admin/pages/cooperation') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-handshake"></i></div>
                                Cooperation
                            </a>
                        <?php else: ?>
                            <a class="nav-link" href="<?= base_url('admin/pages/cooperation') ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-handshake"></i></div>
                                Cooperation
                            </a>
                        <?php endif; ?>
                        <!-- <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a> -->
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <span class="fw-semibold text-white"><?= esc($jabatan) ?></span>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <?= $this->renderSection('admin_dashboard') ?>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-lg-flex text-center text-md-center align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; PT. Najwa Jaya Sukses 2022</div>
                        <div>
                            <span>Developed by</span> <a href="https://id.linkedin.com/in/bayu-albar-ladici-637781273"> Bayudev</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- js datables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- js native -->
    <script src="<?= base_url('/assets/js/scripts.js') ?>"></script>
    <script src="<?= base_url('/assets/js/script.js') ?>"></script>
    <script src="<?= base_url('/assets/js/jquery.min.js') ?>"></script>
    <script>
        $(function() {
            const table = new DataTable('#example', {
                dom: 'Blfrtip',
                scrollX: true,
                autoWidth: false,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'Semua']
                ],
                columnDefs: [{
                    targets: '_all',
                    className: 'dt-nowrap'
                }],
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Download Excel',
                    className: 'btn btn-success',
                    filename: function() {
                        const p = new URLSearchParams(location.search);
                        const suf = p.toString() ? '_filtered' : '';
                        const d = new Date().toISOString().slice(0, 10);
                        return `Laporan_kerjasama${suf}_${d}`;
                    },
                    title: 'Laporan_kerjasama',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            search: 'applied',
                            order: 'applied',
                            page: 'all'
                        }
                    }
                }]
            });
            table.on('init', () => table.columns.adjust());
        });



        // laporan kontak 
        $(document).ready(function() {
            var table = new DataTable('#contactTable', {
                dom: 'Blfrtip', // B = Buttons, l = length, f = filter, r = processing, t = table, i = info, p = pagination
                lengthMenu: [
                    [10, 25, 50, -1], // nilai pilihan
                    [10, 25, 50, "Semua"] // label yang tampil
                ],
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Download Excel',
                    title: 'Laporan_Kontak',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    }
                }]
            });
        });


        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('admin/pages/hapus-home-first/') ?>" + id;
                }
            });
        }

        function confirmDeleteServices(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('admin/pages/services/delete/') ?>" + id;
                }
            });
        }

        function confirmDeleteAbout(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('admin/pages/about/hapus/') ?>" + id;
                }
            });
        }
    </script>
</body>

</html>