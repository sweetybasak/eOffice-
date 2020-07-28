<link href="<?php echo base_url(); ?>assets/dataTables/css/jquery.dataTables.min.css">
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery-3.3.1.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/dataTables/css/js/jquery.dataTables.min.js"></script>
 

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

</style>



<div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: 1000px;">
                <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Participants</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                  
                </div>
                <div class="modal-body">

                   <table class="table table-striped table-hover table-bordered" id="my-table" style="width: 100%; display: block;">
                       <thead class="bg-primary text-center">
                           <tr>
                               
                               <th>Name</th>
                               <th>Designation</th>
                               <th>Email</th>
                               <th>Phone</th>
                               <th>Department</th>
                               <th>Directorate</th>
                               <th>District</th>
                               <th>SP Office</th>
                               <th>Type</th>
                           </tr>
                       </thead>
                       
                       <tbody class="text-center" style="overflow-y: scroll; max-height: 80vh;"> 
                       <?php if(isset($part) && is_array($part) && count($part)): $i=1;
                           foreach($part as $key => $data) {
                           ?>
                           <tr>
                               <td><?php echo $data['name'];?></td>
                               <td><?php echo $data['designation']; ?></td>
                               <td><?php echo $data['email'];?></td>
                               <td><?php echo $data['phone'];?></td>
                               <td><?php echo $data['deptname'];?></td>
                               <td><?php echo $data['directorate'];?></td>
                               <td><?php echo $data['district'];?></td>
                               <td><?php echo $data['spoffice'];?></td>
                               <td><?php echo $data['type1'];?></td>
                           </tr>
                           <?php }  ?>
                       <?php endif; ?>
                       </tbody>
                           </table>
                   
                </div>
            </div>
        </div>
        

    </div>

    


    <script>
            
            
    
            $(document).ready(function() {
                
           
          
       var table = $('#mytable').DataTable( {
          
           
            "scrollY": '50vh',
            "scrollX": '50vh',
            "scrollCollapse": true,
            "paging": false,
            "processing": true,
            "serverSide": true,
            "order": [],
       });
       var table = $('#mytable1').DataTable( {
          
           
          "scrollY": '50vh',
          "scrollX": '50vh',
          "scrollCollapse": true,
          "paging": false,
          "processing": true,
          "serverSide": true,
          "order": [],
     });

    });
</script>