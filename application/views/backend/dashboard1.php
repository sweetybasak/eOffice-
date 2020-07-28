<?php $this->load->view('backend/header1'); ?>

  <br>
  <div class="carousel slide" id="demo" data-ride="carousel">
<ul class="carousel-indicators">
    <li class="active" data-target="#demo" data-slide-to="0"></li>
    <li class="active" data-target="#demo" data-slide-to="1"></li>
    <li class="active" data-target="#demo" data-slide-to="2"></li>
</ul>

<div class="carousel-inner">
    <div class="carousel-item active">
        <img src="<?php echo base_url();?>assets/img/bg_bann_efile5.jpg" alt="First Slide" width="1600" height="400">
    </div>
    <div class="carousel-item">
        <img src="<?php echo base_url();?>assets/img/bg_bann_kms1.jpg" alt="Second Slide" width="1600" height="400">
    </div>
    <div class="carousel-item">
        <img src="<?php echo base_url();?>assets/img/eoffice_banner.jpg" alt="Third Slide" width="1600" height="400">
    </div>
</div>
<a href="#demo" data-slide="prev" class="carousel-control-prev">
    <span class="carousel-control-prev-icon"></span>
</a>
<a href="#demo" data-slide="next" class="carousel-control-next">
    <span class="carousel-control-next-icon"></span>
</a>

</div>


  <main id="main">



    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
      <div class="container">
        

        
<ul class="nav nav-tabs" role="tablist" id="myTab">
  <li class="nav-item"> <a href="#total" class="nav-link active" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Overall status</a> </li>
  <li class="nav-item"> <a href="#department" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Departmental Status</a> </li>
  <li class="nav-item"> <a href="#directorate" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Directorate Status</a> </li>
  <li class="nav-item"> <a href="#district" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">District Status</a> </li>
  <li class="nav-item"> <a href="#spoffice" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">SP Office Status</a> </li>


