<?php 
    $dis = new lsp();
    if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
    }
    $table = "table_perkembangan";
	$auth      = $dis->selectWhere2("table_user","username",$_SESSION['username']);
    $dataDis = $dis->selectWhere2($table,"perk_iduser",$auth[0]['kd_id']);

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
        $editData = $dis->selectWhere($table,"perk_id",$id);
        $autokode = $editData['perk_id'];
    }
    
    if (isset($_POST['getSave'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama']);
        $hp_tanggallahir = $dis->validateHtml($_POST['tanggallahir']);
        $hp_tinggi = $dis->validateHtml($_POST['tb']);
        $hp_berat  = $dis->validateHtml($_POST['bb']);

        //mencari hasil kesimpulan
        $data_grafik = $dis->selectWhere2('table_grafikpertumbuhan',"gt_bulan",1);
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
                    $response = $dis->insert($table,$value,"?page=viewPertumbuhan");
                // }
            // }
        }
    }

    if (isset($_POST['getSave3'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama3']);
        $hp_umur   = $dis->validateHtml($_POST['umur3']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal31']);
        $perk_2 = $dis->validateHtml($_POST['soal32']);
        $perk_3 = $dis->validateHtml($_POST['soal33']);
        $perk_4 = $dis->validateHtml($_POST['soal34']);
        $perk_5 = $dis->validateHtml($_POST['soal35']);
        $perk_6 = $dis->validateHtml($_POST['soal36']);
        $perk_7 = $dis->validateHtml($_POST['soal37']);
        $perk_8 = $dis->validateHtml($_POST['soal38']);
        $perk_9 = $dis->validateHtml($_POST['soal39']);
        $perk_10 = $dis->validateHtml($_POST['soal310']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave6'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama6']);
        $hp_umur   = $dis->validateHtml($_POST['umur6']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal61']);
        $perk_2 = $dis->validateHtml($_POST['soal62']);
        $perk_3 = $dis->validateHtml($_POST['soal63']);
        $perk_4 = $dis->validateHtml($_POST['soal64']);
        $perk_5 = $dis->validateHtml($_POST['soal65']);
        $perk_6 = $dis->validateHtml($_POST['soal66']);
        $perk_7 = $dis->validateHtml($_POST['soal67']);
        $perk_8 = $dis->validateHtml($_POST['soal68']);
        $perk_9 = $dis->validateHtml($_POST['soal69']);
        $perk_10 = $dis->validateHtml($_POST['soal610']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave9'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama9']);
        $hp_umur   = $dis->validateHtml($_POST['umur9']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal91']);
        $perk_2 = $dis->validateHtml($_POST['soal92']);
        $perk_3 = $dis->validateHtml($_POST['soal93']);
        $perk_4 = $dis->validateHtml($_POST['soal94']);
        $perk_5 = $dis->validateHtml($_POST['soal95']);
        $perk_6 = $dis->validateHtml($_POST['soal96']);
        $perk_7 = $dis->validateHtml($_POST['soal97']);
        $perk_8 = $dis->validateHtml($_POST['soal98']);
        $perk_9 = $dis->validateHtml($_POST['soal99']);
        $perk_10 = $dis->validateHtml($_POST['soal910']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave12'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama12']);
        $hp_umur   = $dis->validateHtml($_POST['umur12']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal121']);
        $perk_2 = $dis->validateHtml($_POST['soal122']);
        $perk_3 = $dis->validateHtml($_POST['soal123']);
        $perk_4 = $dis->validateHtml($_POST['soal124']);
        $perk_5 = $dis->validateHtml($_POST['soal125']);
        $perk_6 = $dis->validateHtml($_POST['soal126']);
        $perk_7 = $dis->validateHtml($_POST['soal127']);
        $perk_8 = $dis->validateHtml($_POST['soal128']);
        $perk_9 = $dis->validateHtml($_POST['soal129']);
        $perk_10 = $dis->validateHtml($_POST['soal1210']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave15'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama15']);
        $hp_umur   = $dis->validateHtml($_POST['umur15']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal151']);
        $perk_2 = $dis->validateHtml($_POST['soal152']);
        $perk_3 = $dis->validateHtml($_POST['soal153']);
        $perk_4 = $dis->validateHtml($_POST['soal154']);
        $perk_5 = $dis->validateHtml($_POST['soal155']);
        $perk_6 = $dis->validateHtml($_POST['soal156']);
        $perk_7 = $dis->validateHtml($_POST['soal157']);
        $perk_8 = $dis->validateHtml($_POST['soal158']);
        $perk_9 = $dis->validateHtml($_POST['soal159']);
        $perk_10 = $dis->validateHtml($_POST['soal1510']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave18'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama18']);
        $hp_umur   = $dis->validateHtml($_POST['umur18']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal181']);
        $perk_2 = $dis->validateHtml($_POST['soal182']);
        $perk_3 = $dis->validateHtml($_POST['soal183']);
        $perk_4 = $dis->validateHtml($_POST['soal184']);
        $perk_5 = $dis->validateHtml($_POST['soal185']);
        $perk_6 = $dis->validateHtml($_POST['soal186']);
        $perk_7 = $dis->validateHtml($_POST['soal187']);
        $perk_8 = $dis->validateHtml($_POST['soal188']);
        $perk_9 = $dis->validateHtml($_POST['soal189']);
        $perk_10 = $dis->validateHtml($_POST['soal1810']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave21'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama21']);
        $hp_umur   = $dis->validateHtml($_POST['umur21']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal211']);
        $perk_2 = $dis->validateHtml($_POST['soal212']);
        $perk_3 = $dis->validateHtml($_POST['soal213']);
        $perk_4 = $dis->validateHtml($_POST['soal214']);
        $perk_5 = $dis->validateHtml($_POST['soal215']);
        $perk_6 = $dis->validateHtml($_POST['soal216']);
        $perk_7 = $dis->validateHtml($_POST['soal217']);
        $perk_8 = $dis->validateHtml($_POST['soal218']);
        $perk_9 = $dis->validateHtml($_POST['soal219']);
        $perk_10 = $dis->validateHtml($_POST['soal2110']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave24'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama24']);
        $hp_umur   = $dis->validateHtml($_POST['umur24']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal241']);
        $perk_2 = $dis->validateHtml($_POST['soal242']);
        $perk_3 = $dis->validateHtml($_POST['soal243']);
        $perk_4 = $dis->validateHtml($_POST['soal244']);
        $perk_5 = $dis->validateHtml($_POST['soal245']);
        $perk_6 = $dis->validateHtml($_POST['soal246']);
        $perk_7 = $dis->validateHtml($_POST['soal247']);
        $perk_8 = $dis->validateHtml($_POST['soal248']);
        $perk_9 = $dis->validateHtml($_POST['soal249']);
        $perk_10 = $dis->validateHtml($_POST['soal2410']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave30'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama30']);
        $hp_umur   = $dis->validateHtml($_POST['umur30']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal301']);
        $perk_2 = $dis->validateHtml($_POST['soal302']);
        $perk_3 = $dis->validateHtml($_POST['soal303']);
        $perk_4 = $dis->validateHtml($_POST['soal304']);
        $perk_5 = $dis->validateHtml($_POST['soal305']);
        $perk_6 = $dis->validateHtml($_POST['soal306']);
        $perk_7 = $dis->validateHtml($_POST['soal307']);
        $perk_8 = $dis->validateHtml($_POST['soal308']);
        $perk_9 = $dis->validateHtml($_POST['soal309']);
        $perk_10 = $dis->validateHtml($_POST['soal3010']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave36'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama36']);
        $hp_umur   = $dis->validateHtml($_POST['umur36']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal361']);
        $perk_2 = $dis->validateHtml($_POST['soal362']);
        $perk_3 = $dis->validateHtml($_POST['soal363']);
        $perk_4 = $dis->validateHtml($_POST['soal364']);
        $perk_5 = $dis->validateHtml($_POST['soal365']);
        $perk_6 = $dis->validateHtml($_POST['soal366']);
        $perk_7 = $dis->validateHtml($_POST['soal367']);
        $perk_8 = $dis->validateHtml($_POST['soal368']);
        $perk_9 = $dis->validateHtml($_POST['soal369']);
        $perk_10 = $dis->validateHtml($_POST['soal3610']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave42'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama42']);
        $hp_umur   = $dis->validateHtml($_POST['umur42']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal421']);
        $perk_2 = $dis->validateHtml($_POST['soal422']);
        $perk_3 = $dis->validateHtml($_POST['soal423']);
        $perk_4 = $dis->validateHtml($_POST['soal424']);
        $perk_5 = $dis->validateHtml($_POST['soal425']);
        $perk_6 = $dis->validateHtml($_POST['soal426']);
        $perk_7 = $dis->validateHtml($_POST['soal427']);
        $perk_8 = $dis->validateHtml($_POST['soal428']);
        $perk_9 = $dis->validateHtml($_POST['soal429']);
        // $perk_10 = $dis->validateHtml($_POST['soal4210']);
        $perk_10 = 0;
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave48'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama48']);
        $hp_umur   = $dis->validateHtml($_POST['umur48']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal481']);
        $perk_2 = $dis->validateHtml($_POST['soal482']);
        $perk_3 = $dis->validateHtml($_POST['soal483']);
        $perk_4 = $dis->validateHtml($_POST['soal484']);
        $perk_5 = $dis->validateHtml($_POST['soal485']);
        $perk_6 = $dis->validateHtml($_POST['soal486']);
        $perk_7 = $dis->validateHtml($_POST['soal487']);
        $perk_8 = $dis->validateHtml($_POST['soal488']);
        $perk_9 = $dis->validateHtml($_POST['soal489']);
        // $perk_10 = $dis->validateHtml($_POST['soal4810']);
        $perk_10 = 0;
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave54'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama54']);
        $hp_umur   = $dis->validateHtml($_POST['umur54']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal541']);
        $perk_2 = $dis->validateHtml($_POST['soal542']);
        $perk_3 = $dis->validateHtml($_POST['soal543']);
        $perk_4 = $dis->validateHtml($_POST['soal544']);
        $perk_5 = $dis->validateHtml($_POST['soal545']);
        $perk_6 = $dis->validateHtml($_POST['soal546']);
        $perk_7 = $dis->validateHtml($_POST['soal547']);
        $perk_8 = $dis->validateHtml($_POST['soal548']);
        $perk_9 = $dis->validateHtml($_POST['soal549']);
        $perk_10 = $dis->validateHtml($_POST['soal5410']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave60'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama60']);
        $hp_umur   = $dis->validateHtml($_POST['umur60']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal601']);
        $perk_2 = $dis->validateHtml($_POST['soal602']);
        $perk_3 = $dis->validateHtml($_POST['soal603']);
        $perk_4 = $dis->validateHtml($_POST['soal604']);
        $perk_5 = $dis->validateHtml($_POST['soal605']);
        $perk_6 = $dis->validateHtml($_POST['soal606']);
        $perk_7 = $dis->validateHtml($_POST['soal607']);
        $perk_8 = $dis->validateHtml($_POST['soal608']);
        $perk_9 = $dis->validateHtml($_POST['soal609']);
        $perk_10 = $dis->validateHtml($_POST['soal6010']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave66'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama66']);
        $hp_umur   = $dis->validateHtml($_POST['umur66']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal661']);
        $perk_2 = $dis->validateHtml($_POST['soal662']);
        $perk_3 = $dis->validateHtml($_POST['soal663']);
        $perk_4 = $dis->validateHtml($_POST['soal664']);
        $perk_5 = $dis->validateHtml($_POST['soal665']);
        $perk_6 = $dis->validateHtml($_POST['soal666']);
        $perk_7 = $dis->validateHtml($_POST['soal667']);
        $perk_8 = $dis->validateHtml($_POST['soal668']);
        $perk_9 = $dis->validateHtml($_POST['soal669']);
        $perk_10 = $dis->validateHtml($_POST['soal6610']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

    if (isset($_POST['getSave72'])) {
        $hp_namaanak   = $dis->validateHtml($_POST['nama72']);
        $hp_umur   = $dis->validateHtml($_POST['umur72']);
       
        $kdid = $auth[0]['kd_id'];
        $username = $auth[0]['nama_user'];
        $currentDate = date("Y-m-d");

        $perk_1 = $dis->validateHtml($_POST['soal721']);
        $perk_2 = $dis->validateHtml($_POST['soal722']);
        $perk_3 = $dis->validateHtml($_POST['soal723']);
        $perk_4 = $dis->validateHtml($_POST['soal724']);
        $perk_5 = $dis->validateHtml($_POST['soal725']);
        $perk_6 = $dis->validateHtml($_POST['soal726']);
        $perk_7 = $dis->validateHtml($_POST['soal727']);
        $perk_8 = $dis->validateHtml($_POST['soal728']);
        $perk_9 = $dis->validateHtml($_POST['soal729']);
        $perk_10 = $dis->validateHtml($_POST['soal7210']);
        
        // if (empty($hp_namaanak) || empty($perk_2) || empty($perk_3) || empty($perk_4) || empty($perk_5) || empty($perk_6) || empty($perk_7) || empty($perk_8) || empty($perk_9) || empty($perk_10) ) {
        if (empty($hp_namaanak) || empty($hp_umur) ) {
            $response = ['response'=>'negative','alert'=>'Lengkapi field'];
        }else{
        $perk_total = $perk_1+$perk_2+$perk_3+$perk_4+$perk_5+$perk_6+$perk_7+$perk_8+$perk_9+$perk_10;
                    $value = "'','$kdid','$username','$hp_namaanak','$currentDate',$hp_umur,'$perk_1','$perk_2','$perk_3','$perk_4','$perk_5','$perk_6','$perk_7','$perk_8','$perk_9','$perk_10','$perk_total'";
                    $response = $dis->insert('table_perkembangan',$value,"?page=viewPerkembangan");
        }
    }

  
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
                                <li class="list-inline-item">Data Perkembangan</li>
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
                                    <input type="date" class="form-control form-control-sm" name="tanggallahir" id="tanggallahir" >
                                </div>
                                <hr>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="button" onclick="next();"  name="getSave" class="btn btn-primary"><i class="fa fa-download"></i> Lanjutkan</button>
                                <?php endif ?>
                            </form>
                        </div>
                        </div>
                    </div>
                    <!-- start data  -->
                    <div class="col-md-8" id="tabelperkembangan">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Perkembangan Anak</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                   <thead>
                                       <tr>
                                            <th>Tanggal Cek</th>
                                            <th>Nama Anak</th>
                                            <th>KPSP Umur</th>
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
                                            <td><?= $ds['perk_tanggal'] ?></td>
                                            <td><?= $ds['perk_namaanak'] ?></td>
                                            <td><?= $ds['perk_umur'] ?> Bulan</td>
                                            <td><?= $ds['perk_total'] ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a data-toggle="tooltip" data-placement="top" title="Detail" href="?page=viewPerkembangan&edit&id=<?= $ds['perk_id'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
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
                    <!-- end data  -->
                    <div class="col-md-8" id="formperkembangan" style="display: none;">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Form Perkembangan</strong>
                        </div>
                        <div class="card-body">
                        
                        <div id="ksp3bulan" style="display: none;">
                        <form method="post">
                                <label><b>USIA 3 BULAN</b></label><br>
                                <input type="hidden" name="nama3" id="nama3">
                                <input type="hidden" name="umur3" id="umur3">

                                <label><b>Bayi Terlentangkan</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada waktu bayi terlentang, apakah masing-masing lengan dan tungkai bergerak dengan mudah? Jawaban TIDAK bila salah satu atau kedua tungkai atau lengan bayi bergerak tak terarah/tak terkendali</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal31" name="soal31">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada waktu bayi terlentang apakah ia melihat dan menatap wajah anda?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal32" name="soal32">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah bayi dapat mengeluarkan suara-suara lain (ngoceh) selain menangis?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal33" name="soal33">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada waktu anda mengajak bayi berbicara dan tersenyum, apakah itersenyum kembali kepada anda</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal34" name="soal34">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah bayi suka tertawa keras walau tidak digelitik atau diraba-raba?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal35" name="soal35">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Ambil wool merah, letakkan di atas wajah di depan mata, gerakkan wool dari samping kiri ke kanan kepala. Apakah ia dapat mengikuti gerakan anda dengan menggerakkan kepalanya dari kanan/kiri ke tengah? </label>
                                    <img src="images/perkembangan/3_6.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal36" name="soal36">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Ambil wool merah, letakkan di atas wajah di depan mata, gerakkan wool dari samping kiri ke kanan kepala. Apakah ia dapat mengikuti gerakan anda dengan menggerakkan kepalanya dari satu sisi hampir sampai pada sisi yang lain?</label>
                                    <img src="images/perkembangan/3_7.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal37" name="soal37">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Bayi Telungkupkan</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada waktu bayi telungkup di alas yang datar, apakah ia dapat mengangkat kepalanya seperti pada gambar ini? </label>
                                    <img src="images/perkembangan/3_8.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal38" name="soal38">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        9.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada waktu bayi telungkup di alas yang datar, apakah ia dapat mengangkat kepalanya sehingga membentuk sudut 45˚ seperti pada gambar? </label>
                                    <img src="images/perkembangan/3_9.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal39" name="soal39">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada waktu bayi telungkup di alas yang datar, apakah ia dapat mengangkat kepalanya dengan tegak seperti pada gambar? </label>
                                    <img src="images/perkembangan/3_10.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal310" name="soal310">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])): ?>    
                                <button type="submit" name="getSave3" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp6bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 6 BULAN</b></label><br>
                                <input type="hidden" name="nama6" id="nama6">
                                <input type="hidden" name="umur6" id="umur6">
                                <label><b>Bayi Terlentangkan</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Ambil wool merah, letakkan di atas wajah di depan mata,gerakkan wool dari samping kiri ke kanan kepala. Apakah ia dapat mengikuti gerakan anda dengan menggerakkan kepala sepenuhnya dari satu ke sisi yang lain?</label>
                                    <img src="images/perkembangan/6_1.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal61" name="soal61">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada posisi bayi terlentang, pegang kedua tangannya lalu tarik perlahan-lahan ke posisi duduk. Dapatkah bayi mempertahankan lehernya secara kaku seperti gambar? Jawab TIDAK bila kepala bayi jatuh kembali seperti gambar.</label>
                                    <img src="images/perkembangan/6_2.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal62" name="soal62">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Bayi Telungkupkan</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Ketika bayi telungkup di alas datar, apakah ia dapat mengangkat dada dengan kedua lengannya sebagai penyangga seperti pada gambar? </label>
                                    <img src="images/perkembangan/6_3.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal63" name="soal63">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Bayi dipangku ibunya / pengasuh di tepi meja periksa:</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah bayi mempertahankan posisi kepala dalam keadaan tegak dan stabil? Jawab TIDAK bila kepala bayi cenderung jatuh ke kanan/kiri atau ke dadanya.</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal64" name="soal64">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Sentuhkan pensil di punggung tangan atau ujung jari bayi (jangan meletakkan di attelapak tangan bayi). Apakah bayi dapat menggenggam pensil itu selama beberapa detik?</label>
                                    <img src="images/perkembangan/6_5.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal65" name="soal65">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah bayi mengarahkan matanya pada benda kecil sebesar kacang, kismis atau uang logam? Jawab TIDAK jika ia tidak dapat mengarahkan matanya. </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal66" name="soal66">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah bayi meraih mainan yang diletakkan agak jauh namun masih berada dalam jangkauan tangannya?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal67" name="soal67">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu / Pengasuh :</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pernahkah bayi mengeluarkan suara gembira bernada tinggi atau memekik tetapi bukan menangis? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal68" name="soal68">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pernahkah bayi berbalik paling sedikit dua kali, dari terlentang ke telungkup atau sebaliknya? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal69" name="soal69">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pernahkah anda melihat bayi tersenyum ketika melihat mainan yang lucu, gambar atau binatang peliharaan pada saat ia bermain sendiri?  </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal610" name="soal610">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave6" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp9bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 9 BULAN</b></label><br>
                                <input type="hidden" name="nama9" id="nama9">
                                <input type="hidden" name="umur9" id="umur9">
                                <label><b>Bayi Terlentangkan</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada posisi bayi telentang, pegang kedua tangannya lalu tarik perlahan-lahan ke posisi duduk. Dapatkah bayi mempertahankan lehernya secara kaku seperti gambar di sebelah kiri ? Jawab TIDAK bila kepala bayi jatuh kembali seperti gambar sebelah kanan</label>
                                    <img src="images/perkembangan/9_1.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal91" name="soal91">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Bayi dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Tarik perhatian bayi dengan memperlihatkan wool merah, kemudian jatuh kan ke lantai. Apakah bayi mencoba mencarinya? Misalnya mencari di bawah meja atau di belakang kursi?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal92" name="soal92">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Taruh 2 kubus di atas meja, buat agar bayi dapat memungut masing-masing kubus dengan masing-masing tangan dan memegang satu kubus pada masing-masing tangannya</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal93" name="soal93">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Taruh kismis di atas meja. Dapatkah bayi memungut dengan tangannya benda-benda kecil seperti kismis, kacang-kacangan, potongan biskuit, dengan gerakan miring atau menggerapai seperti gambar ?</label>
                                    <img src="images/perkembangan/9_4.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal94" name="soal94">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan suatu mainan yang dinginkannya di luar jangkauan bayi, apakah ia mencoba mendapatkannya dengan mengulurkan lengan atau badannya?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal95" name="soal95">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu/Pengasuh</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah pernah melihat bayi memindahkan mainan atau kue kering dari satu tangan ke tangan yang lain? Benda-benda panjang seperti sendok atau kerincingan bertangkai tidak ikut dinilai. </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal96" name="soal96">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah bayi dapat makan kue kering sendiri?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal97" name="soal97">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada waktu bayi bermain sendiri dan ibu diam-diam datang berdiri di belakangnya, apakah ia menengok ke belakang seperti mendengar kedatangan anda? Suara keras tidak ikut dihitung. Jawab YA hanya jika anda melihat reaksinya terhadap suara yang perlahan atau bisikan. </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal98" name="soal98">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Bayi dipangku pemeriksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jika anda mengangkat bayi melalui ketiaknya ke posisi berdiri, dapatkah ia menyangga sebagian berat badan dengan kedua kakinya? Jawab YA bila ia mencoba berdiri dan sebagian berat badan tertumpu pada kedua kakinya. </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal99" name="soal99">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Tanpa disangga oleh bantal, kursi atau dinding, dapatkah bayi duduk sendiri selama 60 detik?  </label>
                                    <img src="images/perkembangan/9_10.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal910" name="soal910">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave9" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp12bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 12 BULAN</b></label><br>
                                <input type="hidden" name="nama12" id="nama12">
                                <input type="hidden" name="umur12" id="umur12">
                                <label><b>Bayi dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan pensil di telapak tangan bayi. Coba ambil pensil tersebut dengan perlahan-lahan. Sulitkah anda mendapatkan pensil itu kembali?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal121" name="soal121">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Taruh kismis di atas meja. Dapatkah bayi memungut dengan tangannya benda-benda kecil seperti kismis, kacang-kacangan, potongan biskuit, dengan gerakan miring atau menggerapai seperti gambar ?</label>
                                    <img src="images/perkembangan/12_2.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal122" name="soal122">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Tanpa bantuan,apakah anak dapat mempertemukan dua kubus kecil yang ia pegang?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal123" name="soal123">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Sebut 2-3 kata yang dapat ditiru oleh anak (tidak perlu kata-kata yang lengkap). Apakah ia mencoba meniru menyebutkan kata-kata tadi ?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal124" name="soal124">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu/Pengasuh</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jika anda bersembunyi di belakang sesuatu/di pojok, kemudian muncul dan menghilang secara berulang-ulang di hadapan anak, apakah ia mencari anda atau mengharapkan anda muncul kembali?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal125" name="soal125">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengangkat badannya ke posisi berdiri tanpa bantuan anda? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal126" name="soal126">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat membedakan anda dengan orang yang belum ia kenal? Ia akan menunjukkan sikap malu-malu atau ragu-ragu pada saat permulaan bertemu dengan orang yang belum dikenalnya.</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal127" name="soal127">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat duduk sendiri tanpa bantuan? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal128" name="soal128">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengatakan 2 suku kata yang sama, misalnya: “ma-ma”, “da-da” atau “pa-pa”. Jawab YA  bila ia mengeluarkan salah satu suara tadi. </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal129" name="soal129">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu/Pengasuh</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat berdiri selama 30 detik atau lebih dengan berpegangan pada kursi/meja? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal1210" name="soal1210">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave12" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp15bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 15 BULAN</b></label><br>
                                <input type="hidden" name="nama15" id="nama15">
                                <input type="hidden" name="umur15" id="umur15">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Beri 2 kubus, tanpa bantuan, apakah anak dapat mempertemukan dua kubus kecil yang ia pegang?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal151" name="soal151">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak anak dapat mengambil benda kecil seperti kacang, kismis, atau potongan biskuit dengan menggunakan ibu jari dan jari telunjuk seperti pada gambar ?</label>
                                    <img src="images/perkembangan/15_2.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal152" name="soal152">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu/Pengasuh</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat jalan sendiri atau jalan dengan berpegangan?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal153" name="soal153">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Tanpa bantuan, apakah anak dapat bertepuk tangan atau melambailambai?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal154" name="soal154">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jawab TIDAK bila ia membutuh kan bantuan. Apakah anak dapat mengatakan "papa" ketika ia memanggil/melihat ayahnya, atau mengatakan "mama" jika memanggil/melihat ibunya?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal155" name="soal155">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jawab YA bila anak mengatakan salah satu diantaranya. Apakah anak dapat menunjukkan apa yang diinginkannya tanpamenangis atau merengek? Jawab YA bila ia menunjuk, menarik atau mengeluarkan suara yang menyenangkan </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal156" name="soal156">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Coba berdirikan anak</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat berdiri sendiri tanpa berpegangan selama kira-kira 5 detik?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal157" name="soal157">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat berdiri sendiri tanpa berpegangan selama 30 detik atau lebih? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal158" name="soal158">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Taruh kubus di lantai, tanpa berpegangan atau menyentuh lantai, apakah anak dapat membungkuk untuk memungut kubus di lantai dan kemudian berdiri kembali? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal159" name="soal159">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat berjalan di sepanjang ruangan tanpa jatuh atau terhuyung-huyung? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal1510" name="soal1510">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave15" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp18bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 18 BULAN</b></label><br>
                                <input type="hidden" name="nama18" id="nama18">
                                <input type="hidden" name="umur18" id="umur18">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan kismis diatas meja dekat anak, apakah anak dapat mengambil dengan ibu jari dan telunjuk?</label>
                                    <img src="images/perkembangan/18_1.png"  style="height: 100px;"><br>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal181" name="soal181">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Gelindingkan bola tenis ke arah anak, apakah dapat mengelindingkan
                                        /melempar bola kembali kepada anak?
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal182" name="soal182">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat bertepuk tangan atau melambaikan tangan tanpa bantuan?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal183" name="soal183">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengatakan “papa” ketika melihat atau memanggil ayahnya atau mengatakan “mama” ketika melihat atau memanggil ibunya?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal184" name="soal184">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat menunjukkan apa yang diingikan tanpa menangis atau merengek?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal185" name="soal185">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat minum dari cangkir/gelas sendiri tanpa tumpah? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal186" name="soal186">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Coba berdirikan anak</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat berdiri kira-kira 5 detik tanpa pegangan?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal187" name="soal187">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat berdiri kira kira lebih dari 30 detik tanpa pegangan? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal188" name="soal188">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan kubus di lantai, minta anak memungut, apakah anak dapat memungut dan berdiri kembali tanpa berpegangan? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal189" name="soal189">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Minta anak berjalan sepanjang ruangan, dapatkan ia berjalan tanpa terhunyung/jatuh? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal1810" name="soal1810">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave18" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp21bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 21 BULAN</b></label><br>
                                <input type="hidden" name="nama21" id="nama21">
                                <input type="hidden" name="umur21" id="umur21">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan kismis diatas meja dekat anak, apakah anak dapat mengambil dengan ibu jari dan telunjuk?
                                    <img src="images/perkembangan/21_1.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal211" name="soal211">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Gelindingkan bola tenis ke arah anak, apakah dapat mengelindingkan /melempar bola kembali kepada anak?
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal212" name="soal212">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Beri kubus didepannya. Minta anak meletakkan 1 kubus diatas kubus lainnya (1 tingkat saja)</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal213" name="soal213">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat menunjukkan apa yang diinginkan tanpa menangis atau merengek?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal214" name="soal214">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat minum dari cangkir/gelas sendiri tanpa tumpah?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal215" name="soal215">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak suka meniru bila ibu sedang melakukan pekerjaan rumah tangga (menyapu, mencuci, dll) </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal216" name="soal216">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengucapkan minimal 3 kata yang mempunyai arti (selain kata mama dan papa)?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal217" name="soal217">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak pernah berjalan mundur minimal 5 langkah? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal218" name="soal218">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Coba berdirikan anak</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan kubus di lantai, minta anak memungut, apakah anak dapat memungut dan berdiri kembali tanpa berpegangan? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal219" name="soal219">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Minta anak berjalan sepanjang ruangan, dapatkan ia berjalan tanpa terhunyung/jatuh? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal2110" name="soal2110">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave21" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp24bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 24 BULAN</b></label><br>
                                <input type="hidden" name="nama24" id="nama24">
                                <input type="hidden" name="umur24" id="umur24">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat meletakkan satu kubus di atas kubus yang lain tanpa menjatuhkan kubus itu?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal241" name="soal241">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Tanpa bimbingan, petunjuk, atau bantuan anda, dapatkah anak menunjukdengan benar paling sedikit satu bagian badannya (rambut, mata, hidung, mulut, atau bagian badan yang lain)?
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal242" name="soal242">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak suka meniru bila ibu sedang melakukan pekerjaan rumah tangga (menyapu, mencuci, dll)?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal243" name="soal243">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengucapkan paling sedikit 3 kata yang mempunyai arti selain "papa" dan "mama"?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal244" name="soal244">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak berjalan mundur 5 langkah atau lebih tanpa kehilangan keseimbangan? (Anda mungkin dapat melihatnya ketika anak menarik mainannya)</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal245" name="soal245">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak melepas pakaiannya seperti : Baju, Rok, atau celananya ? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal246" name="soal246">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak berjalan naik tangga sendiri? Jawab YA jika ia naik tanggadengan posisi tegak atau berpegangan pada dinding atau pegangantangga. Jawab TIDAK jika ia naik tangga dengan merangkak atau anda tidak mebolehkan anak naik tangga atau anak harus berpegangan pada seseorang</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal247" name="soal247">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak makan nasi sendiri tanpa banyak tumpah? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal248" name="soal248">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak membantu memungt mainannya sendiri atau membantu mengangkat piring jika diminta? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal249" name="soal249">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Coba berdirikan anak</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan bola tenis di depan kakinya. Apakah dia dapat menendangnytanpa berpegangan pada apapun? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal2410" name="soal2410">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave24" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp30bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 30 BULAN</b></label><br>
                                <input type="hidden" name="nama30" id="nama30">
                                <input type="hidden" name="umur30" id="umur30">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Tanpa bimbingan, petunjuk atau bantuan anda, dapatkah anak menunjuk dengan benar paling sedikit satu bagian badannya (rambut, mata, hidung, mulut, atau bagian badan yang lain)?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal301" name="soal301">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Beri kubus di depannya. Dapatkah anak meletakkan 4 buah kubus satu persatu di atas kubus yang lain tanpa menjatuhkan kubus itu?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal302" name="soal302">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat menyebut 2 diantara gambar-gambar ini tanpa bantuan?
                                    <img src="images/perkembangan/30_3.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal303" name="soal303">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Bila diberi pensil, apakah anak mencoret-coret kertas tanpa bantuan/petunjuk?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal304" name="soal304">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak melepas pakaiannya seperti: baju, rok, atau celananya? (topi dan kaos kaki tidak ikut dinilai).</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal305" name="soal305">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak berjalan naik tangga sendiri? Jawab YA. Jika ia naik tangga dengan posisi tegak atau berpegangan pada dinding atau pegangan tangga Jawab TIDAK. Jika ia naik tangga dengan merangkak atau anda tidak membolehkan anak naik tangga atau anak harus berpegangan pada seseorang.</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal306" name="soal306">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak makan nasi sendiri tanpa banyak tumpah?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal307" name="soal307">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak membantu memungut mainannya sendiri atau membantu mengangkat piring jika diminta? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal308" name="soal308">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak menggunakan 2 kata pada saat berbicara seperti "minta minum", "mau tidur"? "Terimakasih" dan "Dadag" tidak ikut dinilai. </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal309" name="soal309">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Coba berdirikan anak</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan bola tenis didpn kakinya. Dapatkah anak menendang bola kecil (sebesar bola tenis) ke depan tanpa berpegangan pada apapun? Mendorong tidak ikut dinilai. </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal3010" name="soal3010">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave30" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp36bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 36 BULAN</b></label><br>
                                <input type="hidden" name="nama36" id="nama36">
                                <input type="hidden" name="umur36" id="umur36">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Beri kubus di depannya.Dapatkah anak meletakkan 4 buah kubus satu persatu di atas kubus yang lain tanpa menjatuhkan kubus itu? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal361" name="soal361">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat menyebut 2 diantara gambar-gambar ini tanpa bantuan?
                                    <img src="images/perkembangan/36_2.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal362" name="soal362">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Bila diberi pensil, apakah anak mencoret-coret kertas tanpa bantuan/petunjuk?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal363" name="soal363">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Buat garis lurus ke bawah sepanjang sekurang- kurangnya 2.5 cm. Suruh anak menggambar garis lain di samping garis ini. Jawab YA bila ia menggambar garis seperti ini: <img src="images/perkembangan/36_4.png"  style="height: 100px;"><br> Jawab TIDAK bila ia menggambar garis seperti ini: <img src="images/perkembangan/36_4_1.png"  style="height: 100px;"><br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal364" name="soal364">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak menggunakan 2 kata berangkai pada saat berbicara seperti "minta minum", "mau tidur''? "Terimakasih" dan "Dadag" tidak ikut dinilai</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal365" name="soal365">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak mengenakan sepatunya sendiri?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal366" name="soal366">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak mengayuh sepeda roda tiga sejauh sedikitnya 3 meter?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal367" name="soal367">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Coba berdirikan anak</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">lkuti perintah ini dengan seksama. Jangan memberi isyarat dengan telunjuk atau mata pada saat memberikan perintah berikut ini: "Letakkan kertas ini di lantai". "Letakkan kertas ini di kursi". "Berikan kertas ini kepada ibu". </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal368" name="soal368">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak melaksanakan ketiga perintah tadi? Letakkan selembar kertas seukuran buku ini di lantai. Apakah anak dapat melompati bagian lebar kertas dengan mengangkat kedua kakinya secara bersamaan tanpa didahului lari? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal369" name="soal369">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Coba berdirikan anak</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        10.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Beri bola tenis. Minta anak melemparkan kearah dada anda. Dapatkah anak melempar bola lurus ke arah perut atau dada anda dari jarak 1,5 meter? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal3610" name="soal3610">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave36" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp42bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 42 BULAN</b></label><br>
                                <input type="hidden" name="nama42" id="nama42">
                                <input type="hidden" name="umur42" id="umur42">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Beri kubus di depannya. Dapatkah anak meletakkan 8 buah kubus satu persatu di atas yang lain tanpa menjatuhkan kubus tersebut? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal421" name="soal421">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Beri pensil dan kertas. Buatlah lingkaran di atas kertas tersebut.Minta anak menirunya. Dapatkah anak menggambar lingkaran?
                                    <img src="images/perkembangan/42_2.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal422" name="soal422">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu/ Pengasuh</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak mengenakan sepatunya sendiri?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal423" name="soal423">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah  anak   mengayuh  sepeda   roda  tiga  sejauh sedikitnya 3 meter?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal424" name="soal424">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mencuci tangannya sendiri dengan baik setelah makan?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal425" name="soal425">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengikuti peraturan permainan bila bermain dengan teman-temannya? (misal: ular tangga, petak umpet, dll)</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal426" name="soal426">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak mengenakan celana panjang, kemeja, baju atau kaos kaki tanpa di bantu? (Tidak termasuk memasang kancing, gesper atau ikat pinggang)</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal427" name="soal427">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Minta anak untuk Berdiri</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak berdiri satu kaki tanpa berpegangan. Jika perlu tunjukkan caranya dan beri anak anda kesempatan melakukannya 3 kali. Dapatkah ia mempertahankan keseimbangan dalam waktu 2 detik atau lebih? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal428" name="soal428">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan selembar kertas seukuran buku ini di lantai. Apakah anak dapat melompati panjang kertas ini dengan mengangkat kedua kakinya secara bersamaan tanpa didahului lari? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal429" name="soal429">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave42" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp48bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 48 BULAN</b></label><br>
                                <input type="hidden" name="nama48" id="nama48">
                                <input type="hidden" name="umur48" id="umur48">
                                <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak mengayuh sepeda roda tiga sejauh sedikitnya 3 meter? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal481" name="soal481">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Setelah makan, apakah anak mencuci dan mengeringkan tangannya dengan baik sehingga anda tidak perlu mengulanginya?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal482" name="soal482">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <label><b>Tanya Ibu/ Pengasuh</b></label>
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak berdiri satu kaki tanpa berpegangan. Jika perlu tunjukkan caranya dan beri anak Anda kesempatan melakukannya 3 kali. Dapatkah ia mempertahankan keseimbangan dalam waktu 2 detik atau lebih?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal483" name="soal483">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Letakkan selembar kertas seukuran buku ini di lantai. Apakah anak dapat melompati panjang kertas ini dengan mengangkat kedua kakinya secara bersamaan tanpa didahului lari?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal484" name="soal484">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan membantu anak dan jangan menyebut lingkaran. Suruh anak menggambar seperti contoh ini di kertas kosong yang tersedia. Apakah anak dapat menggambar lingkaran?
                                    <img src="images/perkembangan/48_5.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal485" name="soal485">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak meletakkan 8 buah kubuh satu persatu di atas yang lain tanpa menjatuhkan kubus tersebut? Kubus yang digunakan ukuran 2.5 - 5 cm.</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal486" name="soal486">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat bermain petak umpet, ular naga atau permainan lain dimana ia ikut bermain dan mengikuti aturan bermain?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal487" name="soal487">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak mengenakan celana panjang, kemeja, baju atau kaos kaki tanpa di bantu? (Tidak termasuk memasang kancing, gesper atau ikat pinggang)
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal488" name="soal488">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak menyebutkan nama lengkapnya tanpa dibantu? Jawab TIDAK jika ia hanya menyebut sebagian namanya atau ucapannya sulit dimengerti. 
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal489" name="soal489">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave48" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>

                            <div id="ksp54bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 54 BULAN</b></label><br>
                                <input type="hidden" name="nama54" id="nama54">
                                <input type="hidden" name="umur54" id="umur54">
                                <!-- <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak meletakkan 8 buah kubus satu persatu di atas yang lain tanpa menjatuhkan kubus tertentu? Kubus yang digunakan ukuran 2.5 - 5 cm </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal541" name="soal541">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat bermain petak umpet, ular naga atau permainan lain dimana ia ikut bermain dan mengikuti aturan bermain?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal542" name="soal542">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <!-- <label><b>Tanya Ibu/ Pengasuh</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak mengenakan celana panjang, kemeja, baju atau kaos kaki tanpa di bantu? (Tidak termasuk memasang kancing, gesper atau ikat pinggang)</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal543" name="soal543">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak menyebutkan nama lengkapnya tanpa dibantu? Jawab TIDAK jika ia hanya menyebut sebagaian namanya atau ucapannya sulit dimengerti</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal544" name="soal544">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Isi titik-titik di bawah ini dengan jawaban anak. Jangan membantu kecuali mengulangi pertanyaan.<br>"Apa yang kamu lakukan jika kamu kedinginan?".....<br>"Apa yang kamu lakukan jika kamu lapar?".....<br>"Apa yang kamu lakukan jika kamu lelah?".....<br>Jawab YA bila anak menjawab ke 3 pertanyaan tadi dengan benar, bukan dengan gerakan atau isyarat. Jika kedinginan, jawaban yang benar adalah "menggigil",pakai mantel" atau "masuk kedalam rumah".<br>Jika lapar, jawaban yang benar adalah "makan"<br>Jika lelah, jawaban yang benar adalah "mengantuk","tidur","berbaring/tidur-tiduran","istirahat" atau "diam sejenak"</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal545" name="soal545">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengancingkan bajunya atau pakaian boneka?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal546" name="soal546">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak berdiri satu kaki tanpa berpegangan. Jika perlu tunjukkan caranya dan beri anak Anda kesempatan melakukannya 3 kali. Dapatkah ia mempertahankan keseimbangan dalam waktu 6 detik atau lebih?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal547" name="soal547">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan mengoreksi/membantu anak. Jangan menyebut kata "lebih panjang". Perlihatkan gambar kedua garis ini pada anak. Tanyakan:"Mana garis yang leboh panjang?"<br>Minta anak menunjuk garis yang lebih panjang. Setelah anak menunjuk, putar lembar ini dan ulangi pertanyaan tersebut. Setelah anak menunjuk, putar lembar ini lagi dan ulangi pertanyaan tadi. Apakah anak dapat menunjuk garis yang lebih panjang sebanyak 3 kali dengan benar?
                                    <img src="images/perkembangan/54_8.png"  style="height: 100px;"><br>
                                </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal548" name="soal548">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan membantu anak dan jangan memberitahu nama gambar ini, suruh anak menggambar seperti contoh ini di kertas kosong yang tersedia. Berikan 3 kali kesempatan. Apakah anak dapat menggambar seperti contoh ini? 
                                    <img src="images/perkembangan/54_9.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal549" name="soal549">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     10.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Ikuti perintah ini dengan seksama. Jangan memberi isyarat dengan telunjuk atau mata pada saat memberikan perintah berikut ini:<br>
                                    "Letakkan kertas ini di atas lantai".<br>"Letakkan kertas ini di bawah kursi".<br>"Letakkan kertas ini di depan kamu".<br>"Letakkan kertas ini di belakang kamu".<br>Jawab YA hanya jika anak mmengerti arti "di atas","di bawah","di depan" dan "di belakang".</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal5410" name="soal5410">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave54" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>
                            <!-- ----  -->

                            <div id="ksp60bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 60 BULAN</b></label><br>
                                <input type="hidden" name="nama60" id="nama60">
                                <input type="hidden" name="umur60" id="umur60">
                                <!-- <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Isi titik-titik dibawah ini dengan jawaban anak. Jangan membantu kecuali mengulangi pertanyaan.<br>"Apa yang kamu lakukan jika kamu kedinginan?"....<br>"Apa yang kamu lakukan jika kamu lapar?"....<br>"Apa yang kamu lakukan jika kamu lelah?"....<br>Jawab YA bila anak menjawab ke 3 pertanyaan tadi dengan benar, bukan dengan gerakan atau isyarat. Jika kedinginan, jawaban yang benar adalah "menggigil","pakai mantel" atau "masuk kedalam rumah". Jika lapar, jawaban yang beanr adalah "makan". Jika lelah, jawaban yang benar adalah "mengantuk","tidur","berbaring/tidur-tiduran","istirahat" atau "diam sejenak" </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal601" name="soal601">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat mengancingkan bajunya atau pakaian boneka?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal602" name="soal602">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <!-- <label><b>Tanya Ibu/ Pengasuh</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak berdiri satu kaki tanpa berpegangan. Jika perlu tunjukkan caranya dan beri anak anda kesempatan melakukannya 3 kali. Dapatkah ia mempertahankan keseimbangan dalam waktu 6 detik atau lebih?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal603" name="soal603">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan mengoreksi/membantu anak. Jangan menyebut kata "lebih panjang". Perlihatkan gambar kedua garis ini pada anak. Tanyakan: "Mana garis yang lebih panjang?" Minta anak menunjuk garis yang lebih panjang. Setelah anak menunjuk, putar lembar ini dan ulangi pertanyaan tersebut. Stelah anak menunjuk, putar lembar ini lagi dan ulangi pertanyaan tadi. Apakah anak dapat menunjuk garis yanglebih panjang sebanyak 3 kali dengan benar?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal604" name="soal604">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan membantu anak dan jangan memberitahu nama gambar ini, suruh anak menggambar seperti contoh ini di kertas kosong yang tersedia. Berikan 3 kali kesempatan. Apakah anak dapat menggambar seperti contoh ini?
                                    <img src="images/perkembangan/60_5.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal605" name="soal605">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Ikuti perintah ini dengan seksama. Jangan memberi isyarat dengan telunjuk atau mata pada saat ini memberikan perintah berikut ini:<br>"Letakkan kertas ini di atas lantai",<br>"Letakkan kertas ini di bawah kursi",<br>"Letakkan kertas ini di depan kamu"<br>"Letakkan kertas ini di belakang kamu",<br>Jawab YA hanya jika anak mengerti arti "di atas","di bawah","di depan" dan "di belakang".</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal606" name="soal606">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak bereaksi dengan tenang dan tidak rewel (tanpa menangis atau menggelayut pada Anda) pada saat Anda meninggalkannya?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal607" name="soal607">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">
                                    <img src="images/perkembangan/60_8.png"  style="height: 100px;"><br>
                                    Jangan menunjuk, membantu atau membetulkan, katakan pada anak:<br>"Tunjukkan segi empat merah"<br>"Tunjukkan segi empat kuning"<br>"Tunjukkan segi empat biru"<br>"Tunjukkan segi empat hijau"<br> Dapatkah anak menunjuk keempat warna itu dengan benar?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal608" name="soal608">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak melompat dengan satu kaki beberapa kali tanpa berpegangan (lompatan dengan dua kaki tidak ikut dinilai). Apakah ia dapat melompat 2-3 kali dengan satu kaki? </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal609" name="soal609">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     10.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak sepenuhnya berpakaian sendiri tanpa bantuan?</label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal6010" name="soal6010">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave60" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>
                            <!-- ----  -->

                            <div id="ksp66bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 66 BULAN</b></label><br>
                                <input type="hidden" name="nama66" id="nama66">
                                <input type="hidden" name="umur66" id="umur66">
                                <!-- <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan membantu anak dan jangan memberitahu nama gambar ini, suruh anak menggambar bseperti contoh ini di kertas kosong yang tersedia. Berikan 3 kali kesempatan. <br>Apakah anak dapat menggambar seperti contoh ini?
                                    <img src="images/perkembangan/66_1.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal661" name="soal661">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Ikuti perintah ini dengan seksama. Jangan memberi isyarat dengan telunjuk atau mata pada saat memberikan perintah berikut ini:<br>
                                        “Letakan kertas ini di atas lantai”.<br>
                                        “Letakan kertas ini di bawah kursi”.<br>
                                        “Letakan kertas ini di depan kamu”.<br>
                                        “Letakan kertas ini di belakang kamu”.<br>
                                    Jawab YA hanya jika anak mengerti arti “di atas”, “di bawah”, “di depan”, “di belakang”.<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal662" name="soal662">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <!-- <label><b>Tanya Ibu/ Pengasuh</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak bereaksi dengan tenang dan tidak rewel (tanpa menangis atau menggelayut pada anda) pada saat anda meninggalkannya?<br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal663" name="soal663">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan menunjuk, membantu atau membetulkan, katakana pada anak:<br>
                                        “Tunjukkan segi empat merah”<br>
                                        “Tunjukkan segi empat kuning”<br>  
                                        “Tunjukkan segi empat biru”<br>
                                        “Tunjukkan segi empat hijau”<br>
                                    Dapatkah anak menunjuk keempat warna itu dengan benar?
                                    <img src="images/perkembangan/66_4.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal664" name="soal664">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak melompat dengan satu kaki beberapa kali tanpa berpegangan (lompatan degan dua kaki tidak ikut dinilai). <br> Apakah ia dapat melompat 2-3 kali dnegan satu kaki?<br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal665" name="soal665">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak sepenuhnya berpakaian sendiri tanpa bantuan?<br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal666" name="soal666">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">7.	Suruh anak menggambar di tempat kosong yang tersedia. <br> Katakan padanya : “Buatlah gambar orang”.<br>
                                    Jangan memberi perintah lebih dari itu. <br> Jangan bertanya/mengingatkan anak bula ada bagian yang belum tergam-bar. <br> Dalam memberi nilai, hitunglah berapa bagian tubuh yang tergambar.<br> Untuk bagian tubuh yang berpasangan seperti mata, telinga, lengan dan kaki, setiap pasang dinilai satu bagian.<br> Dapatkah anak menggambar sedikitnya 3 bagian tubuh?<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal667" name="soal667">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">8.	Pada gambar orang yang dibuat pada nomor 7, dapatkah anak menggambar sedikitnya 6 bagian tubuh? <br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal668" name="soal668">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">9.	Tulis apa yang dikatakan anak pada kalimat-kalimat yang belum selesai ini, jangan membantu kecuali mengulang pertanyaan:<br>
                                    “Jika kuda besar maka tikus…………………………………..”<br>
                                    “Jika api panas maka es…………………………………………”<br>
                                    “Jika ibu seorang wanita maka ayah seorang………..”<br>
                                    Apakah anak menjawab dengan benar (tikus kecil, es dingin, ayah seorang pria)?<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal669" name="soal669">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     10.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat menangkap bola kecil sebesar bola tenis/bola kasti hanya dengan menggunakan kedua tangannya?<br>
                                    (Bola besar tidak ikut dinilai).<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal6610" name="soal6610">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave66" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>
                            <!-- ----  -->

                            <div id="ksp72bulan" style="display: none;">
                            <form method="post">
                                <label><b>USIA 72 BULAN</b></label><br>
                                <input type="hidden" name="nama72" id="nama72">
                                <input type="hidden" name="umur72" id="umur72">
                                <!-- <label><b>Anak dipangku ibunya/pengasuh di tepi meja periksa</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        1.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan menunjuk, membantu atau membetulkan, katakana pada anak:<br>
                                    “Tunjukkan segi empat merah”<br>
                                    “Tunjukkan segi empat kuning”<br>
                                    “Tunjukkan segi empat biru”<br>
                                    “Tunjukkan segi empat hijau”<br>
                                    Dapatkah anak menunjukan keempat warna itu dengan benar?<img src="images/perkembangan/72_1.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal721" name="soal721">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        2.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak melompat dengan satu kaki beberapa kali tanpa berpegangan (lompatan dengan dua kaki tidak ikut dinilai).<br> 
                                    Apakah ia dapat melompati 2-3 kali dengan satu kaki?<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal722" name="soal722">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <!-- <label><b>Tanya Ibu/ Pengasuh</b></label> -->
                                <div class="row">
                                    <div class="col-md-1">
                                        3.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Dapatkah anak sepenuhnya berpakaian sendiri tanpa bantuab?<br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal723" name="soal723">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        4.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak menggambar di tempat kosong yang tersedia.<br> Katakan padanya: “Buatlah gambar orang”<br>
                                    Jangan memberi perintah lebih dari itu.<br> Jangan bertanya/mengingatkan anak bila ada bagian yang belum tergamb-bar.<br> Dalam meberi nilai, hitunglah berapa bagian tubuh yang tergambar.<br> Untuk bagian tubuh yang berpasangan seperti mata, telinga, lengan dan kaki, setiap pasang dinilai satu bagian.<br> Dapatkah anak menggambar sedikitnya 3 bagiab tubuh?<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal724" name="soal724">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        5.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Pada gambar orang yang dibuat nomor 4, dapatkah anak menggambar sedikitnya 6 bagian tubuh?<br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal725" name="soal725">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        6.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">6.	Tulis apa yang dikatakan anak pada kalimat-kalimat yang belum selesai ini, jangan membantu kecuali mengulang pertanyaan:<br>
                                    “Jika kuda besar maka tikus…………………………………..”<br>
                                    “Jika api panas maka es…………………………………………”<br>
                                    “Jika ibu seorang wanita maka ayah seorang………..”<br>
                                    Apakah anak menjawab dengan benar (tikus kecil, es dingin, ayah seorang pria)?<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal726" name="soal726">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        7.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Apakah anak dapat menangkap bola kecil sebesar bola tenis/bola kasti hanya dengan menggunakan kedua tangannya?<br>
                                    (Bola besar tidak ikut dinilai).<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal727" name="soal727">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                        8.
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Suruh anak berdiri satu kaki tanpa berpegangan.<br> Jika perlu tunjukkan caranya dan beri anak anda kesempatan melakukannya 3 kali.<br> Dapatkah ia mempertahankan keseimbangan dalam waktu 11 detik atau lebih?<br></label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal728" name="soal728">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     9.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">Jangan membantu anak dan jangan memberitahu nama gambar ini, suruh anak menggambar seperti contoh ini di kertas kosong yang tersedia.<br> Berikan 3 kali kesempatan.<br>
                                    Apakah anak dapat menggambar seperti contoh ini?<img src="images/perkembangan/72_9.png"  style="height: 100px;"><br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal729" name="soal729">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-1">
                                     10.   
                                    </div>
                                    <div class="col-md-8">
                                    <label for="">10.	Isi titik-titik di bawah ini dnegan jawaban anak.<br> Jangan membantu kecuali mengulangi pertanyaan samoai 3 kali bila anak menanyakannya.<br>
                                    “Sendok dibuar dari apa?”…………<br>
                                    “Sepatu dibuat dari apa?”………………<br>
                                    “Pintu dibuat dari apa?”…………….<br>
                                    Apakah anak dapat menjawab ke 3 pertanyaan di atas dengan benar? <br>
                                    Sendok dibuat dari besi, baja, plastic, kayu.<br>
                                    Sepatu dibuat dari kulit, karet, kain, plastic, kayu.<br>
                                    Pintu dibuat dari kayu, besi, kaca.<br>
                                    </label>
                                    </div>
                                    <div class="col-md-3">
                                    <select style="width: 120px; text-align: center;" id="soal7210" name="soal7210">
                                        <option>Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                    </div>
                                </div>
                                <hr>

                                <?php if (isset($_GET['edit'])): ?>
                                <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['median'])): ?>    
                                <button type="submit" name="getSave72" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                            </div>
                            <!-- ----  -->

                        </div>
                    </div>
                    </div>
                    <?php endif ?>
                    <?php if (isset($_GET['edit'])): ?>
                        <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Detail Perkembangan Anak</strong>
                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                            <div class="table-responsive">
                               <table  class="table table-borderless table-striped table-earning">
                               <tr>
                                <td style="width: 20px;">Tanggal Cek</td>
                                <td>: <b><?php echo @$editData['perk_tanggal'] ?></b></td>
                               </tr>

                               <tr>
                                <td style="width: 20px;">Nama Anak</td>
                                <td>: <b><?php echo @$editData['perk_namaanak'] ?></b></td>
                               </tr>
                        
                               <tr>
                                <td style="width: 20px;">Umur</td>
                                <td>: <b><?php echo @$editData['perk_umur'] ?> Bulan</b></td>
                               </tr>

                               <tr>
                                <td style="width: 20px;">Total</td>
                                <td>: <b><?php echo @$editData['perk_total'] ?></b></td>
                               </tr>

                               </table>
                            </div>
                           <br>
                           <a href="?page=viewPerkembangan" class="btn btn-danger">Kembali</a>
                           </div>

                           <div class="col-md-5">
                            <center>
                           <img src="images/gambarperkembangan.png"  style="height: 300px;"/>
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
    function next(){
        document.getElementById('formperkembangan').style.display='block';
        document.getElementById('tabelperkembangan').style.display='none';

        var tanggalLahir = document.getElementById('tanggallahir').value;
        var today = new Date();
        var birthDate = new Date(tanggalLahir);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        age = age * 12 + m;

        document.getElementById('ksp3bulan').style.display='none';
        document.getElementById('ksp6bulan').style.display='none';
        document.getElementById('ksp9bulan').style.display='none';
        document.getElementById('ksp12bulan').style.display='none';
        document.getElementById('ksp15bulan').style.display='none';
        document.getElementById('ksp18bulan').style.display='none';
        document.getElementById('ksp21bulan').style.display='none';
        document.getElementById('ksp24bulan').style.display='none';
        document.getElementById('ksp30bulan').style.display='none';
        document.getElementById('ksp36bulan').style.display='none';
        document.getElementById('ksp42bulan').style.display='none';
        document.getElementById('ksp48bulan').style.display='none';
        document.getElementById('ksp54bulan').style.display='none';
        document.getElementById('ksp60bulan').style.display='none';
        document.getElementById('ksp66bulan').style.display='none';
        document.getElementById('ksp72bulan').style.display='none';

        
        if(age>=72){
            document.getElementById('ksp72bulan').style.display='block';
            document.getElementById('nama72').value=document.getElementById('nama').value;
            document.getElementById('umur72').value=72;    
        }else if(age>=66){  
            document.getElementById('ksp66bulan').style.display='block';
            document.getElementById('nama66').value=document.getElementById('nama').value;
            document.getElementById('umur66').value=66;
        }else if(age>=60){
            document.getElementById('ksp60bulan').style.display='block';
            document.getElementById('nama60').value=document.getElementById('nama').value;
            document.getElementById('umur60').value=60;
        }else if(age>=54){
            document.getElementById('ksp54bulan').style.display='block';
            document.getElementById('nama54').value=document.getElementById('nama').value;
            document.getElementById('umur54').value=54;
        }else if(age>=48){
            document.getElementById('ksp48bulan').style.display='block';
            document.getElementById('nama48').value=document.getElementById('nama').value;
            document.getElementById('umur48').value=48;
        }else if(age>=42){
            document.getElementById('ksp42bulan').style.display='block';
            document.getElementById('nama42').value=document.getElementById('nama').value;
            document.getElementById('umur42').value=42;
        }else if(age>=36){
            document.getElementById('ksp36bulan').style.display='block';
            document.getElementById('nama36').value=document.getElementById('nama').value;
            document.getElementById('umur36').value=36;
        }else if(age>=30){
            document.getElementById('ksp30bulan').style.display='block';
            document.getElementById('nama30').value=document.getElementById('nama').value;
            document.getElementById('umur30').value=30;
        }else if(age>=24){
            document.getElementById('ksp24bulan').style.display='block';
            document.getElementById('nama24').value=document.getElementById('nama').value;
            document.getElementById('umur24').value=24;
        }else if(age>=21){
            document.getElementById('ksp21bulan').style.display='block';
            document.getElementById('nama21').value=document.getElementById('nama').value;
            document.getElementById('umur21').value=21;
        }else if(age>=18){
            document.getElementById('ksp18bulan').style.display='block';
            document.getElementById('nama18').value=document.getElementById('nama').value;
            document.getElementById('umur18').value=18;
        }else if(age>=15){
            document.getElementById('ksp15bulan').style.display='block';
            document.getElementById('nama15').value=document.getElementById('nama').value;
            document.getElementById('umur15').value=15;
        }else if(age>=12){
            document.getElementById('ksp12bulan').style.display='block';
            document.getElementById('nama12').value=document.getElementById('nama').value;
            document.getElementById('umur12').value=12;
        }else if(age>=9){
            document.getElementById('ksp9bulan').style.display='block';
            document.getElementById('nama9').value=document.getElementById('nama').value;
            document.getElementById('umur9').value=9;
        }else if(age>=6){
            document.getElementById('ksp6bulan').style.display='block';
            document.getElementById('nama6').value=document.getElementById('nama').value;
            document.getElementById('umur6').value=6;
        }
        // else if(age>=3){
        //     document.getElementById('ksp3bulan').style.display='block';
        //     document.getElementById('nama3').value=document.getElementById('nama').value;
        //     document.getElementById('umur3').value=3;
        // }
        else{
            document.getElementById('ksp3bulan').style.display='block';
            document.getElementById('nama3').value=document.getElementById('nama').value;
            document.getElementById('umur3').value=3;
        }

    }
</script>

