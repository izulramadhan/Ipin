<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/mains.css">
  </head>
  <style>
    body{
        overflow-x: hidden;
    }
  </style>
  <body onload="window.print();">
<?php 
include "../config/controller.php";
$qb = new lsp();
        if (!isset($_GET['dateAwal']) || !isset($_GET['dateAkhir'])) {
            header("location:../PageManager.php?page=pertumbuhanperiode");
        }
        $whereparam = "hp_tanggal";
        $param      = $_GET['dateAwal'];
        $param1     = $_GET['dateAkhir'];
        $dataB      = $qb->selectBetween("detailallpertumbuhan",$whereparam,$param,$param1);
 ?>
 <div class="row">
    <div class="col-sm-12" style="padding: 50px;">
    <h2>Laporan Pertumbuhan</h2>
    <p>IPIN (Aplikasi Ibu Pintar)</p>
    </div>
 </div>
<div class="row">
    <div class="col-sm-12" style="padding: 50px;">
        <p class="text-right">Dari tanggal:<?php echo $_GET['dateAwal']; ?> Ke:<?php echo $_GET['dateAkhir'] ?></p>
        <table class="table table-striped table-bordered">
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
            if (count(@$dataB) > 0) {
                $no = 1;
                foreach(@$dataB['data'] as $ds){ ?>
                <tr>
                    <td><?= $ds['hp_tanggal'] ?></td>
					<td><?= $ds['hp_nama'] ?></td>
					<td><?= $ds['hp_namaanak'] ?></td>
					<td><?= $ds['hp_tanggallahir'] ?></td>
					<td><?= $ds['hp_tinggi'] ?> Cm</td>
					<td><?= $ds['hp_berat'] ?> Gram</td>
					<td><?= $ds['hp_nilaikesimpulan'] ?></td>
					<td><?= $ds['hp_kesimpulan'] ?></td>
                </tr>
            <?php $no++; } ?>
                <tr>
                    <td colspan="7"><b>Total Pemeriksaan</b></td>
                    <td>
                        <?php foreach ($dataB['jumlah'] as $datas): ?>
                            <?php echo $datas; ?>
                        <?php endforeach ?>
                </tr>
             <?php }else{ ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data di periode ini</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <p>Tanggal cetak : <?= date("Y-m-d"); ?></p>
        </div>
</div>

</body>
</html>