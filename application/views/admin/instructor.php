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
                <button class="btn btn-primary" data-toggle="modal" data-target="#newInstructorModal"><i class="fa fa-plus"></i> Tambah Instruktur</button>
                <thead>
                    <tr>
                        <th scope="col">No. ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Verified</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($user_instruktur as $instruktur) : { ?>
                            <?php if ($instruktur['verified'] == 1) { ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $instruktur['name']; ?></td>
                                    <td><?= $instruktur['email']; ?></td>
                                    <td><?php if ($instruktur['verified'] == 1) { ?>
                                            <h4> <span class="badge badge-success"><i class="fa fa-check"></i>Verified</h4>
                                        <?php } else { ?>
                                            <h4> <span class="badge badge-secondary" disabled><i class="fa fa-ban"></i>&nbsp; Not Verified</h4>
                                        <?php } ?>
                                    </td>
                                    <td class="vertical-btn">
                                        <a href="<?= base_url('admin/editInstructor/') . $instruktur['id']; ?>" class="btn btn-primary btn-item"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?= base_url('admin/deleteInstructor/') . $instruktur['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus ?')" class="btn btn-danger btn-item"><i class="fa fa-trash"></i> Hapus</a>
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

<!-- Modal Tambah Instruktur -->
<div class="modal fade" id="newInstructorModal" tabindex="-1" role="dialog" aria-labelledby="newInstructorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="newInstructorModalLabel">Tambah Instruktur</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/instructor'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
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