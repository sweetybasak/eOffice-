<?php $this->load->view('admin/sidebar');
$this->load->view('admin/header'); ?>
<!-- DataTables -->
<html data-base-url="<?php echo base_url(); ?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
<br>

<script src="<?php echo base_url(); ?>assets/files/extra.js"></script>

<br>
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Directorates/Commissioners</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Extras</a></li>
              <li class="breadcrumb-item active">Directorates/Commissioners</li>
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
                        <h3 class="card-title w-100 text-center">Details of Directorates/Commissionerates</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                    <div class="alert alert-success" id="successmessage"></div>
                    <button class="btn btn-success" onclick="add_directorate()"><i class="fas fa-plus"></i> Add Directorate</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the Directorates</th>
                                        <th>Name of the Department</th>
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
                <h3 class="modal-title w-100 text-center">Directorate Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                    <div class="form-group row">
                    <?php $dept = $this->Organization_model->getDepartment();?>
                            <label class="control-label col-md-4">Department Name</label>
                            
                            <div class="col-sm-8">
                               <select name="dept" class="form-control">
                               
                                    <option value="">No Selected</option>
                                    <?php  foreach($dept as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->dname; ?></option>
                               <?php endforeach; ?>
                               </select>
                               <span class="help-block"></span>
                               </div>
                            </div>
                       
                        <div class="form-group row">
                            <label class="control-label col-md-4">Directorate Name</label>
                            <div class="col-md-8">
                                <input name="directorate" placeholder="Directorate Name" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                      
                      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
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

