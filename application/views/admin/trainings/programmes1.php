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
        <div class="row">
        <?php if(!($this->session->userdata('role') === 'Departmental Users' || $this->session->userdata('role') === 'EMD Managers')) { ?>
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
            <thead class="bg-primary text-center">
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
               if($this->session->userdata('role') === 'Super Admin') {
               foreach($all as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->dname; ?></td>
                
                <td>
                  <a href="#" class="btn btn-info btn-sm update-record" data-training="<?php echo $row->training?>"data-dept="<?php echo $row->dname?>"> <i class="fa fa-edit fa-lg"></i> </a>
                  <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
                </td>
               <?php endforeach; ?>
               </tr>
               <?php } else {

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
<?php } ?>
               </tbody>
             
        </table>
    </div>
 
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
                <?php if($this->session->userdata('role') === 'Super Admin') {?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="dept[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($dept->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->dname;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } ?>
 
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
    <form action="<?php echo site_url('add/update');?>" method="post">
        <div class="modal fade" id="UpdateModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Update Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
              
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings" name="dept_edit[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($dept->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->dname;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="edit_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
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
                            <?php } ?>
                            

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
              if( $this->session->userdata('role') === 'Super Admin') {
               foreach($all1 as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
                
                <td><?php echo $row->directorate; ?></td>
                
              
                <td>
                <?php if(!($this->session->userdata('role') === 'EMD Managers')) {?>
                  <a href="#" class="btn btn-info btn-sm update-record1" data-training="<?php echo $row->training?>"data-directorate="<?php echo $row->directorate?>"> <i class="fa fa-edit fa-lg"></i> </a>
                  <?php } ?>
                  <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
                </td>
                
               <?php endforeach; ?>
               </tr>
                <?php } else { 
                  foreach($directorates as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
                
                <td><?php echo $row->directorate; ?></td>
                
              
                <td>
                <?php if(!($this->session->userdata('role') === 'EMD Managers')) {?>
                  <a href="#" class="btn btn-info btn-sm update-record1" data-training="<?php echo $row->training?>"data-directorate="<?php echo $row->directorate?>"> <i class="fa fa-edit fa-lg"></i> </a>
                  <?php } ?>
                  <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
                </td>
                
               <?php endforeach; ?>
               </tr>
                <?php } ?>
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
                <?php if($this->session->userdata('role') === 'Super Admin') {?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Directorates</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="directorate[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($directorate->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } else if($this->session->userdata('role') === 'Admin'){ ?>
                              <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Directorates</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="directorate[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($directorate1->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } else {}?>
                              
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
    <form action="<?php echo site_url('add/update1');?>" method="post">
        <div class="modal fade" id="UpdateModal1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Update Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
              <?php if($this->session->userdata('role') === 'Super Admin') {?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Directorate</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings" name="directorate_edit[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($directorate->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } else {?>
                              <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Directorate</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings" name="directorate_edit[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($directorate1->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } ?>    
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="edit_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
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
                <?php if ($this->session->userdata('role') === 'Super Admin') {
                  # code...
                 ?>
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
               foreach($all2 as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->district; ?></td>
              
                <td>
                  <a href="#" class="btn btn-info btn-sm update-record2" data-training="<?php echo $row->training?>" data-district="<?php echo $row->district?>"> <i class="fa fa-edit fa-lg"></i> </a>
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

    
             
    
 
    <!-- Update Package Modal-->
    <form action="<?php echo site_url('add/update2');?>" method="post">
        <div class="modal fade" id="UpdateModal2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Update Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
              
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Districts<label>
                    <div class="col-sm-10">
                        <select class="bootstrap-select strings" name="district_edit[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($district->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="edit_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
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
               foreach($all3 as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
              
                <td><?php echo $row->spoffice; ?></td>
                <td>
                  <a href="#" class="btn btn-info btn-sm update-record3" data-training="<?php echo $row->training?>"data-spoffice="<?php echo $row->spoffice?>"> <i class="fa fa-edit fa-lg"></i> </a>
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
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SPOffice</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="spoffice[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($spoffice->result() as $row) :?>
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
 
    
 
    <!-- Update Package Modal-->
    <form action="<?php echo site_url('add/update3');?>" method="post">
        <div class="modal fade" id="UpdateModal3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Update Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
              
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SP Office</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings" name="spoffice_edit[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($spoffice->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
 
              </div>
              <div class="modal-footer">
                <input type="hidden" name="edit_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
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
                            <?php } ?>
<div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title w-100 text-center">Assign Offices</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                    <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {?>
 <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewModal4"> <i class="fa fa-plus"></i> Assign SPOffice</button><br/>
                    <?php } ?>
                    <br>
                    
        <table class="table table-striped table-hover table-bordered" id="table4" style="width:100%; ">
            <thead class="bg-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Training Title</th>
                    <th>Departments</th>
                    <th>Directorates</th>
                    <th>Districts</th>
                    <th>SP Office </th>
                    <?php if($this->session->userdata('role') === 'Super Admin') {?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
           
               <tbody>
               <?php 
               $count=0;
               foreach($total as $row) :
                $count++;
               ?>
               <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->dname; ?></td>
                <td><?php echo $row->directorate;?></td>
                <td><?php echo $row->district; ?></td>
                <td><?php echo $row->spoffice; ?></td>
                <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                <td>
                  <a href="#" class="btn btn-info btn-sm update-record4" data-training="<?php echo $row->training?>"data-directorate="<?php echo $row->directorate?>"data-district="<?php echo $row->district?>" data-spoffice="<?php echo $row->spoffice?>"> <i class="fa fa-edit fa-lg"></i> </a>
                  <a href="#" class="btn btn-danger btn-sm delete-record" data-training="<?php echo $row->training ?>"> <i class="fa fa-trash fa-lg"></i> </a>
                </td>
                <?php } ?>
               <?php endforeach; ?>
               </tr>
               </tbody>
             
        </table>
    </div>
 
    <!-- Add New Package Modal -->
    
    <form action="<?php echo site_url('add/add4');?>" method="post">
        <div class="modal fade" id="addNewModal4" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Assign Offices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
 
 
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Training Title</label>
                    <div class="col-sm-9">

                               <?php $training = $this->Trainings_model->getTrainings5();?>
                               <select name="training" class="form-control" required>
                                    <option value="">Select Training</option>
                                    <?php foreach($training as $value): ?>
                                    <option value="<?php echo $value->id?>"><?php echo $value->title ?></option>
                                    <?php endforeach; ?>
                               </select>
                    </div>
                </div>
                <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="dept[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($dept->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->dname;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } ?>
                            <?php if($this->session->userdata('role') === ' Super Admin') { ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Directorates</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="directorate[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($directorate->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } else { ?>
                              <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Directorates</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="directorate[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($directorate1->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } ?>
                            <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">District</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="district[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($district->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SPOffice</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select" name="spoffice[]" data-width="100%" data-live-search="true" multiple required>
                            <?php foreach ($spoffice->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                            <?php } ?>
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
    <form action="<?php echo site_url('add/update4');?>" method="post">
        <div class="modal fade" id="UpdateModal4" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Update Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
              
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings" name="dept_edit[]" data-width="100%" data-live-search="true" multiple >
                            <?php foreach ($dept->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->dname;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Directorates</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings1" name="directorate_edit[]" data-width="100%" data-live-search="true" multiple >
                            <?php foreach ($directorate->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">District</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings2" name="district_edit[]" data-width="100%" data-live-search="true" multiple >
                            <?php foreach ($district->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">SPOffice</label>
                    <div class="col-sm-9">
                        <select class="bootstrap-select strings3" name="spoffice_edit[]" data-width="100%" data-live-search="true" multiple>
                            <?php foreach ($spoffice->result() as $row) :?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="edit_id" required>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
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
            $('.update-record').on('click',function(){
                var id = $(this).data('training');
                var dept = $(this).data('dept');
                $(".strings").val('');
                $('#UpdateModal').modal('show');
                $('[name="edit_id"]').val(id);
                $('[name="dept_edit"]').val(dept);
                //AJAX REQUEST TO GET SELECTED PRODUCT
                $.ajax({
                    url: "<?php echo site_url('add/get_product_by_package');?>",
                    method: "POST",
                    data :{id:id},
                    cache:false,
                    success : function(data){
                        var item=data;
                        var val1=item.replace("[","");
                        var val2=val1.replace("]","");
                        var values=val2;
                        $.each(values.split(","), function(i,e){
                            $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings").selectpicker('refresh');
 
                        });
                    }
                     
                });
                return false;
            });
            
            $('.update-record1').on('click',function(){
                var id = $(this).data('training');
                var directorate = $(this).data('directorate');
                $(".strings").val('');
                $('#UpdateModal1').modal('show');
                $('[name="edit_id"]').val(id);
                $('[name="directorate_edit"]').val(directorate);
                //AJAX REQUEST TO GET SELECTED PRODUCT
                $.ajax({
                    url: "<?php echo site_url('add/get_product_by_package1');?>",
                    method: "POST",
                    data :{id:id},
                    cache:false,
                    success : function(data){
                        var item=data;
                        var val1=item.replace("[","");
                        var val2=val1.replace("]","");
                        var values=val2;
                        $.each(values.split(","), function(i,e){
                            $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings").selectpicker('refresh');
 
                        });
                    }
                     
                });
                return false;
            });
            $('.update-record2').on('click',function(){
                var id = $(this).data('training');
                var district = $(this).data('district');
                $(".strings").val('');
                $('#UpdateModal2').modal('show');
                $('[name="edit_id"]').val(id);
                $('[name="district_edit"]').val(district);
                //AJAX REQUEST TO GET SELECTED PRODUCT
                $.ajax({
                    url: "<?php echo site_url('add/get_product_by_package2');?>",
                    method: "POST",
                    data :{id:id},
                    cache:false,
                    success : function(data){
                        var item=data;
                        var val1=item.replace("[","");
                        var val2=val1.replace("]","");
                        var values=val2;
                        $.each(values.split(","), function(i,e){
                            $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings").selectpicker('refresh');
 
                        });
                    }
                     
                });
                return false;
            });
            $('.update-record3').on('click',function(){
                var id = $(this).data('training');
                var spoffice = $(this).data('spoffice');
                $(".strings").val('');
                $('#UpdateModal3').modal('show');
                $('[name="edit_id"]').val(id);
                $('[name="spoffice_edit"]').val(spoffice);
                //AJAX REQUEST TO GET SELECTED PRODUCT
                $.ajax({
                    url: "<?php echo site_url('add/get_product_by_package3');?>",
                    method: "POST",
                    data :{id:id},
                    cache:false,
                    success : function(data){
                        var item=data;
                        var val1=item.replace("[","");
                        var val2=val1.replace("]","");
                        var values=val2;
                        $.each(values.split(","), function(i,e){
                            $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings").selectpicker('refresh');
 
                        });
                    }
                     
                });
                return false;
            });
            $('.update-record4').on('click',function(){
                var id = $(this).data('training');
                var dept = $(this).data('dept');
                var directorate = $(this).data('directorate');
                var district = $(this).data('district');
                var spoffice = $(this).data('spoffice');
                $(".strings").val('');
                $(".strings1").val('');
                $(".strings2").val('');
                $(".strings3").val('');
                $('#UpdateModal4').modal('show');
                $('[name="edit_id"]').val(id);
                $('[name="dept_edit"]').val(dept);
                $('[name="directorate_edit"]').val(directorate);
                $('[name="district_edit"]').val(district);
                $('[name="spoffice_edit"]').val(spoffice);
                //AJAX REQUEST TO GET SELECTED PRODUCT
                $.ajax({
                    url: "<?php echo site_url('add/get_product_by_package4');?>",
                    method: "POST",
                    data :{id:id},
                    cache:false,
                    success : function(data){
                        var item=data;
                        var val1=item.replace("[","");
                        var val2=val1.replace("]","");
                        var values=val2;
                        $.each(values.split(","), function(i,e){
                            $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings").selectpicker('refresh');
 
                        });
                        var val3=item.replace("[","");
                        var val4=val3.replace("]","");
                        var values1=val4;
                        $.each(values1.split(","), function(i,e){
                            $(".strings1 option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings1").selectpicker('refresh');
 
                        });
                        var val5=item.replace("[","");
                        var val6=val5.replace("]","");
                        var values2=val6;
                        $.each(values2.split(","), function(i,e){
                            $(".strings2 option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings2").selectpicker('refresh');
 
                        });
                        var val7=item.replace("[","");
                        var val8=val6.replace("]","");
                        var values3=val8;
                        $.each(values3.split(","), function(i,e){
                            $(".strings3 option[value='" + e + "']").prop("selected", true).trigger('change');
                            $(".strings3").selectpicker('refresh');
 
                        });
                        
                        
                    }
                     
                });
                return false;
            });
 
 
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
 

