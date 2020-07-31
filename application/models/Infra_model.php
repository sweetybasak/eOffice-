<?php

class Infra_model extends CI_Model {
    var $table = 'infradirectorate';
    var $column_order = array(null,'infradirectorate.directorate','total_users','users_system','new_system','dsc','scanners','printers','dsc_required','printer_required','scanners_required','system_required','isp','bandwidth','cabling');
    var $column_search = array('infradirectorate.directorate');
   var $order = array('infradirectorate.id' => 'asc');
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

  
        

    function depselect() {
        $query=$this->db->query("select * from infrasecretariat");
        return $query->result();
    }

    function getcabling() {
        $query= $this->db->query("select * from infrasecretariat");
        return $query->result();
    }

    function getdepartment() {
        $query = $this->db->query("select * from dept");
        return $query->result();
    }
   

    function getResult($deptname) {
        $result['b'] = $this->db->query("select * from infrasecretariat where deptname='$deptname' ");
        return $result['b']->result();
    }


    function getDept($deptname) {
        $query = $this->db->query("select * from infrasecretariat where deptname='$deptname' ");
        return $query->result();
    }

    function filter_type($type) {
        $this->db->distinct();
        $this->db->select($type);
        $this->db->from('infrasecretariat');
        return $this->db->get();
    }

    function getDetails($deptname, $cabling) {
        $query = $this->db->query("select * from infrasecretariat where deptname='$deptname' or cabling='$cabling' ");
        return $query->result();
    }

    function displayRecords() {
        $query = $this->db->query("select * from infrasecretariat");
        return $query->result();
    }

    

   
    private function _get_datatables_query_directorate()
    {
        if($this->input->post('directorate')) {
            $this->db->where('infradirectorate.directorate', $this->input->post('directorate'));
        }
        $this->db->select('directorate.name as directoratename,*');
        $this->db->from('infradirectorate');
        $this->db->join('directorate','directorate.id=infradirectorate.directorate');
        $this->db->where('infradirectorate.directorate is not null');
        $this->db->group_by(array("directorate.name","total_users","users_system","new_system","dsc","scanners","printers","dsc_required","printer_required","scanners_required","system_required","isp","bandwidth","cabling","infradirectorate.directorate","infradirectorate.id","directorate.id"));
        $i=0;
        foreach($this->column_search as $item) 
        {
            if(isset($_POST['value'])) {
                if($i==0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['value']);
                }
                else {
                    $this->db->or_like($item, $_POST['value']);
                }

                if(count($this->column_search) - 1 == $i)
                $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);

        }

