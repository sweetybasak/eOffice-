function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}

var save_method; //for save method string
var table;
var baseurl = $('html').attr('data-base-url');
 
$(document).ready(function() {
    
   
    //datatables
    otable = $('#my-table').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "searching": false,
        "paging": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "api/participants_departmental",
            "type": "POST",
            "dataType": "JSON"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0  ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
 
    });
    
    
    table = $('#my-table1').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "api/participants_directorate",
            "type": "POST",
            "dataType": "JSON"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0  ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
    table1 = $('#my-table2').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "api/participants_district",
            "type": "POST",
            "dataType": "JSON"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0  ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
    table2 = $('#my-table3').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "api/participants_spoffice",
            "type": "POST",
            "dataType": "JSON"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0  ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
    table3 = $('#my-table4').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "api/participants_combined",
            "type": "POST",
            "dataType": "JSON"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0  ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
 
    });
    
    $('#successmessage').hide();
   
 
    //datatables
    ctable = $('#table_course').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "searching": false,
        "paging": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "api/courses",
            "type": "POST",
            "dataType": "JSON"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
    //datepicker
 
 
    $('#successmessage').hide();
    $('#successmessage1').hide();
   

    $('#training').change(function() {
        var id=$(this).val();
        $.ajax({
            url: baseurl + "api/Dept",
            method: "POST",
            data: {id: id},
            async: true,
            dataType: "JSON",
            success: function(data){
                var html = '';
                var i;
                for(i=0;i<data.length;i++) {
                    html += '<option value='+data[i].dept+'>'+data[i].dname+'</option>';

                }
                $('#dept').html(html);
            }
        })
        return false;
    });
    ptable = $('#table_programme').DataTable({ 
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [[1, "asc"]], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": baseurl + "api/programmes",
            "type": "POST",
            "dataType": "JSON"
            
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
 
    
    
 
    //datepicker
 
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
 
 

 
 
 

 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 

 

 
        
function reload_table1()
{
    otable.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table2()
{
    table1.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table3()
{
    table2.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table4()
{
    table3.ajax.reload(null,false); //reload datatable ajax 
}
 

function delete_participants(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "api/delete_participant/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                reload_table1();
                reload_table();
                reload_table2();
                reload_table3();
                reload_table4();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
function add_course()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Course'); // Set Title to Bootstrap modal title
}
 
function edit_course(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl + "api/courses_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Course'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_course()
{
    ctable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl + "api/add_course";
    } else {
        url = baseurl + "api/update_course";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $('#successmessage').show();
                $('#successmessage').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage').fadeOut("slow");
                    }, 2000);
                    reload_table_course();
            }
            else
            {
                
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
                
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data.. Course Exists');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_course(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "api/delete_course/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                $('#modal_form').modal('hide');
                $('#successmessage').show();
                $('#successmessage').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage').fadeOut("slow");
                    }, 2000)
                    reload_table_course();
               
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 
function add_programme()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Trainings'); // Set Title to Bootstrap modal title
}
 
function edit_programme(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl + "api/programme_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            
            $('[name="id"]').val(data.id);
            $('[name="title"]').val(data.title);
            $('[name="course"]').val(data.course);
            $('[name="starting"]').val(data.starting);
            $('[name="ending"]').val(data.ending);
            $('[name="venue"]').val(data.venue);
            $('[name="type"]').val(data.type);
          
            if(data.files)
            {
                $('#label-files').text('Change File');
                
            }
            else {
                $('#label-files').text('Upload Files');
            }
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Trainings'); // Set title to Bootstrap modal title

            
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_programme()
{
    ptable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save_programme()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl + "api/add_programme";
    } else {
        url = baseurl + "api/update_programme";
    }

    var formData = new FormData($('#form')[0]);

 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $('#successmessage').show();
                $('#successmessage').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage').fadeOut("slow");
                    }, 2000);
                reload_table_programme();
            }
            else
            {
               
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data... Training Exists');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
            
        
    });
}
 
function delete_programme(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "api/delete_programme/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                $('#successmessage').show();
                $('#successmessage').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage').fadeOut("slow");
                    }, 2000);
                reload_table_programme();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
 
}




