<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Profil Pengguna</h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Profil Pengguna</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-user"></i></span>
          <div class="info-box-content">
            <span class="info-box-number"><?php echo $this->session->userdata('user_irl_name'); ?></span>
            <span class="info-box-text"><?php echo $this->session->userdata('user_nip'); ?></span>
            <span class="info-box-text"><?php echo $this->session->userdata('user_name'); ?></span>
            <span class="info-box-text"><?php echo $this->session->userdata('user_role_name'); ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      
    </div>
  </section>

  
</div>