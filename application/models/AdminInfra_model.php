<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminInfra_model extends CI_Model {
    var $table = 'infrasecretariat';
   
    function getAll() {
        $this->db->select('dept.dname as deptname,*');
        $this->db->from('infradirectorate');
        $this->db->join('dept','dept.id=infradirectorate.dept');
        $query = $this->db->get();
        return $query->result();
    }
    function departmental($dept) {
        $this->db->select('dept.dname as deptname,*');
        $this->db->from('infradirectorate');
        $this->db->join('dept','dept.id=infradirectorate.dept');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    function directorate($dept) {
        $this->db->select('directorate.name as deptname,*');
        $this->db->from('infradirectorate');
        $this->db->join('directorate','directorate.id=infradirectorate.directorate');
        $this->db->where('directorate',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    function district($dept) {
        $this->db->select('district.name as deptname,*');
        $this->db->from('infradirectorate');
        $this->db->join('district','district.id=infradirectorate.district');
        $this->db->where('district',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    function spoffice($dept) {
        $this->db->select('spoffice.name as deptname,*');
        $this->db->from('infradirectorate');
        $this->db->join('spoffice','spoffice.id=infradirectorate.spoffice');
        $this->db->where('spoffice',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    function getAllinfra($dept) {
        $this->db->select('dept.dname as deptname,*');
        $this->db->from('infradirectorate');
        $this->db->join('dept','dept.id=infradirectorate.dept');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    function getAll_district() {
      $this->db->select('district.name as districtname,district.id as id,*');
      $this->db->from('infradirectorate');
      $this->db->join('district','district.id=infradirectorate.district');
      $query = $this->db->get();
      return $query->result();
    }
    function getAll_spoffice() {
        $this->db->select('spoffice.name as districtname,spoffice.id as id,*');
        $this->db->from('infradirectorate');
        $this->db->join('spoffice','spoffice.id=infradirectorate.spoffice');
        $query = $this->db->get();
        return $query->result();
      }
  

    function getAll_directorate() {
        $this->db->select('directorate.name as direct,directorate.id as id,*');
        $this->db->from('infradirectorate');
        $this->db->join('directorate','directorate.id=infradirectorate.directorate');
        $query = $this->db->get();
        return $query->result();
      }
      function getAll_directoratedepartmental($directorate) {
        $this->db->select('directorate.name as direct,directorate.id as id,*');
        $this->db->from('infrasecretariat');
        $this->db->join('directorate','directorate.id=infrasecretariat.directorate');
        $this->db->where('directorate',$directorate);
        $query = $this->db->get();
        return $query->result();
      }
      function getAll_directoratedept($dept) {
        $this->db->select('directorate.name as direct,directorate.id as id,*');
        $this->db->from('infrasecretariat');
        $this->db->join('directorate','directorate.id=infrasecretariat.directorate');
        $this->db->join('dept','dept.id=directorate.dept');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query->result();
      }
  
  
    function count_filtered()
    {
        
        $query = $this->db->query("select dept.dname,* from infradirectorate,dept where dept.id=infradirectorate.dept");
        return $query->num_rows();
    }
 
    
    public function getDepartment() {
        $query = $this->db->query('select * from dept');
        return $query->result();
    }


    public function getDistrict() {
        $query = $this->db->query("select id,name  from district");
        return $query->result();
    }
    
    public function getSPOffice() {
        $query = $this->db->query("select id,name  from spoffice");
        return $query->result();
    }
    public function getDirectorate() {
        $query = $this->db->query("select id,name from directorate where name is not null");
        return $query->result();
    }
    public function getDirectorate_dept($dept) {
        $this->db->select('id,name');
        $this->db->from('directorate');
        $this->db->where('dept',$dept);
        $query = $this->db->get();

        return $query->result();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
   
 
    
    
 
    public function delete_by_id($dept)
    {
        $this->db->where('dept', $dept);
        $this->db->delete($this->table2);
    }
     
    


    var $table2 = 'infradirectorate';
    
    function count_filtered_directorate()
    {
        $query = $this->db->query("select directorate.name,* from infrasecretariat,directorate where directorate.id=infrasecretariat.directorate");
        return $query->num_rows();
    }
 
    public function count_all_directorate()
    {
        $this->db->from($this->table2);
        return $this->db->count_all_results();
    }
 
    public function get_by_id_directorate($id)
    {
        $this->db->from($this->table2);
        $this->db->where('directorate',$directorate);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_directorate($data)
    {
        $this->db->insert($this->table2, $data);
        return $this->db->insert_id();
    }
 
    public function update_directorate($where, $data)
    {
        $this->db->update($this->table2, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_directorate($directorate)
    {
        $this->db->where('directorate', $directorate);
        $this->db->delete($this->table2);
    }
         


    var $table1 = 'infradistrict';
    
 
    function count_filtered_district()
    {
        $query = $this->db->query("select district.name,* from infradistrict,district where district.id=infradistrict.district");
        return $query->num_rows();
    }
 
    public function count_all_district()
    {
        $this->db->from($this->table1);
        return $this->db->count_all_results();
    }
 
    public function get_by_id_district($district)
    {
        $this->db->from($this->table1);
        $this->db->where('district',$district);
        $query = $this->db->get();
 
        return $query->row();
    }

 
    public function delete_by_id_district($district)
    {
        $this->db->where('district', $district);
        $this->db->delete($this->table1);
    }
         
    public function add($row)
    {
        $this->db->insert('infrasecretariat',$row);
        return $this->db->insert_id();
    }

    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('infradirectorate');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("dept", $params)){
                $this->db->where('dept', $params['dept']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('dept', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('infradirectorate', $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update1($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
           
            
            // Update member data
            $update = $this->db->update('infradirectorate', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }


    
    function getRows1($params = array()){
        $this->db->select('*');
        $this->db->from('infradirectorate');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("district", $params)){
                $this->db->where('district', $params['district']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('district', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert1($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('infrasecretariat', $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update2($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
           
            
            // Update member data
            $update = $this->db->update('infrasecretariat', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

     
    function getRows2($params = array()){
        $this->db->select('*');
        $this->db->from('infradirectorate');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("directorate", $params)){
                $this->db->where('directorate', $params['directorate']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('directorate', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert2($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('infradirectorate', $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update3($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
           
            
            // Update member data
            $update = $this->db->update('infradirectorate', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    function getRows6($params = array()){
        $this->db->select('*');
        $this->db->from('infradirectorate');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("spoffice", $params)){
                $this->db->where('spoffice', $params['spoffice']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('spoffice', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }

                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert5($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('infradirectorate', $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update5($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
           
            
            // Update member data
            $update = $this->db->update('infradirectorate', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }




}