<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dokumen Kerja Sama</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        hr {
            border: 1px solid #000;
            margin: 20px 0;
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
    </style>
</head>

<body>

    <div class="header">
        <img src="<?= $logoBase64 ?>" alt="Logo" width="100">
        <h2>PT. Najwa Jaya Sukses</h2>
        <p class="fw-semibold">Dokumen Kerja Sama</p>
        <p class="fw-light"><strong><?= esc($d_cooperation['ruang_lingkup_kerjasama']) ?></strong></p>
        <div class="baris-info">
            <span class="label">Dibuat</span>
            <span class="titik-dua">:</span>
            <span class="isi">
                <?= esc(formatTanggalLengkapIndonesia($d_cooperation['created_at'])) ?>
            </span>
        </div>
        <div class="baris-info">
            <span class="label">Diubah</span>
            <span class="titik-dua">:</span>
            <span class="isi">
                <?= esc(formatTanggalLengkapIndonesia($d_cooperation['updated_at'])) ?>
            </span>
        </div>
    </div>

    <hr>

    <div class="narasi">
        <p>Pada tanggal <strong><?= esc(formatTanggalLengkapIndonesia($d_cooperation['tanggal_pengajuan'])) ?></strong>,
            telah terjalin sebuah kesepakatan kerja sama antara <strong><?= esc($d_cooperation['nama_perusahaan']) ?></strong>
            dan <strong>PT. Najwa Jaya Sukses</strong> sebagai bentuk komitmen kedua belah pihak dalam membangun sinergi
            yang produktif dan berkelanjutan. Kerja sama ini diharapkan mampu memberikan manfaat timbal balik serta
            mempererat hubungan profesional demi tercapainya tujuan bersama secara optimal dan harmonis.</p>
    </div>

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