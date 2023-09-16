<?php 
    $dis = new lsp();
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
    $table = "table_hasilpertumbuhan";
	$auth      = $dis->selectWhere2("table_user","username",$_SESSION['username']);
    $dataDis = $dis->selectWhere2($table,"hp_iduser",$auth[0]['kd_id']);

    // $autokode = $dis->autokode($table,"kd_distributor","DS");
        // $bln = 0;
        // $hasil = $dis->selectWhere($table,"gt_bulan",$bln);

    

    // if (isset($_GET['delete'])) {
    //     $where = "kd_distributor";
    //     $whereValues = $_GET['id'];
    //     $redirect = "?page=viewDistributor";
    //     $response = $dis->delete($table,$where,$whereValues,$redirect);
    // }

    if (isset($_GET['edit'])) {
        $id = $_GET['id'];
        $editData = $dis->selectWhere($table,"hp_id",$id);
        $autokode = $editData['hp_id'];
    }
    
    if (isset($_POST['getSave'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama']);
        $hp_tanggallahir = $dis->validateHtml($_POST['tanggallahir']);
        $hp_tinggi = $dis->validateHtml($_POST['tb']);
        $hp_berat  = $dis->validateHtml($_POST['bb']);

        $umur  = $dis->validateHtml($_POST['umur']);

        // //hitung bulan
        // $tanggal_hari_ini = date("Y-m-d");
        // $tanggal_lahir = $hp_tanggallahir;
        // // Ubah tanggal lahir dan hari ini menjadi objek DateTime
        // $tanggal_lahir_obj = new DateTime($tanggal_lahir);
        // $tanggal_hari_ini_obj = new DateTime($tanggal_hari_ini);

        // // Hitung selisih tahun dan bulan
        // $selisih_tahun = $tanggal_hari_ini_obj->diff($tanggal_lahir_obj)->y;
        // $selisih_bulan = $tanggal_hari_ini_obj->diff($tanggal_lahir_obj)->m;

        // // Koreksi selisih bulan jika tanggal hari ini lebih kecil dari tanggal lahir
        // if ($tanggal_hari_ini_obj->format("d") < $tanggal_lahir_obj->format("d")) {
        //     $selisih_bulan -= 1;
        // }

        // // Menghitung total selisih bulan
        // $total_selisih_bulan = $selisih_tahun * 12 + $selisih_bulan;



        //mencari hasil kesimpulan
        // $data_grafik = $dis->selectWhere2('table_grafikpertumbuhan',"gt_bulan",$total_selisih_bulan);
        $data_grafik = $dis->selectWhere2('table_grafikpertumbuhan',"gt_bulan",$umur);
        $median = $data_grafik[0]['gt_median'];
        $min1sd = $data_grafik[0]['gt_min1sd'];
        $nilaikesimpulan = (floatval($hp_tinggi)-$median)/($median-$min1sd);
        $kesimpulan = '';
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        if($nilaikesimpulan < -3){
            $kesimpulan='Sangat Pendek';
        }else if($nilaikesimpulan >= -3 && $nilaikesimpulan <= -2){
            $kesimpulan='Pendek';
        }else if($nilaikesimpulan >= -2 && $nilaikesimpulan <= 3){
            $kesimpulan='Normal';
        }else if($nilaikesimpulan > -3){
            $kesimpulan='Tinggi';
        }

        
        if ($hp_namaanak == " " || empty($hp_tanggallahir) || $hp_tinggi == " " || empty($hp_berat)) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
            // $validno = substr($nohp_distributor, 0,2);
            // if ($validno != "08") {
            //     $response = ['response'=>'negative','alert'=>'Masukan nohp yang valid'];
            // }else{
                // if (strlen($nohp_distributor) < 11) {
                //     $response = ['response'=>'negative','alert'=>'Masukan 11 digit nohp'];
                // }else{
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate','$hp_tanggallahir','$hp_tinggi','$hp_berat','$nilaikesimpulan','$kesimpulan'";
                    $response = $dis->insertskor($table,$value,"?page=viewPertumbuhan",$nilaikesimpulan,$kesimpulan);
                // }
            // }
        }
    }

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
                                <li class="list-inline-item">Data Pertumbuhan</li>
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
            <?php if (!isset($_GET['edit'])): ?>    
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
                                    <input type="date" class="form-control form-control-sm" name="tanggallahir" id="tanggallahir" onchange="getUmur(this.value)">
                                    <input type="hidden" class="form-control form-control-sm" name="umur" id="umur" >
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
                                <!-- <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a> -->
                                <button type="submit"  name="getSave" class="btn btn-primary"><i class="fa fa-download"></i> Cek Data</button>
                            </form>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pertumbuhan Anak</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                   <thead>
                                       <tr>
                                            <th>Tanggal Cek</th>
                                            <th>Nama Anak</th>
                                            <!-- <th>TB</th>
                                            <th>BB</th> -->
                                            <th>Nilai</th>
                                            <th>Hasil</th>
                                            <th>Action</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($dataDis as $ds){
                                         ?>
                                       <tr>
                                            <td><?= $ds['hp_tanggal'] ?></td>
                                            <td><?= $ds['hp_namaanak'] ?></td>
                                            <td><?= $ds['hp_nilaikesimpulan'] ?></td>
                                            <td><?= $ds['hp_kesimpulan'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Detail" href="?page=viewPertumbuhan&edit&id=<?= $ds['hp_id'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    <!-- <a data-toggle="tooltip" data-placement="top" title="Delete" href="#" class="btn btn-danger"><i class="fa fa-trash" id="btnDelete<?php echo $no; ?>" ></i></a> -->
                                                </div>
                                            </td>
                                       </tr>
                                       <script src="vendor/jquery-3.2.1.min.js"></script>
                                       <script>
                                        $('#btnDelete<?php echo $no; ?>').click(function(e){
                                                      e.preventDefault();
                                                        swal({
                                                        title: "Hapus",
                                                        text: "Yakin Ingin menghapus?",
                                                        type: "error",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes",
                                                        cancelButtonText: "Cancel",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: true
                                                      }, function(isConfirm) {
                                                        if (isConfirm) {
                                                            window.location.href="?page=viewDistributor&delete&id=<?php echo $ds['kd_distributor'] ?>";
                                                        }
                                                      });
                                                    });
                                        </script>
                                       <?php $no++; } ?>
                                   </tbody>
                               </table>
                           </div>
                        </div>
                    </div>
                    </div>
                    <?php endif ?>

                    <?php if (isset($_GET['edit'])): ?>
                        <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Detail Pertumbuhan Anak</strong>
                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                            <div class="table-responsive">
                               <table  class="table table-borderless table-striped table-earning">
                               <tr>
                                <td style="width: 20px;">Tanggal Cek</td>
                                <td>: <b><?php echo @$editData['hp_tanggal'] ?></b></td>
                               </tr>

                               <tr>
                                <td style="width: 20px;">Nama Anak</td>
                                <td>: <b><?php echo @$editData['hp_namaanak'] ?></b></td>
                               </tr>
                               
                               <tr>
                                <td style="width: 20px;">Tanggal Lahir</td>
                                <td>: <b><?php echo @$editData['hp_tanggallahir'] ?></b></td>
                               </tr>

                               <tr>
                                <td style="width: 20px;">Tinggi Badan</td>
                                <td>: <b><?php echo @$editData['hp_tinggi'] ?> Cm</b></td>
                               </tr>

                               <tr>
                                <td style="width: 20px;">Berat Badan</td>
                                <td>: <b><?php echo @$editData['hp_berat'] ?> Gram</b></td>
                               </tr>

                               <tr>
                                <td style="width: 20px;">Nilai</td>
                                <td>: <b><?php echo @$editData['hp_nilaikesimpulan'] ?></b></td>
                               </tr>

                               <tr>
                                <td style="width: 20px;">Kesimpulan</td>
                                <td>: <b><?php echo @$editData['hp_kesimpulan'] ?></b></td>
                               </tr>

                               </table>
                            </div>
                           <br>
                           <a href="?page=viewPertumbuhan" class="btn btn-danger">Kembali</a>
                           </div>

                           <div class="col-md-4">
                            <center>
                           <img src="images/gambaranak.png"  style="height: 300px;"/>
                           </center>
                           </div>
                        </div>


                        </div>
                    </div>
                    </div>
                    <?php endif ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getUmur(val){
        console.log("🚀 ~ file: viewPertumbuhan.php:316 ~ getUmur ~ val:", val);
        var tanggalLahir = val;
        var today = new Date();
        var birthDate = new Date(tanggalLahir);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        age = age * 12 + m;
        console.log("🚀 ~ file: viewPertumbuhan.php:322 ~ getUmur ~ age:", age);

        document.getElementById('umur').value=age;
    }
</script>

