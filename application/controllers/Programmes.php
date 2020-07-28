<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programmes extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Programmes_model');
        $this->load->model('Trainings_model');
        $this->load->model('Dashboard_model','dashboard');

    }

    function view()
    {
        $data['dept'] = $this->Programmes_model->getDepartment();
        $this->load->view('admin/trainings/program', $data);
    }

    public function viewAll()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $list = $this->Programmes_model->getAll();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->title;
            $row[] = $r->dname;

              //add html for action
              $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_participant('."'".$r->training."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_programme('."'".$r->training."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                
        $data[] = $row;
                    
        }

        $output = array(
            "draw" => $_POST['draw'],
           
            "data" => $data,
    );
//output to json format
            echo json_encode($output);
 
    }
    

    public function create() {
       $training = $this->input->post('training');
       $dept = $this->input->post('dept');
       $this->Programmes_model->save_programme($training,$dept);
       echo json_encode(array("status" => TRUE));
    }
    public function programme_edit()
    {
        $training = $this->input->post('training');
        $value = array();
        $data = $this->Programmes_model->get_dept($training)->result();
        foreach($data as $result) {
            
            $value[] = (float) $result->dept;
        }
        echo json_encode($value);
        
    }

public function update() {
    $id = $this->input->post('training');
    $dept = $this->input->post('dept');
    $this->Programmes_model->update_programme($id,$dept);
    redirect('programmes/view');
}
}