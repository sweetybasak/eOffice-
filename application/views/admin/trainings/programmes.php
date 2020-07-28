


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
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h1 class="card-title w-100 text-center"> <i class="fas fa-university"></i> Details of Trainings</h1>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                    <div class="alert alert-success" id="successmessage"></div>
                     <button class="btn btn-success" onclick="add_programme()"><i class="fas fa-plus"></i> Add Trainings</button>
        <button class="btn btn-default" onclick="reload_table_programme()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table_programme" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Training Title</th>
                                        <th>Course Type</th>
                                        <th>Date of Training</th>
                                        <th>Venue</th>
                                        <th>Type of Training</th>
                                        <th>More Details</th>
                                        
                                        <th style="width:125px; ">Action</th> 
                                      
                                    
                                </tr>   
                            </thead>
                            <tbody>
                                    
                            </tbody>
                        </table>
                        <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h3 class="modal-title w-100 text-center">Add Programme</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-4">Training Title</label>
                            <div class="col-md-8">
                                <input name="title" placeholder="Training Title" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <?php $depvalue = $this->Trainings_model->getCourse(); ?>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Course Type</label>
                            <div class="col-md-8">
                            <select name="course" class="form-control" required>
                                                <option value="">Select Course</option>
                                                <?php foreach($depvalue as $value): ?>
                                                <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="control-label col-md-4">Date of Training</label>
                            <div class="col-md-4">
                                <input name="starting" placeholder="Training Title" class="form-control" type="datetime-local" required>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-4">
                                <input name="ending" placeholder="Training Title" class="form-control" type="datetime-local" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <?php $venue= $this->Trainings_model->getVenue(); ?>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Venue</label>
                            <div class="col-md-8">
                            <select name="venue" class="form-control" required>
                                                <option value="">Select Venue</option>
                                                <?php foreach($venue as $value): ?>
                                                <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <?php $type = $this->Trainings_model->getType();
                       
                        ?>

                        <?php if($this->session->userdata('role') === 'Super Admin') {?>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Type of Training</label>
                            <div class="col-md-8">
                            <select name="type" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <?php foreach($type as $value): ?>
                                                <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                                                <?php } ?>
                              
                        <div class="form-group row">
                            <label id="label-files" class="control-label col-md-4">Upload More Details</label>
                            <div class="col-md-8">
                                <input type="file" name="files">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_programme()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                    </div>
                </div>
            </div>
      </div>
        
                

            </div>
        </div>
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


