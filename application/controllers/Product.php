<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['id'];
    }

    public function index() {
        redirect('/');
    }

    function shopAllCart() {
        $this->load->view('Product/shopAllCart');
    }

    //function for product list
    function productList() {
        $id = $_GET['item_type'];
        $catid = $_GET['category'];
        $query = "select tag_title from nfw_product_tag where id = $id";
        $res = $this->Product_model->resultAssociate($query);
        $data['tagdata'] = $res;
        if ($catid == 0) {

            $query = "select ct.* from nfw_category as ct"
                    . " right join  nfw_category_tag_connection "
                    . "as nct on nct.category_id = ct.id where nct.tag_id=$id order by index_menu";
            $categorylist = $this->Product_model->resultAssociate($query);
        } else {
            $this->db->where('parent', $catid);
            $this->db->order_by('index_menu asc');
            $query = $this->db->get('nfw_category');
            $categorylist = $query->result_array();
        }
        $data['categorylist'] = $categorylist;

        $this->load->view('Product/productList2', $data);
    }

    //function for product list
    function productListOffers() {
        $id = $_GET['item_type'];
        $catid = $_GET['category'];
        $query = "select tag_title from nfw_product_tag where id = $id";
        $res = $this->Product_model->resultAssociate($query);
        $data['tagdata'] = $res;
        if ($catid == 0) {

            $query = "select ct.* from nfw_category as ct"
                    . " right join  nfw_category_tag_connection "
                    . "as nct on nct.category_id = ct.id where nct.tag_id=$id order by index_menu";
            $categorylist = $this->Product_model->resultAssociate($query);
        } else {
            $this->db->where('parent', $catid);
            $this->db->order_by('index_menu asc');
            $query = $this->db->get('nfw_category');
            $categorylist = $query->result_array();
        }
        $data['categorylist'] = $categorylist;

        $this->load->view('Product/productListOffers', $data);
    }

    function ProductSearch() {
        $data['keyword'] = $_GET['keyword'];
        $this->load->view('Product/productSearch', $data);
    }

    //function for details
    function ProductDetails($product_id, $item_id) {
        $prodct_details = $this->Product_model->productItemInformation($product_id, $item_id);
        $data['product'] = $prodct_details;
        $data['item_id'] = $item_id;
        if ($prodct_details) {
            $this->load->view('Product/productDetails', $data);
        } else {
            $this->load->view('errors/html/error_404');
        }
    }

    function test() {
//        $this->session->unset_userdata('session_cart');
        //$session_cart = $this->Product_model->cartOperation(214, 1);
        $session_cart = $this->Product_model->cartData();
        echo "<pre>";
        print_r($session_cart);
    }

    function unsetData() {
        $this->session->unset_userdata('session_cart');
    }

    function customizationShirt1($productid) {
        $productdetails = $this->Product_model->productDetails($productid);

        $data['productdetails'] = $productdetails;
        $this->load->view('Product/customization_shirt', $data);
    }

    function customizationRedirect($custom_id, $product_id) {
        if ($custom_id == 1) {
            redirect('Product/customizationShirt/' . $product_id . "/" . $custom_id);
        }
        if ($custom_id == 2) {
            redirect('Product/customizationSuit/' . $product_id . "/" . $custom_id);
        }
        if ($custom_id == 4) {
            redirect('Product/customizationJacket/' . $product_id . "/" . $custom_id);
        }
        if ($custom_id == 3) {
            redirect('Product/customizationPant/' . $product_id . "/" . $custom_id);
        }

        if ($custom_id == 5) {
            redirect('Product/customizationTuxedoSuit/' . $product_id . "/" . $custom_id);
        }
        if ($custom_id == 6) {
            redirect('Product/customizationTuxedoJacket/' . $product_id . "/" . $custom_id);
        }
        if ($custom_id == 7) {
            redirect('Product/customizationTuxedoPant/' . $product_id . "/" . $custom_id);
        }
    }

    function customizationShirt($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "Pant";
        $data['custom_id'] = $custom_id;
        $this->load->view('Product/customization_shirt', $data);
    }

    function customizationSuit($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "Suit";
        $data['custom_id'] = $custom_id;
        $data['tuxedotype'] = "0";
        $this->load->view('Product/customization_suit_v2', $data);
    }

    function customizationTuxedoSuit($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "TuxedoSuit";
        $data['custom_id'] = $custom_id;

        $data['tuxedotype'] = "1";

        $this->load->view('Product/customization_suit_v2', $data);
    }

    function customizationTuxedoJacket($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "TuxedoJacket";
        $data['custom_id'] = $custom_id;
        $data['tuxedotype'] = "1";
        $this->load->view('Product/customization_suit_v2', $data);
    }

    function customizationTuxedoPant($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "TuxedoPant";
        $data['custom_id'] = $custom_id;
        $data['tuxedotype'] = "1";
        $this->load->view('Product/customization_suit_v2', $data);
    }

    function customizationSuitV2($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "Suit";
        $data['custom_id'] = $custom_id;
        $data['tuxedotype'] = "0";
        $this->load->view('Product/customization_suit_v3', $data);
    }

    function customizationPant($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "Pant";
        $data['custom_id'] = $custom_id;
        $data['tuxedotype'] = "0";
        $this->load->view('Product/customization_suit_v2', $data);
    }

    function customizationPantV2($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "Pant";
        $data['custom_id'] = $custom_id;
        $this->load->view('Product/customization_suit_v3', $data);
    }

    function customizationJacket($productid, $custom_id) {
        $productdetails = $this->Product_model->productDetails($productid, $custom_id);
        $data['productdetails'] = $productdetails;
        $data["custom_item"] = "Jacket";
        $data['custom_id'] = $custom_id;
        $data['tuxedotype'] = "0";
        $this->load->view('Product/customization_suit_v2', $data);
    }

}
