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
                                                <h5><i class="fa fa-university"></i>Departments</h5>
                                            </div>
                                            <br>
                                            <div class="card-text">
                                                <table class="display table table-striped table-hover table-bordered" style="width:100%; table-layout: fixed;" id="my-table">
                                                    <thead class="text-center bg-primary">
                                                        <tr>
                                                            <th>Department</th>
                                                            <th>Trainings</th>
                                                            <th>Participants</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                    <?php foreach($data as $value): ?>
                                                        <tr>
                                                        
                                                            <td><?php echo $value->dname ?></td>
                                                           
                                                            <td><?php echo $value->train ?></td>
                                                            <td><?php echo $value->users ?></td> 
                                                            
                                                           
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                               
                                                    
                                               
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

<script>
        $(document).ready(function() {
       var oTable = $('#my-table').DataTable( {
            "scrollY": '50vh',
            "scrollX": '50vh',
            "scrollCollapse": true,
            "paging": false
        });
    });
</script>

<style>
      
          tbody tr:nth-child(even){
            background-color: var(--teal);;
            color: #ffffff;
            
          }
         
          
</style>
 

