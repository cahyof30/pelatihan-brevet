<div class="container-fluid">
    <?= $this->session->flashdata('success_message'); ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>
    <?= $this->session->flashdata('sinkron_sukses'); ?>
    <section class="content">
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#newScoreModal"><i class="fa fa-plus"></i> Input Nilai Ujian</button> -->
        <a href="<?= base_url('instructor/syncExamScore') ?>">
            <button class="btn btn-warning mb-1"><i class="fa fa-sync"></i> Sinkron Data</button></a>
        <a href="<?= base_url('instructor/exportExamExcel') ?>">
            <button class="btn btn-success mb-1"><i class="fa fa-file-excel"></i> Ekspor Excel</button></a>
        <a href="<?= base_url('instructor/exportExamWord') ?>">
            <button class="btn btn-primary mb-1"><i class="fa fa-file-excel"></i> Ekspor Word</button></a>
        <table class="table">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">KUP A</th>
                <th scope="col">PPh OP</th>
                <th scope="col">PPh 21</th>
                <th scope="col">PPh 22</th>
                <th scope="col">PPN</th>
                <th scope="col">PPh B</th>
                <th scope="col">PBB</th>
                <th scope="col">KUP B</th>
                <th scope="col">Akt Pajak</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
            <?php
            $no = 1;
            foreach ($score as $sc) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $sc['name'] ?></td>
                    <td><?= $sc['kup_a'] ?></td>
                    <td><?= $sc['pph_op'] ?></td>
                    <td><?= $sc['pph_21'] ?></td>
                    <td><?= $sc['pph_22'] ?></td>
                    <td><?= $sc['ppn'] ?></td>
                    <td><?= $sc['pph_b'] ?></td>
                    <td><?= $sc['pbb'] ?></td>
                    <td><?= $sc['kup_b'] ?></td>
                    <td><?= $sc['akt_pjk'] ?></td>
                    <td>
                        <?php if ($sc['kup_a'] < 50 || $sc['pph_op'] < 50 || $sc['pph_21'] < 50 || $sc['pph_22'] < 50 || $sc['ppn'] < 50 || $sc['pph_b'] < 50 || $sc['pbb'] < 50 || $sc['kup_b'] < 50 || $sc['akt_pjk'] < 50) { ?>
                            <h5> <span class="badge badge-danger" disabled><i class="fa fa-close"></i>Tidak Lulus</h5>
                        <?php } else { ?>
                            <h5> <span class="badge badge-success" disabled><i class="fa fa-check"></i> Lulus</h5>
                        <?php } ?>
                    </td>
                    <td class="vertical-btn">
                        <a href="<?= base_url('instructor/editExamScore/') . $sc['user_id']; ?>" class="btn btn-primary btn-item"><i class="fa fa-edit"></i> &nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                        <br>
                        <a href="<?= base_url('instructor/deleteExamScore/') . $sc['user_id']; ?>" onclick="return confirm('Kamu yakin akan menghapus nilai ini?')" class="btn btn-danger btn-item mt-1"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>

    <div class="alert alert-dark">
        <p>*Nilai kelulusan minimal adalah <strong>50</strong> pada masing-masing nilai ujian.</p>
    </div>



    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="#newScoreModal" tabindex="-1" role="dialog" aria-labelledby="#newScoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="#newScoreModal">Input Nilai</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('instructor/examScore'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="<?= $ex['course_id'] ?>">Brevet Pajak A & B</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="exam_tp" id="exam_tp" class="form-control form-control-user">
                                <?php
                                foreach ($exam as $ex) { ?>
                                    <option value="<?= $ex['exam_tp']; ?>"><?= $ex['exam_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" id="exam_file" name="exam_file" required>
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