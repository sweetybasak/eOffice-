
<?php $this->load->view('admin/sidebar');
$this->load->view('admin/header'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
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
              <li class="breadcrumb-item active">Participants</li>
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
                        <h3 class="card-title">Details of Trainings</h3>
                        <div class="card-tools">
                        
                        <!-- This will cause the card to collapse when clicked -->
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                    </div>

                    <div class="card-body">
                    <button class="btn btn-success" onclick="add_programme()"><i class="glyphicon glyphicon-plus"></i> Add Participants</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        
                        <table class="table table-bordered table-hover table-striped" id="table" style="width:100%; ">
                            <thead class="text-center bg-primary">
                                <tr>
                                        <th>#</th>
                                        <th>Name of the Person</th>
                                       <th>Designation</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Training Title</th>
                                        <th style="width:125px; ">Action</th>    
                                    
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
               
                <h3 class="modal-title">Add Programme</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                   
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name of the Person</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Name of the Person" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Designation</label>
                            <div class="col-md-9">
                               <select name="designation" class="form-control"  required>
                                    <option>No Selected</option>
                                    <?php foreach($designation as $value ): ?>
                                    <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                                    <?php endforeach; ?>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Enter Email" class="form-control" type="email">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Phone</label>
                            <div class="col-md-9">
                                <input name="phone" placeholder="Phone Number" class="form-control" type="phone">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                       
                       
                      
                        <div class="form-group">
                            <label class="control-label col-md-3">Training</label>
                            <div class="col-md-9">
                               <select name="training" class="form-control" id="training" required>
                                    <option>No Selected</option>
                                    <?php foreach($training as $value ): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->title ?></option>
                                    <?php endforeach; ?>
                               </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Department</label>
                            <div class="col-md-9">
                            <select name="dept" class="form-control" id="dept" required>
                                                <option>No Selected</option>
                                                
                                            </select>
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
        </div>

            </div>
        </div>
    </section>


    <!-- DataTables -->
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE-3.0.4/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
    

    $('#training').change(function() {
        var id=$(this).val();
        $.ajax({
            url: "<?php echo site_url('api/Dept');?>",
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
            "url": "<?php echo site_url('api/participants')?>",
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
    $('.modal-title').text('Add Trainings'); // Set Title to Bootstrap modal title
}
 
function edit_participants(id)
{
    $('.training').change(function() {
        var id = $(this).val();
        var dept = $(this).val('dept');
        $.ajax({
            url: "<?php echo site_url('api/Dept'); ?>",
            method: "POST",
            data: {id: id},
            async: true,
            dataType: "json",
            success: function(data) {
                $('select[name="dept"]').empty();
                $.each(data, function(key,value) {
                    if(dept==value.dept) {
                        $('select[name="dept"]').append('<option value="'+value.dept +'" selected>'+value.dname+'</option>').trigger('change');

                    }else {
                        $('select[name="dept"]').append('<option value="'+value.dept +'">'+value.dname+'</option>');

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
        url : "<?php echo site_url('api/participant_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            
            $('[name="id"]').val(data.id);
          
            $('[name="name"]').val(data.name);
            $('[name="designation"]').val(data.designation);
            $('[name="email"]').val(data.email);
            $('[name="phone"]').val(data.phone);
         
            
            $('[name="training"]').val(data.training).trigger('change');
            $('[name="dept"]').val(data.dept).trigger('change');
          
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Participants'); // Set title to Bootstrap modal title
 
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
        url = "<?php echo site_url('api/add_participant')?>";
    } else {
        url = "<?php echo site_url('api/update_participant')?>";
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
 
function delete_participants(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('api/delete_participant')?>/" + id,
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
 
</script>
 

