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
          <h3 class="box-title">Data Cabang Perusahaan</h3><hr />
          <a href="<?php echo site_url('user/perusahaan/tambahcabang') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Cabang Perusahaan</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama Cabang Perusahaan</th>
              <th>Alamat Perusahaan</th>
              <th>Nomor Telp</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($cabang as $cabang): ?>
              <tr>
                <td><?php echo $i; $i++;?></td>
                <td><?php echo $cabang->nama_cabperusahaan; ?></td>
                <td><?php echo $cabang->alamat_cabperusahaan; ?></td>
                <td>
                  <?php echo $cabang->nomor_telp_cabperusahaan;?>
                </td>
                <td>
                	<a href="<?php echo site_url('user/perusahaan/editcabang/'. $cabang->id_cabperusahaan); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sunting</a>
                	<a href="<?php echo site_url('user/perusahaan/hapuscabang/'.$cabang->id_cabperusahaan); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
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