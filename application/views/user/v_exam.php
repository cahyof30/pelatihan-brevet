<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($user['verified'] == 1) { ?>
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
                        <th scope="col">Jenis</th>
                        <th scope="col">Tipe Ujian</th>
                        <th scope="col">Batas Waktu</th>
                        <th scope="col">Unduh Soal</th>
                        <th scope="col">Unggah Jawaban</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($exam as $ex) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $ex['course'] ?></td>
                            <td><?= $ex['exam_name'] ?></td>
                            <td><?= $ex['deadline'] ?></td>
                            <td><a href="<?= base_url(); ?>exam/task/<?= $ex['exam_file']; ?>" class="btn btn-primary"><i class="fa fa-download"></i>Unduh</a></td>
                            <td>
                                <?php $current_time = time(); ?>
                                <?php if ($current_time > strtotime($ex['deadline'])) { ?>
                                    <button class="btn btn-secondary" disabled><i class="fa fa-ban"></i>&nbsp; Waktu Habis</h4>
                                    <?php } else { ?>
                                        <?php if ($ex['exam_tp'] == 1) { ?>
                                            <a href="<?= base_url('user/uploadMidExam'); ?>" class="btn btn-warning"><i class="fa fa-upload"></i>Unggah</a>

                                        <?php } elseif ($ex['exam_tp'] == 2) { ?>
                                            <a href="<?= base_url('user/uploadFinalExam') ?>" class="btn btn-warning"><i class="fa fa-upload"></i>Unggah</a>
                            </td>
                        <?php } else { ?>
                            <a href="<?= base_url('user/uploadRemedialExam') ?>" class="btn btn-warning"><i class="fa fa-upload"></i>Unggah</a>
                    <?php } ?>
                    <?php } ?>



                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php } else { ?>
        <div class="alert alert-danger">
        <h4 class="text-center mt-2"><i class="fa fa-info-circle"></i> Akun Anda Belum Terverifikasi, Silakan hubungi Administrator.</h4>
        </div>
        <?php } ?>
</div>