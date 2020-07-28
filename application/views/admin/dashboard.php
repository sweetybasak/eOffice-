<?php if($this->session->userdata('logged_in') == TRUE && !empty($this->session->userdata('email'))) {?>
<?php $this->load->view('admin/sidebar'); ?>
<?php $this->load->view('admin/header'); ?>
<br><br>

<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                          <?php
                        $query = $this->db->query('select count(id) as dept from dept where dname is not null');
            foreach($query->result() as $row) { ?>
            
                            <h3>  <?php echo $row->dept;
            } ?> </h3>
                            <p>Departments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {?>
                       
                        <a href="<?php echo base_url(); ?>department" class="small-box-footer">More Info<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                      <?php  $query = $this->db->query('select count(id) as user from employee');
            foreach($query->result() as $row) { ?>
            
                            <h3>  <?php echo $row->user;
            } ?> </h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {?>
                       
                        <a href="<?php echo base_url(); ?>users" class="small-box-footer">More Info<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <?php
                        $query = $this->db->query('select count(id) as training from trainings');
            foreach($query->result() as $row) { ?>
            
                            <h3>  <?php echo $row->training;
            } ?> </h3>
                            <p>Trainings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-university"></i>
                        </div>
                        <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {?>
                       
                        <a href="<?php echo base_url(); ?>trainings" class="small-box-footer">More Info<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                        <?php
                        $query = $this->db->query('select count(id) as participants from participation');
            foreach($query->result() as $row) { ?>
            
                            <h3>  <?php echo $row->participants;
            } ?> </h3>

                            <p>Trained Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <?php if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {?>
                       
                        <a href="<?php echo base_url(); ?>participants_add" class="small-box-footer">More Info<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } ?>
                    </div>
                </div>
   


            </div>
        </div>

        
    </section>


    </div> <!-- content-wrapper -->
</div>
<script>
   

  // Sales graph chart
</script>
<?php }
else {
  redirect(base_url() . 'login/login');
}
?>