<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <?php
            if($this->session->flashdata('sukses')) {
              echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Sukses!</h4>';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }
          ?>
          <h3 class="box-title">Data Perusahaan</h3> <br />
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama Perusahaan</th>
              <th>Jenis Perusahaan</th>
              <th>Email</th>
              <th>Tanggal Daftar</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($perusahaan as $perusahaan): ?>
              <tr>
                <td><?php echo $i; $i++;?></td>
                <td><?php echo $perusahaan->nama_perusahaan; ?></td>
                <td><?php echo $perusahaan->jenis_user; ?></td>
                <td>
                  <?php echo $perusahaan->email_perusahaan;?>
                </td>
                <td>
                  <?php echo $perusahaan->tanggal_daftar;?>
                </td>
                <td>
                	<a href="<?php echo site_url('admin/perusahaan/doconfirm/'.$perusahaan->id_user.'/'.$perusahaan->id_perusahaan.'/aktif'); ?>" class="btn btn-info btn-sm"><i class="fa fa-check"></i> Setujui</a>
                	<a href="<?php echo site_url('admin/perusahaan/doconfirm/'.$perusahaan->id_user.'/'.$perusahaan->id_perusahaan.'/hapus') ?>" class="btn btn-warning btn-sm"><i class="fa fa-close"></i> Tolak</a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>