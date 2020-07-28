<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use check\Libraries\RestController;
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
class Api extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('security');
     
    
        $this->load->model('Trainings_model');
        $this->load->model('AdminInfra_model');
        $this->load->model('Training_filter_model');
        $this->load->model('Dashboard_model','dashboard');
        $this->logged_in();

    }  

    private function logged_in(){
       
        if($this->session->userdata('logged_in') !== TRUE) {
            redirect('login');
        }
    }


    function courses_post() {
        
        $list = $this->Trainings_model->get_datatables_course();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->name;
                    
            //add html for action
        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_course('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_course('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';

    
           
            $data[] = $row;
        }
    
        $result = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Trainings_model->count_all_course(),
                        "recordsFiltered" => $this->Trainings_model->count_filtered_course(),
                        "data" => $data,
                );
        //output to json format
       
            if($result) {
                $this->response($result,200);
            }
            else {
             $this->response("No record found",404);
            
            }

        
    
    }
    public function courses_edit_get($id)
    {
        $data = $this->Trainings_model->get_by_id_course($id);
       
        if($data) {
            $this->response($data,200);
        }
        else {
            $this->response("No record found",404);
        }
    }

    public function add_course_post()
    {
        $this->_validate();
       $name =  $this->security->xss_clean($this->input->post("name"));
       $this->form_validation->set_rules('name', 'Course Name', 'required');
       if($this->form_validation->run() === TRUE){
           $validate = $this->Trainings_model->checkCourse($name);
           if($validate->num_rows() > 0 ) {
               echo $this->session->flashdata('Course exists');
           }
           else {
            
        $data = array(
                'name' => $name, 
            );
            $data = $this->security->xss_clean($data);
            if($this->security->xss_clean($data)){
        if($this->Trainings_model->save_course($data)){
           
            $this->response(array(
                "status" => TRUE,
            "message" => "Course added successfully",
            ), 200);
            
        }
           
        }
        else {
            
            $this->response(array(
                "status" => FALSE,
                "message" => "Failed to add course"
            ), 404);
          
        }
    }
}
    else {
        $this->session->set_userdata('error_msg', 'Error, please try again.');  
        redirect(base_url() . 'trainings/course1');
        $this->response(array(
            "status" => FALSE,
            "message" => "All fields are needed"
        ), 200);
      

    }
  
}
    public function update_course_post()
    {
        $this->_validate();
        $name =  $this->security->xss_clean($this->input->post("name"));
        $this->form_validation->set_rules('name', 'Course Name', 'required');
        if($this->form_validation->run() === TRUE){
        $data = array(
                'name' => $name,
              
              
            );
        $this->Trainings_model->update_course(array('id' => $this->input->post('id')), $data);
        $result = array("status" => TRUE,
                    "message" => 'Course Edited Successfully');
        if($result) {
            $this->response($result,200);
        }
        else {
            $this->response("No record found",404);
        }
    }
    else {
        $this->session->set_userdata('error_msg', 'Error, please try again.');  
        redirect(base_url() . 'trainings/course1');
        $this->response(array(
            "status" => FALSE,
            "message" => "All fields are needed"
        ), 200);
      
    }
    }
 
    public function delete_course_post($id)
    {
        $this->Trainings_model->delete_by_id_course($id);
        $result = array("status" => TRUE,
        "message" => 'Deleted Successfully');
        if($result) {
            $this->response($result,200);
        }
        else {
            $this->response("no record found",404);
        }
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

    function secretariat_get() {
        $result = $this->Trainings_model->ajax_list();
        if($result) {
            $this->response($result,200);
        }
        else {
            $this->response("No record found",404);
        }
    }

    function courses1_post()
    {
        

        $list = $this->Trainings_model->get_datatables_course();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->name;
                    
            $data[] = $row;
        }
    
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Trainings_model->count_all_course(),
                        "recordsFiltered" => $this->Trainings_model->count_filtered_course(),
                        "data" => $data,
                );
        //output to json format
                $result = json_encode($output);
       
          
        if($result) {
            $this->response($result,200);
        }
        else {
            $this->response("No record found",404);
        }
    }


    public function add_post() {
        $name = $this->security->xss_clean($this->input->post("name"));
        $this->form_validation->set_rules('name','Course Name','required');
        if($this->form_validation->run() === TRUE) {
            $data = array(
                'name' => $name
            );
            if($this->Trainings_model->save_course($data)) {
                $this->response(array(
                    "status" => 1,
                    "message" => "course added successfully"
                ), RestController::HTTP_OK);
            }
            else {
                $this->response(array(
                    "status" => 0,
                    "message" => "Failed to add course"
                ), RestController::HTTP_NOT_FOUND);
            }
        }
        else {
            $this->response(array(
                "status" => 0,
                "message" => "All Fields required"
            ),RestController::HTTP_NOT_FOUND);
        }
    }

    function programmes_post() {
        if($this->session->userdata('role') === 'Super Admin') {
        
        $list = $this->Trainings_model->getall();
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->title;
            $row[] = $r->course;
            $row[] = $r->date.' to '.$r->ending;
            $row[] = $r->venue;
            $row[] = $r->type;
           
              if($r->files)
              $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$r->files).'" target="_blank"><i class="fas fa-file-pdf fa-lg"></i></a>'; 
              else 
              $row[] = '(No file)';     
            
            //add html for action
        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_programme('."'".$r->id."'".')"><i class="fa fa-edit fa-lg"></i> </a>
        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_programme('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';

    
           
            $data[] = $row;
        }
    }
    else {
    if($this->session->userdata('officetype') === 'Departmental') {

        $d = $this->session->userdata('dept');
        $list = $this->Trainings_model->getalldepartmental($d);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->title;
            $row[] = $r->course;
            $row[] = $r->date.' to '. $r->end;
            $row[] = $r->venue;
            $row[] = $r->type;
           
              if($r->files)
              $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$r->files).'" target="_blank"><i class="fas fa-file-pdf fa-lg"></i></a>'; 
              else 
              $row[] = '(No file)';     
            
            //add html for action
      
         //add html for action
         $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_programme('."'".$r->id."'".')"><i class="fa fa-edit fa-lg"></i> </a>
         <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_programme('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';
 
     
           
            $data[] = $row;
        }

    }
    else if($this->session->userdata('officetype') === 'Directorates'){
        $dept = $this->session->userdata('directorate');
        $list = $this->Trainings_model->getalldirectorate($dept);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->title;
            $row[] = $r->course;
            $row[] = $r->date.' to '.$r->end;
            $row[] = $r->venue;
            $row[] = $r->type;
           
              if($r->files)
              $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$r->files).'" target="_blank"><i class="fas fa-file-pdf fa-lg"></i></a>'; 
              else 
              $row[] = '(No file)';     
            
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_programme('."'".$r->id."'".')"><i class="fa fa-edit fa-lg"></i> </a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_programme('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';
    
    
           
            $data[] = $row;
        }
    }
    else if($this->session->userdata('officetype') === 'District') {
        $dept = $this->session->userdata('district');
        $list = $this->Trainings_model->getalldistrict($dept);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->title;
            $row[] = $r->course;
            $row[] = $r->date.' to '.$r->end;
            $row[] = $r->venue;
            $row[] = $r->type;
           
              if($r->files)
              $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$r->files).'" target="_blank"><i class="fas fa-file-pdf fa-lg"></i></a>'; 
              else 
              $row[] = '(No file)';     
            
            //add html for action
      
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_programme('."'".$r->id."'".')"><i class="fa fa-edit fa-lg"></i> </a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_programme('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';
    
           
            $data[] = $row;
        }
    }
    else {
        $dept = $this->session->userdata('spoffice');
        $list = $this->Trainings_model->getallspoffice($dept);
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->title;
            $row[] = $r->course;
            $row[] = $r->date.' to '.$r->end;
            $row[] = $r->venue;
            $row[] = $r->type;
           
              if($r->files)
              $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$r->files).'" target="_blank"><i class="fas fa-file-pdf fa-lg"></i></a>'; 
              else 
              $row[] = '(No file)';     
            
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_programme('."'".$r->id."'".')"><i class="fa fa-edit fa-lg"></i> </a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_programme('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';
    
    
           
            $data[] = $row;
        }
    }
}
    
        $result = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Trainings_model->count_all_programme(),
                        "recordsFiltered" => $this->Trainings_model->count_filtered_programme(),
                        "data" => $data,
                );
        //output to json format
       
            if($result) {
                $this->response($result,200);
            }
            else {
             $this->response("No record found",404);
            
            }
    
    }

    public function programme_edit_get($id)
    {
        $data = $this->Trainings_model->get_by_id_programme($id);
       
        if($data) {
            $this->response($data,200);
        }
        else {
            $this->response("No record found",404);
        }
    }

    public function add_programme_post()
    {
        $this->validate();
       $title =  $this->security->xss_clean($this->input->post("title"));
       $course = $this->security->xss_clean($this->input->post("course"));
       $venue = $this->security->xss_clean($this->input->post("venue"));
       $type = $this->security->xss_clean($this->input->post("type"));
       $starting = $this->security->xss_clean($this->input->post("starting"));
       $ending = $this->security->xss_clean($this->input->post("ending"));
       $this->form_validation->set_rules('title','Training Title', 'required');
       $this->form_validation->set_rules('course','Course Title', 'required');
       $this->form_validation->set_rules('venue','Venue', 'required');
       $this->form_validation->set_rules('type','Training Type', 'required');
       $this->form_validation->set_rules('starting','Starting', 'required');
       $this->form_validation->set_rules('ending','Ending', 'required');
   
       $validate = $this->Trainings_model->checkTraining($title,$course);
       if($validate->num_rows()  > 0 ) {
           $this->response(array("status" => FALSE,
           "message" => 'Training already exists'));
       }
       else{
           if($this->session->userdata('role') === 'Super Admin') {
        $data = array(
                'title' => $title,
                'starting' => $starting,
                'ending' => $ending,
                'course' => $course,
                'venue' => $venue,
                'type' => $type
                
            );
            if(!empty($_FILES['files']['name'])) {
                $upload = $this->_do_upload();
                $data['files'] = $upload;
            }
         }
         else {
             if($this->session->userdata('officetype') === 'Departmental') {
                $data = array(
                    'title' => $title,
                    'starting' => $starting,
                    'ending' => $ending,
                    'course' => $course,
                    'venue' => $venue,
                    'type' => 'Departmental'
                    
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
             }
             else if($this->session->userdata('officetype') === 'Directorates') {
                $data = array(
                    'title' => $title,
                    'starting' => $starting,
                    'ending' => $ending,
                    'course' => $course,
                    'venue' => $venue,
                    'type' => 'Directorates'
                    
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
             }
             else if($this->session->userdata('officetype') === 'District') {
                $data = array(
                    'title' => $title,
                    'starting' => $starting,
                    'ending' => $ending,
                    'course' => $course,
                    'venue' => $venue,
                    'type' => 'District'
                    
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
             }
             else {
                $data = array(
                    'title' => $title,
                    'starting' => $starting,
                    'ending' => $ending,
                    'course' => $course,
                    'venue' => $venue,
                    'type' => 'SP Office'
                    
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
             }
         }

        if($this->Trainings_model->save_programme($data)){
      
            $this->response(array(
                "status" => TRUE,
            "message" => "Trainings added successfully",
            ), 200);
        }
        else {
            $this->response(array(
                "status" => FALSE,
                "message" => "Failed to add trainings"
            ));
        }
    }


   
}

public function update_programme_post()
{
    $this->validate();
    $data = array(
            'title' => $this->input->post('title'),
            'starting' => $this->input->post('starting'),
            'course' => $this->input->post('course'),
            'venue' => $this->input->post('venue'),
            'ending' => $this->input->post('ending')
          
          
        );
        if($this->input->post('remove_files'))
        {
            if(file_exists('./uploads/'.$this->input->post('remove_files')) && $this->input->post('remove_files'))
            unlink('./uploads/'.$this->input->post('remove_files'));
            $data['files'] = '';
        }
        if(!empty($_FILES['files']['name'])) {
            $upload = $this->_do_upload();

            $training = $this->Trainings_model->get_by_id_programme($this->input->post('id'));
            if(file_exists('./uploads/'.$training->files) && $training->files)
            unlink('./uploads/'.$training->files);

            $data['files'] = $upload;
        }
    $this->Trainings_model->update_programme(array('id' => $this->input->post('id')), $data);
    $result = array("status" => TRUE,
        "message" => 'Trainings updated successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function delete_programme_post($id)
{
    $training = $this->Trainings_model->get_by_id_programme($id);
    if(file_exists('./uploads/'.$training->files) && $training->files)
    unlink('./uploads/'.$training->files);
    $this->Trainings_model->delete_by_id_programme($id);
    $result = array("status" => TRUE,
"message" => 'Deleted Successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("no record found",404);
    }
}

private function validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('title') == '')
    {
        $data['inputerror'][] = 'title';
        $data['error_string'][] = 'Training title is required';
        $data['status'] = FALSE;
    }
    
    if($this->input->post('starting') == '')
    {
        $data['inputerror'][] = 'starting';
        $data['error_string'][] = 'Date is required';
        $data['status'] = FALSE;
    }
    if($this->input->post('course') == '')
    {
        $data['inputerror'][] = 'course';
        $data['error_string'][] = 'Course is required';
        $data['status'] = FALSE;
    }
    if($this->input->post('venue') == '')
    {
        $data['inputerror'][] = 'venue';
        $data['error_string'][] = 'Venue is required';
        $data['status'] = FALSE;
    }
    
   


    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}


function participants_post() {
        
    $list = $this->Trainings_model->getallparticipants();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
        $row[] = $r->designation;
        $row[] = $r->dept;
        $row[] = $r->email;
        $row[] = $r->phone;
     
        $row[] = $r->title;
        $row[] = $r->type;
                
        //add html for action
    $row[] = ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_participants('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_participants(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_participants(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
function participants_departmental_post() {
    if($this->session->userdata('role') === 'Super Admin') {
        
    $list = $this->Trainings_model->getallparticipants_departmental();
    }
    else  {
       
        $dept = $this->session->userdata('dept');
        $result = $this->Trainings_model->checkDepartment1($dept);
       
        $list = $this->Trainings_model->getallparticipantsdepartmental1($dept);
    }
    
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
        $row[] = $r->designation;
        $row[] = $r->dept;
        $row[] = $r->email;
        $row[] = $r->phone;
     
        $row[] = $r->title;
        $row[] = $r->type;
                
        //add html for action
    $row[] = ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_participants('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_participants(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_participants(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
function participants_directorate_post() {
    if($this->session->userdata('role') === 'Super Admin') {
        
    $list = $this->Trainings_model->getallparticipants_directorate();
    }
    else if($this->session->userdata('role') === 'Admin') {
        $dept = $this->session->userdata('dept');
        $result = $this->Trainings_model->checkDepartment1($dept);
       
        $list = $this->Trainings_model->getallparticipant_dept($dept);
    }
    else {
        $directorate = $this->session->userdata('directorate');
     
        $list = $this->Trainings_model->getallparticipant_directorate($directorate);
    }
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
        $row[] = $r->designation;
        $row[] = $r->dept;
        $row[] = $r->email;
        $row[] = $r->phone;
     
        $row[] = $r->title;
        $row[] = $r->type;
                
        //add html for action
    $row[] = '  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_participants('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_participants(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_participants(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
function participants_district_post() {
        
    $list = $this->Trainings_model->getallparticipants_district();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
        $row[] = $r->designation;
        $row[] = $r->dept;
        $row[] = $r->email;
        $row[] = $r->phone;
     
        $row[] = $r->title;
        $row[] = $r->type;
                
        //add html for action
    $row[] = '  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_participants('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_participants(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_participants(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}

function participants_spoffice_post() {
    
        
    $list = $this->Trainings_model->getallparticipants_spoffice();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
        $row[] = $r->designation;
        $row[] = $r->dept;
        $row[] = $r->email;
        $row[] = $r->phone;
     
        $row[] = $r->title;
        $row[] = $r->type;
                
        //add html for action
    $row[] = ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_participants('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_participants(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_participants(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}


function participants_combined_post() {
    if($this->session->userdata('role') === 'Super Admin') {

        
    $list = $this->Trainings_model->getallparticipants_combined();
    }
    else if($this->session->userdata('role') === 'Admin') {
        $dept = $this->session->userdata('dept');
        $result = $this->Trainings_model->checkDepartment1($dept);
        $list = $this->Trainings_model->getallparticipants_combinedDepartment($dept,$result);
    }
    else {
        $directorate = $this->session->userdata('directorate');
        $result = $this->Trainings_model->checkDirectorate($directorate);
        $list = $this->Trainings_model->getallparticipants_combinedDirectorate($directorate);
    }
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
        $row[] = $r->designation;
        $row[] = $r->dept;
        $row[] = $r->directorate;
        $row[] = $r->district;
        $row[] = $r->spoffice;
        $row[] = $r->email;
        $row[] = $r->phone;
     
        $row[] = $r->title;
        $row[] = $r->type;
                
        //add html for action
    $row[] = ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_participants('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_participants(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_participants(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}


public function participant_edit_get($id)
{
    $data = $this->Trainings_model->get_by_id_participant($id);
   
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function add_participant_post()
{
    $this->validate1();
   $name =  $this->security->xss_clean($this->input->post("name"));
   $email = $this->security->xss_clean($this->input->post("email"));
   $phone = $this->security->xss_clean($this->input->post("phone"));
   $dept = $this->input->post("dept");
   $title = $this->input->post("training");
   $designation = $this->input->post("designation");
   $validate = $this->Trainings_model->checkparticipant($email,$title);
   if($validate->num_rows() > 0 ) {
    $this->response(array("status" => FALSE,
    "message" => 'Participant exists'), 404);
}
else {
   
    $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'trainingsid' => $title,
            'dept' => $dept,
            'designation' => $designation,
           
        );
    if($this->Trainings_model->save_participant($data)){
  
        $this->response(array(
            "status" => TRUE,
        "message" => "Participant added successfully",
        ), 200);
    }
    else {
        $this->response(array(
            "status" => FALSE,
            "message" => "Failed to add course"
        ), 404);
    }
}

}

public function update_participant_post()
{
$this->validate1();


$data = array(
        'trainingsid' => $this->input->post("training"),
        'name' => $this->input->post("name"),
        'email' => $this->input->post("email"),
        'phone' => $this->input->post("phone"),
        'dept' => $this->input->post("dept"),
        'designation' => $this->input->post("designation"),
        
    
      
    );
$this->Trainings_model->update_participant(array('id' => $this->input->post('id')), $data);
$result = array("status" => TRUE);

if($result) {
    $this->response($result,200);
}
else {
    $this->response("No record found",404);
}
}

public function delete_participant_post($id)
{
$this->Trainings_model->delete_by_id_participant($id);
$result = array("status" => TRUE,
"message" => 'Participant deleted successfully');
if($result) {
    $this->response($result,200);
}
else {
    $this->response("no record found",404);
}
}

private function validate1()
{
$data = array();
$data['error_string'] = array();
$data['inputerror'] = array();
$data['status'] = TRUE;

if($this->input->post('name') == '')
{
    $data['inputerror'][] = 'name';
    $data['error_string'][] = 'Name of the person is required';
    $data['status'] = FALSE;
}

if($this->input->post('email') == '')
{
    $data['inputerror'][] = 'email';
    $data['error_string'][] = 'Email is required';
    $data['status'] = FALSE;
}
if($this->input->post('phone') == '')
{
    $data['inputerror'][] = 'phone';
    $data['error_string'][] = 'Phone is required';
    $data['status'] = FALSE;
}
if($this->input->post('dept') == '')
{
    $data['inputerror'][] = 'dept';
    $data['error_string'][] = 'Select Department';
    $data['status'] = FALSE;
}
if($this->input->post('designation') == '')
{
    $data['inputerror'][] = 'designation';
    $data['error_string'][] = 'Select Designation';
    $data['status'] = FALSE;
}
if($this->input->post('training') == '')
{
    $data['inputerror'][] = 'training';
    $data['error_string'][] = 'Select Training';
    $data['status'] = FALSE;
}





if($data['status'] === FALSE)
{
    echo json_encode($data);
    exit();
}
}

function Dept_post() {
    
    $training = $this->input->post('id',TRUE);
    $data = $this->Trainings_model->getDept2($training);
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }

}
function Directorate_post() {
    
    $dept = $this->input->post('dept',TRUE);
    $data = $this->Trainings_model->getDirectorate2($dept);
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }

}

function Multiple_post() {
    
    $training = $this->input->post('id',TRUE);
    $validate = $this->Trainings_model->getType1($training);
  
    $data = $this->Trainings_model->getStatus();
  

    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }

}

function designation_post() {
        
    $list = $this->Trainings_model->get_datatables_designation();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
                
        //add html for action
    $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_designation('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_designation('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_designation(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_designation(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
public function designation_edit_get($id)
{
    $data = $this->Trainings_model->get_by_id_designation($id);
   
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function add_designation_post()
{
    $this->__validate();
$name =  $this->security->xss_clean($this->input->post("name"));
$this->form_validation->set_rules('name', 'Course Name', 'required');
if($this->form_validation->run() === TRUE){
    $validate = $this->Trainings_model->checkDesignation($name);
    if($validate->num_rows() > 0 ) {
        echo $this->session->flashdata('Designation exists');
    }
    else {
     
 $data = array(
         'name' => $name, 
     );
 if($this->Trainings_model->save_designation($data)){
    
     $this->response(array(
         "status" => TRUE,
     "message" => "Designation added successfully",
     ), 200);
     

    
 }
 else {
     
     $this->response(array(
         "status" => FALSE,
         "message" => "Failed to add designation"
     ), 404);
   
 }
}
}
else {
 
 $this->response(array(
     "status" => FALSE,
     "message" => "All fields are needed"
 ), 404);


}
}

public function update_designation_post()
{
    $this->__validate();
    $data = array(
            'name' => $this->input->post('name'),
          
        );
    $this->Trainings_model->update_designation(array('id' => $this->input->post('id')), $data);
    $result = array("status" => TRUE,
"message" => 'Updated successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function delete_designation_post($id)
{
    $this->Trainings_model->delete_by_id_designation($id);
    $result = array("status" => TRUE,
"message" => 'Deleted successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("no record found",404);
    }
}

private function __validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('name') == '')
    {
        $data['inputerror'][] = 'name';
        $data['error_string'][] = 'Designation is required';
        $data['status'] = FALSE;
    }

    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}

function venue_post() {
        
    $list = $this->Trainings_model->getAll_venue();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
                
        //add html for action
    $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_venue('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_venue('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_venue(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_venue(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
public function venue_edit_get($id)
{
    $data = $this->Trainings_model->get_by_id_venue($id);
   
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function add_venue_post()
{
    $this->val();
    $name =  $this->security->xss_clean($this->input->post("name"));
    $this->form_validation->set_rules('name', 'Course Name', 'required');
    if($this->form_validation->run() === TRUE){
        $validate = $this->Trainings_model->checkVenue($name);
        if($validate->num_rows() > 0 ) {
            echo $this->session->flashdata('Venue exists');
        }
        else {
         
     $data = array(
             'name' => $name, 
         );
     if($this->Trainings_model->save_venue($data)){
        
         $this->response(array(
             "status" => TRUE,
         "message" => "Venue added successfully",
         ), 200);
         
    
        
     }
     else {
         
         $this->response(array(
             "status" => FALSE,
             "message" => "Failed to add venue"
         ), 404);
       
     }
    }
    }
    else {
     
     $this->response(array(
         "status" => FALSE,
         "message" => "All fields are needed"
     ), 404);
    
    
    }
    }
public function update_venue_post()
{
    $this->val();
    $name = $this->security->xss_clean($this->input->post('name'));
    $data = array(
            'name' => $name,
        );
    $this->Trainings_model->update_venue(array('id' => $this->input->post('id')), $data);
    $result = array("status" => TRUE,
"message" => 'Updated successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function delete_venue_post($id)
{
    $this->Trainings_model->delete_by_id_venue($id);
    $result = array("status" => TRUE,
"message" => 'Deleted successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("no record found",404);
    }
}

private function val()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('name') == '')
    {
        $data['inputerror'][] = 'name';
        $data['error_string'][] = 'Venue is required';
        $data['status'] = FALSE;
    }

    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}

function department_post() {
        
    $list = $this->Trainings_model->getAll_department();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
                
        //add html for action
    $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_course('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_course('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_department(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_department(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
public function department_edit_get($id)
{
    $data = $this->Trainings_model->get_by_id_department($id);
   
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }
}



private function val1()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('dname') == '')
    {
        $data['inputerror'][] = 'dname';
        $data['error_string'][] = 'Department is required';
        $data['status'] = FALSE;
    }

    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}



function district_post() {
        
    $list = $this->Trainings_model->getAll_district();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
                
        //add html for action
    $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_district('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_district('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i> </a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_district(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_district(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
public function district_edit_get($id)
{
    $data = $this->Trainings_model->get_by_id_district($id);
   
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function add_district_post()
{
    $this->val2();
$name =  $this->security->xss_clean($this->input->post("name"));
$this->form_validation->set_rules('name', 'District Name', 'required');
if($this->form_validation->run() === TRUE){
    $validate = $this->Trainings_model->checkDistrict($name);
    if($validate->num_rows() > 0 ) {
        echo $this->session->flashdata('District exists');
    }
    else {
     
 $data = array(
         'name' => $name, 
     );
 if($this->Trainings_model->save_district($data)){
    
     $this->response(array(
         "status" => TRUE,
     "message" => "District added successfully",
     ), 200);
     

    
 }
 else {
     
     $this->response(array(
         "status" => FALSE,
         "message" => "Failed to add department"
     ), 404);
   
 }
}
}
else {
 
 $this->response(array(
     "status" => FALSE,
     "message" => "All fields are needed"
 ), 404);


}
}
public function update_district_post()
{
    $this->val2();
    $name = $this->security->xss_clean($this->input->post('name'));
    $data = array(
            'name' => $name,
        );
    $this->Trainings_model->update_district(array('id' => $this->input->post('id')), $data);
    $result = array("status" => TRUE,
"message" => 'Updated successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function delete_district_post($id)
{
    $this->Trainings_model->delete_by_id_district($id);
    $result = array("status" => TRUE,
"message" => 'Deleted successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("no record found",404);
    }
}

private function val2()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('name') == '')
    {
        $data['inputerror'][] = 'name';
        $data['error_string'][] = 'District is required';
        $data['status'] = FALSE;
    }

    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}

function spoffice_post() {
        
    $list = $this->Trainings_model->getAll_spoffice();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
                
        //add html for action
    $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_spoffice('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_spoffice('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i> </a>';


       
        $data[] = $row;
    }

    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_spoffice(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_spoffice(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
public function spoffice_edit_get($id)
{
    $data = $this->Trainings_model->get_by_id_spoffice($id);
   
    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function add_spoffice_post()
{
    $this->val4();
$name =  $this->security->xss_clean($this->input->post("name"));
$this->form_validation->set_rules('name', 'Course Name', 'required');
if($this->form_validation->run() === TRUE){
    $validate = $this->Trainings_model->checkSPOffice($name);
    if($validate->num_rows() > 0 ) {
        echo $this->session->flashdata('SP Office exists');
    }
    else {
     
 $data = array(
         'name' => $name, 
     );
 if($this->Trainings_model->save_spoffice($data)){
    
     $this->response(array(
         "status" => TRUE,
     "message" => "SP Office added successfully",
     ), 200);
     

    
 }
 else {
     
     $this->response(array(
         "status" => FALSE,
         "message" => "Failed to add department"
     ), 404);
   
 }
}
}
else {
 
 $this->response(array(
     "status" => FALSE,
     "message" => "All fields are needed"
 ), 404);


}
}
public function update_spoffice_post()
{
    $this->val4();
    $name = $this->security->xss_clean($this->input->post('name'));
    $data = array(
            'name' => $name,
        );
    $this->Trainings_model->update_spoffice(array('id' => $this->input->post('id')), $data);
    $result = array("status" => TRUE,
"message" => 'Updated successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function delete_spoffice_post($id)
{
    $this->Trainings_model->delete_by_id_spoffice($id);
    $result = array("status" => TRUE,
"message" => 'Deleted successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("no record found",404);
    }
}

private function val4()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('name') == '')
    {
        $data['inputerror'][] = 'name';
        $data['error_string'][] = 'SP Office is required';
        $data['status'] = FALSE;
    }

    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}


    private function _do_upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '40480000';
        $config['max_width'] = '4000';
        $config['max_height'] = '4000';
        $config['file_name'] = round(microtime(true) * 1000);

        $this->upload->initialize($config);


        if(!$this->upload->do_upload('files'))
        {
            $data['inputerror'][] = 'files';
            $data['error_string'] = 'Upload Error: '.$this->upload->display_errors('','');
            $data['status'] = FALSE;
            echo json_encode($data);
            exit(); 
        }
        return $this->upload->data('file_name');
    }

   

    public function add_department_post()
    {
        $this->val1();
       $name =  $this->security->xss_clean($this->input->post("dname"));
       $this->form_validation->set_rules('dname', 'Course Name', 'required');
       if($this->form_validation->run() === TRUE){
           $validate = $this->Trainings_model->checkDepartment($name);
           if($validate->num_rows() > 0 ) {
               echo $this->session->flashdata('Department exists');
           }
           else {
            
        $data = array(
                'dname' => $name, 
            );
        if($this->Trainings_model->save_department($data)){
           
            $this->response(array(
                "status" => TRUE,
            "message" => "Department added successfully",
            ), 200);
            
      
           
        }
        else {
            
            $this->response(array(
                "status" => FALSE,
                "message" => "Failed to add department"
            ), 404);
          
        }
    }
}
    else {
        $this->session->set_userdata('error_msg', 'Error, please try again.');  
        redirect(base_url() . 'trainings/course1');
        $this->response(array(
            "status" => FALSE,
            "message" => "All fields are needed"
        ), 200);
      

    }
  
}
    public function update_department_post()
    {
        $this->val1();
        $dname = $this->security->xss_clean($this->input->post('dname'));
        $data = array(
                'dname' => $dname,
              
              
            );
        $this->Trainings_model->update_department(array('id' => $this->input->post('id')), $data);
        $result = array("status" => TRUE,
                    "message" => 'Updated Successfully');
        if($result) {
            $this->response($result,200);
        }
        else {
            $this->response("No record found",404);
        }
    }
 
    public function delete_department_post($id)
    {
        $this->Trainings_model->delete_by_id_department($id);
        $result = array("status" => TRUE,
        "message" => 'Deleted Successfully');
        if($result) {
            $this->response($result,200);
        }
        else {
            $this->response("no record found",404);
        }
    }



    function emdoverall_post() {
        if($this->session->userdata('role') === 'Super Admin') {
        
        $list = $this->Trainings_model->getallemd();
        }
        else  {
            $dept = $this->session->userdata('dept');
            $list = $this->Trainings_model->getallemdDept($dept);
        }
       
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->dname;
          
            $row[] = $r->transferred;
            $row[] = $r->retired;
            $row[] = $r->joined;
            
           
             
            
            //add html for action
      
    
           
            $data[] = $row;
        }
    
    
    
        $result = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Trainings_model->count_all_emd(),
                        "recordsFiltered" => $this->Trainings_model->count_filtered_emd(),
                        "data" => $data,
                );
        //output to json format
       
            if($result) {
                $this->response($result,200);
            }
            else {
             $this->response("No record found",404);
            
            }
    
    }
    function emdDirectorate_post() {
        
            $list = $this->Trainings_model->getallemd_directorate();

      

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->directorate;
          
            $row[] = $r->transferred;
            $row[] = $r->retired;
            $row[] = $r->joined;
            
           
             
            
            //add html for action
      
    
           
            $data[] = $row;
        }
    
    
    
        $result = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Trainings_model->count_all_emd(),
                        "recordsFiltered" => $this->Trainings_model->count_filtered_emd(),
                        "data" => $data,
                );
        //output to json format
       
            if($result) {
                $this->response($result,200);
            }
            else {
             $this->response("No record found",404);
            
            }

    }

    function emdDistrict_post() {
        
        $list = $this->Trainings_model->getallemd_district();

  

    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->directorate;
      
        $row[] = $r->transferred;
        $row[] = $r->retired;
        $row[] = $r->joined;
        
       
         
        
        //add html for action
  

       
        $data[] = $row;
    }



    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_emd(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_emd(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}
function emdSPOffice_post() {
        
    $list = $this->Trainings_model->getallemd_spoffice();



$data = array();
$no = $_POST['start'];
foreach ($list as $r) {
    $no++;
    $row = array();

    $row[] = $no;
    $row[] = $r->directorate;
  
    $row[] = $r->transferred;
    $row[] = $r->retired;
    $row[] = $r->joined;
    
   
     
    
    //add html for action


   
    $data[] = $row;
}



$result = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Trainings_model->count_all_emd(),
                "recordsFiltered" => $this->Trainings_model->count_filtered_emd(),
                "data" => $data,
        );
//output to json format

    if($result) {
        $this->response($result,200);
    }
    else {
     $this->response("No record found",404);
    
    }

}


    function emd_post() {
        if($this->session->userdata('role') === 'Super Admin') {
        
        $list = $this->Trainings_model->getallemdtotal();
        }
        else  {
            $dept = $this->session->userdata('dept');
            $directorate = $this->session->userdata('directorate');
            $district = $this->session->userdata('district');
            $spoffice = $this->session->userdata('spoffice');
            $office = $this->session->userdata('officetype');
            if($office === 'Departmental') {
                $list = $this->Trainings_model->getallemdtotaldepartmental($dept);
            }
            else if($office === 'Directorates') {
                $list = $this->Trainings_model->getallemdtotaldirectorates($directorate);
            }
           else  if($office === 'District') {
                $list = $this->Trainings_model->getallemdtotaldistricts($district);
            }
            else {
                    $list = $this->Trainings_model->getallemdtotalspoffice($spoffice);
                
            }
        }
       
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->name;
            $row[] = $r->designation;
            $row[] = $r->dname;
            $row[] = $r->directorate;
            $row[] = $r->district;
            $row[] = $r->spoffice;
          
            $row[] = $r->email;
          
            $row[] = $r->type;
            
           
              if($r->files)
              $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$r->files).'" target="_blank"><i class="fas fa-file-pdf fa-lg"></i></a>'; 
              else 
              $row[] = '(No file)';     
            if(!($this->session->userdata('role') === 'Super Admin')) {
            //add html for action
        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_programme('."'".$r->id."'".')"><i class="fa fa-edit fa-lg"></i> </a>
        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_programme('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';

            }
            else {
                $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_programme('."'".$r->id."'".')"><i class="fa fa-trash fa-lg"></i></a>';
        
            }
           
            $data[] = $row;
        }
    
    
    
        $result = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Trainings_model->count_all_emd(),
                        "recordsFiltered" => $this->Trainings_model->count_filtered_emd(),
                        "data" => $data,
                );
        //output to json format
       
            if($result) {
                $this->response($result,200);
            }
            else {
             $this->response("No record found",404);
            
            }
    
    }


    public function emd_edit_get($id)
    {
        $data = $this->Trainings_model->get_by_id_emd($id);
       
        if($data) {
            $this->response($data,200);
        }
        else {
            $this->response("No record found",404);
        }
    }

    public function add_emd_post()
    {
        $this->validate2();
       $name =  $this->security->xss_clean($this->input->post("name"));
       $email = $this->input->post("email");
       $designation = $this->input->post("designation");
       $dept = $this->input->post("dept");
       $dept1= $this->session->userdata('dept');
       $directorate = $this->session->userdata('directorate');
       $directorate1 = $this->input->post("directorate");
       $type = $this->input->post("type");
       
     
     
       $validate = $this->Trainings_model->checkEmd($email);
       if($validate->num_rows()  > 0 ) {
           $this->response(array("status" => FALSE,
           "message" => 'Emd Report already exists'));
       }
       else{
           if($this->session->userdata('role') === 'Super Admin') {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'designation' => $this->input->post('designation'),
            'dept' => $this->input->post('dept'),
            'directorate' => $directorate1,
            'type' => $this->input->post('type'),
          
            );
            if(!empty($_FILES['files']['name'])) {
                $upload = $this->_do_upload();
                $data['files'] = $upload;
            }
        }
        else if($this->session->userdata('role') === 'Admin') {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'designation' => $this->input->post('designation'),
                'dept' => $dept1,
                'directorate' => $directorate1,
                'type' => $this->input->post('type'),
              
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
        }
        else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'designation' => $this->input->post('designation'),
                'dept' => $dept1,
                'directorate' => $directorate,
                'type' => $this->input->post('type'),
              
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }

        }
        if($this->Trainings_model->save_emd($data)){
      
            $this->response(array(
                "status" => TRUE,
            "message" => "Emd Report added successfully",
            ), 200);
        }
    
        else {
            $this->response(array(
                "status" => FALSE,
                "message" => "Failed to add trainings"
            ));
        }
    
}
   
}

public function update_emd_post()
{
    $this->validate2();
    $dept = $this->session->userdata('dept');
    $directorate = $this->session->userdata('directorate');
    if($this->session->userdata('role') === 'Super Admin') {
    $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'designation' => $this->input->post('designation'),
            'dept' => $this->input->post('dept'),
            'directorate' => $this->input->post('directorate'),
            'type' => $this->input->post('type'),
          
          
        );
        if($this->input->post('remove_files'))
        {
            if(file_exists('./uploads/'.$this->input->post('remove_files')) && $this->input->post('remove_files'))
            unlink('./uploads/'.$this->input->post('remove_files'));
            $data['files'] = '';
        }
        if(!empty($_FILES['files']['name'])) {
            $upload = $this->_do_upload();

            $training = $this->Trainings_model->get_by_id_emd($this->input->post('id'));
            if(file_exists('./uploads/'.$training->files) && $training->files)
            unlink('./uploads/'.$training->files);

            $data['files'] = $upload;
        }
    }
    else if($this->session->userdata('role') === 'Admin') {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'designation' => $this->input->post('designation'),
            'dept' => $dept,
            'directorate' => $this->input->post('directorate'),
            'type' => $this->input->post('type'),
          
          
        );
        if($this->input->post('remove_files'))
        {
            if(file_exists('./uploads/'.$this->input->post('remove_files')) && $this->input->post('remove_files'))
            unlink('./uploads/'.$this->input->post('remove_files'));
            $data['files'] = '';
        }
        if(!empty($_FILES['files']['name'])) {
            $upload = $this->_do_upload();

            $training = $this->Trainings_model->get_by_id_emd($this->input->post('id'));
            if(file_exists('./uploads/'.$training->files) && $training->files)
            unlink('./uploads/'.$training->files);

            $data['files'] = $upload;
        }
    }
    else {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'designation' => $this->input->post('designation'),
            'dept' => $dept,
            'directorate' => $directorate,
            'type' => $this->input->post('type'),
          
          
        );
        if($this->input->post('remove_files'))
        {
            if(file_exists('./uploads/'.$this->input->post('remove_files')) && $this->input->post('remove_files'))
            unlink('./uploads/'.$this->input->post('remove_files'));
            $data['files'] = '';
        }
        if(!empty($_FILES['files']['name'])) {
            $upload = $this->_do_upload();

            $training = $this->Trainings_model->get_by_id_emd($this->input->post('id'));
            if(file_exists('./uploads/'.$training->files) && $training->files)
            unlink('./uploads/'.$training->files);

            $data['files'] = $upload;
        }
    }
       
    
    $this->Trainings_model->update_emd(array('id' => $this->input->post('id')), $data);
    $result = array("status" => TRUE,
        "message" => 'EMD Report updated successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("No record found",404);
    }
}

public function delete_emd_post($id)
{
    $training = $this->Trainings_model->get_by_id_emd($id);
    if(file_exists('./uploads/'.$training->files) && $training->files)
    unlink('./uploads/'.$training->files);
    $this->Trainings_model->delete_by_id_emd($id);
    $result = array("status" => TRUE,
"message" => 'Deleted Successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("no record found",404);
    }
}

private function validate2()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('name') == '')
    {
        $data['inputerror'][] = 'name';
        $data['error_string'][] = 'Name of the person is required';
        $data['status'] = FALSE;
    }
    
    if($this->input->post('dept') == '')
    {
        $data['inputerror'][] = 'dept';
        $data['error_string'][] = 'Select Department';
        $data['status'] = FALSE;
    }
    if($this->input->post('type') == '')
    {
        $data['inputerror'][] = 'type';
        $data['error_string'][] = 'Select Type';
        $data['status'] = FALSE;
    }
    if($this->input->post('email') == '')
    {
        $data['inputerror'][] = 'email';
        $data['error_string'][] = 'Email is required';
        $data['status'] = FALSE;
    }
    if($this->input->post('designation') == '')
    {
        $data['inputerror'][] = 'designation';
        $data['error_string'][] = 'Select Designation';
        $data['status'] = FALSE;
    }
    
   


    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}




public function add_emd1_post()
    {
        $this->validate2();
       $name =  $this->security->xss_clean($this->input->post("name"));
       $email = $this->input->post("email",true);
       $designation = $this->input->post("designation",true);
      
       $dept = $this->session->userdata('dept');
       $directorate = $this->session->userdata('directorate');
      $spoffice = $this->session->userdata('spoffice');
      $district = $this->session->userdata('district');
      
      $dept1 = $this->input->post('dept',true);
      $directorate1 = $this->input->post('directorate',true);
     $spoffice1 = $this->input->post('spoffice',true);
     $district1 = $this->input->post('district',true);
       $type = $this->input->post("type",true);
       $validate = $this->Trainings_model->checkEmd($email);
       if($validate->num_rows()  > 0 ) {
           $this->response(array("status" => FALSE,
           "message" => 'Emd Report already exists'));
       }
       else{
           if($this->session->userdata('role') === 'Super Admin') {

            $data = array(
                'name' => $name,
                'email' => $email,
                'designation' => $designation,
                'dept' => $dept1,
                'directorate' => $directorate1,
                'district' => $district1,
                'spoffice' => $spoffice1,
                'type' => $type,
              
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
           }
           else {
           if($this->session->userdata('officetype') === 'Departmental') {
            $data = array(
                'name' => $name,
                'email' => $email,
                'designation' => $designation,
                'dept' => $dept,
                
                'type' => $type,
              
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
           }
          else if($this->session->userdata('officetype') === 'Directorates') {
            $data = array(
                'name' => $name,
                'email' => $email,
                'designation' => $designation,
                'directorate' => $directorate,
                
                'type' => $type,
              
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
           }
        else   if($this->session->userdata('officetype') === 'District') {
            $data = array(
                'name' => $name,
                'email' => $email,
                'designation' => $designation,
                'district' => $district,
                
                'type' => $type,
              
                );
                if(!empty($_FILES['files']['name'])) {
                    $upload = $this->_do_upload();
                    $data['files'] = $upload;
                }
           }
         else {
          
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'designation' => $designation,
                    'spoffice' => $spoffice,
                    
                    'type' => $type,
                  
                    );
                    if(!empty($_FILES['files']['name'])) {
                        $upload = $this->_do_upload();
                        $data['files'] = $upload;
                    }
               }
             
            }
     
        if($this->Trainings_model->save_emd($data)){
      
            $this->response(array(
                "status" => TRUE,
            "message" => "Emd Report added successfully",
            ), 200);
        }
        else {
            $this->response(array(
                "status" => FALSE,
                "message" => "Failed to add trainings"
            ));
        }
    }
    
    }


public function update_emd1_post()
{
    $this->validate2();
    $name = $this->security->xss_clean($this->input->post('name'));
    $email = $this->input->post("email",true);
    $designation = $this->input->post("designation",true);
    $type = $this->input->post("type",true);
   $office = $this->session->userdata('officetype');
    $dept = $this->session->userdata('dept');
    $directorate = $this->session->userdata('directorate');
    $district = $this->session->userdata('district');
    $spoffice = $this->session->userdata('spoffice');
    $this->form_validation->set_rules('email','Email','required|is_unique[emd1.email]');
    if($this->form_validation->run() === True) {
    if($office === 'Departmental') {
    $data = array(
            'name' => $name,
            'email' => $email,
            'designation' => $designation,
            'dept' => $dept,
            
            'type' => $type,
          
          
        );
    } 
    else if($office === 'Directorates') {
        $data = array(
                'name' => $name,
                'email' => $email,
                'designation' => $designation,
                
                'directorate' => $directorate,
                'type' => $type,
              
              
            );
        }
        else  if($office === 'District') {
            $data = array(
                    'name' => $name,
                    'email' => $email,
                    'designation' => $designation,
                    'district' => $district,
                    
                    'type' => $type,
                  
                  
                );
            }
            else 
            {
               
                    $data = array(
                            'name' => $name,
                            'email' => $email,
                            'designation' => $designation,
                           'spoffice' => $spoffice,
                            'type' => $type,
                          
                          
                        );
                    
            }

        if($this->input->post('remove_files'))
        {
            if(file_exists('./uploads/'.$this->input->post('remove_files')) && $this->input->post('remove_files'))
            unlink('./uploads/'.$this->input->post('remove_files'));
            $data['files'] = '';
        }
        if(!empty($_FILES['files']['name'])) {
            $upload = $this->_do_upload();

            $training = $this->Trainings_model->get_by_id_emd($this->input->post('id'));
            if(file_exists('./uploads/'.$training->files) && $training->files)
            unlink('./uploads/'.$training->files);

            $data['files'] = $upload;
        }
        $data = $this->security->xss_clean($data);
        if($this->security->xss_clean($data)) {
    $this->Trainings_model->update_emd(array('id' => $this->input->post('id')), $data);
    $result = array("status" => TRUE,
        "message" => 'EMD Report updated successfully');
    if($result) {
        $this->response($result,200);
    }
    else {
        $this->response("No record found",404);
    }
}
else {
    echo 'Security validation failed';
}
}

}

public function emd_edit1_get($id)
{
    
   
        $data = $this->Trainings_model->get_details_emd($id);
  


    if($data) {
        $this->response($data,200);
    }
    else {
        $this->response("No record found",404);
    }
}



function emdoverall1_post() {
    if($this->session->userdata('role') === 'Super Admin') {
    
    $list = $this->Trainings_model->getallemd();
    }
    else  {
        $office = $this->session->userdata('officetype');
        $dept = $this->session->userdata('dept');
        $directorate = $this->session->userdata('directorate');
        $district = $this->session->userdata('district');
        $spoffice = $this->session->userdata('spoffice');
        if($office === 'Departmental') {
            $list = $this->Trainings_model->getallemdDept($dept);
        }
       else if($office === 'Directorates') {
            $list = $this->Trainings_model->getemd_directorate($directorate);
        }
       else  if($office === 'District') {
            $list = $this->Trainings_model->getemd_district($district);
        }
        else {
           
                $list = $this->Trainings_model->getemd_spoffice($spoffice);
            
        }
    
    }
   
    
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->dname;
      
        $row[] = $r->transferred;
        $row[] = $r->retired;
        $row[] = $r->joined;
        
       
         
        
        //add html for action
  

       
        $data[] = $row;
    }



    $result = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Trainings_model->count_all_emd(),
                    "recordsFiltered" => $this->Trainings_model->count_filtered_emd(),
                    "data" => $data,
            );
    //output to json format
   
        if($result) {
            $this->response($result,200);
        }
        else {
         $this->response("No record found",404);
        
        }

}



}

