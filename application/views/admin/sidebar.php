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
             <?php if($this->session->userdata('role') === 'Admin') { ?>
            <span class="brand-text font-weight-light">Admin Panel</span>
             <?php } else if($this->session->userdata('role') === 'EMD Managers'){ ?>
                <span class="brand-text font-weight-light">EMD Panel</span>
             
             <?php } else if($this->session->userdata('role') === 'Super Admin'){ ?>
                <span class="brand-text font-weight-light">SuperAdmin </span>
             <?php } else if($this->session->userdata('role') === 'EMD Managers'){ ?>
                <span class="brand-text font-weight-light">User </span>
             <?php } ?>
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
                        <?php if($this->session->userdata('role') === 'Admin' || $this->session->userdata('role') === 'Super Admin') { ?>
                        <a href="<?php echo base_url(); ?>admin_home" class="nav-link active">
                        <?php } else if($this->session->userdata('role') === 'EMD Managers'){ ?>

                        <a href="<?php echo base_url(); ?>emd" class="nav-link active">
                        <?php } else {?>
                            <a href="<?php echo base_url(); ?>deptusers" class="nav-link active">
                        <?php } ?>
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                               
                            </p>
                        </a>
                    </li>
                    <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                    
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="tab">
                        <i class="nav-icon fa fa-hotel"></i>
                            <p>
                                Governance Structure
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>officers" class="nav-link">
                                    <i class="fa fa-university"></i>
                                    <p>
                                        Secretariat Departments
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>district_admin" class="nav-link">
                                    <i class="fa fa-university"></i>
                                    <p>
                                        Districts
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="tab">
                        <i class="nav-icon fa fa-print"></i>
                            <p>
                                Infra Assessment
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <?php  if($this->session->userdata('role') === 'Super Admin') {?>
                          
                          <li class="nav-item">
                         
                                <a href="<?php echo base_url(); ?>infra_secretariat" class="nav-link">
                                
                                    <i class="fa fa-server"></i>
                                    <p>
                                        Secretariat Departments
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>infra_directorate" class="nav-link">
                                
                                <i class="fa fa-keyboard"></i>
                                    <p>
                                        Directorates/Commissioners
                                    </p>
                                </a>
                             
                            
                            <li class="nav-item">
                            
                                <a href="<?php echo base_url(); ?>infra_district" class="nav-link">
                                
                                    <i class="fa fa-laptop-code"></i>
                                    <p>
                                        Districts
                                    </p>
                                </a>
                               
                            </li>
                            <li class="nav-item">
                        
                                <a href="<?php echo base_url(); ?>infra_spoffice" class="nav-link">
                                
                                    <i class="fa fa-laptop-code"></i>
                                    <p>
                                        SP Office
                                    </p>
                                </a>
                               
                            </li>
                            <?php } ?>
                            <?php if($this->session->userdata('role') === 'Admin'|| $this->session->userdata('role') === 'EMD Managers') { ?>
                            
                    <li class="nav-item">
                                <a href="<?php echo base_url(); ?>infra_office" class="nav-link">
                                
                                    <i class="fa fa-laptop-code"></i>
                                    <p>
                                        InfraAssessment Upload
                                    </p>
                                </a>
                                <?php } ?>
                            </li>
                         
                        </ul>
                    </li> 
                
                    <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link" data-toggle="tab">
                            <i class="nav-icon fa fa-poll"></i>
                            <p>
                                Report
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                                <a href="<?php echo base_url(); ?>report_eoffice" class="nav-link">
                                    <i class="fa fa-chart-line nav-icon"></i>
                                    <p>
                                         Statistical Report
                                         
                                    </p>
                                </a>
                               
                                   
                        </li>
                           
                            <li class="nav-item has-treeview">
                                <a href="" class="nav-link">
                                    <i class="fa fa-project-diagram"></i>
                                    <p>
                                        Pendency Report
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                                        <a href="<?php echo base_url(); ?>file_pendency" class="nav-link">
                            <?php }  ?>
                           
                                            <i class="fa fa-chart-pie nav-icon"></i>
                                            <p>File Pendency Report</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                    <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                                
                                        <a href="<?php echo base_url(); ?>receipt_pendency" class="nav-link">
                            <?php }  ?>
                                            <i class="fa fa-chart-area nav-icon"></i>
                                            <p>Receipt Pendency Report</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                            <?php } ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link" data-toggle="tab">
                        <i class="nav-icon fa fa-chalkboard-teacher"></i>
                            <p>
                                Trainings
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') { ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>courses" class="nav-link">
                                    <i class="fa fa-chalkboard"></i>
                                    <p>
                                        Courses
                                    </p>
                                </a>
                            </li>
                        <?php  } ?>
                          <li class="nav-item">
                            <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin' || $this->session->userdata('role') === 'EMD Managers') {?>
                                <a href="<?php echo base_url(); ?>trainings" class="nav-link">
                    <?php } else if($this->session->userdata('role') === 'Departmental Users') { ?>
                        <a href="<?php echo base_url(); ?>trainings_departmental" class="nav-link">
                    <?php } ?>
                                    <i class="fa fa-university"></i>
                                    <p>
                                        Trainings
                                    </p>
                                </a>
                            </li>
                            <?php if(!($this->session->userdata('role') === 'Departmental Users')) {?>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>participants_add" class="nav-link">
                                    <i class="fa fa-laptop-code"></i>
                                    <p>
                                        Participants
                                    </p>
                                </a>
                            </li>
                            <?php } ?>
                   <?php if($this->session->userdata('role') === 'Super Admin'  ) {?>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>programmes" class="nav-link">
                                    <i class="fa fa-laptop-code"></i>
                                    <p>
                                        Programmes
                                    </p>
                                </a>
                            </li>
                   <?php } else {?>
                    <li class="nav-item">
                                <a href="<?php echo base_url(); ?>programmes1" class="nav-link">
                                    <i class="fa fa-laptop-code"></i>
                                    <p>
                                        Programmes
                                    </p>
                                </a>
                            </li>
                   <?php } ?>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?php echo base_url(); ?>emdreport" class="nav-link">
                        <i class="nav-icon fa fa-chalkboard-teacher"></i>
                            <p>
                                EMD Report
                               
                            </p>
                            
                        </a>
                       

                        </li>
                    

                   
                   
                 
                   
                    <?php if($this->session->userdata('role') === 'Super Admin') {?>
                        <li class="nav-header">MISCELLANEOUS</li>
                        
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>users" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="tab">
                                <i class="nav-icon fa fa-university"></i>
                                <p>
                                    Structures
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>department" class="nav-link">
                                    <i class="nav-icon fa fa-hotel"></i>
                                    <p>Departments</p>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a href="<?php echo base_url(); ?>directorate" class="nav-link">
                                    <i class="nav-icon fa fa-hotel"></i>
                                    <p>Directorates/Commissioners</p>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a href="<?php echo base_url(); ?>district" class="nav-link">
                                    <i class="nav-icon fa fa-hotel"></i>
                                    <p>Districts</p>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a href="<?php echo base_url(); ?>spoffice" class="nav-link">
                                    <i class="nav-icon fa fa-hotel"></i>
                                    <p>SP Offices</p>
                                </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link" data-toggle="tab">
                                <i class="nav-icon fa fa-university"></i>
                                <p>
                                    Extras
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a href="<?php echo base_url();?>designation" class="nav-link">
                                    <i class="nav-icon fa fa-hotel"></i>
                                    <p>Designations</p>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a href="<?php echo base_url();?>venue" class="nav-link">
                                    <i class="nav-icon fa fa-hotel"></i>
                                    <p>Venues</p>
                                </a>
                                </li>

                               
                            </ul>
                        </li>
                        <?php } ?>
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