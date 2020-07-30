<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Report_model');
        $this->load->model('Trainings_model');
      
        $this->load->model('Infra_model');
        $this->load->model('AdminInfra_model','adminInfra_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('CSVReader');
   
        $this->load->model('Dashboard_model','dashboard');
       
    }

    private function logged_in(){
       
        if($this->session->userdata('logged_in') !== TRUE) {
            redirect('login');
        }
    }



    function viewajax() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $dept = $this->input->post('dept');
           $list = $this->Report_model->getfilependency($dept);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }
    function viewajax1() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $dept = $this->input->post('dept');
           $list = $this->Report_model->getreceiptpendency($dept);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }

    function viewajax_spoffice() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $spoffice = $this->input->post('spoffice');
           $list = $this->Report_model->getfilependencyspoffice($spoffice);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }
    function viewajax_directorate() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $directorate = $this->input->post('directorate');
           $list = $this->Report_model->getfilependency1($directorate);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }
    function viewajax_district() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $district = $this->input->post('district');
           $list = $this->Report_model->getfilependency2($district);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }
    function viewajax_district1() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $district = $this->input->post('district');
           $list = $this->Report_model->getreceiptpendency2($district);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }
function viewajax_spoffice1() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $spoffice = $this->input->post('spoffice');
           $list = $this->Report_model->getreceiptpendencyspoffice($spoffice);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }
    function viewajax_directorate1() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $directorate = $this->input->post('directorate');
           $list = $this->Report_model->getreceiptpendency1($directorate);
    
           $data1 = array();
           $no = $_POST['start'];
           foreach($list as $cu) {
               $no++;
               $row = array();
            
               
               $row[] = $cu->organisation;
               $row[] = $cu->live;
               $row[] = $cu->value1;
               $row[] = $cu->value2;
               $row[] = $cu->value3;
               $row[] = $cu->value4;
               $row[] = $cu->value5;

              

    
               $data1[] = $row;
           }
    
           $data = array(
               "draw" => $draw,
               "recordsTotal" => $this->Report_model->count_all(),
               "recordsFiltered" => $this->Report_model->count_filtered(),
               "data" => $data1,
           );
           echo json_encode($data);
           exit();
    }

   
    public function viewajax2() {
        $dept = $this->input->get('dept');
        $list = $this->Report_model->getreceiptpendency($dept);
        foreach($list as $value) {
            echo "<tr>
            <td>$value->organisation </td>
            <td>$value->value1 </td>
            <td>$value->value2</td>
            <td>$value->value3</td>
            <td>$value->value4</td>
            <td>$value->value5</td>
            </tr>";
        }
    }

    function file() {
        $this->load->view('report/filependency');
    }

   function filter() {
    $directorate = $this->Report_model->getDirectorate();

    $opt1 = array('' => 'All Directorates');
    foreach ($directorate as $dir) {
        $opt1[$dir->id] = $dir->name;
    }
       $dept = $this->Report_model->get_list_department();
   

       $opt = array('' => 'All department');
       foreach($dept as $d) {
           $opt[$d->id] = $d->dname;
       }

       
       $district = $this->Report_model->getDistrict();

       $opt2 = array('' => 'All District');
       foreach ($district as $d) {
           $opt2[$d->id] = $d->name;
       }
       $spoffice = $this->Report_model->getSPOffice();
       $opt3 = array('' => 'All SP Offices');
       foreach($spoffice as $d) {
           $opt3[$d->id] = $d->name;
       }
       $data['form_spoffice'] = form_dropdown('',$opt3,'','id="spoffice"class="form-control"');
       $data['form_district'] = form_dropdown('',$opt2,'','id="district" class="form-control"');

       $data['form_directorate'] = form_dropdown('',$opt1,'','id="directorate" class="form-control"');

       $data['form_dept'] = form_dropdown('',$opt,'','id="dname" class="form-control"');
 

       $this->load->view('report/eoffice',$data);
   }

   function directoratefilter() {
       $directorate = $this->Report_model->getDirectorate();

       $opt = array('0' => 'All Directorates');
       foreach ($directorate as $d) {
           $opt[$d->id] = $d->name;
       }

       $data['form_directorate'] = form_dropdown('',$opt,'','id="directorate" class="form-control"');
       $this->load->view('report/directoratereport',$data);
   }
   function districtfilter() {
    $district = $this->Report_model->getDistrict();

    $opt = array('0' => 'All District');
    foreach ($district as $d) {
        $opt[$d->id] = $d->name;
    }

    $data['form_district'] = form_dropdown('',$opt,'','id="district" class="form-control"');
    $this->load->view('report/districtreport',$data);
}
   

   public function ajax_list() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
       $list = $this->Report_model->get_datatables();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          

           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }
   public function districtreport() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
       $list = $this->Report_model->get_districtreport();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          

           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }
   public function spofficereport() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
       $list = $this->Report_model->get_spofficereport();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          


           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }
   public function directoratereport() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
       $list = $this->Report_model->get_directoratereport();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          

           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }
