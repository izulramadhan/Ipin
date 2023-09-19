<?php 
    $pg = new lsp();
    $pegawai = $pg->selectCount("table_user","kd_id");
    $pertumbuhanall = $pg->selectCount("table_hasilpertumbuhan","hp_id");
    $perkembanganall   = $pg->selectCount("table_perkembangan","perk_id");
    $pertumbuhan = $pg->selectCountNow("table_hasilpertumbuhan","hp_id","hp_tanggal");
    $perkembangan   = $pg->selectCountNow("table_perkembangan","perk_id","perk_tanggal");
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
                                            <li class="list-inline-item">Dashboard</li>
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
                    <div class="col-sm-6 col-lg-6">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-assignment"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $pertumbuhan['count'] ?></h2>
                                                <span>Pertumbuhan Per Hari</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-assignment"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $perkembangan['count']; ?></h2>
                                                <span>Perkembangan Per Hari</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-circle"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $pegawai['count'] ?></h2>
                                                <span>Data Pengguna</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart1"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-assignment-check"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $pertumbuhanall['count'] ?></h2>
                                                <span>Jumlah Pertumbuhan</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart3"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-assignment-check"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $perkembanganall['count']; ?></h2>
                                                <span>Jumlah Perkembangan</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart4"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
				</div>
			</div>