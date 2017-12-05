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
		<?php echo form_open_multipart(site_url('user/dokumen/insertlaporan')); ?>
		<div class="box-body">
			<div class="form-group col-md-6">
				<label>Jenis Prekursor</label>
				<select class="form-control" name="jenis_prekursor">
					<option value="importir">Importir</option>
					<option value="exportir">Exportir</option>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label>Negara Asal</label>
				<input type="text" name="negara_asal" placeholder="Masukkan Negara Asal" class="form-control" value="<?php echo set_value('negara_asal'); ?>" required>
			</div>

			<div class="form-group col-md-6">
				<label>Negara Tujuan</label>
				<input type="text" name="negara_tujuan" placeholder="Masukkan Negara Tujuan" class="form-control" value="<?php echo set_value('negara_tujuan'); ?>" required>
			</div>

			<div class="form-group col-md-6">
				<label>Perusahaan Asal Prekursor</label>
				<input type="text" name="nama_perusahaan_asal" class="form-control" placeholder="Masukkan Perusahaan Asal Prekursor" value="<?php echo set_value('nama_perusahaan_asal'); ?>" required>
			</div>

			<div class="form-group col-md-6">
				<label>Pelabuhan Tujuan</label>
				<input type="text" name="pelabuhan_tujuan" class="form-control" placeholder="Pelabuhan Tujuan" value="<?php echo set_value('pelabuhan_tujuan') ?>" required>
			</div>

			<div class="form-group col-md-6">
				<label>Berat</label>
				<input type="text" name="jumlah_berat" placeholder="Masukkan Berat Massa (satuan: kg)" class="form-control" value="<?php echo set_value('jumlah_berat') ?>" required>
			</div>

			<div class="form-group col-md-12">
				<label>Upload File</label>
				<input type="file" name="berkas_perrekomendasi" required>
			</div>

		</div>

		<div class="box-footer">
			<button type="submit" class="btn btn-primary btn-sm"> Simpan</button>
		</div>
		<?php echo form_close(); ?>
	</div>
</section>