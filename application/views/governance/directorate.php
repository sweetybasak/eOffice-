<?php $this->load->view('backend/header1');
    ?>
<html data-base-url="<?php echo base_url(); ?>">

 <link href="<?php echo base_url(); ?>assets/dataTables/css/jquery.dataTables.min.css">
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery-3.3.1.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery-ui.js"></script>

 <script type="text/javascript" src="<?php echo base_url(); ?>assets/files/governance1.js"></script>


 
  
  


    


<body>
    <br> <br><br>
    <main id="main">
        <section id="contact">
            <div class="container-fluid">
                <header class="section-header">
                    <h3>Details of the Directorates/Commissionerates</h3>
                </header>
                <div class="row">

                    <div class="col">
                       
                        <div class="card text-blank border-1">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    <h4><i class="fa fa-university"></i> Details of Directorates/Commissionerates</h4>
                                </div>
                            <div class="card-text">
                                <table class="display table table-bordered table-striped table-hover" id="my-table_directorate" style="width:100%">
                                    <thead class="bg-primary text-center">
                                        <tr>
                                         <th>#</th>
                                            <th>Name of the Directorate</th>
                                            <th>Name of the Nodal Officer</th>
                                            <th>Name of the Master Trainer</th>
                                            <th>Name of the EMD Managers</th>
                                        </tr>
                                    </thead>
                                    <tbody class ="text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                            
                            </div>
                </div>
            </div>
        </section>


</main>
</body>
<div class="modal fade displayContent4" id="nodalModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal4.php'); ?>


</div>
<div class="modal fade displayContent5" id="masterModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal5.php'); ?>


</div>
<div class="modal fade displayContent6" id="emdModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal6.php'); ?>


</div>


<style>
      
          tbody tr:nth-child(even){
            background-color: var(--teal);;
            color: #ffffff;
            
          }
         
          
</style>
 
      
       

