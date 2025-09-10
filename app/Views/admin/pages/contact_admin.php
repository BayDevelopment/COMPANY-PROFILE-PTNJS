<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<div class="container py-4 fade-in">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold text-warning">
                <?= esc($sub_judul) ?>
            </h2>
            <p class="text-muted mb-0">Kelola pesan masuk dengan cepat dan mudah</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="<?= base_url('admin') ?>" class="text-decoration-none text-secondary">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active text-dark"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <!-- Top Actions -->
    <div class="d-flex flex-wrap gap-2 mb-3">

        <div class="mb-3">
            <a class="btn btn-gradient rounded-pill px-3" href="<?= base_url('admin/pages/contact') ?>">
                <i class="fa-solid fa-rotate me-1"></i> Reload
            </a>
        </div>
    </div>

    <?php if ($count_contact < 1): ?>
        <!-- Empty State -->
        <div class="text-center my-5">
            <img src="<?= base_url('/assets/img/img_empty.svg') ?>" alt="PT. Najwa Jaya Sukses"
                class="img-fluid mb-3" style="max-width:280px;">
            <p class="fw-semibold text-muted">Maaf, tidak ada data saat ini!</p>
        </div>
    <?php else: ?>
        <!-- Card Table -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0" id="contactTable">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th style="width:64px;">No</th>
                                <th style="min-width:180px;">Name</th>
                                <th style="min-width:220px;">Email Address</th>
                                <th style="min-width:320px;">Message</th>
                                <th style="width:120px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($d_contact as $d_c): ?>
                                <tr>
                                    <td class="fw-semibold"><?= esc($no++) ?>.</td>
                                    <td><?= esc($d_c['name']) ?></td>
                                    <td>
                                        <a href="mailto:<?= esc($d_c['email']) ?>" class="text-decoration-none">
                                            <i class="fa fa-envelope me-1"></i><?= esc($d_c['email']) ?>
                                        </a>
                                    </td>
                                    <td class="text-truncate" style="max-width:560px;"
                                        title="<?= esc($d_c['message']) ?>">
                                        <?= esc($d_c['message']) ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a class="btn btn-outline-secondary"
                                                href="<?= base_url('admin/pages/contact/detail/') . esc($d_c['id_contact']) ?>"
                                                title="Detail" data-bs-toggle="tooltip">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger"
                                                title="Hapus" data-bs-toggle="tooltip"
                                                onclick="confirmDeleteContact(<?= esc($d_c['id_contact']) ?>)">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="5" class="small text-muted px-3">
                                    <span id="result-count"><?= count($d_contact) ?></span> data ditampilkan
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<!-- Styles -->
<style>
    /* Animasi */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .fade-in {
        animation: fadeIn .8s ease-in-out;
    }

    /* Brand focus */
    :root {
        --brand-gold: #d4ba34ff;
        --brand-gold-glow: rgba(212, 186, 52, .25);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-gold) !important;
        box-shadow: 0 0 0 .2rem var(--brand-gold-glow) !important;
        outline: 0;
    }

    .form-floating:focus-within label {
        color: var(--brand-gold);
    }

    /* Button gradient */
    .btn-gradient {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        border: none;
        color: #fff;
        font-weight: 600;
        transition: .3s;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, #d4ba34ff, #f3e69dff);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        color: #fff;
    }

    /* Table polish */
    .table thead th {
        position: sticky;
        top: 0;
        z-index: 1;
    }

    .table tbody tr:hover {
        background: rgba(212, 186, 52, .06);
    }
</style>

<!-- Scripts -->
<script>
    // SweetAlert delete
    function confirmDeleteContact(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/pages/contact/hapus/') ?>" + id;
            }
        });
    }
    // Sweet alerts (flashdata)
    <?php if (session()->getFlashdata('sweet_error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= esc(session()->getFlashdata('sweet_error')) ?>'
        });
    <?php endif; ?>
    <?php if (session()->getFlashdata('sweet_success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= esc(session()->getFlashdata('sweet_success')) ?>'
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>