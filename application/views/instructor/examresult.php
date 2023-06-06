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
        <?php if ($this->session->userdata['role_id'] == 1) { ?>
            <a href="<?= base_url('instructor/wipeAllData/') ?>" onclick="return confirm('Anda yakin akan menghapus seluruh data? \n[TINDAKAN INI TIDAK DAPAT DIPULIHKAN]')">
                <button class="btn btn-danger"><i class="fa fa-eraser"></i>Hapus Semua Data</button></a>
        <?php } ?>
        <table class="table">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">No. Peserta</th>
                <th scope="col">Nama</th>
                <th scope="col">Mid Test</th>
                <th scope="col">Final Test</th>
            </tr>
            <?php
            $no = 1;
            foreach ($result as $rs) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $rs['user_id'] ?></td>
                    <td><?= $rs['name'] ?></td>
                    <?php if (empty($rs['midexam_file'])) { ?>
                        <td><button class="btn btn-secondary" disabled><i class="fa fa-ban"></i>&nbsp;No Data</button></td>
                    <?php } else { ?>
                        <td><a href="<?= base_url(); ?>exam/answer/<?= $rs['midexam_file']; ?>" target="_blank" class="btn btn-success"><i class="fa fa-download"></i>&nbsp;Download</a></td>
                    <?php } ?>
                    <?php if (empty($rs['finalexam_file'])) { ?>
                        <td><button class="btn btn-secondary" disabled><i class="fa fa-ban"></i>&nbsp;No Data</button></td>
                    <?php } else { ?>
                        <td><a href="<?= base_url(); ?>exam/answer/<?= $rs['finalexam_file']; ?>" target="_blank" class="btn btn-success"><i class="fa fa-download"></i>&nbsp;Download</a></td>
                        </td>
                    <?php } ?>

                <?php } ?>
        </table>
    </section>

    <?php if ($this->session->userdata['role_id'] == 1) { ?>
        <div>
            <p class="alert alert-dark"><i class="fa fa-circle-info"></i> Gunakan Tombol <strong>"Hapus Semua Data"</strong> hanya saat pelatihan telah berakhir dan persiapan awal angkatan baru. Data yang telah terhapus tidak dapat dipulihkan.</p>
        </div>
    <?php } ?>