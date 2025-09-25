<?= $this->extend('layouts/t_dashboard_admin') ?>
<?= $this->section('admin_dashboard') ?>

<style>
    .btn-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 500;
        transition: .3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        color: #fff;
    }

    .page-head {
        padding: 56px 0 12px;
        text-align: center;
    }

    .page-head .head-page-title {
        font-weight: 800;
        letter-spacing: .2px;
        margin-bottom: .5rem;
    }

    .text_p_translite {
        color: #6c757d;
        max-width: 800px;
        margin: 0 auto;
    }

    .card_cooperation {
        border: 0;
        border-radius: 16px;
        box-shadow: 0 12px 32px rgba(16, 24, 40, .08);
        overflow: hidden;
        background: linear-gradient(180deg, #fff, #f8fafc);
    }

    .card_cooperation .card-head {
        padding: 20px 24px 0;
    }

    .cover_form_cooperation {
        padding: 24px;
    }

    .input-group-text {
        background: #fff;
        border-right: 0;
    }

    .form-control.fc_native,
    .form-select.fc_native {
        border-left: 0;
    }

    .form-control.fc_native:focus,
    .form-select.fc_native:focus {
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
    }

    .small-help {
        color: #6c757d;
        font-size: .875rem;
    }

    .upload-note {
        color: #6c757d;
        font-size: .85rem;
    }

    .btn-block {
        display: flex;
        gap: .5rem;
    }

    @media (max-width:576px) {
        .btn-block {
            flex-direction: column;
        }
    }

    .alert i {
        margin-right: .35rem;
    }

    /* Overlay loading submit */
    .submit-overlay {
        position: fixed;
        inset: 0;
        background: rgba(255, 255, 255, .85);
        backdrop-filter: blur(3px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1055;
    }

    .submit-overlay .box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 12px 32px rgba(16, 24, 40, .14);
        padding: 18px 22px;
        text-align: center;
        min-width: 240px;
    }

    .submit-overlay .box .label {
        margin-top: .75rem;
        font-weight: 600;
    }

    .submit-overlay .box .hint {
        margin-top: .25rem;
        font-size: .85rem;
        color: #6c757d;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h2 class="fw-bold text-warning"><?= esc($sub_judul) ?></h2>
            <p class="text-muted mb-0">Tambah data Kerjasama anda dengan valid.</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/home') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin/pages/cooperation') ?>" class="text-decoration-none text-secondary">
                    Layout Cooperation
                </a>
            </li>
            <li class="breadcrumb-item active text-dark">Tambah</li>
        </ol>
    </div>

    <div class="mb-3">
        <a href="<?= base_url('admin/pages/cooperation') ?>" class="btn btn-gradient px-3 py-2 rounded-pill">
            <i class="fa-solid fa-angle-left"></i> Kembali
        </a>
    </div>

    <div class="container">
        <!-- Overlay Loading -->
        <div id="submitOverlay" class="submit-overlay" aria-hidden="true">
            <div class="box">
                <div class="spinner-border" role="status" aria-hidden="true"></div>
                <div class="label">Mengunggah berkas…</div>
                <div class="hint">Mohon tunggu, jangan tutup halaman.</div>
            </div>
        </div>

        <!-- Card Cooperation -->
        <div class="card_cooperation mb-4">
            <div class="card-head">
                <?php if (session()->getFlashdata('sweet_success')): ?>
                    <div class="alert alert-success d-flex align-items-center mt-2" role="alert">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Pengajuan kerja sama telah berhasil diproses. Kami akan segera menghubungi Anda.</span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="cover_form_cooperation">
                <form action="<?= site_url('admin/pages/cooperation/tambah') ?>" method="post" enctype="multipart/form-data" novalidate>
                    <?= csrf_field() ?>
                    <?php $errors = session()->get('errors') ?? []; ?>

                    <div class="row g-3">
                        <!-- Nama Perusahaan -->
                        <div class="col-md-6">
                            <label for="nama_perusahaan" class="form-label">Nama perusahaan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                                <input type="text"
                                    class="form-control fc_native <?= isset($errors['nama_perusahaan']) ? 'is-invalid' : '' ?>"
                                    id="nama_perusahaan" name="nama_perusahaan"
                                    placeholder="Masukan nama perusahaan"
                                    value="<?= old('nama_perusahaan') ?>" required>
                                <div class="invalid-feedback">
                                    <?= isset($errors['nama_perusahaan']) ? $errors['nama_perusahaan'] : 'Nama perusahaan wajib diisi.' ?>
                                </div>
                            </div>
                        </div>

                        <!-- Penanggung Jawab -->
                        <div class="col-md-6">
                            <label for="penanggung_jawab" class="form-label">Penanggung jawab</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                                <input type="text"
                                    class="form-control fc_native <?= isset($errors['penanggung_jawab']) ? 'is-invalid' : '' ?>"
                                    id="penanggung_jawab" name="penanggung_jawab"
                                    placeholder="Masukan nama penanggung jawab"
                                    value="<?= old('penanggung_jawab') ?>" required>
                                <div class="invalid-feedback">
                                    <?= isset($errors['penanggung_jawab']) ? $errors['penanggung_jawab'] : 'Penanggung jawab wajib diisi.' ?>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Perusahaan -->
                        <div class="col-12">
                            <label for="alamat_perusahaan" class="form-label">Alamat perusahaan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                <textarea class="form-control fc_native <?= isset($errors['alamat_perusahaan']) ? 'is-invalid' : '' ?>"
                                    id="alamat_perusahaan" name="alamat_perusahaan"
                                    placeholder="Masukan alamat perusahaan" rows="3" required><?= old('alamat_perusahaan') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= isset($errors['alamat_perusahaan']) ? $errors['alamat_perusahaan'] : 'Alamat perusahaan wajib diisi.' ?>
                                </div>
                            </div>
                        </div>

                        <!-- Jabatan -->
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-id-badge"></i></span>
                                <input type="text"
                                    class="form-control fc_native <?= isset($errors['jabatan']) ? 'is-invalid' : '' ?>"
                                    id="jabatan" name="jabatan"
                                    placeholder="Masukan jabatan anda disini"
                                    value="<?= old('jabatan') ?>" required>
                                <div class="invalid-feedback">
                                    <?= isset($errors['jabatan']) ? $errors['jabatan'] : 'Jabatan wajib diisi.' ?>
                                </div>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="col-md-6">
                            <label for="telepon" class="form-label">Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                <input type="text"
                                    class="form-control fc_native <?= isset($errors['telepon']) ? 'is-invalid' : '' ?>"
                                    id="telepon" name="telepon" placeholder="081212341234"
                                    value="<?= old('telepon') ?>" required>
                                <div class="invalid-feedback">
                                    <?= isset($errors['telepon']) ? $errors['telepon'] : 'Nomor telepon wajib diisi.' ?>
                                </div>
                            </div>
                            <div class="small-help mt-1">Gunakan format Indonesia (contoh: 0812xxxxxxx).</div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email"
                                    class="form-control fc_native <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                    id="email" name="email" placeholder="example@gmail.com"
                                    value="<?= old('email') ?>" required aria-describedby="emailHelp">
                                <div class="invalid-feedback">
                                    <?= isset($errors['email']) ? $errors['email'] : 'Email wajib diisi & harus valid.' ?>
                                </div>
                            </div>
                            <div id="emailHelp" class="form-text small-help">Kami tidak akan pernah membagikan email Anda kepada orang lain.</div>
                        </div>

                        <!-- Kerjasama -->
                        <div class="col-md-6">
                            <label for="ruang_lingkup_kerjasama" class="form-label">Kerjasama</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-handshake"></i></span>
                                <select class="form-select fc_native <?= isset($errors['ruang_lingkup_kerjasama']) ? 'is-invalid' : '' ?>"
                                    id="ruang_lingkup_kerjasama" name="ruang_lingkup_kerjasama" required>
                                    <option selected value="">-- PILIH KERJASAMA --</option>
                                    <option value="Construction" <?= old('ruang_lingkup_kerjasama') == 'Construction' ? 'selected' : '' ?>>Construction</option>
                                    <option value="Electrical" <?= old('ruang_lingkup_kerjasama') == 'Electrical'   ? 'selected' : '' ?>>Electrical</option>
                                    <option value="Mechanical" <?= old('ruang_lingkup_kerjasama') == 'Mechanical'   ? 'selected' : '' ?>>Mechanical</option>
                                    <option value="Civil" <?= old('ruang_lingkup_kerjasama') == 'Civil'        ? 'selected' : '' ?>>Civil</option>
                                    <option value="Painting" <?= old('ruang_lingkup_kerjasama') == 'Painting'     ? 'selected' : '' ?>>Painting</option>
                                    <option value="Scafolding" <?= old('ruang_lingkup_kerjasama') == 'Scafolding'   ? 'selected' : '' ?>>Scafolding</option>
                                    <option value="Insulation" <?= old('ruang_lingkup_kerjasama') == 'Insulation'   ? 'selected' : '' ?>>Insulation</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors['ruang_lingkup_kerjasama']) ? $errors['ruang_lingkup_kerjasama'] : 'Silakan pilih jenis kerjasama.' ?>
                                </div>
                            </div>
                        </div>

                        <!-- Proposal -->
                        <div class="col-md-12">
                            <label for="dokumen_pendukung" class="form-label fl_proposal">Dokumen Pendukung</label>
                            <input type="file"
                                class="form-control fc_native <?= isset($errors['dokumen_pendukung']) ? 'is-invalid' : '' ?>"
                                name="dokumen_pendukung" id="dokumen_pendukung" accept=".pdf" required>
                            <div class="invalid-feedback">
                                <?= isset($errors['dokumen_pendukung']) ? $errors['dokumen_pendukung'] : 'Dokumen Pendukung wajib diunggah (PDF).' ?>
                            </div>
                            <div class="upload-note mt-1">Format: PDF • Maksimal <strong>1MB</strong>.</div>
                        </div>
                    </div>

                    <div class="mt-3 d-grid gap-2">
                        <button class="btn btn-warning btn-sm text-white rounded-pill py-2" type="submit">
                            <i class="fa-solid fa-file-arrow-up me-1"></i> Up Kerjasama
                        </button>
                        <button type="reset" class="btn btn-outline-secondary btn-sm rounded-pill py-2">
                            <i class="fa-solid fa-rotate-left me-1"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const form = document.querySelector('form[action*="admin/pages/cooperation/tambah"]');
        if (!form) return;

        const overlay = document.getElementById('submitOverlay');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(e) {
            // kalau invalid → jangan submit, tampilkan feedback
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            // kunci tombol saja (jangan disable input agar nilai & CSRF terkirim)
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.dataset.originalHtml = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mengunggah...';
            }

            // tampilkan overlay
            if (overlay) {
                overlay.style.display = 'flex';
                overlay.setAttribute('aria-hidden', 'false');
            }
        });

        // bila user kembali via BFCache, pulihkan tombol & overlay
        window.addEventListener('pageshow', function() {
            if (overlay) {
                overlay.style.display = 'none';
                overlay.setAttribute('aria-hidden', 'true');
            }
            if (submitBtn) {
                submitBtn.disabled = false;
                if (submitBtn.dataset.originalHtml) submitBtn.innerHTML = submitBtn.dataset.originalHtml;
            }
        });
    })();
</script>

<?= $this->endSection() ?>