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
            <?php foreach ($certificate as $cert) { ?>
                <form action="<?= base_url('admin/uploadCert'); ?>" method="post" enctype="multipart/form-data">
                    <!-- <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="email" name="email" value="<?= $cert['email']; ?>">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">No. Peserta</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?= $cert['user_id']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $cert['name']; ?>" readonly>
                        </div>
                    </div>

                    <!-- Upload Certificate -->
                    <div class="form-group row mt-3">
                        <label for="email" class="col-sm-2 col-form-label">Upload Sertifikat</label>
                        <?php
                        if (isset($cert['certificate'])) { ?>
                            <input type="hidden" name="old_cert" id="old_cert" value="<?= $cert['certificate']; ?>">

                        <?php } ?>
                        <div class="col-sm-10">
                            <input type="file" class="" name="certificate" id="certificate">

                        </div>

                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="back" class="btn btn-danger">Back</button>
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