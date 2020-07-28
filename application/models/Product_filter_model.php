<?php 

class Product_filter_model extends CI_Model {
    function fetch_filter_type($type) {
        $this->db->distinct();
        $this->db->select($type);
        $this->db->from('product');
        $this->db->where('product_status', '1');
        return $this->db->get();
    }

    function make_query($minimum_price, $maximum_price, $brand, $ram, $storage) {
        
    }
} 