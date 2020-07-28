var baseurl = $('html').attr('data-base-url');
$(document).ready(function() {
           
var tables = $('#my-table_directorate').DataTable( {
    "scrollY": '50vh',
    "scrollX": '50vh',
    "scrollCollapse": true,
    "paging": false,
    "processing": true,
    "info": false,
    "serverSide": true,
    "order": [],

    "ajax": {
        "url": baseurl + "Organization/list_directorates",
        "type": "POST",
       
    },
    "columnDefs": [
        {
            "targets": [ 0 ],
            "orderable" : false,
        },
    ],
}).columns.adjust();

    var table = $('#my-table').DataTable( {
        "scrollY": '50vh',
        "scrollX": '50vh',
        "scrollCollapse": true,
        "paging": false,
        "processing": true,
        "info": false,
        "serverSide": true,
        "searching": false,
        "order": [],

        "ajax": {
            "url":baseurl + "Organization/list_districts",
            "type": "POST",
           
        },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "orderable" : false,
            },
        ],
    }).columns.adjust();

  
   
});
load_n_name_district=  function (id)
{



$.ajax({
            type: "POST",
            url: baseurl +"organization/nodal2",
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
            url: baseurl +"organization/master2",
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
            url: baseurl +"organization/emd2",
            data: {id:id},
            success: function (response) {
            $(".displayContent6").html(response);

              
            }
        });
}   
  
 


load_n_name1=  function (id)
{



$.ajax({
        type: "POST",
        url: baseurl +"organization/nodal1",
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
        url: baseurl +"organization/master1",
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
        url: baseurl +"organization/emd1",
        data: {id:id},
        success: function (response) {
        $(".displayContent6").html(response);

          
        }
    });
}   
