<?php

class Calendar_model extends CI_Model {

    public function get_events($start,$end) {
        return $this->db->where("starting >=", $start)->where("ending <=", $end)->get("trainings");
    }

    public function add_events($data) {
        $this->db->insert("calendar_events", $data);
    }

    public function get_event($id) {
        return $this->db->where("id", $id)->get("trainings");
    }

    public function update_event($id, $data) {
        $this->db->where("id", $id)->update("trainings", $data);
    }

    public function delete_event($id) {
        $this->db->where("id", $id)->delete("trainings");
    }

   public function fetch_all_event() {
       $this->db->order_by('id');
       return $this->db->get('trainings');
   }

    
}
?>