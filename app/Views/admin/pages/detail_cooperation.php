<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>
<div class="container">
    <h1 class="mt-4">Layout</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><?= esc($sub_judul) ?></li>
    </ol>
    <div class="cover_btn_insert">
        <a class="btn_a_admin" href="<?= base_url('admin/pages/cooperation') ?>" role="button"><span><i class="fa-solid fa-angle-left"></i></span> Kembali</a>
    </div>
    <div class="cover_detail_cooperation">
        <div class="cover_img_cooperation">
            <img src="<?= base_url('assets/img/logo.jpg') ?>" alt="PT. Najwa Jaya Sukses" class="img_cooperation">
        </div>
        <div class="cover_content_cooperation">
            <h6 class="judul_cooperation">PT. Najwa Jaya Sukses</h6>
            <p class="p_cooperation">Cooperation</p>
            <p class="sub_cooperation"><?= esc($d_cooperation['ruang_lingkup_kerjasama']) ?></p>
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
            <hr>
            <div class="cover_second_content">
                <div class="narasi-kerjasama mt-4">
                    <p>
                        Pada tanggal <strong><?= esc(formatTanggalLengkapIndonesia($d_cooperation['tanggal_pengajuan'])) ?></strong>,
                        telah terjalin sebuah kesepakatan kerja sama antara <strong><?= esc($d_cooperation['nama_perusahaan']) ?></strong>
                        dan <strong>PT. Najwa Jaya Sukses</strong> sebagai bentuk komitmen kedua belah pihak dalam membangun sinergi
                        yang produktif dan berkelanjutan. Kerja sama ini diharapkan mampu memberikan manfaat timbal balik serta
                        mempererat hubungan profesional demi tercapainya tujuan bersama secara optimal dan harmonis.
                    </p>
                </div>

                <div class="surat-info">
                    <div class="baris-info">
                        <span class="label">Nama Perusahaan</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc($d_cooperation['nama_perusahaan']) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Penanggung Jawab</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc($d_cooperation['penanggung_jawab']) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Jabatan</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc($d_cooperation['jabatan']) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Telepon</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc($d_cooperation['telepon']) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Email</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc($d_cooperation['email']) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Alamat Perusahaan</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc($d_cooperation['alamat_perusahaan']) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Tanggal Pengajuan</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc(formatTanggalLengkapIndonesia($d_cooperation['tanggal_pengajuan'])) ?></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Status Pengajuan</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><?= esc($d_cooperation['status_pengajuan']) ?></span>
                    </div>

                    <?php if ($d_cooperation['status_pengajuan'] === 'Dibatalkan') : ?>
                        <div class="baris-info">
                            <span class="label">Alasan</span>
                            <span class="titik-dua">:</span>
                            <span class="isi"><?= esc($d_cooperation['alasan']) ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="baris-info">
                        <span class="label">Proposal</span>
                        <span class="titik-dua">:</span>
                        <span class="isi">
                            <a class="" target="_blank" href="<?= base_url('assets/uploads/') . esc($d_cooperation['proposal']) ?>" role="button">Lihat Disini</a>
                        </span>
                        <span class="isi">
                            <a class="" target="_blank" download="<?= base_url('assets/uploads/') . esc($d_cooperation['proposal']) ?>" href="<?= base_url('assets/uploads/') . esc($d_cooperation['proposal']) ?>" role="button">Download Disini</a>
                        </span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Profil Perusahaan</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><a class="" target="_blank" href="<?= base_url('assets/uploads/') . esc($d_cooperation['profil_perusahaan']) ?>" role="button">Lihat Disini</a></span>
                        <span class="isi"><a class="" target="_blank" download="<?= base_url('assets/uploads/') . esc($d_cooperation['profil_perusahaan']) ?>" href="<?= base_url('assets/uploads/') . esc($d_cooperation['profil_perusahaan']) ?>" role="button">Download Disini</a></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Dokumen Npwp</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><a class="" target="_blank" href="<?= base_url('assets/uploads/') . esc($d_cooperation['dokumen_npwp']) ?>" role="button">Lihat Disini</a></span>
                        <span class="isi"><a class="" target="_blank" download="<?= base_url('assets/uploads/') . esc($d_cooperation['dokumen_npwp']) ?>" href="<?= base_url('assets/uploads/') . esc($d_cooperation['dokumen_npwp']) ?>" role="button">Download Disini</a></span>
                    </div>
                    <div class="baris-info">
                        <span class="label">Surat Pernyataan Kerjasam</span>
                        <span class="titik-dua">:</span>
                        <span class="isi"><a class="" target="_blank" href="<?= base_url('assets/uploads/') . esc($d_cooperation['surat_pernyataan']) ?>" role="button">Lihat Disini</a></span>
                        <span class="isi"><a class="" target="_blank" download="<?= base_url('assets/uploads/') . esc($d_cooperation['surat_pernyataan']) ?>" href="<?= base_url('assets/uploads/') . esc($d_cooperation['surat_pernyataan']) ?>" role="button">Download Disini</a></span>
                    </div>
                </div>
            </div>
            <div class="ttd-container">
                <div class="ttd-box">
                    <p>Mengetahui,</p>
                    <p class="jabatan">Direktur</p>
                    <div class="ttd-space"></div>
                    <p class="nama-ttd"><?= esc($d_cooperation['penanggung_jawab']) ?></p>
                </div>

                <div class="ttd-box">
                    <p>Serang, <?= esc(formatTanggalIndonesia(date('Y-m-d'))) ?></p>
                    <p class="jabatan">Pihak Mengetahui</p>
                    <div class="ttd-space"></div>
                    <p class="nama-ttd">____________________</p>
                </div>
            </div>


        </div>
    </div>

</div>
<?= $this->endSection() ?>