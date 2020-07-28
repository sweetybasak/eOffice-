<?php 
$this->load->view('admin/sidebar');

$this->load->view('admin/header'); ?>
<!-- DataTables -->
<html data-base-url="<?php echo base_url(); ?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
<br>
<script src="<?php echo base_url(); ?>assets/files/trainingadmin.js"></script>
 
 <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-select.css">
<br>

<br>
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Trainings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Trainings</a></li>
              <li class="breadcrumb-item active">Programmes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <?php if(!($this->session->userdata('role') === 'Departmental Users')) {?>
            <?php  if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('officetype') === 'Departmental') {?>
     
        <div class="row">
        
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h1 class="card-title w-100 text-center"> <i class="fas fa-users"></i> Details of Participants for Departmental Trainings</h1>
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
                   
                      <div class="col-md-12 head">
            <div class="float-left">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="fas fa-plus"></i>Add/Edit Details</a>
                <button class="btn btn-primary" onclick="reload_table()"><i class="icon-refresh"></i>Reload</button>
            </div>
        </div>
        <br />
        <br />
        <div class="col-md-12" id="importFrm" style="display: none;">
     
            <form action="<?php echo base_url('Trainings/importd'); ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group row">
                            <label class="control-label col-md-3">Training</label>
                            <div class="col-sm-4">
                            <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                               <select name="training" class="form-control" required>
                               
                                    <option value="">No Selected</option>
                                    <?php  foreach($training as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                               <?php endforeach; ?>
                               </select>
                                    <?php } else {?>
                                        <select name="training" class="form-control" required>
                               
                               <option value="">No Selected</option>
                               <?php  foreach($departmental as $row): ?>
                               <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                          <?php endforeach; ?>
                          </select>
                               <?php } ?>
                               </div>
                               </div>
                               <div class="form-group row">
                               <label class="control-label col-md-3">Choose File</label>
                            <div class="col-sm-4">
                      
                <input type="file" name="file"  required/>
                </div>
                </div>
                <input type="submit" class="btn btn-success" name="importSubmit" value="Submit">
            </form>
        </div>
        
                        <table class="table table-bordered table-hover table-striped" id="my-table" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the Person</th>
                                       <th>Designation</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Training Title</th>
                                        <th>Type</th>
                                    
                                        <th style="width:125px; ">Action</th>    
                                    
                                </tr>   
                            </thead>
                            <tbody>
                                    
                            </tbody>
                        </table>
                        </div>
                        </div>
                        </div>
                        </div>
                        <!-- Bootstrap modal -->
                        <?php } ?>
                        <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('officetype') === 'Directorates')
     {
         ?>
           <div class="row">
       
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h1 class="card-title w-100 text-center"> <i class="fas fa-users"></i> Details of Participants for Directorates/Commissionerates Trainings</h1>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                    <?php if(!empty($success_msg1)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               
        <?php echo $success_msg1; ?></div>
    </div>
                    <?php } ?>
    <?php if(!empty($error_msg1)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               
        <?php echo $error_msg1; ?></div>
    </div>
    <?php } ?>
                   
        <div class="col-md-12 head">
            <div class="float-left">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm1');"><i class="fas fa-plus"></i>Add/Edit Details</a>
                <button class="btn btn-primary" onclick="reload_table()"><i class="icon-refresh"></i>Reload</button>
            </div>
        </div>
        <br />
        <br />
        <div class="col-md-12" id="importFrm1" style="display: none;">
     
            <form action="<?php echo base_url('Trainings/import1'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                            <label class="control-label col-md-3">Training</label>
                            <div class="col-sm-4">
                            <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                               <select name="training" class="form-control" required>
                               
                                    <option value="">No Selected</option>
                                    <?php  foreach($training1 as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                               <?php endforeach; ?>
                               </select>
                                    <?php } else {?>

                                <select name="training" class="form-control" required>
                               
                               <option value="">No Selected</option>
                               <?php  foreach($directorate1 as $row): ?>
                               <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                          <?php endforeach; ?>
                          </select>
                               <?php } ?>
                               </div>
                               </div>
                               <div class="form-group row">
                               <label class="control-label col-md-3">Choose File</label>
                            <div class="col-sm-4">
                      
                <input type="file" name="file" required />
                </div>
                </div>
                <input type="submit" class="btn btn-success" name="importSubmit1" value="Submit">
            </form>
        </div>
        
                    
        
                        <table class="table table-bordered table-hover table-striped" id="my-table1" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the Person</th>
                                       <th>Designation</th>
                                        <th>Directorates/Commissionerates</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Training Title</th>
                                        <th>Type</th>
                                    
                                        <th style="width:125px; ">Action</th>    
                                    
                                </tr>   
                            </thead>
                            <tbody>
                                    
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
                               <?php } if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('officetype') === 'District') {?>
        <div class="row">
       
       <div class="col-12">
           <div class="card card-dark">
               <div class="card-header">
                   <h1 class="card-title w-100 text-center"> <i class="fas fa-users"></i> Details of Participants for Districts Trainings</h1>
                   <div class="card-tools">
                   
                   <!-- This will cause the card to collapse when clicked -->
                   <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
               </div>
               </div>

               <div class="card-body">
               <?php if(!empty($success_msg2)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               
        <?php echo $success_msg2; ?></div>
    </div>
                    <?php } ?>
    <?php if(!empty($error_msg2)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               
        <?php echo $error_msg2; ?></div>
    </div>
    <?php } ?>
                   
        <div class="col-md-12 head">
            <div class="float-left">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm2');"><i class="fas fa-plus"></i>Add/Edit Details</a>
                <button class="btn btn-primary" onclick="reload_table()"><i class="icon-refresh"></i>Reload</button>
            </div>
        </div>
         <br />
        <br />
        <div class="col-md-12" id="importFrm2" style="display: none;">
     
            <form action="<?php echo base_url('Trainings/import2'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                            <label class="control-label col-md-3">Training</label>
                            <div class="col-sm-4">
                               <select name="training" class="form-control" required>
                               
                                    <option value="">No Selected</option>
                                    
                                    <?php  if($this->session->userdata('role') === 'Super Admin') { 
                                    foreach($training2 as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                               <?php endforeach; ?>
                                    <?php } else { 
                                        foreach($dtraining as $row): ?>
                                        <option value="<?php echo $row->id?>"><?php echo $row->title; ?></option> 
                                        <?php endforeach; } ?>
                               </select>
                               </div>
                               </div>
                               <div class="form-group row">
                               <label class="control-label col-md-3">Choose File</label>
                            <div class="col-sm-4">
                      
                <input type="file" name="file" required />
                </div>
                </div>
                <input type="submit" class="btn btn-success" name="importSubmit2" value="Submit">
            </form>
        </div>
        
   
                   <table class="table table-bordered table-hover table-striped" id="my-table2" style="width:100%; ">
                       <thead class="text-center bg-primary">
                           <tr>
                                   <th>#</th>
                                   <th>Name of the Person</th>
                                  <th>Designation</th>
                                   <th>District</th>
                                   <th>Email</th>
                                   <th>Contact</th>
                                   <th>Training Title</th>
                                   <th>Type</th>
                               
                                   <th style="width:125px; ">Action</th>    
                               
                           </tr>   
                       </thead>
                       <tbody>
                               
                       </tbody>
                   </table>
                   <!-- Bootstrap modal -->

               </div>
           </div>
       </div>
   </div>
                                        <?php }  if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('officetype') === 'SP Office'){?>


   
       <div class="row">
       <div class="col-12">
           <div class="card card-dark">
               <div class="card-header">
                   <h1 class="card-title w-100 text-center"> <i class="fas fa-users"></i> Details of Participants for SP Office Trainings</h1>
                   <div class="card-tools">
                   
                   <!-- This will cause the card to collapse when clicked -->
                   <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
               </div>
               </div>

               <div class="card-body">
               <?php if(!empty($success_msg3)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <?php echo $success_msg3; ?></div>
    </div>
                    <?php } ?>
    <?php if(!empty($error_msg3)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <?php echo $error_msg3; ?></div>
    </div>
    <?php } ?>
                   
        <div class="col-md-12 head">
            <div class="float-left">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm3');"><i class="fas fa-plus"></i>Add/Edit Details</a>
                <button class="btn btn-primary" onclick="reload_table()"><i class="icon-refresh"></i>Reload</button>
            </div>
        </div>
        <br />
        <br />
        <div class="col-md-12" id="importFrm3" style="display: none;">
     
            <form action="<?php echo base_url('Trainings/import3'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                            <label class="control-label col-md-3">Training</label>
                            <div class="col-sm-4">
                               <select name="training" class="form-control" required>
                             
                                    <option value="">No Selected</option>
                                    <?php if($this->session->userdata('role') === 'Super Admin') {
                                     foreach($training3 as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                               <?php endforeach; } else {
                                   foreach($sptraining as $row): ?>
                                   <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                                   <?php endforeach; }?>
                               </select>
                               </div>
                               </div>
                               <div class="form-group row">
                               <label class="control-label col-md-3">Choose File</label>
                            <div class="col-sm-4">
                      
                <input type="file" name="file" required />
                </div>
                </div>
                <input type="submit" class="btn btn-success" name="importSubmit3" value="Submit">
            </form>
        </div>
        
   
                   <table class="table table-bordered table-hover table-striped" id="my-table3" style="width:100%; ">
                       <thead class="text-center bg-primary">
                           <tr>
                                   <th>#</th>
                                   <th>Name of the Person</th>
                                  <th>Designation</th>
                                   <th>SP Office</th>
                                   <th>Email</th>
                                   <th>Contact</th>
                                   <th>Training Title</th>
                                   <th>Type</th>
                               
                                   <th style="width:125px; ">Action</th>    
                               
                           </tr>   
                       </thead>
                       <tbody>
                               
                       </tbody>
                   </table>

               </div>
           </div>
       </div>
   </div>
                                    <?php } if($this->session->userdata('role') === 'Super Admin') {?>

   <div class="row">
       
       <div class="col-12">
           <div class="card card-dark">
               <div class="card-header">
                   <h1 class="card-title w-100 text-center"> <i class="fas fa-users"></i> Details of Participants for Combined Trainings</h1>
                   <div class="card-tools">
                   
                   <!-- This will cause the card to collapse when clicked -->
                   <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
               </div>
               </div>

               <div class="card-body">

               <?php if(!empty($success_msg4)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <?php echo $success_msg4; ?></div>
    </div>
                    <?php } ?>
    <?php if(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <?php echo $error_msg4; ?></div>
    </div>
    <?php } ?>
                   
        <div class="col-md-12 head">
            <div class="float-left">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm4');"><i class="fas fa-plus"></i>Add/Edit Details</a>
                <button class="btn btn-primary" onclick="reload_table()"><i class="icon-refresh"></i>Reload</button>
            </div>
        </div>
         <br />
        <br />
        <div class="col-md-12" id="importFrm4" style="display: none;">
     
            <form action="<?php echo base_url('Trainings/import4'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                            <label class="control-label col-md-3">Training</label>
                            <div class="col-sm-4">
                          
                               <select name="training" class="form-control" required>
                               
                                    <option value="">No Selected</option>
                                    <?php  foreach($training4 as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->title; ?></option>
                               <?php endforeach; ?>
                               </select>
                                    
                               </div>
                               </div>
                               <div class="form-group row">
                               <label class="control-label col-md-3">Choose File</label>
                            <div class="col-sm-4">
                      
                <input type="file" name="file" required />
                </div>
                </div>
                <input type="submit" class="btn btn-success" name="importSubmit4" value="Submit">
            </form>
        </div>
        
   
                   <table class="table table-bordered table-hover table-striped" id="my-table4" style="width:100%; ">
                       <thead class="text-center bg-primary">
                           <tr>
                                   <th>#</th>
                                   <th>Name of the Person</th>
                                  <th>Designation</th>
                                   <th>Department</th>
                                   <th>Directorate</th>
                                   <th>District</th>
                                   <th>SP Office</th>
                                   <th>Email</th>
                                   <th>Contact</th>
                                   <th>Training Title</th>
                                   <th>Type</th>
                               
                                   <th style="width:125px; ">Action</th>    
                               
                           </tr>   
                       </thead>
                       <tbody>
                               
                       </tbody>
                   </table>

             
               </div>
           </div>
       </div>
   </div>
                                    <?php } }?>
            
    </section>


    <!-- DataTables -->
 <!-- DataTables -->
 <script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.js"></script>

 