function file2() {
    $directorate = $this->Report_model->getDirectorate();

    $opt1 = array('' => 'All Directorates');
    foreach ($directorate as $d) {
        $opt1[$d->id] = $d->name;
    }
    $data['form_directorate'] = form_dropdown('',$opt1,'','id="directorate" class="form-control"');
    $dept = $this->Report_model->get_list_department();

    $opt2 = array('' => 'All Directorates');
    foreach ($dept as $d) {
        $opt1[$d->id] = $d->dname;
    }
    $data['form_dept'] = form_dropdown('',$opt2,'','id="dept" class="form-control"');
   

    $this->load->view('report/filependency2',$data);
}
   function filter1() {
    $deptname = $this->Report_model->get_list_department();
   

    $opt = array('0' => 'All department');
    foreach($deptname as $d) {
        $opt[$d->id] = $d->dname;
    }
    $directorate = $this->Report_model->getDirectorate();

    $opt1 = array('' => 'All Directorates');
    foreach ($directorate as $d) {
        $opt1[$d->id] = $d->name;
    }
    $district = $this->Report_model->getDistrict();

    $opt2 = array('' => 'All District');
    foreach ($district as $d) {
        $opt2[$d->id] = $d->name;
    }
    $spoffice = $this->Report_model->getSPOffice();
    $opt3 = array('' => 'All SP Offices');
    foreach($spoffice as $d) {
        $opt3[$d->id] = $d->name;
    }
    $data['form_spoffice'] = form_dropdown('',$opt3,'','id="spoffice"class="form-control"');
    $data['form_district'] = form_dropdown('',$opt2,'','id="district" class="form-control"');

    $data['form_directorate'] = form_dropdown('',$opt1,'','id="directorate" class="form-control"');
   

    $data['form_dept'] = form_dropdown('',$opt,'','id="dept" class="form-control"');


    $this->load->view('report/filependency1',$data);
   }
   function filter2() {
    $deptname = $this->Report_model->get_list_department();
   

    $opt = array('0' => 'All department');
    foreach($deptname as $d) {
        $opt[$d->id] = $d->dname;
    }
    $directorate = $this->Report_model->getDirectorate();

    $opt1 = array('' => 'All Directorates');
    foreach ($directorate as $d) {
        $opt1[$d->id] = $d->name;
    }
    $district = $this->Report_model->getDistrict();

    $opt2 = array('' => 'All District');
    foreach ($district as $d) {
        $opt2[$d->id] = $d->name;
    }
    $spoffice = $this->Report_model->getSPOffice();
    $opt3 = array('' => 'All SP Offices');
    foreach($spoffice as $d) {
        $opt3[$d->id] = $d->name;
    }
    $data['form_spoffice'] = form_dropdown('',$opt3,'','id="spoffice"class="form-control"');
    $data['form_district'] = form_dropdown('',$opt2,'','id="district" class="form-control"');

    $data['form_directorate'] = form_dropdown('',$opt1,'','id="directorate" class="form-control"');
   

    $data['form_dept'] = form_dropdown('',$opt,'','id="dept" class="form-control"');




    $this->load->view('report/receiptpendency',$data);
   }

   public function report_eoffice() {
       $this->logged_in();
    $data = array();
        
    // Get messages from the session
    if($this->session->userdata('success_msg')){
        $data['success_msg'] = $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
    }
    if($this->session->userdata('error_msg')){
        $data['error_msg'] = $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
    }
    
    // Get rows
    $data['eoffice'] = $this->Report_model->getRows();
    
       $this->load->view('admin/report/eofficeReport',$data);
   }
   public function report_directorate() {
       $this->logged_in();
    $data = array();
        
    // Get messages from the session
    if($this->session->userdata('success_msg')){
        $data['success_msg'] = $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
    }
    if($this->session->userdata('error_msg')){
        $data['error_msg'] = $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
    }
    
    // Get rows
    $data['eoffice'] = $this->Report_model->getRows();
    $dept = $this->session->userdata('dept');
        // Get rows
      
       $data['director'] = $this->adminInfra_model->getDirectorate_dept($dept);
       
    
       $this->load->view('admin/report/directorateReport',$data);
   }

   public function report_district() {
       $this->logged_in();
    $data = array();
        
    // Get messages from the session
    if($this->session->userdata('success_msg')){
        $data['success_msg'] = $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
    }
    if($this->session->userdata('error_msg')){
        $data['error_msg'] = $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
    }
    
    // Get rows
    $data['eoffice'] = $this->Report_model->getRows();
    
       $this->load->view('admin/report/districtReport',$data);
   }

   

   public function filependency() {
       $this->logged_in();
    $data = array();
        
    // Get messages from the session
    if($this->session->userdata('success_msg')){
        $data['success_msg'] = $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
    }
    if($this->session->userdata('error_msg')){
        $data['error_msg'] = $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
    }
    
    // Get rows
   
    
       $this->load->view('admin/report/filependency',$data);
   }
   public function receiptpendency() {
       $this->logged_in();
    $data = array();
        
    // Get messages from the session
    if($this->session->userdata('success_msg')){
        $data['success_msg'] = $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
    }
    if($this->session->userdata('error_msg')){
        $data['error_msg'] = $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
    }
    
    // Get rows
   
    
       $this->load->view('admin/report/receiptpendency',$data);
   }

   public function emdReport()
   {
       $this->logged_in();
       $data['dept'] = $this->Report_model->get_list_department();
       $dept = $this->session->userdata('dept');
       $data['directorate'] = $this->Report_model->getDirectorate1();
       $data['directorate1'] = $this->Report_model->get_list_directorate($dept);
       $data['designation'] = $this->Report_model->get_list_designation();
       $data['department'] = $this->Report_model->get_list_department();
       $data['district'] = $this->Report_model->get_list_district();
       $data['spoffice'] = $this->Report_model->get_list_spoffice();
       
       $this->load->view('admin/report/emdreport1',$data);
   }
   
   public function ajax_list1() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    $deptname = $this->input->post("deptname");
       $list = $this->Report_model->getFiles($deptname);

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->organisation;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          

           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all1(),
           "recordsFiltered" => $this->Report_model->count_filtered1(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }

   public function ajax_delete($dept)
    {
        $this->Report_model->delete_by_id($dept);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete1($directorate)
    {
        $this->Report_model->delete_by_id($directorate);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete2($district)
    {
        $this->Report_model->delete_by_id($district);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete3($spoffice)
    {
        $this->Report_model->delete_by_id($spoffice);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete_files($organisation)
    {
        $this->Report_model->delete_by_id1($organisation);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_delete_receipts($organisation)
    {
        $this->Report_model->delete_by_id2($organisation);
        echo json_encode(array("status" => TRUE));
    }

    public function getall() {

        $deptname = $this->input->post('deptname');

        if($deptname) {
            $data['files'] = $this->Report_model->getFiles($deptname);
            return $this->load->view('report/filependency1',$data);
        }
    }

   public function statistical_report() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    if($this->session->userdata('role') === 'Super Admin') {
       $list = $this->Report_model->getAll();
    }
    else {
        $dept = $this->session->userdata('dept');
        $list = $this->Report_model->getAlldepartmental($dept);
    }


       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->dept."'".')"><i class="fas fa-trash"></i></a>';
         
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }

   public function statistical_report1() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    if($this->session->userdata('role') === 'Super Admin' ) {
       $list = $this->Report_model->getAlldirectorate();
    }
    


       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_directorate('."'".$cu->directorate."'".')"><i class="fas fa-trash"></i></a>';
         
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }


   public function statistical_report2() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    if($this->session->userdata('role') === 'Super Admin') {
       $list = $this->Report_model->getAlldistrict();
    }
    

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_district('."'".$cu->district."'".')"><i class="fas fa-trash"></i></a>';
         
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }

   public function statistical_report3() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    if($this->session->userdata('role') === 'Super Admin') {
       $list = $this->Report_model->getAllspoffice();
    }
    

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->live;
           $row[] = $cu->filescreated;
           $row[] = $cu->filesmoved;
           $row[] = $cu->receiptscreated;
           $row[] = $cu->receiptsmoved;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_spoffice('."'".$cu->spoffice."'".')"><i class="fas fa-trash"></i></a>';
         
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }

   public function files_report() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
  
       $list = $this->Report_model->getAll_files();
   
    
       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }


   public function files_report1() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
  
       $list = $this->Report_model->getAll_filesdirectorate();
   
    
       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }


   public function files_report2() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
  
       $list = $this->Report_model->getAll_filesdistrict();
   
    
       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }

   public function files_report3() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
  
       $list = $this->Report_model->getAll_filesspoffice();
   
    
       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all(),
           "recordsFiltered" => $this->Report_model->count_filtered(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }


