<?php 
    $dis = new lsp();
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
    $table = "table_grafikpertumbuhan";
    $dataDis = $dis->select($table);
    // $autokode = $dis->autokode($table,"kd_distributor","DS");
        // $bln = 0;
        // $hasil = $dis->selectWhere($table,"gt_bulan",$bln);

    

    // if (isset($_GET['delete'])) {
    //     $where = "kd_distributor";
    //     $whereValues = $_GET['id'];
    //     $redirect = "?page=viewDistributor";
    //     $response = $dis->delete($table,$where,$whereValues,$redirect);
    // }

    // if (isset($_GET['edit'])) {
    //     $id = $_GET['id'];
    //     $editData = $dis->selectWhere($table,"kd_distributor",$id);
    //     $autokode = $editData['kd_distributor'];
    // }
    // if (isset($_POST['getSave'])) {
    //     $kd_distributor   = $dis->validateHtml($_POST['kode_distributor']);
    //     $nama_distributor = $dis->validateHtml($_POST['nama_distributor']);
    //     $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
    //     $alamat           = $dis->validateHtml($_POST['alamat']);

    //     if ($kd_distributor == " " || empty($kd_distributor) || $nama_distributor == " " || empty($nama_distributor) || $nohp_distributor == " " || empty($nohp_distributor) || $alamat == " " || empty($alamat)) {
    //         $response = ['response'=>'negative','alert'=>'Lengkapi field'];
    //     }else{
    //         $validno = substr($nohp_distributor, 0,2);
    //         if ($validno != "08") {
    //             $response = ['response'=>'negative','alert'=>'Masukan nohp yang valid'];
    //         }else{
    //             if (strlen($nohp_distributor) < 11) {
    //                 $response = ['response'=>'negative','alert'=>'Masukan 11 digit nohp'];
    //             }else{
    //                 $value = "'$kd_distributor','$nama_distributor','$alamat','$nohp_distributor'";
    //                 $response = $dis->insert($table,$value,"?page=viewDistributor");
    //             }
    //         }
    //     }
    // }

    // if (isset($_POST['getUpdate'])) {
    //     $kd_distributor   = $dis->validateHtml($_POST['kode_distributor']);
    //     $nama_distributor = $dis->validateHtml($_POST['nama_distributor']);
    //     $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
    //     $alamat           = $dis->validateHtml($_POST['alamat']);

    //     if ($kd_distributor == "" || $nama_distributor == "" || $nohp_distributor == "" || $alamat == "") {
    //         $response = ['response'=>'negative','alert'=>'lengkapi field'];
    //     }else{
    //         $validno = substr($nohp_distributor, 0,2);
    //         if ($validno != "08") {
    //             $response = ['response'=>'negative','alert'=>'Masukan nohp yang valid'];
    //         }else{
    //             if (strlen($nohp_distributor) < 11) {
    //                 $response = ['response'=>'negative','alert'=>'Masukan 11 digit nohp'];
    //             }else{
    //                 $value = "kd_distributor='$kd_distributor',nama_distributor='$nama_distributor',no_telp='$nohp_distributor',alamat='$alamat'";
    //                 $response = $dis->update($table,$value,"kd_distributor",$_GET['id'],"?page=viewDistributor");
    //             }
    //         }
    //     }
    // }
 ?>
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                       <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Data Distributor</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content" style="margin-top: -60px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header" >
                            <strong class="card-title mb-3">Input Pertumbuhan</strong>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="">Nama Anak</label>
                                    <input type="text" class="form-control form-control-sm" name="nama" id="nama" >
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-sm" name="tanggallahir" id="tanggallahir" >
                                </div>
                                <div class="form-group">
                                    <label for="">Tinggi Badan (Cm)</label>
                                    <input type="text" class="form-control form-control-sm" name="tb" id="tb">
                                </div>
                                <div class="form-group">
                                    <label for="">Berat Badan (Gram)</label>
                                    <input type="text" class="form-control form-control-sm" name="bb" id="bb">
                                </div>
                                <hr>
                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="button" onclick="cekData();" name="median" class="btn btn-primary"><i class="fa fa-download"></i> Cek Data</button>
                                <?php endif ?>
                            </form>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pertumbuhan</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                  <!-- <div id="testing"></div> -->
                                  <input type="text" id="test" class="test">
                                   <p>Nama Anak : <b><span id="nama_view" ></span></b></p>
                                   <p>Usia : <b><span id="usia_view"></span> Bulan</b></p>
                                   <p>Tinggi Badan : <b><span id="tb_view"></span> Centimeter</b></p>
                                   <p>Berat Badan : <b><span id="bb_view"></span> Gram</b></p>
                                   <p>Kesimpulan : </p>
                                   
                               </table>
                           </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cekData(){

        var tb = document.getElementById('tb').value;
        var bb = document.getElementById('bb').value;
        var nama = document.getElementById('nama').value;
        var tanggalLahir = document.getElementById('tanggallahir').value;
        
        var today = new Date();
        var birthDate = new Date(tanggalLahir);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        age = age * 12 + m;

        document.getElementById('nama_view').innerHTML=nama;
        document.getElementById('tb_view').innerHTML=tb;
        document.getElementById('bb_view').innerHTML=bb;
        document.getElementById('usia_view').innerHTML=age;
        

    }
</script>
