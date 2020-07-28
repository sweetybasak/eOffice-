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
                        <div class="col-sm-7 background-left">
                            <div class="card text-blank border-1 ">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h3> <i class="fa fa-search"></i> Search</h3>
                                    </div>
                                    <div class="card-text">
                                    <form method="post" id="form-filter" class="form-horizontal"> 
                                            <div class="form-row">
                                                <div class="form-group col-sm-6">
                                                    
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-3">
                                                    <label for="dname"><b> Department </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-9">
                                                    <?php echo $form_dept; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6">
                                               
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-2">
                                                    <label for="course"><b> Courses </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-10">
                                                    <?php echo $form_course; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-sm-3">
                                               
                                                <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                <div class="form-group col-sm-4">
                                                    <label for="venue"><b> Venue </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-9">
                                                    <?php echo $form_venue; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                              
                                                <div class="form-group  col-sm-9">
                                                <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-3">
                                                    <label><b> Date Interval </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                    <input type="date" name="from" id="from" placeholder="from" value="<?php echo date("2014-01-01"); ?>" class="form-control">
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                    <input type="date" name="to" id="to" placeholder="To" class="form-control" value="<?php echo date("Y-m-d");?>">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                       
                                        <div class="form-row">
                                                    <div class="form-group col-sm-2 text-center" style="align: middle;">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-filter">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-2 text-center" style="align:middle; ">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-reset">Reset</button>
                                                    </div>
                                                </div>
                                        </div>
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="col-sm-5">
                            <div class="card text-blank border-1">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h5>Summary</h5>
                                    </div>
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-sm-6">
                                            <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                           <h4>Total Programmes: </h4>
                                              <h5> <b>56</b> </h5>  
                                                        </div> 
                                            </div>
                                            <div class="col-sm-6">
                                            <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                            <h4>Total Users: </h4>
                                                 <h5><b>256</b> </h5>
                                                        </div> 
                                            </div>
                                        </div>
                                        
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                                        </div>
                                     
                                   
                    
                    <div class="row">
                        <div class="col background-left p-5 pb-5">
                            <div class="row">
                                <div class="offset-sm-2 col-sm-8">
                                    <div class="card text-blank border-1">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                <h5><i class="fa fa-university"></i>Trainings Programmes Details</h5>
                                            </div>
                                            <div class="card-text">
                                            <table class="display table table-bordered table-hover table-striped " id="my-table" style="width:100%;">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Training Title</th>
                                        <th>Course</th>
                                        <th>Venue</th>
                                        <th>Date</th>
                                        <th>Users</th>
                                        <th>More Details</th>
                                       
                                       

                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                   
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
                
           
          
       var table = $('#my-table').DataTable( {
           
            "scrollY": '50vh',
            "scrollX": '50vh',
            "scrollCollapse": true,
            "paging": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "order": [],
           
            "ajax": {
                "url": "<?php echo site_url('training_filter/ajax_list')?>",
                "type": "POST",
                "data" : function (data) {
                    data.dname = $('#dname').val();
                    data.course = $('#course').val();
                    data.venue = $('#venue').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    
                }
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable" : false,
                },
            ],
            
        });

        $('#btn-filter').click(function() {
            table.ajax.reload();
        });
        $('#btn-reset').click(function() {
            $('#form-filter')[0].reset();
            table.ajax.reload();
        });
    });
</script>

<style>
      
          tbody tr:nth-child(even){
            background-color: var(--teal);;
            color: #ffffff;
            
          }
         
          
</style>
 

