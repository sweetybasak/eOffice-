<?php $this->load->view('admin/sidebar');
$this->load->view('admin/header'); ?>
<html data-base-url="<?php echo base_url(); ?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
<br>

<script src="<?php echo base_url(); ?>assets/files/governance.js"></script>
<br>

<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Districts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin_home">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Governance Structure</a></li>
              <li class="breadcrumb-item active">District</li>
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
                        <h3 class="card-title w-100 text-center">Details of Nodal Officers</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                    <div class="alert alert-success" id="successmessage"></div>
                    <button class="btn btn-success" onclick="add_course_nodal()"><i class="fas fa-plus"></i> Add Nodal Officer</button>
        <button class="btn btn-default" onclick="reload_table_nodal()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table_nodal" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the District</th>
                                       
                                        <th>Name & Designation of the Nodal Officer</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th style="width:125px; ">Action</th>    
                                    
                                </tr>   
                            </thead>
                            <tbody class="text-center">
                                    
                            </tbody>
                        </table>
                        <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title w-100 text-center">Nodal Officer Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-4">Name of the Nodal Officer</label>
                            <div class="col-md-8">
                                <input name="n_name" placeholder="Enter Name" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Designation</label>
                            <div class="col-md-8">
                                
                                    <select name="designation" class="form-control">
                                        <option value="">No Selected</option>
                                        <?php foreach($designation as $d):?>
                                        <option value="<?php echo $d->name ?>"><?php echo $d->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                               
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">District</label>
                            <div class="col-md-8">
                                
                                    <select name="district" class="form-control">
                                        <option value="">No Selected</option>
                                        <?php foreach($district as $d):?>
                                        <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                               
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Post</label>
                            <div class="col-md-8">
                                
                                    <select name="post" class="form-control">
                                        <option value="">No Selected</option>
                                        <option value="Nodal Officer">Nodal Officer</option>
                                        <option value="Master Trainer">Master Trainer</option>
                                        <option value="EMD Managers">EMD Manager</option>
                                
                                    </select>
                               
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Email</label>
                            <div class="col-md-8">
                              
                            <input name="email" placeholder="Enter Email" class="form-control" type="email" required>
                            
                                
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Phone</label>
                            <div class="col-md-8">
                              
                            <input name="phone" placeholder="Enter Phone" class="form-control" type="text" maxlength="10"required>
                            
                                
                                <span class="help-block"></span>
                            </div>
                        </div>
                      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_nodal()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Details of Master Trainers</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                       <button class="btn btn-default" onclick="reload_table_master()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table_master" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the District</th>
                                        
                                        <th>Name & Designation of the Master Trainers</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        
                                        <th style="width:125px; ">Action</th>    
                                    
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
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Details of EMD Managers</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                     <button class="btn btn-default" onclick="reload_table_emd()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table_emd" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the District</th>
                                        
                                        <th>Name & Designation of the EMD Managers</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        
                                        <th style="width:125px; ">Action</th>    
                                    
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

