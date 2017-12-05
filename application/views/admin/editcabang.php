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
		<?php echo form_open(site_url('admin/perusahaan/simpancabang')); ?>
		<div class="box-body">
			<div class="form-group col-md-6">
				<input type="text" name="id_cabperusahaan" hidden value="<?php echo $cabang->id_cabperusahaan; ?>">
				<label>Nama Cabang Perusahaan</label>
				<input type="text" name="nama_cabperusahaan" class="form-control" value="<?php echo $cabang->nama_cabperusahaan; ?>" required>

				<label>Nomor Telepon Cabang</label>
				<input type="text" name="nomor_telp_cabperusahaan" class="form-control" value="<?php echo $cabang->nomor_telp_cabperusahaan; ?>">
			</div>
			<div class="form-group col-md-6">
				<label>Alamat Cabang Perusahaan</label>
				<textarea class="form-control" name="alamat_cabperusahaan"><?php echo $cabang->alamat_cabperusahaan; ?></textarea>
			</div>
		</div>

		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-sm"> Perbarui</button>
			<a href="<?php echo site_url('admin/perusahaan/cabang/'.$cabang->id_perusahaan); ?>" class="btn btn-warning btn-sm">Batal</a>
		</div>
		<?php echo form_close(); ?>
	</div>
</section>