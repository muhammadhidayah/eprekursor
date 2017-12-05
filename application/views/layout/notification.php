          <?php  
            $notdokumen    = $this->Dokumen_model->getAllDokumenByStatus("menunggu");
            $notperusahaan = $this->User_model->getUserByStatus("menunggu");
          ?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">
                <?php 
                  if((count($notperusahaan) + count($notdokumen)) != 0) 
                    echo count($notperusahaan) + count($notdokumen); 
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo count($notperusahaan) + count($notdokumen); ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php if (count($notperusahaan) != 0): ?>
                    <li>
                      <a href="<?php echo site_url('admin/perusahaan/confirm') ?>">
                        <i class="fa fa-users text-aqua"></i> <?php echo count($notperusahaan); ?> new members joined
                      </a>
                    </li>
                  <?php endif ?>
                  <?php if (count($notdokumen) != 0): ?>
                    <li>
                      <a href="<?php echo site_url('admin/dokumen/daftarmenunggu') ?>">
                        <i class="fa fa-user text-red"></i> <?php echo count($notdokumen); ?> new document uploaded
                      </a>
                    </li>  
                  <?php endif ?>
                </ul>
              </li>
              <li class="footer"></li>
            </ul>
          </li>
          