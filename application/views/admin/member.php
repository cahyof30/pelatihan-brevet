<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No. ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Verifikasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($user_peserta as $peserta) : { ?>
                            <?php if ($peserta['verified'] == 1) { ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $peserta['name']; ?></td>
                                    <td><?= $peserta['email']; ?></td>
                                    <td><?php if ($peserta['verified'] == 1) { ?>
                                            <h4> <span class="badge badge-success" disabled><i class="fa fa-check"></i>&nbsp;Verified</h4>
                                        <?php } else { ?>
                                            <button class="btn btn-secondary disabled" disabled><i class="fa fa-ban"></i>&nbsp;Not Verified</button>
                                        <?php } ?>
                                    </td>
                                    <td class="vertical-btn">
                                        <a href="<?= base_url('admin/editUser/') . $peserta['id']; ?>" class="btn btn-primary btn-item"><i class="fa fa-edit"></i>Edit</a>
                                        <a href="<?= base_url('admin/unverifyUser/') . $peserta['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus status verifikasi?')" class="btn btn-warning btn-item"><i class="fa fa-undo"></i>Kembali</a>
                                        <a href="<?= base_url('admin/deleteMember/') . $peserta['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus ?')" class="btn btn-danger btn-item"><i class="fa fa-trash"></i>Hapus</a>
                                    </td>

                                </tr>
                        <?php } else {
                            }
                        } ?>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .vertical-btn {
        display: flex;
        flex-direction: column;
    }

    .btn-item {
        margin: 2px;
        width: 110px;
        height: 35px;
    }
</style>