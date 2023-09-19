<?php 
	$qb = new lsp();
	$dataB = $qb->select("detailallpertumbuhan");
	if ($_SESSION['level'] != "Manager") {
    header("location:../index.php");
  	}
 ?>
<div class="main-content" style="margin-top: 30px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
            		<div class="card">
            			<div class="card-header">
            				<h3>Laporan Keseluruhan Pertumbuhan</h3>
            				<br>
            				<a href="manager/export.php" name="export" class="btn btn-success" target="_blank">Export Excel</a>
        					<a href="manager/lappertumbuhanfull.php" target="_blank" class="btn btn-info">Print</a>
            			</div>
            			<div class="card-body">
            				<table class="table table-hover table-bordered" id="sampleTable">
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
											<!-- <td class="text-center">
													<a href="?page=viewBarangDetail&id=<?php echo $ds['hp_id'] ?>" class="btn btn-warning"><i class="fa fa-search"></i></a>
											</td> -->
										</tr>
					                  <?php $no++; } ?>
				                </tbody>
            				</table>
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>