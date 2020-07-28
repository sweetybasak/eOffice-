
   
  
    
    $(document).ready(function() {
       $('#btn-filter').on("click", function(event) {
           event.preventDefault();

           var dept = $('#dept').val();
           var table = $('#my-table').DataTable( {
            "scrollY": '50vh',
            "scrollX": '50vh',
            
            "scrollCollapse": true,
            "paging": false,
            "processing": true,
            "serverSide": true,
            "bSort": true,
            "searching": false,
            "order": [],
            "destroy": true,
            
           
            
      
        "ajax": {
               url: "<?php echo site_url('report/viewajax'); ?>",
               type: "POST",
               data: {dept: dept},
               
           },
           "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],

           "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable" : false,
                },
            ],
       });
       });

       $('#btn-filter1').on("click", function(event) {
        event.preventDefault();

        var directorate = $('#directorate').val();
        var table = $('#my-table1').DataTable( {
         "scrollY": '50vh',
         "scrollX": '50vh',
         
         "scrollCollapse": true,
         "paging": false,
         "processing": true,
         "serverSide": true,
         "bSort": true,
         "searching": false,
         "order": [],
         "destroy": true,
         
        
         
   
     "ajax": {
            url: "<?php echo base_url(); ?>report/viewajax_directorate",
            type: "POST",
            data: {directorate: directorate},
            
        },
        "dom": 'Bfrtip',
     "buttons": [
         'excel'
     ],

        "columnDefs": [
             {
                 "targets": [ 0 ],
                 "orderable" : false,
             },
         ],
    });
    });

    $('#btn-filter2').on("click", function(event) {
        event.preventDefault();

        var district = $('#district').val();
        var table = $('#my-table2').DataTable( {
         "scrollY": '50vh',
         "scrollX": '50vh',
         
         "scrollCollapse": true,
         "paging": false,
         "processing": true,
         "serverSide": true,
         "bSort": true,
         "searching": false,
         "order": [],
         "destroy": true,
         
        
         
   
     "ajax": {
            url: "<?php echo base_url(); ?>report/viewajax_district",
            type: "POST",
            data: {district: district},
            
        },
        "dom": 'Bfrtip',
     "buttons": [
         'excel'
     ],

        "columnDefs": [
             {
                 "targets": [ 0 ],
                 "orderable" : false,
             },
         ],
    });
    });


    $('#btn-filter3').on("click", function(event) {
        event.preventDefault();

        var spoffice = $('#spoffice').val();
        var table = $('#my-table3').DataTable( {
         "scrollY": '50vh',
         "scrollX": '50vh',
         
         "scrollCollapse": true,
         "paging": false,
         "processing": true,
         "serverSide": true,
         "bSort": true,
         "searching": false,
         "order": [],
         "destroy": true,
         
        
         
   
     "ajax": {
            url: "<?php echo base_url(); ?>report/viewajax_spoffice",
            type: "POST",
            data: {spoffice: spoffice},
            
        },
        "dom": 'Bfrtip',
     "buttons": [
         'excel'
     ],

        "columnDefs": [
             {
                 "targets": [ 0 ],
                 "orderable" : false,
             },
         ],
    });
    });


}); 
      

        
  
