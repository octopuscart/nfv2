<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['id'];
        } else {
            $this->user_id = 0;
        }
        $this->checklogin = $this->session->userdata('logged_in');
        $this->user_id = $this->session->userdata('logged_in')['id'];
    }

    public function index() {
        redirect('/');
    }

    public function test() {
        setlocale(LC_MONETARY, "en_US");
        echo money_format("%.2n", $number);
    }

    //orders details
    public function orderdetails($order_no) {
        $this->db->where('order_no', $order_no);
        $query = $this->db->get('nfw_product_order');
        $orderDetails = $query->result_array();
        $order_id = $orderDetails[0]['id'];
        $data['orderDetail'] = $orderDetails;
        $data['userInfo'] = $this->Product_model->phpjsonstyle($orderDetails[0]['user_info'], 'php');
        $data['shipping'] = $this->Product_model->phpjsonstyle($orderDetails[0]['shipping_id'], 'php');
        $data['biling'] = $this->Product_model->phpjsonstyle($orderDetails[0]['billing_id'], 'php');
        $query = "SELECT * FROM `nfw_order_invoice` where order_id = $order_id ";
        // echo $query;
        $data['invoice_data'] = $this->Product_model->resultAssociate($query);

        $query1 = ' SELECT ost.id as status_tag,ost.title AS order_status, os.remark,  os.id as status_id,
                      os.op_date_time as date
                             FROM nfw_order_status AS os
                             JOIN nfw_order_status_tag AS ost ON os.status = ost.id
                             WHERE os.order_id =' . $order_id;

        $query2 = 'SELECT ost.id as status_tag,ost.title AS order_status, os.remark,  os.id as status_id,
                        os.op_date_time as date
                            FROM nfw_order_status_tag AS ost
                            JOIN nfw_old_order_status AS os ON os.status = ost.id
                            WHERE os.order_id = ' . $order_id . '
                  order by status_id desc ';
        $order_status_record1 = $this->Product_model->resultAssociate($query1);
        $order_status_record2 = $this->Product_model->resultAssociate($query2);
        $data['order_status_record'] = array_merge($order_status_record1, $order_status_record2);

        $this->load->view('Order/orderdetails', $data);
    }

    public function orderdetailsguest($order_key) {

        $order_details = $this->Product_model->getOrderDetails($order_key, 'key');

        $file_newname = "";
        $this->db->where('active', 'yes');
        $query = $this->db->get('payment_barcode');
        $paymentbarcode = $query->row();
        $order_details['paymentbarcode'] = $paymentbarcode;



        $order_id = $order_details['order_data']->id;


        if ($order_details) {

            try {
                $order_id = $order_details['order_data']->id;
                // $this->Product_model->order_mail($order_id);
                //redirect("Order/orderdetails/$order_key");
            } catch (customException $e) {
                //display custom message
                // redirect("Order/orderdetails/$order_key");
            }
        } else {
            redirect("Order/orderdetailsguest/$order_key");
        }
        $this->load->view('Order/orderdetails', $order_details);
    }

}

?>
