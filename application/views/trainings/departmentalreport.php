<?php $this->load->view('trainings/trainings_header'); ?>
<html data-base-url="<?php echo base_url(); ?>">

<title>Trainings Report</title>
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/files/training.js"></script>



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
.bg-dark{
background-color: #21252975!important;
}
          
</style>

<body>
    <br><br>

    <main id="main">
        <section id="contact">
            <div class="container-fluid">
                <ul class="nav nav-tabs" role="tablist" id="myTab">
  <li class="nav-item"> <a href="#department" class="nav-link active" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Departmental Status</a> </li>
  <li class="nav-item"> <a href="#directorate_tab" class="nav-link" data-toggle="tab" role="tab" style="color: black; font-size: 20px;">Directorate Status</a> </li>
  <li class="nav-item"> <a href="#district_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">District Status</a> </li>
  <li class="nav-item"> <a href="#spoffice_tab" class="nav-link " data-toggle="tab" role="tab" style="color: black; font-size: 20px;">SP Office Status</a> </li>


</ul>
<div class="tab-content">
      <div class="tab-pane active" id="department" role="tabpanel">
         
                  <br>  <div class="row">
                        <div class="col-sm-12 background-left">
                            <div class="card text-blank border-1 border-dark bg-dark">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h3> <i class="fa fa-search"></i> Search</h3>
                                    </div>
                                    <div class="card-text">
                                    <form method="post" id="form-filter" class="form-horizontal"> 
                                            <div class="form-row">
                                                <div class="form-group col-sm-4">
                                                    
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="dname"><b> Department </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_dept; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                                
                                           
                                              
                                                
                                              
                                                <div class="form-group col-sm-4">
                                               
                                               <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                               <div class="form-group col-sm-4">
                                               <label for="course"><b> Training Type </b>  </label> 
                                               </div>
                                               <div class="form-group col-sm-8">
                                               <?php echo $form_trainingtype; ?>
                                               </div>
                                               </div>
                                           </div>
                                        
                                           
                                                
                                               
                                                <div class="form-group col-sm-4">
                                               
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="course"><b> Participant Type </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_participantype; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                         </div>
                                        
                                             
                                        <div class="form-row align-items-center">
                                        <div class="form-group col-sm-4"></div>
                                                    <div class="form-group col-sm-2 text-center" >
                                                        <button type="button" class="btn btn-block btn-primary" id="btn-filter">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-2 text-center">
                                                        <button type="button" class="btn btn-block btn-danger" id="btn-reset">Reset</button>
                                                    </div>
                                                </div>
                                        </div>
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                      
                                                        </div>
                                     
                                   
                  <br>  
                    <div class="row">
                        <div class="col background-left p-5 pb-5">
                            <div class="row">
                                <div class=" col-sm-12">
                                    <div class="card text-blank border-1 border-info">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                <h5><i class="fa fa-university"></i>Trainings Programmes Details</h5>
                                            </div>
                                            <div class="card-text">
                                            <table class="display table table-bordered table-hover table-striped" id="my-table" style="width:100%;">
                                <thead class="bg-primary text-center">
                                    <tr>
                                       
                                        <th>Departments</th>
                                        <th>Total Trainings</th>
                                        <th>Total Participants</th>
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
<div class="tab-pane" id="directorate_tab" role="tabpanel">
<br>
<div class="row">
                        <div class="col-sm-10 background-left">
                            <div class="card text-blank border-1 border-dark bg-dark">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h3> <i class="fa fa-search"></i> Search</h3>
                                    </div>
                                    <div class="card-text">
                                    <form method="post" id="form-filter1" class="form-horizontal"> 
                                            <div class="form-row">
                                                <div class="form-group col-sm-4">
                                                    
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="directorate"><b> Directorate </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_directorate; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                                
                                           
                                              
                                                
                                              
                                                <div class="form-group col-sm-4">
                                               
                                               <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                               <div class="form-group col-sm-4">
                                               <label for="course"><b> Training Type </b>  </label> 
                                               </div>
                                               <div class="form-group col-sm-8">
                                               <?php echo $form_trainingtype1; ?>
                                               </div>
                                               </div>
                                           </div>
                                        
                                           
                                                
                                               
                                                <div class="form-group col-sm-4">
                                               
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="course"><b> Participant Type </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_participantype1; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                         </div>
                                         
                                       
                                        <div class="form-row align-items-center">
                                        <div class="form-group col-sm-4"></div>
                                                    <div class="form-group col-sm-2 text-center" >
                                                        <button type="button" class="btn btn-block btn-primary" id="filter1">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-2 text-center">
                                                        <button type="button" class="btn btn-block btn-danger" id="reset1">Reset</button>
                                                    </div>
                                                </div>
                                        </div>
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                      
                                                        </div>
                                     
                    <br>               
                    
                    <div class="row">
                        <div class="col background-left p-5 pb-5">
                            <div class="row">
                                <div class=" col-sm-12">
                                    <div class="card text-blank border-1 border-info">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                <h5><i class="fa fa-university"></i>Trainings Programmes Details</h5>
                                            </div>
                                            <div class="card-text">
                                            <table class="table table-bordered table-hover table-striped" id="table1" style="width:100%;">
                                <thead class="bg-primary text-center">
                                    <tr>
                                       
                                        <th>Directorates</th>
                                        <th>Total Trainings</th>
                                        <th>Total Participants</th>
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
<div class="tab-pane" id="district_tab" role="tabpanel">
<br>
<div class="row">
                        <div class="col-sm-10 background-left">
                            <div class="card text-blank border-1 border-dark bg-dark">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h3> <i class="fa fa-search"></i> Search</h3>
                                    </div>
                                    <div class="card-text">
                                    <form method="post" id="form-filter2" class="form-horizontal"> 
                                            <div class="form-row">
                                                <div class="form-group col-sm-4">
                                                    
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="dname"><b> District </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_district; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                                
                                           
                                              
                                                
                                              
                                                <div class="form-group col-sm-4">
                                               
                                               <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                               <div class="form-group col-sm-4">
                                               <label for="course"><b> Training Type </b>  </label> 
                                               </div>
                                               <div class="form-group col-sm-8">
                                               <?php echo $form_trainingtype2; ?>
                                               </div>
                                               </div>
                                           </div>
                                        
                                           
                                                
                                               
                                                <div class="form-group col-sm-4">
                                               
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="course"><b> Participant Type </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_participantype2; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                         </div>
                                         
                                        <div class="form-row align-items-center">
                                        <div class="form-group col-sm-4"></div>
                                                    <div class="form-group col-sm-2 text-center" >
                                                        <button type="button" class="btn btn-block btn-primary" id="filter2">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-2 text-center">
                                                        <button type="button" class="btn btn-block btn-danger" id="reset2">Reset</button>
                                                    </div>
                                                </div>
                                        </div>
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                      
                                                        </div>
                                     
                                   
                    <br>
                    <div class="row">
                        <div class="col background-left p-5 pb-5">
                            <div class="row">
                                <div class=" col-sm-12">
                                    <div class="card text-blank border-1 border-info">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                <h5><i class="fa fa-university"></i>Trainings Programmes Details</h5>
                                            </div>
                                            <div class="card-text">
                                            <table class="display table table-bordered table-hover table-striped" id="table2" style="width: 100% !important;">
                                <thead class="bg-primary text-center">
                                    <tr>
                                       
                                        <th>Districts</th>
                                        <th>Total Trainings</th>
                                        <th>Total Participants</th>
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

