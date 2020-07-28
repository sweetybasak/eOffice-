<?php $this->load->view('admin/sidebar');
$this->load->view('admin/header'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-select.css">
<br>

<br>
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Trainings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Trainings</a></li>
              <li class="breadcrumb-item active">Programmes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h1 class="card-title w-100 text-center"> <i class="fas fa-university"></i> Details of EMD Report</h1>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                    <div class="alert alert-success" id="successmessage"></div>
                    <?php  if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin'
                    || $this->session->userdata('role') === 'EMD Managers') {?>
                    
                    <button class="btn btn-success" onclick="add_programme()"><i class="fas fa-plus"></i> Add EMD Report</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                    <?php } ?>
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th> Name of the Department</th>
                                        <th>Person Transferred</th>
                                        <th>Retired on Supermation</th>
                                        <th>Newly Joined</th>
                                     
                                       
                                    
                                </tr>   
                            </thead>
                            <tbody>
                                    
                            </tbody>
                        </table>
                        <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h3 class="modal-title w-100 text-center">Add EMD Report</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" method="post">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">

                        <div class="form-group row">
                            <label class="control-label col-md-4">Name of the Person</label>
                            <div class="col-md-8">
                                <input name="name" placeholder="Name of the Person" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Email</label>
                            <div class="col-md-8">
                                <input name="email" placeholder="Email of the Person" class="form-control" type="email" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <?php if($this->session->userdata('role') === 'Super Admin') { ?>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Department</label>
                            <div class="col-md-8">
                               <select name="dept" class="form-control" id="dept" required>
                                    <option value="">No Selected</option>
                                    <?php foreach($dept as $value ): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->dname ?></option>
                                    <?php endforeach; ?>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4">Directorate</label>
                            <div class="col-md-8">
                               <select name="directorate" class="form-control" id="directorate" required>
                                    <option value="">No Selected</option>
                                  
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                                    <?php } else if($this->session->userdata('role') === 'Admin') {?>
                                        <div class="form-group row">
                            <label class="control-label col-md-4">Directorate</label>
                            <div class="col-md-8">
                               <select name="directorate" class="form-control"  required>
                                    <option value="">No Selected</option>
                                    <?php foreach($directorate1 as $value ): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                    <?php endforeach; ?>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                                    <?php } else {} ?>    
                        <div class="form-group row">
                            <label class="control-label col-md-4">Designation</label>
                            <div class="col-md-8">
                               <select name="designation" class="form-control"  required>
                                    <option value="">No Selected</option>
                                    <?php foreach($designation as $value ): ?>
                                    <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                                    <?php endforeach; ?>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label class="control-label col-md-4">Type</label>
                            <div class="col-md-8">
                               <select name="type" class="form-control" id="type" required>
                                    <option value="">No Selected</option>
                                    <option value="New User">New User</option>
                                    <option value="Modification">Modification</option>
                                    <option value="Deletion">Deletion</option>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label id="label-files" class="control-label col-md-4">Upload More Details</label>
                            <div class="col-md-8">
                                <input type="file" name="files">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                    
        
                    </div>
                </div>
            </div>
            <div class="col-12">
                    <div class="card card-dark">
                            <div class="card-header">
                                <h1 class="card-title w-100 text-center"> <i class="fas fa-university"></i>Details of EMD Report</h1>
                                <div class="card-tools">
                                        <button class="btn btn-tool" type="button" data-card-widget="collapse"> <i class="fas fa-minus"></i> </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <br>
                                <table class="table table-bordered table-hover table-striped" id="my-table1" style="width: 100%; ">
                                <thead class="text-center bg-primary">
                                        <th>#</th>
                                        
                                        <th>Name of the Directorate</th>
                                        <th>Person Transferred</th>
                                        <th>Retired on Supermation</th>
                                        <th>Newly Joined</th>
                                    

                                        </thead>
                                        <tbody></tbody>
                                </table>
                            </div>
                    </div>
            </div>
            <div class="col-12">
                    <div class="card card-dark">
                            <div class="card-header">
                                <h1 class="card-title w-100 text-center"> <i class="fas fa-university"></i>Details of EMD</h1>
                                <div class="card-tools">
                                        <button class="btn btn-tool" type="button" data-card-widget="collapse"> <i class="fas fa-minus"></i> </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <br>
                                <table class="table table-bordered table-hover table-striped" id="my-table" style="width: 100%; ">
                                <thead class="text-center bg-primary">
                                        <th>#</th>
                                        <th>Name of the Person</th>
                                      
                                        
                                        <th>Department</th>
                                        <th>Directorate</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Files</th>
                                        <th style="width: 125px;">Action</th>

                                        </thead>
                                        <tbody></tbody>
                                </table>
                            </div>
                    </div>
            </div>
        </div>
    </section>


    <!-- DataTables -->
 <!-- DataTables -->
 <script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.js"></script>

<script type="text/javascript">
 
 
var save_method; //for save method string
var table;
var base_url = '<?php echo base_url(); ?>';
 
$(document).ready(function() {
    $('#successmessage').hide();
    $('#successmessage1').hide();

   
    $('#dept').change(function() {
        var id=$(this).val();
        $.ajax({
            url: "<?php echo site_url('governance/getDirectorate');?>",
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
 
  
    otable = $('#table').DataTable({ 
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
            "url": " <?php echo site_url('api/emdoverall')?>",
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
    table = $('#my-table').DataTable({ 
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
            "url": " <?php echo site_url('api/emd')?>",
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
    ptable = $('#my-table1').DataTable({ 
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
            "url": " <?php echo site_url('api/emdDirectorate')?>",
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
 
 

 
 
 
function add_programme()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add EMD Report'); // Set Title to Bootstrap modal title
}
 
function edit_programme(id)
{
    $('.dept').change(function() {
        var id = $(this).val();
        var directorate = $(this).val('directorate');
        $.ajax({
            url: "<?php echo site_url('governance/getDirectorate'); ?>",
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
        url : "<?php echo site_url('api/emd_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
            $('[name="email"]').val(data.email);
            $('[name="dept"]').val(data.dept);
            $('[name="directorate"]').val(data.directorate);
            $('[name="designation"]').val(data.designation);
         
            $('[name="type"]').val(data.type);
           
          
            if(data.files)
            {
                $('#label-files').text('Change File');
            }
            else {
                $('#label-files').text('Upload Files');
            }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit EMD Report'); // Set title to Bootstrap modal title

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
function reload_table1()
{
    otable.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table2() {
    ptable.ajax.reload(null,false);
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('api/add_emd')?>";
    } else {
        url = "<?php echo site_url('api/update_emd')?>";
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
                reload_table();
                reload_table1();
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
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data... User already Exists');
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
            url : "<?php echo site_url('api/delete_emd')?>/" + id,
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
                reload_table1();
                reload_table2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
 
}


</script>
 
