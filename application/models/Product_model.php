<?php

class Product_model extends CI_Model
{

	/*function product_code()
	{
		$year = date('Y');

		$prefix = "P-";

		$query =  $this->db->query("SELECT max(product_code) as max_product_code FROM product where product_code LIKE '{$prefix}%'");
		$result = $query->row();


		if ($result->max_product_code) {
			$next_product_code = ++$result->max_product_code;
		} else {
			$next_product_code = $prefix . '0001';
		}
		return $next_product_code;
	}*/

	function insert_product()
	{
		$product_code = (string) $this->input->post('product_code');
		$product_name = (string) $this->input->post('product_name');
		$product_brand =  $this->input->post('product_brand');
		$product_category = (string) $this->input->post('product_category');
		$supplier_id = (string) $this->input->post('supplier_id');
		$product_minimum_quantity = (string) $this->input->post('product_minimum_quantity');
		$product_uom =  $this->input->post('product_uom');
		$product_barcode =  $this->input->post('product_barcode');
		$product_price =  $this->input->post('product_price');

		$data = array(
			'product_code' => $product_code,
			'product_brand' => $product_brand,
			'product_name' => $product_name,
			'product_dateadded' => date('Y-m-d H:i:s'),
			'product_category' => $product_category,
			'product_uom' => $product_uom,
			'supplier_id' => $supplier_id,
			'product_barcode' => $product_barcode,
			'product_minimum_quantity' => $product_minimum_quantity,
			'product_price' => $product_price,

		);

		$response = $this->db->insert('product', $data);

		if ($response) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}


	function get_product($product_id)
	{
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('product');
		$row = $query->row();

		return $row;
	}


	function update_product($product_id)
	{
		$product_code = (string) $this->input->post('product_code');
		$product_name = (string) $this->input->post('product_name');
		$product_brand =  $this->input->post('product_brand');
		$product_category = (string) $this->input->post('product_category');
		$supplier_id = (string) $this->input->post('supplier_id');
		$product_minimum_quantity = (string) $this->input->post('product_minimum_quantity');
		$product_uom =  $this->input->post('product_uom');
		$product_barcode =  $this->input->post('product_barcode');
		$product_price =  $this->input->post('product_price');

		// Update product data in the database
		$data = array(
			'product_code' => $product_code,
			'product_brand' => $product_brand,
			'product_name' => $product_name,
			'product_dateadded' => date('Y-m-d H:i:s'),
			'product_category' => $product_category,
			'product_uom' => $product_uom,
			'supplier_id' => $supplier_id,
			'product_barcode' => $product_barcode,
			'product_minimum_quantity' => $product_minimum_quantity,
			'product_price' => $product_price,
		);

		// Update product data
		$this->db->where('product_id', $product_id);
		$response = $this->db->update('product', $data);

		if ($response) {
			return $product_id;
		} else {
			return FALSE;
		}
	}


	function update_barcode($product_id)
	{

		$product_name = (string) $this->input->post('product_name');

		$product_unit = $this->input->post('product_unit[]');
		$product_barcode = $this->input->post('product_barcode[]');


		foreach ($product_unit as $index => $units) {
			$arr_unit = $units;
			$arr_barcode = $product_barcode[$index];

			// Check if the barcode already exists for the given product_id and unit
			$existing_record = $this->db->get_where('barcode', array('product_id' => $product_id, 'unit' => $arr_unit))->row();

			$data_barcode = [
				'unit' => $arr_unit,
				'product_id' => $product_id,
				'product_name' => $product_name,
				'barcode' => $arr_barcode,

			];

			if ($existing_record && $existing_record->product_id === $product_id && $existing_record->unit === $arr_unit) {
				$this->db->where('barcode_id', $existing_record->barcode_id);
				$this->db->update('barcode', $data_barcode);
			} else {
				$this->db->insert('barcode', $data_barcode);
			}
		}

		return $product_id;
	}


	function delete_product($product_id)
	{
		$data = array(
			'isDelete' => 'yes'
		);
		$this->db->where('product_id', $product_id);
		$response = $this->db->update('product', $data);
		if ($response) {
			return $product_id;
		} else {
			return false;
		}
	}

	function get_all_product_category()
	{
		$this->db->where('isCancel', 'no');
		$query = $this->db->get('product_category');
		$procat = $query->result();

		return $procat;
	}

	function get_all_product()
	{
		$this->db->where('isDelete', 'Active'); //MODIFY PAG MA SET NA ANG TAMA NGA TABLE
		$query = $this->db->get('product');
		$result = $query->result();

		return $result;
	}

	/*function Select_one($id)
	{
		$this->db->select('*');
		$this->db->from('product AS pro');
		$this->db->join('suppliers AS supplier', 'pro.supplier_id = supplier.supplier_id', 'left');
		$this->db->where('pro.product_id', $id);
		$query = $this->db->get()->row();
		return $query;
	}*/

