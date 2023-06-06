<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>
    <?= $this->session->flashdata('sinkron_sukses'); ?>
    <section class="content">
        <a href="<?= base_url('admin/syncCert/') ?>">
            <button class="btn btn-warning"><i class="fa fa-sync"></i>Sinkron Data</button></a>
        <a href="<?= base_url('admin/shareCert/') ?>">
            <button class="btn btn-success"><i class="fa fa-paper-plane"></i>Bagikan Sertifikat</button></a>
        <table class="table"><br>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">No.Peserta</th>
                <th scope="col">Nama</th>
                <th scope="col">Sertifikat</th>
                <th scope="col">Aksi</th>
            </tr>
            <?php
            $no = 1;
            foreach ($certificate as $cert) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $cert['user_id'] ?></td>
                    <td><?= $cert['name'] ?></td>
                    <td><?= $cert['certificate'] ?></td>
                    <td class="vertical-btn">
                        <a href="<?= base_url('admin/uploadCert/' . $cert['user_id']) ?>" class="btn btn-success btn-sm btn-item"><i class="fa fa-upload"></i> Unggah</a>
                        <a href="<?= base_url('admin/deleteCert/' . $cert['user_id']) ?>" onclick="return confirm('Kamu yakin akan menghapus nilai ini?')" class="btn btn-danger btn-sm btn-item"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>