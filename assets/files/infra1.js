var baseurl = $('html').attr('data-base-url');
$(document).ready(function() {
    otable = $('#table_overall').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "searching": false,
        "info": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "overall",
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
       sptable = $('#table_spoffice').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "info": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "AdminInfra/ajax_list_spoffice",
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

    distable = $('#table_district').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "info": false,
        "scrollCollapse": true,
        "searching": false,
        "paging": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url":baseurl + "AdminInfra/ajax_list_district",
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
    dtable = $('#table_directorate').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "info": false,
        "scrollCollapse": true,
        "searching": false,
        "paging": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url":baseurl + "AdminInfra/ajax_list_directorate",
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

 
 
  
    stable = $('#table').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "info": false,
        "scrollCollapse": true,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "secretariat",
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
                "scrollY": '50vh',
                "scrollX": '50vh',
                "scrollCollapse": true,
                "paging": false,
                "processing": true,
                "serverSide": true,
                "searching": false,
                "order": [],
                "info": false,
        
               
              
                "ajax": {
                    "url": baseurl + "Infra/ajax_listinfra",
                    "type": "POST",
                    "data" : function(data) {
                        data.dept = $('#dept').val();
                    }   
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
    
            $('#btn-filter').click(function() {
                table.ajax.reload();
            });
            $('#btn-reset').click(function() {
                $('#form-filter')[0].reset();
                table.ajax.reload();
            });

            var table1 = $('#table1').DataTable( {
                "scrollY": '50vh',
                "scrollX": '50vh',
                "scrollCollapse": true,
                "paging": false,
                "processing": true,
                "serverSide": true,   
                   "info": false,

                "searching": false,
                "order": [],
                responsive: true,
              
                "ajax": {
                    "url": baseurl + "Infra/ajax_list_directorate",
                    "type": "POST",
                    "data" : function (data) {
                        data.directorate = $('#directorate').val();
                      
                       
                    }
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
    
            $('#btn1').click(function() {
                table1.ajax.reload();
            });
            $('#reset1').click(function() {
                $('#form-filter1')[0].reset();
                table1.ajax.reload();
            });
            var table2 = $('#table2').DataTable( {
                "scrollY": '50vh',
                "scrollX": '50vh',
                
                "scrollCollapse": true,
                "paging": false,
                "processing": true,
                "info": false,
                "serverSide": true,
                "bSort": true,
                "searching": false,
                "order": [],
               
              
                "ajax": {
                    "url": baseurl + "Infra/ajax_list_district",
                    "type": "POST",
                    "data" : function (data) {
                        data.district = $('#district').val();
                      
                       
                    }
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
            }).columns.adjust();
    
            $('#btn2').click(function() {
                table2.ajax.reload();
            });
            $('#reset2').click(function() {
                $('#form-filter2')[0].reset();
                table2.ajax.reload();
            });
            var table3 = $('#table3').DataTable( {
                "scrollY": '50vh',
                "scrollX": '50vh',
                
                "scrollCollapse": true,
                "paging": false,
                "processing": true,
                "info": false,
                "serverSide": true,
                "bSort": true,
                "searching": false,
                "order": [],
               
              
                "ajax": {
                    "url": baseurl + "Infra/ajax_list_spoffice",
                    "type": "POST",
                    "data" : function (data) {
                        data.spoffice = $('#spoffice').val();
                      
                       
                    }
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
            }).columns.adjust();
    
            $('#btn3').click(function() {
                table3.ajax.reload();
            });
            $('#reset3').click(function() {
                $('#form-filter3')[0].reset();
                table3.ajax.reload();
            });



            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                   .columns.adjust();
                 
             }); 





        });
        var save_method; //for save method string
var table;
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
            url : baseurl + "AdminInfra/ajax_delete/" + dept,
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
    stable.ajax.reload(null,false); //reload datatable ajax 
}
function delete_directorate(directorate)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "AdminInfra/ajax_delete_directorate/" + directorate,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table_directorate();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function reload_table_directorate()
{
    dtable.ajax.reload(null,false); //reload datatable ajax 
}
function delete_district(district)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "AdminInfra/ajax_delete_district/" + district,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table_district();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function reload_table_district()
{
    distable.ajax.reload(null,false); //reload datatable ajax 
}
function delete_spoffice(dept)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "AdminInfra/ajax_delete/" + dept,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_tableP_spoffice();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}


function reload_table_spoffice()
{
    sptable.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table_overall()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 