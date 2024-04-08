<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_ledger_model extends CI_Model
{
    function get_all_ledger()
    {
        $this->db->select('*');
        $this->db->from('inventory_ledger');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_ledger_by_date_range($date_from, $date_to)
    {
        $this->db->select('*');
        $this->db->from('inventory_ledger');
        $this->db->where('date_posted >=', $date_from);
        $this->db->where('date_posted <=', $date_to);
        $query = $this->db->get()->result();
        return $query;
    }

    function get_product_ledger($product_name)
    {
        $this->db->select('*');
        $this->db->from('inventory_ledger');
        $this->db->where('product_name', $product_name);
        $query = $this->db->get()->result();
        return $query;
    }
}
