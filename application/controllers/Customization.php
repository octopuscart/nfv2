<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $session_user = $this->session->userdata('logged_in');
        if (isset($session_user['id'])) {
            $this->user_id = $session_user['id'];
        } else {
            $this->user_id = 0;
        }
    }

    public function index() {
        redirect('/');
    }

    function start($item_id) {
        if (!$this->user_id) {
            redirect("/");
        }
        $data['item_id'] = $item_id;
        $customdatalink = array(
            "1" => "shirtCustomization",
            "5" => "jacketCustomization",
            "12" => "jacketCustomization",
            "2" => "pantCustomization",
            "11" => "suitCustomization",
            "3" => "waistcoatCustomization",
            "13" => "c3PieceSuitCustomization",
            "15" => "overcoatCustomization",
            "8" => "tuxedoPantCustomization"
        );


        $this->db->where('id', $item_id);
        $query = $this->db->get('nfw_product_tag');
        $itemdata = $query->row();
        $return_data['itemconf'] = $itemdata;
        $measurementlistids = $itemdata->measurement_list;
        $query = "SELECT * from nfw_measurement where id in ($measurementlistids)";
        $query = $this->db->query($query);
        $measurementdata = $query->result_array();
        $data['measurements'] = $measurementdata;

        $data['customlink'] = $customdatalink[$item_id];


        if (isset($_POST['shopStoredMeasurements'])) {
            $cartids = $this->input->post('cart_id');
            foreach ($cartids as $key => $value) {
                if ($value) {
                    $this->db->set('measurement_id', "0");
                    $this->db->set('measurement_data', "Shop Stored");
                    $this->db->where('id', $value); //set column_name and value in which row need to update
                    $this->db->update('nfw_product_cart');
                }
            }
            redirect("Shop/cart");
        }

        if (isset($_POST['confirm_measurements'])) {
            $profile = $this->input->post('profile_name');
            $profileInsert = array(
                "measurement_profile" => $this->input->post('profile_name'),
                "measurement_data" => "",
                "posture_data" => "",
                "user_id" => $this->user_id,
                "user_images" => "",
                "tag_id" => $item_id,
                "default" => "0",
                "is_active" => "1",
                "datetime" => date('Y-m-d H:i:s'),
                "update_datetime" => "",
            );
            $this->db->insert("nfw_measurement_data", $profileInsert);
            $measurement_id = $this->db->insert_id();
            $cartids = $this->input->post('cart_id');

            $measurementsk = $this->input->post('measurementkey');
            $measurementvalue = $this->input->post('measurementvalue');
            $posturekey = $this->input->post('posturekey');
            $posturevalue = $this->input->post('posturevalue');

            foreach ($measurementsk as $key => $value) {
                $valuemes = $measurementvalue[$key];
                $measurementArray = array(
                    "measurement_key" => $value,
                    "measurement_value" => $valuemes,
                    "measurement_type" => "measurement",
                    "profile_id" => $measurement_id
                );
                $this->db->insert("nfw_measurement_attr", $measurementArray);
            }

            foreach ($posturekey as $key => $value) {
                $valuemes = $posturevalue[$key];
                $measurementArray = array(
                    "measurement_key" => $value,
                    "measurement_value" => $valuemes,
                    "measurement_type" => "posture",
                    "profile_id" => $measurement_id
                );
                $this->db->insert("nfw_measurement_attr", $measurementArray);
            }



            foreach ($cartids as $key => $value) {
                if ($value) {
                    $this->db->set('measurement_id', $measurement_id);
                    $this->db->set('measurement_data', $profile);
                    $this->db->where('id', $value); //set column_name and value in which row need to update
                    $this->db->update('nfw_product_cart');
                }
            }
            redirect("Shop/cart");
        }



        $this->load->view('Customization/start', $data);
    }

}
