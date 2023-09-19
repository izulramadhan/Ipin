<?php 
	$qb = new lsp();

	if (isset($_POST['btnSearch'])) {
		$whereparam = "perk_tanggal";
		$param      = $_POST['dateAwal'];
		$param1     = $_POST['dateAkhir'];
		$dataB      = $qb->selectBetween2("detailallperkembangan",$whereparam,$param,$param1);
	}
?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
            		<div class="card">
            			<form method="post">
            				<div class="card-header">
            					<h3>Perkembangan Per Periode</h3>
            				</div>
            				<div class="card-body">
            					<div class="row">
            						<div class="col-sm-4">
										<label for="#">Dari Tanggal</label>
										<input value="<?= $_POST['dateAwal'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAwal" required>	
									</div>
									<div class="col-sm-4">
										<label for="#">Ke Tanggal</label>
										<input value="<?= $_POST['dateAkhir'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAkhir" required>	
									</div>
            					</div>
            					<br>
            					<button class="btn btn-primary" name="btnSearch"><i class="fa fa-search"></i> Search</button>
								<a href="?page=perkembanganperiode" class="btn btn-danger">Reload</a>
								<br><br>
								<?php if (isset($_POST['dateAwal'])): ?>
									<a  target="_blank" href="manager/PerkembanganPeriodePrint.php?dateAwal=<?php echo $param ?>&dateAkhir=<?php echo $param1 ?>"  class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
								<?php endif ?>
								<br><br>
								<table class="table table-striped table-hover table-bordered">
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
							        // if (count(@$dataB['data']) > 0) {
										if (!empty($dataB['data'])) {
							            $no = 1;
							            foreach(@$dataB['data'] as $ds){ ?>
										<tr>
											<td><?= $ds['perk_tanggal'] ?></td>
											<td><?= $ds['perk_nama'] ?></td>
											<td><?= $ds['perk_namaanak'] ?></td>
											<td><?= $ds['perk_umur'] ?> Bulan</td>
											<td><?= $ds['perk_total'] ?></td>
							        <?php $no++; } ?>
							        <?php }else{ ?>
							        	<tr>
							        		<td colspan="7" class="text-center">Tidak ada data</td>
							        	</tr>
							        <?php } ?>
							        </tbody>
								</table>
            				</div>
            			</form>
            		</div>
            	</div>		
            </div>
        </div>
    </div>
</div>