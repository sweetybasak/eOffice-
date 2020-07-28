<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminInfra extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('AdminInfra_model','adminInfra_model');
        $this->load->model('Dashboard_model','dashboard');
        $this->load->model('Infra_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
        $this->load->library('CSVReader');
        $this->load->library('session');
        $this->logged_in();

    }

    private function logged_in(){
       
        if($this->session->userdata('logged_in') !== TRUE) {
            redirect('login');
        }
    }


    public function infra() {
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
        $data['secretariat'] = $this->adminInfra_model->getRows();
        $this->load->view('admin/infra/secretariat',$data);
    }
    public function spoffice() {
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
        $data['secretariat'] = $this->adminInfra_model->getRows();
        $this->load->view('admin/infra/spoffice',$data);
    }
    
    
    

    public function directorate() {
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
        $dept = $this->session->userdata('dept');
        // Get rows
        $data['directorate'] = $this->adminInfra_model->getRows();
       $data['director'] = $this->adminInfra_model->getDirectorate_dept($dept);
        $this->load->view('admin/infra/directorate',$data);
    }
    public function office() {
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
       
        $this->load->view('admin/infra/office',$data);
    }
    public function district() {
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
        $data['district'] = $this->adminInfra_model->getRows1();
        
        $this->load->view('admin/infra/district',$data);
    }

    public function ajax_list()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        if($this->session->userdata('role') === 'Super Admin') {
        $list = $this->adminInfra_model->getAll();
        }
        else {
            $dept = $this->session->userdata('dept');
            $list = $this->adminInfra_model->getAllinfra($dept);

        }
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->deptname;
                    
            $row[] =$r->total_users;
            $row[] = $r->users_system; 
            $row[] =$r->new_system;
            $row[] =  $r->dsc; 
            $row[] = $r->scanners; 
            $row[] = $r->printers;
            $row[] = $r->dsc_required; 
            $row[] = $r->printer_required; 
            $row[] = $r->scanners_required; 
            $row[] = $r->system_required;
            $row[] = $r->isp;
            $row[] = $r->bandwidth; 

            if($r->cabling === 'yes') {
                $row[] = '<button class="btn btn-success">Yes</button>';
            }
           else {
            $row[] = '<button class = "btn btn-danger">No</button>';
       
           }
           
            
           if(!($this->session->userdata('role') === 'Departmental Users' || $this->session->userdata('role') === 'EMD Managers')) {
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$r->dept."'".')"><i class="fas fa-trash fa-lg"></i></a>';
           }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->adminInfra_model->count_all(),
                        "recordsFiltered" => $this->adminInfra_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($dept)
    {
        $data = $this->adminInfra_model->get_by_id($dept);
       
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'address' => $this->input->post('address'),
                
            );
        $insert = $this->adminInfra_model->save($data);
        echo json_encode(array("status" => TRUE));
    }
 

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'address' => $this->input->post('address'),
              
            );
        $this->adminInfra_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($dept)
    {
        $this->adminInfra_model->delete_by_id($dept);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('firstname') == '')
        {
            $data['inputerror'][] = 'firstname';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('lastname') == '')
        {
            $data['inputerror'][] = 'lastname';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }
 
      
 
        if($this->input->post('gender') == '')
        {
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'Please select gender';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('address') == '')
        {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 



    public function ajax_list_directorate()
    {
       
        $list = $this->adminInfra_model->getAll_directorate();
        
       
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->direct;
                    
            $row[] =$r->total_users;
            $row[] = $r->users_system; 
            $row[] =$r->new_system;
            $row[] =  $r->dsc; 
            $row[] = $r->scanners; 
            $row[] = $r->printers;
            $row[] = $r->dsc_required; 
            $row[] = $r->printer_required; 
            $row[] = $r->scanners_required; 
            $row[] = $r->system_required;
            $row[] = $r->isp;
            $row[] = $r->bandwidth; 
            if($r->cabling === 'yes') {
                $row[] = '<button class="btn btn-success">Yes</button>';
            }
           else {
            $row[] = '<button class = "btn btn-danger">No</button>';
       
           }
            
           
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_directorate('."'".$r->directorate."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->adminInfra_model->count_all_directorate(),
                        "recordsFiltered" => $this->adminInfra_model->count_filtered_directorate(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_delete_directorate($directorate)
    {
        $this->adminInfra_model->delete_by_id_directorate($directorate);
        echo json_encode(array("status" => TRUE));
    }
 
 
    public function ajax_list_district()
    {
        $list = $this->adminInfra_model->getAll_district();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->districtname;
                    
            $row[] =$r->total_users;
            $row[] = $r->users_system; 
            $row[] =$r->new_system;
            $row[] =  $r->dsc; 
            $row[] = $r->scanners; 
            $row[] = $r->printers;
            $row[] = $r->dsc_required; 
            $row[] = $r->printer_required; 
            $row[] = $r->scanners_required; 
            $row[] = $r->system_required;
            $row[] = $r->isp;
            $row[] = $r->bandwidth; 
            if($r->cabling === 'yes') {
                $row[] = '<button class="btn btn-success">Yes</button>';
            }
           else {
            $row[] = '<button class = "btn btn-danger">No</button>';
       
           } 
            
           
 
            //add html for action
            $row[] = ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_district('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->adminInfra_model->count_all_district(),
                        "recordsFiltered" => $this->adminInfra_model->count_filtered_district(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list_spoffice()
    {
        $list = $this->adminInfra_model->getAll_spoffice();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->districtname;
                    
            $row[] =$r->total_users;
            $row[] = $r->users_system; 
            $row[] =$r->new_system;
            $row[] =  $r->dsc; 
            $row[] = $r->scanners; 
            $row[] = $r->printers;
            $row[] = $r->dsc_required; 
            $row[] = $r->printer_required; 
            $row[] = $r->scanners_required; 
            $row[] = $r->system_required;
            $row[] = $r->isp;
            $row[] = $r->bandwidth; 
            if($r->cabling === 'yes') {
                $row[] = '<button class="btn btn-success">Yes</button>';
            }
           else {
            $row[] = '<button class = "btn btn-danger">No</button>';
       
           } 
            
           
 
            //add html for action
            $row[] = ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_spoffice('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->adminInfra_model->count_all_district(),
                        "recordsFiltered" => $this->adminInfra_model->count_filtered_district(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 

 
    public function ajax_delete_district($district)
    {
        $this->adminInfra_model->delete_by_id_district($district);
        echo json_encode(array("status" => TRUE));
    }
 
 
   
   



    public function import1(){
        $data = array();
        $memData = array();
        $dept = $this->input->post('dept');
        $dept1 = $this->session->userdata('dept');
        
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
                            if($this->session->userdata('role') === 'Super Admin') {
                            
                            // Prepare data for DB insertion
                            $memData = array(
                                'dept' => $dept,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'dept' => $dept
                                ),
                                'returnType' => 'count'
                            );
                        }
                        else {
                            $memData = array(
                                'dept' => $dept1,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'dept' => $dept1
                                ),
                                'returnType' => 'count'
                            );
                        }
                            $prevCount = $this->adminInfra_model->getRows($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                if($this->session->userdata('role') === 'Super Admin') {
                           
                                $condition = array('dept' => $dept);
                                } else {
                                    $condition = array('dept' => $dept1);
                                }
                                $update = $this->adminInfra_model->update1($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->adminInfra_model->insert($memData);
                                
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
        redirect('adminInfra/infra');
    }
    
    /*
     * Callback function to check file value and type during validation
     */
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
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'district' => $district
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->adminInfra_model->getRows1($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('district' => $district);
                                $update = $this->adminInfra_model->update2($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->adminInfra_model->insert1($memData);
                                
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
        redirect('adminInfra/district');
    }



    
    public function import3(){
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
                            
                            // Prepare data for DB insertion
                            if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {
                            
                                $memData = array(
                                'directorate' => $directorate,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'directorate' => $directorate
                                ),
                                'returnType' => 'count'
                            );
                        }
                        else {
                           
                            $memData = array(
                                'directorate' => $directorate1,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'directorate' => $directorate1
                                ),
                                'returnType' => 'count'
                            );
                        
                       

                        }
                            $prevCount = $this->adminInfra_model->getRows2($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                if($this->session->userdata('role') === 'Super Admin' || $this->session->userdata('role') === 'Admin') {
                            
                                $condition = array('directorate' => $directorate);
                                } else {
                                    $condition = array('directorate' => $directorate1);
                                }
                                $update = $this->adminInfra_model->update3($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->adminInfra_model->insert2($memData);
                                
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
        redirect('adminInfra/directorate');
    }
    
    public function import4() {
        $data = array();
        $memData = array();
        $spoffice = $this->input->post('spoffice');
        
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
                                'spoffice' => $spoffice,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'spoffice' => $district
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->adminInfra_model->getRows6($con);
                            
                            if($prevCount > 0){
                                // Update member data
                                $condition = array('spoffice' => $spoffice);
                                $update = $this->adminInfra_model->update5($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->adminInfra_model->insert5($memData);
                                
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
        redirect('adminInfra/spoffice');
    }

    public function import5(){
        $data = array();
        $memData = array();
        $dept = $this->session->userdata('dept');
        $directorate = $this->session->userdata('directorate');
        $district = $this->session->userdata('district');
        $spoffice = $this->session->userdata('spoffice');
        
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
                            if($this->session->userdata('officetype') === 'Departmental') {
                            
                                $memData = array(
                                'dept' => $dept,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'dept' => $dept
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->adminInfra_model->getRows($con);
                        }
                        else if($this->session->userdata('officetype') === 'Directorates') {
                            $memData = array(
                                'directorate' => $directorate,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'directorate' => $directorate
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->adminInfra_model->getRows2($con);
                        }
                        else if($this->session->userdata('officetype') === 'District') {
                            $memData = array(
                                'district' => $district,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'district' => $district
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->adminInfra_model->getRows1($con);
                        }
                        else {
                           
                            $memData = array(
                                'spoffice' => $spoffice,
                                'total_users' => $row['Total_Users'], 
                                'users_system' => $row['Users_System'], 
                                'new_system' => $row['New_System'], 
                                'dsc' => $row['DSC'], 
                                'scanners' => $row['Scanners'], 
                                'printers' => $row['Printers'],
                                'dsc_required' => $row['DSC_Required'],
                                'printer_required' => $row['Printer_Required'],
                                'scanners_required' => $row['Scanners_Required'],
                                'system_required' => $row['System_Required'],
                                'isp' => $row['ISP'],
                                'bandwidth' => $row['Bandwidth'],
                                'cabling' => $row['Cabling'],
                                
                                
                            );
                            
                            // Check whether email already exists in the database
                            $con = array(
                                'where' => array(
                                    'spoffice' => $spoffice
                                ),
                                'returnType' => 'count'
                            );
                        
                            $prevCount = $this->adminInfra_model->getRows6($con);

                        }
                            
                            
                            if($prevCount > 0){
                                // Update member data
                                if($this->session->userdata('officetype') === 'Departmental') {
                            
                                $condition = array('dept' => $dept);
                                }
                               else if($this->session->userdata('officetype') === 'Directorates') {
                            
                                    $condition = array('directorate' => $directorate);
                                    }
                               else  if($this->session->userdata('officetype') === 'District') {
                            
                                        $condition = array('district' => $district);
                                        }
                                else {
                                    $condition = array('spoffice' => $spoffice);
                                }
                                $update = $this->adminInfra_model->update5($memData, $condition);
                                
                                if($update){
                                    $updateCount++;
                                }
                            }else{
                                // Insert member data
                                $insert = $this->adminInfra_model->insert5($memData);
                                
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
        redirect('adminInfra/office');
    }


    public function overall()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $office = $this->session->userdata('officetype');
        if($office === 'Departmental') {
            $dept = $this->session->userdata('dept');
            $list = $this->adminInfra_model->departmental($dept);
        }
      else  if($office === 'Directorates') {
            $directorate = $this->session->userdata('directorate');
            $list = $this->adminInfra_model->directorate($directorate);
        }
       else if($office === 'District') {
            $district = $this->session->userdata('district');
            $list = $this->adminInfra_model->district($district);
        }
        else {
            $spoffice = $this->session->userdata('spoffice');
            $list = $this->adminInfra_model->spoffice($spoffice);
      
        }
        $data = array();

        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->deptname;
                    
            $row[] =$r->total_users;
            $row[] = $r->users_system; 
            $row[] =$r->new_system;
            $row[] =  $r->dsc; 
            $row[] = $r->scanners; 
            $row[] = $r->printers;
            $row[] = $r->dsc_required; 
            $row[] = $r->printer_required; 
            $row[] = $r->scanners_required; 
            $row[] = $r->system_required;
            $row[] = $r->isp;
            $row[] = $r->bandwidth; 

            if($r->cabling === 'yes') {
                $row[] = '<button class="btn btn-success">Yes</button>';
            }
           else {
            $row[] = '<button class = "btn btn-danger">No</button>';
       
           }
           
            
        
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->adminInfra_model->count_all(),
                        "recordsFiltered" => $this->adminInfra_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}

 


