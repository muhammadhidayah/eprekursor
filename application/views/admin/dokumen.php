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
          <h3 class="box-title">Data Dokumen</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama Perusahaan</th>
              <th>Jenis Prekusor</th>
              <th>Negara Asal</th>
              <th>Tujuan</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($dokumen as $dokumen): ?>
              <tr>
                <td><?php echo $i; $i++;?></td>
                <td><?php echo $dokumen->nama_perusahaan; ?></td>
                <td><?php echo $dokumen->jenis_prekursor; ?></td>
                <td>
                  <?php echo $dokumen->negara_asal;?>
                </td>
                <td>
                  <?php echo $dokumen->pelabuhan_tujuan;?>
                </td>
                <td><?php echo $dokumen->status_perrekomendasi; ?></td>
                <td>
                	<?php include 'modaldetaildokumen.php'; ?>
                	<a href="<?php echo site_url('admin/dokumen/download/'. $dokumen->id_perrekomendasi); ?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a>
                	<?php if($dokumen->status_perrekomendasi == "menunggu"): ?>
                		<a href="<?php echo site_url('admin/dokumen/updatestatus/'.$dokumen->id_perrekomendasi.'/'.'Diterima') ?>" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i> Terima</a>
                		<a href="<?php echo site_url('admin/dokumen/updatestatus/'.$dokumen->id_perrekomendasi.'/'.'Ditolak') ?>" class="btn btn-warning btn-sm"> <i class="fa fa-close"></i> Tolak</a>
                	<?php endif; ?>
                	<?php if ($dokumen->status_perrekomendasi == "Diterima"): ?>
                		<a href="<?php echo site_url('admin/dokumen/updatestatus/'.$dokumen->id_perrekomendasi.'/'.'Ditolak') ?>" class="btn btn-warning btn-sm"> <i class="fa fa-close"></i> Tolak</a>
                	<?php endif ?>
                	<?php if ($dokumen->status_perrekomendasi == "Ditolak"): ?>
                		<a href="<?php echo site_url('admin/dokumen/updatestatus/'.$dokumen->id_perrekomendasi.'/'.'Diterima') ?>" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i> Terima</a>
                	<?php endif ?>
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

<script>
  $(document).ready(function(){

    $(document).on('click', '#detail_dokumen', function(e){
      e.preventDefault();
      var uid = $(this).data('id');

      $('#content-profil').hide();
      $('#modal-loader').show();

      $.ajax({
        url: '<?php echo site_url('admin/dokumen/detaildokumen/') ?>'+uid,
        type: 'POST',
        data: 'id='+uid,
        dataType: 'json'
      })
      .done(function(data){
        console.log(data);
        $('#content-profil').hide();
        $('#content-profil').show();
        $('#modal-loader').hide();

        $('#nama_perusahaan').html(data.nama_perusahaan);
        $('#jenis_prekursor').html(data.jenis_prekursor);
        $('#nama_perusahaan_asal').html(data.nama_perusahaan_asal);
        $('#negara_asal').html(data.negara_asal);
        $('#pelabuhan_tujuan').html(data.pelabuhan_tujuan);
        $('#jumlah_berat').html(data.jumlah_berat);
      })
      .fail(function(){
        $('.modal-body').html('<i class="fa fa-info"></i> Something went wrong, Please try again...');
      });

    });

  });
</script>