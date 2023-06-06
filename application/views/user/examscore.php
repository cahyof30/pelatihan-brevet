<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <?php if ($this->session->userdata('role_id') == 2) { ?>
        <?php if ($nilai['kup_a'] != 0 || $nilai['pph_op'] != 0 || $nilai['pph_21'] != 0 || $nilai['pph_22'] != 0 || $nilai['ppn'] != 0 || $nilai['pph_b'] != 0 || $nilai['pbb'] != 0 || $nilai['kup_b'] != 0 || $nilai['akt_pjk'] != 0) { ?>
            <?php if ($user['verified'] == 1) { ?>
    <div class="card mb-3 col-lg-8">
    <h3 class="text-center mt-2">Hasil Ujian</h3>
    <h3 class="text-center mt-2">Pelatihan Brevet Pajak A & B</h3>
    <h4 class="text-center mt-2"><?= $nilai['name'] ?></h4>
        <div class="row g-0">
            <div class="col-md-10">
                <!-- <img src="<?= base_url('assets/images/profile/') . $user['image']; ?>" class="img-fluid rounded-start"> -->
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    
                    <table class="transparent-table">
                        <tr style="width:50px">
                        <td class="head-table"><strong>Materi</strong></td>
                            <td class="col">KUP A</td>
                            <td class="col">PPh OP</td>
                            <td class="col">PPh 21</td>
                            <td class="col">PPh 22</td>
                            <td class="col">PPN</td>
                            
                        </tr>
                        <tr>
                            <td class="head-table"><strong>Nilai (Numerik)</strong></td>
                    <td class="card-text"> <?= $nilai['kup_a']; ?></td>
                    <td class="card-text"> <?= $nilai['pph_op']; ?></td>
                    <td class="card-text"> <?= $nilai['pph_21']; ?></td>
                    <td class="card-text"> <?= $nilai['pph_22']; ?></td>
                    <td class="card-text"> <?= $nilai['ppn']; ?></td>

                    </tr>
                    <tr>
                        <td class="head-table"><strong>Materi</strong></td>
                    <td class="col">PPh B</td>
                            <td class="col">PBB</td>
                            <td class="col">KUP B</td>
                            <td class="col">Akt Pajak</td>                        
                    </tr>
                    <tr>
                    <td class="head-table"><strong>Nilai (Numerik)</strong></td>   
                    <td class="card-text"> <?= $nilai['pph_b']; ?></td>
                    <td class="card-text"> <?= $nilai['pbb']; ?></td>
                    <td class="card-text"> <?= $nilai['kup_b']; ?></td>
                    <td class="card-text"> <?= $nilai['akt_pjk']; ?></td>
                    </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="alert alert-danger">
        <h4 class="text-center mt-2"><i class="fa fa-info-circle"></i> Akun Anda Belum Terverifikasi, Silakan hubungi Administrator.</h4>
        </div>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-warning">
        <h3 class="text-center mt-2"><i class="fa fa-info-circle"></i> Maaf, Nilai Ujian Sedang Dalam Proses</h3>
    <?php } ?>
    <?php } else { ?>
        <div class="alert alert-warning">
        <h3 class="text-center mt-2"><i class="fa fa-info-circle"></i> Daftar Nilai Hanya Berlaku bagi User Peserta</h3>
        </div>
    <?php } ?>



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
    border: 1px solid #000;
}

.head-table{
    border: 1px solid #000;
}
.transparent-table th,
.transparent-table td {
    background-color: transparent;
    border: 0.5px solid #000;
}

.transparent-table th {
    padding: 8px;
    text-align: left;
    color: #ffffff; /* warna teks pada header tabel */
}

.transparent-table tr:nth-child(even) {
    background-color: rgba(0, 0, 0, 0.1); 
    width: 5px !important;
}

.transparent-table tr:nth-child(odd) {
    background-color: rgba(0, 0, 0, 0.05);
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