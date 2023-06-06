<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
        </div>
    </div>

    <div class="card mb-3 col-lg-8">
        <div class="row g-0">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text"><?= $certificate['user_id']; ?></p>
                    <h5 class="card-title"><?= $certificate['name']; ?></h5>
                    <p><a href="<?= base_url(); ?>assets/cert/<?= $certificate['certificate']; ?>" class="btn btn-success"><i class="fa fa-download"></i></a></p>
                </div>
            </div>
        </div>
    </div>


</div>