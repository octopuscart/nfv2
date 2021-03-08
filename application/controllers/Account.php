<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->model('Product_model');
        $session_user = $this->session->userdata('logged_in');
        if (isset($session_user['id'])) {
            $this->user_id = $session_user['id'];
        } else {
            $this->user_id = 0;
        }
    }

    public function index() {
        redirect('Account/profile');
    }

    function backendlogin() {
        $username = $this->input->get('email');
        $password = $this->input->get('password');

        $this->db->select('*');
        $this->db->from('auth_user au');
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $userdata = $query->result_array()[0];
            $usr = $userdata['email'];
            $pwd = $userdata['password'];

            $this->db->where('user_id', $userdata['id']);
            $this->db->order_by('id desc');
            $query = $this->db->get('auth_event');
            $lastlogin = $query->row();
            $userdata['lastlogin'] = $lastlogin->time_stamp;


            $user_id = $userdata['id'];
            // $session_cart = $this->session->userdata('session_cart');
            // $productlist = $session_cart['products'];
            //$this->Product_model->cartOperationCustomCopy($user_id);

            $this->session->set_userdata('logged_in', $userdata);



            redirect('Account');
        } else {
            // $data1['msg'] = 'Invalid Email Or Password, Please Try Again';
            //  redirect('Shop/index', $data1);
        }
    }

    function userLogin() {
        if (isset($_POST['login'])) {
            $username = $this->input->post('email');
            $password = $this->input->post('password');

            $this->db->select('*');
            $this->db->from('auth_user au');
            $this->db->where('email', $username);
            $this->db->where('password', md5($password));
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $userdata = $query->result_array()[0];
                $usr = $userdata['email'];
                $pwd = $userdata['password'];

                $this->db->where('user_id', $userdata['id']);
                $this->db->order_by('id desc');
                $query = $this->db->get('auth_event');
                $lastlogin = $query->row();
                $userdata['lastlogin'] = $lastlogin->time_stamp;

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                $userarray = array(
                    'client_ip' => $ip,
                    'user_id' => $userdata['id'],
                    'origin' => "",
                    'time_stamp' => date('Y-m-d H:i:s'),
                    'description' => "",
                );
                $this->db->insert('auth_event', $userarray);
                $user_id = $this->db->insert_id();




                $user_id = $userdata['id'];
                // $session_cart = $this->session->userdata('session_cart');
                // $productlist = $session_cart['products'];
                //$this->Product_model->cartOperationCustomCopy($user_id);

                $this->session->set_userdata('logged_in', $userdata);



                redirect('Shop/index');
            } else {
                $data1['msg'] = 'Invalid Email Or Password, Please Try Again';
                redirect('Shop/index', $data1);
            }
        }
    }

    function registration() {
        $data1['msg'] = "";
        $data1["link"] = site_url("Account/registration");
        $data1['msgtype'] = 'success';

        $query = $this->db->get('countries');
        $countrylist = $query->result_array();
        $data1['country_list'] = $countrylist;


        $query = $this->db->get('nfw_profession');
        $professionlist = $query->result_array();
        $data1['professionlist'] = $professionlist;



        $link = isset($_GET['page']) ? $_GET['page'] : '';
        $data1['next_link'] = $link;
        $temp = array_merge(range('A', 'Z'), range(0, 9));
        $temp1 = "";
        for ($i = 0; $i < 8; $i++) {
            $temp1 .= $temp[rand(0, (count($temp) - 1))];
        }
        $token = md5($temp1);

        if (isset($_POST['registration'])) {

            $captchacode = $this->session->userdata('captchacode');


            $password = $this->input->post('pass');
            $cpassword = $this->input->post('con_pass');

            $email = $this->input->post('email');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $middle_name = $this->input->post('middle_name');

            $birth_year = $this->input->post('birth_year');
            $birth_month = $this->input->post('birth_month');
            $birth_date = $this->input->post('birth_date');

            $birth = $birth_year . '-' . $birth_month . '-' . $birth_date;

            $birth_date = $birth;

            $gender = $this->input->post('gender');
            $country = $this->input->post('country');
            $profession = $this->input->post('profession_id');
            $gender = $this->input->post("gender");
            $data1['user_id'] = 0;

            if ($cpassword == $password) {
                $user_check = $this->User_model->check_user($email);
                if ($user_check) {
                    $data1['msg'] = 'Email Address Already Registered.';
                    $data1["link"] = site_url("Account/registration");
                    $data1['msgtype'] = 'warning';
                } else {
                    $userarray = array(
                        'middle_name' => $middle_name,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'password' => md5($password),
                        'telephone_no' => "",
                        'fax_no' => "",
                        'registration_id' => "",
                        'gender' => $gender,
                        'country' => $country,
                        'birth_date' => $birth,
                        'user_img' => $token,
                        'contact_no' => "",
                        'status' => "Active",
                        'profession_id' => $profession,
                        'profession_value' => "",
                        'joining_date' => date('Y-m-d H:i:s'),
                        'remark' => "",
                    );
                    $this->db->insert('auth_user', $userarray);
                    $user_id = $this->db->insert_id();

                    $this->db->where('id', $user_id);
                    $query = $this->db->get('auth_user');
                    $userdata = $query->result_array()[0];
                    $this->session->set_userdata('logged_in', $userdata);
                    $data1['msg'] = 'Verification Mail Sent, Check Your Inbox';
                    $data1["link"] = site_url("/");
                    $data1['msgtype'] = 'success';
                    $data1['user_id'] = $user_id;
                    $username = $userdata['first_name'] . ' ' . $userdata['middle_name'] . ' ' . $userdata['last_name'];
                    $email = $userdata['email'];
                    $token = "";
//                    redirect('/');
                }
            } else {
                $data1['msgtype'] = 'error';
                $data1['msg'] = 'Password did not match.';
                $data1["link"] = site_url("Account/registration");
            }
        }
        $this->load->view('Account/registration', $data1);
    }

    function activation() {
        $user_id = $this->input->get('user_id');
        $this->db->where('id', $user_id);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $token = $this->input->get("token");
        $data = array();
        if ($token == $userdata['user_img']) {
            $this->db->set('status', '1');
            $this->db->where('id', $adid); //set column_name and value in which row need to update
            $this->db->update("auth_user");
            $data['status'] = '1';
            $data['messsage'] = "<i class='fa fa-smile-o'></i> Your Account has been activated.";
        } else {
            $data['status'] = '0';
            $data['messsage'] = "Error in activation link please check the link in your email.";
        }
        $this->load->view('Account/activation', $data);
    }

    // Logout from admin page
    function logout() {
        $newdata = array(
            'username' => '',
            'password' => '',
            'logged_in' => FALSE,
        );

        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();

        redirect('Shop/index');
    }

    function profile() {
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;
        $data["message"] = "";
        if (isset($_POST['updatePass'])) {
            $pass1 = $this->input->post("pwd");
            $pass2 = $this->input->post("pwd1");
            if ($pass1 == $pass2) {
                $this->db->where('id', $userid);
                $this->db->set('password', md5($pass1));
                $this->db->update("auth_user");
                $data["message"] = "Password changed.";
            } else {
                $data["message"] = "Password not matched.";
            }
        }


        $this->load->view('Account/profile', $data);
    }

    function address() {
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;

        if (isset($_POST['deleteAddress'])) {
            echo $addrid = $this->input->post("deleteAddress");
            $this->db->where('id', $addrid);
            $query = $this->db->delete('nfw_billing_shipping_address');
            redirect("Account/address");
        }
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
            redirect("Account/address");
        }

        if (isset($_POST['setDefault'])) {
            $adid = $this->input->post("setDefault");

            $this->db->set('default_shipping_address', '');
            $this->db->where('user_id', $this->user_id); //set column_name and value in which row need to update
            $this->db->update("nfw_billing_shipping_address");

            $this->db->set('default_shipping_address', 'yes');
            $this->db->where('id', $adid); //set column_name and value in which row need to update
            $this->db->update("nfw_billing_shipping_address");
        }


        $this->load->view('Account/address', $data);
    }

    function storCredit() {
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;
        $this->load->view('Account/storeCredit', $data);
    }

    function orderList() {
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;

        $query = " SELECT npo.id,npo.op_date,npo.op_time,npo.order_no,
                   npo.total_price,tag.title FROM `nfw_product_order` as npo 
                   join nfw_order_status as nos on npo.id = nos.order_id
                   join nfw_order_status_tag as tag on nos.status = tag.id
                   where npo.user_id =  $userid  order by op_date desc,npo.order_no desc";
        $data['order_data'] = $this->Product_model->resultAssociate($query);

        $this->load->view('Account/orderList', $data);
    }

    function orderTracking() {
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;
        $query = "SELECT nos.* FROM `nfw_order_shipping` as nos join nfw_product_order as no
                      on nos.order_id = no.id where no.user_id = $userid order by no.op_date desc, nos.order_no desc";

        $data['data'] = $this->Product_model->resultAssociate($query);
        $data['productmodel'] = $this->Product_model;
        $this->load->view('Account/orderTracking', $data);
    }

    function paymentHistory() {
        $userid = $this->user_id;
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;

        $po_query = "";



        $query = "SELECT np.transaction_no,np.status,po.order_no,ni.invoice_no,ni.op_date,ni.op_time,ni.total_amount,nc.card_number,nc.bank_name, po.payment_gateway FROM `nfw_order_invoice` as ni
                      join nfw_order_payment as np on ni.order_id = np.order_id
                      join nfw_product_order as po on ni.order_id = po.id
                      left join nfw_user_card as nc on np.card_id = nc.id
                      where ni.user_id = " . $userid . $po_query . " order by ni.invoice_no desc,ni.op_date desc";


        $data['data'] = $this->Product_model->resultAssociate($query);
        $data['productmodel'] = $this->Product_model;
        $this->load->view('Account/paymentHistory', $data);
    }

    function newsLetters() {
        $userid = $this->user_id;
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;



        $data["maliInfo"] = $this->Product_model->resultAssociate("select * from nfw_news_letters as nnl join nfw_news_letter_box as nlb on nlb.news_letter_id=nnl.id  where nlb.receiver_id='$userid' and nlb.flag in (0,1)");

        $data["total_msg"] = $this->Product_model->resultAssociate("select * from nfw_news_letters as nnl join nfw_news_letter_box as nlb on nlb.news_letter_id=nnl.id  where nlb.receiver_id='$userid' and nlb.flag in (0,1)");
        $data["read_msg"] = $this->Product_model->resultAssociate("select * from nfw_news_letters as nnl join nfw_news_letter_box as nlb on nlb.news_letter_id=nnl.id  where nlb.receiver_id='$userid' and nlb.flag in (1)");
        $data["unread_msg"] = $this->Product_model->resultAssociate("select * from nfw_news_letters as nnl join nfw_news_letter_box as nlb on nlb.news_letter_id=nnl.id  where nlb.receiver_id='$userid' and nlb.flag in (0)");


        if (isset($_POST["deletenews"])) {
            $deleteid = $this->input->post("newsid");
            $this->db->where("id", $deleteid);
            $this->db->set("flag", "2");
            $this->db->update("nfw_news_letter_box");
            redirect("Account/newsLetters");
        }

        $this->load->view('Account/newsLetters', $data);
    }

    function preferences() {
        $userid = $this->user_id;
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;

        $po_query = "";



        $query = "SELECT np.transaction_no,np.status,po.order_no,ni.invoice_no,ni.op_date,ni.op_time,ni.total_amount,nc.card_number,nc.bank_name, po.payment_gateway FROM `nfw_order_invoice` as ni
                      join nfw_order_payment as np on ni.order_id = np.order_id
                      join nfw_product_order as po on ni.order_id = po.id
                      left join nfw_user_card as nc on np.card_id = nc.id
                      where ni.user_id = " . $userid . $po_query . " order by ni.invoice_no desc,ni.op_date desc";


        $data['data'] = $this->Product_model->resultAssociate($query);
        $data['productmodel'] = $this->Product_model;
        $this->load->view('Account/preferences', $data);
    }

    function invoices() {
//        orderSortDetail()
        $userid = $this->user_id;
        $this->db->where('id', $userid);
        $query = $this->db->get('auth_user');
        $userdata = $query->row_array();
        $data['userInfo'] = $userdata;
        $query = "SELECT * FROM nfw_product_order as no
                     where no.user_id = $userid order by no.op_date desc";
        $orderdata = $this->Product_model->resultAssociate($query);
        $orderarray = array();
        foreach ($orderdata as $key => $value) {
            $orderid = $value['id'];
            $order = $this->Product_model->orderSortDetail($orderid);
            array_push($orderarray, $order);
        }
        $data['invoicedata'] = $orderarray;

        $this->load->view('Account/orderInvoice', $data);
    }

    function resetPassword() {
        $data = array();
        $this->load->view('Account/resetPassword', $data);
    }

}

?>
