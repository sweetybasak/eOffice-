<?php $this->load->view('backend/header1');
    ?>


 <link href="<?php echo base_url(); ?>assets/dataTables/css/jquery.dataTables.min.css">
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery-3.3.1.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery-ui.js"></script>


 <style>
      
      tbody tr:nth-child(even){
        background-color: var(--teal);
        color: #ffffff;
        
      }

      td.details-control {
          background: url('<?php echo base_url(); ?>resources/details_open.png') no-repeat center center;
      }
      tr.shown td.details-control {
          background: url('<?php echo base_url(); ?>resources/details_close.png') no-repeat center center;
      }
     
      
</style>
 
  
  


    


<body>
    <br> <br><br>
    <main id="main">
        <section id="contact">
            <div class="container-fluid">
                <header class="section-header">
                    <h3>Details of the Secretariat Departments</h3>
                </header>
                <div class="row">

                    <div class="col">
                       
                        <div class="card text-blank border-1">
                            <div class="card-body">
                                <div class="card-title text-center">
                                    <h4><i class="fa fa-university"></i> Details of Secretariat Departments</h4>
                                </div>
                            <div class="card-text">
                                <table class="display table table-bordered table-striped table-hover" id="my-table">
                                    <thead class="bg-primary text-center">
                                        <tr>
                                            <th></th>
                                            <th>Name of the Department</th>
                                            <th>Name & Designation of the Nodal Officer</th>
                                            <th>Name  & Designation of the Master Trainer</th>
                                            <th>Name  & Designation of the EMD Managers</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
<div class="modal fade displayContent1" id="nodalModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal1.php'); ?>


</div>
<div class="modal fade displayContent2" id="masterModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal2.php'); ?>


</div>
<div class="modal fade displayContent3" id="emdModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal3.php'); ?>


</div>
<div class="modal fade displayContent4" id="nodalModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal4.php'); ?>


</div>
<div class="modal fade displayContent5" id="masterModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal5.php'); ?>


</div>
<div class="modal fade displayContent6" id="emdModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
       <?php include('modal6.php'); ?>


</div>

<script>

    function format(d) {
        if(d.secondary.length == 0) {
            return "There are no sections";
        }
        var display = '<table class="display table  table-striped table-hover" style="color: black; width: 80%; margin-left:288px; table-layout: fixed; " >';
        for(val of d.secondary) {
            display += '<tr>' + '<td>' + val.directorate + '</td>' + '<td>' + val.n_name + '</td>' + '<td>' + val.m_name + '</td>' + '<td>' + val.e_name + '</td>' + '</tr>';
        }

        display +='</table>';
        return display;
    }
    $(document).ready(function() {
        var oTable = $('#my-table').DataTable({
         "scrollY": '50vh',
         "scrollX": true,
            "scrollCollapse": true,
            "paging": false,
            "processing": true,
          
            "ajax": {
                "url":"<?php echo base_url(); ?>organization/list_ajax",
                "type": "POST"
            },



            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                 { "data": "dname"},
                 {
                     "data":"n_name"
                 },
                 {
                     "data":"m_name"
                 },
                 {
                     "data": "e_name"
                 },
            ],
        });

        $('#my-table tbody').on('click','td.details-control',function (){
            var tr = $(this).closest('tr');
            var row = oTable.row(tr);

            if(row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                row.child(format(row.data()) ).show();
                tr.addClass('shown');

                $('[data-toggle="tooltip"]',tr.next('tr')).tooltip();
            }
        });
    });
    load_n_name=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('organization/nodal');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent1").html(response);

                  
                }
            });
}   
load_m_name=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('organization/master');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent2").html(response);

                  
                }
            });
}   
load_e_name=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('organization/emd');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent3").html(response);

                  
                }
            });
}   

load_n_name1=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('organization/nodal1');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent4").html(response);

                  
                }
            });
}   
load_m_name1=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('organization/master1');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent5").html(response);

                  
                }
            });
}   
load_e_name1=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: "<?php echo site_url('organization/emd1');?>",
                data: {id:id},
                success: function (response) {
                $(".displayContent6").html(response);

                  
                }
            });
}   


        
        
</script>

      
       

