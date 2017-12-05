<button class="btn btn-info btn-sm" id="detail_dokumen" data-toggle="modal" data-target="#myModalUser" data-id="<?php echo $dokumen->id_perrekomendasi; ?>">
  <i class="fa fa-eye"> Detail</i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Laporan Dokumen</h4>
      </div>

      <div class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;">
            <img src="<?php echo base_url();?>assets/ajax-loader.gif">
        </div>

        <div id="content-profil">
          <div class="row">
            <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th>Nama Perusahaan</th>
                    <td id="nama_perusahaan"></td>
                  </tr>
                  <tr>
                    <th>Jenis Prekursor</th>
                    <td id="jenis_prekursor"></td>
                  </tr>
                  <tr>
                    <th>Asal Perusahaan</th>
                    <td id="nama_perusahaan_asal"></td>
                  </tr>
                  <tr>
                    <th>Negara Asal</th>
                    <td id="negara_asal"></td>
                  </tr>
                  <tr>
                    <th>Pelabuhan Tujuan</th>
                    <td id="pelabuhan_tujuan"></td>
                  </tr>
                  <tr>
                    <th>Berat (Kg)</th>
                    <td id="jumlah_berat"></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
