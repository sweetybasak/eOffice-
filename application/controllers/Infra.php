<?php
    class Infra extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->database();
         
            $this->load->library('form_validation');
           
           $this->load->library('upload');
           $this->load->library('session');
           $this->load->model('Infra_model');
           $this->load->model('Infra_filter_model');
           $this->load->helper('url');
           $this->load->helper('form');
           $this->load->helper('file');
           $this->load->model('Dashboard_model','dashboard');
           
        }
        function filterinfra() {
            $dept = $this->Infra_filter_model->get_list_department();
        
     
            $opt = array('' => 'All department');
            foreach($dept as $d) {
                $opt[$d->id] = $d->dname;
            }
            $directorate = $this->Infra_model->get_list_directorate();
   

            $opt1 = array('' => 'All directorates');
            foreach($directorate as $d) {
                $opt1[$d->id] = $d->name;
            }
            $district = $this->Infra_model->get_list_district();


            $opt2 = array('' => 'All districts');
            foreach($district as $d) {
                $opt2[$d->id] = $d->name;
            }
            $spoffice = $this->Infra_model->get_list_spoffice();


            $opt3 = array('' => 'All SP Offices');
            foreach($spoffice as $d) {
                $opt3[$d->id] = $d->name;
            }
        
           
        
            $data['form_district'] = form_dropdown('',$opt2,'','id="district" class="form-control"');
        
     
           
            $data['form_directorate'] = form_dropdown('',$opt1,'','id="directorate" class="form-control"');
      
           
     
            $data['form_dept'] = form_dropdown('',$opt,'','id="dept" class="form-control"');
            $data['form_spoffice'] = form_dropdown('',$opt3,'','id="spoffice" class="form-control"');
      
     
            $this->load->view('infra/infra_filter',$data);
        }
     
        public function ajax_listinfra() {
        
     
            $list = $this->Infra_filter_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach($list as $cu) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $cu->deptname;
                $row[] = $cu->total_users;
                $row[] = $cu->users_system;
                $row[] = $cu->new_system;
                $row[] = $cu->dsc;
                $row[] = $cu->scanners;
                $row[] = $cu->printers;
                $row[] = $cu->dsc_required;
                $row[] = $cu->printer_required;
                $row[] = $cu->scanners_required;
                $row[] = $cu->system_required;
                $row[] = $cu->isp;
                $row[] = $cu->bandwidth;
                if($cu->cabling === 'yes') {
                 $row[] = '<button class = "btn btn-success">Yes</button>';
                }
                else {
                 $row[] = '<button class = "btn btn-danger">No</button>';
            
                }
                
     
                $data[] = $row;
            }
     
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Infra_filter_model->count_all(),
                "recordsFiltered" => $this->Infra_filter_model->count_filtered(),
                "data" => $data,
            );
            echo json_encode($output);
            exit();
        }
        
      

        public function dept23() {
            $this->load->view("infra/department1");
        }

        public function viewajax() {
            $draw = intval($this->input->get("draw"));
            $start = intval($this->input->get("start"));
            $length = intval($this->input->get("length"));

            $query = $this->db->get("infrasecretariat");
            $data = [];
            $i=1;
            foreach($query->result() as $r) {
                $data[] = array(
                    $i,
                    $r->deptname,
                    
                   $r->total_users,
                    $r->users_system, 
                   $r->new_system, 
                     $r->dsc, 
                    $r->scanners, 
                    $r->printers,
                    $r->dsc_required, 
                    $r->printer_required, 
                   $r->scanners_required, 
                   $r->system_required, 
                   $r->isp, 
                    $r->bandwidth, 
                    $r->cabling 
                );
                $i++;
            }
            $result = array(
                "draw" =>$draw,
                "recordsTotal" =>$query->num_rows(),
                "recordsFiltered" =>$query->num_rows(),
                "data" =>$data
            );
            echo json_encode($result);
            exit();
            
        }




   public function ajax_list_directorate() {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
       $list = $this->Infra_model->get_datatables_directorate();

       
       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->directoratename;
           $row[] = $cu->total_users;
           $row[] = $cu->users_system;
           $row[] = $cu->new_system;
           $row[] = $cu->dsc;
           $row[] = $cu->scanners;
           $row[] = $cu->printers;
           $row[] = $cu->dsc_required;
           $row[] = $cu->printer_required;
           $row[] = $cu->scanners_required;
           $row[] = $cu->system_required;
           $row[] = $cu->isp;
           $row[] = $cu->bandwidth;
           if($cu->cabling === 'yes') {
            $row[] = '<button class="btn btn-success">Yes</button>';
        }
       else {
        $row[] = '<button class = "btn btn-danger">No</button>';
   
       }

           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $this->Infra_model->count_all_directorate(),
           "recordsFiltered" => $this->Infra_model->count_filtered_directorate(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }

  
   public function ajax_list_spoffice() {
    
       $list = $this->Infra_model->get_datatables_spoffice();

       
       $data = array();
       $no = $_POST['start'];
       foreach($list as $cu) {
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $cu->districtname;
           $row[] = $cu->total_users;
           $row[] = $cu->users_system;
           $row[] = $cu->new_system;
           $row[] = $cu->dsc;
           $row[] = $cu->scanners;
           $row[] = $cu->printers;
           $row[] = $cu->dsc_required;
           $row[] = $cu->printer_required;
           $row[] = $cu->scanners_required;
           $row[] = $cu->system_required;
           $row[] = $cu->isp;
           $row[] = $cu->bandwidth;
           if($cu->cabling === 'yes') {
            $row[] = '<button class="btn btn-success">Yes</button>';
        }
       else {
        $row[] = '<button class = "btn btn-danger">No</button>';
   
       }

           $data[] = $row;
       }

       $output = array(
           "draw" => $_POST['draw'],
           "recordsTotal" => $this->Infra_model->count_all_spoffice(),
           "recordsFiltered" => $this->Infra_model->count_filtered_spoffice(),
           "data" => $data,
       );
       echo json_encode($output);
       exit();
   }



public function ajax_list_district() {
 $draw = intval($this->input->get("draw"));
 $start = intval($this->input->get("start"));
 $length = intval($this->input->get("length"));
    $list = $this->Infra_model->get_datatables_district();

    $data = array();
    $no = $_POST['start'];
    foreach($list as $cu) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $cu->districtname;
        $row[] = $cu->total_users;
        $row[] = $cu->users_system;
        $row[] = $cu->new_system;
        $row[] = $cu->dsc;
        $row[] = $cu->scanners;
        $row[] = $cu->printers;
        $row[] = $cu->dsc_required;
        $row[] = $cu->printer_required;
        $row[] = $cu->scanners_required;
        $row[] = $cu->system_required;
        $row[] = $cu->isp;
        $row[] = $cu->bandwidth;
        if($cu->cabling === 'yes') {
            $row[] = '<button class="btn btn-success">Yes</button>';
        }
       else {
        $row[] = '<button class = "btn btn-danger">No</button>';
   
       }

        $data[] = $row;
    }

    $output = array(
        "draw" => $draw,
        "recordsTotal" => $this->Infra_model->count_all_district(),
        "recordsFiltered" => $this->Infra_model->count_filtered_district(),
        "data" => $data,
    );
    echo json_encode($output);
    exit();
}

    public function infra() {
        $this->load->view('admin/infra/secretariat');
    }

    public function ajax_list_admin() {
        $draw = intval($this->input->get("draw"));
 $start = intval($this->input->get("start"));
 $length = intval($this->input->get("length"));
        $list = $this->Infra_model->get_datatables_secretariat();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $s) {
            $no++;
            $row = array();
            $row[] = $s->deptname;
            $row[] = $s->total_users;
            $row[] = $s->users_system;
            $row[] = $s->new_system;
            $row[] = $s->dsc;
            $row[] = $s->scanners;
            $row[] = $s->printers;
            $row[] = $s->dsc_required;
            $row[] = $s->printer_required;
            $row[] = $s->scanners_required;
            $row[] = $s->system_required;
            $row[] = $s->isp;
            $row[] = $s->bandwidth;
            if($s->cabling === 'yes') {
                $row[] = '<button class="btn btn-success">Yes</button>';
            }
           else {
            $row[] = '<button class = "btn btn-danger">No</button>';
       
           }
        
            $data[] = $row;

        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->Infra_model->count_all_secretariat(),
            "recordsFiltered" => $this->Infra_model->count_filtered_secretariat(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($deptname) {
        $data = $this->infra_model->get_by_deptname($deptname);
        echo json_encode($data);
    }

    public function ajax_delete($deptname) {
        $this->infra_model->delete_by_deptname($deptname);
        echo json_encode(array("status" => TRUE));
    }


 
    private $fields;
    private $separator = ';';
    private $enclosure = '"';

    private $max_row_size = 4096;

    function parse_csv($filepath) {
        if(!file_exists($filepath)){
            return FALSE;
        }
        $csvFile = fopen($filepath, 'r');
        $this->fields = fgetcsv($csvFile, $this->max_row_size, $this->separator,$this->enclosure);
        $key_values = explode(',', $this->fields[0]);
        $keys = $this->escape_string($key_values);

        $csvData = array();
        $i=1;
        while(($row = fgetcsv($csvFile, $this->max_row_size, $this->separator, $this->enclosure)) !== FALSE) {
            if($row != NULL) {
                $values = explode(',',$row[0]);
                if(count($keys) == count($values)) {
                    $arr = array();
                    $new_values = array();
                    $new_values = $this->escape_string($values);
                    for($j = 0; $j < count($keys); $j++) {
                        if($keys[$j] != "") {
                            $arr[$keys[$j]] = $new_values[$j];
                        }
                    }
                    $csvData[$i] = $arr;
                    $i++;
                }
            }
        }
        fclose($csvFile);
        return $csvData;
    }

    function escape_string($data) {
        $result = array();
        foreach($data as $row) {
            $result[] = str_replace('"','',$row);
        }
        return $result;
    }


  
    function filter() {
        $dept = $this->Infra_filter_model->get_list_department();
    
 
        $opt = array('0' => 'All department');
        foreach($dept as $d) {
            $opt[$d->id] = $d->dname;
        }
 
       
 
        $data['form_dept'] = form_dropdown('',$opt,'','id="dept" class="form-control"');
  
 
        $this->load->view('infra/infra_filter',$data);
    }
 
    public function ajax_list() {
     $draw = intval($this->input->get("draw"));
     $start = intval($this->input->get("start"));
     $length = intval($this->input->get("length"));
        $list = $this->Infra_model->get_datatables_dept();
 
        
 
        $data = array();
        $no = $_POST['start'];
        foreach($list as $cu) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $cu->deptname;
            $row[] = $cu->total_users;
            $row[] = $cu->users_system;
            $row[] = $cu->new_system;
            $row[] = $cu->dsc;
            $row[] = $cu->scanners;
            $row[] = $cu->printers;
            $row[] = $cu->dsc_required;
            $row[] = $cu->printer_required;
            $row[] = $cu->scanners_required;
            $row[] = $cu->system_required;
            $row[] = $cu->isp;
            $row[] = $cu->bandwidth;
            if($cu->cabling === 'yes') {
             $row[] = '<button class = "btn btn-success">Yes</button>';
            }
            else {
             $row[] = '<button class = "btn btn-danger">No</button>';
        
            }
            
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->Infra_model->count_all_dept(),
            "recordsFiltered" => $this->Infra_model->count_filtered_dept(),
            "data" => $data,
        );
        echo json_encode($output);
        exit();
    }



    
 }
    

            


              
    