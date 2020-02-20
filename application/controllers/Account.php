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
        if (isset($session_user['login_id'])) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
    }

    public function index() {
        redirect('Account/profile');
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


                $user_id = $userdata['id'];
                // $session_cart = $this->session->userdata('session_cart');
                // $productlist = $session_cart['products'];
                //$this->Product_model->cartOperationCustomCopy($user_id);

                $this->session->set_userdata('logged_in', $userdata);



                redirect('Shop/index');
            } else {
                // $data1['msg'] = 'Invalid Email Or Password, Please Try Again';
                //  redirect('Shop/index', $data1);
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



        $link = isset($_GET['page']) ? $_GET['page'] : '';
        $data1['next_link'] = $link;


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
                        'user_img' => "",
                        'contact_no' => "",
                        'status' => "Inactive",
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

}

?>
