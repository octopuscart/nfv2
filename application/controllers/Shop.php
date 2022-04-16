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

    public function error404() {
        set_status_header('404');
        $this->load->view('errors/error_404');
    }

    public function index3() {
        $this->load->library('user_agent');

        $checkmobile = $this->agent->is_mobile();

        $data['checkmobile'] = $checkmobile;
        $data['featuredProducts'] = $this->Product_model->featurProductTag();
        $this->load->view('home', $data);
    }

    public function index() {
        $this->load->library('user_agent');

        $checkmobile = $this->agent->is_mobile();
        $query = $this->db->get('countries');
        $countrylist = $query->result_array();
        $data['country_list'] = $countrylist;

        $query = $this->db->get('nfw_profession');
        $professionlist = $query->result_array();
        $data['professionlist'] = $professionlist;
        $data['checkmobile'] = $checkmobile;
        $data['featuredProducts'] = $this->Product_model->featurProductTag();
        $this->load->view('homev3', $data);
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
            $maintotal = $this->input->post('maintotal');

            $query = "SELECT address1,address2,city,state,country,zip FROM `nfw_billing_shipping_address` where id = $ship_id ";
            $shipresult = $this->Product_model->resultAssociate($query);
            $shipdata = json_encode(end($shipresult));

            $query = "SELECT id,first_name,middle_name,last_name,email,telephone_no,fax_no,contact_no,registration_id FROM  `auth_user` where id = $this->user_id";
            $userinfo = $this->Product_model->resultAssociate($query);
            $userdata = json_encode(end($userinfo));

            if ($data['cardinfo']) {
                $carddata1 = $this->session->userdata('cardinfo');
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
                "sub_total" => $maintotal,
                "total_price" => $grandtotal,
                "shipping_amount" => $shippingprice,
                "total_quantity" => $totalquantity,
                "billing_id" => "",
                "shipping_id" => $shipdata,
                "coupon_id" => "",
                "payment_gateway" => $cardTitle,
                "payment_gateway_return" => "",
                "order_no" => "",
                "card" => $carddata1,
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

            $url = "http://email.nitafashions.com/nfemail/views/sendMail.php?order_id=$last_id&user_id=$this->user_id&mail_type=1&mail_set=order";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = curl_exec($curl);
            curl_close($curl);

            redirect("Order/orderdetails/" . $last_id);
        }
        $this->load->view('Product/shopCart', $data);
    }

    public function error() {
        redirect(site_url("/"));
    }

    public function contactus() {
        if (isset($_POST['submitEnquiry'])) {
            $captcha = $this->input->post('g-recaptcha-response');
            if (1) {
                $web_enquiry = array(
                    'name' => $this->input->post('name'),
                    'address' => $this->input->post('address'),
                    'email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject'),
                    'message' => $this->input->post('message'),
                );
                $email_bcc = "do-not-reply-nita-fashions-ssl-email-465@costcokart.com";
                $this->email->set_newline("\r\n");
                $this->email->from("sales@nitafashions.com", "Nita Fashions");
                $this->email->to($this->input->post('email'));
                $this->email->bcc(email_bcc);
                $subjectt = $this->input->post('subject');
                $subject = "Enquiry from website - " . $this->input->post('subject');
                $this->email->subject($subject);
                $web_enquiry['web_enquiry'] = $web_enquiry;
                $htmlsmessage = $this->load->view('Email/web_enquiry', $web_enquiry, true);
                $this->email->message($htmlsmessage);
                $send = $this->email->send();
                if ($send) {
//                    echo json_encode("send");
                } else {
                    $error = $this->email->print_debugger(array('headers'));
                    //  echo json_encode($error);
                }
                redirect('Shop/contactus');
            }
        }
        $this->load->view('pages/contactus');
    }

    public function aboutus() {
        $this->load->view('pages/aboutus');
    }

    public function bespokeTailoring() {
        $this->load->view('pages/bespokeTailoring');
    }

    public function scheduleview($last_id) {
        $data["last_id"] = $last_id;
        $this->load->view('pages/appointmentview', $data);
    }

    public function schedule() {
        $cdate = date("Y-m-d");
        $rquery = "
                  SELECT sa.*,sed.start_date,sed.end_date,sed.id as main_id
                  FROM  `nfw_app_set_appointment` as sa 
                  join nfw_app_start_end_date as sed  
                  on sa.id = sed.nfw_set_appointment_id
                   where sed.end_date> date('$cdate')    
                   ";
        $query = $this->db->query($rquery);

        $data = $query->result_array();
        if (isset($_POST['submit'])) {
            $inputdata = $this->input->post();
            $inputarray = array(
                "nfw_time_schedule_id" => $inputdata['select_time'],
                "first_name" => ($inputdata['first_name']),
                "last_name" => ($inputdata['last_name']),
                "email" => $inputdata['email'],
                "telephone" => $inputdata['telephone'],
                "address" => "",
                "op_date" => date('Y-m-d'),
                "op_time" => date('H:i:s'),
                "no_of_person" => $inputdata['no_of_person'],
            );
            $this->db->insert('nfw_app_userlist', $inputarray);
            $last_id = $this->db->insert_id();
            $url = "http://email.nitafashions.com/nfemail/views/sendMail_app.php?mail_type=4&last_id=$last_id";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = curl_exec($curl);
            curl_close($curl);
            redirect(site_url("Shop/scheduleview/$last_id"));
        }

        $this->load->view('pages/appointment', array("data" => $data));
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

    public function virtualAppointment() {
        $postdata = $this->input->post();
        $returnarray = array(
            "code" => "100",
            "message" => ""
        );
        $appointment_id = 0;
        if (isset($_POST['registration'])) {
            $captchaset = $this->input->post('captcha');
            $captchacode = $this->session->userdata('captchacode');

            if ($captchaset == $captchacode) {
                $receiver = $this->input->post('email');
                $web_enquiry = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'select_date' => $this->input->post('select_date'),
                    'select_time' => $this->input->post('select_time'),
                    'timezone' => $this->input->post('timezone'),
                    'country' => $this->input->post('country'),
                    'email' => $receiver,
                );

//                $this->db->insert('virtual_appointments', $web_enquiry);
//                $appointment_id = $this->db->insert_id();

                $this->email->set_newline("\r\n");
                $this->email->from("sales@nitafashions.com", "Nita Fashions");
                $this->email->to(email_bcc . ", " . $receiver);
                $this->email->bcc("do-not-reply-nita-fashions-ssl-email-465@costcointernational.com");

                $subject = "Nita Fashions - Virtual Appointment Request";
                $this->email->subject($subject);
                $web_enquiry['web_enquiry'] = $web_enquiry;
                $htmlsmessage = $this->load->view('Email/virtual_appointment', $web_enquiry, true);
                $this->email->message($htmlsmessage);
                $send = $this->email->send();
                if ($send) {
                    $returnarray = array(
                        "code" => "200",
                        "message" => "Thank you for reaching us for a Virtual Appointment",
                        "web_enquiry" => $web_enquiry,
                    );
                } else {
                    $returnarray = array(
                        "code" => "400",
                        "message" => "Unable to create appointment, please try again later or contact to us."
                    );
                }
            } else {
                $returnarray = array(
                    "code" => "400",
                    "message" => "You have entered wrong captcha, please try again."
                );
            }
        } else {
            redirect(site_url("/"));
        }

        $this->load->view('pages/virtualAppointment', $returnarray);
    }

    public function newsLetters() {
        $postdata = $this->input->post();
        $returnarray = array(
            "code" => "100",
            "message" => ""
        );
        if (isset($_POST['subscribe'])) {
            $captchaset = $this->input->post('captcha');
            $captchacode = $this->session->userdata('captchacodens');

            if ($captchaset == $captchacode) {
                $request_user = $this->input->post('subscribe_email');
                $web_enquiry = array(
                    'subscribe_first' => $this->input->post('subscribe_first'),
                    'subscribe_last' => $this->input->post('subscribe_last'),
                    'subscribe_email' => $request_user,
                );
                $this->email->set_newline("\r\n");
                $this->email->from("sales@nitafashions.com", "Nita Fashions");
                $this->email->to(email_bcc . ", " . $request_user);
                $this->email->bcc("do-not-reply-nita-fashions-ssl-email-465@costcointernational.com");

                $subject = "Nita Fashions - Thank you for subscribing!";
                $this->email->subject($subject);
                $web_enquiry['web_enquiry'] = $web_enquiry;
                $htmlsmessage = $this->load->view('Email/newsletters', $web_enquiry, true);
                $this->email->message($htmlsmessage);
                $send = $this->email->send();
                if ($send) {
                    $returnarray = array(
                        "code" => "200",
                        "web_enquiry" => $web_enquiry,
                        "message" => "Thank you for subscribing to our mailing list. Your will receive our newsletter for exclusive offers."
                    );
                } else {
                    $returnarray = array(
                        "code" => "400",
                        "message" => "Unable to subscribe to our mailing list, please try again later or contact to us."
                    );
                }
            } else {
                $returnarray = array(
                    "code" => "400",
                    "message" => "You have entered wrong captcha, please try again."
                );
            }
        } else {
            redirect(site_url("/"));
        }
        $this->load->view('pages/newsletters', $returnarray);
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
