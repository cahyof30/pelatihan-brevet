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
            <a href="<?= base_url('admin/printAlumni');?>" target="_blank" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Cetak</a>
            <a href="<?= base_url('admin/exportPdfAlumni'); ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Unduh PDF</a>
            <a href="<?= base_url('admin/exportExcelAlumni'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Ekspor ke Excel</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID Peserta</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">No. Handphone</th>
                        <th scope="col">Pendidikan Terakhir</th>
                        <th scope="col">Domisili</th>
                        <th scope="col">Terdaftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($alumni as $alm) : { ?>
                            <?php if ($alm['verified'] == 1) { ?>
                                <tr> 
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $alm['id']; ?></td>
                                    <td><?= $alm['name']; ?></td>
                                    <td><?= $alm['email']; ?></td>
                                    <td><?= $alm['no_hp']; ?></td>
                                    <td><?= $alm['pendidikan']; ?></td>
                                    <td><?= $alm['domisili']; ?></td>
                                    <td><?= date('F Y', $alm['date_created']); ?></td>
                                    
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