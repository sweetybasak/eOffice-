<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Trainings extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Trainings_model');
        $this->load->model('Training_filter_model');
        $this->load->model('Package_model','package_model');
        $this->load->model('AdminInfra_model','adminInfra_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('CSVReader');
     
        $this->load->library('session');
        $this->load->helper('security');

    }

    public function index() {
        $data['deptname'] = $this->Trainings_model->fetch_filter_type('deptname');
        $data['course'] = $this->Trainings_model->fetch_filter_type('course');
        $data['venue'] = $this->Trainings_model->fetch_filter_type('venue');
        $this->load->view('trainings/filter',$data);
    }

    public function fetch_data() {
        sleep(1);
      
        $deptname = $this->input->post('deptname');
        $course = $this->input->post('course');
        $venue = $this->input->post('venue');
        $output = array(
            'trainings_list' => $this->Trainings_model->fetch_data($deptname, $course, $venue)
        );
        echo json_encode($output);
    }

    public function view(){
        $this->load->view('trainings/home');
    }

    public function courses() {
        $data['deptname'] = $this->Trainings_model->fetch_filter_type('deptname');
        $data['courses'] = $this->trainings_model->fetch_filter_type('courses');
        $data['venue'] = $this->trainings_model->fetch_filter_type('venue');
        $this->load->view('trainings/courses',$data);
    }
    public function home() {
        $data['data'] = $this->Trainings_model->getCourses();
      
        $this->load->view('trainings/home',$data);
    }

    public function course() {
        $data['data'] = $this->Trainings_model->getCourse();
        $this->load->view('trainings/course',$data);
    }

    public function dept() {
        $data['data'] = $this->Trainings_model->getdepartment();
        $this->load->view('trainings/dept',$data);
    }

    public function departmentalreport() {
        $data['data'] = $this->Trainings_model->getDepartmentalReport();
        $this->load->view('trainings/departmentalreport',$data);
    }

    

    public function filter() {
        $this->load->helper('url');
        $this->load->helper('form');
        $courses = $this->trainings_model->get_course();

        $opt = array('' => 'All Courses');
        foreach($courses as $cour) {
            $opt[$cour] = $cour;
        }

        $data['form_course'] = form_dropdown('',$opt,'','id="courseid" class="form-control"');
        $this->load->view('trainings/train', $data);

    }

    public function ajax_list() {
        $list = $this->trainings_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $trainings) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $trainings->title;
            $row[] = $trainings->courseid;

            $data[] = $row;
        }

        $output = array("draw" => $_POST['draw'],
            "recordsTotal" => $this->trainings_model->count_all(),
            "recordsFiltered" => $this->trainings_model->count_filtered(),
            "data" => $data,
    );
    echo json_encode($output);
    }

    private function logged_in(){
       
        if($this->session->userdata('logged_in') !== TRUE) {
            redirect('login');
        }
    }
    
    public function course1(){
        $this->logged_in();
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        
        $this->load->view('admin/trainings/courses',$data);
    }
    public function designation(){
        $this->logged_in();
        $this->load->view('admin/governance/designation');
    }
    public function venue(){
        $this->logged_in();
        $this->load->view('admin/governance/venue');
    }
    public function dept1(){
        $this->logged_in();
        $this->load->view('admin/governance/department1');
    }

    public function district(){
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
        
        $this->load->view('admin/governance/district',$data);
    }
    public function spoffice(){
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
        
        $this->load->view('admin/governance/spoffice',$data);
    }

    public function trainings() {
        $this->logged_in();
        $data['all'] = $this->package_model->getAll();
        $data['dept'] = $this->package_model->get_dept();
        $data['training'] = $this->Trainings_model->getTrain();
        $data['designation'] = $this->Trainings_model->getDesignation();
        $course = $this->Training_filter_model->getCourse();
        $venue = $this->Training_filter_model->getVenue();
       
    
    
        $opt1 = array('0' => 'Select Courses');
        foreach($course as $c) {
            $opt1[$c->id] = $c->name;
        }
        $opt2 = array('0' => 'Select Venue');
        foreach($venue as $v) {
            $opt2[$v->id] = $v->name;
        }
    
       
        $data['form_course'] = form_dropdown('',$opt1,'','id="course" class="form-control"');
        $data['form_venue'] = form_dropdown('',$opt2,'','id="venue" class="form-control"');
        
        $this->load->view('admin/trainings/programmes',$data);
        
    }

    public function ajax_list_course()
    {
        $list = $this->Trainings_model->get_datatables_course();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->name;
                    
            
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_course('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_course('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Trainings_model->count_all_course(),
                        "recordsFiltered" => $this->Trainings_model->count_filtered_course(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit_course($id)
    {
        $data = $this->Trainings_model->get_by_id_course($id);
       
        echo json_encode($data);
    }
 
    public function ajax_add_course()
    {
        $this->_validate();
        
        $data = array(
                'name' => $this->input->post('name'),
               
                
            );
        $insert = $this->Trainings_model->save_course($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update_course()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
              
              
            );
        $this->Trainings_model->update_course(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete_course($id)
    {
        $this->Trainings_model->delete_by_id_course($id);
        echo json_encode(array("status" => TRUE));
    }
    
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Course name is required';
            $data['status'] = FALSE;
        }
 
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function participants() {
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
        if($this->session->userdata('success_msg1')){
            $data['success_msg1'] = $this->session->userdata('success_msg1');
            $this->session->unset_userdata('success_msg1');
        }
        if($this->session->userdata('error_msg1')){
            $data['error_msg1'] = $this->session->userdata('error_msg1');
            $this->session->unset_userdata('error_msg1');
        }
        if($this->session->userdata('success_msg2')){
            $data['success_msg2'] = $this->session->userdata('success_msg2');
            $this->session->unset_userdata('success_msg2');
        }
        if($this->session->userdata('error_msg2')){
            $data['error_msg2'] = $this->session->userdata('error_msg2');
            $this->session->unset_userdata('error_msg2');
        }
        if($this->session->userdata('success_msg3')){
            $data['success_msg3'] = $this->session->userdata('success_msg3');
            $this->session->unset_userdata('success_msg3');
        }
        if($this->session->userdata('error_msg3')){
            $data['error_msg3'] = $this->session->userdata('error_msg3');
            $this->session->unset_userdata('error_msg3');
        }
        if($this->session->userdata('success_msg4')){
            $data['success_msg4'] = $this->session->userdata('success_msg4');
            $this->session->unset_userdata('success_msg4');
        }
        if($this->session->userdata('error_msg4')){
            $data['error_msg4'] = $this->session->userdata('error_msg4');
            $this->session->unset_userdata('error_msg4');
        }
        
        // Get rows
       
        
      
        $dept = $this->session->userdata('dept');
        $directorate = $this->session->userdata('directorate');
        $district = $this->session->userdata('district');
        $spoffice = $this->session->userdata('spoffice');
        if($this->session->userdata('role') === 'Super Admin') {
            $data['training'] = $this->Trainings_model->getfilterTrainings();
        $data['training1'] = $this->Trainings_model->getDirectorateTrainings();
        $data['training2'] = $this->Trainings_model->getDistrictTrainings();
        $data['training3'] = $this->Trainings_model->getSPOfficeTrainings();
        $data['training4'] = $this->Trainings_model->getCombinedTrainings();
        }
        else {
        if($this->session->userdata('officetype') === 'Departmental') {
        $data['departmental'] = $this->Trainings_model->getfilterTrainingsDepartmental($dept);
        }
        else if($this->session->userdata('officetype') === 'Directorates') {
       
        
        $data['directorate1'] = $this->Trainings_model->getfilterTrainingsD($directorate);
        } else if($this->session->userdata('officetype') === 'District') {
            $data['dtraining'] = $this->Trainings_model->getDTrainings($district);
        }
        else {
            $data['sptraining'] = $this->Trainings_model->getSPTrainings($spoffice);
        }
        
    }
        
    
        $data['designation'] = $this->Trainings_model->getDesignation();
        $this->load->view("admin/trainings/addparticipants",$data);
    }


    
    public function import(){
        $data = array();
        $memData = array();
        $training = $this->input->post('training');
        
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
                                'trainingsid' => $training,
                                'name' => $row['Name'], 
                                'email' => $row['Email'], 
                                'phone' => $row['Phone'], 
                                'dname' => $row['Department'], 
                                'type' => $row['Type'], 
                                'designation' => $row['Designation']
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'trainingsid' => $training,
                                   
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Trainings_model->getRows($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('trainingsid' => $training,
                                                'email' => $row['Email']);
                                $update = $this->Trainings_model->update($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->Trainings_model->insert($memData);
                                
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
        redirect('Trainings/participants');
    }

    private function validation(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('training') == '')
        {
            $data['inputerror'][] = 'training';
            $data['error_string'][] = 'Training name is required';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('file') == '')
        {
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'Choose File';
            $data['status'] = FALSE;
        }
 
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


    public function import1(){
        
        $data = array();
        $memData = array();
        $training = $this->input->post('training');
        
        // If import request is submitted
        if($this->input->post('importSubmit1')){
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
                            $d = $row['Directorates'];
                            $result = $this->Trainings_model->checkDirec($d);
                            // Prepare data for DB insertion
                            $memData = array(
                                'trainingsid' => $training,
                                'name' => $row['Name'], 
                                'email' => $row['Email'], 
                                'phone' => $row['Phone'], 
                                'direct' => $result, 
                                'type' => $row['Type'], 
                                'designation' => $row['Designation']
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'trainingsid' => $training,
                                    'email' => $row['Email']
                                   
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Trainings_model->getRows1($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('trainingsid' => $training,
                                                'email' => $row['Email']);
                                $update = $this->Trainings_model->update1($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->Trainings_model->insert1($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg1 = 'Details uploaded successfully...';
                        $this->session->set_userdata('success_msg1', $successMsg1);
                    }
                }else{
                    $this->session->set_userdata('error_msg1', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg1', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('participants_add');
    }




    public function import2(){
        $data = array();
        $memData = array();
        $training = $this->input->post('training');
        
        // If import request is submitted
        if($this->input->post('importSubmit2')){
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
                            $d=$row['District'];
                            $result = $this->Trainings_model->checkDist($d);
                            // Prepare data for DB insertion
                            $memData = array(
                                'trainingsid' => $training,
                                'name' => $row['Name'], 
                                'email' => $row['Email'], 
                                'phone' => $row['Phone'], 
                                'dist' => $result, 
                                'type' => $row['Type'], 
                                'designation' => $row['Designation']
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'trainingsid' => $training,
                                    'email' => $row['Email']
                                   
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Trainings_model->getRows2($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('trainingsid' => $training,
                                                'email' => $row['Email']);
                                $update = $this->Trainings_model->update2($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->Trainings_model->insert2($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg2 = 'Details uploaded successfully...';
                        $this->session->set_userdata('success_msg2', $successMsg2);
                    }
                }else{
                    $this->session->set_userdata('error_msg2', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg2', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('participants_add');
    }



    public function import3(){
        $data = array();
        $memData = array();
        $training = $this->input->post('training');
        
        // If import request is submitted
        if($this->input->post('importSubmit3')){
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
                            $d = $row['SP Office'];
                            $result = $this->Trainings_model->checkSPofc($d);
                            // Prepare data for DB insertion
                            $memData = array(
                                'trainingsid' => $training,
                                'name' => $row['Name'], 
                                'email' => $row['Email'], 
                                'phone' => $row['Phone'], 
                                'spofc' => $result, 
                                'type' => $row['Type'], 
                                'designation' => $row['Designation']
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'trainingsid' => $training,
                                    'email' => $row['Email']
                                   
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Trainings_model->getRows3($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('trainingsid' => $training,
                                                'email' => $row['Email']);
                                $update = $this->Trainings_model->update3($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->Trainings_model->insert3($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg3 = 'Details uploaded successfully...';
                        $this->session->set_userdata('success_msg3', $successMsg3);
                    }
                }else{
                    $this->session->set_userdata('error_msg3', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg3', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('participants_add');
    }

    public function import4(){
        $data = array();
        $memData = array();
        $training = $this->input->post('training');
        
        // If import request is submitted
        if($this->input->post('importSubmit4')){
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
                            $d = $row['Department'];
                            $result = $this->Trainings_model->check($d);
                            $d1 = $row['Directorates'];
                            $result1 = $this->Trainings_model->checkDirec($d1);
                            $d2 = $row['District'];
                            $result2 = $this->Trainings_model->checkDist($d2);
                            $d3 = $row['SP Office'];
                            $result3 = $this->Trainings_model->checkSPofc($d3);
                            // Prepare data for DB insertion
                            $memData = array(
                                'trainingsid' => $training,
                                'name' => $row['Name'], 
                                'email' => $row['Email'], 
                                'phone' => $row['Phone'], 
                                'dept' => $result, 
                                'direct' => $result1,
                                'dist' => $result2, 
                                'spofc' => $result3,
                                
                                'type' => $row['Type'], 
                                'designation' => $row['Designation']
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'trainingsid' => $training,
                                    'email' => $row['Email']
                                   
                                ),
                                'returnType' => 'count'
                            );
                            
                          
                            $prevCount = $this->Trainings_model->getRows4($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('trainingsid' => $training,
                                                'email' => $row['Email']);
                                $update = $this->Trainings_model->update4($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->Trainings_model->insert4($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg4 = 'Details uploaded successfully...';
                        $this->session->set_userdata('success_msg4', $successMsg4);
                    }
                }else{
                    $this->session->set_userdata('error_msg4', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg4', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('participants_add');
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


    public function participants1() {
        $data['training'] = $this->Trainings_model->getTrain();
        $data['designation'] = $this->Trainings_model->getDesignation();
        $this->load->view("admin/trainings/participants",$data);
    }
    
    public function getDept() {
        $training = $this->input->post('id',TRUE);
        $data = $this->Trainings_model->getDept2($training);
        echo json_encode($data);
    }


    public function dreport() {


        $dept= $this->Training_filter_model->getDepartment();
        $type = $this->Training_filter_model->getTrainingType();
        $type1 = $this->Training_filter_model->getParticipantType();
        $directorate = $this->Training_filter_model->getDirectorate();
        $district = $this->Training_filter_model->getDistrict();
        $spoffice = $this->Training_filter_model->getSPOffice();
        $opt3 = array('' => 'All Directorate');
        foreach($directorate as $v) {
            $opt3[$v->id] = $v->name;
        }
        $opt4 = array('' => 'All Districts');
        foreach($district as $v) {
            $opt4[$v->id] = $v->name;
        }
       
        $opt5 = array('' => 'All SP Offices');
        foreach($spoffice as $v) {
            $opt5[$v->id] = $v->name;
        }
        $opt = array('' => 'All Department');
        foreach($dept as $d) {
            $opt[$d->id] = $d->dname;
        }
        $opt6 = array('' => 'All Training Type');
        foreach($type as $v) {
            $opt6[$v->name] = $v->name;
        }
        $opt7 = array('' => 'All Participant Type');
        foreach($type1 as $v) {
            $opt7[$v->name] = $v->name;
        }
        $data['form_directorate'] = form_dropdown('',$opt3,'','id="directorate" class="form-control"');
     
        $data['form_dept'] = form_dropdown('',$opt,'','id="dname" class="form-control"');
        $data['form_trainingtype'] = form_dropdown('',$opt6,'','id="trainingtype" class="form-control"');
        $data['form_participantype'] = form_dropdown('',$opt7,'','id="participanttype" class="form-control"');
        $data['form_trainingtype1'] = form_dropdown('',$opt6,'','id="trainingtype1" class="form-control"');
        $data['form_participantype1'] = form_dropdown('',$opt7,'','id="participanttype1" class="form-control"');
        $data['form_trainingtype2'] = form_dropdown('',$opt6,'','id="trainingtype2" class="form-control"');
        $data['form_participantype2'] = form_dropdown('',$opt7,'','id="participanttype2" class="form-control"');
        $data['form_trainingtype3'] = form_dropdown('',$opt6,'','id="trainingtype3" class="form-control"');
        $data['form_participantype3'] = form_dropdown('',$opt7,'','id="participanttype3" class="form-control"');
        
        $data['form_district'] = form_dropdown('',$opt4,'','id="district" class="form-control"');
        $data['form_spoffice'] = form_dropdown('',$opt5,'','id="spoffice" class="form-control"');
     
           $this->load->view('trainings/departmentalreport',$data);
           
     }

     public function ajax_list2() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
           $list = $this->Training_filter_model->get_report();
    
           $data = array();
          
        
           foreach($list as $cu) {
              
               
               $row = array();
             
               $row[] = $cu->dname;
               $row[] = $cu->train; 
               $row[] = $cu->users; 
               $data[] = $row;
           }
    
           $output = array(
               "draw" => $draw,
               
               "data" => $data,
           );
           echo json_encode($output);
           exit();
       }

      

     public function ajax_list3() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
           $list = $this->Training_filter_model->get_report1();
    
           $data = array();
          
        
           foreach($list as $cu) {
              
               
               $row = array();
             
               $row[] = $cu->dname;
               $row[] = $cu->train; 
               $row[] = $cu->users; 
               $data[] = $row;
           }
    
           $output = array(
               "draw" => $draw,
               
               "data" => $data,
           );
           echo json_encode($output);
           exit();
       }


     
     public function ajax_list4() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
           $list = $this->Training_filter_model->get_report2();
    
           $data = array();
          
        
           foreach($list as $cu) {
              
               
               $row = array();
             
               $row[] = $cu->dname;
               $row[] = $cu->train; 
               $row[] = $cu->users; 
               $data[] = $row;
           }
    
           $output = array(
               "draw" => $draw,
               
               "data" => $data,
           );
           echo json_encode($output);
           exit();
       }


     public function ajax_list5() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
           $list = $this->Training_filter_model->get_report3();
    
           $data = array();
          
        
           foreach($list as $cu) {
              
               
               $row = array();
             
               $row[] = $cu->dname;
               $row[] = $cu->train; 
               $row[] = $cu->users; 
               $data[] = $row;
           }
    
           $output = array(
               "draw" => $draw,
               
               "data" => $data,
           );
           echo json_encode($output);
           exit();
       }

       public function importd(){
        
        $data = array();
        $memData = array();
        $training = $this->input->post('training');
        
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
                            $d = $row['Department'];
                            $result = $this->Trainings_model->check($d);
                            // Prepare data for DB insertion
                            $memData = array(
                                'trainingsid' => $training,
                                'name' => $row['Name'], 
                                'email' => $row['Email'], 
                                'phone' => $row['Phone'], 
                                'dept' => $result, 
                                'type' => $row['Type'], 
                                'designation' => $row['Designation']
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'trainingsid' => $training,
                                    'email' => $row['Email']
                                   
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->Trainings_model->getRows($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('trainingsid' => $training,
                                                'email' => $row['Email']);
                                $update = $this->Trainings_model->update($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->Trainings_model->insert($memData);
                                
                                if($insert){
                                    $insertCount++;
                                }
                            }
                        }
                        
                        // Status message with imported data count
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg= 'Details uploaded successfully...';
                        $this->session->set_userdata('success_msg1', $successMsg);
                    }
                }else{
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('participants_add');
    }



}
?>