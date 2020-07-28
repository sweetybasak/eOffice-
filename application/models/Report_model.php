<?php

class Report_model extends CI_Model {

    var $table = 'report';
    var $table1 = 'files';
    var $table2 = 'receipts';
    var $column_order = array('dname','live','filescreated','filesmoved','receiptscreated','receiptsmoved');
    var $column_search = array('report.dept');
    
  

    var $column_order1 = array(null,'deptname','organisation','value1','value2','value3','value4','value5');
    var $column_search1 = array('deptname');
    var $order1 = array('deptname' => 'asc');

    var $column_order2 = array('directorate','live','filescreated','filesmoved','receiptscreated','receiptsmoved');
    var $column_search2 = array('report.directorate');

    var $column_order3 = array('district','live','filescreated','filesmoved','receiptscreated','receiptsmoved');
    var $column_search3 = array('report.district');

    var $column_order4 = array('spoffice','live','filescreated','filesmoved','receiptscreated','receiptsmoved');
    var $column_search4 = array('report.spoffice');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        if($this->input->post('dname')) {
            $this->db->where('report.dept', $this->input->post('dname'));
        }
       
        $this->db->select("dept.dname as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved");
        $this->db->from($this->table);
        $this->db->join('dept','dept.id=report.dept','left');
        $this->db->where('report.dept is not null');
        $this->db->group_by(array("dept.dname","report.live","report.filescreated","report.filesmoved","report.receiptscreated","report.receiptsmoved"));
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



