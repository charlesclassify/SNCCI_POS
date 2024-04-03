<?php

class User_model extends CI_Model
{

	function insertuser($data)
	{
		$this->db->insert('user', $data);
	}

	function get_all_users()
	{
		$this->db->where('isDelete', 'no');
		$query = $this->db->get('user');
		$result = $query->result();

		return $result;
	}
	function insert1()
	{
		$username = (string) $this->input->post('username');
		$first_name = (string) $this->input->post('first_name');
		$last_name = (string) $this->input->post('last_name');
		$password = (string) $this->input->post('password');
		$warehouse = (string) $this->input->post('warehouse');
		$role = (string) $this->input->post('role');

		$data = array(
			'username' => $username,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'password' => sha1($password),
			'warehouse' => $warehouse,
			'role' => $role,
			'status' => 'active'
		);

		$response = $this->db->insert('user', $data);

		if ($response) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	function get_users($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('user');
		$row = $query->row();

		return $row;
	}
	function update_user()
	{
		$user_id = (int) $this->input->post('user_id');

		$username = (string) $this->input->post('username');
		$first_name = (string) $this->input->post('first_name');
		$last_name = (string) $this->input->post('last_name');
		$password = (string) $this->input->post('password');
		$warehouse = (string) $this->input->post('warehouse');
		$role = (string) $this->input->post('role');


		$data = array(
			'username' => $username,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'password' => sha1($password),
			'warehouse' => $warehouse,
			'role' => $role,
		);

		$this->db->where('user_id', $user_id);

		$response = $this->db->update('user', $data);

		if ($response) {
			return $user_id;
		} else {
			return FALSE;
		}
	}

	function checkPassword($password, $username)
	{
		// Hash the input password using SHA1
		$hashed_password = sha1($password);

		// Retrieve user from database by username and hashed password
		$query = $this->db->query("SELECT * FROM user WHERE username = ? AND password = ?", array($username, $hashed_password));

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function deactivate_user($user_id)
	{
		$data = array(
			'status' => 'deactivated',
		);

		$this->db->where('user_id', $user_id);

		$response = $this->db->update('user', $data);

		if ($response) {
			return $user_id;
		} else {
			return FALSE;
		}
	}

	public function reactivate_user($user_id)
	{
		$data = array(
			'status' => 'active',
		);

		$this->db->where('user_id', $user_id);

		$response = $this->db->update('user', $data);

		if ($response) {
			return $user_id;
		} else {
			return FALSE;
		}
	}
}
