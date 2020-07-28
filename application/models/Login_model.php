<?php 

class Login_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

   function validate($email,$password) {
       $this->db->select('*');
       $this->db->where('email',$email);
       $this->db->where('password',$password);
      
       $result = $this->db->get('employee',1);
       return $result;
   }

   public function setSession($email,$sessionId) {
    $oldSessionId =  $this->db->select("session_id")
                       ->where(array('email' => $email))
                         ->get("employee")
                         ->row('session_id');

                       

    $this->db->where('id', $oldSessionId);
    $this->db->delete('ci_sessions');

    $this->db->where('email',$email);
    $this->db->update('employee',array('session_id'=>$sessionId));
   }

   public function unsetSession($email) {

    $this->db->where('email',$email);
    $this->db->update('employee',array('session_id'=> null));
   }
}