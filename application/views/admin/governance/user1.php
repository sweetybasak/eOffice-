<?php $this->load->view('admin/sidebar');
$this->load->view('admin/header'); ?>
<!-- DataTables -->
<html data-base-url="<?php echo base_url(); ?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
<br>
<script src="<?php echo base_url(); ?>assets/files/extra1.js"></script>

<br>
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              
              <li class="breadcrumb-item active">Users</li>
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
                        <h3 class="card-title w-100 text-center">Details of Users</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>
                   
                    <div class="card-body">
                    <div class="alert alert-success" id="successmessage2"></div>
                    <button class="btn btn-success" onclick="add_user()"><i class="fas fa-plus"></i> Add Users</button>
        <button class="btn btn-default" onclick="reload_table_user()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table_user">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th scope="col">Name of the User</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Directorate</th>
                                       <th>District</th>
                                       <th>SP Office</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status</th>
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
             
                <h3 class="modal-title w-100 text-center">Add User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-4">Name of the User</label>
                            <div class="col-md-8">
                                <input name="name" placeholder="Name of the User" class="form-control" type="text" required>
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
                                <input name="phone" placeholder="Enter Phone Number" class="form-control" type="number" required maxlength="10">
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
                                <label class="control-label col-md-4">Office Type</label>
                                <div class="col-md-8">
                                <select name="officetype" id="officetype" class="form-control">
                                            <option value=""> No Selected </option>
                                            <option value="Departmental">Departmental</option>
                                            <option value="Directorates">Directorates</option>
                                            <option value="District">District</option>
                                            <option value="SP Office">SP Office</option>
                                </select>
                                <span class="help-block"></span>
                                </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="control-label col-md-4">Office</label>
                            <div class="col-md-8">
                             
                            <select name="office" class="form-control" id="office">
                                        <option value="0">No Selected</option>
                                        
                                    </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Role</label>
                            <div class="col-md-8">
                            <select name="role" class="form-control">
                                        <option value="">No Selected</option>
                                        <?php foreach($role as $d):?>
                                        <option value="<?php echo $d->name ?>"><?php echo $d->name ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-4">Status</label>
                            <div class="col-md-8">
                               <select name="status" class="form-control">
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                      
                      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_user()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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


