<?php $this->load->view('trainings/trainings_header'); ?>

<link href="<?php echo base_url(); ?>assets/dataTables/css/jquery.dataTables.min.css">
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery-3.3.1.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery.dataTables.min.js"></script>

  

<body>
    <br><br>

    <main id="main">
        <section id="contact">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col background-left p-5 pb-5">
                            <div class="row">
                                <div class="offset-sm-2 col-sm-8">
                                    <div class="card text-blank border-1">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                <h5><i class="fa fa-university"></i>Courses Details</h5>
                                            </div>
                                            <br>
                                            <div class="card-text">
                                                <?php foreach($data as $value): ?>
                                                    <p> <i class="fa fa-play"></i> <a href="#" style="color: green; "><?php echo $value->name ?></a></p>
                                                    
                                                <?php endforeach; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                    </div>










            </div>
        </section>
    <main>
</body>


