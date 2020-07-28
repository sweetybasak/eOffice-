<?php $this->load->view('trainings/trainings_header'); ?>

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


<style>
 .modal {
     overflow-y:auto;
 }
 .modal:nth-of-type(even){
     z-index: 1052 !important;
 }

 
 </style>

<body>
    <br><br>

    <main id="main">
        <section id="contact">
            <div class="container-fluid">
               
                    <div class="row">
                        <div class="col-sm-10 background-left">
                            <div class="card text-blank border-1 ">
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
                                                    <label for="course"><b> Courses </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_course; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="dname"><b> Directorates </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_directorate; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                              
                                                <div class="form-group col-sm-4">
                                               
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="course"><b> Districts </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                    <?php echo $form_district; ?>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    
                                                    <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-4">
                                                    <label for="dname"><b> SP Offices </b>  </label> 
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
                                               <?php echo $form_trainingtype; ?>
                                               </div>
                                               </div>
                                           </div>
                                            </div>
                                            <div class="form-row">
                                                
                                               
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
                                                <div class="form-group col-sm-3">
                                               
                                               <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                               <div class="form-group col-sm-4">
                                                   <label for="venue"><b> Venue </b>  </label> 
                                                   </div>
                                                   <div class="form-group col-sm-8">
                                                   <?php echo $form_venue; ?>
                                                   </div>
                                                   </div>
                                               </div>
                                               
                                               <div class="form-group  col-sm-5">
                                               <div class="form-row">
                                                <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                                                    <div class="form-group col-sm-2">
                                                    <label><b> Date Interval </b>  </label> 
                                                    </div>
                                                    <div class="form-group col-sm-5">
                                                    <input type="date" name="from" id="from" placeholder="from" value="<?php echo date("Y-m-d"); ?>" class="form-control">
                                                    </div>
                                                    <div class="form-group col-sm-5">
                                                    <input type="date" name="to" id="to" placeholder="To" class="form-control" value="<?php echo date("2022-12-31");?>">
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-row">
                                               
                                              
                                              
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
                                     
                                   
                    
                    <div class="row">
                        <div class="col background-left ">
                            <div class="row">
                                <div class=" col-sm-12">
                                    <div class="card text-blank border-1">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                                <h5><i class="fa fa-university"></i>Trainings Programmes Details</h5>
                                            </div>
                                            <div class="card-text">
                                            <table class="display table table-bordered table-hover table-striped" id="my-table" style="width:100%;">
                                <thead class="bg-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Training Title</th>
                                        <th>Course</th>
                                        <th>Venue</th>
                                        <th>Training Type</th>
                                        <th>Date</th>
                                        <th>Departments</th>
                                        <th>Directorates</th>
                                        <th>Districts</th>
                                        <th>SP Offices</th>
                                        <th>Total Participants</th>
                                        
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
<div class="modal fade displayContent1" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal1.php'); ?>


</div>
<div class="modal fade displayContent2" id="directorateModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal2.php'); ?>

     </div> 
     <div class="modal modal-child hide fade displayContenth" id="participants1" data-modal-parent="#directorateModal" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('participantsd.php'); ?>


</div>
     <div class="modal fade displayContent3" id="districtModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal3.php'); ?>

     </div> 
     <div class="modal fade displayContent4" id="spofficeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal4.php'); ?>

     </div>

    <div class="modal fade displayContent" id="userModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal.php'); ?>

     </div> 
      



        <script>
            
            var load_marks;
            var load_department;
            var load_directorate;
            var load_district;
            var load_spoffice;
            var load_participants;
            var load_participantsdept;
            var load_participantsdistrict;
             var load_participantsspoffice;
            $(document).ready(function() {
                
                $('.modal-child').on('show.bs.modal', function () {
               var modalParent = $(this).attr('data-modal-parent');
               $(modalParent).css('opacity', 0);
           });
           $('.modal-child').on('hidden.bs.modal', function(){
               var modalParent = $(this).attr('data-modal-parent');
               $(modalParent).css('opacity', 1);
           });
          
       var table = $('#my-table').DataTable( {
          
           

            "scrollY": "400px",
            "paging": false,
          "processing": true,
            "serverSide": true,
            "searching": false,
           "bAutoWidth": false,
            "order": [],
            "info": false,
            "buttons": [
            'excel'
        ],
      
            "ajax": {
                "url": "<?php echo site_url('training_filter/ajax_list1')?>",
                "type": "POST",
                "data" : function (data) {
                    data.dname = $('#dname').val();
                    data.course = $('#course').val();
                    data.venue = $('#venue').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.directorate = $('#directorate').val();
                    data.district = $('#district').val();
                    data.spoffice = $('#spoffice').val();
                    data.trainingtype = $('#trainingtype').val();
                    data.participanttype = $('#participanttype').val();
                   
                    
                }
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable" : false,
                }, 
            ]
            
            

            
        });
      
       
        $('#btn-filter').click(function() {
            table.ajax.reload();
        });
        $('#btn-reset').click(function() {
            $('#form-filter')[0].reset();
            table.ajax.reload();
        });

        $('.view_data').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "<?php echo base_url() ?>Training_filter/get_phone_result",
                method: "POST",
                data: {
                    id : id
                },
                success: function(data) {
                    $('#phone_result').html(data);
                    $('#userModal').modal('show');
                }
            });
        });

        load_marks=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/part');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent").html(response);

                  
                }
            });
}



        load_department=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/part_department');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent1").html(response);

                  
                }
            });
}   

load_district=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/part_district');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent3").html(response);

                  
                }
            });
}   

load_directorate=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/part_directorate');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent2").html(response);

                  
                }
            });
}  
load_participants=  function (id,dept)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/participants_dept');?>",
                data: {id:id,
                dept:dept},
                success: function (response) {
                $(".displayContenth").html(response);

                  
                }
            });
}   
load_participantsdept=  function (id,dept)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/participants_directorate');?>",
                data: {id:id,
                dept:dept},
                success: function (response) {
                $(".displayContenth").html(response);

                  
                }
            });
}   
load_participantsdistrict=  function (id,dept)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/participants_district');?>",
                data: {id:id,
                dept:dept},
                success: function (response) {
                $(".displayContenth").html(response);

                  
                }
            });
}   
load_participantsspoffice=  function (id,dept)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/participants_spoffice');?>",
                data: {id:id,
                dept:dept},
                success: function (response) {
                $(".displayContenth").html(response);

                  
                }
            });
}   
       
              


load_spoffice=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('training_filter/part_spoffice');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent4").html(response);

                  
                }
            });
}   

                        

           
    });
</script>

<style>
      
          tbody tr:nth-child(even){
            background-color: var(--teal);;
            color: #ffffff;
            
          }

          
         
          
</style>
 

