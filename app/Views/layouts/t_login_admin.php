<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= esc($title) ?></title>

    <!-- icon -->
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/x-icon">


    <link href="<?= base_url('/assets/css/styles.css') ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .bg_card_login {
            background: #f7eed7;
            background: linear-gradient(90deg, rgba(247, 238, 215, 1) 0%, rgba(255, 210, 10, 1) 50%, rgba(247, 238, 215, 1) 100%);
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: transparent;
            /* biar kelihatan partikel di atas background oranye */
            z-index: -1;
            top: 0;
            left: 0;
        }

        @media (max-width: 576px) {
            #particles-js {
                background-color: transparent;
            }
        }
    </style>

</head>

<body class="bg_card_login">

    <!-- Particles.js container -->
    <div id="particles-js"></div>


    <!-- SweetAlert Flash -->
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
            const ToastEr = Swal.mixin({
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

            ToastEr.fire({
                icon: "info",
                title: "<?= session()->getFlashdata('sweet_error'); ?>"
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_COOKIE['flash_logout'])) : ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "<?= $_COOKIE['flash_logout']; ?>",
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: "top-end",
                timerProgressBar: true
            });
        </script>
        <?php setcookie("flash_logout", "", time() - 3600, "/"); ?>
    <?php endif; ?>

    <!-- Login Section -->
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <?= $this->renderSection('login_admin') ?>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-lg-flex text-center text-md-center align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; PT. Najwa Jaya Sukses 2022</div>
                        <div>
                            <span>Developed by</span> <a href="https://id.linkedin.com/in/bayu-albar-ladici-637781273">Bayudev</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 40,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#007bff"
                },
                "shape": {
                    "type": "circle"
                },
                "opacity": {
                    "value": 0.5
                },
                "size": {
                    "value": 3
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#007bff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    }
                }
            },
            "retina_detect": true
        });
    </script>


</body>

</html>