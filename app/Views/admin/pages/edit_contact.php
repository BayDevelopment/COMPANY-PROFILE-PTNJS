<?= $this->extend('layouts/t_dashboard_admin') ?>

<?= $this->section('admin_dashboard') ?>
<div class="container">
    <h1 class="mt-4">Layout</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><?= esc($sub_judul) ?></li>
    </ol>
    <div class="cover_btn_insert">
        <a class="btn_a_admin" href="<?= base_url('admin/pages/contact') ?>" role="button"><span><i class="fa-solid fa-angle-left"></i></span> Kembali</a>
    </div>
    <form action="<?= site_url('admin/pages/contact/edit/') . esc($d_contact['id_contact']) ?>" method="POST">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control fc_native" id="name" name="name" value="<?= esc($d_contact['name']) ?>" required>
            <span class="text-danger"><?= esc(session('errors')['name'] ?? '') ?></span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?= esc($d_contact['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control fc_native" id="message" name="message" rows="3"><?= esc($d_contact['message']) ?></textarea>
            <span class="text-danger"><?= esc(session('errors')['message'] ?? '') ?></span>
        </div>
        <button type="submit" class="btn_a_native mb-3"><span><i class="fa-solid fa-file-pen"></i></span> Edit</button>

    </form>
</div>
<?= $this->endSection() ?>