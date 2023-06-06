<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana;
            padding: 10px 10px 10px 10px;
        }

        h3 {
            font-family: Verdana;
        }
    </style>

    <h3>
        <center>Laporan Data Alumni</center>
    </h3>
    <h3>
        <center>Pelatihan Akuntansi Brevet Pajak A & B</center>
    </h3>
    <br />
    <table class="table-data trans-table">
        <tr>
            <td>Ketentuan Umum dan Tata Cara Perpajakan A</td>
            <td>Pajak Penghasilan Orang Pribadi</td>
            <td>Pajak Penghasilan 21</td>
            <td>Pajak Penghasilan Pasal 22, 23, 26, dan 4 ayat 2</td>
            <td>Pajak Pertambahan Nilai</td>
            <td>Pajak Penghasilan Badan </td>
            <td>Pajak Bumi dan Bangunan, BPHTB, dan Bea Materai</td>
            <td>Ketentuan Umum dan Tata Cara Perpajakan B</td>
            <td>Akuntansi Pajak</td>
        </tr>

        <?php
        $no = 1;
        foreach ($alumni as $alm) {
        ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $alm['kup_a']; ?></td>
                <td><?= $alm['pph_op']; ?></td>
                <td><?= $alm['email']; ?></td>
                <td><?= $alm['no_hp']; ?></td>
                <td><?= $alm['pendidikan']; ?></td>
                <td><?= $alm['domisili']; ?></td>
                <td><?= date('F Y', $alm['date_created']); ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>