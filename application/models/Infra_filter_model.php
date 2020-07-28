<?php

class Infra_filter_model extends CI_Model {
   
    var $column_order = array(null,'infrasecretariat.dept','total_users','users_system','new_system,dsc','scanners','printers','dsc_required','printer_required','scanners_required','system_required','isp','bandwidth','cabling');
    var $column_search = array('infradirectorate.dept');
   

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    private function _get_datatables_query()
    {
        if($this->input->post('dept')) {
            $this->db->where('infradirectorate.dept', $this->input->post('dept'));
        }
       
        $this->db->select('dept.dname as deptname,total_users,users_system,new_system,dsc,scanners,printers,dsc_required,printer_required,scanners_required,system_required,isp,bandwidth,cabling');
        $this->db->from('infradirectorate');
        $this->db->join('dept','dept.id=infradirectorate.dept','left');
        $this->db->where('infradirectorate.dept is not null');
        $this->db->group_by(array("dept.dname","total_users","users_system","new_system","dsc","scanners","printers","dsc_required","printer_required","scanners_required","system_required","isp","bandwidth","cabling"));
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

    public function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from('infradirectorate');
        return $this->db->count_all_results();
    }

    public function get_list_department() {
        $this->db->select('id,dname');
        $this->db->from('dept');
        $this->db->order_by('dname','asc');
        $query = $this->db->get();
        return $query->result();

       
    }

    public function get_list_cabling() {
        $this->db->select('cabling');
        $this->db->from($this->table);
        $this->db->order_by('cabling','asc');
        $query = $this->db->get();
        $result = $query->result();
        
        $cabling = array();
        foreach($result as $row) {
            $cabling[] = $row->cabling;
        }
        return $cabling;
    }
}
?>