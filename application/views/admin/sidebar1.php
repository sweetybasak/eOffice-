<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/daterangepicker/daterangepicker.css">

 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed ">
    
        
    <aside class="main-sidebar bg-gradient-grey sidebar-dark-maroon elevation-4 " style="color: black;">
        <a href="#" class="brand-link">
            <img src="<?php echo base_url(); ?>assets/img/eoffice.png" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
           
                <span class="brand-text font-weight-light">Users </span>
             
        </a>

        <!-- sidebar-->
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo base_url(); ?>assets/img/team-1.jpg" alt="User Image" class="img-circle elevation-2">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $this->session->userdata('username'); ?></a>
                </div>
            </div>

            <!--sidebar menu-->
            <nav class="mt-2">
                <ul class="nav nav-child-indent nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                    <li class="nav-item has-treeview menu-open">
                       
                            <a href="<?php echo base_url(); ?>dept_home" class="nav-link active">
                      
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                               
                            </p>
                        </a>
                    </li>
                   
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="tab">
                        <i class="nav-icon fas fa-print"></i>
                            <p>
                                Infra Assessment
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
          
            <a href="<?php echo base_url(); ?>infra_secretariat" class="nav-link">
          
                                    <i class="fas fa-server"></i>
                                    <p>
                                        Secretariat Departments
                                    </p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                           
                               
                                    <a href="<?php echo base_url(); ?>infra_directorate" class="nav-link">
                                    
                                    <i class="fas fa-keyboard"></i>
                                    <p>
                                        Directorates/Commissioners
                                    </p>
                                </a>
      
                            </li>
                                
                         
                        </ul>
                    </li>
                            
              
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link" data-toggle="tab">
                            <i class="nav-icon fas fa-poll"></i>
                            <p>
                                Report
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview">
                             <a href="<?php echo base_url(); ?>report_eoffice" class="nav-link">
                            
                                    <i class="fas fa-chart-line nav-icon"></i>
                                    <p>eOffice Statistical Report</p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin' ||
                            $this->session->userdata('role') === 'EMD Managers') { ?>
                                <a href="<?php echo base_url(); ?>report_eoffice" class="nav-link">
                            <?php } else if($this->session->userdata('role') === 'Departmental Users') { ?>
                                <a href="<?php echo base_url(); ?>report_eoffice_departmental" class="nav-link">
                            <?php }  ?>
                                            <i class="fas fa-chart-line nav-icon"></i> 
                                            <p>Departmental Report</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin' ||
                            $this->session->userdata('role') === 'EMD Managers') { ?>
                                <a href="<?php echo base_url(); ?>report_directorate" class="nav-link">
                            <?php } else if($this->session->userdata('role') === 'Departmental Users') { ?>
                                <a href="<?php echo base_url(); ?>report_eoffice_directorate" class="nav-link">
                            <?php }  ?>
                                            <i class="fas fa-chart-line nav-icon"></i> 
                                            <p>Directorates Report</p>
                                        </a>
                                    </li>
                                   </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="" class="nav-link">
                                    <i class="fas fa-project-diagram"></i>
                                    <p>
                                        Pendency Report
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    
                            <a href="<?php echo base_url(); ?>file_pendency" class="nav-link">
                            
                                            <i class="fas fa-chart-pie nav-icon"></i>
                                            <p>File Pendency Report</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    
                                <a href="<?php echo base_url(); ?>receipt_pendency" class="nav-link">
                            
                                            <i class="fas fa-chart-area nav-icon"></i>
                                            <p>Receipt Pendency Report</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="tab">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>
                                Trainings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        
                          <li class="nav-item">
                           <a href="<?php echo base_url(); ?>trainings" class="nav-link">
                   
                                    <i class="fas fa-university"></i>
                                    <p>
                                        Trainings
                                    </p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                   
                  
                
                   
                    
                            
                </ul>
            </nav>
        </div>

    </aside>
   
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>




<!-- jQuery -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->



<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/daterangepicker/daterangepicker.js"></script>

<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/dist/js/adminlte.js"></script>





</body>
</html>