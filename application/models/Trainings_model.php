<?php

class Trainings_model extends CI_Model {
    public function __construct() {
        parent::__construct();

    }
   
   

    function getCourses() {
        $query = $this->db->query("select * from courses limit 3");
        return $query->result();
    }
    function getVenue() {
        $query = $this->db->query("select * from venue");
        return $query->result();
    }
    function getcourses1() {
        $query = $this->db->query("select * from courses");
        return $query->result();
    }

    function getDept() {
        $query = $this->db->query("select * from dept limit 3");
        return $query->result();
    }
    function getdept1() {
        $query = $this->db->query("select * from dept");
        return $query->result();
    }

    function getCourse() {
        $query = $this->db->query("select * from courses");
        return $query->result();
    }
    function getType() {
        $query = $this->db->query("select * from trainingtype");
        return $query->result();
    }

    function getdepartment() {
        $query = $this->db->query("select dept.dname,count(distinct depttrainings.trainingid) as train,count(participation.name) as users from dept left join depttrainings on dept.id=depttrainings.dname  left join trainings on depttrainings.trainingid=trainings.id left join participation on participation.trainingsid=trainings.id and participation.dept=dept.id group by dept.dname");
        return $query->result();
    }

    function getDepartmentalTrainings($dept) {
        $query = $this->db->query("select id, title from trainings join depttrainings where depttrainings.dname=$dept");
        return $query->result();
    }

    function getDepartmentalReport() {
        $query = $this->db->query("select dept.dname,count(distinct depttrainings.trainingid) as train,count(participation.name) as users,(select count(participation.name) as local from participation where type='Local Admin') from dept left join depttrainings on dept.id=depttrainings.dname  left join trainings on depttrainings.trainingid=trainings.id left join participation on participation.trainingsid=trainings.id and participation.dept=dept.id group by dept.dname");
        return $query->result();
    }
    function getProgramme() {
        $query = $this->db->query("select title,date(starting) as start from trainings order by starting desc limit 3");
        return $query->result();
    }
    function getTrainings() {
        $query = $this->db->query("select count(title) from trainings");
        return $query->result();
    }
    function getTrain()
    {
        $query = $this->db->query("select trainings.id,trainings.title from trainings where exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id)");
        return $query->result();
    }
    function getDept2($training) {
        $this->db->select('dept.dname as dname,dept.id as dept');
        $this->db->from('depttrainings');
        $this->db->join('dept','dept.id=depttrainings.dname');
       $this->db->where('trainingid',$training);
       $query = $this->db->get();
        return $query->result();
    }
    function getDirectorate2($dept) {
        $this->db->select('directorate.name as name,directorate.id as id');
        $this->db->from('directorate');
        $this->db->join('dept','dept.id=directorate.dept');
       $this->db->where('dept',$dept);
       $this->db->or_where('directorate.id=0');
       $query = $this->db->get();
        return $query->result();
    }
    function getDesignation() {
        $this->db->select('designation.name');
        $this->db->from('designation');
        $query = $this->db->get();
        return $query->result();
    }

    public function getType1($training) {
        $this->db->select('type');
        $this->db->from('trainings');
        $this->db->where('trainings.id',$training);
        $query = $this->db->get();
        return $query->result();
    }

    public function getStatus() {
        $this->db->select('dept.id as dept,dept.dname as dname');
        $this->db->from('dept');
        $query = $this->db->get();
        return $query->result();
    }
    public function getStatus1() {
        $this->db->select('directorate.id as dept,directorate.name as dname');
        $this->db->from('directorate');
        $query = $this->db->get();
        return $query->result();
    }
    public function getStatus2() {
        $this->db->select('district.id as dept,district.name as dname');
        $this->db->from('district');
        $query = $this->db->get();
        return $query->result();
    }
    public function getStatus3() {
        $this->db->select('spoffice.id as dept,spoffice.name as dname');
        $this->db->from('spoffice');
        $query = $this->db->get();
        return $query->result();
    }





