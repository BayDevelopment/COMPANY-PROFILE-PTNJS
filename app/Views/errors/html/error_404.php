<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>404 • Halaman Tidak Ditemukan</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <style>
        :root {
            --brand: #F8C007;
            --text: #0f172a;
            --muted: #64748b;
            --bg: #f8fafc;
            --card: #ffffff;
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Poppins", sans-serif;
            background: radial-gradient(1200px 600px at 30% -10%, rgba(248, 192, 7, .08), transparent) var(--bg);
            color: var(--text);
            display: grid;
            place-items: center;
        }

        .wrap {
            width: min(960px, 94vw);
            padding: 24px
        }

        .card {
            background: var(--card);
            border-radius: 16px;
            box-shadow: 0 12px 32px rgba(16, 24, 40, .08);
            overflow: hidden;
        }

        .bar {
            height: 6px;
            width: 100%;
            background: linear-gradient(90deg, var(--brand), #ffe168);
        }

        .body {
            padding: clamp(20px, 4vw, 40px);
            text-align: center;
        }

        .logo {
            height: 44px;
            width: auto;
            margin-bottom: 12px;
            object-fit: contain;
        }

        .code {
            font-size: clamp(56px, 10vw, 96px);
            line-height: 1;
            font-weight: 800;
            letter-spacing: .02em;
            background: linear-gradient(90deg, #1f2937 0%, #0f172a 40%, var(--brand) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin: 8px 0 12px;
        }

        .title {
            font-size: clamp(18px, 3.6vw, 28px);
            font-weight: 700;
            margin: 0 0 8px;
        }

        .desc {
            font-size: clamp(14px, 2.8vw, 16px);
            color: var(--muted);
            margin: 0 0 20px;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .7rem 1rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 600;
            text-decoration: none;
            transition: box-shadow .25s ease, background-color .25s ease, border-color .25s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand), #ffe168);
            color: #111827;
            box-shadow: 0 6px 16px rgba(253, 237, 13, .25);
        }

        .btn-primary:hover {
            box-shadow: 0 10px 22px rgba(253, 237, 13, .35);
        }

        .hint {
            margin-top: 16px;
            font-size: 12px;
            color: var(--muted);
        }

        /* jaga agar tidak transform saat hover */
        .btn,
        .btn:hover,
        .btn:focus {
            transform: none;
        }
    </style>
</head>

<body>
    <?php
    // ===== Logika tombol berdasarkan sesi =====
    $role = session('role'); // sesuaikan key session jika berbeda
    $isAdminRole = in_array($role, ['admin'], true);

    // Ganti 'dashboard' jika dashboard public-mu punya route berbeda
    $dashboardUrl = $isAdminRole ? base_url('auth/login') : base_url('admin/dashboard');

    $hasRole   = !empty($role);
    $ctaHref   = $hasRole ? $dashboardUrl : base_url('/');
    $ctaLabel  = $hasRole ? 'Kembali ke Dashboard' : 'Kembali ke Beranda';
    // ==========================================
    ?>

    <main class="wrap">
        <section class="card" role="region" aria-labelledby="err-title">
            <div class="bar"></div>
            <div class="body">
                <img class="logo" src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
                <div class="code" aria-hidden="true">404</div>
                <h1 class="title" id="err-title">Maaf, halaman yang Anda cari tidak ditemukan.</h1>
                <p class="desc">URL mungkin salah atau sudah dipindahkan.</p>

                <div class="actions">
                    <!-- Hanya SATU tombol, dinamis sesuai sesi -->
                    <a href="<?= esc($ctaHref) ?>" class="btn btn-primary"><?= esc($ctaLabel) ?></a>
                </div>

                <div class="hint">Jika masalah berlanjut, hubungi admin sistem Anda.</div>
            </div>
        </section>
    </main>
</body>

</html>