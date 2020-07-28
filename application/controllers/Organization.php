<?php
    class Organization extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->database();
         
            $this->load->library('form_validation');
            $this->load->model("Organization_model");
            $this->load->model('Dashboard_model','dashboard');
            
        }
        public function dept() {
            $this->load->view('governance/secretariat');
        }

        public function home() {
            $this->load->view('backend/dashboard1');
        }

        public function district() {
            $this->load->view('governance/district');
        }
        private function logged_in(){
       
            if($this->session->userdata('logged_in') !== TRUE) {
                redirect('login');
            }
        }
        

        public function directorate1() {
            $this->logged_in();
            $this->load->view('admin/governance/createdirectorate');
        }

        public function directorate() {
            $this->load->view('governance/directorate');
        }


        public function list_ajax() {
            
            
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));
            $books = $this->Organization_model->getTotalList_of_dept();

            $data['draw'] = 1;
            $data['recordsTotal'] = count($books);
            $data['recordsFiltered'] = count($books);

            foreach($books as $key => $row)
            {
                $arr_result = array(

                    "dname" => $row->dname,
                    
                    "n_name" => '<a data-toggle="modal" data-target="#nodalModal" name="n_name"  onclick="javascript:load_n_name('.$row->id.');">'. $row->n_name. '</a>',
                   
                
                    "m_name" => '<a data-toggle="modal" data-target="#masterModal" name="n_name"  onclick="javascript:load_m_name('.$row->id.');">'. $row->m_name. '</a>',
                   
                    "e_name" =>  '<a data-toggle="modal" data-target="#emdModal" name="e_name"  onclick="javascript:load_e_name('.$row->id.');">'. $row->e_name. '</a>',
                   
                
                    
                );
                
               

                $array_secondary = array();
                $books_of_secondary = $this->Organization_model->getTotalList_of_sections($row->id);
                foreach($books_of_secondary as $key => $row)
                {
                    $arr_result2 = array(
                        "directorate" => $row->section,
                        "n_name" => '<a data-toggle="modal" data-target="#nodalModal1" name="n_name"  onclick="javascript:load_n_name1('.$row->id.');">'. $row->n_name. '</a>',
                   
                        
                        "m_name" =>'<a data-toggle="modal" data-target="#masterModal1" name="n_name"  onclick="javascript:load_m_name1('.$row->id.');">'. $row->m_name. '</a>',
                   
                        "e_name" => '<a data-toggle="modal" data-target="#emdModal1" name="e_name"  onclick="javascript:load_e_name1('.$row->id.');">'. $row->e_name. '</a>',
                   
                        
                    );

                    $array_secondary[] = $arr_result2;
                }
                $arr_result['secondary'] = $array_secondary;
                $data['data'][] = $arr_result;
            }
            echo json_encode($data);
            exit;
            
           
           
           
        }



        public function nodal() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->nodal($id);
            $this->load->view("governance/modal1",$data);
        } 
        public function master() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->master($id);
            $this->load->view("governance/modal2",$data);
        } 
        public function emd() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->emd($id);
            $this->load->view("governance/modal3",$data);
        } 
        public function nodal1() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->nodal1($id);
            $this->load->view("governance/modal4",$data);
        } 
        public function master1() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->master1($id);
            $this->load->view("governance/modal5",$data);
        } 
        public function emd1() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->emd1($id);
            $this->load->view("governance/modal6",$data);
        } 
        public function nodal2() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->nodal2($id);
            $this->load->view("governance/modal4",$data);
        } 
        public function master2() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->master2($id);
            $this->load->view("governance/modal5",$data);
        } 
        public function emd2() {
            $id = $_POST['id'];
            $data['part'] = $this->Organization_model->emd2($id);
            $this->load->view("governance/modal6",$data);
        } 
        
        public function secretariat() {
            $this->load->view('governance/secretariat');
        }

        public function add_directorate() {

        }
        public function directorates() {

            $list = $this->Organization_model->getAll_directorates();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $r) {
                $no++;
                $row = array();
            
                $row[] = $no;
                $row[] = $r->name;
                $row[] = $r->deptname;
                        
                //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_directorate('."'".$r->did."'".')"><i class="fas fa-edit fa-lg"></i></a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_directorate('."'".$r->did."'".')"><i class="fas fa-trash fa-lg"></i></a>';
    
        
               
                $data[] = $row;
            }
        
            $result = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Organization_model->count_all_directorate(),
                            "recordsFiltered" => $this->Organization_model->count_filtered_directorate(),
                            "data" => $data,
                    );
            //output to json format

            echo json_encode($result);
        }

        public function ajax_add_directorate()
        {
            
        $this->validate();
$name =  $this->security->xss_clean($this->input->post("directorate"));
$dept = $this->input->post("dept");
$this->form_validation->set_rules('directorate', 'Course Name', 'required');
if($this->form_validation->run() === TRUE){
    $validate = $this->Organization_model->checkDirectorate($name,$dept);
    if($validate->num_rows() > 0 ) {
        echo json_encode(array("message" => 'District exists'));
    }
    else {
     
 $data = array(
         'name' => $name, 
         'dept' => $dept,
     );
 if($this->Organization_model->save_directorate($data)){
    
    echo json_encode(array(
         "status" => TRUE,
     "message" => "Directorate added successfully",
     ));
     

    
 }
 else {
     
     echo json_encode(array(
         "status" => FALSE,
         "message" => "Failed to add directorate"
     ));
   
 }
}
}
else {
 
 echo json_encode(array(
     "status" => FALSE,
     "message" => "All fields are needed"
 ));


}
    }

    private function validate()
{
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('directorate') == '')
    {
        $data['inputerror'][] = 'directorate';
        $data['error_string'][] = 'Directorate name is required';
        $data['status'] = FALSE;
    }

    if($this->input->post('dept') == '')
    {
        $data['inputerror'][] = 'dept';
        $data['error_string'][] = 'Select Department';
        $data['status'] = FALSE;
    }
    
    if($data['status'] === FALSE)
    {
        echo json_encode($data);
        exit();
    }
}


        public function ajax_update_directorate()
        {
            $this->validate();
            $dept = $this->input->post('dept');
            $data = array(
                    'dept' => $dept,
                    'name' => $this->input->post('directorate'),
                  
                  
                );
            $this->Organization_model->update_directorate(array('id' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE,
        "message" => 'Updated successfully'));
        }
     
        public function ajax_delete_directorate($id)
        {
            $this->Organization_model->delete_by_id_directorate($id);
            echo json_encode(array("status" => TRUE,
        "message" => 'Deleted successfully'));
        }

        public function ajax_edit_directorate($id)
        {
            $data = $this->Organization_model->get_by_id_directorate($id);
           
            echo json_encode($data);
        }



       public function list_directorates() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
           $list = $this->Organization_model->getAll();
           $data = array();

           
           $no = $start;
           foreach ($list as $r) {
               $no++;
               $row = array();
           
               $row[] = $no;
               $row[] = $r->dname;
              $row[] = '<a data-toggle="modal" data-target="#nodalModal1" name="n_name" onclick="javascript:load_n_name1('.$r->id.');">'.$r->n_name.'</a>';
        
                  $row[] = '<a data-toggle="modal" data-target="#masterModal1" name="m_name"  onclick="javascript:load_m_name1('.$r->id.');">'. $r->m_name. '</a>';
            $row[] = '<a data-toggle="modal" data-target="#emdModal1" name="e_name"  onclick="javascript:load_e_name1('.$r->id.');">'. $r->e_name. '</a>';
                        
                 
                       
               //add html for action
          
              
               $data[] = $row;
           }
       
           $result = array(
                           "draw" => $_POST['draw'],
                           "recordsTotal" => $this->Organization_model->count_all_directorate(),
                           "recordsFiltered" => $this->Organization_model->count_filtered_directorate(),
                           "data" => $data,
                   );
           //output to json format

           echo json_encode($result);

       }
     
       public function list_districts() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
           $list = $this->Organization_model->getAll_districts();
           $data = array();

           $no = $start;
           foreach ($list as $r) {
               $no++;
               $row = array();
           
               $row[] = $no;
               $row[] = $r->districts;
              
               $row[] = '<a data-toggle="modal" data-target="#nodalModal1" name="n_name" onclick="javascript:load_n_name_district('.$r->id.');">'.$r->n_name.'</a>';
        
               $row[] = '<a data-toggle="modal" data-target="#masterModal1" name="m_name"  onclick="javascript:load_m_name_district('.$r->id.');">'. $r->m_name. '</a>';
         $row[] = '<a data-toggle="modal" data-target="#emdModal1" name="e_name"  onclick="javascript:load_e_name_district('.$r->id.');">'. $r->e_name. '</a>';
           
               //add html for action
          
              
               $data[] = $row;
           }
       
           $result = array(
                           "draw" => $_POST['draw'],
                           "recordsTotal" => $this->Organization_model->count_all_directorate(),
                           "recordsFiltered" => $this->Organization_model->count_filtered_directorate(),
                           "data" => $data,
                   );
           //output to json format

           echo json_encode($result);

       }



       public function list_ajax_direct() {
            
            
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $books = $this->Organization_model->getAll();

        $data['draw'] = 1;
        $data['recordsTotal'] = count($books);
        $data['recordsFiltered'] = count($books);

        foreach($books as $key => $row)
        {
            $arr_result = array(

                "dname" => $row->dname,
                
                "n_name" => '<a data-toggle="modal" data-target="#nodalModal1" name="n_name"  onclick="javascript:load_n_name1('.$row->id.');">'. $row->n_name. '</a>',
               
            
                "m_name" => '<a data-toggle="modal" data-target="#masterModal1" name="n_name"  onclick="javascript:load_m_name1('.$row->id.');">'. $row->m_name. '</a>',
               
                "e_name" =>  '<a data-toggle="modal" data-target="#emdModal1" name="e_name"  onclick="javascript:load_e_name1('.$row->id.');">'. $row->e_name. '</a>',
               
            
                
            );
            
            $data['data'][] = $arr_result;
        }
        echo json_encode($data);
        exit;
        
       
       
       
    }
     
    }

    
?>