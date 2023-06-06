<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?> -->
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-8">
            <?php if ($this->session->userdata('role_id') == 2) { ?>
            <?= $this->session->flashdata('pesan'); ?>
            <form action="<?= base_url('user/uploadMidExam'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="id" name="id" value=<?= $users['user_id'] ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="email" name="email" value=<?= $users['email'] ?> readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value=<?= $users['name'] ?> readonly>
                    </div>
                </div>
                
                
                <!-- Upload Mid Exam -->

                <div class="form-group row mt-3">
                    <label for="email" class="col-sm-2 col-form-label">Upload Jawaban</label>

                    <?php
                    if (isset($users['midexam_file'])) { ?>
                        <input type="hidden" name="old_ans" id="old_ans" value="<?= $users['midexam_file']; ?>">

                    <?php } ?>

                    <div class="col-sm-10">
                        <input type="file" class="" name="midexam_file" id="midexam_file">


                    </div>

                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">

                        <button type="back" class="btn btn-danger">Back</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning" role="alert"><i class="fa fa-info-circle"></i> Halaman ini hanya dapat diakses oleh peserta!</div>
                <?php } ?>
        </div>
        </form>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    function goBack() {
        window.history.back();
    }
</script>