<div class="tab-pane" id="spoffice_tab" role="tabpanel">
<br>
<div class="row">
                        <div class="col-sm-10 background-left">
                            <div class="card text-blank border-1 border-dark bg-dark ">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h3> <i class="fa fa-search"></i> Search</h3>
                                    </div>
                                    <div class="card-text">
                                    <form method="post" id="form-filter3" class="form-horizontal"> 
                                            <div class="form-row">
                                                <div class="form-group col-sm-4">
                                                    
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="dname"><b> SP Office </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_spoffice; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                                
                                           
                                              
                                                
                                              
                                                <div class="form-group col-sm-4">
                                               
                                               <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                               <div class="form-group col-sm-4">
                                               <label for="course"><b> Training Type </b>  </label> 
                                               </div>
                                               <div class="form-group col-sm-8">
                                               <?php echo $form_trainingtype3; ?>
                                               </div>
                                               </div>
                                           </div>
                                        
                                           
                                                
                                               
                                                <div class="form-group col-sm-4">
                                               
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="course"><b> Participant Type </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_participantype3; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                               
                                         </div>
                                       
                                       
                                        <div class="form-row">
                                                    <div class="form-group col-sm-4"></div>
                                                    <div class="form-group col-sm-2 text-center" >
                                                        <button type="button" class="btn btn-block btn-primary" id="filter3">Submit</button>
                                                    </div>
                                                    <div class="form-group col-sm-2 text-center">
                                                        <button type="button" class="btn btn-block btn-danger" id="reset3">Reset</button>
                                                    </div>
                                                </div>
                                        </div>
                                       
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                      
                                                        </div>
                                     
                                   
                    <br>
                    <div class="row">
                        <div class="col background-left p-5 pb-5">
                            <div class="row">
                                <div class=" col-sm-12">
                                    <div class="card text-blank border-1 border-info">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                <h5><i class="fa fa-university"></i>Trainings Programmes Details</h5>
                                            </div>
                                            <div class="card-text">
                                            <table class="display table table-bordered table-hover table-striped" id="table3" style="width: 100% !important;">
                                <thead class="bg-primary text-center">
                                    <tr>
                                       
                                        <th>SP Offices</th>
                                        <th>Total Trainings</th>
                                        <th>Total Participants</th>
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
</div>

            </div>
        </section>
    <main>
</body>




        <script>
           
</script>