    public function get_datatables_query() {
        

        if($this->input->post('courseid')) {
            $this->db->where('courseid', $this->input->post('courseid'));
        }
        if($this->input->post('venue')) {
            $this->db->where('venue', $this->input->post('venue'));
        }

        $this->db->from('trainings');
        $i =0;
        foreach($this->column_search as $item) {
            if($_POST['search']['value']) {
                if($i==0){
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else{
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->colum_search) - 1 == $i)
                $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($_POST['order'])) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
   

    public function get_datatables() {
        $this->get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    

    public function count_filtered() {
        $this->get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from('trainings');
        return $this->db->count_all_results();
    }

    public function get_course() {
        $this->db->select('*');
        $this->db->from('courses');
        $query = $this->db->get();
        $result = $query->result();

        $courses = array();
        foreach($result as $row) {
            $courses[] = $row->id;
        }
        return $courses;
    }



    var $table = 'courses';
    var $column_order = array('name',null); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('name' => 'asc'); // default order 
 
   
    private function _get_datatables_query_course()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_course()
    {
        $this->_get_datatables_query_course();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_course()
    {
        $this->_get_datatables_query_course();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_course()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function get_by_id_course($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_course($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update_course($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_course($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
         
    public function get_all_courses() {
        $this->db->select('name');
        $this->db->from('courses');
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result_array();

        }
        else {
            return 0;
        }
    }

    public function ajax_list()
    {
        $this->load->model('AdminInfra_model');
        $list = $this->AdminInfra_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
        
            $row[] = $no;
            $row[] = $r->deptname;
                    
            $row[] =$r->total_users;
            $row[] = $r->users_system; 
            $row[] =$r->new_system;
            $row[] =  $r->dsc; 
            $row[] = $r->scanners; 
            $row[] = $r->printers;
            $row[] = $r->dsc_required; 
            $row[] = $r->printer_required; 
            $row[] = $r->scanners_required; 
            $row[] = $r->system_required;
            $row[] = $r->isp;
            $row[] = $r->bandwidth; 
            $row[] = $r->cabling; 
            
           
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$r->deptname."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$r->deptname."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->AdminInfra_model->count_all(),
                        "recordsFiltered" => $this->AdminInfra_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format

        echo json_encode($output);
    }



public function ajax_list_course()
{
    
   
    $list = $this->get_datatables_course();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $r) {
        $no++;
        $row = array();
    
        $row[] = $no;
        $row[] = $r->name;
                
        

        //add html for action
        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_course('."'".$r->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_course('."'".$r->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
     
        $data[] = $row;
    }

    $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->count_all_course(),
                    "recordsFiltered" => $this->count_filtered_course(),
                    "data" => $data,
            );
    //output to json format
    echo json_encode($output);
}


private function _get_datatables_query_programme()
{
     
    $this->db->from($this->table);

    $i = 0;
 
    foreach ($this->column_search as $item) // loop column 
    {
        if($_POST['search']['value']) // if datatable send POST for search
        {
             
            if($i===0) // first loop
            {
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
            }
            else
            {
                $this->db->or_like($item, $_POST['search']['value']);
            }

            if(count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
        }
        $i++;
    }
     
    if(isset($_POST['order'])) // here order processing
    {
        $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
    }
}


function get_datatables_programme()
{
    $this->_get_datatables_query_programme();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
}

function count_filtered_programme()
{
    
        $query = $this->db->get('trainings');
        return $query->num_rows();
    }
 
    public function count_all_programme()
    {
        $this->db->from('trainings');
        return $this->db->count_all_results();
    }
    function count_filtered_emd()
    {
        
            $query = $this->db->get('emd1');
            return $query->num_rows();
        }

       public function getallemd_directorate() {
            $query = $this->db->query("select directorate.name as directorate,(select count(emd1.name) as joined from emd1 where
             emd1.directorate=directorate.id and emd1.type='New User' and emd1.directorate is not null ),
            (select count(emd1.name) as transferred from emd1 where emd1.directorate=directorate.id and emd1.type='Modification' and 
            emd1.directorate is not null),
            (select count(emd1.name) as retired from emd1 where emd1.directorate=directorate.id and emd1.type='Deletion' and emd1.directorate is not null )
            from emd1,directorate where emd1.directorate=directorate.id  and emd1.directorate is not null and emd1.directorate!=0 group by directorate.name,directorate.id");
            return $query->result();
        }
        public function getallemd_district() {
            $query = $this->db->query("select district.name as directorate,(select count(emd1.name) as joined from emd1 where
             emd1.district=district.id and emd1.type='New User' and emd1.district is not null ),
            (select count(emd1.name) as transferred from emd1 where emd1.district=district.id and emd1.type='Modification' and 
            emd1.district is not null),
            (select count(emd1.name) as retired from emd1 where emd1.district=district.id and emd1.type='Deletion' and emd1.district is not null )
            from emd1,district where emd1.district=district.id  and emd1.district is not null and emd1.district!=0  group by district.name,district.id");
            return $query->result();
        }
        public function getallemd_spoffice() {
            $query = $this->db->query("select spoffice.name as directorate,(select count(emd1.name) as joined from emd1 where
             emd1.spoffice=spoffice.id and emd1.type='New User' and emd1.spoffice is not null ),
            (select count(emd1.name) as transferred from emd1 where emd1.spoffice=spoffice.id and emd1.type='Modification' and 
            emd1.spoffice is not null),
            (select count(emd1.name) as retired from emd1 where emd1.spoffice=spoffice.id and emd1.type='Deletion' and emd1.spoffice is not null )
            from emd1,spoffice where emd1.spoffice=spoffice.id  and emd1.spoffice is not null and emd1.spoffice!=0   group by spoffice.name,spoffice.id");
            return $query->result();
        }
        

       public  function getallemd_admindirectorate($dept) {
            $query = $this->db->query("select directorate.name as directorate,(select count(emd1.name) as joined from emd1 where emd1.directorate=directorate.id and emd1.type='New User' and emd1.directorate!=0 ),
            (select count(emd1.name) as transferred from emd1 where emd1.directorate=directorate.id and emd1.type='Modification' and emd1.directorate!=0 ),
            (select count(emd1.name) as retired from emd1 where emd1.directorate=directorate.id and emd1.type='Deletion' and emd1.directorate!=0 )
            from emd1,directorate where emd1.directorate=directorate.id  and emd1.dept=$dept and emd1.directorate!=0  group by directorate.name,directorate.id");
            return $query->result();
        }
      public  function getallemd_emddirectorate($directorate) {
            $query = $this->db->query("select directorate.name as directorate,(select count(emd1.name) as joined from emd1 where emd1.directorate=directorate.id and emd1.type='New User' and emd1.directorate!=0 ),
            (select count(emd1.name) as transferred from emd1 where emd1.directorate=directorate.id and emd1.type='Modification' and emd1.directorate!=0 ),
            (select count(emd1.name) as retired from emd1 where emd1.directorate=directorate.id and emd1.type='Deletion' and emd1.directorate!=0 )
            from emd1,directorate where emd1.directorate=directorate.id  and emd1.directorate=$directorate and emd1.directorate!=0  group by directorate.name,directorate.id");
            return $query->result();
        }
     
        public function count_all_emd()
        {
            $this->db->from('emd1');
            return $this->db->count_all_results();
        }
        

        public function getallemd() {
          $query1 =  $this->db->query("select dept.dname as dname,(select count(emd1.name) as joined from emd1 where 
          emd1.dept=dept.id and emd1.type='New User' and  emd1.dept is not null),(select count(emd1.name) as transferred from emd1 
          where emd1.dept=dept.id and emd1.type='Modification' and emd1.dept is not null),(select count(emd1.name) as retired from 
          emd1 where emd1.dept=dept.id and emd1.type='Deletion' and  emd1.dept is not null),emd1.files from emd1,dept where 
          dept.id=emd1.dept and emd1.dept is not null and emd1.dept!=0 group by dept.dname,emd1.files,dept.id");
            return $query1->result();
        }

        public function getallemdDept($dept) {
            $query1 =  $this->db->query("select dept.dname as dname,(select count(emd1.name) as joined from emd1 where 
            emd1.dept=dept.id and emd1.type='New User' and  emd1.dept is not null),(select count(emd1.name) as transferred 
            from emd1 where emd1.dept=dept.id and emd1.type='Modification' and  emd1.dept is not null),(select count(emd1.name) 
            as retired from emd1 where emd1.dept=dept.id and emd1.type='Deletion' and emd1.dept is not null),emd1.files from emd1,
            dept where dept.id=emd1.dept and emd1.dept=$dept  group by dept.dname,emd1.files,dept.id");
              return $query1->result();
          }
          public function getemd_directorate($dept) {
            $query1 =  $this->db->query("select directorate.name as dname,(select count(emd1.name) as joined from emd1 where
             emd1.directorate=directorate.id and emd1.type='New User' and emd1.directorate is not null),(select count(emd1.name) 
             as transferred from emd1 where emd1.directorate=directorate.id and emd1.type='Modification' and  emd1.directorate is 
             not null),(select count(emd1.name) as retired from emd1 where emd1.directorate=directorate.id and emd1.type='Deletion'
              and emd1.directorate is not null),emd1.files from emd1,directorate where directorate.id=emd1.directorate and 
              emd1.directorate=$dept  group by directorate.name,emd1.files,directorate.id");
              return $query1->result();
          }

          public function getemd_district($dept) {
            $query1 =  $this->db->query("select district.name as dname,(select count(emd1.name) as joined from emd1 where
             emd1.district=district.id and emd1.type='New User' and emd1.district is not null),(select count(emd1.name) 
             as transferred from emd1 where emd1.district=district.id and emd1.type='Modification' and  emd1.district is 
             not null),(select count(emd1.name) as retired from emd1 where emd1.district=district.id and emd1.type='Deletion'
              and emd1.district is not null),emd1.files from emd1,district where district.id=emd1.district and 
              emd1.district=$dept  group by district.name,emd1.files,district.id");
              return $query1->result();
          }
          public function getemd_spoffice($dept) {
            $query1 =  $this->db->query("select spoffice.name as dname,(select count(emd1.name) as joined from emd1 where
             emd1.spoffice=spoffice.id and emd1.type='New User' and emd1.spoffice is not null),(select count(emd1.name) 
             as transferred from emd1 where emd1.spoffice=spoffice.id and emd1.type='Modification' and  emd1.spoffice is 
             not null),(select count(emd1.name) as retired from emd1 where emd1.spoffice=spoffice.id and emd1.type='Deletion'
              and emd1.spoffice is not null),emd1.files from emd1,spoffice where spoffice.id=emd1.spoffice and 
              emd1.spoffice=$dept  group by spoffice.name,emd1.files,spoffice.id");
              return $query1->result();
          }




        public function getallemddepartmental($dept) {
            $query1 =  $this->db->query("select dept.dname as dname,(select count(emd1.name) as joined from emd1 where emd1.dept=dept.id and emd1.type='New User'),(select count(emd1.name) as transferred from emd1 where emd1.dept=dept.id and emd1.type='Modification'),(select count(emd1.name) as retired from emd1 where emd1.dept=dept.id and emd1.type='Deletion'),emd1.files from emd1,dept where dept.id=emd1.dept and emd1.dept='.$dept.' group by dept.dname,emd1.files,dept.id");
              return $query1->result();
          }

          public function getallemddirectorate($directorate) {
            $query1 =  $this->db->query("select dept.dname as dname,(select count(emd1.name) as joined from emd1 where emd1.dept=dept.id and emd1.type='New User'),(select count(emd1.name) as transferred from emd1 where emd1.dept=dept.id and emd1.type='Modification'),(select count(emd1.name) as retired from emd1 where emd1.dept=dept.id and emd1.type='Deletion'),emd1.files from emd1,dept where dept.id=emd1.dept and emd1.dept='.$dept.' group by dept.dname,emd1.files,dept.id");
            return $query1->result();
          }
    public function getall() {
        
        $query1 = $this->db->query("select trainings.id as id,trainings.title,string_agg(dept.dname,', ' order by dept.dname) as dname,courses.name as course,to_char(starting::DATE,'DD/MM/YYYY') as date,to_char(ending::DATE,'DD/MM/YYYY') as ending,venue.name as venue,trainings.files,trainings.type from trainings left join depttrainings on depttrainings.trainingid=trainings.id left join dept on depttrainings.dname=dept.id left join courses on courses.id=trainings.course left join venue on trainings.venue=venue.id left join trainingtype on trainings.type=trainingtype.name group by trainings.title,courses.name,venue.name,starting,trainings.id,trainings.type");
        return $query1->result();
    }

    public function getallemdtotal() {
        $this->db->select('emd1.id as id,emd1.name as name,emd1.designation,emd1.email,dept.dname as dname,directorate.name as directorate,district.name as district,spoffice.name as spoffice,emd1.type,emd1.files');
        $this->db->from('emd1');
        $this->db->join('dept','dept.id=emd1.dept','left');
        $this->db->join('directorate','directorate.id=emd1.directorate','left');
        $this->db->join('district','district.id=emd1.district','left');
        $this->db->join('spoffice','spoffice.id=emd1.spoffice','left');
        $query = $this->db->get();
        return $query->result();
    }
    public function getallemdtotaldepartmental($dept) {
        $this->db->select('emd1.id as id,emd1.name as name,emd1.designation,emd1.email,dept.dname as dname,emd1.directorate as directorate,emd1.district,emd1.spoffice,emd1.type,emd1.files');
        $this->db->from('emd1');
        $this->db->join('dept','dept.id=emd1.dept');
        
        $this->db->where('emd1.dept',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    public function getallemdtotaldirectorates($dept) {
        $this->db->select('emd1.id as id,emd1.name as name,emd1.designation,emd1.email,emd1.dept as dname,directorate.name as 
        directorate,emd1.district,emd1.spoffice,emd1.type,emd1.files');
        $this->db->from('emd1');
        $this->db->join('directorate','directorate.id=emd1.directorate');
        $this->db->where('emd1.directorate',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getallemdtotaldistricts($dept) {
        $this->db->select('emd1.id as id,emd1.name as name,emd1.designation,emd1.email,emd1.dept as dname,
        emd1.directorate as directorate,district.name as district,emd1.spoffice,emd1.type,emd1.files');
        $this->db->from('emd1');
        
        $this->db->join('district','district.id=emd1.district');
        $this->db->where('emd1.district',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    public function getallemdtotalspoffice($dept) {
        $this->db->select('emd1.id as id,emd1.name as name,emd1.designation,emd1.email,emd1.dept as dname,
        emd1.directorate as directorate,emd1.district,spoffice.name as spoffice,emd1.type,emd1.files');
        $this->db->from('emd1');
   
        $this->db->join('spoffice','spoffice.id=emd1.spoffice');
        $this->db->where('emd1.spoffice',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    public function getallemdtotaldirectorate($directorate) {
        $this->db->select('emd1.id as id,emd1.name as name,emd1.designation,emd1.email,dept.dname as dname,directorate.name as directorate,emd1.type,emd1.files');
        $this->db->from('emd1');
        $this->db->join('dept','dept.id=emd1.dept');
        $this->db->join('directorate','directorate.id=emd1.directorate');
        $this->db->where('emd1.directorate',$directorate);
        $query = $this->db->get();
        return $query->result();
    }

    public function getalldepartmental($d) {
        
       $query = $this->db->query("select  trainings.id as id,trainings.title as title,to_char(starting::DATE, 'dd/mm/yyyy') as date,to_char(ending::DATE,'dd/mm/yyyy') as end,trainings.type as type,trainings.files,courses.name as course,venue.name as venue
       from trainings left join depttrainings on 
       depttrainings.trainingid=trainings.id  left join dept on 
        dept.id=depttrainings.dname left join courses on courses.id=trainings.course left join
       venue on venue.id=trainings.venue
       where depttrainings.dname=$d and trainings.type!='Combined' group by trainings.title,starting,type,files,courses.name,venue.name,trainings.id");
        return $query->result();

    }
    public function getalldirectorate($d) {
        
        $this->db->select("trainings.id as id,trainings.title,courses.name as course,to_char(starting::DATE,'dd/mm/yyyy') as date, to_char(ending::DATE,'dd/mm/yyyy') as end,venue.name as venue,trainings.files,trainings.type");
        $this->db->from('trainings');
        $this->db->join('depttrainings','depttrainings.trainingid=trainings.id','left');
        $this->db->join('courses','courses.id=trainings.course','left');
        $this->db->join('venue','venue.id=trainings.venue','left');
        $this->db->where('depttrainings.directorate',$d);
        $this->db->where("trainings.type!='Combined'");
        $this->db->group_by(array("trainings.title","courses.name","venue.name","starting","trainings.id"));
        $query1 = $this->db->get();
        return $query1->result();

    }
    public function getalldistrict($d) {
        
        $this->db->select("trainings.id as id,trainings.title,courses.name as course,to_char(starting::DATE,'dd/mm/yyyy') as date, to_char(ending::DATE,'dd/mm/yyyy') as end,venue.name as venue,trainings.files,trainings.type");
        $this->db->from('trainings');
        $this->db->join('depttrainings','depttrainings.trainingid=trainings.id','left');
        $this->db->join('courses','courses.id=trainings.course','left');
        $this->db->join('venue','venue.id=trainings.venue','left');
        $this->db->where('depttrainings.district',$d);
        $this->db->where("trainings.type!='Combined'");
        $this->db->group_by(array("trainings.title","courses.name","venue.name","starting","trainings.id"));
        $query1 = $this->db->get();
        return $query1->result();

    }
    public function getallspoffice($d) {
        
        $this->db->select("trainings.id as id,trainings.title,courses.name as course,to_char(starting::DATE,'dd/mm/yyyy') as date, to_char(ending::DATE,'dd/mm/yyyy') as end,venue.name as venue,trainings.files,trainings.type");
        $this->db->from('trainings');
        $this->db->join('depttrainings','depttrainings.trainingid=trainings.id','left');
        $this->db->join('courses','courses.id=trainings.course','left');
        $this->db->join('venue','venue.id=trainings.venue','left');
        $this->db->where('depttrainings.spoffice',$d);
        $this->db->where("trainings.type!='Combined'");
        $this->db->group_by(array("trainings.title","courses.name","venue.name","starting","trainings.id"));
        $query1 = $this->db->get();
        return $query1->result();

    }
    public function get_by_id_programme($id)
    {
        $this->db->select('title,id,date(starting) as starting,date(ending) as ending,course,venue,files,trainings.type,trainings.files');
        $this->db->from('trainings');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_programme($data)
    {
        $this->db->insert('trainings', $data);
        return $this->db->insert_id();
    }

 
    public function update_programme($where, $data)
    {
        $this->db->update('trainings', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_programme($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('trainings');
    }

    public function getfilterTrainingsDepartmental($dept) {
        $query = $this->db->query("select distinct trainings.title,trainings.id from trainings left join 
        depttrainings on depttrainings.trainingid=trainings.id  where 
        depttrainings.dname=$dept and trainings.type='Departmental'");
        return $query->result();
    }
    public function getDTrainings($dept) {
        $query = $this->db->query("select distinct trainings.title,trainings.id from trainings left join 
        depttrainings on depttrainings.trainingid=trainings.id left join district on district.id=depttrainings.district where 
        district.id=$dept and trainings.type='District'");
        return $query->result();
    }
    public function getSPTrainings($dept) {
        $query = $this->db->query("select distinct trainings.title,trainings.id from trainings left join 
        depttrainings on depttrainings.trainingid=trainings.id left join spoffice on spoffice.id=depttrainings.spoffice where 
        spoffice.id=$dept and trainings.type='SP Office'");
        return $query->result();
    }
   

    public function getfilterTrainingsD($directorate) {
        $query = $this->db->query("select distinct trainings.title,trainings.id from trainings left join depttrainings 
        on depttrainings.trainingid=trainings.id left join directorate on depttrainings.directorate=directorate.id 
    where directorate.id=$directorate and trainings.type='Directorates'");
        return $query->result();
    } 

    public function getCombinedTrainingsdepartmental($dept) {
        $query = $this->db->query("select distinct trainings.title,trainings.id from trainings left join depttrainings on 
        trainings.id=depttrainings.trainingid left join dept on dept.id=depttrainings.dname  left join directorate on
         directorate.id=depttrainings.directorate where dept.id=$dept and 
        trainings.type='Combined'");
        return $query->result();
    }

    public function getCombinedTrainingsDirectorate($directorate) {
        $query = $this->db->query("select distinct trainings.title,trainings.id from trainings left join depttrainings on 
        depttrainings.trainingid=trainings.id left join directorate on depttrainings.directorate=directorate.id
        where directorate.id=$directorate and trainings.type='Combined'");
        return $query->result();
    }

    public function getallparticipants() 
    {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,dept.dname as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join dept on dept.id=participation.dept");
        return $query->result();

    }
    public function getallparticipants_departmental() 
    {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,dept.dname as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join dept on dept.id=participation.dept where trainings.type=
        'Departmental'");
        return $query->result();

    }
    public function getallparticipantsdepartmental1($dept) 
    {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,dept.dname as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join dept on dept.id=participation.dept where trainings.type=
        'Departmental' and participation.dept=$dept");
        return $query->result();

    }

    public function getallparticipant_dept($dept) {
        $query = $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,directorate.name as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join directorate on directorate.id=participation.direct left join
        dept on dept.id= directorate.dept where trainings.type= 'Directorates' and dept.id=$dept");
        return $query->result();
    }

    public function getallparticipant_directorate($directorate) {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,directorate.name as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join directorate on directorate.id=participation.direct where trainings.type=
        'Directorates' and participation.direct='$directorate'");
        return $query->result();

    }

    public function getallparticipants_directorate() 
    {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,directorate.name as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join directorate on directorate.id=participation.direct where trainings.type=
        'Directorates'");
        return $query->result();

    }
    public function getallparticipants_district() 
    {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,district.name as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join district on district.id=participation.dist where trainings.type=
        'District'");
        return $query->result();

    }
    public function getallparticipants_spoffice() 
    {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,spoffice.name as dept,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join spoffice on spoffice.id=participation.spofc where trainings.type=
        'SP Office'");
        return $query->result();

    }
    public function getallparticipants_combined() 
    {
        $query= $this->db->query("select participation.id,trainings.title as title,participation.name,participation.email,participation.phone,participation.designation as designation,dept.dname as dept,directorate.name as directorate,district.name as district,spoffice.name as spoffice,participation.type as type from participation left join trainings on trainings.id=participation.trainingsid left join spoffice on spoffice.id=participation.spofc  left join directorate on directorate.id=participation.direct left join dept on participation.dept=dept.id or directorate.dept=dept.id left join district on district.id=participation.dist where trainings.type=
        'Combined'");
        return $query->result();

    }

    public function get_by_id_participant($id)
    {
        $this->db->select('participation.name,participation.trainingsid as training,participation.email,participation.phone,participation.dept,participation.id,participation.designation');
        $this->db->from('participation');
        $this->db->join('trainings','trainings.id=participation.trainingsid','left');
        $this->db->join('dept','dept.id=participation.dept','left');
        $this->db->where('participation.id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_participant($data)
    {
        $this->db->insert('participation', $data);
        return $this->db->insert_id();
    }
 

    public function update_participant($where, $data)
    {
        $this->db->update('participation', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_participant($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('participation');
    }

    function count_filtered_participants()
{
    
        $query = $this->db->get('participation');
        return $query->num_rows();
    }
 
    public function count_all_participants()
    {
        $this->db->from('participation');
        return $this->db->count_all_results();
    }

    public function getTrainings1() {
        $query = $this->db->query("select id,title from trainings where not exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type='Departmental'");
        return $query->result();
    }
    public function getTrainings2() {
        $query = $this->db->query("select id,title from trainings where not exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type='Directorates'");
        return $query->result();
    }
    public function getTrainings3() {
        $query = $this->db->query("select id,title from trainings where not exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type='District'");
        return $query->result();
    }
    public function getTrainings4() {
        $query = $this->db->query("select id,title from trainings where not exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type='SP Office'");
        return $query->result();
    }
    public function getTrainings5() {
        $query = $this->db->query("select id,title from trainings where not exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type='Combined'");
        return $query->result();
    }
   
    var $table1 = 'designation';
    var $column_order1 = array('name',null); //set column field database for datatable orderable
    var $column_search1 = array('name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order1 = array('name' => 'asc'); // default order 
 
   
    private function _get_datatables_query_designation()
    {
         
        $this->db->from($this->table1);
 
        $i = 0;
     
        foreach ($this->column_search1 as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search1) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order1))
        {
            $order1 = $this->order1;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }
 
    function get_datatables_designation()
    {
        $this->_get_datatables_query_designation();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_designation()
    {
        $this->_get_datatables_query_designation();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_designation()
    {
        $this->db->from($this->table1);
        return $this->db->count_all_results();
    }
 
    public function get_by_id_designation($id)
    {
        $this->db->from($this->table1);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
    public function get_by_id_emd($id)
    {

        
        $this->db->select('emd1.name,designation,email,type,files,emd1.dept as dept,emd1.directorate as directorate,emd1.id');
        $this->db->from('emd1');
        $this->db->join('dept','dept.id=emd1.dept','left');
        $this->db->join('directorate','directorate.id=emd1.directorate','left');
        $this->db->where('emd1.id',$id);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_details_emd($id)
    {

        
        $this->db->select('emd1.name,designation,email,type,files,emd1.id');
        $this->db->from('emd1');
        $this->db->where('emd1.id',$id);
        $query = $this->db->get();
        return $query->row();
    }
 
    public function save_designation($data)
    {
        $this->db->insert($this->table1, $data);
        return $this->db->insert_id();
    }
    public function save_emd($data)
    {
        $this->db->insert('emd1', $data);
        return $this->db->insert_id();
    }
    public function checkEmd($email) {
        $this->db->where('email',$email);
        $result = $this->db->get('emd1');
        return $result;
        
    }
 
    public function update_designation($where, $data)
    {
        $this->db->update($this->table1, $data, $where);
        return $this->db->affected_rows();
    }
    public function update_emd($where, $data)
    {
        $this->db->update('emd1', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_designation($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table1);
    }
    public function delete_by_id_emd($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('emd1');
    }

    
    public function getAll_venue() {
        $this->db->select('*');
        $this->db->from('venue');
        $this->db->order_by('name','asc');
        $query = $this->db->get();
        return $query->result();
    }


    function count_filtered_venue()
    {
       $query = $this->db->query("select * from venue");
        
        return $query->num_rows();
    }
 
    public function count_all_venue()
    {
        $this->db->from('venue');
        return $this->db->count_all_results();
    }
 
    public function get_by_id_venue($id)
    {
        $this->db->from('venue');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_venue($data)
    {
        $this->db->insert('venue', $data);
        return $this->db->insert_id();
    }
 
    public function update_venue($where, $data)
    {
        $this->db->update('venue', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_venue($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('venue');
    }


    public function getAll_department() {
        $this->db->select('id,dname as name');
        $this->db->from('dept');
        $this->db->order_by('dname','asc');
        $query = $this->db->get();
        return $query->result();
    }


    function count_filtered_department()
    {
       $query = $this->db->query("select * from dept");
        
        return $query->num_rows();
    }
 
    public function count_all_department()
    {
        $this->db->from('dept');
        return $this->db->count_all_results();
    }
 
    public function get_by_id_department($id)
    {
        $this->db->from('dept');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_department($data)
    {
        $this->db->insert('dept', $data);
        return $this->db->insert_id();
    }
 
    public function update_department($where, $data)
    {
        $this->db->update('dept', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_department($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('dept');
    }



    public function getAll_district() {
        $this->db->select('*');
        $this->db->from('district');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();
    }


    function count_filtered_district()
    {
       $query = $this->db->query("select * from district");
        
        return $query->num_rows();
    }
 
    public function count_all_district()
    {
        $this->db->from('district');
        return $this->db->count_all_results();
    }
 
    public function get_by_id_district($id)
    {
        $this->db->from('district');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_district($data)
    {
        $this->db->insert('district', $data);
        return $this->db->insert_id();
    }
 
    public function update_district($where, $data)
    {
        $this->db->update('district', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_district($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('district');
    }

    public function getAll_spoffice() {
        $this->db->select('*');
        $this->db->from('spoffice');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();
    }


    function count_filtered_spoffice()
    {
       $query = $this->db->query("select * from spoffice");
        
        return $query->num_rows();
    }
 
    public function count_all_spoffice()
    {
        $this->db->from('spoffice');
        return $this->db->count_all_results();
    }
 
    public function get_by_id_spoffice($id)
    {
        $this->db->from('spoffice');
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_spoffice($data)
    {
        $this->db->insert('spoffice', $data);
        return $this->db->insert_id();
    }
 
    public function update_spoffice($where, $data)
    {
        $this->db->update('spoffice', $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_spoffice($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('spoffice');
    }

    function checkcourse($name) {
        $this->db->where('name',$name);
        
       
        $result = $this->db->get('courses');
        return $result;
    }
    function checkparticipant($email,$title) {
        $this->db->where('email',$email);
        $this->db->where('trainingsid', $title);
        
       
        $result = $this->db->get('participation');
        return $result;
    }
    function checkTraining($title,$course) {
        $this->db->where('title',$title);
        $this->db->where('course', $course);       
       
        $result = $this->db->get('trainings');
        return $result;
    }
    function checkDesignation($name) {
        $this->db->where('name',$name);
         
       
        $result = $this->db->get('designation');
        return $result;
    }
    function checkVenue($name) {
        $this->db->where('name',$name);
         
       
        $result = $this->db->get('venue');
        return $result;
    }
    function checkDepartment($name) {
        $this->db->where('dname',$name);
         
       
        $result = $this->db->get('dept');
        return $result;
    }
    function checkDepartment1($dept) {
        $this->db->select('dname');
        $this->db->from('dept');
        $this->db->where('id',$dept);
         
       
        $query = $this->db->get();
        $result = $query->row();
        return $result->dname;
    }
    function check($d) {
        $this->db->select('id');
        $this->db->from('dept');
        $this->db->where('dname',$d);
         
       
        $query = $this->db->get();
        $result = $query->row();
        return $result->id;
    }
    function checkDirec($d) {
        $this->db->select('id');
        $this->db->from('directorate');
        $this->db->where('name',$d);
         
       
        $query = $this->db->get();
        $result = $query->row();
        return $result->id;
    }
    function checkDist($d) {
        $this->db->select('id');
        $this->db->from('district');
        $this->db->where('name',$d);
         
       
        $query = $this->db->get();
        $result = $query->row();
        return $result->id;
    }

    function checkSPofc($d) {
        $this->db->select('id');
        $this->db->from('spoffice');
        $this->db->where('name',$d);
         
       
        $query = $this->db->get();
        $result = $query->row();
        return $result->id;
    }

    


    function checkDirectorate($directorate) {
        $this->db->select('name');
        $this->db->from('directorate');
        $this->db->where('id',$directorate);
         
       
        $query = $this->db->get();
        $result = $query->row();
        return $result->name;
    }

    function getallparticipants_combinedDepartment($dept) {
       $query = $this->db->query("select participation.name as name,trainings.title as title,directorate.name as directorate,dept.dname as dept,participation.email as email,
       participation.phone,participation.type,participation.dist as district,participation.spofc as spoffice,participation.id,participation.designation
        from trainings left join participation on participation.trainingsid=trainings.id
       left join directorate on directorate.id=participation.direct
       left join dept on dept.id=directorate.dept or dept.id=participation.dept where directorate.dept=$dept or participation.dept=$dept and trainings.type='Combined'");
       return $query->result();
    }

    function getallparticipants_combinedDirectorate($result) {
        $query = $this->db->query("select participation.name as name,trainings.title as title,directorate.name as directorate,dept.dname as dept,participation.email as email,
        participation.phone,participation.type,participation.dist as district,participation.spofc as spoffice,participation.id,participation.designation
         from trainings left join participation on participation.trainingsid=trainings.id
        left join directorate on directorate.id=participation.direct
        left join dept on dept.id=directorate.dept or dept.id=participation.dept where  participation.direct=$result and trainings.type='Combined'");
             return $query->result();
    }

    function checkDistrict($name) {
        $this->db->where('name',$name);
         
       
        $result = $this->db->get('district');
        return $result;
    }

    function checkSPOffice($name) {
        $this->db->where('name',$name);
         
       
        $result = $this->db->get('spoffice');
        return $result;
    }

    function getfilterTrainings() {
       
        $query = $this->db->query("select trainings.id,trainings.title from trainings where exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type=
        'Departmental'");
        return $query->result();
    }
    function getDirectorateTrainings() {
       
        $query = $this->db->query("select trainings.id,trainings.title from trainings where exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type=
        'Directorates'");
        return $query->result();
    }
    function getDistrictTrainings() {
       
        $query = $this->db->query("select trainings.id,trainings.title from trainings where exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type=
        'District'");
        return $query->result();
    }
    function getSPOfficeTrainings() {
       
        $query = $this->db->query("select trainings.id,trainings.title from trainings where exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type=
        'SP Office'");
        return $query->result();
    }
    function getCombinedTrainings() {
       
        $query = $this->db->query("select trainings.id,trainings.title from trainings where exists (select trainingid from depttrainings where depttrainings.trainingid=trainings.id) and trainings.type=
        'Combined'");
        return $query->result();
    }




 

    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('participation');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("trainingsid", $params)){
                $this->db->where('trainingsid', $params['trainingsid']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('trainingsid', 'desc');
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

    function getRows1($params = array()){
        $this->db->select('*');
        $this->db->from('participation');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("trainingsid", $params)){
                $this->db->where('trainingsid', $params['trainingsid']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('trainingsid', 'desc');
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

    function getRows2($params = array()){
        $this->db->select('*');
        $this->db->from('participation');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("trainingsid", $params)){
                $this->db->where('trainingsid', $params['trainingsid']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('trainingsid', 'desc');
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
    function getRows3($params = array()){
        $this->db->select('*');
        $this->db->from('participation');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("trainingsid", $params)){
                $this->db->where('trainingsid', $params['trainingsid']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('trainingsid', 'desc');
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
    function getRows4($params = array()){
        $this->db->select('*');
        $this->db->from('participation');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("trainingsid", $params)){
                $this->db->where('trainingsid', $params['trainingsid']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('trainingsid', 'desc');
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

    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('participation', $data);
            
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
    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
           
            
            // Update member data
            $update = $this->db->update('participation', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    public function insert1($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('participation', $data);
            
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
            $update = $this->db->update('participation', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    public function insert2($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('participation', $data);
            
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
            $update = $this->db->update('participation', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    public function insert3($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('participation', $data);
            
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
            $update = $this->db->update('participation', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    public function insert4($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('participation', $data);
            
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
    public function update4($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
           
            
            // Update member data
            $update = $this->db->update('participation', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }


    





}




