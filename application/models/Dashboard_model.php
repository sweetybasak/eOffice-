<?php

class Dashboard_model extends CI_Model {
    var $table = "secretariat";
    var $select_column = array("dname","n_name","m_name","e_name");
    var $order_column = array(null,"n_name","m_name","e_name");

   

    function make_query() {
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("n_name",$_POST["search"]["value"]);
            $this->db->or_like("m_name",$_POST["search"]["value"]);
            $this->db->or_like("e_name",$_POST["e_name"]["value"]);
        }
        if(isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

        }
        else {
            $this->db->order_by('dname','DESC');
        }

    }

    function make_datatables() {
        $this->make_query();
        if($_POST["length"] != -1) {
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data() {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data() {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function insert_secretariat($data) {
        $this->db->insert('secretariat', $data);

    }

    function fetch_single_secretariat($dname) {
        $this->db->where("dname", $dname);
        $query = $this->db->get('secretariat');
        return $query->result();
    }

    function update_secretariat($dname,$data) {
        $this->db->where("dname",$dname);
        $this->db->update("secretariat",$data);
    }

    function delete_single_secretariat($dname) {
        $this->db->where("dname",$dname);
        $this->db->delete("secretariat");
    }
    function getAll(){
        $this->db->select('dept.dname as dname,n_name,designation,secretariat.id as id,directorate.name as directorate,email,phone ');
        $this->db->from('secretariat');
        $this->db->join('dept','dept.id=secretariat.dept');
        $this->db->join('directorate','directorate.id=secretariat.directorate');
        $this->db->where('n_name is not null');
        $this->db->group_by(array("dept.dname","n_name","secretariat.id","directorate.name"));
        $query = $this->db->get();
        return $query->result();
    }

    function getSecretariat()
    {
        $query = $this->db->query("select name from designation");
        return $query->result();
    }
    function count_filtered_secretariat()
{
    
        $query = $this->db->get('secretariat');
        return $query->num_rows();
    }
 
    public function count_all_secretariat()
    {
        $this->db->from('secretariat');
        return $this->db->count_all_results();
    }

    public function save_nodal($data) {

        
        $this->db->insert('secretariat', $data);
        return $this->db->insert_id();
    }

    public function getDesignation() {
        $query = $this->db->query("select name from designation");
        return $query->result();
    }
    
    public function getDepartment() {
        $query = $this->db->query("select * from dept ");
        return $query->result();
    }
    public function getDirectorate() {
        $query = $this->db->query("select * from directorate");
        return $query->result();
    }

    function getOfficeDepartment() {
        $this->db->select('dept.dname as directoratename,dept.id as directorate');
        $this->db->from('dept');
       $query = $this->db->get();
        return $query->result();
    }
    function getOfficeDirectorates() {
        $this->db->select('directorate.name as directoratename,directorate.id as directorate');
        $this->db->from('directorate');
       $query = $this->db->get();
        return $query->result();
    }
    function getOfficeDistrict() {
        $this->db->select('district.name as directoratename,district.id as directorate');
        $this->db->from('district');
       $query = $this->db->get();
        return $query->result();
    }
    function getOfficeSPOffice() {
        $this->db->select('spoffice.name as directoratename,spoffice.id as directorate');
        $this->db->from('spoffice');
       $query = $this->db->get();
        return $query->result();
    }

    function getDirectorate2($dept) {
        $this->db->select('directorate.name as directoratename,directorate.id as directorate');
        $this->db->from('directorate');
       $this->db->where('dept',$dept);
       $this->db->or_where('directorate.id=0');
       $query = $this->db->get();
        return $query->result();
    }

    function getAll_master(){
        $this->db->select('dept.dname as dname,m_name,designation,secretariat.id as id,directorate.name as directorate,email,phone ');
        $this->db->from('secretariat');
        $this->db->join('dept','dept.id=secretariat.dept');
        $this->db->join('directorate','directorate.id=secretariat.directorate');
        $this->db->where('m_name is not null');
        $this->db->group_by(array("dept.dname","m_name","secretariat.id","directorate.name"));
        $query = $this->db->get();
        return $query->result();
    }

    public function save_master($data) {

        
        $this->db->insert('secretariat', $data);
        return $this->db->insert_id();
    }

    function getAll_emd(){
        $this->db->select('dept.dname as dname,e_name,designation,secretariat.id as id,directorate.name as directorate,email,phone ');
        $this->db->from('secretariat');
        $this->db->join('dept','dept.id=secretariat.dept');
        $this->db->join('directorate','directorate.id=secretariat.directorate');
        $this->db->where('e_name is not null');
        $this->db->group_by(array("dept.dname","e_name","secretariat.id","directorate.name"));
        $query = $this->db->get();
        return $query->result();
    }

    public function save_emd($data) {

        
        $this->db->insert('secretariat', $data);
        return $this->db->insert_id();
    }

    public function update_nodal($where,$data) {
        
            $this->db->update('secretariat', $data, $where);
            return $this->db->affected_rows();
        
    }
    public function get_by_id_nodal($id)
    {
        $this->db->select('n_name,designation,secretariat.id as id,secretariat.directorate,secretariat.dept as dept,email,phone');
        $this->db->from('secretariat');
        $this->db->join('dept','dept.id=secretariat.dept');
        $this->db->join('directorate','directorate.id=secretariat.directorate');
        $this->db->where('secretariat.id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function delete_by_id_nodal($nodal)
    {
        $this->db->where('id', $nodal);
        $this->db->delete('secretariat');
    }

    public function update_master($where,$data) {
        
        $this->db->update('secretariat', $data, $where);
        return $this->db->affected_rows();
    
}
    public function get_by_id_master($id)
    {
        $this->db->select('m_name,designation,secretariat.id as id,secretariat.directorate,secretariat.dept as dept,email,phone');
        $this->db->from('secretariat');
        $this->db->join('dept','dept.id=secretariat.dept');
        $this->db->join('directorate','directorate.id=secretariat.directorate');
        $this->db->where('secretariat.id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function delete_by_id_master($master)
    {
        $this->db->where('id', $master);
        $this->db->delete('secretariat');
    }

    public function update_emd($where,$data) {
            
        $this->db->update('secretariat', $data, $where);
        return $this->db->affected_rows();

    }
    public function get_by_id_emd($id)
    {
    $this->db->select('e_name,designation,secretariat.id as id,secretariat.directorate,secretariat.dept as dept,email,phone');
    $this->db->from('secretariat');
    $this->db->join('dept','dept.id=secretariat.dept');
    $this->db->join('directorate','directorate.id=secretariat.directorate');
    $this->db->where('secretariat.id',$id);
    $query = $this->db->get();

    return $query->row();
    }

    public function delete_by_id_emd($emd)
    {
    $this->db->where('id', $emd);
    $this->db->delete('secretariat');
    }


    function getAll_district(){
        $this->db->select('district.name as district,n_name,nodaldistrict.id as id,,designation,email,phone');
        $this->db->from('nodaldistrict');
        $this->db->join('district','district.id=nodaldistrict.district');
       
        $this->db->where('n_name is not null');
        $this->db->group_by(array("district.name","n_name","nodaldistrict.id"));
        $query = $this->db->get();
        return $query->result();
    }

   function getDistrict() {
       $this->db->select('*');
       $this->db->from('district');
       $query = $this->db->get();
       return $query->result();
   }
    function count_filtered_district()
{
    
        $query = $this->db->get('nodaldistrict');
        return $query->num_rows();
    }
 
    public function count_all_district()
    {
        $this->db->from('nodaldistrict');
        return $this->db->count_all_results();
    }

    public function save_nodal_district($data) {

        
        $this->db->insert('nodaldistrict', $data);
        return $this->db->insert_id();
    }

  
    function getAll_master_district(){
        $this->db->select('district.name as district,m_name,nodaldistrict.id as id,designation,email,phone ');
        $this->db->from('nodaldistrict');
        $this->db->join('district','district.id=nodaldistrict.district');
        $this->db->where('m_name is not null');
        $this->db->group_by(array("district.name","m_name","nodaldistrict.id"));
        $query = $this->db->get();
        return $query->result();
    }

    public function save_master_district($data) {

        
        $this->db->insert('nodaldistrict', $data);
        return $this->db->insert_id();
    }

    function getAll_emd_district(){
        $this->db->select('district.name as district,e_name,nodaldistrict.id as id,designation,email,phone');
        $this->db->from('nodaldistrict');
        $this->db->join('district','district.id=nodaldistrict.district');
        
        $this->db->where('e_name is not null');
        $this->db->group_by(array("district.name","e_name","nodaldistrict.id"));
        $query = $this->db->get();
        return $query->result();
    }

    public function save_emd_district($data) {

        
        $this->db->insert('nodaldistrict', $data);
        return $this->db->insert_id();
    }

    public function update_nodal_district($where,$data) {
        
            $this->db->update('nodaldistrict', $data, $where);
            return $this->db->affected_rows();
        
    }
    public function get_by_id_nodal_district($id)
    {
        $this->db->select('n_name,designation,nodaldistrict.id as id,nodaldistrict.district as district,email,phone');
        $this->db->from('nodaldistrict');
        $this->db->join('district','district.id=nodaldistrict.district');
        $this->db->where('nodaldistrict.id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function delete_by_id_nodal_district($nodal)
    {
        $this->db->where('id', $nodal);
        $this->db->delete('nodaldistrict');
    }

    public function update_master_district($where,$data) {
        
        $this->db->update('nodaldistrict', $data, $where);
        return $this->db->affected_rows();
    
}
    public function get_by_id_master_district($id)
    {
        $this->db->select('m_name,designation,nodaldistrict.id as id,nodaldistrict.district as district,email,phone');
        $this->db->from('nodaldistrict');
        $this->db->join('district','district.id=nodaldistrict.district');
       
        $this->db->where('nodaldistrict.id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function delete_by_id_master_district($master)
    {
        $this->db->where('id', $master);
        $this->db->delete('nodaldistrict');
    }

    public function update_emd_district($where,$data) {
            
        $this->db->update('nodaldistrict', $data, $where);
        return $this->db->affected_rows();

    }
    public function get_by_id_emd_district($id)
    {
    $this->db->select('e_name,designation,nodaldistrict.id as id,nodaldistrict.district as district,email,phone');
    $this->db->from('nodaldistrict');
    $this->db->join('district','district.id=nodaldistrict.district');
   
    $this->db->where('nodaldistrict.id',$id);
    $query = $this->db->get();

    return $query->row();
    }

    public function delete_by_id_emd_district($emd)
    {
    $this->db->where('id', $emd);
    $this->db->delete('nodaldistrict');
    }
    

    public function getRole() {
        $this->db->select("*");
        $this->db->from("role");
        $query = $this->db->get();
        return $query->result();
    }

    function getAll_users(){
        $this->db->select('dept.dname as dname,employee.name,employee.id as id,directorate.name as directorate,employee.name,employee.email,employee.phone,employee.status,employee.role,designation.name as designation,district.name as district,spoffice.name as spoffice');
        $this->db->from('employee');
        $this->db->join('dept','dept.id=employee.dept','left');
        $this->db->join('directorate','directorate.id=employee.directorate','left');
        $this->db->join('designation','designation.name=employee.designation','left');
        $this->db->join('district','district.id=employee.district','left');
        $this->db->join('spoffice','spoffice.id=employee.spoffice','left');
        
        $this->db->group_by(array("dept.dname","employee.name","employee.id","directorate.name","email","phone","role","status","designation.name","district.name","spoffice.name"));
        $query = $this->db->get();
        return $query->result();
    } 
    
    function count_filtered_users()
    {
        
            $query = $this->db->get('employee');
            return $query->num_rows();
        }
     
        public function count_all_users()
        {
            $this->db->from('employee');
            return $this->db->count_all_results();
        }

        public function save_user($data) {

        
            $this->db->insert('employee', $data);
            return $this->db->insert_id();
        }
    
       
        public function get_by_id_user($id)
        {
            $this->db->select('employee.name,designation,employee.id as id,employee.directorate,employee.dept as dept,email,role,phone,status');
            $this->db->from('employee');
            $this->db->join('dept','dept.id=employee.dept','left');
            $this->db->join('directorate','directorate.id=employee.directorate','left');
            $this->db->where('employee.id',$id);
            $query = $this->db->get();
     
            return $query->row();
        }

        public function officetype($id) {
            $this->db->select('office');
            $this->db->from('employee');
            $this->db->where('employee.id',$id);
            $row = $this->db->get()->row();
            if(isset($row)) {
                return $row->office;
            }
            else {
                return false;
            }
        }
        public function get_user_department($id)
        {
            $this->db->select('employee.name,designation,employee.id as id,employee.dept as office,email,role,phone,status,office as officetype');
            $this->db->from('employee');
            $this->db->join('dept','dept.id=employee.dept','left');
            $this->db->where('employee.id',$id);
            $query = $this->db->get();
     
            return $query->row();
        }
        public function get_user_directorate($id)
        {
            $this->db->select('employee.name,designation,employee.id as id,employee.directorate as office,email,role,phone,status,office as officetype');
            $this->db->from('employee');
            $this->db->join('directorate','directorate.id=employee.directorate','left');
            $this->db->where('employee.id',$id);
            $query = $this->db->get();
     
            return $query->row();
        }
        public function get_user_district($id)
        {
            $this->db->select('employee.name,designation,employee.id as id,employee.district as office,email,role,phone,status,office as officetype');
            $this->db->from('employee');
            $this->db->join('district','district.id=employee.district','left');
            $this->db->where('employee.id',$id);
            $query = $this->db->get();
     
            return $query->row();
        }
        public function get_user_spoffice($id)
        {
            $this->db->select('employee.name,designation,employee.id as id,employee.spoffice as office,email,role,phone,status,office as officetype');
            $this->db->from('employee');
            $this->db->join('spoffice','spoffice.id=employee.spoffice','left');
            $this->db->where('employee.id',$id);
            $query = $this->db->get();
     
            return $query->row();
        }
        function checkuser($email) {
            $this->db->where('email',$email);
            
           
            $result = $this->db->get('employee');
            return $result;
        }
        function checknodal($name,$dept) {
            $this->db->where('n_name',$name);
            $this->db->where('dept',$dept);
            
           
            $result = $this->db->get('secretariat');
            return $result;
        }
        function checkMaster($name,$dept) {
            $this->db->where('m_name',$name);
            $this->db->where('dept',$dept);
            
           
            $result = $this->db->get('secretariat');
            return $result;
        }
        function checkemd($name,$dept) {
            $this->db->where('e_name',$name);
            $this->db->where('dept',$dept);
            
           
            $result = $this->db->get('secretariat');
            return $result;
        }

        function checknodal_district($name,$district) {
            $this->db->where('n_name',$name);
            $this->db->where('district',$district);
            
           
            $result = $this->db->get('nodaldistrict');
            return $result;
        }
        function checkMaster_district($name,$district) {
            $this->db->where('m_name',$name);
            $this->db->where('district',$district);
            
           
            $result = $this->db->get('nodaldistrict');
            return $result;
        }
        function checkemd_district($name,$district) {
            $this->db->where('e_name',$name);
            $this->db->where('district',$district);
            
           
            $result = $this->db->get('nodaldistrict');
            return $result;
        }
        public function delete_by_id_user($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('employee');
        }
    
        public function update_user($where,$data) {
            
            $this->db->update('employee', $data, $where);
            return $this->db->affected_rows();
        
    }
    public function getDepartmentUser($where) {
        $this->db->select('dept.id,dname');
        $this->db->from('dept');
        $this->db->join('employee','dept.id=employee.dept');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();

    }
    public function getDirectorateUser($where) {
        $this->db->select('directorate.id,directorate.name');
        $this->db->from('directorate');
        $this->db->join('employee','directorate.id=employee.directorate');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();

    }
    public function getDistrictUser($where) {
        $this->db->select('district.id,district.name');
        $this->db->from('district');
        $this->db->join('employee','district.id=employee.district');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();

    }
    public function getSPOfficeUser($where) {
        $this->db->select('spoffice.id,spoffice.name');
        $this->db->from('spoffice');
        $this->db->join('employee','spoffice.id=employee.spoffice');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();

    }

    public function Reset_Password($email,$data) {
        $this->db->where('email',$email);
        $this->db->update('employee',$data);
    }

    function checkDirectorate($email) {
        $this->db->where('email',$email);
        $this->db->where('directorate = 0');
        
       
        $result = $this->db->get('employee');
        return $result;
    }
}

