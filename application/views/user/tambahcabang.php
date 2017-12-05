<section class="content">
	<div class="box">
		<div class="box-header">
			<?php
	           echo validation_errors('<div class="alert alert-warning alert-dismissible">','</div>');
	           if(isset($errors)) {
	             echo '<div class="alert alert-warning alert-dismissible">';
	             echo $errors;
	             echo '</div>';
	           }
	         ?>

	        <h3 class="box-title">Edit Cabang Perusahaan</h3>
		</div>
		<?php echo form_open(site_url('user/perusahaan/tambah')); ?>
		<div class="box-body">
			<div class="form-group col-md-6">
				<label>Nama Cabang Perusahaan</label>
				<input type="text" name="nama_cabperusahaan" class="form-control" value="<?php echo set_value('nama_cabperusahaan'); ?>" required>

				<label>Nomor Telepon Cabang</label>
				<input type="text" name="nomor_telp_cabperusahaan" class="form-control" value="<?php echo set_value('nomor_telp_cabperusahaan'); ?>">
			</div>
			<div class="form-group col-md-6">
				<label>Alamat Cabang Perusahaan</label>
				<textarea class="form-control" name="alamat_cabperusahaan"><?php echo set_value('alamat_cabperusahaan'); ?></textarea>
			</div>
		</div>

		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-sm"> Tambah</button>
			<a href="<?php echo site_url('user/perusahaan'); ?>" class="btn btn-warning btn-sm">Batal</a>
		</div>
		<?php echo form_close(); ?>
	</div>
</section>