</ul>

  <div class="tab-content">
      <div class="tab-pane active" id="total" role="tabpanel">
      <div class="row counters">
      <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php
                            $this->db->from("dept");
                            $this->db->where('dname is not null');
                            echo $this->db->count_all_results();
                        ?></span>
            <p>Departments</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                                  $this->db->from("directorate");
                                  $this->db->where('name is not null');
                                  echo $this->db->count_all_results();
                              ?></span>
                  <p>Directorates</p>
                </div>
          <div class="col-lg-3 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                                  $this->db->from("district");
                                  $this->db->where('name is not null');
                                  echo $this->db->count_all_results();
                              ?></span>
                  <p>Districts</p>
                </div>
                <div class="col-lg-3 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                                  $this->db->from("spoffice");
                                  $this->db->where('name is not null');
                                  echo $this->db->count_all_results();
                              ?></span>
                  <p>SP Offices</p>
                </div>
        
        

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php 
             $query = $this->db->query('select sum(filescreated) as files from report');
             foreach($query->result() as $row)
             {
               echo $row->files;
             }
            
            ?></span>
            <p>Files Created</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(filesmoved) as  filesmoved from report');
            foreach($query->result() as $row) {
              echo $row->filesmoved;
            }
            ?></span>
            <p>Files Movement</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(receiptscreated) as  receiptscreated from report');
            foreach($query->result() as $row) {
              echo $row->receiptscreated;
            }
            ?></span>
            <p>Receipts Created</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(receiptsmoved) as  receiptsmoved from report');
            foreach($query->result() as $row) {
              echo $row->receiptsmoved;
            }
            ?></span>
            <p>Receipts Movement</p>
          </div>
         
        
        </div>
        

      </div>

      <div class="tab-pane" id="department" role="tabpanel">
            
      <div class="row counters">
         

          <div class="col-lg-2 col-6 text-center">
            <span data-toggle="counter-up"><?php 
             $query = $this->db->query('select sum(filescreated) as files from report where dept is not null');
             foreach($query->result() as $row)
             {
               echo $row->files;
             }
            
            ?></span>
            <p>Files Created</p>
          </div>

          <div class="col-lg-2 col-6 text-center">
            <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(filesmoved) as  filesmoved from report where dept is not null');
            foreach($query->result() as $row) {
              echo $row->filesmoved;
            }
            ?></span>
            <p>Files Movement</p>
          </div>
          <div class="col-lg-2 col-6 text-center">
            <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(receiptscreated) as  receiptscreated from report where dept is not null');
            foreach($query->result() as $row) {
              echo $row->receiptscreated;
            }
            ?></span>
            <p>Receipts Created</p>
          </div>
          <div class="col-lg-2 col-6 text-center">
            <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(receiptsmoved) as receiptsmoved from report where dept is not null');
            foreach($query->result() as $row) {
              echo $row->receiptsmoved;
            }
            ?></span>
            <p>Receipts Movement</p>
          </div>

          <div class="col-lg-2 col-6 text-center">
            <span data-toggle="counter-up"><?php
                            $this->db->from("dept");
                            $this->db->where('dname is not null');
                            echo $this->db->count_all_results();
                        ?></span>
            <p>Departments</p>
          </div>
  
        </div>
      </div>
      <div class="tab-pane" id="directorate" role="tabpanel">
            
            <div class="row counters">
                
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php 
                   $query = $this->db->query('select sum(filescreated) as files from report where directorate is not null');
                   foreach($query->result() as $row)
                   {
                     echo $row->files;
                   }
                  
                  ?></span>
                  <p>Files Created</p>
                </div>
      
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                  $query = $this->db->query('select sum(filesmoved) as  filesmoved from report where directorate is not null');
                  foreach($query->result() as $row) {
                    echo $row->filesmoved;
                  }
                  ?></span>
                  <p>Files Movement</p>
                </div>
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                  $query = $this->db->query('select sum(receiptscreated) as  receiptscreated from report where directorate is not null');
                  foreach($query->result() as $row) {
                    echo $row->receiptscreated;
                  }
                  ?></span>
                  <p>Receipts Created</p>
                </div>
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(receiptsmoved) as receiptsmoved from report where directorate is not null');
            foreach($query->result() as $row) {
              echo $row->receiptsmoved;
            }
            ?></span>
                  <p>Receipts Movement</p>
                </div>
      
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                                  $this->db->from("directorate");
                                  $this->db->where('name is not null');
                                  echo $this->db->count_all_results();
                              ?></span>
                  <p>Directorates</p>
                </div>
        
              </div>
            </div>
      
            <div class="tab-pane" id="district" role="tabpanel">
            
            <div class="row counters">
               
      
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php 
                   $query = $this->db->query('select sum(filescreated) as files from report where district is not null');
                   foreach($query->result() as $row)
                   {
                     echo $row->files;
                   }
                  
                  ?></span>
                  <p>Files Created</p>
                </div>
      
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                  $query = $this->db->query('select sum(filesmoved) as  filesmoved from report where district is not null');
                  foreach($query->result() as $row) {
                    echo $row->filesmoved;
                  }
                  ?></span>
                  <p>Files Movement</p>
                </div>
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                  $query = $this->db->query('select sum(receiptscreated) as  receiptscreated from report where district is not null');
                  foreach($query->result() as $row) {
                    echo $row->receiptscreated;
                  }
                  ?></span>
                  <p>Receipts Created</p>
                </div>
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(receiptsmoved) as receiptsmoved from report where district is not null');
            foreach($query->result() as $row) {
              echo $row->receiptsmoved;
            }
            ?></span>
                  <p>Receipts Movement</p>
                </div>
      
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                                  $this->db->from("district");
                                  $this->db->where('name is not null');
                                  echo $this->db->count_all_results();
                              ?></span>
                  <p>Districts</p>
                </div>
        
              </div>
            </div>
            <div class="tab-pane" id="spoffice" role="tabpanel">
            
            <div class="row counters">
                
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php 
                   $query = $this->db->query('select sum(filescreated) as files from report where spoffice is not null');
                   foreach($query->result() as $row)
                   {
                     echo $row->files;
                   }
                  
                  ?></span>
                  <p>Files Created</p>
                </div>
      
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                  $query = $this->db->query('select sum(filesmoved) as  filesmoved from report where spoffice is not null');
                  foreach($query->result() as $row) {
                    echo $row->filesmoved;
                  }
                  ?></span>
                  <p>Files Movement</p>
                </div>
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                  $query = $this->db->query('select sum(receiptscreated) as  receiptscreated from report where spoffice is not null');
                  foreach($query->result() as $row) {
                    echo $row->receiptscreated;
                  }
                  ?></span>
                  <p>Receipts Created</p>
                </div>
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
            $query = $this->db->query('select sum(receiptsmoved) as receiptsmoved from report where spoffice is not null');
            foreach($query->result() as $row) {
              echo $row->receiptsmoved;
            }
            ?></span>
                  <p>Receipts Movement</p>
                </div>
      
                <div class="col-lg-2 col-6 text-center">
                  <span data-toggle="counter-up"><?php
                                  $this->db->from("spoffice");
                                  $this->db->where('spoffice.name is not null');
                                  echo $this->db->count_all_results();
                              ?></span>
                  <p>SP Offices</p>
                </div>
        
              </div>
            </div>

  </div>
        
        
      </div>
    </section>

    <section id="about">
          <div class="container">
              <header class="section-header">
                <h3>About Us</h3>
                <p style="font-size: 16px; ">eOffice aims to support governance by ushering in more effective and transparent inter
                 and intra-government processes. The vision of e-Office is to achieve a simplified, responsive, effective and
                  transparent working of all government offices. </p>
              </header>
              <div class="row about-container">
                <div class="col-lg-6 content order-lg-1 order-2">
                    <p>The Open Architecture on which eOffice has been built, makes
                   it a reusable framework and a standard reusable product amenable to replication across the governments, at
                    the state and district levels. The product brings together the independent functions and systems 
                    under a single framework.</p>

                    <div class="icon-box wow-fadeInUp">
                      <div class="icon"> <i class="fa fa-file-text"></i>  </div>
                      <h4 class="title"><a href="#">Enhance Transparency</a></h4>
                      <p class="description">Files status is known at all times.</p>
                    </div>
                    <div class="icon-box wow-fadeInUp" data-wow-delay="0.2s">
                      <div class="icon"> <i class="fa fa-file-text"></i>  </div>
                      <h4 class="title"><a href="#">Increase Accountability</a></h4>
                      <p class="description">the responsibility of quality and speed of decision making is easier to monitor.Assure data 
                      ecurity and data integrity.Provide a platform for re-inventing and re-engineering the government.</p>
                    </div>
                    <div class="icon-box wow-fadeInUp" data-wow-delay="0.4s">
                      <div class="icon"> <i class="fa fa-file-text"></i>  </div>
                      <h4 class="title"><a href="#">Other Benefits</a></h4>
                      <p class="description">Promote innovation by releasing staff energy and time from unproductive procedures.Transform 
                      the government work culture and ethics.Promote greater collaboration in the work place and effective knowledge management.</p>
                    </div>
                    </div>

                    <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
                      <img src="<?php echo base_url(); ?>assets/img/benefits_bann.jpg" class="img-fluid" height="1500">
                    </div>
                
              </div>
          </div>

    
    </section>



  </main>

  <!-- Footer -->

  <?php $this->load->view('backend/footer') ?>

  
  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/easing/easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/mobile-nav/mobile-nav.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/waypoints/waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="<?php echo base_url(); ?>assets/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
</body>
</html>