    private function _districtreport()
    {
        if($this->input->post('district')) {
            $this->db->where('report.district', $this->input->post('district'));
        }
       
        $this->db->select("district.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved");
        $this->db->from('district');
        $this->db->join('report','district.id=report.district','left');
        $this->db->where('report.district is not null');
        $this->db->group_by(array("district.name","report.live","report.filescreated","report.filesmoved","report.receiptscreated","report.receiptsmoved"));
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
    private function _spofficereport()
    {
        if($this->input->post('spoffice')) {
            $this->db->where('report.spoffice', $this->input->post('spoffice'));
        }
       
        $this->db->select("spoffice.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved");
        $this->db->from('spoffice');
        $this->db->join('report','spoffice.id=report.spoffice','left');
        $this->db->where('report.spoffice is not null');
        $this->db->group_by(array("spoffice.name","report.live","report.filescreated","report.filesmoved","report.receiptscreated","report.receiptsmoved"));
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

        else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function get_districtreport() {
        $this->_districtreport();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_spofficereport() {
        $this->_spofficereport();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    private function _dreport()
    {
        if($this->input->post('directorate')) {
            $this->db->where('report.directorate', $this->input->post('directorate'));
        }
       
        $this->db->select("directorate.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved");
        $this->db->from('directorate');
        $this->db->join('report','directorate.id=report.directorate','left');
        $this->db->where('report.directorate is not null');
        $this->db->group_by(array("directorate.name","report.live","report.filescreated","report.filesmoved","report.receiptscreated","report.receiptsmoved"));
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

    public function get_directoratereport() {
        $this->_dreport();
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
    public function count_filtered_receipts() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function count_all_receipts() {
        $this->db->from($this->table2);
        return $this->db->count_all_results();
    }

    public function get_list_department() {
        $this->db->select('id,dname');
        $this->db->from('dept');
        $this->db->order_by('dname','asc');
        $this->db->where('dname is not null');
        $query = $this->db->get();
        return $query->result();

       
    }
    public function get_list_district() {
        $this->db->select('id,name');
        $this->db->from('district');
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

    public function getDirectorate() {
        $this->db->select('id,name');
        $this->db->from('directorate');
        $this->db->order_by('name','asc');
        $this->db->where('name is not null');
        $query = $this->db->get();
        return $query->result();

       
    }
    public function getDirectorate1() {
        $this->db->select('id,name');
        $this->db->from('directorate');
        $this->db->order_by('name','asc');
       
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
    public function get_list_designation() {
        $this->db->select('id,name');
        $this->db->from('designation');
        $this->db->order_by('name','asc');
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
    private function _get_datatables_query1()
    {
        if($this->input->post('deptname')) {
            $this->db->where('deptname', $this->input->post('deptname'));
        }
       

        $this->db->from($this->table1);
        $i=0;
        foreach($this->column_search1 as $item) 
        {
            if(isset($_POST['search']['value'])) {
                if($i==0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search1) - 1 == $i)
                $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order1'])) {
            $this->db->order_by($this->column_order1[$_POST['order1']['0']['column']],$_POST['order1']['0']['dir']);

        }

        else if(isset($this->order1)) {
            $order = $this->order1;
            $this->db->order_by(key($order1), $order1[key($order1)]);
        }
    }

    public function get_datatables1() {
        $this->_get_datatables_query1();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered1() {
        $this->_get_datatables_query1();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all1() {
        $this->db->from($this->table1);
        return $this->db->count_all_results();
    }

   
   public function get_list_directorate($dept) {
       $this->db->select("*");
       $this->db->from('directorate');
       $this->db->where('dept',$dept);
       $this->db->or_where('name is null');
      
       $query = $this->db->get();
       return $query->result();
   }
    public function getAll() {
        $this->db->select("dept.dname as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.dept as dept");
        $this->db->from('report');
        $this->db->join('dept','dept.id=report.dept');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAlldirectorate() {
        $this->db->select("directorate.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.directorate as directorate");
        $this->db->from('report');
        $this->db->join('directorate','directorate.id=report.directorate');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllcommissionerates($dept) {
        $this->db->select("directorate.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.directorate as directorate");
        $this->db->from('report');
        $this->db->join('directorate','directorate.id=report.directorate');
        $this->db->where('directorate',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAlldirectoratedept($dept) {
        $this->db->select("directorate.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.directorate as directorate");
        $this->db->from('report');
        $this->db->join('directorate','directorate.id=report.directorate');
        $this->db->join('dept','dept.id=directorate.dept');
        $this->db->where('directorate.dept',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAlldistrict() {
        $this->db->select("district.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.district as district");
        $this->db->from('report');
        $this->db->join('district','district.id=report.district');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllspoffice() {
        $this->db->select("spoffice.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.spoffice as spoffice");
        $this->db->from('report');
        $this->db->join('spoffice','spoffice.id=report.spoffice');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllDistricts($dept) {
        $this->db->select("district.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.district as district");
        $this->db->from('report');
        $this->db->join('district','district.id=report.district');
        $this->db->where('district',$dept);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAlldepartmental($dept) {
        $this->db->select("dept.dname as dname,to_char(live::DATE,'DD/MM/YYYY') as live,filescreated,filesmoved,receiptscreated,receiptsmoved,report.dept as dept");
        $this->db->from('report');
        $this->db->join('dept','dept.id=report.dept');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query->result();
    }
    public function getFiles($dept) {
        $this->db->select('organisation,value1,value2,value3,value4,value5');
        $this->db->from('files');
        $this->db->join('dept','dept.id=files.dept');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAll_files() {
        $this->db->select("dept.dname as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,files.dept as dept");
        $this->db->from('files');
        $this->db->join('dept','dept.id=files.dept');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAll_filesdirectorate() {
        $this->db->select("directorate.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,files.directorate as dept");
        $this->db->from('files');
        $this->db->join('directorate','directorate.id=files.directorate');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAll_filesdistrict() {
        $this->db->select("district.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,files.district as dept");
        $this->db->from('files');
        $this->db->join('district','district.id=files.district');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAll_filesspoffice() {
        $this->db->select("spoffice.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,files.spoffice as dept");
        $this->db->from('files');
        $this->db->join('spoffice','spoffice.id=files.spoffice');
        $query = $this->db->get();
        return $query->result();
    }
   
    public function getAll_receipts() {
        $this->db->select("dept.dname as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,receipts.dept as dept");
        $this->db->from('receipts');
        $this->db->join('dept','dept.id=receipts.dept');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAll_receiptsdirectorate() {
        $this->db->select("directorate.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,receipts.directorate as dept");
        $this->db->from('receipts');
        $this->db->join('directorate','directorate.id=receipts.directorate');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAll_receiptsdistrict() {
        $this->db->select("district.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,receipts.district as dept");
        $this->db->from('receipts');
        $this->db->join('district','district.id=receipts.district');
        $query = $this->db->get();
        return $query->result();
    }
    public function getAll_receiptsspoffice() {
        $this->db->select("spoffice.name as dname,to_char(live::DATE,'DD/MM/YYYY') as live,organisation,value1,value2,value3,value4,value5,receipts.spoffice as dept");
        $this->db->from('receipts');
        $this->db->join('spoffice','spoffice.id=receipts.spoffice');
        $query = $this->db->get();
        return $query->result();
    }
    
    
   
    public function delete_by_id($dept)
    {
        $this->db->where('dept', $dept);
        $this->db->delete($this->table);
    }


    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('report');
        
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

    function getRows3($params = array()){
        $this->db->select('*');
        $this->db->from('report');
        
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

    public function insert4($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('report', $data);
            
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
            $update = $this->db->update('report', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    function getRows4($params = array()){
        $this->db->select('*');
        $this->db->from('report');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("district", $params)){
                $this->db->where('district', $params['directorate']);
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
    function getRows5($params = array()){
        $this->db->select('*');
        $this->db->from('report');
        
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

    public function insert5($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('report', $data);
            
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
            $update = $this->db->update('report', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    public function getfilependency($dept) {
        $this->db->select("*,to_char(live::DATE,'DD/MM/YYYY') as live");
        $this->db->from('files');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query->result();

    } 
    public function getfilependencyspoffice($spoffice) {
        $this->db->select("*,to_char(live::DATE,'DD/MM/YYYY') as live");
        $this->db->from('files');
        $this->db->where('spoffice',$spoffice);
        $query = $this->db->get();
        return $query->result();

    }
    public function getfilependency1($directorate) {
        $query = $this->db->query("select *,to_char(live::DATE,'DD/MM/YYYY') as live from files where directorate=$directorate");
        return $query->result();

    }
    public function getfilependency2($directorate) {
        $query = $this->db->query("select *,to_char(live::DATE,'DD/MM/YYYY') as live from files where district=$directorate");
        return $query->result();

    }
    public function getreceiptpendency2($dept) {
        $this->db->select("*,to_char(live::DATE,'DD/MM/YYYY') as live");
        $this->db->from('receipts');
        $this->db->where('district',$dept);
        $query = $this->db->get();
        return $query->result();

    }
    public function getreceiptpendency($dept) {
        $this->db->select("*,to_char(live::DATE,'DD/MM/YYYY') as live");
        $this->db->from('receipts');
        $this->db->where('dept',$dept);
        $query = $this->db->get();
        return $query->result();

    }
   
    public function getreceiptpendencyspoffice($spoffice) {
        $this->db->select("*,to_char(live::DATE,'DD/MM/YYYY') as live");
        $this->db->from('receipts');
        $this->db->where('spoffice',$spoffice);
        $query = $this->db->get();
        return $query->result();

    }
    public function getreceiptpendency1($directorate) {
        $query = $this->db->query("select *,to_char(live::DATE,'DD/MM/YYYY') as live from receipts where directorate=$directorate");
        return $query->result();

    }
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('report', $data);
            
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
            $update = $this->db->update('report', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    
    function getRows1($params = array()){
        $this->db->select('*');
        $this->db->from('files');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("organisation", $params)){
                $this->db->where('organisation', $params['organisation']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('organisation', 'desc');
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
    public function insert1($data) {
        
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('files', $data);
            
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
            $update = $this->db->update('files', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    public function delete_by_id1($organisation)
    {
        $this->db->where('organisation', $organisation);
        $this->db->delete($this->table1);
    }

   
    function getRows2($params = array()){
        $this->db->select('*');
        $this->db->from('receipts');
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("organisation", $params)){
                $this->db->where('organisation', $params['organisation']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('organisation', 'desc');
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
    public function insert3($data) {
        
        if(!empty($data)){
            // Add created and modified date if not included
           
            // Insert member data
            $insert = $this->db->insert('receipts', $data);
            
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
            $update = $this->db->update('receipts', $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    public function delete_by_id2($organisation)
    {
        $this->db->where('organisation', $organisation);
        $this->db->delete($this->table2);
    }

   


   

   
    
}
?>