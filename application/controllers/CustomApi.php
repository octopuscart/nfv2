<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class CustomApi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->checklogin = $this->session->userdata('logged_in');
        $this->user_id = $this->session->userdata('logged_in')['id'];
    }

    function customProfileAttributeInsert_post() {
        $styletype = $this->post("styletype");
        $styleid = $this->post("profile");
        $cart_id = $this->post("cart_id");
        $cartarray = explode(",", $cart_id);
        $tag_id = $this->post("tag_id");
        $stylelist = $this->post();
        $stylecontainer = array();
        foreach ($stylelist as $key => $value) {
            $checkstyle = explode("stylekey_", $key);
            if (count($checkstyle) > 1) {
                $stylecontainer[$checkstyle[1]] = $value;
            }
        }
        $last_id = $styletype;
        if ($styletype == 'custom') {
            $profileInsert = array(
                "style_profile" => $styleid,
                "custom_form_data" => "",
                "user_id" => $this->user_id,
                "tag_id" => $tag_id,
                "default" => "0",
                "is_active" => "1",
                "datetime" => date('Y-m-d H:i:s'),
                "update_datetime" => "",
            );

            $this->db->insert("nfw_custom_form_data", $profileInsert);
            $last_id = $this->db->insert_id();
            foreach ($stylecontainer as $key => $value) {
                $syleprofileattr = array(
                    "style_key" => $key,
                    "style_value" => $value,
                    "extra_price" => "",
                    "style_profile" => $last_id,
                    "datetime" => date('Y-m-d H:i:s')
                );
                $this->db->insert("nfw_custom_form_data_attr", $syleprofileattr);
            }
        }

        foreach ($cartarray as $key => $value) {
            $this->db->set('customization_id', $last_id);
            $this->db->set('customization_data', $styleid);
            $this->db->where('id', $value); //set column_name and value in which row need to update
            $this->db->update('nfw_product_cart');
        }
    }

    function customMeausrementApiByItem_get($item_id) {
        $this->db->where('id', $item_id);
        $query = $this->db->get('nfw_product_tag');
        $itemdata = $query->row();
        $return_data['itemconf'] = $itemdata;
        $measurementlistids = $itemdata->measurement_list;
        $posturelistids = $itemdata->posture_list;
        $query = "SELECT * from nfw_measurement where id in ($measurementlistids)";
        $query = $this->db->query($query);
        $measurementdata = $query->result_array();
        $standerd = array();
        $standerd['Profile'] = $itemdata->tag_title . "-" . date('Y/m/d/H:i');
        $standerd['Height'] = "5 Feet";
        $standerd['Weight'] = "70 KG";
        $standerd['Age'] = "25";
        foreach ($measurementdata as $key => $value) {
            $standerd[$value['title']] = $value['standard_value'];
        }

        $posturedata = array();
        $posturelistidslist = explode(",", $posturelistids);
        foreach ($posturelistidslist as $key => $value) {
            $posdata = $this->Product_model->getChildren($value);
            $this->db->where("id", $value);
            $posqry = $this->db->get("nfw_custom_element");
            $posrow = $posqry->row();
            $posturedata[$posrow->title . " Posture"] = $posdata;
            $standerd[$posrow->title . " Posture"] = "-";
        }

        $querycustomprofile = "SELECT * FROM `nfw_custom_form_data` where tag_id=$item_id and user_id=" . $this->user_id . " and custom_form_data='' group by style_profile";
        $query = $this->db->query($querycustomprofile);
        $customprofiles = $query->result_array();
        $customProfileArray = array();
        foreach ($customprofiles as $key => $value) {
            $this->db->where("style_profile", $value['id']);
            $customattr = $this->db->get("nfw_custom_form_data_attr");
            $customattrdata = $customattr->result_array();
            $customProfileArray[$value["id"]] = array("profile" => $value['style_profile'], "style" => $customattrdata, "id" => $value["id"]);
        }



        $return_data['customProfileArray'] = $customProfileArray;
        $return_data['posturedata'] = $posturedata;
        $return_data['standerd'] = $standerd;
        $return_data["measurementdata"] = $measurementdata;
        $this->response($return_data);
    }

    function shirtCustomization_get() {
        $shirtelements = $this->Product_model->shirtCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(10),
            'Collar Style' => $this->Product_model->getChildren(11),
            'Add 2 Buttons On The Collar Band' => $this->Product_model->getChildren('13'),
            'Collar & Cuff Stiffness' => $this->Product_model->getChildren('14'),
            'Collar Stays' => $this->Product_model->getChildren('15'),
            'Sleeve And Cuff Style' => $shirtelements['cuff_style_container'],
            'Wrist Watch' => $shirtelements['watchoption_container'],
            'Front Style' => $this->Product_model->getChildren('16'),
            'Back Style' => $this->Product_model->getChildren('17'),
            'Darts' => $this->Product_model->getChildren('18'),
            'Pocket Style' => $this->Product_model->getChildren('19'),
            'Bottom Style' => $this->Product_model->getChildren('20'),
            'Collar & Cuff Feature' => $this->Product_model->getChildren('21'),
            'Inner Collar Insert' => $shirtelements['ccinsert'],
            'Inner Cuff Insert' => $shirtelements['ccinsert'],
            'Inner Front Placket Insert' => $shirtelements['ccinsert'],
            'Label' => $this->Product_model->getChildren('24'),
            'Button' => $shirtelements['buttoncontainer'],
            'Monogram Placement' => $shirtelements['monogram_placementcontainer'],
            'Monogram Style' => $shirtelements['monogramontainer'],
            'Monogram Initial' => array(),
            'Monogram Color' => $shirtelements['monogram_colorcontainer'],
        );
        $selectelements = array(
            'Body Fit' => "Loose Fit",
            'Collar Style' => 'Medium Spread (1 5/8" x 3 ")',
            'Add 2 Buttons On The Collar Band' => "No",
            'Collar & Cuff Stiffness' => "Standard",
            'Collar Stays' => "Permanent",
            'Sleeve And Cuff Style' => "Long Sleeve Single Cuff Rounded",
            'Wrist Watch' => "No",
            'Front Style' => "Plain Front",
            'Back Style' => "Plain",
            'Darts' => "No Darts",
            'Pocket Style' => "No Pocket",
            'Bottom Style' => "Shirt Tail",
            'Collar & Cuff Feature' => "No",
            'Inner Collar Insert' => "-",
            'Inner Cuff Insert' => "-",
            'Inner Front Placket Insert' => "-",
            'Label' => "Nita Fashions",
            'Button' => "Standard",
            'Monogram Placement' => "No Monogram",
            'Monogram Style' => "-",
            'Monogram Initial' => "-",
            'Monogram Color' => "-",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Collar Style' => array("col" => "4", "lablestyle" => "height:60px", "maxsize" => "bodymax400", "prenext" => 1),
            'Add 2 Buttons On The Collar Band' => array("col" => "3", "prenext" => 1),
            'Collar & Cuff Stiffness' => array("col" => "3", "prenext" => 1,),
            'Collar Stays' => array("col" => "3", "prenext" => 1),
            'Sleeve And Cuff Style' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Wrist Watch' => array("col" => "4", "lablestyle" => "", "depandent" => "Sleeve Style", "prenext" => 1),
            'Front Style' => array("col" => "3", "lablestyle" => "", "prenext" => 1),
            'Back Style' => array("col" => "4", "lablestyle" => "", "prenext" => 1),
            'Darts' => array("col" => "4", "lablestyle" => "", "prenext" => 1),
            'Pocket Style' => array("col" => "4", "lablestyle" => "height:60px", "prenext" => 1),
            'Bottom Style' => array("col" => "4", "lablestyle" => "height:60px", "prenext" => 1),
            'Collar & Cuff Feature' => array("col" => "4", "lablestyle" => "", "prenext" => 1),
            'Inner Collar Insert' => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            'Inner Cuff Insert' => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            'Inner Front Placket Insert' => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            'Label' => array("col" => "4", "lablestyle" => "", "prenext" => 1),
            'Button' => array("col" => "4", "lablestyle" => "", "prenext" => 1),
            'Monogram Placement' => array("col" => "4", "lablestyle" => "", "prenext" => 1),
            'Monogram Style' => array("col" => "2", "lablestyle" => "", "prenext" => 1),
            'Monogram Color' => array("col" => "4", "lablestyle" => "", "prenext" => 1),
            'Monogram Initial' => array("col" => "4", "lablestyle" => "", "view" => "text", "prenext" => 2),
        );
        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "Shirt Customization",
            "item" => "Shirt",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

    function jacketCustomization_get() {
        $jacketelements = $this->Product_model->jacketCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(43),
            'Lapel Style & Width' => $jacketelements['laplestyle'],
            'Lapel Button Hole' => $this->Product_model->getChildren(48),
            'Handstitching' => $this->Product_model->getChildren(49),
            'Front Style' => $jacketelements['front_Style'],
            'Sleeve Buttons' => $jacketelements['sleevebuttons'],
            'Shoulder Padding' => $this->Product_model->getChildren(56),
            'Breast Pocket' => $this->Product_model->getChildren(57),
            'Lower Pocket' => $this->Product_model->getChildren(58),
            'Ticket Pocket' => $this->Product_model->getChildren(59),
            'Lining Type' => $this->Product_model->getChildren(78),
            "Lining Style" => $jacketelements['liningstyle'],
            "Button" => $jacketelements['buttonslist'],
            "Contrast Button Thread" => $jacketelements['contrastarray'],
            "Contrast Button Hole On Lapel" => $jacketelements['contrastarray'],
            "Contrast First Sleeve Button Hole" => $jacketelements['contrastarray'],
        );
        $selectelements = array(
            'Body Fit' => "Loose Fit",
            'Lapel Style & Width' => '3" Classic (Notch Lapel)',
            'Lapel Button Hole' => 'No',
            'Handstitching' => "No",
            'Front Style' => "2 Button (Single Breasted)",
            'Sleeve Buttons' => '4 Flat Buttons (4 Buttons)',
            'Shoulder Padding' => 'Standard',
            'Breast Pocket' => "Slanted Breast Pocket",
            'Lower Pocket' => "Straight Flap Pockets",
            'Ticket Pocket' => "No",
            'Lining Type' => 'Fully Lined',
            "Lining Style" => "Matching",
            "Button" => "Standard",
            "Contrast Button Thread" => "-",
            "Contrast Button Hole On Lapel" => "-",
            "Contrast First Sleeve Button Hole" => "-",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Lapel Style & Width' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Lapel Button Hole' => array("col" => "4", "prenext" => 0),
            'Handstitching' => array("col" => "4", "prenext" => 0),
            'Front Style' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Sleeve Buttons' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Shoulder Padding' => array("col" => "4", "prenext" => 0),
            'Breast Pocket' => array("col" => "4", "prenext" => 0),
            'Lower Pocket' => array("col" => "4", "prenext" => 0),
            'Ticket Pocket' => array("col" => "4", "prenext" => 0),
            'Lining Type' => array("col" => "4", "prenext" => 0),
            "Lining Style" => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            "Button" => array("col" => "2", "lablestyle" => "height:40px", "view" => "buttonview", "prenext" => 1),
            "Contrast Button Thread" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast Button Hole On Lapel" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast First Sleeve Button Hole" => array("col" => "4", "prenext" => 0, "view" => "selection",),
        );

        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "Jacket Customization",
            "item" => "Jacket",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

    function overcoatCustomization_get() {
        $jacketelements = $this->Product_model->jacketCustomElement();
        $overcoatelement = $this->Product_model->overcoatCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(71),
            'Category' => $this->Product_model->getChildren(72),
            'Lapel Style & Width' => $overcoatelement['overcoatlaple'],
            'Lapel Button Hole' => $this->Product_model->getChildren(75),
            'Front Style' => $overcoatelement['front_Style'],
            'Sleeve Buttons' => $jacketelements['sleevebuttons'],
            'Shoulder Epaulettes' => $this->Product_model->getChildren(75),
            'Sleeve Epaulettes' => $this->Product_model->getChildren(77),
            'Breast Pocket' => $this->Product_model->getChildren(80),
            'Lower Pocket' => $this->Product_model->getChildren(81),
            'Inside Zipper Pocket' => $this->Product_model->getChildren(82),
            'Lining Type' => $this->Product_model->getChildren(78),
            "Lining Style" => $jacketelements['liningstyle'],
            "Contrast Button Thread" => $jacketelements['contrastarray'],
            "Contrast Button Hole On Lapel" => $jacketelements['contrastarray'],
            "Contrast First Sleeve Button Hole" => $jacketelements['contrastarray'],
        );
        $selectelements = array(
            'Body Fit' => "Loose Fit",
            'Category' => 'Car Coat',
            'Lapel Style & Width' => '3" Modern (Notch Lapel)',
            'Lapel Button Hole' => 'No',
            'Front Style' => "2 Buttons (Single Breasted)",
            'Sleeve Buttons' => '4 Flat Buttons (4 Buttons)',
            'Shoulder Epaulettes' => "No",
            "Sleeve Epaulettes" => "No",
            'Breast Pocket' => "Slanted Pocket",
            'Lower Pocket' => "Slanted",
            'Inside Zipper Pocket' => "No",
            'Lining Type' => 'Fully Lined',
            "Lining Style" => "Matching",
            "Contrast Button Thread" => "-",
            "Contrast Button Hole On Lapel" => "-",
            "Contrast First Sleeve Button Hole" => "-",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Category' => array("col" => "4", "prenext" => 0),
            'Lapel Style & Width' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Lapel Button Hole' => array("col" => "4", "prenext" => 0),
            'Front Style' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Sleeve Buttons' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Shoulder Epaulettes' => array("col" => "4", "prenext" => 0),
            'Sleeve Epaulettes' => array("col" => "4", "prenext" => 0),
            'Breast Pocket' => array("col" => "4", "prenext" => 0),
            'Lower Pocket' => array("col" => "4", "prenext" => 0),
            'Inside Zipper Pocket' => array("col" => "4", "prenext" => 0),
            'Lining Type' => array("col" => "4", "prenext" => 0),
            "Lining Style" => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            "Contrast Button Thread" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast Button Hole On Lapel" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast First Sleeve Button Hole" => array("col" => "4", "prenext" => 0, "view" => "selection",),
        );

        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "Overcoat Customization",
            "item" => "Overcoat",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

    function pantCustomization_get() {
        $jacketelements = $this->Product_model->jacketCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(1),
            'Number of Pleat' => $jacketelements['pantpleat'],
            'Waistband' => $this->Product_model->getChildren(2),
            'Suspender Buttons on Inner waistband' => $this->Product_model->getChildren(3),
            'Cuff' => $this->Product_model->getChildren(5),
            'Zipper - Front Fly' => $this->Product_model->getChildren(6),
            'Front Pocket Style' => $this->Product_model->getChildren(7),
            'Number of Back Pocke' => $this->Product_model->getChildren(8),
        );
        $selectelements = array(
            'Body Fit' => "Medium Fit",
            'Number of Pleat' => 'No Pleat',
            'Waistband' => 'Belt Loop',
            'Suspender Buttons on Inner waistband' => "No",
            'Cuff' => "No Cuff",
            'Zipper - Front Fly' => 'Metal (Standard)',
            'Front Pocket Style' => '1/4" Slanting Pocket (Standard)',
            'Number of Back Pocke' => "2 Pockets with Buttons (Standard)",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Number of Pleat' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Waistband' => array("col" => "4", "prenext" => 0),
            'Suspender Buttons on Inner waistband' => array("col" => "4", "prenext" => 0),
            'Cuff' => array("col" => "4", "prenext" => 0),
            'Zipper - Front Fly' => array("col" => "4", "prenext" => 0),
            'Front Pocket Style' => array("col" => "4", "prenext" => 0),
            'Number of Back Pocke' => array("col" => "4", "prenext" => 0),
        );

        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "Pant Customization",
            "item" => "Pant",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

    function suitCustomization_get() {
        $jacketelements = $this->Product_model->jacketCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(43),
            'Lapel Style & Width' => $jacketelements['laplestyle'],
            'Lapel Button Hole' => $this->Product_model->getChildren(48),
            'Handstitching' => $this->Product_model->getChildren(49),
            'Front Style' => $jacketelements['front_Style'],
            'Sleeve Buttons' => $jacketelements['sleevebuttons'],
            'Shoulder Padding' => $this->Product_model->getChildren(56),
            'Breast Pocket' => $this->Product_model->getChildren(57),
            'Lower Pocket' => $this->Product_model->getChildren(58),
            'Ticket Pocket' => $this->Product_model->getChildren(59),
            'Lining Type' => $this->Product_model->getChildren(78),
            "Lining Style" => $jacketelements['liningstyle'],
            "Button" => $jacketelements['buttonslist'],
            "Contrast Button Thread" => $jacketelements['contrastarray'],
            "Contrast Button Hole On Lapel" => $jacketelements['contrastarray'],
            "Contrast First Sleeve Button Hole" => $jacketelements['contrastarray'],
            'Number of Pleat' => $jacketelements['pantpleat'],
            'Waistband' => $this->Product_model->getChildren(2),
            'Suspender Buttons on Inner waistband' => $this->Product_model->getChildren(3),
            'Cuff' => $this->Product_model->getChildren(5),
            'Zipper - Front Fly' => $this->Product_model->getChildren(6),
            'Front Pocket Style' => $this->Product_model->getChildren(7),
            'Number of Back Pocke' => $this->Product_model->getChildren(8),
        );
        $selectelements = array(
            'Body Fit' => "Loose Fit",
            'Lapel Style & Width' => '3" Classic (Notch Lapel)',
            'Lapel Button Hole' => 'No',
            'Handstitching' => "No",
            'Front Style' => "2 Button (Single Breasted)",
            'Sleeve Buttons' => '4 Flat Buttons (4 Buttons)',
            'Shoulder Padding' => 'Standard',
            'Breast Pocket' => "Slanted Breast Pocket",
            'Lower Pocket' => "Straight Flap Pockets",
            'Ticket Pocket' => "No",
            'Lining Type' => 'Fully Lined',
            "Lining Style" => "Matching",
            "Button" => "Standard",
            "Contrast Button Thread" => "-",
            "Contrast Button Hole On Lapel" => "-",
            "Contrast First Sleeve Button Hole" => "-",
            'Number of Pleat' => 'No Pleat',
            'Waistband' => 'Belt Loop',
            'Suspender Buttons on Inner waistband' => "No",
            'Cuff' => "No Cuff",
            'Zipper - Front Fly' => 'Metal (Standard)',
            'Front Pocket Style' => '1/4" Slanting Pocket (Standard)',
            'Number of Back Pocke' => "2 Pockets with Buttons (Standard)",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Lapel Style & Width' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Lapel Button Hole' => array("col" => "4", "prenext" => 0),
            'Handstitching' => array("col" => "4", "prenext" => 0),
            'Front Style' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Sleeve Buttons' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Shoulder Padding' => array("col" => "4", "prenext" => 0),
            'Breast Pocket' => array("col" => "4", "prenext" => 0),
            'Lower Pocket' => array("col" => "4", "prenext" => 0),
            'Ticket Pocket' => array("col" => "4", "prenext" => 0),
            'Lining Type' => array("col" => "4", "prenext" => 0),
            "Lining Style" => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            "Button" => array("col" => "2", "lablestyle" => "height:40px", "view" => "buttonview", "prenext" => 1),
            "Contrast Button Thread" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast Button Hole On Lapel" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast First Sleeve Button Hole" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            'Number of Pleat' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Waistband' => array("col" => "4", "prenext" => 0),
            'Suspender Buttons on Inner waistband' => array("col" => "4", "prenext" => 0),
            'Cuff' => array("col" => "4", "prenext" => 0),
            'Zipper - Front Fly' => array("col" => "4", "prenext" => 0),
            'Front Pocket Style' => array("col" => "4", "prenext" => 0),
            'Number of Back Pocke' => array("col" => "4", "prenext" => 0),
        );

        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "Suit Customization",
            "item" => "Suit",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

    function waistcoatCustomization_get() {
        $waistelements = $this->Product_model->waistCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(62),
            'Lapel Style & Width' => $waistelements['waistcoatlaple'],
            'Lapel Button Hole' => $this->Product_model->getChildren(66),
            'Handstitching' => $this->Product_model->getChildren(67),
            'Front Style' => $waistelements['front_Style'],
            'Front Edge' => $this->Product_model->getChildren(68),
            'Back Fabric' => $waistelements['liningstyle'],
            'Back Style' => $this->Product_model->getChildren(69),
            'Breast Pocket' => $this->Product_model->getChildren(70),
            'Lower Pocket' => $this->Product_model->getChildren(73),
        );
        $selectelements = array(
            'Body Fit' => "Medium Fit",
            'Lapel Style & Width' => 'No Lapel',
            'Lapel Button Hole' => 'No',
            'Handstitching' => "No",
            'Front Style' => "Single Breasted (5 Buttons)",
            'Front Edge' => 'Metal (Standard)',
            'Back Fabric' => '1/4" Slanting Pocket (Standard)',
            'Back Style' => "Welt Pocket",
            'Breast Pocket' => "No",
            'Lower Pocket' => "Welt Pocket",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Lapel Style & Width' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Lapel Button Hole' => array("col" => "4", "prenext" => 0),
            'Handstitching' => array("col" => "4", "prenext" => 0),
            'Front Style' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Front Edge' => array("col" => "4", "prenext" => 0),
            'Back Fabric' => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            'Back Style' => array("col" => "4", "prenext" => 0),
            'Breast Pocket' => array("col" => "4", "prenext" => 0),
            'Lower Pocket' => array("col" => "4", "prenext" => 0),
        );

        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "Pant Customization",
            "item" => "Pant",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

    function c3PieceSuitCustomization_get() {
        $jacketelements = $this->Product_model->jacketCustomElement();
        $waistelements = $this->Product_model->waistCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(43),
            'Lapel Style & Width' => $jacketelements['laplestyle'],
            'Lapel Button Hole' => $this->Product_model->getChildren(48),
            'Handstitching' => $this->Product_model->getChildren(49),
            'Front Style' => $jacketelements['front_Style'],
            'Sleeve Buttons' => $jacketelements['sleevebuttons'],
            'Shoulder Padding' => $this->Product_model->getChildren(56),
            'Breast Pocket' => $this->Product_model->getChildren(57),
            'Lower Pocket' => $this->Product_model->getChildren(58),
            'Ticket Pocket' => $this->Product_model->getChildren(59),
            'Lining Type' => $this->Product_model->getChildren(78),
            "Lining Style" => $jacketelements['liningstyle'],
            "Button" => $jacketelements['buttonslist'],
            "Contrast Button Thread" => $jacketelements['contrastarray'],
            "Contrast Button Hole On Lapel" => $jacketelements['contrastarray'],
            "Contrast First Sleeve Button Hole" => $jacketelements['contrastarray'],
            'Waistcoat  Lapel Style & Width' => $waistelements['waistcoatlaple'],
            'Waistcoat Lapel Button Hole' => $this->Product_model->getChildren(66),
            'Waistcoat Handstitching' => $this->Product_model->getChildren(67),
            'Waistcoat Front Style' => $waistelements['front_Style'],
            'Waistcoat Front Edge' => $this->Product_model->getChildren(68),
            'Waistcoat Back Fabric' => $waistelements['liningstyle'],
            'Waistcoat Back Style' => $this->Product_model->getChildren(69),
            'Waistcoat Breast Pocket' => $this->Product_model->getChildren(70),
            'Waistcoat Lower Pocket' => $this->Product_model->getChildren(73),
            'Number of Pleat' => $jacketelements['pantpleat'],
            'Waistband' => $this->Product_model->getChildren(2),
            'Suspender Buttons on Inner waistband' => $this->Product_model->getChildren(3),
            'Cuff' => $this->Product_model->getChildren(5),
            'Zipper - Front Fly' => $this->Product_model->getChildren(6),
            'Front Pocket Style' => $this->Product_model->getChildren(7),
            'Number of Back Pocke' => $this->Product_model->getChildren(8),
        );
        $selectelements = array(
            'Body Fit' => "Loose Fit",
            'Lapel Style & Width' => '3" Classic (Notch Lapel)',
            'Lapel Button Hole' => 'No',
            'Handstitching' => "No",
            'Front Style' => "2 Button (Single Breasted)",
            'Sleeve Buttons' => '4 Flat Buttons (4 Buttons)',
            'Shoulder Padding' => 'Standard',
            'Breast Pocket' => "Slanted Breast Pocket",
            'Lower Pocket' => "Straight Flap Pockets",
            'Ticket Pocket' => "No",
            'Lining Type' => 'Fully Lined',
            "Lining Style" => "Matching",
            "Button" => "Standard",
            "Contrast Button Thread" => "-",
            "Contrast Button Hole On Lapel" => "-",
            "Contrast First Sleeve Button Hole" => "-",
            'Waistcoat Lapel Style & Width' => 'No Lapel',
            'Waistcoat Lapel Button Hole' => 'No',
            'Waistcoat Handstitching' => "No",
            'Waistcoat Front Style' => "Single Breasted (5 Buttons)",
            'Waistcoat Front Edge' => 'Metal (Standard)',
            'Waistcoat Back Fabric' => '1/4" Slanting Pocket (Standard)',
            'Waistcoat Back Style' => "Welt Pocket",
            'Waistcoat Breast Pocket' => "No",
            'Waistcoat Lower Pocket' => "Welt Pocket",
            'Number of Pleat' => 'No Pleat',
            'Waistband' => 'Belt Loop',
            'Suspender Buttons on Inner waistband' => "No",
            'Cuff' => "No Cuff",
            'Zipper - Front Fly' => 'Metal (Standard)',
            'Front Pocket Style' => '1/4" Slanting Pocket (Standard)',
            'Number of Back Pocke' => "2 Pockets with Buttons (Standard)",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Lapel Style & Width' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Lapel Button Hole' => array("col" => "4", "prenext" => 0),
            'Handstitching' => array("col" => "4", "prenext" => 0),
            'Front Style' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Sleeve Buttons' => array("col" => "4", "lablestyle" => "", "view" => "multicol", "prenext" => 1),
            'Shoulder Padding' => array("col" => "4", "prenext" => 0),
            'Breast Pocket' => array("col" => "4", "prenext" => 0),
            'Lower Pocket' => array("col" => "4", "prenext" => 0),
            'Ticket Pocket' => array("col" => "4", "prenext" => 0),
            'Lining Type' => array("col" => "4", "prenext" => 0),
            "Lining Style" => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            "Button" => array("col" => "2", "lablestyle" => "height:40px", "view" => "buttonview", "prenext" => 1),
            "Contrast Button Thread" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast Button Hole On Lapel" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            "Contrast First Sleeve Button Hole" => array("col" => "4", "prenext" => 0, "view" => "selection",),
            'Waistcoat Lapel Style & Width' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Waistcoat Lapel Button Hole' => array("col" => "4", "prenext" => 0),
            'Waistcoat Handstitching' => array("col" => "4", "prenext" => 0),
            'Waistcoat Front Style' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Waistcoat Front Edge' => array("col" => "4", "prenext" => 0),
            'Waistcoat Back Fabric' => array("col" => "4", "lablestyle" => "", "view" => "multi", "prenext" => 1),
            'Waistcoat Back Style' => array("col" => "4", "prenext" => 0),
            'Waistcoat Breast Pocket' => array("col" => "4", "prenext" => 0),
            'Waistcoat Lower Pocket' => array("col" => "4", "prenext" => 0),
            'Number of Pleat' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Waistband' => array("col" => "4", "prenext" => 0),
            'Suspender Buttons on Inner waistband' => array("col" => "4", "prenext" => 0),
            'Cuff' => array("col" => "4", "prenext" => 0),
            'Zipper - Front Fly' => array("col" => "4", "prenext" => 0),
            'Front Pocket Style' => array("col" => "4", "prenext" => 0),
            'Number of Back Pocke' => array("col" => "4", "prenext" => 0),
        );

        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "3 Piece Customization",
            "item" => "3 Piece",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

    function tuxedoPantCustomization_get() {
        $jacketelements = $this->Product_model->jacketCustomElement();
        $shirtCustomization = array(
            'Body Fit' => $this->Product_model->getChildren(1),
            'Number of Pleat' => $jacketelements['pantpleat'],
            'Ribbon on Side Seam' => $this->Product_model->getChildren(9),
            'Waistband' => $this->Product_model->getChildren(2),
            'Suspender Buttons on Inner waistband' => $this->Product_model->getChildren(3),
            'Cuff' => $this->Product_model->getChildren(5),
            'Zipper - Front Fly' => $this->Product_model->getChildren(6),
            'Front Pocket Style' => $this->Product_model->getChildren(7),
            'Number of Back Pocke' => $this->Product_model->getChildren(8),
        );
        $selectelements = array(
            'Body Fit' => "Medium Fit",
            'Number of Pleat' => 'No Pleat',
            'Ribbon on Side Seam' => 'Satin',
            'Waistband' => 'Belt Loop',
            'Suspender Buttons on Inner waistband' => "No",
            'Cuff' => "No Cuff",
            'Zipper - Front Fly' => 'Metal (Standard)',
            'Front Pocket Style' => '1/4" Slanting Pocket (Standard)',
            'Number of Back Pocke' => "2 Pockets with Buttons (Standard)",
        );
        $mainnavigation = array(
            'Body Fit' => array("col" => "4", "prenext" => 0),
            'Number of Pleat' => array("col" => "4", "lablestyle" => "", "view" => "multicol2", "prenext" => 1),
            'Ribbon on Side Seam' => array("col" => "4", "prenext" => 0),
            'Waistband' => array("col" => "4", "prenext" => 0),
            'Suspender Buttons on Inner waistband' => array("col" => "4", "prenext" => 0),
            'Cuff' => array("col" => "4", "prenext" => 0),
            'Zipper - Front Fly' => array("col" => "4", "prenext" => 0),
            'Front Pocket Style' => array("col" => "4", "prenext" => 0),
            'Number of Back Pocke' => array("col" => "4", "prenext" => 0),
        );

        $return_data = array(
            "formItems" => $shirtCustomization,
            "navigation" => $mainnavigation,
            "title" => "Pant Customization",
            "item" => "Pant",
            "selection" => $selectelements,
        );
        $this->response($return_data);
    }

}

?>