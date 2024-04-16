<?php

class Location_model extends CI_Model
{

    function get_all_location()
    {
        $this->db->where('isCancel', 'no');
        $query = $this->db->get('location');
        $procat = $query->result();

        return $procat;
    }

    public function insert_added_location()
    {
        $location = (string) $this->input->post('location');

        $data = array(
            'location' => $location,
        );

        $response = $this->db->insert('location', $data);

        if ($response) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    public function update_added_location()
    {
        $location_id = (int) $this->input->post('location_id');
        $location = (string) $this->input->post('location');

        $data = array(
            'location' => $location,
        );

        $this->db->where('location_id', $location_id);
        $response = $this->db->update('location', $data);

        if ($response) {
            return $location_id;
        } else {
            return FALSE;
        }
    }
    public function get_location($location_id)
    {
        $this->db->where('location_id', $location_id);
        $query = $this->db->get('location');
        $row = $query->row();

        return $row;
    }

    public function delete_location($id)
    {
        $data = array(
            'IsCancel' => 'Yes'
        );
        $this->db->where('location_id', $id);
        $response = $this->db->update('location', $data);
        if ($response) {
            return $id;
        } else {
            return false;
        }
    }
}
