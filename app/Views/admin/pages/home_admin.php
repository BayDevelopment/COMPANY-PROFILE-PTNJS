<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<style>
    /* ========== NJS CARD SYSTEM ========== */
    /* Token & Variabel */
    :root {
        --njs-card-bg: #fff;
        --njs-card-fg: #4b4b4bff;
        --njs-card-muted: #69707d;
        --njs-card-border: #e6e8eb;
        --njs-card-shadow: 0 6px 20px rgba(51, 51, 51, 0.08);
        --njs-card-radius: 16px;
        --njs-card-gap: 16px;
        --njs-card-pad: 20px;
        --njs-card-pad-sm: 14px;
        --njs-accent: #ffda6a;
        /* kuning halus */
        --njs-danger: #ef4444;
        --njs-success: #10b981;
    }

    /* Dark mode adaptif */
    @media (prefers-color-scheme: dark) {
        :root {
            --njs-card-bg: #ffffffff;
            --njs-card-fg: #383838ff;
            --njs-card-muted: #94a3b8;
            --njs-card-border: #e5e7eb;
            --njs-card-shadow: 0 6px 20px rgba(0, 0, 0, .45);
        }
    }

    /* ========== CARD DASAR ========== */
    .njs-card {
        background: var(--njs-card-bg);
        color: var(--njs-card-fg);
        border: 1px solid var(--njs-card-border);
        border-radius: var(--njs-card-radius);
        box-shadow: var(--njs-card-shadow);
        overflow: hidden;
        /* potong media & badge */
        display: flex;
        flex-direction: column;
    }

    .njs-card__body {
        padding: var(--njs-card-pad);
    }

    /* ========== HEADER / FOOTER ========== */
    .njs-card__header,
    .njs-card__footer {
        padding: var(--njs-card-pad);
        display: flex;
        align-items: center;
        gap: var(--njs-card-gap);
    }

    .njs-card__header {
        border-bottom: 1px solid var(--njs-card-border);
        justify-content: space-between;
        /* judul kiri, actions kanan */
    }

    .njs-card__footer {
        border-top: 1px solid var(--njs-card-border);
        justify-content: flex-end;
        /* tombol kanan */
    }

    /* Judul & subjudul */
    .njs-card__title {
        font-weight: 700;
        font-size: 1.05rem;
        margin: 0;
    }

    .njs-card__subtitle {
        margin: 2px 0 0;
        font-size: .9rem;
        color: var(--njs-card-muted);
    }

    .njs-card__headings {
        display: grid;
        gap: 2px;
    }

    /* Area aksi (icon/tombol) */
    .njs-card__actions {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    /* ========== MEDIA (gambar/video) ========== */
    .njs-card__media {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        /* aman default */
        background: #f4f6f8;
        overflow: hidden;
    }

    .njs-card__media>img,
    .njs-card__media>video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Badge pada pojok media */
    .njs-card__badge {
        position: absolute;
        top: 10px;
        left: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(0, 0, 0, .6);
        color: #fff;
        font-size: .75rem;
        padding: 6px 10px;
        border-radius: 999px;
        backdrop-filter: blur(2px);
    }

    /* ========== VARIAN CARD ========== */
    .njs-card--outlined {
        box-shadow: none;
    }

    .njs-card--hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, .12);
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .njs-card--clickable {
        cursor: pointer;
    }

    .njs-card--clickable:focus-within,
    .njs-card--clickable:hover {
        outline: 2px solid color-mix(in srgb, var(--njs-accent) 60%, transparent);
        outline-offset: 2px;
    }

    /* ========== KONTEN: LIST, META, GRID DI BODY ========== */
    .njs-card__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 16px;
        margin-bottom: 8px;
        color: var(--njs-card-muted);
        font-size: .9rem;
    }

    .njs-card__list {
        display: grid;
        gap: 10px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .njs-card__list-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px dashed var(--njs-card-border);
    }

    .njs-card__list-item:last-child {
        border-bottom: 0;
    }

    /* ========== GRID KUMPULAN CARD ========== */
    .njs-card-grid {
        display: grid;
        gap: 18px;
        grid-template-columns: repeat(12, 1fr);
    }

    .njs-card-grid>.njs-card {
        grid-column: span 4;
    }

    /* 3 kolom desktop */

    @media (max-width: 992px) {
        .njs-card-grid>.njs-card {
            grid-column: span 6;
        }
    }

    /* 2 kolom */
    @media (max-width: 576px) {
        .njs-card-grid>.njs-card {
            grid-column: span 12;
        }
    }

    /* 1 kolom */

    /* ========== UTILITIES ========== */
    .njs-divider {
        height: 1px;
        background: var(--njs-card-border);
        margin: 12px 0;
        width: 100%;
    }

    .njs-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .8rem;
        padding: 6px 10px;
        border-radius: 999px;
        background: #f4f6f8;
        color: var(--njs-card-fg);
        border: 1px solid var(--njs-card-border);
    }

    .njs-chip--success {
        background: color-mix(in srgb, var(--njs-success) 18%, #fff);
        border-color: color-mix(in srgb, var(--njs-success) 40%, #fff);
    }

    .njs-chip--danger {
        background: color-mix(in srgb, var(--njs-danger) 18%, #fff);
        border-color: color-mix(in srgb, var(--njs-danger) 40%, #fff);
    }

    .njs-btn {
        appearance: none;
        border: 1px solid var(--njs-card-border);
        background: #fff;
        color: var(--njs-card-fg);
        padding: 8px 12px;
        border-radius: 10px;
        font-size: .9rem;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .njs-btn:hover {
        background: #fafafa;
    }

    .njs-btn--ghost {
        border-color: transparent;
        background: transparent;
    }

    .njs-btn--accent {
        border-color: color-mix(in srgb, var(--njs-accent) 40%, #fff);
        background: linear-gradient(135deg, #fff176, #9b9349ff);
        color: #fff;
    }

    /* ========== STATE ========== */
    .njs-skeleton {
        position: relative;
        overflow: hidden;
        background: #f1f3f5;
        border-radius: 8px;
    }

    .njs-skeleton::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .55), transparent);
        transform: translateX(-100%);
        animation: njs-shimmer 1.25s infinite;
    }

    @keyframes njs-shimmer {
        to {
            transform: translateX(100%);
        }
    }

    .njs-empty {
        text-align: center;
        color: var(--njs-card-muted);
        padding: 28px 16px;
        font-size: .95rem;
    }

    /* =========================
       RESPONSIVE ENHANCEMENTS
       ========================= */
    /* Tipografi fluid */
    .njs-card__title {
        font-size: clamp(1rem, 1.2vw + .8rem, 1.15rem);
    }

    .njs-card__subtitle {
        font-size: clamp(.82rem, .5vw + .7rem, .95rem);
    }

    /* Header & actions wrap */
    .njs-card__header {
        flex-wrap: wrap;
        align-items: flex-start;
        row-gap: 8px;
    }

    .njs-card__headings {
        min-width: 240px;
    }

    /* Actions & paddings mobile */
    @media (max-width: 576px) {
        .njs-card__actions {
            width: 100%;
            justify-content: flex-start;
            gap: 8px;
        }

        .njs-card__header,
        .njs-card__footer {
            padding: var(--njs-card-pad-sm);
        }

        .njs-card__body {
            padding: var(--njs-card-pad-sm);
        }
    }

    /* Grid 1–4 kolom adaptif */
    .njs-card-grid {
        gap: clamp(12px, 2.2vw, 22px);
    }

    .njs-card-grid>.njs-card {
        grid-column: span 6;
    }

    /* default 2 kolom */
    @media (min-width: 576px) {
        .njs-card-grid>.njs-card {
            grid-column: span 6;
        }
    }

    @media (min-width: 992px) {
        .njs-card-grid>.njs-card {
            grid-column: span 4;
        }
    }

    @media (min-width: 1400px) {
        .njs-card-grid>.njs-card {
            grid-column: span 3;
        }
    }

    /* Media: tinggi minimal & posisi */
    .njs-card__media {
        aspect-ratio: auto;
        min-height: clamp(160px, 24vw, 320px);
    }

    .njs-card__media>img,
    .njs-card__media>video {
        object-position: center;
    }

    /* Badge kecil di very-small */
    @media (max-width: 400px) {
        .njs-card__badge {
            font-size: .7rem;
            padding: 4px 8px;
            top: 8px;
            left: 8px;
        }
    }

    /* Footer rapat di mobile */
    @media (max-width: 576px) {
        .njs-card__footer {
            justify-content: flex-start;
            gap: 8px;
        }
    }

    /* Tombol: target sentuh */
    @media (max-width: 576px) {
        .njs-btn {
            padding: 10px 12px;
            font-size: .92rem;
        }
    }

    /* Divider & empty state dinamis */
    .njs-divider {
        margin: clamp(8px, 1.5vw, 16px) 0;
    }

    .njs-empty {
        padding: clamp(18px, 3vw, 28px) clamp(12px, 2vw, 16px);
    }

    /* Kurangi bayangan di mobile */
    @media (max-width: 576px) {
        .njs-card {
            box-shadow: 0 4px 14px rgba(173, 173, 173, 0.06);
        }
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .njs-card--hover:hover {
            transform: none;
            box-shadow: var(--njs-card-shadow);
        }

        .njs-skeleton::after {
            animation: none;
        }
    }

    /* Penyesuaian elemen yang sudah ada (opsional) */
    .native_carousel .carousel-caption {
        padding: clamp(.5rem, 1.5vw, 1rem) clamp(.75rem, 2vw, 1.25rem);
    }

    .judul_carousel {
        font-size: clamp(1.1rem, 1.8vw + .6rem, 1.6rem);
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

<main class="page-main">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h1 class="fw-bold text-warning">Setting Home</h1>
                <p class="text-muted mb-0">Setting Home</p>
            </div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="text-black text-decoration-none">
                        <i class="fa fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active">About</li>
            </ol>
        </div>

        <!-- Card utama -->
        <div class="njs-card njs-card--hover">
            <div class="njs-card__header">
                <div class="njs-card__headings">
                    <h3 class="njs-card__title">Jumbotron & About</h3>
                    <p class="njs-card__subtitle">Ringkasan konten beranda</p>
                </div>
                <div class="njs-card__actions">
                    <a class="btn btn-shiny" href="<?= base_url('admin/pages/tambah') ?>">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                </div>
            </div>

            <!-- Media -->
            <div class="njs-card__media">
                <div class="native_carousel">
                    <?php if ($jumlahFast_model < 1): ?>
                        <span class="njs-card__badge"><i class="fa fa-info-circle"></i> Kosong</span>
                    <?php else: ?>
                        <span class="njs-card__badge"><i class="fa fa-image"></i> Banner</span>
                    <?php endif; ?>
                    <div class="carousel-caption">
                        <?php if ($jumlahFast_model > 0): foreach ($data_firstHome as $d_firstHomeJumbo): ?>
                                <h5 class="judul_carousel"><?= esc($d_firstHomeJumbo['judul_jumbotron']) ?></h5>
                                <p><?= esc($d_firstHomeJumbo['paragraft_jumbo']) ?></p>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="njs-card__body">
                <?php if ($jumlahFast_model < 1): ?>
                    <div class="njs-empty">Belum ada data yang diinputkan.</div>
                <?php else: ?>
                    <div class="njs-card__meta">
                        <span class="njs-chip">Home</span>
                        <span class="njs-chip">Jumbotron</span>
                    </div>
                    <div class="njs-divider"></div>

                    <div class="row align-items-center gy-3 gy-lg-4">
                        <?php foreach ($data_firstHome as $d_firstHomeAbout): ?>
                            <div class="col-lg-7 mb-2 mb-lg-4">
                                <h6 class="njs-card__title"><?= esc($d_firstHomeAbout['judul_about']) ?></h6>
                                <p class="paragraft_native mb-0">
                                    <?= esc(substr($d_firstHomeAbout['paragraft_about'], 0, 300)) ?>…
                                </p>
                            </div>
                            <div class="col-lg-5 mb-2 mb-lg-4">
                                <img
                                    src="<?= base_url('assets/uploads/' . $d_firstHomeAbout['image_about']) ?>"
                                    alt="PT. Najwa Jaya Sukses"
                                    class="img-fluid rounded-3"
                                    loading="lazy" decoding="async">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Footer -->
            <div class="njs-card__footer">
                <?php if ($jumlahFast_model > 0): ?>
                    <a class="btn btn-shiny" href="<?= base_url('admin/pages/edit-home-first') ?>">
                        <i class="fa fa-pen"></i> Edit
                    </a>
                    <button class="btn btn-shiny"
                        onclick="confirmDelete(<?= (int)($d_firstHomeAbout['id_home_first'] ?? 0) ?>)">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection() ?>