<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->model('Dashboard_model');
        $this->load->helper('url');
        $this->load->helper('string');

        $this->load->library('email');
      
        
      
        
        
    }

    public function login() {
            $this->load->view('login');
        
    }


    public function login_auth() {
        $email = $this->input->post('email',TRUE);
        $password = md5($this->input->post('password',TRUE));
        $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required');
        $this->form_validation->set_rules('password','Password', 'trim|xss_clean|required');
           if($this->form_validation->run() == FALSE) {
            
                
                echo $this->session->set_flashdata('msg','Username or Password is Wrong');
                redirect(base_url() . 'login');
        
        }
        else{
        $validate = $this->Login_model->validate($email,$password);

        if($validate->num_rows() > 0) {
            $data = $validate->row_array();
            $name = $data['name'];
            $emal = $data['email'];
            $role = $data['role'];
            $password = md5($data['password']);
            $phone = $data['phone'];
            $dept = $data['dept'];
            $directorate = $data['directorate'];
            $id = $data['id'];
            $status = $data['status'];
            $designation = $data['designation'];
            $district = $data['district'];
            $spoffice = $data['spoffice'];
            $officetype = $data['office'];

           
            if(($role === 'Super Admin') && $emal == $email) {
                $sesdata = array(
                    'username' => $name,
                    'email' => $email,
                    'role' => $role,
                    'logged_in' => TRUE,
                    'session_id' => session_id(),
                    'password' => $password,
                    'phone' => $phone,
                    'dept' => $dept,
                    'directorate' => $directorate,
                    'district' => $district,
                    'spoffice' => $spoffice,
                    'officetype' => $officetype,
                    'id' => $id,
                    'status' => $status,
                    'designation' => $designation  
                );
                $this->session->set_userdata($sesdata);
             
    
                redirect(base_url() . 'dashboard');
            }
            else if(($role === 'Admin')&& $emal == $email) {
                $sesdata = array(
                    'username' => $name,
                    'email' => $email,
                    'role' => $role,
                    'logged_in' => TRUE,
                    'password' => $password,
                    'phone' => $phone,
                    'dept' => $dept,
                    'directorate' => $directorate,
                    'district' => $district,
                    'spoffice' => $spoffice,
                    'officetype' => $officetype,
                    'id' => $id,
                    'status' => $status,
                    'designation' => $designation
                );
                $this->session->set_userdata($sesdata);
                $sessionId = session_id();
                $this->Login_model->setSession($email,$sessionId);
    
               redirect(base_url() . 'admin');

            }
            else if($role === 'EMD Managers') {
                $sesdata = array(
                    'username' => $name,
                    'email' => $email,
                    'role' => $role,
                    'logged_in' => TRUE,
                    'session_id' => session_id(),
                    'password' => $password,
                    'phone' => $phone,
                    'dept' => $dept,
                    'directorate' => $directorate,
                    'district' => $district,
                    'spoffice' => $spoffice,
                    'officetype' => $officetype,
                    'id' => $id,
                    'status' => $status,
                    'designation' => $designation
                    
                );

                $this->session->set_userdata($sesdata);
                
                $sessionId = session_id();
                $this->Login_model->setSession($email,$sessionId);
    
                redirect(base_url() . 'dashboard/emd');
            }
            
            else if($role === 'Departmental Users') {
                $sesdata = array(
                    'username' => $name,
                    'email' => $email,
                    'role' => $role,
                    'logged_in' => TRUE,
                    'session_id' => session_id(),
                    'password' => $password,
                    'phone' => $phone,
                    'dept' => $dept,
                    'directorate' => $directorate,
                    'id' => $id,
                    'status' => $status,
                    'designation' => $designation
                    
                );
                $this->session->set_userdata($sesdata);
                $sessionId = session_id();
                $this->Login_model->setSession($email,$sessionId);
    
                redirect(base_url() . 'dashboard/deptusers');
            }
        }else {
            echo $this->session->set_flashdata('msg','Username or Password is Wrong');
            redirect(base_url() . 'login');
        }
    }
}
    public function logout() {

        $this->session->set_userdata('logged_in',FALSE);
        $email = $this->session->userdata('email');
       $this->Login_model->unsetSession($email);
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
    }

    
    public function forgotten_page() {
        $data = array();
      
        $this->load->view('backend/forgotpassword',$data);

    }

    public function forgot() {
        
      
        $this->load->view('backend/forgotpassword');

    }

    public function forgot_password() {
        $email = $this->input->post('email');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|callback_email_check');
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('backend/forgotpassword');
        }
        else
        {
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
           $this->email->subject('Get your forgotten Password');
           $this->email->message('Please go to this link to get your password. http://localhost/eoffice/login/recover/'.$rs);
           if($this->email->send()) {
            echo $this->session->set_flashdata('msg','Please check your email');
            redirect(base_url(). 'login/forgot');
           }

           else {
            echo $this->session->set_flashdata('errormsg','Email Could not be send');
           }
                
            }
        }


        public function email_check($str) {
            $query = $this->db->get_where('employee',array('email' => $str), 1);
            if($query->num_rows() == 1) {
                return true;
            }
            else {
                $this->form_validation->set_message('email_check', 'This Email does not exist. ');
                return false;
            }
        }


        public function recover($rs=FALSE) {
            $this->form_validation->set_rules('password','trim|required|min_length[7]|max_length[20]|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation','trim|required');
            if($this->form_validation->run() == FALSE) {
                echo form_open();
                $this->load->view('gp_form');
            }
            else {
                $query = $this->db->query("select * from employee where rs='$rs' limit 1");
                if($query->num_rows() == 0) 
                {
                    show_error('Sorry!! Invalid Request!');
                }
                else {
                    $data = array(
                        'password' => md5($this->input->post('password')),
                        'rs' => ''
                    );

                    $where = $this->db->where('rs', $rs);
                    $where->update('employee',$data);
                    $this->session->set_flashdata('success','Password Changed');
                    redirect(base_url(). 'login');
                }
            }
        }


        private function  _create_captcha() {
              $this->load->helper('captcha');
              $captcha = random_string('alnum',3);
            $options = array('word'=>$captcha,'img_path'=>FCPATH.'captcha/','img_url'=>site_url().'captcha/','img_width'=>'150','img_height'=>'40','expiration'=>7200,    'font_size' => '16');
        
            $cap = create_captcha($options);
            $image = $cap['image'];
            $this->session->set_userdata('captchaword',$cap['word']);
            return $image;
            
        }
        public function check_captcha($string) {
            if($string==$this->session->userdata('captchaword')) {
                return TRUE;
            }
            else {
                $this->form_validation->set_message('check_captcha', 'Wrong captcha code');
                return FALSE;
            }

        }

       
    
}
