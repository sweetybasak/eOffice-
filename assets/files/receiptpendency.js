
 
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
 
function delete_person(organisation)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('Report/ajax_delete_receipts')?>/" + organisation,
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
    table.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table1()
{
    ptable.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table2()
{
    qtable.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table3()
{
    rtable.ajax.reload(null,false); //reload datatable ajax 
}
$(document).ready(function() {


   
    var baseurl = $('html').attr('data-base-url');
    //datatables
    table = $('#table').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "info": false,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "report/receipts_report",
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

    ptable = $('#table1').DataTable({ 
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
            "url": baseurl + "report/receipts_report1",
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

 
    qtable = $('#table2').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "info": false,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "report/receipts_report2",
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
    rtable = $('#table3').DataTable({ 
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
            "url": baseurl + "report/receipts_report3",
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

    

});
 
