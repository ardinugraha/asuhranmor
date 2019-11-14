<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title?></title>

  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css"/>

  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css"/>

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jQueryUI/jquery-ui.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/sweetalert.css">

  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/pace/pace.min.css">




</head>

<body class="hold-transition skin-red fixed sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="<?= base_url() ?>dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>R</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ASuH</b>RanMor</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li>
              <a href="<?= base_url('login/logout')?>">
                <span class="hidden-xs">Log Out</span>
              </a>
            </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- Sidebar -->
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url()?>assets/dist/img/Avatar2.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('user_irl_name')?></p>
              <p><?php echo $this->session->userdata('user_role_name')?></p>
              
            </div>
            
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" >
            <li class="header">MAIN NAVIGATION</li>
            <!-- Dashboard -->
            <li class="<?php if ($this->uri->segment(1) == 'dashboard'): echo "active"; endif;?>"><a href="<?= base_url()?>dashboard"><i class="fa fa-institution"></i> <span>Dashboard</span></a></li>
            <!-- Data User -->
            <li class="<?php if ($this->uri->segment(1) == 'survei'): echo "active"; endif;?>"><a href="<?= base_url()?>survei"><i class="fa fa-book"></i> <span>Manajemen Laporan Survei</span></a></li>
            <?php if($this->session->userdata('user_role')=='1'):?>
            <li class="<?php if ($this->uri->segment(1) == 'report'): echo "active"; endif;?>"><a href="<?= base_url()?>report"><i class="fa fa-file-text"></i> <span>Hasil Laporan Survei</span></a></li>
            <?php endif;?>
            <!-- Data Guru -->
            <li class="<?php if ($this->uri->segment(1) == 'guru'): echo "active"; endif;?>" ><a href="<?= base_url()?>profil"><i class="fa fa-users"></i> <span>Profil Pengguna</span></a></li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Main Content -->
      <?= $content?>

      <!-- Footer -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2019 <a href="#">Bapenda Jawa Barat</a>.</strong> All rights
        reserved.
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url('assets/plugins/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?= base_url('assets/plugins/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?= base_url() ?>assets/js/sweetalert.min.js"></script>

    <script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/app.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="<?= base_url() ?>assets/plugins/pace/pace.min.js"></script>

    <script src="<?= base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>


    <script src="<?= base_url() ?>assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/daterangepicker/moment.js"></script>
    <script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

    
    <script src="<?= base_url() ?>assets/js/jquery.mask.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.mask.js"></script>


    
    <?php if ($title == "Dashboard | .this.nilaiSiswa"): ?>
      <script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
      <script src="<?= base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
      <script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
      <script src="<?= base_url() ?>assets/plugins/chartjs/Chart.min.js"></script>
      <script src="<?= base_url() ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <?php endif ?>

    

    <script type="text/javascript">
      let save_method;
      let tableSurvei,tableUser, tableGuru, tableMapel, tableSemuaSiswa, tableSiswaKelasVIIA, tableSiswaKelasVIIB, tableSiswaKelasVIIC, tableSiswaKelasVIIIA, tableSiswaKelasVIIIB, tableSiswaKelasVIIIC, tableSiswaKelasIXA, tableSiswaKelasIXB, tableSiswaKelasIXC;
    
      
  </script>

</body>
</html>
