<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Programmes_model extends CI_Model{

    public function getDepartment() {
        $query = $this->db->get('dept');
        return $query;
    }
    

    public function getAll() {
        $this->db->select("trainings.id as training,trainings.title as title,string_agg(dept.dname, ', ' order by dept.dname) as dname");
        $this->db->from('trainings');
        $this->db->join('depttrainings','depttrainings.trainingid=trainings.id','left');
        $this->db->join('dept','depttrainings.dname=dept.id','left');
        $this->db->group_by(array("trainings.title","trainings.id"));
       $query = $this->db->get();
       return $query->result();

    }

    public function save_programme($training,$dept) {
        $this->db->trans_start();
        $result = array();
        foreach($dept as $key => $val) 
        {
            $result[] = array(

                'trainingid' => $training,
                'dname' => $_POST['dept'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }

    function get_dept($training) {
       $this->db->select('dept.id as dept,dept.dname as depart,*');
       $this->db->from('dept');
       $this->db->join('depttrainings','depttrainings.dname=dept.id');
       $this->db->join('trainings','trainings.id=depttrainings.trainingid');
       $this->db->where('trainings.id',$training);
       $query = $this->db->get();
       return $query;
    }

    function update_programme($id,$dept) {
        $result = array();
            foreach($dept as $key => $val) {
                $result[] = array(
                'trainingid' => $id,
                'dname' => $_POST['dept'][$key]
            );
            }
        $this->db->insert_batch('depttrainings', $result);
    }
}