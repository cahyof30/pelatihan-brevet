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
        <button class="btn btn-primary" data-toggle="modal" data-target="#newMaterialModal"><i class="fa fa-plus"></i> Tambah Materi Baru</button>
        <table class="table">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Pelatihan</th>
                <th scope="col">Judul</th>
                <th scope="col">Link Pertemuan</th>
                <th scope="col">Modul</th>
                <th scope="col">Waktu</th>
                <th scope="col" colspan="2">Aksi</th>
            </tr>
            <?php
            $no = 1;
            foreach ($materi as $mat) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= substr($mat['course'], 0, 12) ?></td>
                    <td><?= substr($mat['title'], 0, 15) ?></td>
                    <td><a href="<?= $mat['link']; ?>" target="_blank"><?= substr($mat['link'], 0, 37); ?></td>
                    <td><?= substr($mat['modul'], 5, 25) ?></td>
                    <td><?= substr($mat['time'], 2, 14) ?></td>
                    <td>
                        <a href="<?= base_url('instructor/editMateri/') . $mat['id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                        <a href="<?= base_url('instructor/deleteCourse/') . $mat['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus ?')" class="btn btn-danger btn-item"><i class="fa fa-trash"></i>&nbsp;Hapus</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>



    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="newMaterialModal" tabindex="-1" role="dialog" aria-labelledby="newMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="newMaterialModalLabel">Tambah Materi Baru</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('instructor'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="course_id" id="course_id" class="form-control">
                            <option value="<?= $mat['course_id'] ?>">Brevet Pajak A & B</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Material Title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="link" name="link" placeholder="URL to Meeting">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" id="modul" name="modul" required>
                    </div>
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" id="time" name="time">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>