<?php
defined('BASEPATH') OR exit ('No direct script access allowed'); 
class Governance extends CI_Controller {

  function __construct() {
      parent::__construct();
      $this->load->database();
      $this->load->model('Dashboard_model','dashboard');
     
      $this->load->helper('url');
      $this->logged_in();
  }

  private function logged_in(){
       
    if($this->session->userdata('logged_in') !== TRUE) {
        redirect('login');
    }
}



  function district(){
    if($this->session->userdata('role') === 'Admin' || $this->session->userdata('role') === 'Super Admin'){
    $data['designation'] = $this->dashboard->getDesignation();
    $data['district'] = $this->dashboard->getDistrict();
    
    $this->load->view('admin/governance/addDistrict',$data);
  }

    else {
      redirect('login');
    }
  }
  
  function secretariat(){
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
    
    $data['designation'] = $this->dashboard->getDesignation();
    $data['department'] = $this->dashboard->getDepartment();
    $data['directorate'] = $this->dashboard->getDirectorate();
      $this->load->view('admin/governance/addsecretariat',$data);
  }

  
  public function ajax_list() {
      
  }


  public function getSecretariat() {
    $list = $this->dashboard->getAll();
    $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->dname;
            $row[] = $r->directorate;
            $row[] = $r->n_name .'('.$r->designation.')';
            $row[] = $r->email;
            $row[] = $r->phone;
                    
            
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_course('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_course('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->dashboard->count_all_secretariat(),
                        "recordsFiltered" => $this->dashboard->count_filtered_secretariat(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

  }

  public function add_nodal()
  {
    $this->validate_nodal();
   $post = $this->input->post('post',TRUE);
    $name = $this->input->post('n_name',true);
    $designation = $this->input->post('designation',true);
    $dept = $this->input->post('dept',true);
    $directorate = $this->input->post('directorate',true);
    $email = $this->input->post('email',true);
    $phone = $this->input->post('phone',true);

  
    $validate = $this->dashboard->checkNodal($name,$dept);
    if($validate->num_rows() > 0) {
      $this->response(array('status' => FALSE,
      "message" => 'Nodal Officer already exists'));
    }
    else{
      if($post === 'Nodal Officer') {
    $data = array(
      'n_name' => $name,
      'designation' => $designation,
      'dept' => $dept,
      'directorate' => $directorate,
      'email' => $email,
      'phone' => $phone, 
    );
  } else if($post === 'Master Trainer') {
    $data = array(
      'm_name' => $name,
      'designation' => $designation,
      'dept' => $dept,
      'directorate' => $directorate,
      'email' => $email,
      'phone' => $phone, 
    );
  } else if($post === 'EMD Managers') {
    $data = array(
      'e_name' => $name,
      'designation' => $designation,
      'dept' => $dept,
      'directorate' => $directorate,
      'email' => $email,
      'phone' => $phone, 
    );
  } else {}
    
    $insert = $this->dashboard->save_nodal($data);
    echo json_encode(array("status" => TRUE,
  "message" => 'Nodal Officer added successfully'));
  }
}

public function getOffice() {
  $office = $this->input->post('id',TRUE);
  if($office === 'Departmental') {
    $data = $this->dashboard->getOfficeDepartment();
  }
  else if($office === 'Directorates') {
    $data = $this->dashboard->getOfficeDirectorates();
  }
  else if($office === 'District') {
    $data = $this->dashboard->getOfficeDistrict();
  }
  else {
    $data = $this->dashboard->getOfficeSPOffice();
  }
  
  echo json_encode($data);
}


  public function getDirectorate() {
    $dept = $this->input->post('id',TRUE);
    $data = $this->dashboard->getDirectorate2($dept);
    echo json_encode($data);
}
private function validate_nodal()
{
$data = array();
$data['error_string'] = array();
$data['inputerror'] = array();
$data['status'] = TRUE;

if($this->input->post('n_name') == '')
{
    $data['inputerror'][] = 'n_name';
    $data['error_string'][] = 'Name of the person is required';
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
if($this->input->post('directorate') == '')
{
    $data['inputerror'][] = 'directorate';
    $data['error_string'][] = 'Select Directorate';
    $data['status'] = FALSE;
}

if($this->input->post('email') == '')
{
    $data['inputerror'][] = 'email';
    $data['error_string'][] = 'Enter Email';
    $data['status'] = FALSE;
}
if($this->input->post('phone') == '')
{
    $data['inputerror'][] = 'phone';
    $data['error_string'][] = 'Enter Phone';
    $data['status'] = FALSE;
}




if($data['status'] === FALSE)
{
    echo json_encode($data);
    exit();
}
}


public function getMaster() {
  $list = $this->dashboard->getAll_master();
  $data = array();
      $no = $_POST['start'];
      foreach ($list as $r) {
          $no++;
          $row = array();
      
          $row[] = $no;
          $row[] = $r->dname;
          $row[] = $r->directorate;
          $row[] = $r->m_name .'('.$r->designation.')';
          $row[] = $r->email;
          $row[] = $r->phone;
           

          //add html for action
          $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_master('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_master('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
       
          $data[] = $row;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->dashboard->count_all_secretariat(),
                      "recordsFiltered" => $this->dashboard->count_filtered_secretariat(),
                      "data" => $data,
              );
      //output to json format
      echo json_encode($output);

}
public function add_master()
  {
    $this->validate_master();
    $name = $this->input->post('m_name');
    $designation = $this->input->post('designation');
    $dept = $this->input->post('dept');
    $directorate = $this->input->post('directorate');
    $email = $this->input->post('email');
    $phone = $this->input->post('phone');

  
    
    $validate = $this->dashboard->checkMaster($name,$dept);
    if($validate->num_rows() > 0 ) {
      echo json_encode(array("status" => FALSE,
      "message" => 'Master Trainer already exists'));
    }
    else {
    $data = array(
      'm_name' => $name,
      'designation' => $designation,
      'dept' => $dept,
      'directorate' => $directorate ,
      'email' => $email,
      'phone' => $phone
    );
    
    $insert = $this->dashboard->save_master($data);
    echo json_encode(array("status" => TRUE,
  "message" => 'Master Trainer added successfully'));
  }
  }
  private function validate_master()
  {
  $data = array();
  $data['error_string'] = array();
  $data['inputerror'] = array();
  $data['status'] = TRUE;
  
  if($this->input->post('m_name') == '')
  {
      $data['inputerror'][] = 'm_name';
      $data['error_string'][] = 'Name of the person is required';
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
  if($this->input->post('directorate') == '')
  {
      $data['inputerror'][] = 'directorate';
      $data['error_string'][] = 'Select Directorate';
      $data['status'] = FALSE;
  }
  if($this->input->post('email') == '')
{
    $data['inputerror'][] = 'email';
    $data['error_string'][] = 'Enter Email';
    $data['status'] = FALSE;
}
if($this->input->post('phone') == '')
{
    $data['inputerror'][] = 'phone';
    $data['error_string'][] = 'Enter Phone';
    $data['status'] = FALSE;
}

  
  
  
  if($data['status'] === FALSE)
  {
      echo json_encode($data);
      exit();
  }
  }
  

  public function getEmd() {
    $list = $this->dashboard->getAll_emd();
    $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->dname;
            $row[] = $r->directorate;
           
            $row[] = $r->e_name .'('.$r->designation.')';
            $row[] = $r->email;
            $row[] = $r->phone;
             
                    
            
  
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_emd('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_emd('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
            $data[] = $row;
        }
  
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->dashboard->count_all_secretariat(),
                        "recordsFiltered" => $this->dashboard->count_filtered_secretariat(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
  
  }
  public function add_emd()
    {
      $this->validate_emd();
      $name = $this->input->post('e_name');
      $designation = $this->input->post('designation');
      $dept = $this->input->post('dept');
      $directorate = $this->input->post('directorate');
      $email = $this->input->post('email');
    $phone = $this->input->post('phone');

      $validate = $this->dashboard->checkemd($name,$dept);
      if($validate->num_rows() > 0) {
        echo json_encode(array("status" => FALSE,
        "message" => 'EMD Managers already exists' ));
      }
      else {
      $data = array(
        'e_name' => $name,
        'designation' => $designation,
        'dept' => $dept,
        'directorate' => $directorate,
        'email' => $email,
        'phone' => $phone, 
      );
      
      $insert = $this->dashboard->save_emd($data);
      echo json_encode(array("status" => TRUE,
    "message" => 'EMD Managers added successfully'));
    }
    }

    private function validate_emd()
  {
  $data = array();
  $data['error_string'] = array();
  $data['inputerror'] = array();
  $data['status'] = TRUE;
  
  if($this->input->post('e_name') == '')
  {
      $data['inputerror'][] = 'e_name';
      $data['error_string'][] = 'Name of the person is required';
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
  if($this->input->post('directorate') == '')
  {
      $data['inputerror'][] = 'directorate';
      $data['error_string'][] = 'Select Directorate';
      $data['status'] = FALSE;
  }
  
  if($this->input->post('email') == '')
{
    $data['inputerror'][] = 'email';
    $data['error_string'][] = 'Enter Email';
    $data['status'] = FALSE;
}
if($this->input->post('phone') == '')
{
    $data['inputerror'][] = 'phone';
    $data['error_string'][] = 'Enter Phone';
    $data['status'] = FALSE;
}

  
  
  if($data['status'] === FALSE)
  {
      echo json_encode($data);
      exit();
  }
  }
  
  private function validate_nodal_district()
  {
  $data = array();
  $data['error_string'] = array();
  $data['inputerror'] = array();
  $data['status'] = TRUE;
  
  if($this->input->post('n_name') == '')
  {
      $data['inputerror'][] = 'n_name';
      $data['error_string'][] = 'Name of the person is required';
      $data['status'] = FALSE;
  }
  
  
  
  if($this->input->post('designation') == '')
  {
      $data['inputerror'][] = 'designation';
      $data['error_string'][] = 'Select Designation';
      $data['status'] = FALSE;
  }
  
  if($this->input->post('district') == '')
  {
      $data['inputerror'][] = 'district';
      $data['error_string'][] = 'Select District';
      $data['status'] = FALSE;
  }
  
  
  
  
  
  if($data['status'] === FALSE)
  {
      echo json_encode($data);
      exit();
  }
  }

  private function validate_master_district()
  {
  $data = array();
  $data['error_string'] = array();
  $data['inputerror'] = array();
  $data['status'] = TRUE;
  
  if($this->input->post('m_name') == '')
  {
      $data['inputerror'][] = 'm_name';
      $data['error_string'][] = 'Name of the person is required';
      $data['status'] = FALSE;
  }
  
  
  
  if($this->input->post('designation') == '')
  {
      $data['inputerror'][] = 'designation';
      $data['error_string'][] = 'Select Designation';
      $data['status'] = FALSE;
  }
  
  if($this->input->post('district') == '')
  {
      $data['inputerror'][] = 'district';
      $data['error_string'][] = 'Select District';
      $data['status'] = FALSE;
  }
  
  
  
  
  
  if($data['status'] === FALSE)
  {
      echo json_encode($data);
      exit();
  }
  }
  
  private function validate_emd_district()
  {
  $data = array();
  $data['error_string'] = array();
  $data['inputerror'] = array();
  $data['status'] = TRUE;
  
  if($this->input->post('e_name') == '')
  {
      $data['inputerror'][] = 'e_name';
      $data['error_string'][] = 'Name of the person is required';
      $data['status'] = FALSE;
  }
  
  
  
  if($this->input->post('designation') == '')
  {
      $data['inputerror'][] = 'designation';
      $data['error_string'][] = 'Select Designation';
      $data['status'] = FALSE;
  }
  
  if($this->input->post('district') == '')
  {
      $data['inputerror'][] = 'district';
      $data['error_string'][] = 'Select District';
      $data['status'] = FALSE;
  }
  
  
  
  
  
  if($data['status'] === FALSE)
  {
      echo json_encode($data);
      exit();
  }
  }

    public function update_nodal()
    {
      $this->validate_nodal();
      $post = $this->input->post('post',true);
      $name = $this->input->post('n_name');
      $designation = $this->input->post('designation');
      $dept = $this->input->post('dept');
      $directorate = $this->input->post('directorate');
      $email = $this->input->post('email');
      $phone = $this->input->post('phone');
  
  
    
  if($post === 'Nodal Officer') {
      $data = array(
        'n_name' => $name,
        'designation' => $designation,
        'dept' => $dept,
        'directorate' => $directorate,
        'email' => $email,
        'phone'=> $phone, 
      );
    }
    else if($post === 'Master Trainer') {
      $data = array(
        'm_name' => $name,
        'designation' => $designation,
        'dept' => $dept,
        'directorate' => $directorate,
        'email' => $email,
        'phone'=> $phone, 
      );
    }
    else if($post === 'EMD Managers') {
      $data = array(
        'e_name' => $name,
        'designation' => $designation,
        'dept' => $dept,
        'directorate' => $directorate,
        'email' => $email,
        'phone'=> $phone, 
      );
    } else {}
        $this->dashboard->update_nodal(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE,"message" => 'Updated Successfully'));
    }
    public function edit_nodal($id)
    {
        $data = $this->dashboard->get_by_id_nodal($id);
       
        echo json_encode($data);
    }

    public function delete_nodal($nodal)
    {
        $this->dashboard->delete_by_id_nodal($nodal);
        echo json_encode(array("status" => TRUE,
      "message" => 'Deleted successfully'));
    }

   
    public function edit_master($id)
    {
        $data = $this->dashboard->get_by_id_master($id);
       
        echo json_encode($data);
    }

    public function delete_master($master)
    {
        $this->dashboard->delete_by_id_master($master);
        echo json_encode(array("status" => TRUE,
      "message" => 'Deleted successfully'));
    }
    
    public function edit_emd($id)
    {
        $data = $this->dashboard->get_by_id_emd($id);
       
        echo json_encode($data);
    }

    public function delete_emd($emd)
    {
        $this->dashboard->delete_by_id_emd($emd);
        echo json_encode(array("status" => TRUE,
      "message" => 'Deleted successfully'));
    }



    public function getSecretariat_district() {
      $list = $this->dashboard->getAll_district();
      $data = array();
          $no = $_POST['start'];
          foreach ($list as $r) {
              $no++;
              $row = array();
          
              $row[] = $no;
              $row[] = $r->district;
             
              
              $row[] = $r->n_name .'('.$r->designation.')';
              $row[] = $r->email;
              $row[] = $r->phone;
               

                      
              
   
              //add html for action
              $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_course_district('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_course_district('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
           
              $data[] = $row;
          }
   
          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->dashboard->count_all_district(),
                          "recordsFiltered" => $this->dashboard->count_filtered_district(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
  
    }
  
    public function add_nodal_district()
    {
      $this->validate_nodal_district();
     $post = $this->input->post('post',true);
      $name = $this->input->post('n_name');
      $designation = $this->input->post('designation');
      $district = $this->input->post('district');
      $email = $this->input->post('email');
      $phone = $this->input->post('phone');
     
      $validate = $this->dashboard->checknodal_district($name,$district);

      if($validate->num_rows() > 0){
        echo json_encode(array("status" => FALSE,
        "message" => 'Nodal Officer exists'));
      }
      else{
        if($post === 'Nodal Officer') {
      $data = array(
        'n_name' => $name,
        'designation' => $designation,
        'district' => $district,
        'email' => $email,
        'phone' => $phone
       
      );
      }
      else if($post === 'Master Trainer') {
        $data = array(
          'm_name' => $name,
          'designation' => $designation,
          'district' => $district,
          'email' => $email,
          'phone' => $phone
         
        );
        }
       else if($post === 'EMD Managers') {
          $data = array(
            'e_name' => $name,
            'designation' => $designation,
            'district' => $district,
            'email' => $email,
            'phone' => $phone
           
          );
          } else{}
      
      $insert = $this->dashboard->save_nodal_district($data);
      echo json_encode(array("status" => TRUE,
    "message" => 'Nodal Officer added successfully'));
    }
      
  }

  

  
   
  public function getMaster_district() {
    $list = $this->dashboard->getAll_master_district();
    $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->district;
          
            $row[] = $r->m_name .'('.$r->designation.')';
            $row[] = $r->email;
            $row[] = $r->phone;
             
                    
            
  
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_master_district('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_master_district('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
         
            $data[] = $row;
        }
  
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->dashboard->count_all_district(),
                        "recordsFiltered" => $this->dashboard->count_filtered_district(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
  
  }
  
  
  
    public function getEmd_district() {
      $list = $this->dashboard->getAll_emd_district();
      $data = array();
          $no = $_POST['start'];
          foreach ($list as $r) {
              $no++;
              $row = array();
          
              $row[] = $no;
              $row[] = $r->district;
             
              $row[] = $r->e_name .'('.$r->designation.')';
              $row[] = $r->email;
              $row[] = $r->phone;
               
                      
              
    
              //add html for action
              $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_emd_district('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_emd_district('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
           
              $data[] = $row;
          }
    
          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->dashboard->count_all_district(),
                          "recordsFiltered" => $this->dashboard->count_filtered_district(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
    
    }
    
       
        
      public function update_nodal_district()
      {
        $this->validate_nodal_district();
        $post = $this->input->post('post');
        $name = $this->input->post('n_name');
        $designation = $this->input->post('designation');
        $district = $this->input->post('district');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
       
        
       
      if($post === 'Nodal Officer') {
    
        $data = array(
          'n_name' => $name,
          'designation' => $designation,
          'district' => $district,
          'email' => $email,
          'phone' => $phone,
          
          
        );
      }
     else if($post === 'Master Trainer') {
    
        $data = array(
          'm_name' => $name,
          'designation' => $designation,
          'district' => $district,
          'email' => $email,
          'phone' => $phone,
          
          
        );
      }
     else if($post === 'EMD Managers') {
    
        $data = array(
          'e_name' => $name,
          'designation' => $designation,
          'district' => $district,
          'email' => $email,
          'phone' => $phone,
          
          
        );
      } else {}
        
          $this->dashboard->update_nodal_district(array('id' => $this->input->post('id')), $data);
          echo json_encode(array("status" => TRUE,
        "message" => 'Updated successfully'));
      }
      public function edit_nodal_district($id)
      {
          $data = $this->dashboard->get_by_id_nodal_district($id);
         
          echo json_encode($data);
      }
  
      public function delete_nodal_district($nodal)
      {
          $this->dashboard->delete_by_id_nodal_district($nodal);
          echo json_encode(array("status" => TRUE,
        "message" => 'Deleted successfully'));
      }
  
      
      public function edit_master_district($id)
      {
          $data = $this->dashboard->get_by_id_master_district($id);
         
          echo json_encode($data);
      }
  
      public function delete_master_district($master)
      {
          $this->dashboard->delete_by_id_master_district($master);
          echo json_encode(array("status" => TRUE,
        "message" => 'Deleted successfully'));
      }
     
      public function edit_emd_district($id)
      {
          $data = $this->dashboard->get_by_id_emd_district($id);
         
          echo json_encode($data);
      }
  
      public function delete_emd_district($emd)
      {
          $this->dashboard->delete_by_id_emd_district($emd);
          echo json_encode(array("status" => TRUE,
        "message" => 'Deleted successfully'));
      }
  
  
      public function user() {
        $data['designation'] = $this->dashboard->getDesignation();
        $data['dept'] = $this->dashboard->getDepartment();
        $data['directorate'] = $this->dashboard->getDirectorate();
        $data['role'] = $this->dashboard->getRole();
        $this->load->view('admin/governance/user1',$data);
      }

      public function users() {
        $list = $this->dashboard->getAll_users();
        $data = array();
            $no = $_POST['start'];
            foreach ($list as $r) {
                $no++;
                $row = array();
            
                $row[] = $no;
                $row[] = $r->name;
                $row[] = $r->email;
                $row[] = $r->phone;
                $row[] = $r->designation;
                $row[] = $r->dname;
                $row[] = $r->directorate;
                $row[] = $r->district;
                $row[] = $r->spoffice;
                $row[] = $r->role;
                $row[] = $r->status;
                
      
                //add html for action
                $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$r->id."'".')"><i class="fas fa-edit fa-lg"></i></a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$r->id."'".')"><i class="fas fa-trash fa-lg"></i></a>';
             
                $data[] = $row;
            }
      
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->dashboard->count_all_users(),
                            "recordsFiltered" => $this->dashboard->count_filtered_users(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
      
      }

      

      public function update_user()
      {
        $this->validate_user();
        $name = $this->input->post('name');
        $designation = $this->input->post('designation');
        $dept = $this->input->post('dept');
        $directorate = $this->input->post('directorate');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $role = $this->input->post('role');
        $status = $this->input->post('status');
    
       
    
        $data = array(
          'name' => $name,
          'designation' => $designation,
          'dept' => $dept,
          'directorate' => $directorate,
          'email' => $email,
          'phone' => $phone,
          'role' => $role,
          'status' => $status,

        );
        
          $this->dashboard->update_user(array('id' => $this->input->post('id')), $data);
          echo json_encode(array("status" => TRUE,
        "message" => 'Updated successfully'));
      
  }
      public function user_edit($id)
      {
          $data = $this->dashboard->get_by_id_user($id);
         
          echo json_encode($data);
      }
  
      public function user_edit1($id)
      {
        $check = $this->dashboard->officetype($id);
        if($check === 'Departmental') {
          $data = $this->dashboard->get_user_department($id);
        }
        else if($check === 'Directorates') {
          $data = $this->dashboard->get_user_directorate($id);
        }
        else if($check === 'District') {
          $data = $this->dashboard->get_user_district($id);
        }
        else {
          $data = $this->dashboard->get_user_spoffice($id);
        }

         
          echo json_encode($data);
      }
  
      public function delete_user($id)
      {
          $this->dashboard->delete_by_id_user($id);
          echo json_encode(array("status" => TRUE,
        "message" => 'Deleted successfully'));
      }
      
 
      public function add_user()
  {
   $this->validate_user();
    $name = $this->input->post('name');
    $designation = $this->input->post('designation');
    $dept = $this->input->post('dept');
    $directorate = $this->input->post('directorate');
    $email = $this->input->post('email');
    $phone = $this->input->post('phone');
    $role = $this->input->post('role');
    $status = $this->input->post('status');

  
    

  $validate = $this->dashboard->checkuser($email);
  if($validate->num_rows() > 0 ){
    echo $this->session->set_flashdata('msg','User exists');
  }
 else{
    $data = array(
      'name' => $name,
      'designation' => $designation,
      'dept' => $dept,
      'directorate' => $directorate,
      'email' => $email,
      'phone' => $phone,
      'role' => $role,
      'status' => $status,

    );
    
    $insert = $this->dashboard->save_user($data);
   
    $this->load->helper('string');
    $rs = random_string('alnum', 12);
    $data = array(
        'rs' => $rs
    );

    $this->db->where('email',$email);
    $this->db->update('employee',$data);

   

    $config['protocol'] ='smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_port'] = 465;
    $config['smtp_user'] = 'meghabasak121@gmail.com';
    $config['smtp_pass'] = 'megha121';

    $this->email->initialize($config);
    $this->email->set_newline("\r\n"); 
    $this->email->from('meghabasak121@gmail.com','eOffice');
    $this->email->to($email);
    $this->email->subject('Set your Password');
    $this->email->message('Please go to this link to set your password. http://localhost/eoffice/login/recover/'.$rs);
    if($this->email->send()) {
    echo json_encode(" Email Sent !!Please check your email address");
    echo json_encode(array("status" => TRUE));
    }
    else {
        echo $this->email->print_debugger();
    }
         
     }

    }

    private function validate_user()
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
    
    
    
    if($this->input->post('designation') == '')
    {
        $data['inputerror'][] = 'designation';
        $data['error_string'][] = 'Select Designation';
        $data['status'] = FALSE;
    }
    
    if($this->input->post('dept') == '')
    {
        $data['inputerror'][] = 'dept';
        $data['error_string'][] = 'Select Department';
        $data['status'] = FALSE;
    }
    if($this->input->post('email') == '')
    {
        $data['inputerror'][] = 'email';
        $data['error_string'][] = 'Enter Email address';
        $data['status'] = FALSE;
    }
    if($this->input->post('phone') == '')
    {
        $data['inputerror'][] = 'phone';
        $data['error_string'][] = 'Enter phone number';
        $data['status'] = FALSE;
    }
    if($this->input->post('directorate') == '')
    {
        $data['inputerror'][] = 'directorate';
        $data['error_string'][] = 'Select Dierctorate';
        $data['status'] = FALSE;
    }
    if($this->input->post('role') == '')
    {
        $data['inputerror'][] = 'role';
        $data['error_string'][] = 'Select Role';
        $data['status'] = FALSE;
    }
    
    
    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
    }



    public function add_user1()
    {
     
      $name = $this->input->post('name');
      $designation = $this->input->post('designation');
      $officetype = $this->input->post('officetype');
      $office = $this->input->post('office');
      $email = $this->input->post('email');
      $phone = $this->input->post('phone');
      $role = $this->input->post('role');
      $status = $this->input->post('status');
  
    
      
  
    $validate = $this->dashboard->checkuser($email);
    if($validate->num_rows() > 0 ){
      echo $this->session->set_flashdata('msg','User exists');
    }
   else{
     if($officetype === 'Departmental') {
      $data = array(
        'name' => $name,
        'designation' => $designation,
        'dept' => $office,
        'email' => $email,
        'phone' => $phone,
        'role' => $role,
        'status' => $status,
        'office' => $officetype,
  
      );

     }
     else if($officetype === 'Directorates') {
      $data = array(
        'name' => $name,
        'designation' => $designation,
        'directorate' => $office,
        'email' => $email,
        'phone' => $phone,
        'role' => $role,
        'status' => $status,
        'office' => $officetype,
  
      );
     }
     else if($officetype === 'District') {
      $data = array(
        'name' => $name,
        'designation' => $designation,
        'district' => $office,
        'email' => $email,
        'phone' => $phone,
        'role' => $role,
        'status' => $status,
        'office' => $officetype,
  
      );
     }
     else {
      $data = array(
        'name' => $name,
        'designation' => $designation,
        'spoffice' => $office,
        'email' => $email,
        'phone' => $phone,
        'role' => $role,
        'status' => $status,
        'office' => $officetype,
  
      );
     }
     
      
      $insert = $this->dashboard->save_user($data);
     
      $this->load->helper('string');
      $rs = random_string('alnum', 12);
      $data = array(
          'rs' => $rs
      );
  
      $this->db->where('email',$email);
      $this->db->update('employee',$data);
  
     
  
      $config['protocol'] ='smtp';
      $config['smtp_host'] = 'ssl://smtp.googlemail.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'meghabasak121@gmail.com';
      $config['smtp_pass'] = 'megha121';
  
      $this->email->initialize($config);
      $this->email->set_newline("\r\n"); 
      $this->email->from('meghabasak121@gmail.com','eOffice');
      $this->email->to($email);
      $this->email->subject('Set your Password');
      $this->email->message('Please go to this link to set your password. http://localhost/eoffice/login/recover/'.$rs);
      if($this->email->send()) {
      echo json_encode(" Email Sent !!Please check your email address");
      echo json_encode(array("status" => TRUE));
      }
      else {
          echo $this->email->print_debugger();
      }
           
       }
  
      }
    

      public function update_user1()
      {
       
        $name = $this->input->post('name');
        $designation = $this->input->post('designation');
        $officetype = $this->input->post('officetype');
        $office = $this->input->post('office');  
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $role = $this->input->post('role');
        $status = $this->input->post('status');
    
       if($officetype === 'Departmental') {
        $data = array(
          'name' => $name,
          'designation' => $designation,
          'dept' => $office,
         'office' => $officetype,
          'email' => $email,
          'phone' => $phone,
          'role' => $role,
          'status' => $status,

        );
        
       }
       else if($officetype === 'Directorates') {
        $data = array(
          'name' => $name,
          'designation' => $designation,
          
          'directorate' => $office,
          'office'=> $officetype,
          'email' => $email,
          'phone' => $phone,
          'role' => $role,
          'status' => $status,

        );
        
       }
       else if($officetype === 'District') {
        $data = array(
          'name' => $name,
          'designation' => $designation,
          
          'district' => $office,
          'office'=> $officetype,
          'email' => $email,
          'phone' => $phone,
          'role' => $role,
          'status' => $status,

        );
       }
    else {
      $data = array(
        'name' => $name,
        'designation' => $designation,
        
        'spoffice' => $office,
        'office'=> $officetype,
        'email' => $email,
        'phone' => $phone,
        'role' => $role,
        'status' => $status,

      );
    }
       
        
          $this->dashboard->update_user(array('id' => $this->input->post('id')), $data);
          echo json_encode(array("status" => TRUE,
        "message" => 'Updated successfully'));
      
  }
}