<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">


            <?= form_open_multipart('user/uploadbb'); ?>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" readonly>
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Upload Bukti Bayar -->
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/images/bukti_bayar/') . $user['buktibayar']; ?>" class="img-thumbnail">
                        </div>

                        <div class="col-sm-9">
                            <div class="custom-file">
                                <?php 
                                if (isset($user['buktibayar'])) { ?>
                                    <input type="hidden" class="custom-file-input" id="old_bb" name="old_bb" value="<?= $user['buktibayar']; ?>">
                                    <?php } ?>
                                <input type="file" class="custom-file-input" id="buktibayar" name="buktibayar">
                                <label class="custom-file-label" for="buktibayar">Choose file</label>
                                <?= form_error('buktibayar', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close(); ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->