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
                        <th scope="col">#</th>
                        <th scope="col">Pelatihan</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Link Pertemuan</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Modul</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($materi as $mat) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $mat['course']; ?></td>
                            <td><?= $mat['title']; ?></td>
                            <td id="url"><a href="<?= $mat['link']; ?>" target="_blank"><?= substr($mat['link'], 0, 37); ?> </a></td>
                            <td><?= substr($mat['time'], 0, 16); ?></td>
                            <td><a href="<?= base_url(); ?>modul/<?= $mat['modul']; ?>" class="btn btn-success"><i class="fa fa-download"></i></a></td>
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