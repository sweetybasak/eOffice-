var baseurl = $('html').attr('data-base-url');
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 $('#successmessage').hide();
    //datatables
    $('#successmessage2').hide();
    $('#officetype').change(function() {
        var id=$(this).val();
        $.ajax({
            url: baseurl + "governance/getOffice",
            method: "POST",
            data: {id: id},
            async: true,
            dataType: "JSON",
            success: function(data){
                var html = '';
                var i;
                for(i=0;i<data.length;i++) {
                    html += '<option value='+data[i].directorate+'>'+data[i].directoratename+'</option>';

                }
                $('#office').html(html);
            }
        })
        return false;
    });
 
    //datatables
    utable = $('#table_user').DataTable({ 
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
            "url": baseurl +  "governance/users",
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
 
    table = $('#table').DataTable({ 
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
            "url": baseurl + "organization/directorates",
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
   
 
//datatables
stable = $('#table_department').DataTable({ 
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
        "url": baseurl +"api/department",
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
vtable = $('#table_venue').DataTable({ 
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
        "url": baseurl + "api/venue",
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

table = $('#table_designation').DataTable({ 
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
        "url": baseurl +"api/designation",
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
  //datatables
  dtable = $('#table_district').DataTable({ 
    "scrollY": '50vh',
    "scrollX": '50vh',
    "searching": false,
    "scrollCollapse": true,
    "paging": false,
    "processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.

    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": baseurl + "api/district",
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
 //datatables
 qtable = $('#table_spoffice').DataTable({ 
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
        "url": baseurl + "api/spoffice",
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
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    
 
 
 
function add_directorate()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Directorate'); // Set Title to Bootstrap modal title
}
 
function edit_directorate(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl + "organization/ajax_edit_directorate/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="dept"]').val(data.dept);
            $('[name="directorate"]').val(data.name);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Directorate'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl + "organization/ajax_add_directorate";
    } else {
        url = baseurl + "organization/ajax_update_directorate";
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
                reload_table();
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
            alert('Error adding / update data.. Directorate exists');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_directorate(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url :baseurl +  "organization/ajax_delete_directorate/" + id,
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
                reload_table();
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
    $('.modal-title').text('Add Department'); // Set Title to Bootstrap modal title
}
 
function edit_course(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl +"api/department_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="dname"]').val(data.dname);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Department'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_department()
{
    stable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save_department()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl +"api/add_department";
    } else {
        url = baseurl +"api/update_department";
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
                    reload_table_department();
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
            url : baseurl + "api/delete_department/" + id,
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
                    reload_table_department();
               
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

 
 
function add_designation()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Designation'); // Set Title to Bootstrap modal title
}
 
function edit_designation(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl + "api/designation_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Designation'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_designation()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save_designation()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl +"api/add_designation";
    } else {
        url = baseurl +"api/update_designation";
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
                reload_table_designation();
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
            alert('Error adding / update data... Designation exists');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_designation(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "api/delete_designation/" + id,
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
                reload_table_designation();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 
function add_district()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add District'); // Set Title to Bootstrap modal title
}
 
function edit_district(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl + "api/district_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit District'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_district()
{
    dtable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save_district()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl + "api/add_district";
    } else {
        url = baseurl + "api/update_district";
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
                reload_table_district();
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
            alert('Error adding / update data... District exists');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_district(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "api/delete_district/" + id,
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
                reload_table_district();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function add_spoffice()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add SP Office'); // Set Title to Bootstrap modal title
}
 
function edit_spoffice(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl +"api/spoffice_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit SP Office'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_spoffice()
{
    qtable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save_spoffice()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl +"api/add_spoffice";
    } else {
        url =baseurl + "api/update_spoffice";
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
                reload_table_spoffice();
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
            alert('Error adding / update data... SP Office exists');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_spoffice(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl +"api/delete_spoffice/" + id,
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
                reload_table_spoffice();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 
function add_user()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
}
 
function edit_user(id)
{

    $('.officetype').change(function() {
        var id = $(this).val();
        var office = $(this).val('office');
        $.ajax({
            url:  baseurl + "governance/getOffice",
            method: "POST",
            data: {id: id},
            async: true,
            dataType: "json",
            success: function(data) {
                $('select[name="office"]').empty();
                $.each(data, function(key,value) {
                    if(office==value.office) {
                        $('select[name="office"]').append('<option value="'+value.directorate +'" selected>'+value.directoratename+'</option>').trigger('change');

                    }else {
                        $('select[name="office"]').append('<option value="'+value.directorate +'">'+value.directoratename+'</option>');

                    }
                });
            }
            
        });
        return false;
    });
 

    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url :  baseurl + "governance/user_edit1/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
            $('[name="office"]').val(data.office);
            $('[name="designation"]').val(data.designation);
            $('[name="officetype"]').val(data.officetype);
            $('[name="email"]').val(data.email);
            $('[name="phone"]').val(data.phone);
            $('[name="role"]').val(data.role);
            $('[name="status"]').val(data.status);
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_user()
{
    utable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save_user()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url =  baseurl + "governance/add_user1>";
    } else {
        url =  baseurl + "governance/update_user1";
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
                $('#successmessage2').show();
                $('#successmessage2').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage2').fadeOut("slow");
                    }, 2000);
                reload_table_user();
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
            alert('Already Exists/Email Sent');
            $('#form')[0].reset();
            $('#modal_form').modal('hide');
           reload_table_user();
 
        }
    });
}
 
function delete_user(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "governance/delete_user/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                $('#successmessage2').show();
                $('#successmessage2').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage2').fadeOut("slow");
                    }, 2000);
                reload_table_user();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
function add_venue()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Venue'); // Set Title to Bootstrap modal title
}
 
function edit_venue(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl + "api/venue_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Venue'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table_venue()
{
    vtable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save_venue()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl + "api/add_venue";
    } else {
        url =baseurl +  "api/update_venue";
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
                reload_table_venue();
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
            alert('Error adding / update data... Venue exists');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_venue(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl + "api/delete_venue/" + id,
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
                reload_table_venue();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}