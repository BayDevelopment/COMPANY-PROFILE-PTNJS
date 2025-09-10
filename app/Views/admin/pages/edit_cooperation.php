<?php $this->extend('layouts/t_dashboard_admin'); ?>
<?php $this->section('admin_dashboard'); ?>
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
        <form action="<?= site_url('admin/pages/cooperation/edit/') . esc($d_cooperation['id_pengajuan']) ?>" method="post">
            <div class="cover_content_cooperation">
                <h6 class="judul_cooperation">PT. Najwa Jaya Sukses</h6>
                <p class="p_cooperation">Cooperation</p>
                <div class="baris-info">
                    <span class="label">Lingkup Kerjasama</span>
                    <span class="titik-dua">:</span>
                    <span class="isi">
                        <?php
                        $currentStatus = $d_cooperation['ruang_lingkup_kerjasama'];

                        $statusList = [
                            'Construction' => 'Construction',
                            'Electrical'   => 'Electrical',
                            'Mechanical'   => 'Mechanical',
                            'Civil'        => 'Civil',
                            'Painting'     => 'Painting',
                            'Scafolding'   => 'Scafolding',
                            'Insulation'   => 'Insulation'
                        ];
                        ?>

                        <select class="form-select fc_native" name="ruang_lingkup_kerjasama" required>
                            <option value="" disabled>-- PILIH STATUS --</option>
                            <?php foreach ($statusList as $value => $label) : ?>
                                <option value="<?= $value ?>" <?= ($value == $currentStatus) ? 'selected' : '' ?>>
                                    <?= $label ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </span>
                </div>
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

                    <?php if (session()->getFlashdata('errors')) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>


                    <div class="surat-info">
                        <div class="baris-info">
                            <span class="label">Nama Perusahaan</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <input type="text" class="form-control fc_native" id="nama_perusahaan" name="nama_perusahaan" value="<?= esc($d_cooperation['nama_perusahaan']) ?>">
                                <span class="text-danger"><?= isset($validation) ? esc($validation->getError('nama_perusahaan')) : '' ?></span>
                            </span>
                        </div>
                        <div class="baris-info">
                            <span class="label">Penanggung Jawab</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <input type="text" class="form-control fc_native" id="penanggung_jawab" name="penanggung_jawab" value="<?= esc($d_cooperation['penanggung_jawab']) ?>">
                                <span class="text-danger"><?= isset($validation) ? esc($validation->getError('penanggung_jawab')) : '' ?></span>
                            </span>
                        </div>
                        <div class="baris-info">
                            <span class="label">Jabatan</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <input type="text" class="form-control fc_native" id="jabatan" name="jabatan" value="<?= esc($d_cooperation['jabatan']) ?>">
                                <span class="text-danger"><?= isset($validation) ? esc($validation->getError('jabatan')) : '' ?></span>
                            </span>
                        </div>
                        <div class="baris-info">
                            <span class="label">Telepon</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <input type="text" class="form-control fc_native" id="telepon" name="telepon" value="<?= esc($d_cooperation['telepon']) ?>">
                                <span class="text-danger"><?= isset($validation) ? esc($validation->getError('telepon')) : '' ?></span>
                            </span>
                        </div>
                        <div class="baris-info">
                            <span class="label">Email</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <input type="email" class="form-control fc_native" id="email" name="email" value="<?= esc($d_cooperation['email']) ?>">
                                <span class="text-danger"><?= isset($validation) ? esc($validation->getError('email')) : '' ?></span>
                            </span>
                        </div>
                        <div class="baris-info">
                            <span class="label">Alamat Perusahaan</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <textarea class="form-control fc_native" id="alamat_perusahaan" rows="3" name="alamat_perusahaan"> <?= esc($d_cooperation['alamat_perusahaan']) ?></textarea>
                                <span class="text-danger"><?= isset($validation) ? esc($validation->getError('alamat_perusahaan')) : '' ?></span>
                            </span>
                        </div>
                        <div class="baris-info">
                            <span class="label">Tanggal Pengajuan</span>
                            <span class="titik-dua">:</span>
                            <span class="isi"><?= esc(formatTanggalLengkapIndonesia($d_cooperation['tanggal_pengajuan'])) ?></span>
                        </div>
                        <div class="baris-info">
                            <span class="label">Status Pengajuan</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <?php
                                $currentStatus = $d_cooperation['status_pengajuan'];

                                $statusList = [
                                    'Menunggu persetujuan' => 'Menunggu persetujuan',
                                    'Diproses'              => 'Diproses',
                                    'Disetujui'             => 'Disetujui',
                                    'Dibatalkan'            => 'Dibatalkan',
                                ];
                                ?>

                                <select class="form-select fc_native" name="status_pengajuan" id="status_pengajuan" required>
                                    <option value="" disabled>-- PILIH STATUS --</option>
                                    <?php foreach ($statusList as $value => $label) : ?>
                                        <option value="<?= $value ?>" <?= ($value == $currentStatus) ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </span>
                        </div>
                        <!-- Input alasan -->
                        <div class="baris-info mt-2" id="alasan_container" style="display: none;">
                            <span class="label">Alasan</span>
                            <span class="titik-dua">:</span>
                            <span class="isi">
                                <textarea class="form-control fc_native" name="alasan" id="alasan" rows="3" placeholder="Tuliskan alasan pembatalan..." disabled>
                                    <?= esc($d_cooperation['alasan']) ?>
                                </textarea>
                            </span>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn_a_admin" type="submit"><span><i class="fa-solid fa-file-pen"></i></span> Edit Cooperation</button>
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
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const statusSelect = document.getElementById("status_pengajuan");
        const alasanContainer = document.getElementById("alasan_container");
        const alasanInput = document.getElementById("alasan");

        function toggleAlasan() {
            if (statusSelect.value === "Dibatalkan") {
                alasanContainer.style.display = "flex";
                alasanInput.disabled = false;
                alasanInput.required = true;
            } else {
                alasanContainer.style.display = "none";
                alasanInput.disabled = true;
                alasanInput.required = false;
                alasanInput.value = "";
            }
        }

        // jalankan saat load halaman
        toggleAlasan();

        // jalankan saat status berubah
        statusSelect.addEventListener("change", toggleAlasan);
    });
</script>
<?php $this->endSection(); ?>