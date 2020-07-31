<?php $this->load->view('backend/header1'); ?>
<html data-base-url="<?php echo base_url(); ?>">
 <link href="<?php echo base_url(); ?>assets/dataTables/css/jquery.dataTables.min.css">
    
     <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
<title>File Pendency Report</title>

<link rel="stylesheet" type="text/css"  href="<?php echo base_url(); ?>assets/dataTables/eoffice.css" />
<script src="<?php echo base_url(); ?>assets/files/filependency.js"></script>

<style>
 .bg-dark{
background-color: #21252975!important;
}
</style>




<body>
    <br> <br><br>
    <main id="main">
        <section id="about">
            <div class="container">
                <header class="section-header">
                    <h3>Details of the File Pendency Report</h3>
                </header>
                
                <ul class="nav nav-tabs" role="tablist" id="myTab">
  <li class="nav-item"> <a href="#department" class="nav-link active" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Directorate Status</a> </li>
  <li class="nav-item"> <a href="#directorate_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Department Status</a> </li>
  <li class="nav-item"> <a href="#district_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">District Status</a> </li>
  <li class="nav-item"> <a href="#spoffice_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">SP Office Status</a> </li>


</ul>
<div class="tab-content">
      <div class="tab-pane active" id="department" role="tabpanel">
      <br>
                <div class="col-12">
                        <div class="offset-sm-2 col-sm-6">
                            <div class="card text-blank border-1 border-dark bg-dark">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            
                                            <label for="dept">Directorate</label>
                                            <?php echo $form_directorate; ?>
                                            </div>
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <input type="submit" class="btn btn-block btn-primary" id="btn-filter" value="Submit">
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="submit" class="btn btn-block btn-danger" name="btn-reset">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
    <br>
                        <div class="card text-blank border-1 border-info">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4> <i class="fa fa-search"></i>
                                Search Results</h4>
                            </div>
                            <div class="card-text">
                           
                            <table class=" table table-bordered table-striped table-hover" id="my-table" style="width:100%">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        
                                        
                                        <th>Organisation Unit </th>
                                        <th>Live on Date</th>
                                        <th>0-7 days</th>
                                        <th>8-15 days</th>
                                        <th>16-30 days</th>
                                        <th>31-60 days</th>
                                        <th> >60 days </th>
                                        
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

<div class="tab-pane" id="directorate_tab" role="tabpanel">
<br>
                <div class="col">
                        <div class="offset-sm-2 col-sm-6">
                            <div class="card text-blank border-1 border-dark bg-dark">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            
                                            <label for="dept">Department</label>
                                            <?php echo $form_dept; ?>
                                            </div>
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <input type="submit" class="btn btn-block btn-primary" id="button1" value="Submit">
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="submit" class="btn btn-block btn-danger" name="btn-reset">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
<br>
                        <div class="col-sm-12">
                        <div class="card text-blank border-1 border-info">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4> <i class="fa fa-search"></i>
                                Search Results</h4>
                            </div>
                            <div class="card-text">
                           
                            <table class="display table table-bordered table-striped table-hover" id="my-table1" style="width:100%">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        
                                        
                                        <th>Organisation Unit </th>
                                        <th>Live on Date</th>
                                        <th>0-7 days</th>
                                        <th>8-15 days</th>
                                        <th>16-30 days</th>
                                        <th>31-60 days</th>
                                        <th> >60 days </th>
                                        
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
<br>
<div class="col">
                        <div class="offset-sm-2 col-sm-6">
                            <div class="card text-blank border-dark border-1 bg-dark">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            
                                            <label for="dept">District</label>
                                            <?php echo $form_district; ?>
                                            </div>
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <input type="submit" class="btn btn-block btn-primary" id="btn-filter2" value="Submit">
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="submit" class="btn btn-block btn-danger" name="btn-reset2">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
<br>
                        <div class="card text-blank border-1 border-info">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4> <i class="fa fa-search"></i>
                                Search Results</h4>
                            </div>
                            <div class="card-text">
                           
                            <table class="display table table-bordered table-striped table-hover" id="my-table2" style="width:100%">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        
                                        
                                        <th>Organisation Unit </th>
                                        <th>Live on Date</th>
                                        <th>0-7 days</th>
                                        <th>8-15 days</th>
                                        <th>16-30 days</th>
                                        <th>31-60 days</th>
                                        <th> >60 days </th>
                                        
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

<div class="tab-pane" id="spoffice_tab" role="tabpanel">
<br>
<div class="col">
                        <div class="offset-sm-2 col-sm-6">
                            <div class="card text-blank border-dark border-1 bg-dark">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5><b>Filter</b></h5>
                                    </div>
                                    <div class="card-text">
                                    
                                    <form method="post" class="form-horizontal"> 
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                            
                                            <label for="dept">SP Offices</label>
                                            <?php echo $form_spoffice; ?>
                                            </div>
                                            </div>
                                            <div class="form-row">
                                                    <div class="form-group col-sm-4 text-center">
                                                        <input type="submit" class="btn btn-block btn-primary" id="btn-filter3" value="Submit">
                                                    </div>
                                                    <div class="form-group col-sm-4 text-center">
                                                        <button type="submit" class="btn btn-block btn-danger" name="btn-reset3">Reset</button>
                                                    </div>
                                                </div>
                                            
                              </form>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
<br>
                        <div class="card text-blank border-1 border-info">
                        <div class="card-body">
                            <div class="card-title text-center">
                                <h4><i class="fa fa-search"></i>
                                Search Results</h4>
                            </div>
                            <div class="card-text">
                           
                            <table class="display table table-bordered table-striped table-hover" id="my-table3" style="width:100%">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        
                                        
                                        <th>Organisation Unit </th>
                                        <th>Live on Date</th>
                                        <th>0-7 days</th>
                                        <th>8-15 days</th>
                                        <th>16-30 days</th>
                                        <th>31-60 days</th>
                                        <th> >60 days </th>
                                        
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

 

