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
            <?php foreach ($score as $sc) { ?>
                <form action="<?= base_url('instructor/editExamScore'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $sc['user_id']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $sc['name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">KUP A</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kup_a" name="kup_a" value="<?= $sc['kup_a']; ?>">
                        </div>
                        <label for="email" class="col-sm-2 col-form-label">PPh B</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="pph_b" name="pph_b" value="<?= $sc['pph_b']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">PPh OP</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="pph_op" name="pph_op" value="<?= $sc['pph_op']; ?>">
                        </div>
                        <label for="email" class="col-sm-2 col-form-label">PBB</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="pbb" name="pbb" value="<?= $sc['pbb']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">PPh 21</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="pph_21" name="pph_21" value="<?= $sc['pph_21']; ?>">
                        </div>
                        <label for="email" class="col-sm-2 col-form-label">KUP B</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kup_b" name="kup_b" value="<?= $sc['kup_b']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">PPh 22</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="pph_22" name="pph_22" value="<?= $sc['pph_22']; ?>">
                        </div>
                        <label for="email" class="col-sm-2 col-form-label">Akt Pajak</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="akt_pjk" name="akt_pjk" value="<?= $sc['akt_pjk']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">PPN</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="ppn" name="ppn" value="<?= $sc['ppn']; ?>">
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status_id" id="status_id" class="form-control">
                                <option value="<?= $sc['status_id']; ?>" selected="selected"><?= $stat; ?> (Default)</option>
                                <?php
                                foreach ($status as $stat) { ?>
                                    <option value="<?= $stat['status_id']; ?>"><?= $stat['status_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
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