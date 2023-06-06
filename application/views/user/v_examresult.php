<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row" style="width: 80vw;">
        <div class="">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <?php foreach ($result as $row) :  ?>
        <div class="card">
            <header>
                <time datetime="2018-05-15T19:00">24 Mei 2023</time>
                <div class="logo">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 234.5 53.7">
                            <style>
                                .st0 {
                                    fill: none;
                                    stroke: #FFFFFF;
                                    stroke-width: 5;
                                    stroke-miterlimit: 10;
                                }
                            </style>
                            <path d="M.6 1.4L116.9 52l117-50.6" class="st0" />
                        </svg>
                    </span>
                    <img style="width=100px;" src="<?= base_url('assets/images/logo-cert.png') ?>" class="logo-img-top" alt="Gambar Peserta">
                </div>
                <div class="sponsor"><?= $row->id; ?></div>
            </header>
            <div class="announcement">
                <div><img src="<?= base_url('assets/images/profile/') . $row->image; ?>" class="card-img-top" alt="Gambar Peserta"></div>
                <div>
                    <h3>Sertifikat Brevet Pajak</h3>
                    <h5>Atas Nama</h5>
                    <h1> <?= $row->name; ?></h1>
                    <h2 class="italic"><a href="<?= base_url(); ?>assets/cert/<?= $row->certificate; ?>" class="btn btn-success"><i></i>Download</a></td>
                    </h2>
                </div>
            </div>

        </div>

    <?php endforeach; ?>