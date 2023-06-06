<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-8">


            <?= $this->session->flashdata('pesan'); ?>
            <?php foreach ($exam as $ex) { ?>
                <form action="<?= base_url('instructor/editExam'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $ex['id']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course_id" class="col-sm-2 col-form-label">Pelatihan</label>
                        <div class="col-sm-10">
                            <select name="course_id" id="course_id" class="form-control">

                                <option value=1>Brevet Pajak A & B</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Jenis Ujian</label>
                        <div class="col-sm-10">
                            <select name="exam_tp" id="exam_tp" class="form-control">
                                <option value="<?= $ex['exam_tp']; ?>" selected="selected"><?= $ext; ?> (Default)</option>
                                <?php
                                foreach ($examtype as $ext) { ?>
                                    <option value="<?= $ext['exam_tp']; ?>"><?= $ext['exam_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Link Zoom</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="<?= $ex['deadline']; ?>">
                        </div>
                    </div>
                    <!-- Upload Modul -->
                    <div class="form-group row mt-3">
                        <label for="email" class="col-sm-2 col-form-label">Upload Berkas Ujian</label>
                        <?php
                        if (isset($ex['exam_file'])) { ?>
                            <input type="hidden" name="old_task" id="old_task" value="<?= $ex['exam_file']; ?>">

                        <?php } ?>
                        <div class="col-sm-10">
                            <input type="file" class="" name="exam_file" id="exam_file">

                        </div>

                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
        </div>
        </form>
    <?php } ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->