        else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables_directorate() {
        $this->_get_datatables_query_directorate();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
   

    public function count_filtered_directorate() {
        $this->_get_datatables_query_directorate();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_directorate() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_list_directorate() {
        $this->db->select('id,name');
        $this->db->from('directorate');
        $this->db->order_by('name','asc');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();

       
    }
    public function get_list_spoffice() {
        $this->db->select('id,name');
        $this->db->from('spoffice');
        $this->db->order_by('name','asc');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();

       
    }
    

    

    

   
    var $column_order1 = array(null,'infradirectorate.district','total_users','users_system','new_system','dsc','scanners','printers','dsc_required','printer_required','scanners_required','system_required','isp','bandwidth','cabling');
    var $column_search1 = array('infradirectorate.district');
   
    private function _get_datatables_query_district()
    {
        if($this->input->post('district')) {
            $this->db->where('infradirectorate.district', $this->input->post('district'));
        }
       
        $this->db->select('district.name as districtname,*');
        $this->db->from('infradirectorate');
        $this->db->join('district','district.id=infradirectorate.district');
        $this->db->where('infradirectorate.district is not null');
        $this->db->group_by(array("district.name","total_users","users_system","new_system","dsc","scanners","printers","dsc_required","printer_required","scanners_required","system_required","isp","bandwidth","cabling","infradirectorate.district","infradirectorate.id","district.id"));
        $i=0;
        foreach($this->column_search1 as $item) 
        {
            if(isset($_POST['value'])) {
                if($i==0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['value']);
                }
                else {
                    $this->db->or_like($item, $_POST['value']);
                }

                if(count($this->column_search1) - 1 == $i)
                $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order1[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);

        }

        else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables_district() {
        $this->_get_datatables_query_district();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_district() {
        $this->_get_datatables_query_district();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_district() {
        $this->db->from('infradirectorate');
        return $this->db->count_all_results();
    }

    public function get_list_district() {


        $this->db->select('id,name');
        $this->db->from('district');
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        return $query->result();

       
    }

 var $column_order2 = array(null,'infrasecretariat.dept','total_users','users_system','new_system','dsc','scanners','printers','dsc_required','printer_required','scanners_required','system_required','isp','bandwidth','cabling');
 var $column_search2 = array('infrasecretariat.dept');
 
 private function _get_datatables_query_dept()
 {
     if($this->input->post('dept')) {
         $this->db->where('infrasecretariat.dept', $this->input->post('dept'));
     }
    
     $this->db->select('dept.dname as deptname,*');
     $this->db->from('infrasecretariat');
     $this->db->join('dept','dept.id=infrasecretariat.dept');
 
     $this->db->group_by(array("dept.dname","total_users","users_system","new_system","dsc","scanners","printers","dsc_required","printer_required","scanners_required","system_required","isp","bandwidth","cabling","infrasecretariat.dept","infrasecretariat.id","dept.id"));
     $i=0;
     foreach($this->column_search2 as $item) 
     {
         if(isset($_POST['value'])) {
             if($i==0)
             {
                 $this->db->group_start();
                 $this->db->like($item, $_POST['value']);
             }
             else {
                 $this->db->or_like($item, $_POST['value']);
             }

             if(count($this->column_search2) - 1 == $i)
             $this->db->group_end();
         }
         $i++;
     }

     if(isset($_POST['order'])) {
         $this->db->order_by($this->column_order2[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);

     }

     else if(isset($this->order)) {
         $order = $this->order;
         $this->db->order_by(key($order), $order[key($order)]);
     }
 }

 public function get_datatables_dept() {
     $this->_get_datatables_query_dept();
     if($_POST['length'] != -1)
     $this->db->limit($_POST['length'], $_POST['start']);
     $query = $this->db->get();
     return $query->result();
 }

 public function count_filtered_dept() {
     $this->_get_datatables_query_dept();
     $query = $this->db->get();
     return $query->num_rows();
 }

 public function count_all_dept() {
     $this->db->from('infrasecretariat');
     return $this->db->count_all_results();
 }

   

 var $column_order3 = array(null,'infradirectorate.spoffice','total_users','users_system','new_system','dsc','scanners','printers','dsc_required','printer_required','scanners_required','system_required','isp','bandwidth','cabling');
 var $column_search3 = array('infradirectorate.spoffice');

 private function _get_datatables_query_spoffice()
 {
     if($this->input->post('spoffice')) {
         $this->db->where('infradirectorate.spoffice', $this->input->post('spoffice'));
     }
    
     $this->db->select('spoffice.name as districtname,*');
     $this->db->from('infradirectorate');
     $this->db->join('spoffice','spoffice.id=infradirectorate.spoffice');
     $this->db->where('infradirectorate.spoffice is not null');
     $this->db->group_by(array("spoffice.name","total_users","users_system","new_system","dsc","scanners","printers","dsc_required","printer_required","scanners_required","system_required","isp","bandwidth","cabling","infradirectorate.spoffice","infradirectorate.id","spoffice.id"));
     $i=0;
     foreach($this->column_search3 as $item) 
     {
         if(isset($_POST['value'])) {
             if($i==0)
             {
                 $this->db->group_start();
                 $this->db->like($item, $_POST['value']);
             }
             else {
                 $this->db->or_like($item, $_POST['value']);
             }

             if(count($this->column_search3) - 1 == $i)
             $this->db->group_end();
         }
         $i++;
     }
     

     if(isset($_POST['order'])) {
         $this->db->order_by($this->column_order3[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);

     }

     else if(isset($this->order)) {
         $order = $this->order;
         $this->db->order_by(key($order), $order[key($order)]);
     }
 }

 public function get_datatables_spoffice() {
     $this->_get_datatables_query_spoffice();
     if($_POST['length'] != -1)
     $this->db->limit($_POST['length'], $_POST['start']);
     $query = $this->db->get();
     return $query->result();
 }

 public function count_filtered_spoffice() {
     $this->_get_datatables_query_district();
     $query = $this->db->get();
     return $query->num_rows();
 }

 public function count_all_spoffice() {
     $this->db->from('infradirectorate');
     return $this->db->count_all_results();
 }

}
?>
