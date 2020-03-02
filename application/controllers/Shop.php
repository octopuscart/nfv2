<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $session_user = $this->session->userdata('logged_in');
        $this->session_user = $session_user;
        if ($session_user) {
            $this->user_id = $session_user['id'];
        } else {
            $this->user_id = 0;
        }
    }

    public function index() {
        $data['featuredProducts'] = $this->Product_model->featurProductTag();
        $this->load->view('home', $data);
    }

    public function cart() {
        if (isset($_POST['submitAddress'])) {
            $addressinsert = array(
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zip' => $this->input->post('zip'),
                'contact_no' => "",
                'user_id' => $this->user_id,
                "shipping_address" => "",
                "default_shipping_address" => "yes",
                "default_billing_address" => "",
            );
            $this->db->insert('nfw_billing_shipping_address', $addressinsert);
            redirect("Shop/cart?addrurl=billingShipping");
        }

        $shiping_deduct = $this->Product_model->resultAssociate("SELECT * FROM `nfw_shipping`");
        $data['shiping_deduct'] = $shiping_deduct;

        $data['cardinfo'] = $this->session->userdata('cardinfo');

        if (isset($_POST['card_submit'])) {
            $cardinfo = $this->input->post('card-holder-name');
            $this->session->set_userdata('cardinfo', $cardinfo);
            redirect("Shop/cart?addrurl=paymentMode");
        }
        if (isset($_POST['removecard'])) {
            $this->session->unset_userdata('cardinfo');
            redirect("Shop/cart?addrurl=paymentMode");
        }


        if (isset($_POST['confirm_order'])) {
            $ship_id = $this->input->post('shipid');

            $totalprice = $this->input->post('totalprice');
            $totalquantity = $this->input->post('totalquantity');
            $grandtotal = $this->input->post('grandtotal');
            $shippingprice = $this->input->post('shippingprice');

            $query = "SELECT address1,address2,city,state,country,zip FROM `nfw_billing_shipping_address` where id = $ship_id ";
            $shipresult = $this->Product_model->resultAssociate($query);
            $shipdata = json_encode(end($shipresult));


            $query = "SELECT id,first_name,middle_name,last_name,email,telephone_no,fax_no,contact_no,registration_id FROM  `auth_user` where id = $this->user_id";
            $userinfo = $this->Product_model->resultAssociate($query);
            $userdata = json_encode(end($userinfo));

            if ($data['cardinfo']) {
                $carddata1 =  $this->session->userdata('cardinfo');
                $cardTitle = 'Credit Card';
            } else {
                $carddata1 = "";
                $cardTitle = 'Manual payment';
            }

            $dat = date('Y-m-d ');
            $tm = date('H:i:s');
            $date_code = date('ym');
            $dte1 = date('Y-m-d H:i:s');


            $orderInsertData = array(
                "user_id" => $this->user_id,
                "user_info" => $userdata,
                "op_date" => $dat,
                "op_time" => $tm,
                "total_price" => $grandtotal,
                "shipping_amount" => $shippingprice,
                "total_quantity" => $totalquantity,
                "billing_id" => "",
                "shipping_id" => $shipdata,
                "coupon_id" => "",
                "payment_gateway" => $cardTitle,
                "payment_gateway_return" => "",
                "order_no" => "",
                "card"=> $carddata1,
            );

            $this->db->insert('nfw_product_order', $orderInsertData);
            $last_id = $this->db->insert_id();
            $gen_num = 1100 + $last_id;
            $order_code = 'ON' . $date_code . '' . $gen_num;
            $invoice_no = 'IN' . $date_code . '' . $gen_num;

            $this->db->set('order_no', $order_code);
            $this->db->where('id', $last_id); //set column_name and value in which row need to update
            $this->db->update("nfw_product_order");

            $orderpaymentinsert = array(
                "user_id" => $this->user_id,
                "order_id" => $last_id,
                "card_id" => "",
                "transaction_no" => "",
                "transaction_amount" => $grandtotal,
                "status" => "Pending"
            );
            $this->db->insert("nfw_order_payment", $orderpaymentinsert);

            $invoiceinsert = array(
                "user_id" => $this->user_id,
                "order_id" => $last_id,
                "op_date" => $dat,
                "op_time" => $tm,
                "total_amount" => $grandtotal,
                "invoice_no" => $invoice_no,
            );
            $this->db->insert("nfw_order_invoice", $invoiceinsert);
            $dte1 = date('Y-m-d H:i:s');
            $nfw_order_status = array(
                "order_id" => $last_id,
                "op_date_time" => $dte1,
                "remark" => "Confirmed on $dte1",
                "status" => "1"
            );
            $this->db->insert("nfw_order_status", $nfw_order_status);


            $this->db->set('order_id', $last_id);
            $this->db->where('order_id', "0");
            $this->db->where("measurement_id != ''");
            $this->db->where('user_id', $this->user_id); //set column_name and value in which row need to update
            $this->db->update("nfw_product_cart");

            redirect("Order/orderdetails/" . $last_id);
        }
        $this->load->view('Product/shopCart', $data);
    }
    
    public function error(){
        redirect(site_url("/"));
    }

    public function contactus() {
        if (isset($_POST['sendmessage'])) {
            $web_enquiry = array(
                'last_name' => $this->input->post('last_name'),
                'first_name' => $this->input->post('first_name'),
                'email' => $this->input->post('email'),
                'contact' => $this->input->post('contact'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'),
                'datetime' => date("Y-m-d H:i:s a"),
            );

            $this->db->insert('web_enquiry', $web_enquiry);

            $emailsender = email_sender;
            $sendername = email_sender_name;
            $email_bcc = email_bcc;
            $sendernameeq = $this->input->post('last_name') . " " . $this->input->post('first_name');
            if ($this->input->post('email')) {
                $this->email->set_newline("\r\n");
                $this->email->from($this->input->post('email'), $sendername);
                $this->email->to(email_bcc);
//                $this->email->bcc(email_bcc);
                $subjectt = $this->input->post('subject');


                $subject = "Enquiry from website - " . $this->input->post('subject');
                $this->email->subject($subject);

                $web_enquiry['web_enquiry'] = $web_enquiry;

                echo $htmlsmessage = $this->load->view('Email/web_enquiry', $web_enquiry, true);
                $this->email->message($htmlsmessage);

                $this->email->print_debugger();
                //$send = $this->email->send();
                //if ($send) {
                //     echo json_encode("send");
                // } else {
                //      $error = $this->email->print_debugger(array('headers'));
                //      echo json_encode($error);
                //  }
            }

            redirect('Shop/contactus');
        }
        $this->load->view('pages/contactus');
    }

    public function aboutus() {
        $this->load->view('pages/aboutus');
    }

    public function schedule() {
        $this->load->view('pages/appointment');
    }

    public function guide() {
        $this->load->view('pages/guide');
    }

    public function term_of_service() {
        $this->load->view('pages/tnc');
    }

    public function faqs() {
        $this->load->view('pages/faqs');
    }

    public function privacy_policy() {
        $this->load->view("pages/policy");
    }

    public function catalogue() {
        $this->load->view('pages/catalogue');
    }

    function testEmail() {
        $receiver = "octopuscartltd@gmail.com";
        $this->email->set_newline("\r\n");
        $this->email->from($receiver, "Test");
        $this->email->to($receiver);
//                $this->email->bcc(email_bcc);
        $subjectt = "Test Email";

        $subject = $subjectt;
        $this->email->subject($subject);
        $this->email->message("This is test mail");
        $this->email->print_debugger();
        $send = $this->email->send();
        if ($send) {
            echo json_encode("send");
            $error = $this->email->print_debugger(array('headers'));
            echo json_encode($error);
        } else {
            $error = $this->email->print_debugger(array('headers'));
            echo json_encode($error);
        }
    }

}
