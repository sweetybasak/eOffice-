<nav class="main-header navbar navbar-expand navbar-dark navbar-light fixed-top bg-primary">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            <?php if ($this->session->userdata('role') === 'Super Admin' ||  
            $this->session->userdata('role') === 'Admin' || 
            $this->session->userdata('role') === 'EMD Managers'  ) { ?>
             
              <a href="<?php echo base_url(); ?>admin_home" class="nav-link">Home</a>
         <?php   }  else {?>
          <a href="<?php echo base_url(); ?>dept_home" class="nav-link">Home</a>
         <?php } ?> 
            </li>
            <li class="nav-item d-none d-sm-inline-block float-left">
                <a href="<?php echo base_url(); ?>login/logout" class="nav-link">Logout</a>
            </li>

            </ul>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>profile" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>Profile
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>logout" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> Logout
            
          </a>
          
          
      </li>
      
    </ul>
  </nav>

      