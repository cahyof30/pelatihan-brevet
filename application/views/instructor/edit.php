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
            <?php foreach ($materi as $mat) { ?>
                <form action="<?= base_url('instructor/editMateri'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $mat['id']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course_id" class="col-sm-2 col-form-label">Pelatihan</label>
                        <div class="col-sm-10">
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="<?= $id; ?>" selected="selected"><?= $crs; ?></option>
                                <?php
                                foreach ($course as $crs) { ?>
                                    <option value="<?= $crs['id']; ?>"><?= $crs['course']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Judul Materi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" value="<?= $mat['title']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Link Zoom</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="link" name="link" value="<?= $mat['link']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Waktu</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="time" name="time" value="<?= $mat['time']; ?>">
                        </div>
                    </div>
                    <!-- Upload Modul -->
                    <div class="form-group row mt-3">
                        <label for="email" class="col-sm-2 col-form-label">Upload Modul</label>
                        <?php
                        if (isset($mat['modul'])) { ?>
                            <input type="hidden" name="old_mod" id="old_mod" value="<?= $mat['modul']; ?>">

                        <?php } ?>
                        <div class="col-sm-10">
                            <input type="file" class="" name="modul" id="modul">

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