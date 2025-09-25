<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dokumen Kerja Sama</title>
    <style>
        /* ===== Base ===== */
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #000;
        }

        .narasi {
            text-align: justify;
            margin-bottom: 20px;
        }

        table.info {
            width: 100%;
            border-collapse: collapse;
        }

        table.info td {
            padding: 4px 0;
            vertical-align: top;
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
            text-align: center;
        }

        .ttd .box {
            width: 45%;
            display: inline-block;
        }

        .ttd .space {
            height: 60px;
        }

        .ttd .nama {
            text-decoration: underline;
            font-weight: bold;
        }

        /* optional info rows styling */
        .baris-info {
            margin: 4px 0;
        }

        .baris-info .label {
            display: inline-block;
            min-width: 60px;
        }

        /* ===== Letterhead (kop) ===== */
        .header {
            margin-bottom: 12px;
        }

        .letterhead {
            display: table;
            width: 100%;
        }

        .lh-left {
            display: table-cell;
            width: 85px;
            vertical-align: top;
        }

        .lh-right {
            display: table-cell;
            vertical-align: top;
            padding-left: 10px;
        }

        .lh-logo {
            width: 80px;
            height: auto;
        }

        .lh-title {
            font-size: 22px;
            font-weight: 800;
            color: #e67e22;
            letter-spacing: .6px;
            text-transform: uppercase;
            margin: 0 0 4px 0;
            line-height: 1.15;
        }

        .lh-sub,
        .lh-addr,
        .lh-contact {
            font-size: 11px;
            margin: 0 0 2px 0;
            line-height: 1.35;
        }

        .lh-contact strong {
            font-weight: 700;
        }

        .lh-contact .mail {
            color: #0070c0;
            text-decoration: underline;
        }

        .lh-divider {
            border-top: 3px solid #000;
            margin: 6px 0 14px 0;
        }

        /* judul dokumen di bawah kop */
        .doc-title {
            margin: 0 0 10px 0;
            font-weight: 700;
            font-size: 14px;
        }

        .doc-sub {
            margin: 0 0 12px 0;
        }
    </style>
</head>

<body>

    <!-- ===== HEADER / KOP ===== -->
    <div class="header">
        <div class="letterhead">
            <div class="lh-left">
                <img src="<?= $logoBase64 ?>" alt="Logo" class="lh-logo">
            </div>
            <div class="lh-right">
                <div class="lh-title">PT. Najwa Jaya Sukses</div>
                <p class="lh-sub">
                    Contractor, Supplier, Insulation, Mechanical, Instrument, Electrical, Construction,
                    Scaffolding, Civil, Piping, Labor Supply &amp; Service
                </p>
                <p class="lh-addr">
                    Jl. Raya Salira Kp. Pengoreng RT 06/02 Ds. Mangunreja Kec. Pulo Ampel, Kab. Serang – Banten
                </p>
                <p class="lh-contact">
                    Telp: <strong>085219691708</strong>
                    &nbsp;&nbsp; E-Mail: <span class="mail">arifudinnjs@gmail.com</span>
                </p>
            </div>
        </div>
        <div class="lh-divider"></div>

        <!-- judul dokumen -->
        <h3 class="doc-title">Dokumen Kerja Sama</h3>
        <p class="doc-sub"><strong><?= esc($d_cooperation['ruang_lingkup_kerjasama']) ?></strong></p>

        <!-- meta info -->
        <div class="baris-info">
            <span class="label">Dibuat</span><span> :</span>
            <span class="isi"><?= esc(formatTanggalLengkapIndonesia($d_cooperation['created_at'])) ?></span>
        </div>
        <div class="baris-info">
            <span class="label">Diubah</span><span> :</span>
            <span class="isi"><?= esc(formatTanggalLengkapIndonesia($d_cooperation['updated_at'])) ?></span>
        </div>
    </div>

    <!-- ===== NARASI ===== -->
    <div class="narasi">
        <p>
            Pada tanggal <strong><?= esc(formatTanggalLengkapIndonesia($d_cooperation['tanggal_pengajuan'])) ?></strong>,
            telah terjalin sebuah kesepakatan kerja sama antara
            <strong><?= esc($d_cooperation['nama_perusahaan']) ?></strong> dan
            <strong>PT. Najwa Jaya Sukses</strong> sebagai bentuk komitmen kedua belah pihak
            dalam membangun sinergi yang produktif dan berkelanjutan. Kerja sama ini diharapkan
            mampu memberikan manfaat timbal balik serta mempererat hubungan profesional demi
            tercapainya tujuan bersama secara optimal dan harmonis.
        </p>
    </div>

    <!-- ===== TABEL INFO ===== -->
    <table class="info">
        <tr>
            <td width="160">Nama Perusahaan</td>
            <td width="10">:</td>
            <td><?= esc($d_cooperation['nama_perusahaan']) ?></td>
        </tr>
        <tr>
            <td>Penanggung Jawab</td>
            <td>:</td>
            <td><?= esc($d_cooperation['penanggung_jawab']) ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= esc($d_cooperation['jabatan']) ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>:</td>
            <td><?= esc($d_cooperation['telepon']) ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?= esc($d_cooperation['email']) ?></td>
        </tr>
        <tr>
            <td>Alamat Perusahaan</td>
            <td>:</td>
            <td><?= esc($d_cooperation['alamat_perusahaan']) ?></td>
        </tr>
        <tr>
            <td>Tanggal Pengajuan</td>
            <td>:</td>
            <td><?= esc(formatTanggalLengkapIndonesia($d_cooperation['tanggal_pengajuan'])) ?></td>
        </tr>
        <tr>
            <td>Status Pengajuan</td>
            <td>:</td>
            <td><?= esc($d_cooperation['status_pengajuan']) ?></td>
        </tr>
        <?php if ($d_cooperation['status_pengajuan'] === 'Dibatalkan') : ?>
            <tr>
                <td>Alasan</td>
                <td>:</td>
                <td><?= esc($d_cooperation['alasan']) ?></td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- ===== TANDA TANGAN ===== -->
    <div class="ttd">
        <div class="box">
            <p>Mengetahui,</p>
            <p class="jabatan">Direktur</p>
            <div class="space"></div>
            <p class="nama"><?= esc($d_cooperation['penanggung_jawab']) ?></p>
        </div>

        <div class="box">
            <p>Serang, <?= esc(formatTanggalIndonesia(date('Y-m-d'))) ?></p>
            <p class="jabatan">Pihak Mengetahui</p>
            <div class="space"></div>
            <p class="nama">____________________</p>
        </div>
    </div>

</body>

</html>