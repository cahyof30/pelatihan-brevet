<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if (validation_errors()) { ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>
    <?= $this->session->flashdata('pesan'); ?>
    <section class="content">
        <button class="btn btn-primary" data-toggle="modal" data-target="#newExamModal"><i class="fa fa-plus"></i> Tambah Ujian</button>
        <table class="table">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Jenis</th>
                <th scope="col">Tipe Ujian</th>
                <th scope="col">Batas Waktu</th>
                <th scope="col">Berkas Soal</th>
                <th scope="col"></th>
            </tr>
            <?php
            $no = 1;
            foreach ($exam as $ex) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $ex['course'] ?></td>
                    <td><?= $ex['exam_name'] ?></td>
                    <td><?= $ex['deadline'] ?></td>
                    <td><?= $ex['exam_file'] ?></td>
                    <td>
                        <a href="<?= base_url('instructor/editExam/') . $ex['id']; ?>" class="btn btn-primary btn-item"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                        <a href="<?= base_url('instructor/deleteExam/') . $ex['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus ?')" class="btn btn-danger btn-item"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                </tr>
            <?php } ?>
        </table>
    </section>


    <!-- Modal Tambah Ujian -->
    <div class="modal fade" id="newExamModal" tabindex="-1" role="dialog" aria-labelledby="newExamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="newExamModalLabel">Tambah Ujian</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('instructor/exam'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="<?= $ex['course_id'] ?>">Brevet Pajak A & B</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="exam_tp" id="exam_tp" class="form-control form-control-user">
                            <option value="">Pilih Jenis Ujian</option>
                            <option value="1">Mid Exam</option>
                            <option value="2">Final Exam</option>
                            <option value="3">Remedial Exam</option>s
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