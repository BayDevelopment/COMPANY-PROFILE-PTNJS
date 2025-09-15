<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<style>
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
<div class="container-fluid px-4">
    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold text-warning">Dashboard</h1>
            <p class="text-muted mb-0">Selamat datang di panel admin</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><i class="fa fa-home"></i> Home</li>
            <li class="breadcrumb-item active"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <!-- Card Section -->
    <div class="row g-4">
        <div class="col-xl-4 col-md-6">
            <a href="<?= base_url('admin/pages/cooperation') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-semibold text-dark">Cooperation</h5>
                            <span class="badge bg-warning fs-6"><?= esc(count($d_cooperation)) ?></span>
                            <p class="text-muted small mb-0">Lihat detail kerjasama</p>
                        </div>
                        <div class="icon-circle bg-gradient-warning text-white shadow-sm">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Tambahkan card lain di sini jika perlu -->
    </div>

    <!-- Chart Section -->
    <div class="row mt-5">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm rounded-4 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-secondary">📊 Tren Kerja Sama per Tahun</h5>
                    <div style="width:100%; height:380px;">
                        <canvas id="cooperationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm rounded-4 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-secondary">📈 Distribusi Service's</h5>
                    <div style="width:100%; height:380px;">
                        <canvas id="servicesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <div class="container py-4">
                <!-- HEADER CARD + TOMBOL -->
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card shadow-sm rounded-4 h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title fw-bold text-secondary mb-0">📇 Direktur</h5>
                                    <span class="text-muted small">Kelola nomor HP yang dipublikasikan</span>
                                </div>
                                <!-- TOMBOL MODAL TAMBAH -->
                                <button class="btn btn-warning text-white rounded-pill"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDirekturAdd">
                                    <i class="fa-solid fa-user-plus me-1"></i> Tambah Direktur
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FLASH ALERTS -->
                <?php foreach (['sweet_success' => 'success', 'sweet_error' => 'danger', 'sweet_warning' => 'warning'] as $k => $cls): ?>
                    <?php if (session()->getFlashdata($k)): ?>
                        <div class="alert alert-<?= $cls ?>">
                            <span><i class="fa-solid fa-bell"></i></span>
                            <?= esc(session()->getFlashdata($k)) ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <!-- GRID KARTU DIREKTUR -->
                <div class="row g-3">
                    <?php if (!empty($list_direktur)): ?>
                        <?php
                        $formErrorsEdit = session()->getFlashdata('form_errors_edit') ?? [];
                        $openEditId     = (int)(session()->getFlashdata('open_modal_edit_id') ?? 0);
                        ?>
                        <?php foreach ($list_direktur as $row): ?>
                            <?php
                            $id    = (int)($row['id_direktur'] ?? 0);
                            $isOn  = (int)($row['verified_handphone'] ?? 0) === 1;

                            // Build link WA (opsional)
                            $digits = preg_replace('/\D+/', '', $row['no_hp'] ?? '');
                            if ($digits !== '') {
                                if (strpos($digits, '62') !== 0) {
                                    if (isset($digits[0]) && $digits[0] === '0') {
                                        $digits = '62' . substr($digits, 1);
                                    } elseif (isset($digits[0]) && $digits[0] === '8') {
                                        $digits = '62' . $digits;
                                    }
                                }
                            }
                            $waLink = $digits ? "https://wa.me/{$digits}" : null;

                            // Untuk modal edit auto-open bila validasi gagal
                            $shouldOpen = ($openEditId === $id);
                            ?>
                            <div class="col-xl-4 col-lg-6">
                                <div class="card shadow-sm rounded-4 h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h5 class="fw-bold mb-0"><?= esc($row['nama']) ?></h5>
                                            <span class="badge <?= $isOn ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= $isOn ? 'Publik' : 'Privat' ?>
                                            </span>
                                        </div>
                                        <div class="text-muted small mb-3">
                                            <?= esc($row['jabatan'] ?? '-') ?>
                                        </div>

                                        <ul class="list-unstyled mb-3">
                                            <li class="mb-1">
                                                <i class="fa-solid fa-envelope me-2"></i>
                                                <span class="text-muted"><?= esc($row['email'] ?? '-') ?></span>
                                            </li>
                                            <li>
                                                <i class="fa-solid fa-phone me-2"></i>
                                                <span class="text-muted"><?= esc($row['no_hp']) ?></span>
                                            </li>
                                        </ul>

                                        <div class="d-flex flex-wrap gap-2">
                                            <!-- Toggle publik/privat -->
                                            <form action="<?= route_to('admin_direktur_toggle', $id) ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <?php if ($isOn): ?>
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="fa-solid fa-eye-slash me-1"></i> Hapus dari Publik
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline-success">
                                                        <i class="fa-solid fa-eye me-1"></i> Jadikan Publik
                                                    </button>
                                                <?php endif; ?>
                                            </form>

                                            <?php if ($isOn && $waLink): ?>
                                                <a target="_blank" href="<?= esc($waLink) ?>" class="btn btn-sm btn-success">
                                                    <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
                                                </a>
                                            <?php endif; ?>

                                            <!-- EDIT (modal) -->
                                            <button class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDirekturEdit_<?= $id ?>">
                                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                            </button>

                                            <!-- HAPUS (tanpa modal) -->
                                            <form action="<?= route_to('admin_direktur_delete', (int)$row['id_direktur']) ?>"
                                                method="post"
                                                class="d-inline js-delete-direktur"
                                                data-nama="<?= esc($row['nama']) ?>">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-outline-dark">
                                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </div>

                                    <div class="card-footer bg-transparent d-flex justify-content-between small text-muted">
                                        <span>Ditambahkan: <?= esc(!empty($row['created_at']) ? date('d M Y', strtotime($row['created_at'])) : '-') ?></span>
                                        <span>Diubah: <?= esc(!empty($row['updated_at']) ? date('d M Y', strtotime($row['updated_at'])) : '-') ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL: EDIT DIREKTUR (per item) -->
                            <div class="modal fade" id="modalDirekturEdit_<?= $id ?>" tabindex="-1" aria-labelledby="labelEdit_<?= $id ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content rounded-4 shadow">
                                        <form action="<?= route_to('admin_direktur_update', $id) ?>" method="post" novalidate>
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="PUT">

                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="labelEdit_<?= $id ?>">Edit Direktur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                                                        <input type="text" name="nama"
                                                            class="form-control <?= ($openEditId === $id && isset($formErrorsEdit['nama'])) ? 'is-invalid' : '' ?>"
                                                            value="<?= esc(($openEditId === $id) ? (old('nama') ?? $row['nama']) : $row['nama']) ?>"
                                                            placeholder="Nama lengkap direktur" required>
                                                        <div class="invalid-feedback">
                                                            <?= ($openEditId === $id && isset($formErrorsEdit['nama'])) ? $formErrorsEdit['nama'] : 'Nama wajib diisi.' ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                                        <input type="text" name="jabatan"
                                                            class="form-control <?= ($openEditId === $id && isset($formErrorsEdit['jabatan'])) ? 'is-invalid' : '' ?>"
                                                            value="<?= esc(($openEditId === $id) ? (old('jabatan') ?? $row['jabatan']) : $row['jabatan']) ?>"
                                                            placeholder="Jabatan">
                                                        <div class="invalid-feedback">
                                                            <?= ($openEditId === $id && isset($formErrorsEdit['jabatan'])) ? $formErrorsEdit['jabatan'] : '' ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                                        <input type="email" name="email"
                                                            class="form-control <?= ($openEditId === $id && isset($formErrorsEdit['email'])) ? 'is-invalid' : '' ?>"
                                                            value="<?= esc(($openEditId === $id) ? (old('email') ?? $row['email']) : $row['email']) ?>"
                                                            placeholder="email@contoh.com">
                                                        <div class="invalid-feedback">
                                                            <?= ($openEditId === $id && isset($formErrorsEdit['email'])) ? $formErrorsEdit['email'] : 'Email tidak valid.' ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                                        <input type="text" name="no_hp"
                                                            class="form-control <?= ($openEditId === $id && isset($formErrorsEdit['no_hp'])) ? 'is-invalid' : '' ?>"
                                                            value="<?= esc(($openEditId === $id) ? (old('no_hp') ?? $row['no_hp']) : $row['no_hp']) ?>"
                                                            placeholder="0812xxxxxxx" required>
                                                        <div class="invalid-feedback">
                                                            <?= ($openEditId === $id && isset($formErrorsEdit['no_hp'])) ? $formErrorsEdit['no_hp'] : 'No. HP wajib diisi.' ?>
                                                        </div>
                                                        <div class="form-text">Gunakan format Indonesia (contoh: 0812xxxxxxx).</div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-check form-switch">
                                                            <?php
                                                            $checked = ($openEditId === $id)
                                                                ? (old('verified_handphone') ? true : false)
                                                                : ((int)$row['verified_handphone'] === 1);
                                                            ?>
                                                            <input class="form-check-input <?= ($openEditId === $id && isset($formErrorsEdit['verified_handphone'])) ? 'is-invalid' : '' ?>"
                                                                type="checkbox" role="switch"
                                                                id="switchPublishEdit_<?= $id ?>"
                                                                name="verified_handphone" value="1"
                                                                <?= $checked ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="switchPublishEdit_<?= $id ?>">
                                                                Publikasikan nomor ini (maks. 1 direktur aktif)
                                                            </label>
                                                            <?php if ($openEditId === $id && isset($formErrorsEdit['verified_handphone'])): ?>
                                                                <div class="invalid-feedback d-block"><?= $formErrorsEdit['verified_handphone'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-shiny rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-shiny rounded-pill px-4">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="card shadow-sm rounded-4">
                                <div class="card-body text-center text-muted">
                                    Belum ada data direktur.
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- MODAL: TAMBAH DIREKTUR -->
                <?php
                $formErrorsAdd = session()->getFlashdata('form_errors') ?? [];
                $openAdd       = session()->getFlashdata('open_modal') === 'add';
                $oldAdd        = fn($k, $d = '') => (old($k) ?? $d);
                ?>
                <div class="modal fade" id="modalDirekturAdd" tabindex="-1" aria-labelledby="modalDirekturAddLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content rounded-4 shadow">
                            <form action="<?= route_to('admin_direktur_store') ?>" method="post" novalidate>
                                <?= csrf_field() ?>

                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="modalDirekturAddLabel">Tambah Direktur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" name="nama"
                                                class="form-control <?= isset($formErrorsAdd['nama']) ? 'is-invalid' : '' ?>"
                                                value="<?= esc($oldAdd('nama')) ?>" placeholder="Nama lengkap direktur" required>
                                            <div class="invalid-feedback"><?= $formErrorsAdd['nama'] ?? 'Nama wajib diisi.' ?></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                                            <input type="text" name="jabatan"
                                                class="form-control <?= isset($formErrorsAdd['jabatan']) ? 'is-invalid' : '' ?>"
                                                value="<?= esc($oldAdd('jabatan')) ?>" placeholder="Jabatan">
                                            <div class="invalid-feedback"><?= $formErrorsAdd['jabatan'] ?? '' ?></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                class="form-control <?= isset($formErrorsAdd['email']) ? 'is-invalid' : '' ?>"
                                                value="<?= esc($oldAdd('email')) ?>" placeholder="email@contoh.com">
                                            <div class="invalid-feedback"><?= $formErrorsAdd['email'] ?? 'Email tidak valid.' ?></div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                            <input type="text" name="no_hp"
                                                class="form-control <?= isset($formErrorsAdd['no_hp']) ? 'is-invalid' : '' ?>"
                                                value="<?= esc($oldAdd('no_hp')) ?>" placeholder="0812xxxxxxx" required>
                                            <div class="invalid-feedback"><?= $formErrorsAdd['no_hp'] ?? 'No. HP wajib diisi.' ?></div>
                                            <div class="form-text">Gunakan format Indonesia (contoh: 0812xxxxxxx).</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input <?= isset($formErrorsAdd['verified_handphone']) ? 'is-invalid' : '' ?>"
                                                    type="checkbox" role="switch" id="switchPublishAdd"
                                                    name="verified_handphone" value="1"
                                                    <?= old('verified_handphone') ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="switchPublishAdd">
                                                    Publikasikan nomor ini (maks. 1 direktur aktif)
                                                </label>
                                                <div class="invalid-feedback d-block"><?= $formErrorsAdd['verified_handphone'] ?? '' ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-shiny rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-shiny rounded-pill px-4">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Extra CSS for Hover & Icon -->
<style>
    .hover-card:hover {
        transform: translateY(-4px);
        transition: 0.3s;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #e9c732ff, #e9c732ff);
    }
</style>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line/Bar Chart
    const ctxLine = document.getElementById('cooperationChart').getContext('2d');
    new Chart(ctxLine, {
        type: 'bar',
        data: {
            labels: <?= $chart_labels ?>,
            datasets: <?= $chart_data ?>
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Doughnut Chart
    const ctx2 = document.getElementById('servicesChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: <?= $services_labels ?>,
            datasets: [{
                data: <?= $services_data ?>,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                ],
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: false
                }
            }
        }
    });

    // Jika server mengirim flag open_modal=add (karena validasi gagal), buka modal otomatis
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->getFlashdata('open_modal') === 'add'): ?>
            var m = new bootstrap.Modal(document.getElementById('modalDirektur'));
            m.show();
        <?php endif; ?>
    });

    // modal edit dan add
    document.addEventListener('DOMContentLoaded', function() {
        // Buka modal Tambah jika ada error tambah
        var openAdd = <?= $openAdd ? 'true' : 'false' ?>;
        if (openAdd && typeof bootstrap !== 'undefined') {
            var addEl = document.getElementById('modalDirekturAdd');
            if (addEl) new bootstrap.Modal(addEl).show();
        }
    });

    (function() {
        function ensureSwal(cb) {
            if (window.Swal) return cb();
            const s = document.createElement('script');
            s.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            s.onload = cb;
            document.head.appendChild(s);
        }

        ensureSwal(function() {
            document.addEventListener('submit', function(e) {
                const form = e.target.closest('.js-delete-direktur');
                if (!form) return;

                e.preventDefault();
                const nama = form.getAttribute('data-nama') || 'direktur ini';

                Swal.fire({
                    title: 'Hapus Direktur?',
                    html: 'Anda akan menghapus <b>' + nama.replace(/</g, '&lt;') + '</b>.<br>Tindakan ini tidak dapat dibatalkan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true,
                    buttonsStyling: false,
                    customClass: {
                        actions: 'd-flex justify-content-center gap-3 px-3', // ← jarak antar tombol + padding kiri/kanan
                        confirmButton: 'btn btn-danger px-3', // ← padding horizontal tombol
                        cancelButton: 'btn btn-secondary px-3'
                    }
                }).then((res) => {
                    if (res.isConfirmed) form.submit();
                });
            }, true);
        });
    })();
</script>
<?= $this->endSection() ?>