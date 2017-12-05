
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="box">
  <div class="register-logo">
    <a href="<?php echo site_url('auth')?>">Badan Narkotika Nasional</a>
  </div>
  	<div class="box-header with-border">
         <?php
           echo validation_errors('<div class="alert alert-warning alert-dismissible">','</div>');
           if(isset($errors)) {
             echo '<div class="alert alert-warning alert-dismissible">';
             echo $errors;
             echo '</div>';
           }
         ?>

         <?php
            if($this->session->flashdata('sukses')) {
              echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4>';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }
          ?>

         <h3 class="box-title">Registrasi Perusahaan</h3>
    </div>
    <div class="box-body">
    <form action="<?php echo site_url('register/doregister'); ?>" method="post">
      <div class="form-group col-md-6">
      	<label>Nama Perusahaan<p class="penting">*</p></label>
        <input type="text" class="form-control" value="<?php echo set_value('nama_perusahaan') ?>" placeholder="Nama Perusahaan" name="nama_perusahaan" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Bidang Usaha<p class="penting">*</p></label>
        <input type="text" class="form-control" value="<?php echo set_value('bidang_usaha') ?>" placeholder="Bidang Usaha" name="bidang_usaha" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Jenis Barang <p class="penting">*</p></label>
        <input type="text" class="form-control" value="<?php echo set_value('jenis_barang') ?>" placeholder="Jenis Barang" name="jenis_barang" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Penanggung Jawab<p class="penting">*</p></label>
      	<input type="text" name="penanggung_jawab" value="<?php echo set_value('penanggung_jawab') ?>" class="form-control" placeholder="Penanggung Jawab" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Jenis</label>
      	<select name="jenis_user" class="form-control" required>
      		<option value="3">Importir</option>
      		<option value="4">Exportir</option>
      	</select>
      </div>
      <div class="form-group col-md-6">
      	<label>Nomor SIUP<p class="penting">**</p></label>
      	<input type="text" name="nomor_siup" value="<?php echo set_value('nomor_siup') ?>" class="form-control" placeholder="Masukkan Nomor SIUP" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Nomor APIU<p class="penting">**</p></label>
      	<input type="text" name="nomor_apiu" value="<?php echo set_value('nomor_apiu') ?>" class="form-control" placeholder="Masukkan Nomor API Umum" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Nomor TDP<p class="penting">**</p></label>
      	<input type="text" name="nomor_tdp" value="<?php echo set_value('nomor_tdp') ?>" class="form-control" placeholder="Masukan Nomor Tanda Daftar Perusahaan" required>
      </div>
      <div class="form-group col-md-6">
      	<label>NPWP<p class="penting">**</p></label>
      	<input type="text" class="form-control" value="<?php echo set_value('nomor_npwp') ?>" name="nomor_npwp" placeholder="Masukkan Nomor Pokok Wajib Pajak" required>
      </div>

      <div class="form-group col-md-6">
      	<label>Alamat Perusahaan<p class="penting">*</p></label>
      	<input type="text" name="alamat_perusahaan" value="<?php echo set_value('alamat_perusahaan') ?>" class="form-control" placeholder="Masukkan Alamat Perusahaan" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Provinsi<p class="penting">*</p></label>
      	<select name="provinsi_perusahaan" class="form-control" required>
      		<?php foreach($provinsi as $provinsi):?>
      			<option value="<?php echo $provinsi->id_provinsi;?>">
      				<?php echo $provinsi->nama_provinsi; ?>
      			</option>
      		<?php endforeach; ?>
      	</select>
      </div>
      <div class="form-group col-md-6">
      	<label>Kota <p class="penting">*</p></label>
      	<input type="text" name="kota_perusahaan" value="<?php echo set_value('kota_perusahaan') ?>" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Kode Pos <p class="penting">**</p></label>
      	<input type="text" name="kodepos_perusahaan" value="<?php echo set_value('kodepos_perusahaan') ?>" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Email <p class="penting">*</p></label>
      	<input type="email" name="email_perusahaan" value="<?php echo set_value('email_perusahaan') ?>" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Nomor Telepon <p class="penting">**</p></label>
      	<input type="text" name="telepon_perusahaan" value="<?php echo set_value('telepon_perusahaan') ?>" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Username <p class="penting">*</p></label>
      	<input type="text" name="username_login" value="<?php echo set_value('username_login') ?>" class="form-control" required>
      </div>
      <div class="form-group col-md-6">
      	<label>Password <p class="penting">*</p></label>
      	<input type="password" name="password_login" value="<?php echo set_value('password_login') ?>" class="form-control" required>
      </div>
      <div class="col-md-12">
      	<input type="submit" name="Daftar" value="Daftar" class="btn btn-primary btn-sm">
      	<a href="<?php site_url('auth'); ?>" class="btn btn-warning btn-sm">Batal</a>
      </div>
    </form>
    </div>
</div>
  <!-- /.form-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/admin/')?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/admin/')?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
