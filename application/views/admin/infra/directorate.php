<?php
$this->load->view('admin/sidebar');

$this->load->view('admin/header'); ?>
<html data-base-url="<?php echo base_url(); ?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
<br>
<script src="<?php echo base_url(); ?>assets/files/infra1.js"></script>

<br>
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Infra Assessment of Directorates/Commissioners</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Infra Assessment</a></li>
              <li class="breadcrumb-item active">Directorate/Commissioners</li>
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
                        <h3 class="card-title w-100 text-center"> <i class="fas fa-print"></i> Details of Infra Assessments of Directorates/Commissioners</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">

                    <?php if(!empty($success_msg)){ ?>
    <div class="col-xs-12">
        
        <div class="alert alert-success alert-dismissible" id="successmessage">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <?php echo $success_msg; ?>
              </div>                                 
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
   
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-left">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="fas fa-plus"></i>Add/Edit Details</a>
                <button class="btn btn-default" onclick="reload_table_directorate()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
            </div>
        </div>

  
        <!-- File upload form -->
        <div class="col-md-12" id="importFrm" style="display: none;">
        <?php $directorate = $this->adminInfra_model->getDirectorate();?>
            <form action="<?php echo base_url('AdminInfra/import3'); ?>" method="post" enctype="multipart/form-data">
            <?php if($this->session->userdata('role') === 'Super Admin') {?>
                            <div class="form-group row">
                            <label class="control-label col-md-3">Select Directorate</label>
                            <div class="col-sm-4">
                               <select name="directorate" class="form-control" required>

                               
                                    <option value="">No Selected</option>
                                    <?php  foreach($directorate as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->name; ?></option>
                               <?php endforeach; ?>
                               </select>
                               </div>
                               </div>
                                    <?php } else if($this->session->userdata('role') === 'Admin') {?>
                                      
                            <div class="form-group row">
                            <label class="control-label col-md-3">Select Directorate</label>
                            <div class="col-sm-4">
                               <select name="directorate" class="form-control" required>

                               
                                    <option value="">No Selected</option>
                                    <?php  foreach($director as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->name; ?></option>
                               <?php endforeach; ?>
                               </select>
                               </div>
                               </div>
                                    <?php } else {} ?>
                               <div class="form-group row">
                               <label class="control-label col-md-3">Choose File</label>
                            <div class="col-sm-4">
                      
                <input type="file" name="file" required />
                </div>
                </div>
                <input type="submit" class="btn btn-success" name="importSubmit" value="Submit">
            </form>
        </div>
        </div>
        <br/>
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table_directorate" style="width:20%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the Directorate</th>
                                        <th>Total Users</th>
                                        <th>Users having System</th>
                                        <th>New System Distributed</th>
                                        <th>Users having DSC</th>
                                        <th>Total Scanners</th>
                                        <th>Total Printers</th>
                                        <th>Additional DSC Required </th>
                                        <th>Additional Printer Required</th>
                                        <th>Additional Scanners Required</th>
                                        <th>Additional System Required</th>
                                        <th>ISP</th>
                                        <th>Bandwidth</th>
                                        <th>Structured Cabling</th>
                                        <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin' || $this->session->userdata('role') === 'Departmental Users') {?>
                    <th style="width:125px;">Action</th>
                <?php } ?>                
                               
                                    
                                  
                                       
                                    
                                </tr>   
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                        <!-- Bootstrap modal -->

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


