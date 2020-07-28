<?php

class Ajax_model extends CI_Model {
    public function fetchMemberData() {
        $sql = "SELECT * FROM infrasecretariat";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
}
?>