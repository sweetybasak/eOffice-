
$(document).ready(function() {
    var baseurl = $('html').attr('data-base-url');
$('#btn-filter').on("click", function(event) {
event.preventDefault();

var directorate = $('#directorate').val();

var table = $('#my-table').DataTable( {

"scrollY": '50vh',
"scrollX": '50vh',

"scrollCollapse": true,
"paging": false,
"processing": true,
"serverSide": true,
"bSort": true,
"searching": false,
"order": [],
"destroy": true,




"ajax": {
   url: baseurl + "report/viewajax_directorate",
   type: "POST",
   data: {directorate: directorate},
   
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
});

$('#button1').on("click", function(event) {
event.preventDefault();

var dept = $('#dept').val();
var table = $('#my-table1').DataTable( {
"scrollY": '50vh',
"scrollX": '50vh',

"scrollCollapse": true,
"paging": false,
"processing": true,
"serverSide": true,
"bSort": true,
"searching": false,
"order": [],
"destroy": true,




"ajax": {
url: baseurl + "report/viewajax",
type: "POST",
data: {dept: dept},

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
});

$('#btn-filter2').on("click", function(event) {
event.preventDefault();

var district = $('#district').val();
var table = $('#my-table2').DataTable( {
"scrollY": '50vh',
"scrollX": '50vh',

"scrollCollapse": true,
"paging": false,
"processing": true,
"serverSide": true,
"bSort": true,
"searching": false,
"order": [],
"destroy": true,




"ajax": {
url: baseurl +"report/viewajax_district",
type: "POST",
data: {district: district},

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
});


$(document).on("click","#btn-filter3", function(event) {
console.log("callerd");
event.preventDefault();

var spoffice = $('#spoffice').val();
var table = $('#my-table3').DataTable( {
"scrollY": '50vh',
"scrollX": '50vh',

"scrollCollapse": true,
"paging": false,
"processing": true,
"serverSide": true,
"bSort": true,
"searching": false,
"order": [],
"destroy": true,




"ajax": {
url:baseurl + "report/viewajax_spoffice",
type: "POST",
data: {spoffice: spoffice},

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
});

$('#btn1').on("click", function(event) {
    event.preventDefault();

    var directorate = $('#directorate').val();
   
     $('#table1').DataTable( {
    
     "scrollY": '50vh',
     "scrollX": '50vh',
     
     "scrollCollapse": true,
     "paging": false,
     "processing": true,
     "serverSide": true,
     "bSort": true,
     "searching": false,
     "order": [],
     "destroy": true,
     
    
     

 "ajax": {
        url: baseurl + "report/viewajax_directorate1",
        type: "POST",
        data: {directorate: directorate},
        
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
});

$('#btn2').on("click", function(event) {
 event.preventDefault();

 var dept = $('#dept').val();
  $('#table2').DataTable( {
  "scrollY": '50vh',
  "scrollX": '50vh',
  
  "scrollCollapse": true,
  "paging": false,
  "processing": true,
  "serverSide": true,
  "bSort": true,
  "searching": false,
  "order": [],
  "destroy": true,
  
 
  

"ajax": {
     url: baseurl + "report/viewajax1",
     type: "POST",
     data: {dept: dept},
     
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
});

$('#btn3').on("click", function(event) {
 event.preventDefault();

 var district = $('#district').val();
 $('#table3').DataTable( {
  "scrollY": '50vh',
  "scrollX": '50vh',
  
  "scrollCollapse": true,
  "paging": false,
  "processing": true,
  "serverSide": true,
  "bSort": true,
  "searching": false,
  "order": [],
  "destroy": true,
  
 
  

"ajax": {
     url: baseurl + "report/viewajax_district1",
     type: "POST",
     data: {district: district},
     
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
});


$(document).on("click","#btn4", function(event) {

 event.preventDefault();

 var spoffice = $('#spoffice').val();
  $('#table4').DataTable( {
  "scrollY": '50vh',
  "scrollX": '50vh',
  
  "scrollCollapse": true,
  "paging": false,
  "processing": true,
  "serverSide": true,
  "bSort": true,
  "searching": false,
  "order": [],
  "destroy": true,
  
 
  

"ajax": {
     url: baseurl + "report/viewajax_spoffice1",
     type: "POST",
     data: {spoffice: spoffice},
     
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
});












});

    
   