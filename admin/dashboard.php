<?php 
  $dash = new lsp();
  $dis  = $dash->getCountRows("table_distributor");
  $mer  = $dash->getCountRows("table_merek");
  $bar  = $dash->selectCount("table_barang","kd_barang");

  if ($_SESSION['level'] != "Admin") {
    header("location:../index.php");
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
                                            <li class="list-inline-item">Halaman Utama</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			<div class="main-content">
				<div class="section__content section__content--p30">
					<div class="container-fluid">
					<div class="row" style="margin-top: -30px;">
                            
                            <div class="col-sm-6 col-lg-6" >
                                <div class="overview-item overview-item--c2" style="padding-bottom: 40px;">
                                <a href="?page=viewPertumbuhan">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2>Pertumbuhan</h2>
                                                <!-- <span>Merek</span> -->
                                            </div>
                                            <br>
                                            <center>
                                            <img src="images/gambaranak.png"  style="height: 200px;"/>
                                            </center>
                                        </div>
                                        <!-- <div class="overview-chart"> -->
                                            <!-- <canvas id="widgetChart2"></canvas> -->
                                        <!-- </div> -->
                                    </div>
                                </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="overview-item overview-item--c3">
                                <a href="?page=viewPerkembangan">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix" style="padding-bottom: 40px;">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>Perkembangan</h2>
                                                <!-- <span>Distributor</span> -->
                                            </div>
                                            <br>
                                            <center>
                                            <img src="images/gambarperkembangan.png"  style="height: 200px;"/>
                                            </center>
                                        </div>
                                        <!-- <div class="overview-chart"> -->
                                            <!-- <canvas id="widgetChart3"></canvas> -->
                                           

                                        <!-- </div> -->
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
				</div>
				</div>
			</div>