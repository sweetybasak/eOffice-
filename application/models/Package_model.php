<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Package_model extends CI_Model{
     
    // GET ALL PRODUCT
    function get_dept(){
        $query = $this->db->get('dept');
        return $query;
    }
    function getDirectorate(){
        $query = $this->db->get('directorate');
        return $query;
    }
    function getDirectoratedepartmental($dept){
        $this->db->select('*');
        $this->db->from('directorate');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query;
    }
    function getDistrict(){
        $query = $this->db->get('district');
        return $query;
    }
    function getSpOffice(){
        $query = $this->db->get('spoffice');
        return $query;
    }
 
    //GET PRODUCT BY PACKAGE ID
    function get_product_by_package($package_id){
        $this->db->select('dept.id as did,dept.dname as dept,*,trainings.id as training,trainings.title as title');
        $this->db->from('dept');
        $this->db->join('depttrainings', 'depttrainings.dname=dept.id');
        $this->db->join('trainings', 'trainings.id=depttrainings.trainingid');
        $this->db->where('trainings.id',$package_id);
        $query = $this->db->get();
        return $query;

    }
    function get_product_by_package1($package_id){
        $this->db->select('directorate.id as did,directorate.name as dept,*,trainings.id as training,trainings.title as title');
        $this->db->from('directorate');
        $this->db->join('depttrainings', 'depttrainings.directorate=directorate.id');
        $this->db->join('trainings', 'trainings.id=depttrainings.trainingid');
        $this->db->where('trainings.id',$package_id);
        $query = $this->db->get();
        return $query;

    }
    function get_product_by_package2($package_id){
        $this->db->select('district.id as did,district.name as dept,*,trainings.id as training,trainings.title as title');
        $this->db->from('district');
        $this->db->join('depttrainings', 'depttrainings.district=district.id');
        $this->db->join('trainings', 'trainings.id=depttrainings.trainingid');
        $this->db->where('trainings.id',$package_id);
        $query = $this->db->get();
        return $query;

    }
    function get_product_by_package3($package_id){
        $this->db->select('spoffice.id as did,spoffice.name as dept,*,trainings.id as training,trainings.title as title');
        $this->db->from('spoffice');
        $this->db->join('depttrainings', 'depttrainings.spoffice=spoffice.id');
        $this->db->join('trainings', 'trainings.id=depttrainings.trainingid');
        $this->db->where('trainings.id',$package_id);
        $query = $this->db->get();
        return $query;

    }
    function get_product_by_package4($package_id){
        $this->db->select('dept.id as did,dept.dname as dept,directorate.id as directorate,directorate.name as dname,district.id as district,district.name as diname,spoffice.id as spoffice,spoffice.name as sname,*,trainings.id as training,trainings.title as title');
        $this->db->from('spoffice');
        $this->db->join('depttrainings', 'depttrainings.spoffice=spoffice.id');
        $this->db->join('trainings', 'trainings.id=depttrainings.trainingid');
        $this->db->join('dept', 'depttrainings.dname=dept.id');
        $this->db->join('directorate', 'depttrainings.directorate=directorate.id');
        $this->db->join('district', 'depttrainings.district=district.id');
        $this->db->where('trainings.id',$package_id);
        $query = $this->db->get();
        return $query;

    }
    public function getAll() {
        $this->db->select("trainings.id as training,trainings.title as title,string_agg(dept.dname, ', ' order by dept.dname) as dname");
        $this->db->from('depttrainings');
        $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
        $this->db->join('dept','depttrainings.dname=dept.id','left');
        $this->db->where('trainings.type','Departmental');
        $this->db->group_by(array("trainings.title","trainings.id"));
       $query = $this->db->get();
       return $query->result();

    }
    public function getDepartmental($dept) {
    
       $query = $this->db->query("select trainings.id as training,trainings.title as title,
       string_agg(dept.dname, ', ' order by dept.dname) as dname
       from trainings,depttrainings,dept where 
       exists(select depttrainings.dname from depttrainings where depttrainings.dname='$dept' 
       and depttrainings.trainingid=trainings.id) and trainings.type='Departmental'
        and trainings.id=depttrainings.trainingid and depttrainings.dname=dept.id group by trainings.id,trainings.title");
       return $query->result();

    }
    public function getAll_directorate() {
        $this->db->select("trainings.id as training,trainings.title as title,string_agg(directorate.name, ', ' order by directorate.name) as directorate");
        $this->db->from('depttrainings');
        $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
        
        $this->db->join('directorate','depttrainings.directorate=directorate.id','left');
        $this->db->where('trainings.type','Directorates');
        $this->db->group_by(array("trainings.title","trainings.id"));
       $query = $this->db->get();
       return $query->result();

    }
    public function getDirectoratestrainings($directorate) {
       $query = $this->db->query( "select trainings.id as training,trainings.title as title,
        string_agg(directorate.name, ', ' order by directorate.name) as directorate
        from trainings,depttrainings,directorate where 
        exists(select depttrainings.directorate from depttrainings where depttrainings.directorate='$directorate' and
         depttrainings.trainingid=trainings.id) and trainings.type='Directorates'
         and trainings.id=depttrainings.trainingid and depttrainings.directorate=directorate.id  group by trainings.id,trainings.title");
         return $query->result();
        
    }


    public function getDistricttrainings($district) {
        $query = $this->db->query( "select trainings.id as training,trainings.title as title,
         string_agg(district.name, ', ' order by district.name) as district
         from trainings,depttrainings,district where 
         exists(select depttrainings.district from depttrainings where depttrainings.district='$district' and
          depttrainings.trainingid=trainings.id) and trainings.type='District'
          and trainings.id=depttrainings.trainingid and depttrainings.district=district.id  group by trainings.id,trainings.title");
          return $query->result();
         
     }
     public function getSPOfficetrainings($district) {
        $query = $this->db->query( "select trainings.id as training,trainings.title as title,
         string_agg(spoffice.name, ', ' order by spoffice.name) as spoffice
         from trainings,depttrainings,spoffice where 
         exists(select depttrainings.spoffice from depttrainings where depttrainings.spoffice='$district' and
          depttrainings.trainingid=trainings.id) and trainings.type='SP Office'
          and trainings.id=depttrainings.trainingid and depttrainings.spoffice=spoffice.id  group by trainings.id,trainings.title");
          return $query->result();
         
     }

    public function getAll_district() {
        $this->db->select("trainings.id as training,trainings.title as title,string_agg(district.name, ', ' order by district.name) as district");
        $this->db->from('depttrainings');
        $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
        
        $this->db->join('district','depttrainings.district=district.id','left');
        $this->db->where('trainings.type','District');
        $this->db->group_by(array("trainings.title","trainings.id"));
       $query = $this->db->get();
       return $query->result();

    }

    public function getAll_spoffice() {
        $this->db->select("trainings.id as training,trainings.title as title,string_agg(spoffice.name, ', ' order by spoffice.name) as spoffice");
        $this->db->from('depttrainings');
        $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
        
        $this->db->join('spoffice','depttrainings.spoffice=spoffice.id','left');
       
        $this->db->where('trainings.type','SP Office');
        $this->db->group_by(array("trainings.title","trainings.id"));
       $query = $this->db->get();
       return $query->result();

    }
    public function getAll_total() {
        $this->db->select("trainings.id as training,trainings.title as title,string_agg(dept.dname, ', ' order by dept.dname) as dname,string_agg(directorate.name, ', ' order by directorate.name) as directorate,string_agg(district.name, ', ' order by district.name) as district,string_agg(spoffice.name, ', ' order by spoffice.name) as spoffice");
        $this->db->from('depttrainings');
        $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
        $this->db->join('dept','depttrainings.dname=dept.id','left');
        $this->db->join('directorate','depttrainings.directorate=directorate.id','left');
        $this->db->join('district','depttrainings.district=district.id','left');
        $this->db->join('spoffice','depttrainings.spoffice=spoffice.id','left');
      $this->db->where('trainings.type','Combined');
        $this->db->group_by(array("trainings.title","trainings.id"));
       $query = $this->db->get();
       return $query->result();

    }
 
    //READ
    function get_packages(){
        $this->db->select('trainings.id as id,trainings.title as title,COUNT(dept.id) AS item_product');
        $this->db->from('trainings');
        $this->db->join('depttrainings', 'trainings.id=depttrainings.trainingid');
        $this->db->join('dept', 'depttrainings.dname=dept.id');
        $this->db->group_by('trainings.id');
        $query = $this->db->get();
        return $query;
    }
 
    // CREATE
    function create_package($package,$product){
        $this->db->trans_start();
            //INSERT TO PACKAGE
           
            $data  = array(
                'title' => $package,
                
            );
            
            $this->db->insert('trainings', $data);
            //GET ID PACKAGE
            $package_id = $this->db->insert_id();
            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'trainingid'   => $package_id,
                      'dname'   => $_POST['dept'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }
 
     
    // UPDATE
    function update_package($id,$package,$product){
        $this->db->trans_start();
            //UPDATE TO PACKAGE
            $data  = array(
                'title' => $package
            );
            $this->db->where('trainings.id',$id);
            $this->db->update('trainings', $data);
             
            //DELETE DETAIL PACKAGE
            $this->db->delete('depttrainings', array('trainingid' => $id));
 
            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'trainingid'   => $id,
                      'dname'   => $_POST['product_edit'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }
 
    // DELETE
    function delete_programme($id){
        $this->db->trans_start();
            $this->db->delete('depttrainings', array('trainingid' => $id));
            
        $this->db->trans_complete();
    }
    function delete_prog($dept,$id){
        $this->db->trans_start();
            $this->db->delete('depttrainings', array('trainingid' => $id, 'dname' => $dept));
            
        $this->db->trans_complete();
    }
    function delete_directorate($dept,$id){
        $this->db->trans_start();
            $this->db->delete('depttrainings', array('trainingid' => $id, 'directorate' => $dept));
            
        $this->db->trans_complete();
    }
    function delete_district($dept,$id){
        $this->db->trans_start();
            $this->db->delete('depttrainings', array('trainingid' => $id, 'district' => $dept));
            
        $this->db->trans_complete();
    }
    function delete_spoffice($dept,$id){
        $this->db->trans_start();
            $this->db->delete('depttrainings', array('trainingid' => $id, 'spoffice' => $dept));
            
        $this->db->trans_complete();
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

    public function save_p($data) {
       
        $this->db->insert('depttrainings',$data);
        return $this->db->insert_id();
    }
    public function save_pd($data) {
       
        $this->db->insert('depttrainings',$data);
        return $this->db->insert_id();
    }
    public function save_pdistrict($data) {
       
        $this->db->insert('depttrainings',$data);
        return $this->db->insert_id();
    }
    public function save_spoffice($data) {
       
        $this->db->insert('depttrainings',$data);
        return $this->db->insert_id();
    }
    public function save_programme1($training,$directorate) {
        $this->db->trans_start();
        $result = array();
        foreach($directorate as $key => $val) 
        {
            $result[] = array(

                'trainingid' => $training,
                'directorate' => $_POST['directorate'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }

    public function save_programme2($training,$district) {
        $this->db->trans_start();
        $result = array();
        foreach($district as $key => $val) 
        {
            $result[] = array(

                'trainingid' => $training,
                'district' => $_POST['district'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }
    public function save_programme3($training,$spoffice) {
        $this->db->trans_start();
        $result = array();
        foreach($spoffice as $key => $val) 
        {
            $result[] = array(

                'trainingid' => $training,
                'spoffice' => $_POST['spoffice'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }

    public function save_programme4($training,$dept,$directorate,$district,$spoffice) {
        $this->db->trans_start();
        $result = array();
        $result1 = array();
        $result2 = array();
        $result3 = array();

         foreach($dept as $key => $val) 
        {
            $result[] = array(

                'trainingid' => $training,
                'dname' => $_POST['dept'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result);
        foreach($directorate as $key => $val) 
        {
            $result1[] = array(

                'trainingid' => $training,
                'directorate' => $_POST['directorate'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result1);
        foreach($district as $key => $val) 
        {
            $result2[] = array(

                'trainingid' => $training,
                'district' => $_POST['district'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result2);
        foreach($spoffice as $key => $val) 
        {
            $result3[] = array(

                'trainingid' => $training,
                'spoffice' => $_POST['spoffice'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result3);
       
        $this->db->trans_complete();
    }
    public function save_programmeadmin($training,$directorate) {
        $this->db->trans_start();
        $result = array();
        $result1 = array();
       

       
        foreach($directorate as $key => $val) 
        {
            $result1[] = array(

                'trainingid' => $training,
                'directorate' => $_POST['directorate'][$key]
            ); 
        }
        $this->db->insert_batch('depttrainings', $result1);
        
        $this->db->trans_complete();
    }


    public function getTrainings() {
       $query= $this->db->query("select trainings.id,trainings.title from trainings where not exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id)");
        
        return $query->result();
    }

    function update_programme($id,$product){
        $this->db->trans_start();
           
            //DELETE DETAIL PACKAGE
            $this->db->delete('depttrainings', array('trainingid' => $id));
 
            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'trainingid'   => $id,
                      'dname'   => $_POST['dept_edit'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }

    function update_programme1($id,$product){
        $this->db->trans_start();
           
            //DELETE DETAIL PACKAGE
            $this->db->delete('depttrainings', array('trainingid' => $id));
 
            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'trainingid'   => $id,
                      'directorate'   => $_POST['directorate_edit'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }
    function update_programme2($id,$product){
        $this->db->trans_start();
           
            //DELETE DETAIL PACKAGE
            $this->db->delete('depttrainings', array('trainingid' => $id));
 
            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'trainingid'   => $id,
                      'district'   => $_POST['district_edit'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }
    function update_programme3($id,$product){
        $this->db->trans_start();
           
            //DELETE DETAIL PACKAGE
            $this->db->delete('depttrainings', array('trainingid' => $id));
 
            $result = array();
                foreach($product AS $key => $val){
                     $result[] = array(
                      'trainingid'   => $id,
                      'spoffice'   => $_POST['spoffice_edit'][$key]
                     );
                }      
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('depttrainings', $result);
        $this->db->trans_complete();
    }

    function update_programme4($id,$product1,$product2,$product3,$product){
        $this->db->trans_start();
           
            //DELETE DETAIL PACKAGE
            $this->db->delete('depttrainings', array('trainingid' => $id));
 
            $result = array();
            $result1 = array();
            $result2 = array();
            $result3 = array();
            
                 foreach($product1 AS $key => $val){
                    $result1[] = array(
                     'trainingid'   => $id,
                     'dname'   => $_POST['dept_edit'][$key]
                    );
               }   
               $this->db->insert_batch('depttrainings', $result1);  
               foreach($product2 AS $key => $val){
                $result2[] = array(
                 'trainingid'   => $id,
                 'directorate'   => $_POST['directorate_edit'][$key]
                );
           } 
           $this->db->insert_batch('depttrainings', $result2);
           foreach($product3 AS $key => $val){
            $result3[] = array(
             'trainingid'   => $id,
             'district'   => $_POST['district_edit'][$key]
            );
       }
            //MULTIPLE INSERT TO DETAIL TABLE
            $this->db->insert_batch('depttrainings', $result3);
            foreach($product AS $key => $val){
                $result[] = array(
                 'trainingid'   => $id,
                 'spoffice'   => $_POST['spoffice_edit'][$key]
                );
           }
           $this->db->insert_batch('depttrainings', $result);
          
        $this->db->trans_complete();
    }

    function validate($training) {
        $this->db->select('type');
        $this->db->from('trainings');
        $this->db->where('id',$training);
        $query = $this->db->get();
        return $query->result();
    }
 
}