/*
 * Callback function to check file value and type during validation
 */

 
public function import1(){
    $data = array();
    $memData = array();
    
    // If import request is submitted
    if($this->input->post('importSubmit')){
        // Form field validation rules
        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
        
        // Validate submitted form data
        if($this->form_validation->run() == true){
            $insertCount = $updateCount = $rowCount = $notAddCount = 0;
            
            // If file uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                // Load CSV reader library
                
                
                // Parse data from CSV file
                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                
                // Insert/update CSV data into database
                if(!empty($csvData)){
                    foreach($csvData as $row){ $rowCount++;
                        $d = $row['Office'];
                   
                       
                     
                       $type = $row['Type'];
                       if($type === 'Department') {
                        
                        $result = $this->Trainings_model->check($d);
                        // Prepare data for DB insertion
                        $memData = array(
                            'dept' => $result,
                            'live' => $row['Live_on_Date'], 
                            'filescreated' => $row['Files_Created'], 
                            'filesmoved' => $row['Files_Moved'], 
                            'receiptscreated' => $row['Receipts_Created'], 
                            'receiptsmoved' => $row['Receipts_Moved'], 
                            
                            
                        );
                        
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'dept' => $result
                            ),
                            'returnType' => 'count'
                        );
                        $prevCount = $this->Report_model->getRows($con);
                        $condition = array('dept' => $result);
                       }
                       else if($type === 'Directorate') {
                        $result1 = $this->Trainings_model->checkDirec($d);
                        $memData = array(
                            'directorate' => $result1,
                            'live' => $row['Live_on_Date'], 
                            'filescreated' => $row['Files_Created'], 
                            'filesmoved' => $row['Files_Moved'], 
                            'receiptscreated' => $row['Receipts_Created'], 
                            'receiptsmoved' => $row['Receipts_Moved'], 
                            
                            
                        );
                        
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'directorate' => $result1
                            ),
                            'returnType' => 'count'
                        );
                        $prevCount = $this->Report_model->getRows3($con);
                        $condition = array('directorate' => $result1);
                       }
                       else if($type === 'District') {
                        $result2 = $this->Trainings_model->checkDist($d);
                        $memData = array(
                            'district' => $result2,
                            'live' => $row['Live_on_Date'], 
                            'filescreated' => $row['Files_Created'], 
                            'filesmoved' => $row['Files_Moved'], 
                            'receiptscreated' => $row['Receipts_Created'], 
                            'receiptsmoved' => $row['Receipts_Moved'], 
                            
                            
                        );
                        
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'district' => $result2
                            ),
                            'returnType' => 'count'
                        );
                        $prevCount = $this->Report_model->getRows4($con);
                        $condition = array('district' => $result2);
                       }
                       else  if($type === 'SP Office'){
                        $result3 = $this->Trainings_model->checkSPofc($d);
                        $memData = array(
                            'spoffice' => $result3,
                            'live' => $row['Live_on_Date'], 
                            'filescreated' => $row['Files_Created'], 
                            'filesmoved' => $row['Files_Moved'], 
                            'receiptscreated' => $row['Receipts_Created'], 
                            'receiptsmoved' => $row['Receipts_Moved'], 
                            
                            
                        );
                        
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'spoffice' => $result3
                            ),
                            'returnType' => 'count'
                        );
                        $prevCount = $this->Report_model->getRows5($con);   
                         $condition = array('spoffice' => $result3);
                       }
                       else {}
                       
                    
                        
                        if($prevCount > 0){
                            
                            // Update member data
                        
                            
                            
                            $update = $this->Report_model->update1($memData, $condition);
                            
                            if($update){
                                $updateCount++;
                            }
                        }else{
                            // Insert member data
                            $insert = $this->Report_model->insert($memData);
                            
                            if($insert){
                                $insertCount++;
                            }
                        }
                    }
                    
                    // Status message with imported data count
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $successMsg = 'Details uploaded successfully...';
                    $this->session->set_userdata('success_msg', $successMsg);
                }
            }else{
                $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
            }
        }else{
            $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
        }
    }
    redirect('Report/report_eoffice');
}

