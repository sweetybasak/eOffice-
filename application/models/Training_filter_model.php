<?php

class Training_filter_model extends CI_Model {
    

    var $column_order = array('title','venue','course','starting');
    var $column_search = array('depttrainings.dname','participation.dept','trainings.course','trainings.venue','depttrainings.directorate','participation.direct','depttrainings.district','depttrainings.spoffice','trainings.type','participation.type');

    function __construct(){
        parent::__construct();
    }

    public function getDepartment() {

        $this->db->select('id,dname');
        $this->db->from('dept');
        $this->db->order_by('dname','asc');
        $this->db->where('dname is not null');
        $query = $this->db->get();
        return $query->result();

        
        
        
    }
    public function getDirectorate() {

        $this->db->select('id,name');
        $this->db->from('directorate');
        $this->db->order_by('name','asc');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();

        
        
        
    }
    public function getDistrict() {

        $this->db->select('id,name');
        $this->db->from('district');
        $this->db->order_by('name','asc');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();
        
    }
    public function getSPOffice() {

        $this->db->select('id,name');
        $this->db->from('spoffice');
        $this->db->order_by('name','asc');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();

        
        
        
    }
    public function getTrainingType() {

        $this->db->select('name');
        $this->db->from('trainingtype');
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        return $query->result();

        
        
        
    }
    public function getTrainingTypeadmin() {

        
        $query = $this->db->query("select name from trainingtype where name='Departmental' or name='Directorates'");
        return $query->result();  
        
    }
    public function getTrainingTypeemd() {

        $query = $this->db->query("select name from trainingtype where  name='Directorates'");
        return $query->result();  
         
        
    }
    public function getParticipantType() {

        $this->db->select('name');
        $this->db->from('participanttype');
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        return $query->result();

        
        
        
    }

    public function get_list_department() {
        $this->db->select('deptname');
        $this->db->from('infrasecretariat');
        $this->db->order_by('deptname','asc');
        $query = $this->db->get();
        $result = $query->result();

        $dept = array();
        foreach($result as $row)
        {
            $dept[] = $row->deptname;
        }
        return $dept;
    }

    public function getCourse() {

        $this->db->select('id,name');
        $this->db->from('courses');
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        return $query->result();

       
        
    }


    public function getVenue() {

        $this->db->select('id,name');
        $this->db->from('venue');
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        return $query->result();

      
    }

   
  

         public function get_datatables() {
            $this->_get_datatables_query();
            if(isset($_POST['length']) != -1)
            $this->db->limit(isset($_POST['length'], $_POST['start']));
            $query = $this->db->get();
            return $query->result();
        }

