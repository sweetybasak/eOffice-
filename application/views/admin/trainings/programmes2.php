<?php $this->load->view('admin/sidebar');
$this->load->view('admin/header'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-select.css">
  <!-- Theme style -->
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
    <?php if($this->session->userdata('officetype') === 'Departmental') { ?>
        <div class="row">
    
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Assign Secretariat Offices</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">

                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal"> <i class="fa fa-plus"></i> Assign Departments</button>
                   
                    <br>
                    
        <table class="table table-striped table-hover table-bordered" id="table" style="width:100%; ">
            <thead class="text-center" style="background-color: #0066ff!important;">
                <tr>
                    <th>#</th>
                    <th>Training Title</th>
                    
                    <th>Departments</th>
                    
                    <th>Action</th>
                </tr>
            </thead>
           
               <tbody>
              
               <?php 
               $count=0;
foreach($departmental as $row) :
  $count++;
 ?>
 <tr>
  <td><?php echo $count; ?></td>
  <td><?php echo $row->title; ?></td>
  <td><?php echo $row->dname; ?></td>
  
  <td>
               
               <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
             </td>
             
 <?php endforeach; ?>
 </tr>

               </tbody>
             
        </table>
    

    <!-- Add New Package Modal -->
    <form action="<?php echo site_url('add/add');?>" method="post">
        <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Assign Departments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Training Title</label>
                    <div class="col-sm-9">

                               <?php $training = $this->Trainings_model->getTrainings1();?>
                               <select name="training" class="form-control" required>
                                    <option value="">Select Training</option>
                                    <?php foreach($training as $value): ?>
                                    <option value="<?php echo $value->id?>"><?php echo $value->title ?></option>
                                    <?php endforeach; ?>
                               </select>
                    </div>
                </div>
                
              <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
               
              </div>
            </div>
          </div>
        </div>
    </form>
    
 
    
     
               
    <!-- Update Package Modal-->

 
    <!-- Delete Package Modal -->
    <form action="<?php echo site_url('add/delete');?>" method="post">
        <div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Delete Departments Assigned</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
                <h4>Are you sure to delete this package?</h4>
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="delete_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success btn-sm">Yes</button>
              </div>
            </div>
          </div>
        </div>
    </form>
  
                    </div>
                </div>
                                    </div>
                                    </div>
                                    <?php } ?>

                <?php if($this->session->userdata('officetype') === 'Directorates') {?>
                  <div class="row">
                <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Assign Directorates</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">

                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal1"> <i class="fa fa-plus"></i> Assign Directorates</button>
                  
                    <br>
                    
        <table class="table table-striped table-hover table-bordered" id="table1" style="width:100%; ">
            <thead class="bg-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Training Title</th>
                    
                    
                    <th>Directorates </th>
                  
                    <th>Action</th>
                   
                </tr>
            </thead>
           
               <tbody>
               
                <?php 
            $count=0;
                  foreach($directorates as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
                
                <td><?php echo $row->directorate; ?></td>
                
              
                <td>
               
                  <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
                </td>
                
               <?php endforeach; ?>
               </tr>
               
               </tbody>
             
        </table>
    </div>
 
    <!-- Add New Package Modal -->
        
            
    <form action="<?php echo site_url('add/add1');?>" method="post">
        <div class="modal fade" id="addNewModal1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Assign Directorates</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Training Title</label>
                    <div class="col-sm-9">

                               <?php $training = $this->Trainings_model->getTrainings2();?>
                               <select name="training" class="form-control" required>
                                    <option value="">Select Training</option>
                                    <?php foreach($training as $value): ?>
                                    <option value="<?php echo $value->id?>"><?php echo $value->title ?></option>
                                    <?php endforeach; ?>
                               </select>
                    </div>
                </div>
               
                              
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
               
              </div>
            </div>
          </div>
        </div>
    </form>
    <form action="<?php echo site_url('add/delete');?>" method="post">
        <div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Delete Departments Assigned</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
                <h4>Are you sure to delete this package?</h4>
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="delete_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success btn-sm">Yes</button>
              </div>
            </div>
          </div>
        </div>
    </form> 
                    </div>
                </div>
                                    </div>
                            <?php }?>
                            
                            <?php if ($this->session->userdata('officetype') === 'District') {
                  # code...
                 ?>
                 <div class="row">
                <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Assign Districts</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">

                   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal2"> <i class="fa fa-plus"></i> Assign Districts</button>
                    
                    <br>
                    
        <table class="table table-striped table-hover table-bordered" id="table2" style="width:100%; ">
            <thead class="bg-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Training Title</th>
                    
                   
                    <th>District</th>
                  
                    <th>Action</th>
                </tr>
            </thead>
           
               <tbody>
               <?php 
               $count=0;
               foreach($districts as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->district; ?></td>
              
                <td>
                    <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
                </td>
               <?php endforeach; ?>
               </tr>
               </tbody>
             
        </table>
    </div>
 
    <!-- Add New Package Modal -->
    
    
    <form action="<?php echo site_url('add/add2');?>" method="post">
        <div class="modal fade" id="addNewModal2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Assign Districts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Training Title</label>
                    <div class="col-sm-9">

                               <?php $training = $this->Trainings_model->getTrainings3();?>
                               <select name="training" class="form-control" required>
                                    <option value="">Select Training</option>
                                    <?php foreach($training as $value): ?>
                                    <option value="<?php echo $value->id?>"><?php echo $value->title ?></option>
                                    <?php endforeach; ?>
                               </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Districts</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="district[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($district->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
 
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
               
              </div>
            </div>
          </div>
        </div>
    </form>

    
             
    
 
 
    <!-- Delete Package Modal -->
    <form action="<?php echo site_url('add/delete');?>" method="post">
        <div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Delete Departments Assigned</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
                <h4>Are you sure to delete this package?</h4>
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="delete_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success btn-sm">Yes</button>
              </div>
            </div>
          </div>
        </div>
    </form>
 
 
                         
                
                    
                    </div>
                </div>
                            </div>
                            <?php }?>
                <?php if($this->session->userdata('officetype') === 'SP Office') { ?>
                  <div class="row">
                <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Assign SP Offices</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
 <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal3"> <i class="fa fa-plus"></i> Assign SPOffice</button><br/>
                   
                    <br>
                    
        <table class="table table-striped table-hover table-bordered" id="table3" style="width:100%; ">
            <thead class="bg-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Training Title</th>
                    <th>SP Office </th>
                    <th>Action</th>
                </tr>
            </thead>
           
               <tbody>
               <?php 
               $count=0;
               foreach($spoffice as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
              
                <td><?php echo $row->spoffice; ?></td>
                <td>
                   <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
                </td>
               <?php endforeach; ?>
               </tr>
               </tbody>
             
        </table>
    </div>
 
    <!-- Add New Package Modal -->
    
    <form action="<?php echo site_url('add/add3');?>" method="post">
        <div class="modal fade" id="addNewModal3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Assign SP Offices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Training Title</label>
                    <div class="col-sm-9">

                               <?php $training = $this->Trainings_model->getTrainings4();?>
                               <select name="training" class="form-control" required>
                                    <option value="">Select Training</option>
                                    <?php foreach($training as $value): ?>
                                    <option value="<?php echo $value->id?>"><?php echo $value->title ?></option>
                                    <?php endforeach; ?>
                               </select>
                    </div>
                </div>
                
              
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-success btn-sm">Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
               
              </div>
            </div>
          </div>
        </div>
    </form>
 
    
 
    
 
 
    <!-- Delete Package Modal -->
    <form action="<?php echo site_url('add/delete');?>" method="post">
        <div class="modal fade" id="DeleteModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Delete Departments Assigned</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
                <h4>Are you sure to delete this package?</h4>
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="delete_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success btn-sm">Yes</button>
              </div>
            </div>
          </div>
        </div>
    </form>
 
 
                                    </div>
                    </div>
                </div>
                            <?php } ?>


            </div>
        </div>
    </section>


    <!-- DataTables -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.bootstrap-select').selectpicker();

            
 
 
            //GET UPDATE
           
            
            
 
 
            //GET CONFIRM DELETE
            $('.delete-record').on('click',function(){
                var id = $(this).data('training');
                $('#DeleteModal').modal('show');
                $('[name="delete_id"]').val(id);
            });

    
          
 
        });
    </script>
</body>
</html>
 

