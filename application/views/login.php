<?php $this->load->view('backend/header1'); ?>
<body>
        <br><br>
    <main id="main">
        <section id="contact">
        <br><br>
        <p class="text-center" style="font-size: 26px;"><i class="fa fa-user-secret text-danger"></i> USER LOGIN</p>
                                            <div class="container-fluid">
                                                <div class="row justify-content-center mt-5">
                                                    <div class="col-sm-6 col-md-4">
                                                    
          
                                            <?php if(!empty($this->session->flashdata('msg'))) {
                                                ?>
                                                <div class="alert alert-danger alert-dismissible" id="successmessage">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong class="text-danger">Danger! </strong><?php echo $this->session->flashdata('msg') ?>
                                                </div>
                                            <?php } ?>
                                            

                                                <form action="<?php echo base_url() ?>login/login_auth" class="shadow-lg p-4" method="post" id="loginform">

                                                    <div class="form-group">
                                                    <i class="fa fa-user"></i>
                                                    <label for="email" class="font-weight-bold pl-2">Email</label>
                                                            <input class="form-control" name="email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>" type="email" required placeholder="Username">
                                                            <small>we'll never share your email ID with anyone</small>
                                                    </div>
                                                    <div class="form-group">
                                                    <i class="fa fa-key"></i>
                                                    <label for="pass" class="font-weight-bold pl-2">Password</label>
                                                            <input type="password" class="form-control" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; }?>" required placeholder="Password">
                                                        
                                                    </div>
                                                    
                                                
                                                    <div class="form-group text-center m-t-20">
                                                        <div class="col-xs-6">
                                                        
                    <button type="submit" class="btn btn-outline-danger mt-4 font-weight-bold btn-block shadow-sm"> LOGIN</button>
                                                               </div>
                                                    </div>
                                                    <a href="<?php echo base_url(); ?>login/forgot" >Forgot Password</a>
                                                </form>
                                            </div>
                                            </div>
                                            </div>
             
         </section>
    </main>


