	function get_barcode($id)
	{
		$this->db->select('*');
		$this->db->from('barcode AS bar');
		$this->db->join('product AS pro', 'bar.product_id = pro.product_id', 'left');
		$this->db->where('pro.product_id', $id);
		$query = $this->db->get()->row();
		return $query;
	}
	function get_all_barcode()
	{
		$this->db->select('*');
		$this->db->from('barcode');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_total_products()
	{
		// Assuming your table is named 'product'
		$this->db->from('product');
		return $this->db->count_all_results();
	}
	public function getLowStockProductsCount()
	{
		// Calculate the total number of products with low stock
		$this->db->select('COUNT(*) as low_stock_count');
		$this->db->from('product');
		$this->db->where('isDelete', 'no'); // Assuming 'isDelete' is the column for deletion status
		$this->db->where('product_quantity < product_minimum_quantity');
		$query = $this->db->get();

		// Return the result
		return $query->row()->low_stock_count;
	}
	public function getLowStockProducts()
	{
		// Select products where the quantity is less than the inbound threshold
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_quantity < product_minimum_quantity');
		$query = $this->db->get();

		return $query->result();
	}
	public function countOutOfStockProducts()
	{
		// Assuming your product table is named 'product'
		$this->db->from('product');
		$this->db->where('product_quantity', 0);

		return $this->db->count_all_results();
	}


	public function insert_added_product_category()
	{
		$product_category = (string) $this->input->post('product_category');

		$data = array(
			'product_category' => $product_category,
		);

		$response = $this->db->insert('product_category', $data);

		if ($response) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function update_added_product_category()
	{
		$procat_id = (int) $this->input->post('procat_id');
		$product_category = (string) $this->input->post('product_category');

		$data = array(
			'product_category' => $product_category,
		);

		$this->db->where('procat_id', $procat_id);
		$response = $this->db->update('product_category', $data);

		if ($response) {
			return $procat_id;
		} else {
			return FALSE;
		}
	}
	public function get_product_category($procat_id)
	{
		$this->db->where('procat_id', $procat_id);
		$query = $this->db->get('product_category');

		$row = $query->row();

		return $row;
	}

	public function delete_product_category($id)
	{
		$data = array(
			'isCancel' => 'yes'
		);
		$this->db->where('procat_id', $id);
		$response = $this->db->update('product_category', $data);
		if ($response) {
			return $id;
		} else {
			return false;
		}
	}

	public function receiving_no()
	{
		$year = date('Y');
		$text = "RN" . '-' . $year;
		$query = "SELECT max(receiving_no) as code_auto from receiving";
		$data = $this->db->query($query)->row_array();
		if ($data && isset($data["code_auto"])) {
			$max_code = $data['code_auto'];
			$max_code2 =  (int)substr($max_code, 8, 5);
			$codecount = $max_code2 + 1;
			$code_auto = $text . '-' . sprintf('%03s', $codecount);
			return $code_auto;
		} else {
			// Log error or return a default value
			error_log("No existing receiving numbers found.");
			return $text . '-' . sprintf('%03s', 1);
		}
	}

	public function insert_received_quantity($image_file_name)
	{
		$product_id = (int) $this->input->post('product_id');
		$product_quantity = (int) $this->input->post('product_quantity');
		$product_code = $this->input->post('product_code');
		$product_name = $this->input->post('product_name');
		$username = $this->input->post('username');
		$supplier = $this->input->post('supplier');
		$product_uom = $this->input->post('product_uom');
		$comments = $this->input->post('comments');
		$rn = $this->input->post('rn');

		// Get the current product quantity
		$this->db->select('product_quantity');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('product');
		$current_quantity = $query->row()->product_quantity;

		// Calculate the new total quantity
		$new_quantity = $current_quantity + $product_quantity;

		// Update the product quantity in the database
		$this->db->where('product_id', $product_id);
		$response = $this->db->update('product', array('product_quantity' => $new_quantity));

		if ($response) {

			$data = array(
				'receiving_no' => $rn,
				'product_code' => $product_code,
				'product_name' => $product_name,
				'inbound_quantity' => $product_quantity,
				'date' => date('Y-m-d H:i:s'),
				'username' => $username,
				'supplier' => $supplier,
				'product_uom' => $product_uom,
				'comments' => $comments,
				'product_image' => $image_file_name,

			);
			$this->db->where('product_id', $product_id);
			$this->db->insert('receiving', $data);

			$data_inventory_ledger = [
				'product_name' => $product_name,
				'unit' => $product_uom, // Adjust based on your unit information
				'quantity' => $product_quantity, // Negative quantity for sales
				'price' => '0',
				'activity' => 'Inbound', // Adjust based on your activity types
				'date_posted' => date('Y-m-d'), // Adjust based on your date format
			];

			$this->db->insert('inventory_ledger', $data_inventory_ledger);

			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}
	function get_receiving($id)
	{
		$this->db->select('*');
		$this->db->from('receiving');
		$this->db->where('receiving_id', $id);
		$query = $this->db->get()->row();
		return $query;
	}
	function get_all_receiving()
	{
		$this->db->select('*');
		$this->db->from('receiving');
		$query = $this->db->get()->result();
		return $query;
	}
}
