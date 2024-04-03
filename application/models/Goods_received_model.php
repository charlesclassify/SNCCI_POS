<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Goods_received_model extends CI_Model
{
    public function post_goods_received()
    {
        $this->updatestatus();
        $purchase_id = (int) $this->input->post('purchase_id');
        $goods = [
            'goods_received_no' => $this->input->post('goods_received_no'),
            'supplier_id' => $this->input->post('supplier_id'),
            'date_received' => $this->input->post('date_received'),
            'purchase_order_no_id' => $this->input->post('gr_id')
        ];

        $this->db->insert('goods_received_no', $goods);

        $last_id = $this->db->insert_id();


        $product_name = $this->input->post('product_name');
        $po_product_quantity = $this->input->post('po_product_quantity');
        $product_unit = $this->input->post('product_unit');
        $product_unitprice = $this->input->post('product_unitprice');
        $unserved_quantity = $this->input->post('unserved_quantity');
        $expiry_date = $this->input->post('expiry_date');

        $total_cost = 0; // Initialize total cost variable

        foreach ($product_name as $index => $product_name) {
            $arr_product = $product_name;
            $arr_quant = $po_product_quantity[$index];
            $arr_unit = $product_unit[$index];
            $arr_price = $product_unitprice[$index];
            $arr_un = $unserved_quantity[$index];
            $arr_exp = $expiry_date[$index];


            $arr_rec = $arr_quant - $arr_un;


            // Calculate cost for this product
            $cost = $arr_price * $arr_rec;
            $total_cost += $cost; // Add cost to the total cost variable


            // Insert data into goods_received table
            $data_goods_received = [
                'goods_received_no' => $last_id,
                'gr_product_name' => $arr_product,
                'gr_total_quantity' => $arr_quant,
                'gr_unit' => $arr_unit,
                'gr_product_unitprice' => $arr_price,
                'gr_unserved_quantity' => $arr_un,
                'gr_received_quantity' => $arr_rec,
                'gr_expiry_date' => $arr_exp,
            ];

            $this->db->insert('goods_received', $data_goods_received);

            // Insert data into inventory_ledger table
            $data_inventory_ledger = [
                'product_name' => $arr_product,
                'unit' => $arr_unit,
                'quantity' => $arr_rec,
                'price' => $arr_price,
                'activity' => 'Received', // Adjust based on your activity types
                'date_posted' => date('Y-m-d'), // Adjust based on your date format
            ];

            $this->db->insert('inventory_ledger', $data_inventory_ledger);

            // Update product_quantity in the product table
            // First, get the current product_quantity
            $this->db->select('product_quantity');
            $this->db->from('product');
            $this->db->where('product_name', $arr_product);
            $query = $this->db->get();
            $current_quantity = $query->row()->product_quantity;

            // Calculate the new product quantity
            $new_quantity = $current_quantity + $arr_rec;

            // Update product_quantity in the product table
            $this->db->set('product_quantity', $new_quantity);
            $this->db->where('product_name', $arr_product);
            $this->db->update('product');
        }

        // Insert total cost into goods_received_no table
        $this->db->set('gr_total_cost', $total_cost);
        $this->db->where('goods_received_no_id', $last_id);
        $this->db->update('goods_received_no');

        return $last_id;
    }
    public function post_back_order()
    {
        $this->updatestatus1();
        $purchase_id = (int) $this->input->post('purchase_id');
        $goods = [
            'supplier_id' => $this->input->post('supplier_id'),
            'date_received' => $this->input->post('date_received'),
            'purchase_order_id' => $this->input->post('gr_id')
        ];

        $this->db->insert('goods_received_no', $goods);

        $last_id = $this->db->insert_id();

        $product = $this->input->post('product');
        $quantity = $this->input->post('quantity');
        $unit = $this->input->post('unit');
        $product_unitprice = $this->input->post('product_unitprice');
        $received_quantity = $this->input->post('received_quantity');
        $expiry_date = $this->input->post('expiry_date');

        $total_cost = 0; // Initialize total cost variable

        foreach ($product as $index => $product) {
            $arr_product = $product;
            $arr_quant = $quantity[$index];
            $arr_unit = $unit[$index];
            $arr_price = $product_unitprice[$index];
            $arr_rec = $received_quantity[$index];
            $arr_exp = $expiry_date[$index];

            // Calculate cost for this product
            $cost = $arr_price * $arr_rec;
            $total_cost += $cost; // Add cost to total cost variable

            // Insert data into goods_received table
            $data_goods_received = [
                'goods_received_no' => $last_id,
                'gr_product_name' => $arr_product,
                'gr_total_quantity' => $arr_quant,
                'gr_unit' => $arr_unit,
                'gr_product_unitprice' => $arr_price,
                'gr_received_quantity' => $arr_rec,
                'gr_expiry_date' => $arr_exp,
            ];

            $this->db->insert('goods_received', $data_goods_received);

            // Insert data into inventory_ledger table
            $data_inventory_ledger = [
                'product_name' => $arr_product,
                'unit' => $arr_unit,
                'quantity' => $arr_rec,
                'price' => $arr_price,
                'activity' => 'received',
                'date_posted' => date('Y-m-d'),
            ];

            $this->db->insert('inventory_ledger', $data_inventory_ledger);

            // Update product_quantity and product_expirydate in product table
            $this->db->set('product_quantity', "product_quantity + $arr_rec", FALSE);
            $this->db->set('product_expirydate', $arr_exp);
            $this->db->where('product_name', $arr_product);
            $this->db->update('product');
        }

        // Insert total cost into goods_received_no table
        $this->db->set('gr_total_cost', $total_cost);
        $this->db->where('goods_received_id', $last_id);
        $this->db->update('goods_received_no');

        return $last_id;
    }


    public function updatestatus()
    {
        $gr_id = $this->input->post('gr_id');
        $unserved_quantities = $this->input->post('unserved_quantity');
        $expected_quantities = $this->input->post('quantity');
        $status = "Received";

        foreach ($unserved_quantities as $key => $unserved_quantity) {
            if ($unserved_quantity != $expected_quantities[$key] && $unserved_quantity != 0) {
                $status = "Back Order";
                break;
            }
        }

        $ref = array(
            'status' => $status // Update status based on conditions
        );

        $this->db->where('purchase_order_no_id', $gr_id);
        $this->db->update('purchase_order_no', $ref);

        return $gr_id;
    }
    public function updatestatus1()
    {
        $gr_id = $this->input->post('gr_id');
        $ref = array(
            'status' => 'Received'
        );
        $this->db->where('purchase_order_id', $gr_id);
        $this->db->update('purchase_order_no', $ref);
        return $gr_id;
    }


    function get_all_gr1()
    {
        $this->db->select('*');
        $this->db->from('purchase_order_no');
        $this->db->join('suppliers', 'purchase_order_no.supplier_id = suppliers.supplier_id');
        $this->db->where('purchase_order_no.is_Delete', 'no');
        $this->db->where('purchase_order_no.status', 'Received');
        $query = $this->db->get()->result();
        return $query;
    }
    function get_all_gr()
    {
        $this->db->select('*');
        $this->db->from('goods_received_no');
        $this->db->join('suppliers', 'goods_received_no.supplier_id = suppliers.supplier_id');
        $this->db->where('goods_received_no.isCancel', 'no');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_barcode()
    {
        $this->db->select('*');
        $this->db->from('barcode');
        $query = $this->db->get()->result();
        return $query;
    }

    function code($id)
    {
        $this->db->select('*');
        $this->db->from('purchase_order_no');
        $this->db->join('goods_received_no', 'purchase_order_no.purchase_order_no_id = goods_received_no.purchase_order_no_id', 'left');
        $this->db->where('purchase_order_no.purchase_order_no_id', $id);
        $query = $this->db->get()->row();
        return $query;
    }


    function Select_one($id)
    {
        $this->db->select('*');
        $this->db->from('suppliers AS supplier');
        $this->db->join('purchase_order_no AS purc', 'purc.supplier_id = supplier.supplier_id');
        $this->db->join('purchase_order AS PO', 'purc.purchase_order_no_id= PO.purchase_order_no');
        $this->db->where('purchase_order_no_id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function view_all_GR($id)
    {
        $this->db->select('*');
        $this->db->from('goods_received');
        $this->db->join('goods_received_no', 'goods_received.goods_received_no = goods_received_no.goods_received_no_id');
        $this->db->join('purchase_order', 'purchase_order.purchase_order_id = goods_received_no.purchase_order_no_id');
        $this->db->join('purchase_order_no', 'purchase_order_no.purchase_order_no_id = purchase_order.purchase_order_id');
        $this->db->join('product', 'product.product_name = goods_received.gr_product_name');
        $this->db->where('purchase_order_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function view_all_GR1($id)
    {
        $this->db->select('*');
        $this->db->from('goods_received');
        $this->db->join('goods_received_no', 'goods_received.goods_received_no = goods_received_no.goods_received_no_id');
        $this->db->join('purchase_order', 'purchase_order.purchase_order_id = goods_received_no.purchase_order_no_id');
        $this->db->join('purchase_order_no', 'purchase_order_no.purchase_order_no_id = purchase_order.purchase_order_id');
        $this->db->where('purchase_order_id', $id);
        $this->db->where('gr_total_quantity != gr_received_quantity'); // new where clause
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_receiving()
    {
        $this->db->select('*');
        $this->db->from('receiving');
        $query = $this->db->get()->result();
        return $query;
    }

    function get_receipt_details($receiving_no)
    {
        $this->db->select('*');
        $this->db->from('receiving');
        $this->db->where('receiving_no', $receiving_no);
        $query = $this->db->get()->result();
        return $query;
    }
}
