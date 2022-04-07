<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
    }

    public function index() {
        redirect('/');
    }

    public function testmail() {

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'server.costcointernational.com',
            'smtp_port' => 587,
            'smtp_user' => 'no-reply-nitafashions@octopuscart.in',
            'smtp_pass' => 'M5?$Ad%N{UTvfT&-',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        print_r($this->email);
        $this->email->set_newline("\r\n");
        $this->email->from('sales@nitafashions.com', 'Nita Fashions');
        $this->email->to("octopuscartltd@gmail.com");
   
        $this->email->subject('Test mail from nita fashions');
        $this->email->message("this is test mail from nit fashions.");
        echo $result = $this->email->send();
    }

}
?>

