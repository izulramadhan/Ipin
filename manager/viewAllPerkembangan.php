<?php 
	$qb = new lsp();
	$dataB = $qb->select("detailallperkembangan");
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
            				<h3>Laporan Keseluruhan Perkembangan</h3>
            				<br>
            				<a href="manager/export_perkembangan.php" name="export" class="btn btn-success" target="_blank">Export Excel</a>
        					<a href="manager/lapperkembanganfull.php" target="_blank" class="btn btn-info">Print</a>
            			</div>
            			<div class="card-body">
            				<table class="table table-hover table-bordered" id="sampleTable">
								<thead>
				                  <tr>
				                    <th>Tanggal Cek</th>
				                    <th>Nama Ibu</th>
				                    <th>Nama Anak</th>
				                    <th>KPSP Umur</th>
				                    <th>Hasil</th>
				                  </tr>
				                </thead>
				                <tbody>
				                	<?php 
					                  $no = 1;
					                  foreach($dataB as $ds){ ?>
										<tr>
											<td><?= $ds['perk_tanggal'] ?></td>
											<td><?= $ds['perk_nama'] ?></td>
											<td><?= $ds['perk_namaanak'] ?></td>
											<td><?= $ds['perk_umur'] ?></td>
											<td><?= $ds['perk_total'] ?></td>
											<!-- <td class="text-center">
													<a href="?page=viewBarangDetail&id=<?php echo $ds['perk_id'] ?>" class="btn btn-warning"><i class="fa fa-search"></i></a>
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