  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/admin/');?>dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if ($this->session->userdata('id_jenis_user') == 1) {
            echo "Anda Login Sebagai <br /> admin";
          } elseif ($this->session->userdata('id_jenis_user') == 2) {
            echo "Anda Login Sebagai <br /> Kepala Subbid";
          } elseif ($this->session->userdata('id_jenis_user') == 3){
            echo "Anda Login Sebagai <br /> Importir";
          } else {
            echo "Anda Login Sebagai <br /> Exportir";
          }?></p>
          
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li>
          <a href="<?php echo site_url('auth'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <?php if ($this->session->userdata('id_jenis_user') == 1 || 
                  $this->session->userdata('id_jenis_user') == 2): ?>
            <li>
              <a href="<?php echo site_url('admin/perusahaan') ?>">
                <i class="fa fa-list-alt"></i> <span>Perusahaan Terdaftar</span>
                <span class="pull-right-container">
                </span>
              </a>
            </li>

            <li class="active treeview">
              <a href="#">
                <i class="fa fa-folder-open"></i> <span>Dokumen</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url('admin/dokumen') ?>"><i class="fa fa-circle-o"></i>Dokumen Diterima</a></li>
                <li><a href="<?php echo site_url('admin/dokumen/disetujui') ?>"><i class="fa fa-circle-o"></i> Dokumen Disetujui</a></li>
                <li><a href="<?php echo site_url('admin/dokumen/ditolak') ?>"><i class="fa fa-circle-o"></i> Dokumen Ditolak</a></li>
              </ul>
            </li>          
        <?php endif ?>

        <?php if ($this->session->userdata('id_jenis_user') == 3 || 
                  $this->session->userdata('id_jenis_user') == 4): ?>
            <li>
              <a href="<?php echo site_url('user/perusahaan');?>">
                <i class="fa fa-list-alt"></i> <span>Cabang Perusahaan</span>
                <span class="pull-right-container"></span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('user/dokumen') ?>">
                <i class="fa  fa fa-file-pdf-o"></i> <span>Laporan</span>
                <span class="pull-right-container"></span>
              </a>
            </li>
        <?php endif ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>