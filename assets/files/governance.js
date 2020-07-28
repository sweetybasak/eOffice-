
 
var save_method; //for save method string
var table;
var baseurl = $('html').attr('data-base-url');
$(document).ready(function() {
    
    $('#successmessage').hide();
    $('#successmessage1').hide();
    $('#successmessage2').hide();
    $('#dept').change(function() {
        var id=$(this).val();
        $.ajax({
            url: baseurl + "governance/getDirectorate",
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
                $('#directorate').html(html);
            }
        })
        return false;
    });
    $('#dept1').change(function() {
        var id=$(this).val();
        $.ajax({
            url: baseurl + "governance/getDirectorate",
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
                $('#directorate1').html(html);
            }
        })
        return false;
    });
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
            "url": baseurl + "governance/getMaster",
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

    $('#dept2').change(function() {
        var id=$(this).val();
        $.ajax({
            url: baseurl +"governance/getDirectorate",
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
                $('#directorate2').html(html);
            }
        })
        return false;
    });
    mtable = $('#my-table1').DataTable({ 
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
            "url":baseurl + "governance/getEmd",
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
            "url": baseurl +  "governance/getSecretariat",
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
 
 
function add_course()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Nodal Officer'); // Set Title to Bootstrap modal title
}
 
function edit_course(id)
{
    $('.dept').change(function() {
        var id = $(this).val();
        var directorate = $(this).val('directorate');
        $.ajax({
            url:baseurl + "governance/getDirectorate",
            method: "POST",
            data: {id: id},
            async: true,
            dataType: "json",
            success: function(data) {
                $('select[name="directorate"]').empty();
                $.each(data, function(key,value) {
                    if(directorate==value.directorate) {
                        $('select[name="directorate"]').append('<option value="'+value.directorate +'" selected>'+value.directoratename+'</option>').trigger('change');

                    }else {
                        $('select[name="directorate"]').append('<option value="'+value.directorate +'">'+value.directoratename+'</option>');

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
        url : baseurl + "governance/edit_nodal/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="n_name"]').val(data.n_name);
            $('[name="dept"]').val(data.dept);
            $('[name="designation"]').val(data.designation);
            $('[name="directorate"]').val(data.directorate);
            $('[name="email"]').val(data.email);
            $('[name="phone"]').val(data.phone);
        
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Nodal Officer'); // Set title to Bootstrap modal title
 
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
        url =baseurl + "governance/add_nodal";
    } else {
        url = baseurl +"governance/update_nodal";
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
            alert('Error adding / update data');
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
            url : baseurl +"governance/delete_nodal/" + id,
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
 
 
 
function add_master()
{
    save_method = 'add';
    $('#form1')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form1').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Master Trainer'); // Set Title to Bootstrap modal title
}
 
function edit_master(id)
{ $('.dept1').change(function() {
        var id = $(this).val();
        var directorate = $(this).val('directorate1');
        $.ajax({
            url:baseurl + "governance/getDirectorate",
            method: "POST",
            data: {id: id},
            async: true,
            dataType: "json",
            success: function(data) {
                $('select[name="directorate"]').empty();
                $.each(data, function(key,value) {
                    if(directorate==value.directorate) {
                        $('select[name="directorate"]').append('<option value="'+value.directorate +'" selected>'+value.directoratename+'</option>').trigger('change');

                    }else {
                        $('select[name="directorate"]').append('<option value="'+value.directorate +'">'+value.directoratename+'</option>');

                    }
                });
            }
            
        });
        return false;
    });
 

    save_method = 'update';
    $('#form1')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl +"governance/edit_master/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="m_name"]').val(data.m_name);
            $('[name="dept"]').val(data.dept);
            $('[name="designation"]').val(data.designation);
            $('[name="directorate"]').val(data.directorate);
            $('[name="email"]').val(data.email);
            $('[name="phone"]').val(data.phone);
        
        
           
            $('#modal_form1').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Master Trainer'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table1()
{
    otable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save1()
{
    $('#btnSave1').text('saving...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl +"governance/add_master";
    } else {
        url = baseurl +"governance/update_master";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form1').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
               
                $('#modal_form1').modal('hide');
                $('#successmessage1').show();
                $('#successmessage1').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage1').fadeOut("slow");
                    }, 2000);
                reload_table1();
            }
            else
            {
              

                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_master(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            
            url : baseurl +"governance/delete_master/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form1').modal('hide');
                $('#successmessage1').show();
                $('#successmessage1').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage1').fadeOut("slow");
                    }, 2000);
                reload_table1();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function add_emd()
{
    save_method = 'add';
    $('#form2')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form2').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add EMD Manager'); // Set Title to Bootstrap modal title
}
 
function edit_emd(id)
{
    
    save_method = 'update';
    $('#form2')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl +"governance/edit_emd/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.id);
            $('[name="e_name"]').val(data.e_name);
            $('[name="dept"]').val(data.dept);
            $('[name="designation"]').val(data.designation);
            $('[name="directorate"]').val(data.directorate);
            $('[name="email"]').val(data.email);
            $('[name="phone"]').val(data.phone);
        
           
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit EMD Manager'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table2()
{
    mtable.ajax.reload(null,false); //reload datatable ajax 
}
 
function save2()
{
    $('#btnSave2').text('saving...'); //change button text
    $('#btnSave2').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = baseurl +"governance/add_emd";
    } else {
        url = baseurl +"governance/update_emd";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form2').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
               
                $('#modal_form2').modal('hide');
                $('#successmessage2').show();
                $('#successmessage2').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage2').fadeOut("slow");
                    }, 2000);
                reload_table2();
            }
            else
            {
            
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_emd(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl +"governance/delete_emd/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form2').modal('hide');
                $('#successmessage2').show();
                $('#successmessage2').fadeIn().html(data.message);
                    setTimeout(function () {
                        $('#successmessage2').fadeOut("slow");
                    }, 2000);
                reload_table2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 






 
 
  
 $(document).ready(function() {
     //datatables
     $('#successmessage').hide();
     
     $('#successmessage1').hide();
     
     $('#successmessage2').hide();
     
     atable = $('#table_nodal').DataTable({ 
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
             "url": baseurl + "governance/getSecretariat_district",
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
     
     btable = $('#table_master').DataTable({ 
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
             "url": baseurl + "governance/getMaster_district",
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
 
     
     ctable = $('#table_emd').DataTable({ 
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
             "url": baseurl + "governance/getEmd_district",
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
 
 
 });
  
  
  
 function add_course_nodal()
 {
     save_method = 'add';
     $('#form')[0].reset(); // reset form on modals
     $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string
     $('#modal_form').modal('show'); // show bootstrap modal
     $('.modal-title').text('Add Nodal Officer'); // Set Title to Bootstrap modal title
 }
  
 function edit_course_nodal(id)
 {
     save_method = 'update';
     $('#form')[0].reset(); // reset form on modals
     $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string
  
     //Ajax Load data from ajax
     $.ajax({
         url :baseurl +  "governance/edit_nodal_district/" + id,
         type: "GET",
         dataType: "JSON",
         success: function(data)
         {
             
             $('[name="id"]').val(data.id);
             $('[name="n_name"]').val(data.n_name);
             $('[name="district"]').val(data.district);
             $('[name="designation"]').val(data.designation);
             $('[name="email"]').val(data.email);
             $('[name="phone"]').val(data.phone);
         
            
         
            
             $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
             $('.modal-title').text('Edit Nodal Officer'); // Set title to Bootstrap modal title
  
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
             alert('Error get data from ajax');
         }
     });
 }
  
 function reload_table_nodal()
 {
     atable.ajax.reload(null,false); //reload datatable ajax 
 }
  
 function save_nodal()
 {
     $('#btnSave').text('saving...'); //change button text
     $('#btnSave').attr('disabled',true); //set button disable 
     var url;
  
     if(save_method == 'add') {
         url =baseurl +  "governance/add_nodal_district";
     } else {
         url =baseurl +  "governance/update_nodal_district";
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
             alert('Error adding / update data.. Nodal Officer exists');
             $('#btnSave').text('save'); //change button text
             $('#btnSave').attr('disabled',false); //set button enable 
             
         }
     });
 }
  
 function delete_course_nodal(id)
 {
     if(confirm('Are you sure delete this data?'))
     {
         // ajax delete data to database
         $.ajax({
             url :baseurl +  "governance/delete_nodal_district/" + id,
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
                 reload_table_nodal();
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                 alert('Error deleting data');
             }
         });
  
     }
 
 }
  
  
  
 function add_master_district()
 {
     save_method = 'add';
     $('#form1')[0].reset(); // reset form on modals
     $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string
     $('#modal_form1').modal('show'); // show bootstrap modal
     $('.modal-title').text('Add Master Trainer'); // Set Title to Bootstrap modal title
 }
  
 function edit_master_district(id)
 { 
     save_method = 'update';
     $('#form1')[0].reset(); // reset form on modals
     $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string
  
     //Ajax Load data from ajax
     $.ajax({
         url : baseurl + "governance/edit_master_district/" + id,
         type: "GET",
         dataType: "JSON",
         success: function(data)
         {
             
             $('[name="id"]').val(data.id);
             $('[name="m_name"]').val(data.m_name);
             $('[name="district"]').val(data.district);
             $('[name="designation"]').val(data.designation);
             $('[name="email"]').val(data.email);
             $('[name="phone"]').val(data.phone);
         
         
            
             $('#modal_form1').modal('show'); // show bootstrap modal when complete loaded
             $('.modal-title').text('Edit Master Trainer'); // Set title to Bootstrap modal title
  
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
             alert('Error get data from ajax');
         }
     });
 }
  
 function reload_table_master()
 {
     btable.ajax.reload(null,false); //reload datatable ajax 
 }
  
 function save_master()
 {
     $('#btnSave1').text('saving...'); //change button text
     $('#btnSave1').attr('disabled',true); //set button disable 
     var url;
  
     if(save_method == 'add') {
         url = baseurl + "governance/add_master_district";
     } else {
         url = baseurl + "governance/update_master_district";
     }
  
     // ajax adding data to database
     $.ajax({
         url : url,
         type: "POST",
         data: $('#form1').serialize(),
         dataType: "JSON",
         success: function(data)
         {
  
             if(data.status) //if success close modal and reload ajax table
             {
                 
                 $('#modal_form1').modal('hide');
                 $('#successmessage1').show();
                 $('#successmessage1').fadeIn().html(data.message);
                     setTimeout(function () {
                         $('#successmessage1').fadeOut("slow");
                     }, 2000);
                 reload_table_master();
             }
             else
             {
                
                 for (var i = 0; i < data.inputerror.length; i++) 
                 {
                     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                 }
             }
             $('#btnSave1').text('save'); //change button text
             $('#btnSave1').attr('disabled',false); //set button enable 
  
  
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
             alert('Error adding / update data... Master Trainer exists');
             $('#btnSave1').text('save'); //change button text
             $('#btnSave1').attr('disabled',false); //set button enable 
  
         }
     });
 }
  
 function delete_master_district(id)
 {
     if(confirm('Are you sure delete this data?'))
     {
         // ajax delete data to database
         $.ajax({
             url :baseurl +  "governance/delete_master_district/" + id,
             type: "POST",
             dataType: "JSON",
             success: function(data)
             {
                 //if success reload ajax table
                 $('#modal_form1').modal('hide');
                 $('#successmessage1').show();
                 $('#successmessage1').fadeIn().html(data.message);
                     setTimeout(function () {
                         $('#successmessage1').fadeOut("slow");
                     }, 2000);
                 reload_table_master();
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                 alert('Error deleting data');
             }
         });
  
     }
 }
 
 function add_emd_district()
 {
     save_method = 'add';
     $('#form2')[0].reset(); // reset form on modals
     $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string
     $('#modal_form2').modal('show'); // show bootstrap modal
     $('.modal-title').text('Add EMD Managers'); // Set Title to Bootstrap modal title
 }
  
 function edit_emd_district(id)
 {
     
     save_method = 'update';
     $('#form2')[0].reset(); // reset form on modals
     $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string
  
     //Ajax Load data from ajax
     $.ajax({
         url :baseurl +  "governance/edit_emd_district/" + id,
         type: "GET",
         dataType: "JSON",
         success: function(data)
         {
             
             $('[name="id"]').val(data.id);
             $('[name="e_name"]').val(data.e_name);
             $('[name="district"]').val(data.district);
             $('[name="designation"]').val(data.designation);
             $('[name="email"]').val(data.email);
             $('[name="phone"]').val(data.phone);
         
         
            
             $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
             $('.modal-title').text('Edit EMD Manager'); // Set title to Bootstrap modal title
  
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
             alert('Error get data from ajax');
         }
     });
 }
  
 function reload_table_emd()
 {
     ctable.ajax.reload(null,false); //reload datatable ajax 
 }
  
 function save_emd()
 {
     $('#btnSave2').text('saving...'); //change button text
     $('#btnSave2').attr('disabled',true); //set button disable 
     var url;
  
     if(save_method == 'add') {
         url = baseurl + "governance/add_emd_district";
     } else {
         url = baseurl + "governance/update_emd_district";
     }
  
     // ajax adding data to database
     $.ajax({
         url : url,
         type: "POST",
         data: $('#form2').serialize(),
         dataType: "JSON",
         success: function(data)
         {
  
             if(data.status) //if success close modal and reload ajax table
             {
                 
                 $('#modal_form2').modal('hide');
                 $('#successmessage2').show();
                 $('#successmessage2').fadeIn().html(data.message);
                     setTimeout(function () {
                         $('#successmessage2').fadeOut("slow");
                     }, 2000);
                 reload_table_emd();
             }
             else
             {
             
                 
                 for (var i = 0; i < data.inputerror.length; i++) 
                 {
                     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                 }
             }
             $('#btnSave2').text('save'); //change button text
             $('#btnSave2').attr('disabled',false); //set button enable 
  
  
         },
         error: function (jqXHR, textStatus, errorThrown)
         {
             alert('Error adding / update data... EMD Managers exists');
             $('#btnSave2').text('save'); //change button text
             $('#btnSave2').attr('disabled',false); //set button enable 
  
         }
     });
 }
  
 function delete_emd_district(id)
 {
     if(confirm('Are you sure delete this data?'))
     {
         // ajax delete data to database
         $.ajax({
             url : baseurl + "governance/delete_emd_district/" + id,
             type: "POST",
             dataType: "JSON",
             success: function(data)
             {
                 //if success reload ajax table
                 $('#modal_form2').modal('hide');
                 $('#successmessage2').show();
                 $('#successmessage2').fadeIn().html(data.message);
                     setTimeout(function () {
                         $('#successmessage2').fadeOut("slow");
                     }, 2000);
                 reload_table_emd();
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                 alert('Error deleting data');
             }
         });
  
     }
 }
 
 
 load_n_name1=  function (id)
 {
     
 
     
     $.ajax({
                 type: "POST",
                 url: baseurl + "organization/nodal1",
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
                 url: baseurl + "organization/master1",
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
                 url: baseurl  + "organization/emd1",
                 data: {id:id},
                 success: function (response) {
                 $(".displayContent6").html(response);
 
                   
                 }
             });
 }   
 load_n_name_district=  function (id)
 {
     
 
     
     $.ajax({
                 type: "POST",
                 url: baseurl + "organization/nodal2",
                 data: {id:id},
                 success: function (response) {
                 $(".displayContent4").html(response);
 
                   
                 }
             });
 }   
 load_m_name_district=  function (id)
 {
     
 
     
     $.ajax({
                 type: "POST",
                 url: baseurl + "organization/master2",
                 data: {id:id},
                 success: function (response) {
                 $(".displayContent5").html(response);
 
                   
                 }
             });
 }   
 load_e_name_district=  function (id)
 {
     
 
     
     $.ajax({
                 type: "POST",
                 url: baseurl + "organization/emd2",
                 data: {id:id},
                 success: function (response) {
                 $(".displayContent6").html(response);
 
                   
                 }
             });
 }   
 
load_n_name=  function (id)
{
    

    
    $.ajax({
                type: "POST",
                url: baseurl + "organization/nodal",
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
                url: baseurl + "organization/master",
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
                url: baseurl + "organization/emd",
                data: {id:id},
                success: function (response) {
                $(".displayContent3").html(response);

                  
                }
            });
}   

