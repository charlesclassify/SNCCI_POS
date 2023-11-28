<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Main extends CI_Controller
{

	function index()
	{
		$this->load->model('product_model');
		$this->load->model('purchase_order_model');
		$this->data['total_prod'] = $this->product_model->get_total_products();
		$this->data['low_stocks'] = $this->product_model->getLowStockProductsCount();
		$this->data['lowStockProducts'] = $this->product_model->getLowStockProducts();
		$this->data['out_off_stock'] = $this->product_model->countOutOfStockProducts();
		$this->data['pending_po'] = $this->purchase_order_model->getPendingPurchaseOrdersCount();
		$this->data['completed_po'] = $this->purchase_order_model->getReceivedPurchaseOrderCount();
		$this->load->view('main/header');
		$this->load->view('main/dashboard', $this->data);
		$this->load->view('main/footer');
	}




	function user()
	{
		$this->load->model('user_model');
		$this->data['result'] = $this->user_model->get_all_users();
		$this->load->view('main/header');
		$this->load->view('main/user', $this->data);
		$this->load->view('main/footer');
	}

	function add_user()
	{
		$this->add_user_submit();
		$this->load->view('main/header');
		$this->load->view('main/add_user');
		$this->load->view('main/footer');
	}
	function add_user_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[user.username]');
			$this->form_validation->set_rules('first_name', 'first_name', 'trim|required|is_unique[user.first_name]', array('is_unique' => 'The username is already taken.'));
			$this->form_validation->set_rules('last_name', 'last_name', 'trim|required|is_unique[user.last_name]');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
			$this->form_validation->set_rules('role', 'role', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('user_model');
				$response = $this->user_model->insert1();
				if ($response) {
					$success_message = 'User added successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'User was not added.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/user');
			}
		}
	}

	function edit_user($user_id)
	{
		$this->edit_user_submit();
		$this->load->model('user_model');
		$this->data['user'] = $this->user_model->get_users($user_id);

		$this->load->view('main/header');
		$this->load->view('main/edituser', $this->data);
		$this->load->view('main/footer');
	}
	function edit_user_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('password1', 'Confirm New Password', 'required|matches[password]');
			$this->form_validation->set_rules('role', 'role', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('user_model');

				$response = $this->user_model->update_user();

				if ($response) {
					$success_message = 'User updated successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'User was not updated successfully.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/user');
			}
		}
	}
	function deactivate_user($user_id)
	{

		$this->load->model('user_model');

		$response = $this->user_model->deactivate_user($user_id);

		if ($response) {
			$success_message = 'User deactivated successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'User was not deactivated successfully.';
			$this->session->set_flashdata('error', $error_message);
		}
		redirect('main/user');
	}

	function reactivate_user($user_id)
	{

		$this->load->model('user_model');

		$response = $this->user_model->reactivate_user($user_id);

		if ($response) {
			$success_message = 'User activated successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'User was not activated successfully.';
			$this->session->set_flashdata('error', $error_message);
		}
		redirect('main/user');
	}
	function supplier()
	{

		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_all_suppliers();

		$this->load->view('main/header');
		$this->load->view('main/supplier', $this->data);
		$this->load->view('main/footer');
	}
	function add_supplier()
	{
		$this->add_supplier_submit();
		$this->load->view('main/header');
		$this->load->view('main/add_supplier');
		$this->load->view('main/footer');
	}


	function add_supplier_submit()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('supplier_name', 'Supplier', 'trim|required|is_unique[suppliers.supplier_name]');
			$this->form_validation->set_rules('company_name', 'Company', 'trim|required|is_unique[suppliers.company_name]');
			$this->form_validation->set_rules('supplier_contact', 'Contact', 'trim|required|is_unique[suppliers.supplier_contact]');
			$this->form_validation->set_rules('supplier_street', 'Street', 'trim|required');
			$this->form_validation->set_rules('supplier_barangay', 'Barangay', 'trim|required');
			$this->form_validation->set_rules('supplier_city', 'City', 'trim|required');
			$this->form_validation->set_rules('supplier_province', 'Province', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('supplier_model');
				$response = $this->supplier_model->insertsupplier();
				if ($response) {
					$success_message = 'Supplier added successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'Supplier was not added successfully.';
					$this->session->set_flashdata('success', $error_message);
				}
				redirect('main/supplier');
			}
		}
	}
	function view_supplier($supplier_id)
	{

		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_supplier($supplier_id);
		$this->load->view('main/header');
		$this->load->view('main/view_supplier', $this->data);
		$this->load->view('main/footer');
	}


	function editsupplier($supplier_id)
	{
		$this->edit_supplier_submit();
		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_supplier($supplier_id);

		$this->load->view('main/header');
		$this->load->view('main/edit_supplier', $this->data);
		$this->load->view('main/footer');
	}

	function edit_supplier_submit()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'trim|required');
			$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
			$this->form_validation->set_rules('supplier_contact', 'Supplier Contact', 'trim|required');
			$this->form_validation->set_rules('supplier_street', 'Supplier Street', 'trim|required');
			$this->form_validation->set_rules('supplier_barangay', 'Supplier Barangay', 'trim|required');
			$this->form_validation->set_rules('supplier_city', 'Supplier City', 'trim|required');
			$this->form_validation->set_rules('supplier_province', 'Supplier Province', 'trim|required');

			if ($this->form_validation->run() != FALSE) {
				$this->load->model('supplier_model');

				$response = $this->supplier_model->update_added_supplier();

				if ($response) {
					$success_message = 'Supplier updated successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'Supplier was not updated successfully.';
				}
				redirect('main/supplier');
			}
		}
	}

	public function delete_supplier($id)
	{

		$this->load->model('supplier_model');
		$response = $this->supplier_model->delete_supplier($id);

		if ($response) {
			$success_message = 'Supplier deleted successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Supplier was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/supplier');
	}
	function purchase_order()
	{
		$this->load->model('purchase_order_model');
		$this->data['po'] = $this->purchase_order_model->get_all_po();


		$this->load->view('main/header');
		$this->load->view('main/purchase_order', $this->data);
		$this->load->view('main/footer');
	}


	function add_purchase_order()
	{
		$this->add_purchase_order_submit();
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_all_product();

		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_all_suppliers();

		$this->load->model('purchase_order_model');
		$this->data['po_no'] = $this->purchase_order_model->po_no();
		$this->load->view('main/header');
		$this->load->view('main/add_purchase_order', $this->data);
		$this->load->view('main/footer');
	}

	function add_purchase_order_submit()
	{
		if ($this->input->post('btn_create_pr')) {

			$this->load->model('purchase_order_model');
			$response = $this->purchase_order_model->insertpurchaseorder();
			if ($response) {

				$success_message = 'Purchase order created successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {
				$error_message = 'Purchase order was not created successfully.';
				$this->session->set_flashdata('error', $error_message);
			}

			redirect('main/purchase_order');
		}
	}

	public function delete_po($id)
	{

		$this->load->model('purchase_order_model');
		$response = $this->purchase_order_model->delete_po($id);

		if ($response) {
			$success_message = 'Purchase order deleted successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Purchase order was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/purchase_order');
	}


	function edit_purchase_order($id)
	{
		$this->edit_purchase_order_submit($id);
		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_all_suppliers();
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_all_product();
		$this->load->model('purchase_order_model');
		$this->data['code'] = $this->purchase_order_model->code($id);
		$this->data['select'] = $this->purchase_order_model->Select_one($id);
		$this->data['view'] = $this->purchase_order_model->view_all_PO($id);

		$this->load->view('main/header');
		$this->load->view('main/edit_purchase_order', $this->data);
		$this->load->view('main/footer');
	}
	public function edit_purchase_order_submit($id)
	{
		if ($this->input->post('update_po')) {

			$this->load->model('purchase_order_model');
			$response = $this->purchase_order_model->update_po();

			if ($response) {

				$success_message = 'Purchase order updated successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {
				$error_message = 'Purchase order was not updated successfully.';
				$this->session->set_flashdata('error', $error_message);
			}
			redirect('main/purchase_order/' . $id);
		}
	}

	function view_purchase_order($id)
	{
		$this->load->model('purchase_order_model');
		$this->data['code'] = $this->purchase_order_model->code($id);
		$this->data['select'] = $this->purchase_order_model->Select_one($id);
		$this->data['view'] = $this->purchase_order_model->view_all_PO($id);

		$this->load->view('main/header');
		$this->load->view('main/view_purchase_order', $this->data);
		$this->load->view('main/footer');
	}
	public function approved_po($id)
	{
		$this->load->model('purchase_order_model');
		$response = $this->purchase_order_model->approved_po($id);

		if ($response) {
			$success_message = 'Purchase order approved successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Purchase order was not approved successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/purchase_order');
	}
	public function cancel_po($id)
	{
		$this->load->model('purchase_order_model');
		$response = $this->purchase_order_model->cancel_po($id);

		if ($response) {
			$success_message = 'Purchase order cancel successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Purchase order was not cancel successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/purchase_order');
	}
	public function print_purchase_order($id)
	{
		$this->load->model('purchase_order_model');
		$this->data['code'] = $this->purchase_order_model->code($id);
		$this->data['select'] = $this->purchase_order_model->Select_one($id);
		$this->data['view'] = $this->purchase_order_model->view_all_PO($id);
		$this->load->view('main/print_po_report', $this->data);
	}

	function goods_received()
	{
		$this->load->model('purchase_order_model');
		$this->data['po'] = $this->purchase_order_model->get_all_gr();
		$this->load->view('main/header');
		$this->load->view('main/goods_received', $this->data);
		$this->load->view('main/footer');
	}
	function goods_received_list()
	{
		$this->load->model('goods_received_model');
		$this->data['gr'] = $this->goods_received_model->get_all_gr();
		$this->load->view('main/header');
		$this->load->view('main/goods_received_list', $this->data);
		$this->load->view('main/footer');
	}
	function view_goods_received($id)
	{
		$this->load->model('goods_received_model');
		$this->data['code'] = $this->goods_received_model->code($id);
		$this->data['select'] = $this->goods_received_model->Select_one($id);
		$this->data['view'] = $this->goods_received_model->view_all_GR($id);
		$this->load->model('goods_received_model');

		$this->load->view('main/header');
		$this->load->view('main/view_goods_received', $this->data);
		$this->load->view('main/footer');
	}
	function post_goods_received($id)
	{
		$this->load->model('purchase_order_model');
		$this->data['code'] = $this->purchase_order_model->code($id);
		$this->data['select'] = $this->purchase_order_model->Select_one($id);
		$this->data['view'] = $this->purchase_order_model->view_all_PO($id);
		$this->data['gr_no'] = $this->purchase_order_model->gr_no();
		$this->load->view('main/header');
		$this->load->view('main/post_goods_received', $this->data);
		$this->load->view('main/footer');
	}
	public function post_goods_received_submit()
	{
		if ($this->input->post('btn_post_gr')) {

			$this->load->model('goods_received_model');
			$response = $this->goods_received_model->post_goods_received();
			if ($response) {

				$success_message = 'Goods recieved posted successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {
				$error_message = 'Goods received was not posted successfully.';
				$this->session->set_flashdata('error', $error_message);
			}

			redirect('main/purchase_order');
		}
	}
	public function print_goods_received($id)
	{
		$this->load->model('goods_received_model');
		$this->data['code'] = $this->goods_received_model->code($id);
		$this->data['select'] = $this->goods_received_model->Select_one($id);
		$this->data['view'] = $this->goods_received_model->view_all_GR($id);;
		$this->load->view('main/print_gr_report', $this->data);
	}
	function goods_return()
	{
		$this->load->model('goods_return_model');
		$this->data['grt'] = $this->goods_return_model->get_all_grt();
		$this->load->view('main/header');
		$this->load->view('main/goods_return', $this->data);
		$this->load->view('main/footer');
	}
	function goods_return_list()
	{
		$this->load->model('goods_return_model');
		$this->data['gr1'] = $this->goods_return_model->get_all_grt1();
		$this->load->view('main/header');
		$this->load->view('main/goods_return_list', $this->data);
		$this->load->view('main/footer');
	}

	function post_goods_return($id)
	{

		$this->load->model('goods_return_model');
		$this->data['grt_no'] = $this->goods_return_model->grt_no();
		$this->data['select'] = $this->goods_return_model->Select_one($id);
		$this->data['select1'] = $this->goods_return_model->Select_two($id);
		$this->data['view'] = $this->goods_return_model->view_all_grt($id);
		$this->load->view('main/header');
		$this->load->view('main/post_goods_return', $this->data);
		$this->load->view('main/footer');
	}
	public function post_goods_return_submit()
	{
		if ($this->input->post('btn_post_grt')) {

			$this->load->model('goods_return_model');
			$response = $this->goods_return_model->post_goods_return();
			if ($response) {

				$success_message = 'Goods return posted successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {
				$error_message = 'Goods return was not posted successfully.';
				$this->session->set_flashdata('error', $error_message);
			}

			redirect('main/goods_return');
		}
	}
	function view_goods_return($id)
	{
		$this->load->model('goods_return_model');
		$this->data['code'] = $this->goods_return_model->code($id);
		$this->data['select'] = $this->goods_return_model->Select_one($id);
		$this->data['view'] = $this->goods_return_model->view_all_grt1($id);
		$this->load->view('main/header');
		$this->load->view('main/view_goods_return', $this->data);
		$this->load->view('main/footer');
	}
	function print_goods_return($id)
	{
		$this->load->model('goods_return_model');
		$this->data['code'] = $this->goods_return_model->code($id);
		$this->data['select'] = $this->goods_return_model->Select_one($id);
		$this->data['view'] = $this->goods_return_model->view_all_grt1($id);
		$this->load->view('main/print_grt_report', $this->data);
	}

	function back_order()
	{
		$this->load->view('main/header');
		$this->load->view('main/back_order');
		$this->load->view('main/footer');
	}

	function product()
	{
		$this->load->model('product_model');
		$this->data['result'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/product', $this->data);
		$this->load->view('main/footer');
	}

	function add_product()
	{

		$this->add_product_submit();
		$this->load->model('product_model');
		$this->data['product_code'] = $this->product_model->product_code();
		$this->load->model('supplier_model');
		$this->data['suppliers'] = $this->supplier_model->get_all_suppliers();
		$this->load->view('main/header');
		$this->load->view('main/add_product', $this->data);
		$this->load->view('main/footer');
	}
	function add_product_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('product_code', 'Product Code', 'trim|required|is_unique[product.product_code]');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|is_unique[product.product_name]', array('is_unique' => 'The Product Name is already taken.'));
			$this->form_validation->set_rules('supplier_id', 'Supplier', 'trim|required');
			$this->form_validation->set_rules('product_barcode', 'Product Barcode', 'trim|required');
			$this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
			$this->form_validation->set_rules('product_margin', 'Product Barcode', 'trim|required');
			$this->form_validation->set_rules('product_barcode', 'Product Margin', 'trim|required');
			$this->form_validation->set_rules('product_vat', 'Product VAT', 'trim|required');
			$this->form_validation->set_rules('product_inbound_threshold', 'Product Inbound Threshold', 'trim|required');
			$this->form_validation->set_rules('product_shelf_life', 'Product Shelf Life', 'trim|required');
			$this->form_validation->set_rules('product_recall_threshold', 'Product Recall Threshold', 'trim|required');
			$this->form_validation->set_rules('product_minimum_quantity', 'Product Miminum Quantity', 'trim|required');
			$this->form_validation->set_rules('product_required_quantity', 'Product Required Quantity', 'trim|required');
			$this->form_validation->set_rules('product_maximum_quantity', 'Product Maximum Quantity', 'trim|required');
			$this->form_validation->set_rules('product_minimum_order_quantity', 'Product Miminum Order Quantity', 'trim|required');


			if ($this->form_validation->run() != FALSE) {
				$config['upload_path'] = './assets/images/'; // Set the upload directory
				$config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
				$config['max_size'] = 2048; // Maximum file size in kilobytes
				$config['encrypt_name'] = TRUE; // Encrypt the file name for security

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('product_image')) {
					$image_data = $this->upload->data();

					// Generate a unique filename based on the product name
					$product_name = $this->input->post('product_name');
					$product_code = $this->input->post('product_code');
					$unique_filename = strtolower(str_replace(' ', '', $product_name)) . '' . $product_code . '_' . time() . $image_data['file_ext'];

					// Rename the uploaded file to the unique filename
					$new_path = './assets/images/' . $unique_filename;
					rename($image_data['full_path'], $new_path);

					// Now, you can save $unique_filename into your database.
					// Make sure you have a column in your database table to store the file name.

					$this->load->model('product_model');
					$response = $this->product_model->insert_product($unique_filename); // Pass the unique filename to the model

					if ($response) {
						$success_message = 'Product added successfully.';
						$this->session->set_flashdata('success', $success_message);
					} else {
						$error_message = 'Product was not added.';
						$this->session->set_flashdata('error', $error_message);
					}
				} else {
					$error_message = 'Image upload failed: ' . $this->upload->display_errors();
					$this->session->set_flashdata('error', $error_message);
				}

				redirect('main/product');
			}
		}
	}

	function edit_product($product_id)
	{
		$this->edit_product_submit($product_id);
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_product($product_id);
		$this->data['select'] = $this->product_model->select_one($product_id);
		$this->load->model('supplier_model');
		$this->data['supplier'] = $this->supplier_model->get_all_suppliers();
		$this->load->view('main/header');
		$this->load->view('main/editproduct', $this->data);
		$this->load->view('main/footer');
	}

	function edit_product_submit($product_id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('product_code', 'Product Code', 'trim|required');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
			$this->form_validation->set_rules('supplier_id', 'Supplier', 'trim|required');
			$this->form_validation->set_rules('product_barcode', 'Product Barcode', 'trim|required');
			$this->form_validation->set_rules('product_category', 'Product Category', 'trim|required');
			$this->form_validation->set_rules('product_margin', 'Product Margin', 'trim|required');
			$this->form_validation->set_rules('product_vat', 'Product VAT', 'trim|required');
			$this->form_validation->set_rules('product_inbound_threshold', 'Product Inbound Threshold', 'trim|required');
			$this->form_validation->set_rules('product_shelf_life', 'Product Shelf Life', 'trim|required');
			$this->form_validation->set_rules('product_recall_threshold', 'Product Recall Threshold', 'trim|required');
			$this->form_validation->set_rules('product_minimum_quantity', 'Product Minimum Quantity', 'trim|required');
			$this->form_validation->set_rules('product_required_quantity', 'Product Required Quantity', 'trim|required');
			$this->form_validation->set_rules('product_maximum_quantity', 'Product Maximum Quantityr', 'trim|required');
			$this->form_validation->set_rules('product_minimum_order_quantity', 'Product Minimum Order Quantity', 'trim|required');


			if ($this->form_validation->run() != FALSE) {
				$this->load->model('product_model');

				// Check if a new image is being uploaded
				$update_image = false;

				if ($_FILES['product_image']['name']) {
					$update_image = true;
					$config['upload_path'] = './assets/images/';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = 2048;
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('product_image')) {
						$image_data = $this->upload->data();
						$product = $this->product_model->get_product($product_id);

						// Delete the old image file if it exists
						if ($product && !empty($product->product_image)) {
							unlink('./assets/images/' . $product->product_image);
						}

						// Generate a unique filename based on the product name
						$product_name = $this->input->post('product_name');
						$unique_filename = strtolower(str_replace(' ', '', $product_name)) . '' . $product_id . '_' . time() . $image_data['file_ext'];

						// Rename the uploaded file to the unique filename
						$new_path = './assets/images/' . $unique_filename;
						rename($image_data['full_path'], $new_path);

						// Update the product with the new image filename
						$this->input->post('product_image', $unique_filename);
					} else {
						$error_message = 'Image upload failed: ' . $this->upload->display_errors();
						echo $error_message; // Debugging: Output the error message
						$this->session->set_flashdata('error', $error_message);
						redirect('main/product'); // Stop further processing if image upload fails
					}
				}

				// Update the product data
				$response = $this->product_model->update_product($product_id, $update_image);

				if ($response) {
					$success_message = 'Product updated successfully.';
					$this->session->set_flashdata('success', $success_message);
					echo $success_message; // Debugging: Output the success message

				} else {
					$error_message = 'Product was not updated successfully.';
					echo $error_message; // Debugging: Output the error message
					$this->session->set_flashdata('error', $error_message);
				}


				// Redirect to the product listing page
				redirect('main/product');
			}
		}
	}

	function delete_product($product_id)
	{
		$this->load->model('product_model');
		$response = $this->product_model->delete_product($product_id);

		if ($response) {
			$success_message = 'Product deleted successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Product was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/product');
	}
	function inventory_adjustment()
	{
		$this->load->model('product_model');

		$this->data['product'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/inventory_adjustment', $this->data);
		$this->load->view('main/footer');
	}
	function add_stock($product_id)
	{
		$this->add_stock_submit();
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_product($product_id);
		$this->load->view('main/header');
		$this->load->view('main/add_stock', $this->data);
		$this->load->view('main/footer');
	}

	function add_stock_submit()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->form_validation->set_rules('product_quantity', 'Quantity', 'trim|required');


			if ($this->form_validation->run() != FALSE) {
				$this->load->model('inventory_adjustment_model');

				$response = $this->inventory_adjustment_model->updateQuantity();

				if ($response) {
					$success_message = 'Quantity adjusted successfully.';
					$this->session->set_flashdata('success', $success_message);
				} else {
					$error_message = 'Quantity was not adjusted successfully.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/inventory_adjustment');
			}
		}
	}
	function inventory_ledger()
	{
		$this->load->model('inventory_ledger_model');

		if (isset($_POST['search'])) {
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');
			$this->data['ledger'] = $this->inventory_ledger_model->get_ledger_by_date_range($date_from, $date_to);
		} else {
			$this->data['ledger'] = $this->inventory_ledger_model->get_all_ledger();
		}

		$this->load->view('main/header');
		$this->load->view('main/inventory_ledger', $this->data);
		$this->load->view('main/footer');
	}
	function stock_requisition()
	{
		$this->add_purchase_order_submit();
		$this->load->model('stock_requisition_model');
		$this->data['sr'] = $this->stock_requisition_model->get_all_sr();
		$this->load->view('main/header');
		$this->load->view('main/stock_requisition', $this->data);
		$this->load->view('main/footer');
	}
	function add_stock_requisition()
	{
		$this->add_stock_requisition_submit();
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_all_product();
		$this->load->model('stock_requisition_model');
		$this->data['sr_no'] = $this->stock_requisition_model->sr_no();
		$this->load->view('main/header');
		$this->load->view('main/add_stock_requisition', $this->data);
		$this->load->view('main/footer');
	}
	function add_stock_requisition_submit()
	{

		if ($this->input->post('btn_create_sr')) {

			$this->load->model('stock_requisition_model');
			$response = $this->stock_requisition_model->insertstockrequisition();
			if ($response) {

				$success_message = 'Stock Requisition created successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {
				$error_message = 'Stock Requisition was not created successfully.';
				$this->session->set_flashdata('error', $error_message);
			}

			redirect('main/stock_requisition');
		}
	}
	function view_stock_requisition($id)
	{
		$this->view_stock_requisition_submit();
		$this->load->model('stock_requisition_model');
		$this->data['code'] = $this->stock_requisition_model->code($id);
		$this->data['select'] = $this->stock_requisition_model->Select_one($id);
		$this->data['view'] = $this->stock_requisition_model->view_all_sr($id);
		$this->load->view('main/header');
		$this->load->view('main/view_stock_requisition', $this->data);
		$this->load->view('main/footer');
	}
	function view_stock_requisition_submit()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$this->load->model('stock_requisition_model');

			// Validate the form data
			$product = $this->input->post('product');
			$quantity = $this->input->post('quantity');

			foreach ($product as $index => $product_name) {
				$product_quantity = $this->stock_requisition_model->get_product_quantity($product_name);
				if ($quantity[$index] > $product_quantity) {
					$this->session->set_flashdata('exceeds', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Error!</strong> The quantity of "' . $product_name . '" in the form exceeds the available quantity in your stocks.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('main/stock_requisition');
				}
			}

			// Call the poststockrequisition() method if the form data is valid
			$response = $this->stock_requisition_model->poststockrequisition();
			if ($response) {
				$success_message = 'Stock Requisition posted successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {
				$error_message = 'Stock Requisition was not posted successfully.';
				$this->session->set_flashdata('error', $error_message);
			}

			redirect('main/stock_requisition');
		}
	}
	function edit_stock_requisition($id)
	{

		$this->edit_stock_requisition_submit();
		$this->load->model('stock_requisition_model');
		$this->data['code'] = $this->stock_requisition_model->code($id);
		$this->data['select'] = $this->stock_requisition_model->Select_one($id);
		$this->data['view'] = $this->stock_requisition_model->view_all_sr($id);
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_all_product();
		$this->load->view('main/header');

		$this->load->view('main/editstockrequisition', $this->data);
		$this->load->view('main/footer');
	}
	function edit_stock_requisition_submit()
	{

		if ($this->input->post('btn_update_sr')) {

			$this->load->model('stock_requisition_model');
			$response = $this->stock_requisition_model->update_sr();
			if ($response) {

				$success_message = 'Stock Requisition updated successfully.';
				$this->session->set_flashdata('success', $success_message);
			} else {

				$error_message = 'Stock Requisition was not updated successfully.';
				$this->session->set_flashdata('error', $error_message);
			}

			redirect('main/stock_requisition');
		}
	}
	public function delete_sr($id)
	{


		$this->load->model('stock_requisition_model');
		$response = $this->stock_requisition_model->delete_sr($id);

		if ($response) {
			$success_message = 'Stock Requisition deleted successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Stock Requisition was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/stock_requisition/');
	}
	public function cancel_sr($id)
	{


		$this->load->model('stock_requisition_model');
		$response = $this->stock_requisition_model->cancel_sr($id);

		if ($response) {
			$success_message = 'Stock Requisition cancelled successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Stock Requisition was not cancelled successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/stock_requisition/');
	}
	public function received_sr($id)
	{

		$this->load->model('stock_requisition_model');
		$response = $this->stock_requisition_model->received_sr($id);

		if ($response) {
			$success_message = 'Stock Requisition received successfully.';
			$this->session->set_flashdata('success', $success_message);
		} else {
			$error_message = 'Stock Requisition was not received successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/stock_requisition/');
	}
	function reports()
	{
		$this->load->model('purchase_order_model');
		$this->data['po'] = $this->purchase_order_model->get_all_po();
		$this->load->model('goods_received_model');
		$this->data['gr'] = $this->goods_received_model->get_all_gr();
		$this->load->model('inventory_adjustment_model');
		$this->data['ia'] = $this->inventory_adjustment_model->get_all_adjust();
		$this->load->model('goods_return_model');
		$this->data['gr1'] = $this->goods_return_model->get_all_grt1();
		$this->load->view('main/header');
		$this->load->view('main/reports', $this->data);
		$this->load->view('main/footer');
	}
	function backup()
	{
		$this->load->view('main/header');
		$this->load->view('main/backup');
		$this->load->view('main/footer');
	}
	public function export()
	{
		//load helpers
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
		//load database
		$this->load->dbutil();
		//create format
		$db_format = array('format' => '.sql', 'filename' => 'pos.sql');
		$backup = &$this->dbutil->backup($db_format);
		// file name
		$dbname = 'pos.sql';
		$save = '.assets/db_backup/' . $dbname;
		// write file
		write_file($save, $backup);

		// and force download
		force_download($dbname, $backup);
	}
	public function import()
	{

		if ($this->input->post('btn_import')) {
			$config['upload_path'] = './upload/database/';
			$config['allowed_types'] = '*';
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('import')) {
				$error_message = 'Backup was not restored.';
				$this->session->set_flashdata('error', $error_message);
			} else {
				$this->import2();
				$success_message = 'Backup was restored successfully.';
				$this->session->set_flashdata('success', $success_message);
			}

			redirect('main/backup_and_restore');

		}
	}


	public function import2()
	{

		$host = 'localhost'; //DB Hosting Name
		$UN = 'root'; //Db Username
		$pwd = ''; // Db Password
		$database_name = 'inventory'; // Db Name
		$db_file = $this->input->post('back');
		$connection = mysqli_connect($host, $UN, $pwd, $database_name);

		$filename = 'C:/xampp/htdocs/ETPI/upload/database/inventory.sql';
		$handle = fopen($filename, "r+");
		$contents = fread($handle, filesize($filename));

		$sql = explode(';', $contents);
		foreach ($sql as $query) {
			$result = mysqli_query($connection, $query);
		}
		fclose($handle);
	}

	function payment()
	{
		$this->load->view('main/header');
		$this->load->view('main/payment');
		$this->load->view('main/footer');
	}
	function receipt()
	{
		$this->load->view('main/header');
		$this->load->view('main/receipt');
		$this->load->view('main/footer');
	}
	function pos()
	{
		$this->load->model('product_model');
		$this->data['result'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/pos', $this->data);
		$this->load->view('main/footer');
	}


	function displayrec()
	{
		$this->load->view('main/header');
		$this->load->view('main/displayrec');
		$this->load->view('main/footer');
	}


}
