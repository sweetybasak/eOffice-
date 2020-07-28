<?php $this->load->view('trainings/trainings_header'); ?>
            
            <body>
                <br>
                <main id="main">
                    <section id="contact">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12 background-left">
                                    <div class="offset-sm-2 col-sm-6">
                                        <div class="card text-blank border-1">
                                            <div class="card-body">
                                                <div class="card-title text-left">
                                                    <h5> <b>Gallery</b> </h5>
                                                    <div class="carousel slide" id="demo" data-ride="carousel">
                                                        <ul class="carousel-indicators">
                                                            <li class="active" data-target="#demo" data-slide-to="0"></li>
                                                            <li class="active" data-target="#demo" data-slide-to="1"></li>
                                                            <li class="active" data-target="#demo" data-slide-to="2"></li>
                                                        </ul>

                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <img src="<?php echo base_url();?>assets/img/trainings1.jpg" alt="First Slide" width="1000" height="350">
                                                            </div>
                                                            <div class="carousel-item">
                                                                <img src="<?php echo base_url();?>assets/img/trainings.jpg" alt="Second Slide" width="1500" height="350">
                                                            </div>
                                                            <div class="carousel-item">
                                                                <img src="<?php echo base_url();?>assets/img/download.jpg" alt="Third Slide" width="1500" height="350">
                                                            </div>
                                                        </div>
                                                        <a href="#demo" data-slide="prev" class="carousel-control-prev">
                                                            <span class="carousel-control-prev-icon"></span>
                                                        </a>
                                                        <a href="#demo" data-slide="next" class="carousel-control-next">
                                                            <span class="carousel-control-next-icon"></span>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                

                                </div>


                            </div>
                            <hr>
                            <div class="row">
                               
                                <div class="col-sm-4 background-left">
                                        <div class="card text-blank border-1">
                                            <div class="card-body">
                                                <div class="card-title text-left">
                                                    <h3> <b>Courses</b> </h3>
                                            </div>
                                            <div class="card-text">
                                                <?php foreach($data as $value): ?>
                                                    <p> <i class="fa fa-university"></i> <?php echo $value->name; ?></p>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="card-text">
                                                <div class="float-right">
                                                    <a href="<?php echo base_url(); ?>course"> <i class="fa fa-hand-o-right"></i> More</a>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                            
                                        <div class="card text-blank border-1">
                                            <div class="card-body">
                                                <div class="card-title text-left">
                                                    <h3> <b> Departments</b></h3>

                                            </div>
                                            <?php $depvalue = $this->Trainings_model->getDept(); ?>
                                            <div class="card-text">
                                                <?php foreach($depvalue as $value): ?>
                                                    <p> <i class="fa fa-university"></i><?php echo $value->dname ?></p>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="card-text">
                                                <div class="float-right">
                                                    <a href="<?php echo base_url(); ?>dept"> <i class="fa fa-hand-o-right"></i> More</a>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>

                                            
                                 <div class="col-sm-4">
                            <div class="card text-blank border-1">
                                <div class="card-body">
                                    <div class="card-title text-left">
                                        <h3> <b>Programmes</b> </h3>

                                </div>
                                <?php $program = $this->Trainings_model->getProgramme(); ?>
                                <div class="card-text">
                                    <?php foreach($program as $value): ?>
                                    <p><?php echo $value->start ?>-----<?php echo $value->title ?></p>
                                    <?php endforeach; ?>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                            </div>

                        </div>

                    </section>

                </main>
            </body>

        
     