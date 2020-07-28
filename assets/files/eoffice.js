//<script>
 
var save_method; //for save method string
var wtable,dtable;
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
 
function delete_person(dept)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "Report/ajax_delete" + dept,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function reload_table()
{
    wtable.ajax.reload(null,false); //reload datatable ajax 
}
function delete_directorate(directorate)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "Report/ajax_delete1" + directorate,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table1();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function reload_table1()
{
    dtable.ajax.reload(null,false); //reload datatable ajax 
}
function delete_district(district)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url :baseurl +  "Report/ajax_delete2" + district,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function reload_table2()
{
    ditable.ajax.reload(null,false); //reload datatable ajax 
}
 
function delete_spoffice(spoffice)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url :baseurl +  "Report/ajax_delete3" + spoffice,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table3();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function reload_table3()
{
    dstable.ajax.reload(null,false); //reload datatable ajax 
}
 



   


   
 
    

       $(document).ready(function() {
         
            var baseurl = $('html').attr('data-base-url');
            dstable = $('#table3').DataTable({ 
                "scrollY": '50vh',
                "scrollX": '50vh',
                "info": false,
                "scrollCollapse": true,
                "searching": false,
                "paging": false,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                responsive: true,
                "autoWidth": false,
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": baseurl + "report/statistical_report3",
                    "type": "POST"
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],
        
            }).columns.adjust();
            //datatables
    ditable = $('#table2').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "searching": false,
        "info": false,
        "paging": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "report/statistical_report2",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
 
            //datatables
    dtable = $('#table1').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "searching": false,
        "info": false,
        "scrollCollapse": true,
        "paging": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "report/statistical_report1",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });

            
  wtable = $('#table').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "searching": false,
        "info": false,
        "paging": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "report/statistical_report",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });
       var table = $('#my-table').DataTable( {
            "scrollY": '400px',
            "scrollX": true,
            "info": false,
            "scrollCollapse": true,
            "paging": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "responsive": true,
            "autoWidth": true,
            "order": [],
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],

            "ajax": {
                url: baseurl + "report/ajax_list",
                "type": "POST",
                "data" : function (data) {
                    data.dname = $('#dname').val(); 
                }
            },
            
            
        });
       
        var ptable = $('#my-table1').DataTable( {
            "scrollY": '50vh',
            "scrollX": '50vh',
            "scrollCollapse": true,
            "paging": false,
            "processing": true,
            "info": false,
            "serverSide": true,
            "responsive": true,
            "searching": false,
            "order": [],
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],

            "ajax": {
                "url": baseurl + "report/directoratereport",
                "type": "POST",
                "data" : function (data1) {
                  
                    data1.directorate = $('#directorate').val(); 
                 
                  
                }
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable" : false,
                },
            ],
        });
        var stable = $('#my-table2').DataTable( {
            "scrollY": '50vh',
            "scrollX": '50vh',
            "scrollCollapse": true,
            "paging": false,
            "info": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "responsive" : true,
            "order": [],
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],

            "ajax": {
                "url": baseurl + "report/districtreport",
                "type": "POST",
                "data" : function (data2) {
                    data2.district = $('#district').val();
                
                   
                }
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable" : false,
                },
            ],
        });

      
        var rtable = $('#my-table3').DataTable( {
            "scrollY": '50vh',
            "scrollX": '50vh',
            "scrollCollapse": true,
            "paging": false,
            "info": false,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "responsive" : true,
            "order": [],
            "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],

            "ajax": {
                "url": baseurl + "report/spofficereport",
                "type": "POST",
                "data" : function (data3) {
                    data3.spoffice = $('#spoffice').val();
                  
                   
                }
            },
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable" : false,
                },
            ],
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust();
       
   }); 
        
        $('#btn-filter').click(function() {
            console.log("called  button 1")
            table.ajax.reload();
        });
        $('#btn-reset').click(function() {
            $('#form-filter')[0].reset();
            table.ajax.reload();
        });
        $('#btn-filter1').click(function() {
            console.log("called  button 2")
            ptable.ajax.reload();
        });
        $('#btn-reset1').click(function() {
            $('#form-filter1')[0].reset();
            ptable.ajax.reload();
        });
        $('#btn-filter2').click(function() {
            stable.ajax.reload();
        });
        $('#btn-reset2').click(function() {
            $('#form-filter2')[0].reset();
            stable.ajax.reload();
        });
        $('#btn-filter3').click(function() {
            rtable.ajax.reload();
        });
        $('#btn-reset3').click(function() {
            $('#form-filter3')[0].reset();
            rtable.ajax.reload();
        });
      
    });
    /*
</script> */