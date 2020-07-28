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
                        <div class="col-sm-6 background-left">
                            <div class="card text-blank border-1 ">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h3> <i class="fa fa-search"></i> Search</h3>
                                    </div>
                                    <div class="card-text">
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-sm-6">
                                                    <?php $depvalue = $this->Trainings_model->getDept(); ?>
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <label><b> Department </b>  </label> 
                                                    <select name="deptname" class="form-control">
                                                    <option value="deptname">Select Department</option>
                                                    <?php foreach($depvalue as $value): ?>
                                                       
                                                      
                                                <option value="<?php echo $value->id ?>"><?php echo $value->deptname ?></option>
                                                <?php endforeach; ?>  
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6">
                                               
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <label for="courseid"><b> Courses </b>  </label> 
                                                        <?php echo $form_course; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-sm-4">
                                                <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <label><b> Venue </b>  </label> 
                                                    <select name="deptname" class="form-control">
                                                        <option value="deptname">Select Venue</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-8">
                                                <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <label><b> Date Interval </b>  </label> 
                                                    <input type="date" name="from" placeholder="from">---
                                                    <input type="date" name="to" placeholder="To">
                                                    </div>
                                                </div>
                                            </div>
                                       
                                        <div class="form-row">
                                                    <div class="form-group col-sm-2 text-center" style="align: middle;">
                                                        <button type="submit" class="btn btn-block btn-primary" name="filter">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-2 text-center" style="align:middle; ">
                                                        <button type="submit" class="btn btn-block btn-primary" name="reset">Reset</button>
                                                    </div>
                                                </div>
                                        </div>
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="col-sm-6">
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
                                                <table id="my-table" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Title</th>
                                                            <th>courseid</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
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
            "paging": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('trainings/ajax_list')?>",
                "type": "POST",
                "data": function(data) {
                    data.title = $('#title').val();
                    data.courseid = $('#courseid').val();
                }
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable": false,
                },
            ],
        });

        $('#btn-filter').click(function() {
            oTable.ajax.reload();
        });
        $('#btn-reset').click(function( {
            $('#form-filter')[0].reset();
            oTable.ajax.reload();
        });
    });
</script>
