<?php 
$this->load->view('admin/sidebar');
$this->load->view('admin/header'); ?>

<!-- DataTables -->
<br>

<br>
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="fa fa-user"></i> Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
           
              <li class="breadcrumb-item active">Profile</li>
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
                        <h3 class="card-title w-100 text-center">Profile Details</h3>
                        
                    </div>
                   
                    

                        <ul class="nav nav-tabs " role="tablist" id="myTab">
                            <li class="nav-item"> <a href="#profile" class="nav-link active" data-toggle="tab" role="tab">Personal Info</a></li>
                            
                            
                            <li class="nav-item"> <a href="#password" class="nav-link" data-toggle="tab" role="tab">Change Password</a> </li>
                           
                                
                        </ul>
                        
                        <div class="tab-content">
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                        <div id="message">
                                        <?php if(!empty($feedback)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success alert-dismissible" id="successmessage">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <?php echo $feedback; ?></div>
    </div>
                    <?php } ?>
                    <?php if(!empty($feedback_error)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger alert-dismissible" id="errormessage">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <?php echo $feedback_error; ?></div>
    </div>
                    <?php } ?>
                    </div>
                    

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                        <div class="text-center">
                                                        <img src="<?php echo base_url(); ?>assets/img/team-1.jpg" alt="" class="img-circle center" width="150">
                                                            <h4 class="card-title m-t-10 w-100 text-center"><?php echo $this->session->userdata('username'); ?> </h4>
                                                        </div>
                                                        </div>
                                                    
                                                    <hr>
                                                   
                                               
                                               
                                            
                                            <div class="card-body"> <small class="text-muted">Email address</small>
                                            <h6><?php echo $this->session->userdata('email'); ?></h6> 
                                            <small class="text-muted p-t-30 db">Phone</small>
                                            <h6><?php echo $this->session->userdata('phone'); ?></h6>
                                            
                                            <small class="text-muted p-t-30 db">Social Profile</small>
                                            <br>
                                            <a href="" class="btn btn-circle btn-secondary" target="_blank"> <i class="fas fa-facebook"></i> </a>
                                            <a href="" class="btn btn-circle btn-secondary" target="_blank"> <i class="fas fa-twitter-square"></i> </a>
                                            <a href="" class="btn btn-circle btn-secondary" target="_blank"> <i class="fas fa-skype"></i> </a>
                                            <a href="" class="btn btn-circle btn-secondary" target="_blank"> <i class="fas fa-google"></i> </a>
                                            
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <form action="" class="row">
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Employee ID</label>
                                            <input type="text" class="form-control form-control-line" readonly name="id" value="<?php echo $this->session->userdata('id'); ?>">

                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Name</label>
                                            <input type="text" class="form-control form-control-line"readonly name="name" value="<?php echo $this->session->userdata('username'); ?>">

                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Role</label>
                                            <input type="text" class="form-control form-control-line"readonly name="role" value="<?php echo $this->session->userdata('role'); ?>">

                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Status</label>
                                            <input type="text" class="form-control form-control-line" readonly name="name" value="<?php echo $this->session->userdata('status'); ?>">

                                        </div>
                                        
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Designation</label>
                                            <input type="text" class="form-control form-control-line" readonly name="designation" value="<?php echo $this->session->userdata('designation'); ?>">

                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Department</label>
                                            <input type="text" class="form-control form-control-line" readonly name="dname" value="<?php foreach($dept as $row) {
                                                  echo $row->dname; }   ?>">

                                        </div>

                                        <div class="form-group col-md-4 m-t-10">
                                            <label>Directorate</label>
                                            <input type="textarea" rows="2" cols="6"class="form-control form-control-line" readonly name="directorate" value="<?php foreach($directorate as $row) {
                                                  echo $row->name; }   ?>">

                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>District</label>
                                            <input type="textarea" rows="2" cols="6"class="form-control form-control-line" readonly name="district" value="<?php foreach($district as $row) {
                                                  echo $row->name; }   ?>">

                                        </div>
                                        <div class="form-group col-md-4 m-t-10">
                                            <label>SP Office</label>
                                            <input type="textarea" rows="2" cols="6"class="form-control form-control-line" readonly name="spoffice" value="<?php foreach($spoffice as $row) {
                                                  echo $row->name; }   ?>">

                                        </div>
                                    </form>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                               

                              <div class="tab-pane" id="password" role="tabpanel">
                                    <div class="card-body">
                                 
   
                                        <form action="<?php echo base_url(); ?>dashboard/Reset_Password" class="row" method="post">
                                                <div class="form-group col-md-6 m-t-20">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" name="new1" required>
                                                </div>
                                                <div class="form-group col-md-6 m-t-20">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control" name="new2" required>
                                                </div>
                                                <div class="form-actions col-md-12">
                                                        <input type="hidden" name="email" value="<?php $this->session->userdata('email'); ?>">
                                                        <button class="btn btn-info pull-right" type="submit"> <i class="fa fa-check"></i> Save</button>
                                                </div>
                                                
                                        </form>
                                    </div>
                              </div>

                        </div>
                </div>
            </div>
        </div>

    </section>

    <script>
       
        $('#message').click(function() {
        
        $('#successmessage').fadeIn("slow");
      
    });
        
        
    </script>



