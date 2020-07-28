var baseurl = $('html').attr('data-base-url');

$(document).ready(function() {
   
    
    
    var table = $('#my-table').DataTable( {
       
        
      "scrollY": '50vh',
         "scrollX":true,
         "info": false,
         "scrollCollapse": true,
         "paging": false,
         "processing": true,
         "serverSide": true,
         "searching": false,
         "order": [],
         "responsive": true,
         autoWidth: true,
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],
        
         "ajax": {
             "url": baseurl + "trainings/ajax_list2",
             "type": "POST",
             "data" : function (data) {
                 data.dname = $('#dname').val();
                 data.trainingtype = $('#trainingtype').val();
                 data.participanttype = $('#participanttype').val();
                
                 
             }
         },
         "columnDefs": [
             {
                 "targets": [ 0 ],
                 "orderable" : true,
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

     var stable = $('#table1').DataTable( {
          
           
        "scrollY": '50vh',
        "scrollX": true,
        "info": false,
        "bScrollCollapse": true,
        "paging": false,
        "processing": true,
        "serverSide": true,
        "searching": false,
        "order": [],
        "responsive": true,
        bAutoWidth: false,
       
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],
       
        "ajax": {
            "url": baseurl + "trainings/ajax_list3",
            "type": "POST",
            "data" : function (data) {
                data.directorate = $('#directorate').val();
                data.trainingtype1 = $('#trainingtype1').val();
                data.participanttype1 = $('#participanttype1').val();
                
                
            }
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "orderable" : true,
            }, 
        ]
        
        

        
    });
   

    
    $('#filter1').click(function() {
        stable.ajax.reload();
    });
    $('#reset1').click(function() {
        $('#form-filter1')[0].reset();
        stable.ajax.reload();
    });

    var qtable = $('#table2').DataTable( {
          
           
        "scrollY": '50vh',
        "scrollX": true,
        "scrollCollapse": true,
        "paging": false,
        "info": false,
        "processing": true,
        "serverSide": true,
        "searching": false,
        "order": [],
        "responsive": true,
        autoWidth: true,
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],
         
       
       
        "ajax": {
            "url": baseurl + "trainings/ajax_list4",
            "type": "POST",
            "data" : function (data) {
                data.district = $('#district').val();
                data.trainingtype2 = $('#trainingtype2').val();
                data.participanttype2 = $('#participanttype2').val();
               
                
            }
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "orderable" : false,
            }, 
        ]
        
        

        
    });

    $('#filter2').click(function() {
        qtable.ajax.reload();
    });
    $('#reset2').click(function() {
        $('#form-filter2')[0].reset();
        qtable.ajax.reload();
    });

    var ptable = $('#table3').DataTable( {
          
           
        "scrollY": '50vh',
        "scrollX": true,
        "scrollCollapse": true,
        "info": false,
        "paging": false,
        "processing": true,
        "serverSide": true,
        "searching": false,
        "responsive": true,
        autoWidth: true,
        
        "order": [],
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],
       
        "ajax": {
            "url": baseurl + "trainings/ajax_list5",
            "type": "POST",
            "data" : function (data) {
                data.spoffice = $('#spoffice').val();
                data.trainingtype3 = $('#trainingtype3').val();
                data.participanttype3 = $('#participanttype3').val();
               
                
            }
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "orderable" : false,
            }, 
        ]
        
        

        
    });
   

    $('#filter3').click(function() {
        ptable.ajax.reload();
    });
    $('#reset3').click(function() {
        $('#form-filter3')[0].reset();
        ptable.ajax.reload();
    });

    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
           
           .scroller.measure();
         
     }); 
   
    });
   