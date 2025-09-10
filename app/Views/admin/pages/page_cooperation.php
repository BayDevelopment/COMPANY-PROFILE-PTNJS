<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<style>
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: rgba(0, 0, 0, 0.05) 0px 4px 14px;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: rgba(0, 0, 0, 0.08) 0px 6px 18px;
    }

    .btn-group .btn {
        border-radius: 10px !important;
        margin: 0 3px;
    }

    .cover_img_empty {
        text-align: center;
        margin: 40px 0;
    }

    .caption_img_empty {
        font-size: 1rem;
        color: #6c757d;
        margin-top: 12px;
    }

    .table thead th {
        background: linear-gradient(135deg, #ffe082, #ffca28);
        color: #444;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-hover tbody tr:hover {
        background-color: #fffde7;
    }

    .filter-label {
        font-weight: 600;
        color: #444;
        font-size: 0.9rem;
    }

    .btn-filter {
        border-radius: 10px;
        font-weight: 600;
    }
</style>

<div class="container-fluid px-4">
    <!-- Heading -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold text-warning">Laporan Kerjasama</h1>
            <p class="text-muted mb-0">Daftar pengajuan & kerjasama yang terdata</p>
        </div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><i class="fa fa-home"></i> Dashboard</li>
            <li class="breadcrumb-item active"><?= esc($sub_judul) ?></li>
        </ol>
    </div>

    <!-- Action Buttons -->
    <div class="mb-3">
        <a class="btn btn-success me-2 shadow-sm" href="<?= base_url('admin/pages/cooperation/tambah') ?>">
            <i class="fa-solid fa-circle-plus"></i> Tambah
        </a>
        <a class="btn btn-outline-secondary shadow-sm" href="<?= base_url('admin/pages/cooperation') ?>">
            <i class="fa-solid fa-arrows-rotate"></i> Reload
        </a>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="get" action="">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label filter-label"><i class="fa-solid fa-calendar-days"></i> Bulan</label>
                        <select name="bulan" class="form-control shadow-sm">
                            <option value="">-- Semua Bulan --</option>
                            <?php
                            $bulanList = [
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember'
                            ];
                            foreach ($bulanList as $key => $val): ?>
                                <option value="<?= $key ?>" <?= ($bulan == $key) ? 'selected' : '' ?>><?= $val ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label filter-label"><i class="fa-solid fa-calendar"></i> Tahun</label>
                        <select name="tahun" class="form-control shadow-sm">
                            <option value="">-- Semua Tahun --</option>
                            <?php for ($y = 2019; $y <= date('Y') + 1; $y++): ?>
                                <option value="<?= $y ?>" <?= ($tahun == $y) ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label filter-label"><i class="fa-solid fa-check-circle"></i> Status</label>
                        <select name="status" class="form-control shadow-sm">
                            <option value="">-- Semua Status --</option>
                            <option value="Menunggu persetujuan" <?= ($status == "Menunggu persetujuan") ? 'selected' : '' ?>>Menunggu persetujuan</option>
                            <option value="Diproses" <?= ($status == "Diproses") ? 'selected' : '' ?>>Diproses</option>
                            <option value="Diterima" <?= ($status == "Diterima") ? 'selected' : '' ?>>Diterima</option>
                            <option value="Dibatalkan" <?= ($status == "Dibatalkan") ? 'selected' : '' ?>>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-warning w-100 btn-filter shadow-sm">
                            <i class="fas fa-filter"></i> Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-body">
            <?php if (empty($d_cooperation)): ?>
                <div class="cover_img_empty">
                    <img src="/assets/img/empty_data.png" alt="PT. Najwa Jaya Sukses" class="size_img_empty">
                    <h6 class="caption_img_empty">Maaf, Tidak ada data saat ini!</h6>
                </div>
            <?php else: ?>

                <style>
                    /* Kartu pembungkus */
                    .table-card {
                        border: 1px solid #e9ecef;
                        border-radius: 14px;
                        box-shadow: 0 10px 24px rgba(16, 24, 40, .06);
                        overflow: hidden;
                    }

                    /* Tabel modern */
                    .table-modern th,
                    .table-modern td {
                        vertical-align: middle;
                    }

                    .table-modern tbody tr:hover {
                        background: rgba(0, 0, 0, .02);
                    }

                    /* Header sticky + gradient warning muda → putih */
                    .table-sticky thead th {
                        position: sticky;
                        top: 0;
                        z-index: 5;
                        background: linear-gradient(180deg, rgba(255, 193, 7, .18) 0%, #ffffff 100%);
                        border-bottom: 1px solid #f1f3f5;
                        color: #212529;
                        text-transform: uppercase;
                        letter-spacing: .3px;
                        font-weight: 700;
                        font-size: .8rem;
                    }

                    /* Rounded sudut atas */
                    .table-sticky thead th:first-child {
                        border-top-left-radius: 14px;
                    }

                    .table-sticky thead th:last-child {
                        border-top-right-radius: 14px;
                    }

                    /* Ellipsis untuk teks panjang */
                    .td-ellipsis {
                        max-width: 240px;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }

                    /* Kolom aksi biar nggak patah */
                    .td-actions {
                        white-space: nowrap;
                    }

                    /* Scroll X selalu mulus */
                    .table-responsive {
                        overflow-x: auto;
                    }
                </style>
                <div class="table-responsive table-card p-4">
                    <?php
                    $showAlasan = false;
                    if (!empty($d_cooperation)) {
                        foreach ($d_cooperation as $row) {
                            if (($row['status_pengajuan'] ?? '') === 'Dibatalkan') {
                                $showAlasan = true;
                                break;
                            }
                        }
                    }
                    ?>
                    <?php $showAlasan = isset($showAlasan) ? (bool)$showAlasan : false; ?>
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table class="table table-hover table-modern align-middle table-sticky w-100" id="example">
                            <thead>
                                <tr>
                                    <th style="width:56px">No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Jabatan</th>
                                    <th>Alamat PT</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Kerjasama</th>
                                    <th>Status</th>
                                    <?php if ($showAlasan): ?>
                                        <th>Alasan</th>
                                    <?php endif; ?>
                                    <th>Tanggal Pengajuan</th>
                                    <th class="text-center" style="width:180px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($d_cooperation as $d_coo): ?>
                                    <?php
                                    $status = $d_coo['status_pengajuan'] ?? '';
                                    $badgeClass = match ($status) {
                                        'Menunggu persetujuan' => 'badge bg-secondary',
                                        'Diproses'             => 'badge bg-warning text-dark',
                                        'Diterima'             => 'badge bg-success',
                                        'Dibatalkan'           => 'badge bg-danger',
                                        default                => 'badge bg-dark text-white',
                                    };
                                    // Alasan hanya terisi jika kolom ditampilkan & status = Dibatalkan, selain itu '-'
                                    $alasanCell = ($showAlasan && $status === 'Dibatalkan') ? ($d_coo['alasan'] ?? '') : '-';
                                    $tgl = formatTanggalLengkapIndonesia($d_coo['tanggal_pengajuan']);
                                    ?>
                                    <tr>
                                        <td><?= esc($no++) ?>.</td>
                                        <td class="fw-semibold td-ellipsis" title="<?= esc($d_coo['nama_perusahaan']) ?>"><?= esc($d_coo['nama_perusahaan']) ?></td>
                                        <td class="td-ellipsis" title="<?= esc($d_coo['penanggung_jawab']) ?>"><?= esc($d_coo['penanggung_jawab']) ?></td>
                                        <td class="td-ellipsis" title="<?= esc($d_coo['jabatan']) ?>"><?= esc($d_coo['jabatan']) ?></td>
                                        <td class="td-ellipsis" title="<?= esc($d_coo['alamat_perusahaan']) ?>"><?= esc($d_coo['alamat_perusahaan']) ?></td>
                                        <td class="td-ellipsis" title="<?= esc($d_coo['telepon']) ?>"><?= esc($d_coo['telepon']) ?></td>
                                        <td class="td-ellipsis" title="<?= esc($d_coo['email']) ?>"><?= esc($d_coo['email']) ?></td>
                                        <td class="td-ellipsis" title="<?= esc($d_coo['ruang_lingkup_kerjasama']) ?>"><?= esc($d_coo['ruang_lingkup_kerjasama']) ?></td>
                                        <td><span class="<?= $badgeClass ?>"><?= esc($status) ?></span></td>

                                        <?php if ($showAlasan): ?>
                                            <?php $alasanDisplay = trim((string)$alasanCell) !== '' ? $alasanCell : '-'; ?>
                                            <td class="td-ellipsis" title="<?= esc($alasanDisplay) ?>"><?= esc($alasanDisplay) ?></td>
                                        <?php endif; ?>

                                        <td class="td-ellipsis" title="<?= esc($tgl) ?>"><?= esc($tgl) ?></td>
                                        <td class="text-center td-actions">
                                            <div class="btn-group" role="group" aria-label="Aksi">
                                                <a href="<?= base_url('admin/pages/cooperation/edit/') . esc($d_coo['id_pengajuan']) ?>" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i><span class="d-none d-md-inline">Edit</span>
                                                </a>
                                                <a href="<?= base_url('admin/pages/cooperation/detail/') . esc($d_coo['id_pengajuan']) ?>" class="btn btn-sm btn-outline-info d-inline-flex align-items-center gap-1" title="Detail">
                                                    <i class="fa-solid fa-eye"></i><span class="d-none d-md-inline">Detail</span>
                                                </a>
                                                <a href="#" onclick="confirmDeleteCooperation(<?= (int)$d_coo['id_pengajuan'] ?>)" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i><span class="d-none d-md-inline">Hapus</span>
                                                </a>
                                                <a href="<?= base_url('admin/pages/cooperation/pdf/') . esc($d_coo['id_pengajuan']) ?>" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1" target="_blank" title="Download PDF">
                                                    <i class="fa-solid fa-file-pdf"></i><span class="d-none d-md-inline">PDF</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function confirmDeleteCooperation(id) {
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
                window.location.href = "<?= base_url('admin/pages/cooperation/hapus/') ?>" + id;
            }
        });
    }
</script>
<?= $this->endSection() ?>