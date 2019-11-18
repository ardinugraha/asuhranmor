<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php if($this->session->userdata('user_role')=='1' OR $this->session->userdata('user_role')=='2'): ?>
  <section class="content-header">
    <h1>Dashboard Laporan Survei</h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-navy"><i class="glyphicon glyphicon-book"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Laporan Telah di Terima</span>
            <span class="info-box-number"><?= $surveireported2 ?> Laporan Kegiatan Survei</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-light-blue"><i class="glyphicon glyphicon-file"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Data Survei Telah di Terima</span>
            <span class="info-box-number"><?= $surveidatareported2 ?> Data Survei Kendaraan Bermotor</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- /.col -->
    </div>
  </section>

  <section class="content-header">
    <h1>Rekap tiap Cabang</h1>
  </section>


  <?php endif;?>


  <section class="content-header">
    <h1>Dashboard Kegiatan Survei</h1>
    <?php if($this->session->userdata('user_role')!='1' AND $this->session->userdata('user_role')!='2'): ?>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
    <?php endif;?>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="ion ion-ios-paper"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Laporan Belum di Laporkan</span>
            <span class="info-box-number"><?= $surveinonreported ?> Laporan</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-paper"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Data Survei Belum di Laporkan</span>
            <span class="info-box-number"><?= $surveidatanonreported ?> Data Survei Kendaraan Bermotor</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion ion-ios-paper"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Laporan telah di Laporkan</span>
            <span class="info-box-number"><?= $surveireported ?> Laporan</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="ion ion ion-ios-paper"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Jumlah Data Survei telah di Laporkan</span>
            <span class="info-box-number"><?= $surveidatareported ?> Data Survei Kendaraan Bermotor</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
  </section>


  

  
</div>