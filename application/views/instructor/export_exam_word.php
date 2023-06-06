<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: Attachment; filename=$title.doc");
header("Pragma: no-cache");
header("Expires:0");
?>

<h3>
    <center>Laporan Data Hasil Ujian</center>
</h3>
<h3>
    <center>Pelatihan Akuntansi Brevet Pajak A & B</center>
</h3>
<br />
<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Peserta</th>
            <th>Nama Peserta</th>
            <th>KUP A</th>
            <th>PPh OP</th>
            <th>PPh 21</th>
            <th>PPh 22</th>
            <th>PPN</th>
            <th>PPh B</th>
            <th>PBB</th>
            <th>KUP B</th>
            <th>Akt Pajak</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($examresult as $ex) {
        ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $ex['user_id']; ?></td>
                <td><?= $ex['name']; ?></td>
                <td><?= $ex['kup_a']; ?></td>
                <td><?= $ex['pph_op']; ?></td>
                <td><?= $ex['pph_21']; ?></td>
                <td><?= $ex['pph_22']; ?></td>
                <td><?= $ex['ppn']; ?></td>
                <td><?= $ex['pph_b']; ?></td>
                <td><?= $ex['pbb']; ?></td>
                <td><?= $ex['kup_b']; ?></td>
                <td><?= $ex['akt_pjk']; ?></td>
                <td> <?php if ($ex['status_id'] == 1) { ?>
                        Lulus
                    <?php } else { ?>
                        Tidak Lulus <?php } ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>