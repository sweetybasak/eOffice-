<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');


class Training_filter extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Training_filter_model');
        $this->load->library('pagination');
        $this->load->model('Dashboard_model','dashboard');
    }


    public function filter() {

        $dept= $this->Training_filter_model->getDepartment();
        $course = $this->Training_filter_model->getCourse();
        $venue = $this->Training_filter_model->getVenue();

        $opt = array('0' => 'All Department');
        foreach($dept as $d) {
            $opt[$d->id] = $d->dname;
        }

        $opt1 = array('0' => 'All Courses');
        foreach($course as $c) {
            $opt1[$c->id] = $c->name;
        }
        $opt2 = array('0' => 'All Venue');
        foreach($venue as $v) {
            $opt2[$v->id] = $v->name;
        }

        $data['form_dept'] = form_dropdown('',$opt,'','id="dname" class="form-control"');
        $data['form_course'] = form_dropdown('',$opt1,'','id="course" class="form-control"');
        $data['form_venue'] = form_dropdown('',$opt2,'','id="venue" class="form-control"');
        
        $this->load->view('trainings/training_filter',$data);
    }

    
    
    public function ajax_list() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
           $list = $this->Training_filter_model->get_datatables();
    
           $data = array();
           $no = $start;
        
           foreach($list as $cu) {
              
               $no++;
               $row = array();
               $row[] = $no;
               $row[] = $cu->title;
               $row[] = $cu->course;
               $row[] = $cu->venue;
               $row[] = $cu->date;
               $row[] = $cu->users;
               if($cu->files)
               $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$cu->files).'" target="_blank"><i class="fa fa-file-pdf-o fa-lg"></i></a>'; 
               else 
               $row[] = '(No file)';     
             
             
               $data[] = $row;
           }
    
           $output = array(
               "draw" => $draw,
               "recordsTotal" => $this->Training_filter_model->count_all(),
               "recordsFiltered" => $this->Training_filter_model->count_filtered(),
               "data" => $data,
           );
           echo json_encode($output);
           exit();
       }


       public function participants() {

        $dept= $this->Training_filter_model->getDepartment();
        $course = $this->Training_filter_model->getCourse();
        $venue = $this->Training_filter_model->getVenue();
        $directorate = $this->Training_filter_model->getDirectorate();
        $district = $this->Training_filter_model->getDistrict();
        $spoffice = $this->Training_filter_model->getSPOffice();
        $type = $this->Training_filter_model->getTrainingType();
        $type1 = $this->Training_filter_model->getParticipantType();
        
        
        
        

        $opt = array('' => 'All Department');
        foreach($dept as $d) {
            $opt[$d->id] = $d->dname;
        }

        $opt1 = array('' => 'All Courses');
        foreach($course as $c) {
            $opt1[$c->id] = $c->name;
        }
        $opt2 = array('' => 'All Venue');
        foreach($venue as $v) {
            $opt2[$v->id] = $v->name;
        }
        $opt3 = array('' => 'All Directorate');
        foreach($directorate as $v) {
            $opt3[$v->id] = $v->name;
        }
        $opt4 = array('' => 'All District');
        foreach($district as $v) {
            $opt4[$v->id] = $v->name;
        }
        $opt5 = array('' => 'All SP Offices');
        foreach($spoffice as $v) {
            $opt5[$v->id] = $v->name;
        }
        $opt6 = array('' => 'All Training Type');
        foreach($type as $v) {
            $opt6[$v->name] = $v->name;
        }
        
        $opt7 = array('' => 'All Participant Type');
        foreach($type1 as $v) {
            $opt7[$v->name] = $v->name;
        }

        $data['form_dept'] = form_dropdown('',$opt,'','id="dname" class="form-control"');
        $data['form_course'] = form_dropdown('',$opt1,'','id="course" class="form-control"');
        $data['form_venue'] = form_dropdown('',$opt2,'','id="venue" class="form-control"');
        $data['form_directorate'] = form_dropdown('',$opt3,'','id="directorate" class="form-control"');
        $data['form_district'] = form_dropdown('',$opt4,'','id="district" class="form-control"');
        $data['form_spoffice'] = form_dropdown('',$opt5,'','id="spoffice" class="form-control"');
        $data['form_trainingtype'] = form_dropdown('',$opt6,'','id="trainingtype" class="form-control"');
        $data['form_participantype'] = form_dropdown('',$opt7,'','id="participanttype" class="form-control"');
       
           $this->load->view('trainings/participants1',$data);
           
       }
       public function upcoming() {

        $dept= $this->Training_filter_model->getDepartment();
        $course = $this->Training_filter_model->getCourse();
        $venue = $this->Training_filter_model->getVenue();
        $directorate = $this->Training_filter_model->getDirectorate();
        $district = $this->Training_filter_model->getDistrict();
        $spoffice = $this->Training_filter_model->getSPOffice();
        $type = $this->Training_filter_model->getTrainingType();
        $type1 = $this->Training_filter_model->getParticipantType();
        
        
        
        

        $opt = array('' => 'All Department');
        foreach($dept as $d) {
            $opt[$d->id] = $d->dname;
        }

        $opt1 = array('' => 'All Courses');
        foreach($course as $c) {
            $opt1[$c->id] = $c->name;
        }
        $opt2 = array('' => 'All Venue');
        foreach($venue as $v) {
            $opt2[$v->id] = $v->name;
        }
        $opt3 = array('' => 'All Directorate');
        foreach($directorate as $v) {
            $opt3[$v->id] = $v->name;
        }
        $opt4 = array('' => 'All District');
        foreach($district as $v) {
            $opt4[$v->id] = $v->name;
        }
        $opt5 = array('' => 'All SP Offices');
        foreach($spoffice as $v) {
            $opt5[$v->id] = $v->name;
        }
        $opt6 = array('' => 'All Training Type');
        foreach($type as $v) {
            $opt6[$v->name] = $v->name;
        }
        $opt7 = array('' => 'All Participant Type');
        foreach($type1 as $v) {
            $opt7[$v->name] = $v->name;
        }

        $data['form_dept'] = form_dropdown('',$opt,'','id="dname" class="form-control"');
        $data['form_course'] = form_dropdown('',$opt1,'','id="course" class="form-control"');
        $data['form_venue'] = form_dropdown('',$opt2,'','id="venue" class="form-control"');
        $data['form_directorate'] = form_dropdown('',$opt3,'','id="directorate" class="form-control"');
        $data['form_district'] = form_dropdown('',$opt4,'','id="district" class="form-control"');
        $data['form_spoffice'] = form_dropdown('',$opt5,'','id="spoffice" class="form-control"');
        $data['form_trainingtype'] = form_dropdown('',$opt6,'','id="trainingtype" class="form-control"');
        $data['form_participantype'] = form_dropdown('',$opt7,'','id="participanttype" class="form-control"');
       
           $this->load->view('trainings/upcoming',$data);
           
       }

       public function ajax_list1() {
      
           $list = $this->Training_filter_model->get_datatables();
    
           $data = array();
           
           $no = $_POST['start'];
        
           foreach($list as $cu) {
              
               $no++;
               $row = array();
               $row[] = $no;
               $row[] = $cu->title;
               $row[] = $cu->course; 
               $row[] = $cu->venue;
               $row[] = $cu->trainingtype;
               $row[] = $cu->date.' to '.$cu->end;
               $row[] = '<button type="button" data-toggle="modal" data-target="#departmentModal" name="department"  onclick="javascript:load_department('.$cu->id.');" class="btn btn-warning department">View Departments</button>';
               $row[] = '<button type="button" data-toggle="modal" data-target="#directorateModal" name="directorate"  onclick="javascript:load_directorate('.$cu->id.');" class="btn btn-primary directorate">View Directorates</button>';  
               $row[] = '<button type="button" data-toggle="modal" data-target="#districtModal" name="district"  onclick="javascript:load_district('.$cu->id.');" class="btn btn-warning district">View Districts</button>';
               $row[] = '<button type="button" data-toggle="modal" data-target="#spofficeModal" name="spoffice"  onclick="javascript:load_spoffice('.$cu->id.');" class="btn btn-primary spoffice">View SP Offices</button>';
               
              
               
               $row[] = $cu->users;

               
              // $row[] = '<button type="button" data-toggle="modal" data-target="#userModal" name="update"  onclick="javascript:load_marks('.$cu->id.');" class="btn btn-warning update">View Participants</button>';
               if($cu->files)
               $row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('./uploads/'.$cu->files).'" target="_blank"><i class="fa fa-file-pdf-o fa-lg"></i></a>'; 
               else 
               $row[] = '(No file)';    
               $data[] = $row;
           }
    
           $output = array(
               "draw" => $_POST['draw'],
               "recordsTotal" => $this->Training_filter_model->count_all(),
               "recordsFiltered" => $this->Training_filter_model->count_filtered(),
               "data" => $data,
           );
           echo json_encode($output);
           exit();
       }

       public function part() {
           $id = $_POST['id'];
           $data['part'] = $this->Training_filter_model->parti($id);
           $this->load->view("trainings/modal",$data);
       }
       public function part_department() {
        $id = $_POST['id'];
        $data['part'] = $this->Training_filter_model->department($id);
        $this->load->view("trainings/modal1",$data);
    }
    public function part_directorate() {
        $id = $_POST['id'];
        $data['part'] = $this->Training_filter_model->directorate($id);
        $this->load->view("trainings/modal2",$data);
    }
    public function part_district() {
        $id = $_POST['id'];
        $data['part'] = $this->Training_filter_model->district($id);
        $this->load->view("trainings/modal3",$data);
    }
    public function part_spoffice() {
        $id = $_POST['id'];
        $data['part'] = $this->Training_filter_model->spoffice($id);
        $this->load->view("trainings/modal4",$data);
    }
    public function participants_dept() {
        $id = $_POST['id'];
        $dept = $_POST['dept'];
        $data['part'] = $this->Training_filter_model->participantsd($id,$dept);
        $this->load->view("trainings/participantsd",$data);
    }
    public function participants_directorate() {
        $id = $_POST['id'];
        $dept = $_POST['dept'];
        $data['part'] = $this->Training_filter_model->participantsdi($id,$dept);
        $this->load->view("trainings/participantsd",$data);
    }

    public function participants_district() {
        $id = $_POST['id'];
        $dept = $_POST['dept'];
        $data['part'] = $this->Training_filter_model->participantsdistrict($id,$dept);
        $this->load->view("trainings/participantsd",$data);
    }
    public function participants_spoffice() {
        $id = $_POST['id'];
        $dept = $_POST['dept'];
        $data['part'] = $this->Training_filter_model->participantsspoffice($id,$dept);
        $this->load->view("trainings/participantsd",$data);
    }

       public function fetch_details() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $id = $this->input->post('id');
         
          $data= $this->Training_filter_model->fetch_participant($id);
          
          $output = array();
          $no =$start;
          foreach($data as $r) {
            $no++;
            $row=array();
            $row[] = $no;
            $row[] = $r->name;
            $row[] = $r->deptname;
            $row[] = $r->email;
            $row[] = $r->phone;
            $output[]=$row;

          }

          $d=array(
              "draw" => $draw,
              "recordsTotal" => $this->Training_filter_model->count_all(),
             
              "data" => $output
          );
          echo json_encode($d);
          exit();
       }


       public function fetch_details_department() {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $id = $this->input->post('id');
         
          $data= $this->Training_filter_model->fetch_department($id);
          
          $output = array();
          $no =$start;
          foreach($data as $r) {
            $no++;
            $row=array();
            $row[] = $no;
           
            $row[] = $r->deptname;
           
            $output[]=$row;

          }

          $d=array(
              "draw" => $draw,
              "recordsTotal" => $this->Training_filter_model->count_all(),
             
              "data" => $output
          );
          echo json_encode($d);
          exit();
       }

       }





?>