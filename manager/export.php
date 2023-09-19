<?php 

	$dateNow = date("Y-m-d");
	header("Content-type:application/vnd-ms-excel");
	header("Content-Disposition:attachment;filename=Laporan Keseluruhan Pertumbuhan - $dateNow.xls");

	include "lappertumbuhanfull.php";

 ?>