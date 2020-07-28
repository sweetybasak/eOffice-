
 
      
<?php $this->load->view('backend/header1');
    ?>
     <html data-base-url="<?php echo base_url(); ?>">
  

     <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
     
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/files/infra1.js"></script>


<style>
     a.active.nav-link {

background-color: #0000ff73 !important;


}

      
          tbody tr:nth-child(even){
            background-color: var(--teal);;
            color: #ffffff;
            
          }

          .dataTables_scrollHeadInner{
    width: 100% !important;
    padding-right: 17px;
}
table {
    width: 100% !important;
} 
               
         
          
</style>

<body>
    <br> 
    <main id="main">
        <section id="contact">
            <div class="container-fluid">
                <br><br>
            <ul class="nav nav-tabs" role="tablist" id="myTab">
  <li class="nav-item"> <a href="#department" class="nav-link active" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Departmental Status</a> </li>
  <li class="nav-item"> <a href="#directorate_tab" class="nav-link" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Directorate Status</a> </li>
  <li class="nav-item"> <a href="#district_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">District Status</a> </li>
  <li class="nav-item"> <a href="#spoffice_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">SP Office Status</a> </li>


</ul>
<div class="tab-content">
      <div class="tab-pane active" id="department" role="tabpanel">
         
                <header class="section-header">
                    <h3>Details of the Infra Assessments of the Departments</h3>
                </header>

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
                                            <label for="dept">Department</label>
                                            
                                                
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
                      
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-print"></i> Infra Assessment Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="my-table" >
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Name of the Department</th>
                                        <th>Total Users</th>
                                        <th>Users having System</th>
                                        <th>New System Distributed</th>
                                        <th>Users having DSC</th>
                                        <th>Total Scanners</th>
                                        <th>Total Printers</th>
                                        <th>Additional DSC Required </th>
                                        <th>Additional Printer Required</th>
                                        <th>Additional Scanners Required</th>
                                        <th>Additional System Required</th>
                                        <th>ISP</th>
                                        <th>Bandwidth</th>
                                        <th>Structured Cabling</th>
                                       

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
<header class="section-header">
                    <h3>Details of the Infra Assessments of the Directorates/Commissionerates</h3>
                </header>

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
                                                        <button type="button" class="btn btn-block btn-primary" id="btn1">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="reset1">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-print"></i> Infra Assessment Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="table1" >
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Name of the Directorate</th>
                                        <th>Total Users</th>
                                        <th>Users having System</th>
                                        <th>New System Distributed</th>
                                        <th>Users having DSC</th>
                                        <th>Total Scanners</th>
                                        <th>Total Printers</th>
                                        <th>Additional DSC Required </th>
                                        <th>Additional Printer Required</th>
                                        <th>Additional Scanners Required</th>
                                        <th>Additional System Required</th>
                                        <th>ISP</th>
                                        <th>Bandwidth</th>
                                        <th>Structured Cabling</th>
                                       

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
<header class="section-header">
                    <h3>Details of the Infra Assessments of the Districts</h3>
                </header>

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
                                            <label for="district">District</label>
                                            
                                                
                                                <?php echo $form_district; ?>
                                               
                                            
                                            </div>

                                            
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn2">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="reset2">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-print"></i> Infra Assessment Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="table2">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Name of the Districts</th>
                                        <th>Total Users</th>
                                        <th>Users having System</th>
                                        <th>New System Distributed</th>
                                        <th>Users having DSC</th>
                                        <th>Total Scanners</th>
                                        <th>Total Printers</th>
                                        <th>Additional DSC Required </th>
                                        <th>Additional Printer Required</th>
                                        <th>Additional Scanners Required</th>
                                        <th>Additional System Required</th>
                                        <th>ISP</th>
                                        <th>Bandwidth</th>
                                        <th>Structured Cabling</th>
                                       

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
<header class="section-header">
                    <h3>Details of the Infra Assessments of the SP Offices</h3>
                </header>

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
                                            <label for="district">SP Office</label>
                                            
                                                
                                                <?php echo $form_spoffice; ?>
                                               
                                            
                                            </div>

                                            
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="btn3">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="button" class="btn btn-block btn-primary" id="reset3">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                      <div class="card text-blank border-1">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-print"></i> Infra Assessment Results</h4>
                            </div>
                            <div class="card-text">
                                 
                            <table class="display table table-bordered table-hover table-striped " id="table3">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Name of the SP Office</th>
                                        <th>Total Users</th>
                                        <th>Users having System</th>
                                        <th>New System Distributed</th>
                                        <th>Users having DSC</th>
                                        <th>Total Scanners</th>
                                        <th>Total Printers</th>
                                        <th>Additional DSC Required </th>
                                        <th>Additional Printer Required</th>
                                        <th>Additional Scanners Required</th>
                                        <th>Additional System Required</th>
                                        <th>ISP</th>
                                        <th>Bandwidth</th>
                                        <th>Structured Cabling</th>
                                       

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
         
 

