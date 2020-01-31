<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['id'];
    }

    public function index() {
        redirect('/');
    }

    function start($item_id) {
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
        
        
        
        
        
        
        $this->load->view('Customization/start', $data);
    }

}
