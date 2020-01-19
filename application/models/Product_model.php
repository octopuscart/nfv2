<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function edit_table_information($tableName, $id) {
        $this->User_model->tracking_data_insert($tableName, $id, 'update');
        $this->db->update($tableName, $id);
    }

    public function query_exe($query) {
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        } else {
            return array();
        }
    }

    function delete_table_information($tableName, $columnName, $id) {
        $this->db->where($columnName, $id);
        $this->db->delete($tableName);
    }

    function convert_num_word($number) {
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $wordsz = array('0' => 'zero', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',);
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else
                $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $result = $result ? $result : $wordsz[$result / 10];
        $points = ($point) ?
                " and " . $wordsz[$point / 10] . " " .
                $wordsz[$point = $point % 10] : '';
        return "Only " . globle_currency . $result . " " . ($points ? "" . $points . " Cents" : "") . "";
    }

    function productInformation($product_id) {
        $fquery = "SELECT * FROM nfw_product where id = '$product_id'";
        $fquery = $this->db->query($fquery);
        $productinfo = $fquery->result_array();
        $productinfo = $productinfo ? $productinfo[0] : array();
        
        $iquery = "select concat('".IMAGESERVER."', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = '".$product_id."' order by display_priority desc";
        $iquery = $this->db->query($iquery);
        $productimage = $iquery->result_array();
        $productinfo['images'] = $productimage;
        return $productinfo;
    }
    
    function productItemInformation($product_id, $item_id){
        $productinfo = $this->productInformation($product_id);
        $this->db->where('tag_id', $item_id);
        $query = $this->db->get('nfw_product_tag_connection');
        $producttag = $query->row();
        $this->db->where('id', $item_id);
        $query = $this->db->get('nfw_product_tag');
        $tag = $query->row();
        $productinfo['item_name'] = $tag->tag_title;
        $productinfo['price'] = $producttag->price;
        return $productinfo;
    }

    function featurProductTag($product_id) {
        $fquery = "SELECT nfw_product_id FROM nfw_product_featured ";
        $fquery = $this->db->query($fquery);
        $fprdlist = $fquery->result_array();
        $featurProducts = array();
        foreach ($fprdlist as $pkey => $pvalue) {
            $pid = $pvalue['nfw_product_id'];
            $query = "SELECT pt.tag_title,ptc.price,ptc.tag_id,ptc.product_id FROM `nfw_product_tag_connection` as ptc 
                 join nfw_product_tag as pt on ptc.tag_id = pt.id
                 join nfw_product_featured as pf on ptc.product_id = pf.nfw_product_id
                 where ptc.product_id = $pid limit 0,1";
            $query = $this->db->query($query);
            $frtdata = $query->row();

            $productinfo = $this->productInformation($pid);

            $productinfo['imagelink'] = $productinfo['images'];
            $productinfo['tag_id'] = $frtdata ? $frtdata->tag_id : '';
            $productinfo['tag_title'] = $frtdata ? $frtdata->tag_title : '';
            $productinfo['price'] = $frtdata ? $frtdata->price : '';
            array_push($featurProducts, $productinfo);
        }
        return $featurProducts;
    }
    
    
    function getCartData(){
        $query = "SELECT * from nfw_product_cart where user_id = '$this->user_id' and customization_id = '0' and !order_id;";
        $query = $this->db->query($query);
        $cartdata = $query->result_array();
        $productcart = array();
        foreach ($cartdata as $key => $value) {
            $productcart[$value['product_id']."_".$value['tag_id']] = $value;
        }
        return $productcart;
    }

}
