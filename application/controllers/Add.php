<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Add extends CI_Controller{
     
    function __construct(){
        parent::__construct();
        $this->load->model('Package_model','package_model');
        $this->load->model('Training_filter_model');
        $this->load->model('Trainings_model');
    }
 
    private function logged_in(){
       
        if($this->session->userdata('logged_in') !== TRUE) {
            redirect('login');
        }
    }
    
function filter1() {
    $this->logged_in();
    $data['all'] = $this->package_model->getAll();
   
    $data['dept'] = $this->package_model->get_dept();
    $data['directorate'] = $this->package_model->getDirectorate();
    $dept = $this->session->userdata('dept');
    $directorate = $this->session->userdata('directorate');
    $district = $this->session->userdata('district');
    $spoffice = $this->session->userdata('spoffice');
  
    $course = $this->Training_filter_model->getCourse();
    $venue = $this->Training_filter_model->getVenue();
    if($this->session->userdata('officetype') === 'Departmental') {
    $data['departmental'] = $this->package_model->getDepartmental($dept);
    }
    if($this->session->userdata('officetype') === 'Directorates') {
    $data['directorates'] = $this->package_model->getDirectoratestrainings($directorate);
    }
    if($this->session->userdata('officetype') === 'District') {
        $data['districts'] = $this->package_model->getDistricttrainings($district);
    }
    if($this->session->userdata('officetype') === 'SP Office') {
        $data['spoffice'] = $this->package_model->getSPOfficetrainings($spoffice);
    }
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
    
  
    $this->load->view('admin/trainings/programmes2',$data);
}
    // READ
    function filter(){
        $this->logged_in();
        $data['all'] = $this->package_model->getAll();
       
        $data['all1'] = $this->package_model->getAll_directorate();
        $data['all2'] = $this->package_model->getAll_district();
        $data['all3'] = $this->package_model->getAll_spoffice();
        $data['dept'] = $this->package_model->get_dept();
        $data['directorate'] = $this->package_model->getDirectorate();
        $dept = $this->session->userdata('dept');
        $directorate = $this->session->userdata('directorate');
        $district = $this->session->userdata('district');
        $spoffice = $this->session->userdata('spoffice');
        $data['directorate1'] = $this->package_model->getDirectoratedepartmental($dept);
        $data['district'] = $this->package_model->getDistrict();
        $data['spoffice'] = $this->package_model->getSpOffice();
        $data['total'] = $this->package_model->getAll_total();
        $course = $this->Training_filter_model->getCourse();
        $venue = $this->Training_filter_model->getVenue();
    
        $data['departmental'] = $this->package_model->getDepartmental($dept);
        $data['directorates'] = $this->package_model->getDirectoratestrainings($dept);
    
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
        
      
        $this->load->view('admin/trainings/programmes1',$data);
    }
    
    
 
    function viewAll() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $list = $this->package_model->getAll();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->title;
            $row[] = $r->dname;

              //add html for action
              $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_programme('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_programme('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
     
        $data[] = $row;
                    
        }

        $output = array(
            "draw" => $_POST['draw'],
           
            "data" => $data,
    );
//output to json format
            echo json_encode($output);
 
    
    }
    //CREATE
    function create(){
        $package = $this->input->post('training',TRUE);
        $product = $this->input->post('dept',TRUE);
        $this->package_model->create_package($package,$product);
        redirect('Add/filter');
    }

    function add() {
        $this->validate();
        $training = $this->input->post('training');
        $dept = $this->input->post('dept');
        $dept1 = $this->session->userdata('dept');
        $this->form_validation->set_rules('training','Training','required');
        if($this->form_validation->run() === TRUE) {
        if($this->session->userdata('role') === 'Super Admin') {
        $this->package_model->save_programme($training,$dept);
        } 
        else {
            $data = array(
                'trainingid' => $training,
                'dname' => $dept1
            );
            $this->package_model->save_p($data);
        }
        echo json_encode(array("status" => TRUE));
        if($this->session->userdata('role') === 'Super Admin') {
        redirect('Add/filter');
        }
        else {
            redirect('programmes1');
        }
    }
    
    }
    function add1() {
        $training = $this->input->post('training');
        $directorate = $this->input->post('directorate');
        $directorate1 = $this->session->userdata('directorate');
        $this->form_validation->set_rules('training','Training','required');
        if($this->form_validation->run() === TRUE) {
       
        if($this->session->userdata('role') === 'Super Admin') {
        $this->package_model->save_programme1($training,$directorate);
        }
        else {
            $data = array(
                    'trainingid' => $training,
                    'directorate' => $directorate1
            );
            $this->package_model->save_pd($data);

        }
        echo json_encode(array("status" => TRUE));
        if($this->session->userdata('role') === 'Super Admin') {
            redirect('Add/filter');
            }
            else {
                redirect('programmes1');
            }
    }
}
    function add2() {
        $training = $this->input->post('training');
        $district= $this->input->post('district');
        $district1 = $this->session->userdata('district');
        $this->form_validation->set_rules('training','Training','required');
        if($this->form_validation->run() === TRUE) {
       
        if($this->session->userdata('role') === 'Super Admin') {
        $this->package_model->save_programme2($training,$district);
        }
        else {
            $data = array(
                'trainingid' => $training,
                'district' => $district1
            );
            $this->package_model->save_pdistrict($data);
        }
        echo json_encode(array("status" => TRUE));
        if($this->session->userdata('role') === 'Super Admin') {
            redirect('Add/filter');
            }
            else {
                redirect('programmes1');
            }
    }
}
    function add3() {
        $training = $this->input->post('training');
        $spoffice = $this->input->post('spoffice');
        $spoffice1 = $this->session->userdata('spoffice');
        $this->form_validation->set_rules('training','Training','required');
        if($this->form_validation->run() === TRUE) {
       
        if($this->session->userdata('role') === 'Super Admin') {
        $this->package_model->save_programme3($training,$spoffice);
        }
        else {
            $data = array( 
                'trainingid' => $training,
                'spoffice' => $spoffice1
            );
            $this->package_model->save_spoffice($data);
        }
        echo json_encode(array("status" => TRUE));
        if($this->session->userdata('role') === 'Super Admin') {
            redirect('Add/filter');
            }
            else {
                redirect('programmes1');
            }
    }
}
    function add4() {
        $training = $this->input->post('training');
        $dept = $this->input->post('dept');
        $directorate = $this->input->post('directorate');
        $district = $this->input->post('district');
        $spoffice = $this->input->post('spoffice');
        $dept1 = $this->session->userdata('dept');
        $this->form_validation->set_rules('training','Training','required');
        if($this->form_validation->run() === TRUE) {
       
        if($this->session->userdata('role') === 'Super Admin') {
        $this->package_model->save_programme4($training,$dept,$directorate,$district,$spoffice);
        }
        else {
            $data = array(
                'trainingid' => $training,
                'dname' => $dept1
            );
            $this->package_model->save_p($data);
            $this->package_model->save_programmeadmin($training,$directorate);
        }
        echo json_encode(array("status" => TRUE));
        if($this->session->userdata('role') === 'Super Admin') {
            redirect('Add/filter');
            }
            else {
                redirect('programmes1');
            }
    }
}
    
 
    // GET DATA PRODUCT BY PACKAGE ID
    function get_product_by_package(){
        $package_id=$this->input->post('id');
        $data=$this->package_model->get_product_by_package($package_id)->result();
     
        foreach ($data as $result) {
           
            
          $value[] = (float) $result->did;
        }
        echo json_encode($value);
    }

    function get_product_by_package1(){
        $package_id=$this->input->post('id');
        $data=$this->package_model->get_product_by_package1($package_id)->result();
     
        foreach ($data as $result) {
           
            
          $value[] = (float) $result->did;
        }
        echo json_encode($value);
    }
    function get_product_by_package2(){
        $package_id=$this->input->post('id');
        $data=$this->package_model->get_product_by_package2($package_id)->result();
     
        foreach ($data as $result) {
           
            
          $value[] = (float) $result->did;
        }
        echo json_encode($value);
    }
    function get_product_by_package3(){
        $package_id=$this->input->post('id');
        $data=$this->package_model->get_product_by_package3($package_id)->result();
     
        foreach ($data as $result) {
           
            
          $value[] = (float) $result->did;
        }
        echo json_encode($value);
    }
    function get_product_by_package4(){
        $package_id=$this->input->post('id');
        $data=$this->package_model->get_product_by_package4($package_id)->result();
     $output = array();
        foreach ($data as $result) {
           
            
          $value[] = (float) $result->did;
         $value[] = (float) $result->directorate;
         $value[] = (float) $result->district;
         $value[] = (float) $result->spoffice;
           
         
         
        }
        $output[] = $value; 
        echo json_encode($output);
    }
 
    //UPDATE
    function update(){
        $id = $this->input->post('edit_id',TRUE);
       
        $product = $this->input->post('dept_edit',TRUE);
        $this->package_model->update_programme($id,$product);
        redirect('Add/filter');
    }
    function update1(){
        $id = $this->input->post('edit_id',TRUE);
       
        $product = $this->input->post('directorate_edit',TRUE);
        $this->package_model->update_programme1($id,$product);
        redirect('Add/filter');
    }
    function update2(){
        $id = $this->input->post('edit_id',TRUE);
       
        $product = $this->input->post('district_edit',TRUE);
        $this->package_model->update_programme2($id,$product);
        redirect('Add/filter');
    }
    function update3(){
        $id = $this->input->post('edit_id',TRUE);
       
        $product = $this->input->post('spoffice_edit',TRUE);
        $this->package_model->update_programme3($id,$product);
        redirect('Add/filter');
    }
    function update4(){
        $id = $this->input->post('edit_id',TRUE);
        $product1 = $this->input->post('dept_edit',TRUE);
        $product2 = $this->input->post('directorate_edit',TRUE);
        $product3 = $this->input->post('district_edit',TRUE);
        $product = $this->input->post('spoffice_edit',TRUE);

        $this->package_model->update_programme4($id,$product1,$product2,$product3,$product);
        redirect('Add/filter');
    }
 
 
    // DELETE
    function delete(){
        $dept = $this->session->userdata('dept');
        $directorate = $this->session->userdata('directorate');
        $district = $this->session->userdata('district');
        $spoffice = $this->session->userdata('spoffice');
        $id = $this->input->post('delete_id',TRUE);
        if($this->session->userdata('role') === 'Super Admin') {
        $this->package_model->delete_programme($id);
        }
        else {
            if($this->session->userdata('officetype') === 'Departmental') {
            $this->package_model->delete_prog($dept,$id);
            }
           else if($this->session->userdata('officetype') === 'Directorates') {
                $this->package_model->delete_directorate($directorate,$id);
                }
           else  if($this->session->userdata('officetype') === 'District') {
                    $this->package_model->delete_district($district,$id);
                    }
                    else  {
                        $this->package_model->delete_spoffice($spoffice,$id);
                        }
        }
        if($this->session->userdata('role') === 'Super Admin') {
            redirect('Add/filter');
            }
            else {
                redirect('programmes1');
            }
    }

    private function validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('training') == '')
        {
            $data['inputerror'][] = 'training';
            $data['error_string'][] = 'Training is required';
            $data['status'] = FALSE;
        }
 
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    
    }
}