<?php 

	$dateNow = date("Y-m-d");
	header("Content-type:application/vnd-ms-excel");
	header("Content-Disposition:attachment;filename=Laporan Keseluruhan Perkembangan - $dateNow.xls");

	include "lapperkembanganfull.php";

 ?>