        private function _get_datatables_query()
        {
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            
           

            if($this->input->post('dname')) {
                $this->db->where('depttrainings.dname', $this->input->post('dname'));
               
                     }
            if($this->input->post('course')) {
                $this->db->where('trainings.course', $this->input->post('course'));
            }
           
            if($this->input->post('venue')) {
                $this->db->where('trainings.venue', $this->input->post('venue'));
            }
            
            if($this->input->post('directorate')) {
                $this->db->where('depttrainings.directorate', $this->input->post('directorate'));
               
            }
            if($this->input->post('district')) {
                $this->db->where('depttrainings.district', $this->input->post('district'));
               
                
            }
            if($this->input->post('spoffice')) {
                $this->db->where('depttrainings.spoffice', $this->input->post('spoffice'));
                
           
            }
            if($this->input->post('trainingtype')) {
                $this->db->where('trainings.type', $this->input->post('trainingtype'));
            }
            if($this->input->post('participanttype')) {
                $this->db->where('participation.type', $this->input->post('participanttype'));
            }
           
            
            
            
            


            $this->db->select("courses.name as course,trainings.id as id,trainings.title,venue.name as venue,to_char(starting::DATE,'dd/mm/yyyy') as date,to_char(ending::DATE,'dd/mm/yyyy') as end,count(distinct(participation.name)) as users,count(trainings.id) as train,trainings.files,trainings.type as trainingtype");
            $this->db->from('trainings');
            $this->db->join('courses','courses.id=trainings.course','left');
            $this->db->join('venue','venue.id=trainings.venue','left');
            $this->db->join('depttrainings','depttrainings.trainingid=trainings.id','left');
            $this->db->join('dept','depttrainings.dname=dept.id','left');
            $this->db->join('directorate','depttrainings.directorate=directorate.id','left');
            $this->db->join('district','depttrainings.district=district.id','left');
            $this->db->join('spoffice','depttrainings.spoffice=spoffice.id','left');
            $this->db->join('participation','participation.trainingsid=trainings.id','left');

            
            $this->db->where('date(starting) >= ',$from);
            $this->db->where('date(starting) <= ',$to);
            
            $this->db->group_by(array("trainings.title","trainings.venue","trainings.starting","trainings.id","courses.name","venue.name"));
            
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

        public function count_filtered() {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function count_all() {
            $this->db->from('trainings');
            return $this->db->count_all_results();
        }
        
        

        public function fetch_participant($id) {

            $this->db->select('trainings.id,participation.name,dept.dname as dname,participation.email,participation.phone');
            $this->db->from('participation');
            $this->db->join('trainings','participation.trainingsid=trainings.id','left');
            $this->db->join('dept','dept.id=participation.dept','left');
            $this->db->where('trainings.id',$id);

            $query = $this->db->get();
            return $query->result();

           
        }
        public function fetch_department($id) {

            $this->db->select('trainings.id,dept.dname as dname');
            $this->db->from('depttrainings');
            $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
            $this->db->join('dept','dept.id=depttrainings.dname','left');
            $this->db->where('trainings.id',$id);

            $query = $this->db->get();
            return $query->result();

           
        }
        public function parti($id) {
           

                $query=$this->db->query("SELECT trainings.id,participation.name, dept.dname as deptname,participation.designation as designation,participation.email,participation.phone,participation.type as type1,directorate.name as directorate,district.name as district,spoffice.name as spoffice
                                         FROM participation 
                                         LEFT JOIN trainings 
                                         ON participation.trainingsid=trainings.id
                                         LEFT JOIN dept
                                         ON participation.dept=dept.id
                                         LEFT JOIN directorate
                                         ON participation.direct=directorate.id
                                         LEFT JOIN district
                                         ON participation.dist=district.id
                                         LEFT JOIN spoffice
                                         ON participation.spofc=spoffice.id
                                         
                                         WHERE trainings.id = $id");
                return $query->result_array();
            
        
        }
        public function department($id) {
           

            $query=$this->db->query("SELECT trainings.id as id, dept.dname as deptname,count(distinct(participation.name)) as users,dept.id as dept
                                     FROM depttrainings 
                                     LEFT JOIN trainings 
                                     ON depttrainings.trainingid=trainings.id
                                     LEFT JOIN dept
                                     ON depttrainings.dname=dept.id
                                     LEFT JOIN participation 
									 ON participation.dept=dept.id and participation.trainingsid=trainings.id
                                 
                                     WHERE trainings.id = $id AND depttrainings.dname is not null group by trainings.id,dept.dname,dept.id");
            return $query->result_array();

        
    
    }
    public function directorate($id) {
           

        $query=$this->db->query("SELECT trainings.id as id, directorate.name as deptname,count(distinct(participation.name)) as users,directorate.id as dept
                                 FROM depttrainings 
                                 LEFT JOIN trainings 
                                 ON depttrainings.trainingid=trainings.id
                                 LEFT JOIN directorate
                                 ON depttrainings.directorate=directorate.id
                                 LEFT JOIN participation 
									 ON participation.direct=directorate.id and participation.trainingsid=trainings.id
                                 
                             
                                 WHERE trainings.id = $id AND depttrainings.directorate is not null group by trainings.id,directorate.name,directorate.id");
        return $query->result_array();

    

}
public function district($id) {
           

    $query=$this->db->query("SELECT trainings.id, district.name as deptname,count(distinct(participation.name)) as users,district.id as dept
                             FROM depttrainings 
                             LEFT JOIN trainings 
                             ON depttrainings.trainingid=trainings.id
                             LEFT JOIN district
                             ON depttrainings.district=district.id
                             LEFT JOIN participation 
									 ON participation.dist=district.id and participation.trainingsid=trainings.id
                                 
                         
                             WHERE trainings.id = $id AND depttrainings.district is not null group by trainings.id,district.name,district.id");
    return $query->result_array();



}
public function spoffice($id) {
           

    $query=$this->db->query("SELECT trainings.id, spoffice.name as deptname,count(distinct(participation.name)) as users,spoffice.id as dept
                             FROM depttrainings 
                             LEFT JOIN trainings 
                             ON depttrainings.trainingid=trainings.id
                             LEFT JOIN spoffice
                             ON depttrainings.spoffice=spoffice.id
                             LEFT JOIN participation 
									 ON participation.spofc=spoffice.id and participation.trainingsid=trainings.id
                                 
                             WHERE trainings.id = $id AND depttrainings.spoffice is not null group by trainings.id,spoffice.name,spoffice.id");
    return $query->result_array();



}

var $column_order1 = array('dept.dname','trainings','participants');
var $column_search1 = array('dept.id','trainings.type','participation.type');
var $order1 = array('dept.dname' => 'asc');

public function get_report() {
    $this->_report();
    if(isset($_POST['length']) != -1)
    $this->db->limit(isset($_POST['length'], $_POST['start']));
    $query = $this->db->get();
    return $query->result();
}

private function _report()
{
   
    if($this->input->post('dname')) {
        $this->db->where('dept.id', $this->input->post('dname'));
    }
    
    if($this->input->post('trainingtype')) {
        $this->db->where('trainings.type', $this->input->post('trainingtype'));
    }
    if($this->input->post('participanttype')) {
        $this->db->where('participation.type', $this->input->post('participanttype'));
    }
   
    
    
    
    


    $this->db->select("dept.dname as dname,count(distinct depttrainings.trainingid) as train,count(participation.name) as users");
    $this->db->from('dept');

    $this->db->join('depttrainings','depttrainings.dname=dept.id','left');
    $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
  
    $this->db->join('participation','participation.trainingsid=trainings.id AND participation.dept=dept.id','left');
    $this->db->where('dept.dname is not null');
    
    $this->db->group_by(array("dept.id"));
    
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

    else if(isset($this->order1)) {
        $order1 = $this->order1;
        $this->db->order_by(key($order1), $order1[key($order1)]);
    }
}

var $column_order2 = array('directorate.name','trainings','participants');
var $column_search2 = array('directorate.id','trainings.type','participation.type');
var $order2 = array('directorate.name'=> 'asc');
public function get_report1() {
    $this->_report1();
    if(isset($_POST['length']) != -1)
    $this->db->limit(isset($_POST['length'], $_POST['start']));
    $query = $this->db->get();
    return $query->result();
}

private function _report1()
{
   
    if($this->input->post('directorate')) {
        $this->db->where('directorate.id', $this->input->post('directorate'));
    }
    
    if($this->input->post('trainingtype1')) {
        $this->db->where('trainings.type', $this->input->post('trainingtype1'));
    }
    if($this->input->post('participanttype1')) {
        $this->db->where('participation.type', $this->input->post('participanttype1'));
    }
   
    
    
    
    


    $this->db->select("directorate.name as dname,count(distinct depttrainings.trainingid) as train,count(participation.name) as users");
    $this->db->from('directorate');

    $this->db->join('depttrainings','depttrainings.directorate=directorate.id','left');
    $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
  
    $this->db->join('participation','participation.trainingsid=trainings.id AND participation.direct=directorate.id','left');
    
    $this->db->where('directorate.name is not null');
    $this->db->group_by(array("directorate.id"));
    
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

    else if(isset($this->order2)) {
        $order2 = $this->order2;
        $this->db->order_by(key($order2), $order2[key($order2)]);
    }
}


var $column_order3 = array('district.name','trainings','participants');
var $column_search3 = array('district.id','trainings.type','participation.type');
var $order3 = array('district.name' => 'asc');
public function get_report2() {
    $this->_report2();
    if(isset($_POST['length']) != -1)
    $this->db->limit(isset($_POST['length'], $_POST['start']));
    $query = $this->db->get();
    return $query->result();
}

private function _report2()
{
   
    if($this->input->post('district')) {
        $this->db->where('district.id', $this->input->post('district'));
    }
    
    if($this->input->post('trainingtype2')) {
        $this->db->where('trainings.type', $this->input->post('trainingtype2'));
    }
    if($this->input->post('participanttype2')) {
        $this->db->where('participation.type', $this->input->post('participanttype2'));
    }
   
    
    
    
    


    $this->db->select("district.name as dname,count(distinct depttrainings.trainingid) as train,count(participation.name) as users");
    $this->db->from('district');

    $this->db->join('depttrainings','depttrainings.district=district.id','left');
    $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
  
    $this->db->join('participation','participation.trainingsid=trainings.id AND participation.dist=district.id','left');
    $this->db->where('district.name is not null');
    
    $this->db->group_by(array("district.id"));
    
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

    else if(isset($this->order3)) {
        $order3 = $this->order3;
        $this->db->order_by(key($order3), $order3[key($order3)]);
    }
}

       
var $column_order4 = array('spoffice.name','trainings','participants');
var $column_search4 = array('spoffice.id','trainings.type','participation.type');
var $order4 = array('spoffice.name','asc');

public function get_report3() {
    $this->_report3();
    if(isset($_POST['length']) != -1)
    $this->db->limit(isset($_POST['length'], $_POST['start']));
    $query = $this->db->get();
    return $query->result();
}

private function _report3()
{
   
    if($this->input->post('spoffice')) {
        $this->db->where('spoffice.id', $this->input->post('spoffice'));
    }
    
    if($this->input->post('trainingtype3')) {
        $this->db->where('trainings.type', $this->input->post('trainingtype3'));
    }
    if($this->input->post('participanttype3')) {
        $this->db->where('participation.type', $this->input->post('participanttype3'));
    }
   
    
    
    
    


    $this->db->select("spoffice.name as dname,count(distinct depttrainings.trainingid) as train,count(participation.name) as users");
    $this->db->from('spoffice');

    $this->db->join('depttrainings','depttrainings.spoffice=spoffice.id','left');
    $this->db->join('trainings','depttrainings.trainingid=trainings.id','left');
  
    $this->db->join('participation','participation.trainingsid=trainings.id AND participation.spofc=spoffice.id','left');
    $this->db->where('spoffice.name is not null');
    
    $this->db->group_by(array("spoffice.id"));
    
    $i=0;
    foreach($this->column_search4 as $item) 
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

            if(count($this->column_search4) - 1 == $i)
            $this->db->group_end();
        }
        $i++;
    }

    if(isset($_POST['order'])) {
        $this->db->order_by($this->column_order4[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);

    }

    else if(isset($this->order4)) {
        $order4 = $this->order4;
        $this->db->order_by(key($order4), $order4[key($order4)]);
    }
}
        

public function participantsd($id,$dept) {
           

    $query=$this->db->query("SELECT trainings.id, participation.name as pname,directorate.name as dname,designation,email,phone,participation.type
                             FROM participation 
                             LEFT JOIN trainings 
                             ON participation.trainingsid=trainings.id
                             LEFT JOIN directorate
                             ON participation.direct=directorate.id
                               
                             WHERE participation.trainingsid = $id AND participation.direct=$dept group by trainings.id,participation.name,directorate.name,designation,email,phone,participation.type");
    return $query->result_array();



}
public function participantsdi($id,$dept) {
           

    $query=$this->db->query("SELECT trainings.id, participation.name as pname,dept.dname as dname,designation,email,phone,participation.type
                             FROM participation 
                             LEFT JOIN trainings 
                             ON participation.trainingsid=trainings.id
                             LEFT JOIN dept
                             ON participation.dept=dept.id
                               
                             WHERE participation.trainingsid = $id AND participation.dept=$dept group by trainings.id,participation.name,dept.dname,designation,email,phone,participation.type");
    return $query->result_array();

}

public function participantsdistrict($id,$dept) {
           

    $query=$this->db->query("SELECT trainings.id, participation.name as pname,district.name as dname,designation,email,phone,participation.type
                             FROM participation 
                             LEFT JOIN trainings 
                             ON participation.trainingsid=trainings.id
                             LEFT JOIN district
                             ON participation.dist=district.id
                               
                             WHERE participation.trainingsid = $id AND participation.dist=$dept group by trainings.id,participation.name,district.name,designation,email,phone,participation.type");
    return $query->result_array();

}
public function participantsspoffice($id,$dept) {
           

    $query=$this->db->query("SELECT trainings.id, participation.name as pname,spoffice.name as dname,designation,email,phone,participation.type
                             FROM participation 
                             LEFT JOIN trainings 
                             ON participation.trainingsid=trainings.id
                             LEFT JOIN spoffice
                             ON participation.spofc=spoffice.id
                               
                             WHERE participation.trainingsid = $id AND participation.spofc=$dept group by trainings.id,participation.name,spoffice.name,designation,email,phone,participation.type");
    return $query->result_array();

}


}