public function file_check($str){
    $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
        $mime = get_mime_by_extension($_FILES['file']['name']);
        $fileAr = explode('.', $_FILES['file']['name']);
        $ext = end($fileAr);
        if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
            return true;
        }else{
            $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
            return false;
        }
    }else{
        $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
        return false;
    }
}

public function import2(){
    $data = array();
    $memData = array();
   
    // If import request is submitted
    if($this->input->post('importSubmit')){
        // Form field validation rules
        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
        
        // Validate submitted form data
        if($this->form_validation->run() == true){
            $insertCount = $updateCount = $rowCount = $notAddCount = 0;
            
            // If file uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                // Load CSV reader library
                
                
                // Parse data from CSV file
                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                
                // Insert/update CSV data into database
                if(!empty($csvData)){
                    foreach($csvData as $row){ $rowCount++;
                       
                        $d = $row['Office'];
                   
                       
                     
                        $type = $row['Type'];
                        if($type === 'Department') {
                         
                         $result = $this->Trainings_model->check($d);

                        // Prepare data for DB insertion
                        $memData = array(
                            'dept' => $result,
                            'live' => $row['Live on Date'],
                            'organisation' => $row['Organisation_Unit'], 
                            'value1' => $row['0-7days'], 
                            'value2' => $row['8-15days'], 
                            'value3' => $row['16-30days'], 
                            'value4' => $row['31-60days'], 
                            'value5' => $row['>60days'], 
                            
                            
                        );

                    }
                    else if($type === 'Directorate') {
                        $result1 = $this->Trainings_model->checkDirec($d);
                        $memData = array(
                            'directorate' => $result1,
                            'live' => $row['Live on Date'],
                            'organisation' => $row['Organisation_Unit'], 
                            'value1' => $row['0-7days'], 
                            'value2' => $row['8-15days'], 
                            'value3' => $row['16-30days'], 
                            'value4' => $row['31-60days'], 
                            'value5' => $row['>60days'], 
                            
                            
                        );

                    }
                    else if($type === 'District') {
                        $result2 = $this->Trainings_model->checkDist($d);
                        $memData = array(
                            'district' => $result2,
                            'live' => $row['Live on Date'],
                            'organisation' => $row['Organisation_Unit'], 
                            'value1' => $row['0-7days'], 
                            'value2' => $row['8-15days'], 
                            'value3' => $row['16-30days'], 
                            'value4' => $row['31-60days'], 
                            'value5' => $row['>60days'], 
                            
                            
                        );
                    }
                    else if($type === 'SP Office') {
                        $result3 = $this->Trainings_model->checkSPofc($d);
                        $memData = array(
                            'spoffice' => $result3,
                            'live' => $row['Live on Date'],
                            'organisation' => $row['Organisation_Unit'], 
                            'value1' => $row['0-7days'], 
                            'value2' => $row['8-15days'], 
                            'value3' => $row['16-30days'], 
                            'value4' => $row['31-60days'], 
                            'value5' => $row['>60days'], 
                            
                            
                        );
                    }
                    else {}
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'organisation' => $row['Organisation_Unit']
                            ),
                            'returnType' => 'count'
                        );
                   
                        $prevCount = $this->Report_model->getRows1($con);
                    
                   
                        if($prevCount > 0){
                            // Update member data
                            $condition = array('organisation' => $row['Organisation_Unit']);
                            $update = $this->Report_model->update2($memData, $condition);
                            
                            if($update){
                                $updateCount++;
                            }
                        }else{
                            // Insert member data
                            $insert = $this->Report_model->insert1($memData);
                            
                            if($insert){
                                $insertCount++;
                            }
                        }
                    }
                    
                    // Status message with imported data count
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $successMsg = 'Details uploaded successfully...';
                    $this->session->set_userdata('success_msg', $successMsg);
                }
            }else{
                $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
            }
        }else{
            $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
        }
    }
    redirect('Report/filependency');
}



    public function import3(){
        $data = array();
        $memData = array();
     
        
        // If import request is submitted
        if($this->input->post('importSubmit')){
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            // Validate submitted form data
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                    
                    
                    // Parse data from CSV file
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    // Insert/update CSV data into database
                    if(!empty($csvData)){
                        foreach($csvData as $row){ $rowCount++;
                            $d = $row['Office'];
                   
                       
                     
                        $type = $row['Type'];
                        if($type === 'Department') {
                         
                         $result = $this->Trainings_model->check($d);

                            // Prepare data for DB insertion
                            $memData = array(
                                'dept' => $result,
                                'organisation' => $row['Organisation_Unit'], 
                                'live' => $row['Live on Date'],
                                'value1' => $row['0-7days'], 
                                'value2' => $row['8-15days'], 
                                'value3' => $row['16-30days'], 
                                'value4' => $row['31-60days'], 
                                'value5' => $row['>60days'], 
                                
                                
                            );

                        }
                        else if($type === 'Directorate') {
                            $result1 = $this->Trainings_model->checkDirec($d);
                            $memData = array(
                                'directorate' => $result1,
                                'organisation' => $row['Organisation_Unit'],
                                'live' => $row['Live on Date'], 
                                'value1' => $row['0-7days'], 
                                'value2' => $row['8-15days'], 
                                'value3' => $row['16-30days'], 
                                'value4' => $row['31-60days'], 
                                'value5' => $row['>60days'], 
                                
                                
                            );
                        }
                        else if($type === 'District') {
                            $result2 = $this->Trainings_model->checkDist($d);
                            $memData = array(
                                'district' => $result2,
                                'organisation' => $row['Organisation_Unit'], 
                                'live' => $row['Live on Date'],
                                'value1' => $row['0-7days'], 
                                'value2' => $row['8-15days'], 
                                'value3' => $row['16-30days'], 
                                'value4' => $row['31-60days'], 
                                'value5' => $row['>60days'], 
                                
                                
                            );
                        }
                        else if($type === 'SP Office') {
                            $result3 = $this->Trainings_model->checkSPofc($d);
                            $memData = array(
                                'spoffice' => $result3,
                                'organisation' => $row['Organisation_Unit'], 
                                'live' => $row['Live on Date'],
                                'value1' => $row['0-7days'], 
                                'value2' => $row['8-15days'], 
                                'value3' => $row['16-30days'], 
                                'value4' => $row['31-60days'], 
                                'value5' => $row['>60days'], 
                                
                                
                            );
                        } else {}
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'organisation' => $row['Organisation_Unit']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Report_model->getRows2($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('organisation' => $row['Organisation_Unit']);
                                $update = $this->Report_model->update3($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                            // Insert member data
                            $insert = $this->Report_model->insert3($memData);
                            
                            if($insert){
                                $insertCount++;
                            }
                        }
                    }
                    
                    // Status message with imported data count
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $successMsg = 'Details uploaded successfully...';
                    $this->session->set_userdata('success_msg', $successMsg);
                }
            }else{
                $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
            }
        }else{
            $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
        }
    }
    redirect('Report/receiptpendency');
}

    
   public function receipts_report() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

  
       $list = $this->Report_model->getAll_receipts();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all_receipts(),
           "recordsFiltered" => $this->Report_model->count_filtered_receipts(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }
   public function receipts_report1() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

  
       $list = $this->Report_model->getAll_receiptsdirectorate();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all_receipts(),
           "recordsFiltered" => $this->Report_model->count_filtered_receipts(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }
   public function receipts_report2() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

  
       $list = $this->Report_model->getAll_receiptsdistrict();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all_receipts(),
           "recordsFiltered" => $this->Report_model->count_filtered_receipts(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }
   public function receipts_report3() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

  
       $list = $this->Report_model->getAll_receiptsspoffice();

       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->dname;
           $row[] = $cu->organisation;
           $row[] = $cu->live;
           $row[] = $cu->value1;
           $row[] = $cu->value2;
           $row[] = $cu->value3;
           $row[] = $cu->value4;
           $row[] = $cu->value5;
          
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cu->organisation."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
           $data[] = $row;
       }
    
       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Report_model->count_all_receipts(),
           "recordsFiltered" => $this->Report_model->count_filtered_receipts(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }


   public function import4(){
    $data = array();
    $memData = array();
    $directorate = $this->input->post('directorate');
    $directorate1 = $this->session->userdata('directorate');
    
    // If import request is submitted
    if($this->input->post('importSubmit')){
        // Form field validation rules
        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
        
        // Validate submitted form data
        if($this->form_validation->run() == true){
            $insertCount = $updateCount = $rowCount = $notAddCount = 0;
            
            // If file uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                // Load CSV reader library
                
                
                // Parse data from CSV file
                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                
                // Insert/update CSV data into database
                if(!empty($csvData)){
                    foreach($csvData as $row){ $rowCount++;
                        if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {
                        
                        // Prepare data for DB insertion
                        $memData = array(
                            'directorate' => $directorate,
                            'live' => $row['Live_on_Date'], 
                            'filescreated' => $row['Files_Created'], 
                            'filesmoved' => $row['Files_Moved'], 
                            'receiptscreated' => $row['Receipts_Created'], 
                            'receiptsmoved' => $row['Receipts_Moved'], 
                            
                            
                        );
                        
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'directorate' => $directorate
                            ),
                            'returnType' => 'count'
                        );
                    } else {
                        $memData = array(
                            'directorate' => $directorate1,
                            'live' => $row['Live_on_Date'], 
                            'filescreated' => $row['Files_Created'], 
                            'filesmoved' => $row['Files_Moved'], 
                            'receiptscreated' => $row['Receipts_Created'], 
                            'receiptsmoved' => $row['Receipts_Moved'], 
                            
                            
                        );
                        
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'directorate' => $directorate1
                            ),
                            'returnType' => 'count'
                        );
                    }
                        $prevCount = $this->Report_model->getRows3($con);
                        
                        if($prevCount > 0){
                            if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {
                        
                       
                            // Update member data
                            $condition = array('directorate' => $directorate);
                            }
                            else {
                                $condition = array('directorate' => $directorate1);
                            }
                            $update = $this->Report_model->update4($memData, $condition);
                            
                            if($update){
                                $updateCount++;
                            }
                        }else{
                            // Insert member data
                            $insert = $this->Report_model->insert4($memData);
                            
                            if($insert){
                                $insertCount++;
                            }
                        }
                    }
                    
                    // Status message with imported data count
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $successMsg = 'Details uploaded successfully...';
                    $this->session->set_userdata('success_msg', $successMsg);
                }
            }else{
                $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
            }
        }else{
            $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
        }
    }
    redirect('Report/report_directorate');
}


