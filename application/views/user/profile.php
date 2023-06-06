<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-8">
    <h3 class="text-center mt-2">Data Peserta</h3>
    <h3 class="text-center mt-2">Pelatihan Brevet Pajak A & B</h3>
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('assets/images/profile/') . $user['image']; ?>" class="img-fluid rounded-start ml-3 mt-2">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    
                    <table class="transparent-table">
                        <tr style="width:50px">
                            <td class="col">Nama</td>
                            <td class="col">Email</td>
                            <td class="col">No. Handphone</td>
                            <td class="col">Domisili</td>
                            <td class="col">Registered since</td>
                        </tr>
                        <tr>
                    <td class="card-text">: <?= $user['name']; ?></td>
                    <td class="card-text">: <?= $user['email']; ?></td>
                    <td class="card-text">: <?= $user['no_hp']; ?></td>
                    <td class="card-text">: <?= $user['domisili']; ?></td>
                    <td class="card-text">: <?= date('d F Y', $user['date_created']); ?></td>
                    </tr>
                    </table>
                    
                    <?php if ($user['verified'] == 0) { ?>
                        <br>
                        <p>Upload Bukti Pembayaran</p>
                        <p><a href="<?= base_url('user/uploadbb/') . $user['id']; ?>" class="btn btn-danger">Upload</a></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<style>

    .tab-nama{
        padding-right: 10px;
    }
    .transparent-table {
    background-color: transparent;
    border-collapse: collapse;
}

.transparent-table th,
.transparent-table td {
    background-color: transparent;
    border: none;
}

.transparent-table th {
    padding: 8px;
    text-align: left;
    color: #ffffff; /* warna teks pada header tabel */
}

.transparent-table tr:nth-child(even) {
    /* background-color: rgba(0, 0, 0, 0.1);  */
    width: 5px !important;
}

.transparent-table tr:nth-child(odd) {
    /* background-color: rgba(0, 0, 0, 0.05); */
    width: 100px;
}

.transparent-table td {
    padding: 8px;
    color: #000000; /* warna teks pada sel tabel */
}

.transparent-table {
    /* kode CSS lainnya */
    display: flex;
    flex-direction: column;
}

.transparent-table thead {
    /* kode CSS lainnya */
    display: flex;
}

.transparent-table th,
.transparent-table td {
    /* kode CSS lainnya */
    flex: 1;
}

.transparent-table tbody {
    /* kode CSS lainnya */
    display: flex;
}

.transparent-table tr {
    /* kode CSS lainnya */
    flex: 1;
    
}

.transparent-table td {
    /* kode CSS lainnya */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: flex-start;
}

</style>