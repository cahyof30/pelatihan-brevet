<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <section class="content">
        <button class="btn btn-primary" data-toggle="modal" data-target="TambahMateriModal"><i class="fa fa-plus"></i> Tambah Materi Baru</button>
        <table class="table">
            <tr>
                <th>No.</th>
                <th>Jenis</th>
                <th>Judul</th>
                <th>Link</th>
                <th>Modul</th>
            </tr>
            <?php
            $no = 1;
            foreach ($materi as $mat) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $mat->course_id ?></td>
                    <td><?= $mat->title ?></td>
                    <td><?= $mat->url ?></td>
                    <td><?= $mat->modul ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>



    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="newMaterialModal" tabindex="-1" role="dialog" aria-labelledby="newMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="newMaterialModalLabel">Add New Material</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('instructor'); ?> " method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($material as $mat) : ?>
                                    <option value="<?= $mat['id'] ?>"><?= $mat['course'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Material Title">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="URL to Meeting">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>