<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    .btn-gradient {
        background: linear-gradient(135deg, #ffe259, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #ffe259, #f3e69dff);
        transform: translateY(-2px);
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f9f9f9, #eef1f6);
    }

    h1,
    h5,
    h6 {
        font-weight: 600;
        color: #2d3436;
    }

    .breadcrumb {
        background: transparent;
        font-size: 0.9rem;
    }

    /* Card wrapper */
    .card-modern {
        background: #fff;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        animation: fadeIn 0.7s ease-in-out;
    }

    /* Carousel */
    .native_carousel {
        height: 280px;
        border-radius: 20px;
        background: url('<?= base_url("assets/img/jumbo_new.jpg") ?>') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    .native_carousel::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        /* overlay gelap */
        border-radius: 20px;
    }


    .carousel-caption {
        background: rgba(0, 0, 0, 0.6);
        border-radius: 14px;
        padding: 1rem 1.5rem;
        animation: fadeIn 1s ease-in-out;
    }

    .judul_carousel {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(to right, #fff176, #fff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Section One */
    .section_one {
        padding: 40px 0;
    }

    .judul_col {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .paragraft_native {
        color: #636e72;
        line-height: 1.7;
    }

    .img_native {
        width: 100%;
        border-radius: 18px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .img_native:hover {
        transform: scale(1.03);
        box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Button modern */
    .btn_a_native {
        background: linear-gradient(135deg, #fff176, #9b9349ff);
        color: #fff;
        padding: 10px 20px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 500;
        margin-right: 8px;
        /* transition: all 0.3s ease; */
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        transition: .2s;
    }

    .btn_a_native:hover {
        background: linear-gradient(135deg, #fff176, #9b9349ff);
        /* transform: translateY(-2px); */
        transition: .2s;
        padding: 10px 20px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        color: #fff;
    }

    /* Alert modern */
    .alert {
        border-radius: 12px;
        font-size: 0.95rem;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold text-warning">Setting Home</h1>
            <p class="text-muted mb-0">Setting Home</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>" class="text-black text-decoration-none"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">About</li>
        </ol>
    </div>

    <!-- Carousel Modern -->
    <div class="card-modern">
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="native_carousel">
                        <?php if ($jumlahFast_model < 1): ?>
                            <div class="alert alert-danger m-0" role="alert">
                                Belum ada data yang diinputkan!
                            </div>
                        <?php else: ?>
                            <?php foreach ($data_firstHome as $d_firstHomeJumbo): ?>
                                <div class="carousel-caption">
                                    <h5 class="judul_carousel"><?= esc($d_firstHomeJumbo['judul_jumbotron']) ?></h5>
                                    <p><?= esc($d_firstHomeJumbo['paragraft_jumbo']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section One Modern -->
    <div class="card-modern">
        <section class="section_one">
            <div class="row align-items-center">
                <?php if ($jumlahFast_model < 1): ?>
                    <div class="alert alert-danger w-100" role="alert">
                        Belum ada data yang diinputkan!
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('admin/pages/tambah') ?>" class="btn_a_native">
                            <i class="fa-solid fa-file-arrow-down"></i> Tambah Data
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach ($data_firstHome as $d_firstHomeAbout): ?>
                        <div class="col-lg-7 mb-4">
                            <h6 class="judul_col"><?= esc($d_firstHomeAbout['judul_about']) ?></h6>
                            <p class="paragraft_native">
                                <?= esc(substr($d_firstHomeAbout['paragraft_about'], 0, 300)) ?>...
                            </p>
                            <div class="mt-3">
                                <a href="<?= base_url('admin/pages/edit-home-first') ?>" class="btn btn-gradient px-4 py-2 rounded-pill">
                                    <i class="fa-solid fa-file-pen"></i> Edit
                                </a>
                                <button class="btn btn-gradient px-4 py-2 rounded-pill"
                                    onclick="confirmDelete(<?= (int)$d_firstHomeAbout['id_home_first'] ?>)">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <img src="<?= base_url('assets/uploads/' . $d_firstHomeAbout['image_about']) ?>"
                                alt="PT. Najwa Jaya Sukses" class="img_native">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>