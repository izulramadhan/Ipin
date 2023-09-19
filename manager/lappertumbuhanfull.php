<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style>
    body{
     	overflow-x: hidden;
    }
  </style>
  <body onload="" style="padding: 20px;">
  <?php 
  include "../config/controller.php";
  $qb = new lsp();
  $dataB = $qb->select("detailallpertumbuhan");
  $total = $qb->selectCount("detailallpertumbuhan","hp_id");
   ?>
<style>
    @media print{
      .btn{
        display: none;
      }
    }
 </style>
<div class="row">
	<div class="col-sm-12">
    <button class="btn" onclick="window.print()">Print</button>
    <h2>Laporan Keseluruhan Petumbuhan</h2>
    <p>IPIN (Aplikasi Ibu Pintar)</p>
    <p class="text-right">Tanggal Cetak: <?php echo date("Y-m-d"); ?></p>
			<table border="1" cellspacing="0" width="100%;" cellpadding="20">
                <thead>
                  <tr>
                  <th>Tanggal Cek</th>
				          <th>Nama Ibu</th>
				          <th>Nama Anak</th>
				          <th>Tanggal Lahir</th>
				          <th>Tinggi</th>
				          <th>Berat</th>
				          <th>Nilai</th>
				          <th>Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach($dataB as $ds){ ?>
                <tr>
                <td><?= $ds['hp_tanggal'] ?></td>
                <td><?= $ds['hp_nama'] ?></td>
                <td><?= $ds['hp_namaanak'] ?></td>
                <td><?= $ds['hp_tanggallahir'] ?></td>
                <td><?= $ds['hp_tinggi'] ?> Cm</td>
                <td><?= $ds['hp_berat'] ?> Gram</td>
                <td><?= $ds['hp_nilaikesimpulan'] ?></td>
                <td><?= $ds['hp_kesimpulan'] ?></td>
                  <?php $no++; } ?>
                </tbody>
                <tr>
                	<td colspan="7"><b>Total Pemeriksaan</b></td>
                	<td style="text-align: center;"><b> <?php echo $total['count']; ?></b></td>
                </tr>
              </table>
		</div>
</div>

</body>
</html>