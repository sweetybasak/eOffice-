<?php 
$this->load->view('admin/sidebar');

$this->load->view('admin/header'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <html data-base-url="<?php echo base_url(); ?>">
  <script src="<?php echo base_url();?>assets/files/eoffice.js" type="text/javascript"></script>
  <style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
  </style>

<br>

<br>
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">eOffice Statistical Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Report</a></li>
              <li class="breadcrumb-item active">eOffice Statistical Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Department Report</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">


                    <?php if(!empty($success_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               
        <?php echo $success_msg; ?></div>
    </div>
                    <?php } ?>
    <?php if(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               
        <?php echo $error_msg; ?></div>
    </div>
    <?php } ?>
	
    <div class="row">
        <!-- Import link -->
        <?php  if($this->session->userdata('role') === 'Super Admin' ) {?>
        <div class="col-md-12 head">
            <div class="float-left">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="fas fa-plus"></i>Add/Edit Details</a>
                <button class="btn btn-primary" onclick="reload_table()"><i class="icon-refresh"></i>Reload</button>
            </div>
        </div>
        <?php } ?>
        <br>
        <br>
        <!-- File upload form -->
        <div class="col-md-12" id="importFrm" style="display: none;">
   
            <form action="<?php echo base_url('Report/import1'); ?>" method="post" enctype="multipart/form-data">
                
                               <div class="form-group row">
                               <label class="control-label col-md-3">Choose File</label>
                            <div class="col-sm-4">
                      
                <input type="file" name="file" required/>
                </div>
                </div>
                <input type="submit" class="btn btn-success" name="importSubmit" value="Submit">
            </form>
        </div>
        </div>
        <br/>
        
                        <table class="table table-bordered table-hover table-striped" id="table" style="width:100%; ">
                        <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3">#</th>
                                       <th rowspan="3">Name of the Department</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                      
                                          
                                          <th style="width: 125px; " rowspan="3"> Action</th>
                                     
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
                                   </tr> 
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Directorate Report</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">


                
	
    
        
                        <table class="table table-bordered table-hover table-striped" id="table1" style="width:100%; ">
                        <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3">#</th>
                                       <th rowspan="3">Name of the Directorate</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                      
                                          
                                         <th style="width: 125px; " rowspan="3"> Action</th>
                                      
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
                                   </tr> 
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">District Report</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">


                
	
    
        
                        <table class="table table-bordered table-hover table-striped" id="table2" style="width:100%; ">
                        <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3">#</th>
                                       <th rowspan="3">Name of the District</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                      
                                          
                                         <th style="width: 125px; " rowspan="3"> Action</th>
                                      
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
                                   </tr> 
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        
            <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">SP Office Report</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">


                
	
    
        
                        <table class="table table-bordered table-hover table-striped" id="table3" style="width:100%; ">
                        <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3">#</th>
                                       <th rowspan="3">Name of the SP Office</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                      
                                          
                                         <th style="width: 125px; " rowspan="3"> Action</th>
                                      
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
                                   </tr> 
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>

        </div>
        </div>

          

          

        
    </section>


    <!-- DataTables -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

