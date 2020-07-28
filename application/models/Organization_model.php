<?php 
    class Organization_model extends CI_Model {

        
        public function getTotalList_of_dept() {
          
            $query = $this->db->query("select dept.dname,string_agg(n_name, ',  ' order by n_name) as n_name,string_agg(e_name,',  ' order by e_name) as e_name,string_agg(m_name, ',  ' order by m_name) as m_name,dept.id as id from dept join secretariat on dept.id=secretariat.dept where secretariat.directorate=0 group by dept.dname,dept.id");
            $res = $query->result();
            return $res;
        }

        public function getTotalList_of_sections($dept) {
           

           $query = $this->db->query("select distinct(directorate.name) as section, string_agg(n_name,  ', ' order by n_name) as n_name,string_agg(e_name,  ', ' order by e_name) as e_name,string_agg(m_name,  ', ' order by m_name) as m_name,directorate.id as id from  secretariat, directorate where  secretariat.dept='$dept'and directorate.id=secretariat.directorate and secretariat.directorate!=0 group by directorate.name,directorate.id");

            $res = $query->result();
            return $res;
        }

       public function getAll_directorates() {
           $this->db->select('dept.dname as deptname,directorate.id as did,*');
           $this->db->from('directorate');
           $this->db->join('dept','dept.id=directorate.dept');
           $query = $this->db->get();
           return $query->result();
       }

       public function getDepartment() {
           $query = $this->db->query("select * from dept");
           return $query->result();
       }

       public function count_all_directorate() {
           $query = $this->db->from('directorate');
               return $this->db->count_all_results();
           }
        public function count_filtered_directorate()
           {
               
               $query = $this->db->query("select dept.dname,directorate.id as did,* from directorate,dept where dept.id=directorate.dept");
               return $query->num_rows();
           }

           public function save_directorate($data)
    {
        $this->db->insert('directorate', $data);
        return $this->db->insert_id();
    }

    public function update_directorate($where, $data)
    {
        $this->db->update('directorate', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_directorate($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('directorate');
    }
 
    public function get_by_id_directorate($id)
    {
        $this->db->select('*');
        $this->db->from('directorate');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function getAll() {
        $query = $this->db->query("select directorate.name as dname,string_agg(n_name, ',  ' order by n_name) as n_name,string_agg(e_name,',  ' order by e_name) as e_name,string_agg(m_name, ',  ' order by m_name) as m_name,directorate.id as id from directorate join secretariat on directorate.id=secretariat.directorate where secretariat.directorate!=0 group by directorate.name,directorate.id");
        $res = $query->result();
        return $res;
    }

    
    public function getAll_districts() {
        $query = $this->db->query("select district.name as districts,string_agg(n_name, ',  ' order by n_name) as n_name,string_agg(e_name,',  ' order by e_name) as e_name,string_agg(m_name, ',  ' order by m_name) as m_name,district.id as id from district join nodaldistrict on district.id=nodaldistrict.district group by district.name,district.id");
        $res = $query->result();
        return $res;
    }

    function checkDirectorate($name,$dept) {
        $this->db->where('name',$name);
        $this->db->where('dept', $dept);
         
       
        $result = $this->db->get('directorate');
        return $result;
    }

    public function parti($id) {
           

        $query=$this->db->query("SELECT phone,email,designation FROM secretariat
                                 
                                 WHERE secretariat.id = $id");
        return $query->result_array();
    

}

public function nodal($id) {
           

    $query=$this->db->query("SELECT secretariat.dept, n_name,email,phone,designation
                             FROM secretariat 
                            
                         
                             WHERE secretariat.dept = $id and secretariat.directorate=0 and e_name is null and m_name is null");
    return $query->result_array();



}
public function master($id) {
           

    $query=$this->db->query("SELECT secretariat.dept, m_name,email,phone,designation
                             FROM secretariat 
                            
                         
                             WHERE secretariat.dept = $id and secretariat.directorate=0 and e_name is null and n_name is null");
    return $query->result_array();



}
public function emd($id) {
           

    $query=$this->db->query("SELECT secretariat.dept, e_name,email,phone,designation
                             FROM secretariat 
                            
                         
                             WHERE secretariat.dept = $id and secretariat.directorate=0 and n_name is null and m_name is null");
    return $query->result_array();



}
public function nodal1($id) {
           

    $query=$this->db->query("SELECT secretariat.directorate, n_name,email,phone,designation
                             FROM secretariat 
                            
                         
                             WHERE secretariat.directorate = $id and e_name is null and m_name is null");
    return $query->result_array();



}
public function master1($id) {
           

    $query=$this->db->query("SELECT secretariat.directorate, m_name,email,phone,designation
                             FROM secretariat 
                            
                         
                             WHERE secretariat.directorate = $id and e_name is null and n_name is null");
    return $query->result_array();



}
public function emd1($id) {
           

    $query=$this->db->query("SELECT secretariat.directorate, e_name,email,phone,designation
                             FROM secretariat 
                            
                         
                             WHERE secretariat.directorate = $id  and n_name is null and m_name is null");
    return $query->result_array();



}
public function nodal2($id) {
           

    $query=$this->db->query("SELECT nodaldistrict.district, n_name,email,phone,designation
                             FROM nodaldistrict 
                            
                         
                             WHERE nodaldistrict.district = $id and e_name is null and m_name is null");
    return $query->result_array();



}
public function master2($id) {
           

    $query=$this->db->query("SELECT nodaldistrict.district, m_name,email,phone,designation
                             FROM nodaldistrict 
                            
                         
                             WHERE nodaldistrict.district = $id and e_name is null and n_name is null");
    return $query->result_array();



}
public function emd2($id) {
           

    $query=$this->db->query("SELECT nodaldistrict.district, e_name,email,phone,designation
                             FROM nodaldistrict 
                            
                         
                             WHERE nodaldistrict.district = $id  and n_name is null and m_name is null");
    return $query->result_array();



}



    }
?>