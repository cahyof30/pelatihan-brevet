<!DOCTYPE html>
<html>
<head>
 <title></title>
</head>
<body>
 <style type="text/css">
 .table-data{
   width: 100%;
   border-collapse: collapse;
  }

  .table-data tr th,
  .table-data tr td{
   border:1px solid black;
   font-size: 11pt;
   font-family:Verdana;
   padding: 10px 10px 10px 10px;
  }
  h3{
    font-family:Verdana;
  }
 </style>

 <h3><center>Laporan Data Alumni </center></h3>
 <h3><center>Pelatihan Akuntansi Brevet Pajak A & B</center></h3>
 <br/>
 <table class="table-data">
  <thead>
   <tr>
    <th>No</th>
    <th>ID Peserta</th>
    <th>Nama Peserta</th>
    <th>E-mail</th>
    <th>No. Handphone</th>
    <th>Pendidikan Terakhir</th>
    <th>Domisili</th>
    <th>Terdaftar Sejak</th>
   </tr>
  </thead>
  <tbody>
   <?php
   $no = 1;
   foreach($alumni as $alm){
   ?>
   <tr>
     <th scope="row"><?= $no++; ?></th>
     <td><?= $alm['id']; ?></td>
     <td><?= $alm['name']; ?></td>
     <td><?= $alm['email']; ?></td>
     <td><?= $alm['no_hp']; ?></td>
     <td><?= $alm['pendidikan']; ?></td>
     <td><?= $alm['domisili']; ?></td>
     <td><?= date('F Y', $alm['date_created']); ?></td>

   </tr>
   <?php
  }
  ?>
 </tbody>
</table>

<script type="text/javascript">
 window.print();
</script>

</body>
</html>
