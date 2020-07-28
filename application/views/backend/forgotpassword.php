<?php $this->load->view('backend/header1'); ?>

<body>
        <br><br>
    <main id="main">
        <section id="contact">
         
               
            <br><br>
        <p class="text-center" style="font-size: 26px;"><i class="fa fa-user-secret text-danger"></i> FORGOT PASSWORD </p>
                                            <div class="container-fluid">
                                                <div class="row justify-content-center mt-5">
                                                    <div class="col-sm-6 col-md-4">
          
                      
                                    
                                                    <?php if(!empty($this->session->flashdata('msg'))) {
                                                ?>
                                                <div class="alert alert-success alert-dismissible" id="successmessage">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong class="text-success"><?php echo $this->session->flashdata('msg') ?> </strong> 
                                                </div>
                                            <?php } else if(!empty($this->session->flashdata('errormsg'))) {?>
                                               
                                                <div class="alert alert-danger alert-dismissible" id="successmessage">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong class="text-danger">Danger! </strong><?php echo $this->session->flashdata('errormsg') ?>
                                                </div>
                                            <?php } else {} ?>
                                        <form action="<?php echo base_url(); ?>login/forgot_password" class="shadow-lg p-4" method="post" role="form">
                                            <div class="form-group">
                                            <i class="fa fa-user"></i>
                                                    <label for="email" class="font-weight-bold pl-2">Email</label>
                                                   
                                                <input name="email" type="email" id="email" placeholder="Enter email" class="form-control" value="<?php echo set_value('email'); ?>" />
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                            <button class="btn btn-outline-danger mt-4 font-weight-bold btn-block shadow-sm" type="submit">Submit</button>
                                            <a href="<?php echo base_url(); ?>login" >Back to Login</a>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        
        </section>
    </main>
</body>