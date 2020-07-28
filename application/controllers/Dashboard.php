<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->logged_in();
        $this->load->model('Dashboard_model','dashboard');
        $this->load->library('session');
        $this->load->database();
        $this->load->helper(array('url','html','form'));

    }



    private function logged_in(){
       
        if($this->session->userdata('logged_in') !== TRUE) {
            redirect('login');
        }
    }

    function index() {
        if($this->session->userdata('role')==='Super Admin') {
            
            $query = $this->db->query("select count(id) as count,to_char(starting,'Month') as month from trainings where to_char(starting,'Year') ='". date('Y') ."'
            group by to_char(starting,'Year'),to_char(starting,'Month')");
    
            $record = $query->result();
           
            $data['chart_data'] = json_encode($record);
          
            $this->load->view('admin/dashboard',$data);
        }
        else {
            redirect(base_url() . 'login');
        }

    }

    function admin() {

        if($this->session->userdata('role')==='Admin' && !empty($this->session->userdata('email'))) {

            $this->load->view('admin/dashboard');
        }
        else {
            redirect(base_url() . 'login');
        }
        
    
    }

    function emd() {
        if($this->session->userdata('role')==='EMD Managers') {
            $this->load->view('admin/dashboard');
        }
        else {
            redirect(base_url() . 'login');
        }
    }

    function deptusers() {
        if($this->session->userdata('role')==='Departmental Users') {
            $this->load->view('admin/dashboard1');
        }
        else {
            redirect(base_url() . 'login');
        }
    }

    function secretariat() {
        $this->load->view('admin/governance/addsecretariat'); 
    }

    function home() {
        $this->load->view('admin/dashboard');
    }
    function dept_home() {
        $this->load->view('admin/dashboard1');
    }
    

    function profile() {
        
        $email = $this->session->userdata('email');
        $where = ['email' => $email];
        $data['dept'] = $this->dashboard->getDepartmentUser($where);
        $data['directorate'] = $this->dashboard->getDirectorateUser($where);
        $data['district'] = $this->dashboard->getDistrictUser($where);
        $data['spoffice'] = $this->dashboard->getSPOfficeUser($where);
        if($this->session->userdata('feedback')){
            $data['feedback'] = $this->session->userdata('feedback');
            $this->session->unset_userdata('feedback');
        }
        if($this->session->userdata('feedback_error')){
            $data['feedback_error'] = $this->session->userdata('feedback_error');
            $this->session->unset_userdata('feedback_error');
        }
        $this->load->view('admin/profile',$data);
        }

        public function Reset_Password(){
            $email = $this->session->userdata('email');
            $onep = md5($this->input->post('new1'));
            $twop = md5($this->input->post('new2'));

            if($onep == $twop) {
                $data = array();
                $data = array(
                    'password' => $onep
                );
                $success = $this->dashboard->Reset_Password($email,$data);
                $this->session->set_flashdata('feedback', 'Successfully changed password');
            }
            else {
                $this->session->set_flashdata('feedback_error','Please enter valid password');
            }
            redirect('profile');

        }
        

    }