public function import5(){
    $data = array();
    $memData = array();
    $district = $this->input->post('district');
    
    // If import request is submitted
    if($this->input->post('importSubmit')){
        // Form field validation rules
        $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
        
        // Validate submitted form data
        if($this->form_validation->run() == true){
            $insertCount = $updateCount = $rowCount = $notAddCount = 0;
            
            // If file uploaded
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                // Load CSV reader library
                
                
                // Parse data from CSV file
                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                
                // Insert/update CSV data into database
                if(!empty($csvData)){
                    foreach($csvData as $row){ $rowCount++;
                        
                        // Prepare data for DB insertion
                        $memData = array(
                            'district' => $district,
                            'live' => $row['Live_on_Date'], 
                            'filescreated' => $row['Files_Created'], 
                            'filesmoved' => $row['Files_Moved'], 
                            'receiptscreated' => $row['Receipts_Created'], 
                            'receiptsmoved' => $row['Receipts_Moved'], 
                            
                            
                        );
                        
                        // Check whether email already exists in the database
                        $con = array(
                            'where' => array(
                                'district' => $district
                            ),
                            'returnType' => 'count'
                        );
                        $prevCount = $this->Report_model->getRows4($con);
                        
                        if($prevCount > 0){
                            // Update member data
                            $condition = array('district' => $district);
                            $update = $this->Report_model->update5($memData, $condition);
                            
                            if($update){
                                $updateCount++;
                            }
                        }else{
                            // Insert member data
                            $insert = $this->Report_model->insert5($memData);
                            
                            if($insert){
                                $insertCount++;
                            }
                        }
                    }
                    
                    // Status message with imported data count
                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
                    $successMsg = 'Details uploaded successfully...';
                    $this->session->set_userdata('success_msg', $successMsg);
                }
            }else{
                $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
            }
        }else{
            $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
        }
    }
    redirect('Report/report_district');
}

}
?>