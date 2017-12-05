<section class="content">
     <!-- Default box -->
     <div class="box">
       <div class="box-header with-border">
         <?php
           echo validation_errors('<div class="alert alert-warning alert-dismissible">','</div>');
           if(isset($errors)) {
             echo '<div class="alert alert-warning alert-dismissible">';
             echo $errors;
             echo '</div>';
           }
         ?>

         <h3 class="box-title">Tambah Perusahaan</h3>
       </div>
       <?php $attribute = array('role' => 'form'); echo form_open(site_url('admin/perusahaan/tambahperusahaan'), $attribute); ?>
            <div class="box-body">
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
		    </div>
             <!-- /.box-body -->

             <div class="box-footer">
               <button type="submit" class="btn btn-primary" name="submit">Submit</button>
             </div>
           <?php echo form_close(); ?>
       <!-- /.box-body -->
       <div class="box-footer">
       </div>
       <!-- /.box-footer-->
     </div>
     <!-- /.box -->

   </section>
