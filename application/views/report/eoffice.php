<?php $this->load->view('backend/header1');
    ?>
    
    <html data-base-url="<?php echo base_url(); ?>">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  
<br>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


          
         

   
  <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>

<script src="<?php echo base_url();?>assets/files/eoffice.js" type="text/javascript"></script> 
<style>
    .table_row_id {
        width : 20% !important;
    }
    </style>

<body>
    <br> 
    <main id="main">
        <section id="contact">
            <div class="container-fluid">
                <header class="section-header">
                    <h3>eOffice Statistical Report</h3>
                </header>
                <ul class="nav nav-tabs" role="tablist" id="myTab">
  <li class="nav-item"> <a href="#department" class="nav-link active" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Departmental Status</a> </li>
  <li class="nav-item"> <a href="#directorate_tab" class="nav-link" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Directorate Status</a> </li>
  <li class="nav-item"> <a href="#district_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">District Status</a> </li>
  <li class="nav-item"> <a href="#spoffice_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">SP Office Status</a> </li>


</ul>
<div class="tab-content">
      <div class="tab-pane active" id="department" role="tabpanel">
                <div class="row">
                    <div class="col sm-7 background-left">
                        <div class="offset-sm-2 col-sm-4 background-left">
                            <div class="card text-blank border-1 bg-light">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" id="form-filter" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            <label for="dname">Department</label>
                                            
                                                
                                                <?php echo $form_dept; ?>
                                               
                                            
                                            </div>

                                            
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-filter">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-reset">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                      <br>
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-line-chart"></i> eOffice Statistical Report Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="my-table" style="width: 100%;">
                            <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3" class="table_row_id">#</th>
                                       <th rowspan="3">Name of the Department</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
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
                
                <div class="tab-pane" id="directorate_tab" role="tabpanel">
                <div class="row">
                    <div class="col sm-7 background-left">
                        <div class="offset-sm-2 col-sm-4 background-left">
                            <div class="card text-blank border-1 bg-light">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" id="form-filter1" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            <label for="directorate">Directorate</label>
                                            <?php echo $form_directorate; ?>
                                                

                                            
                                            </div>

                                            
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-filter1">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-reset1">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                      <br>
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-line-chart"></i> eOffice Statistical Report Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="my-table1" style="width:100%;">
                            <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3">#</th>
                                       <th rowspan="3">Name of the Directorate</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
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
                <div class="tab-pane" id="district_tab" role="tabpanel">
                <div class="row">
                    <div class="col sm-7 background-left">
                        <div class="offset-sm-2 col-sm-4 background-left">
                            <div class="card text-blank border-1 bg-light">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" id="form-filter2" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            <label for="dname">District</label>
                                            
                                                
                                                <?php echo $form_district; ?>
                                               
                                            
                                            </div>

                                            
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-filter2">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-reset2">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                      <br>
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-line-chart"></i> eOffice Statistical Report Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="my-table2" style="width:100%;">
                            <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3">#</th>
                                       <th rowspan="3">Name of the District</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
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
                <div class="tab-pane" id="spoffice_tab" role="tabpanel">
                <div class="row">
                    <div class="col sm-7 background-left">
                        <div class="offset-sm-2 col-sm-4 background-left">
                            <div class="card text-blank border-1 bg-light">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" id="form-filter3" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            <label for="dname">SP Office</label>
                                            
                                                
                                                <?php echo $form_spoffice; ?>
                                               
                                            
                                            </div>

                                            
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-filter3">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-reset3">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                      <br>
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-line-chart"></i> eOffice Statistical Report Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="my-table3" style="width:100%;">
                            <thead class="bg-primary text-center">
                                   
                                   <tr>
                                       <th rowspan="3">#</th>
                                       <th rowspan="3">Name of the SP Office</th>
                                       <th rowspan="3">Live on Date</th>
                                       <th colspan="4"  scope="colgroup" class="text-center">Month-January</th>
                                   </tr>
                                   <tr>
                                       <th colspan="2" scope="colgroup">Files</th>
                                       <th colspan="2">Receipts</th>
                                   </tr>
                                   <tr>
                                       <th>Created</th>
                                       <th>Movement</th>
                                       <th>Created</th>
                                       <th>Movement</th>
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


</main>



       
        
         </body>
        


 

