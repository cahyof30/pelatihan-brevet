<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Jumlah Peserta-->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Total Pendaftar</div>
                            <div class="h1 mb-0 font-weight-bold text-white"><?= $user_count ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('admin/member'); ?>"><i class="fas fa-users fa-3x text-warning"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu verifikasi-->

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Menunggu Verifikasi</div>
                            <div class="h1 mb-0 font-weight-bold text-white"><?= $user_wait ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('admin'); ?>"><i class="fas fa-users fa-3x text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sudah Verifikasi-->

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Sudah Terverifikasi</div>
                            <div class="h1 mb-0 font-weight-bold text-white"><?= $user_verified ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('admin/member'); ?>"><i class="fas fa-users fa-3x text-warning"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Instruktur-->

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-secondary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Instruktur</div>
                            <div class="h1 mb-0 font-weight-bold text-white"><?= $instructor ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('admin/instructor'); ?>"><i class="fas fa-user-graduate fa-3x text-warning"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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
                        <th scope="col">No.</th>
                        <th scope="col">ID Peserta</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Bukti Pembayaran</th>
                        <th scope="col">Verifikasi</th>
                        <!-- <th scope="col">Role</th> -->
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($user_peserta as $peserta) : { ?>
                            <?php if ($peserta['verified'] == 0) { ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $peserta['id']; ?></td>
                                    <td><?= $peserta['name']; ?></td>
                                    <td><?= $peserta['email']; ?></td>
                                    <td>
                                        <img src="<?= base_url(); ?>assets/images/bukti_bayar/<?= $peserta['buktibayar']; ?>" width='110' height='90'>
                                    </td>
                                    <td>
                                        <?php if ($peserta['verified'] == 1) { ?>
                                            <a href="#" class="alert alert-success"><i class="fa fa-check"></i>Verified</a>
                                        <?php } else { ?>
                                            <h4><span class="badge badge-secondary" disabled><i class="fa fa-ban"></i>&nbsp; Not Verified</h4>
                                        <?php } ?>
                                    </td>
                                    <td class="vertical-btn">
                                        <?php if (empty($peserta['buktibayar']) || $peserta['buktibayar'] == 'nodata.png') {  ?>
                                            <a href="#" class="btn btn-secondary btn-item disabled" disabled><i class="fa fa-ban "></i> Lihat</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url(); ?>assets/images/bukti_bayar/<?= $peserta['buktibayar']; ?>" target="_blank" class="btn btn-primary btn-item"><i class="fa fa-search "></i>&nbsp;Lihat</a>
                                        <?php } ?>
                                        <!-- <a href="<?= base_url('admin/open_bb/') ?>" target="_blank" class="btn btn-primary">Lihat</a> -->
                                        <a href="<?= base_url('admin/verifyUser/') . $peserta['id']; ?>" onclick="return confirm('Kamu yakin akan mengesahkan ?')" class="btn btn-success btn-item"><i class="fa fa-check"></i>&nbsp;Verifikasi</a>
                                        <a href="<?= base_url('admin/deleteUser/') . $peserta['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus ?')" class="btn btn-danger btn-item"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
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
        margin: 5px;
    }

    .btn-item {
        margin: 2px;
        width: 110px;
        height: 35px;
    }
</style>