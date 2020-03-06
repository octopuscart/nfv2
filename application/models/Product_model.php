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

        $iquery = "select concat('" . IMAGESERVER . "', image) as image 
                  from nfw_product_images 
                  where nfw_product_id = '" . $product_id . "' order by display_priority desc";
        $iquery = $this->db->query($iquery);
        $productimage = $iquery->result_array();
        $productinfo['images'] = $productimage;
        return $productinfo;
    }

    function productColor($product_id) {
        $query = "SELECT nc.* FROM `nfw_product_color` as pc join 
                        nfw_color as nc on pc.nfw_color_id = nc.id
                        join nfw_product as np on pc.nfw_product_id = np.id
                        where np.id = '$product_id' ";
        $result = $this->resultAssociate($query);
        return $result;
    }

    function relatedProducts($product_id) {

        $related_product_query = " select nfw_related_product_id as nfw_product_id from nfw_product_related where nfw_product_id = $product_id ";
        $related_product_list = $this->resultAssociate($related_product_query);
        return $related_product_list;
    }

    function productItemInformation($product_id, $item_id) {
        $productinfo = $this->productInformation($product_id);
        $this->db->where('tag_id', $item_id);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('nfw_product_tag_connection');
        $producttag = $query->row();
        $this->db->where('id', $item_id);
        $query = $this->db->get('nfw_product_tag');
        $tag = $query->row();

        $this->db->where('id', $productinfo['product_category']);
        $query = $this->db->get('nfw_category');
        $productcat = $query->row();

        $productinfo['item_name'] = $tag->tag_title;
        $productinfo['price'] = $producttag->sale_price ? $producttag->sale_price : $producttag->price;
        $productinfo['rprice'] = $producttag->price;
        $productinfo['sprice'] = $producttag->sale_price ? $producttag->sale_price : 0;
        $productinfo['categorystring'] = $this->getparent($productinfo['product_category']);
        $productinfo['category_name'] = $productcat->name;
        $productinfo['productColor'] = $this->productColor($product_id);

        $relatedproducts = $this->relatedProducts($product_id);

        $related = [];

        if ($relatedproducts) {
            foreach ($relatedproducts as $key => $value) {
                $pid = $value['nfw_product_id'];
                $productinfo2 = $this->productInformation($pid);
                $this->db->where('tag_id', $item_id);
                $this->db->where('product_id', $productinfo2['id']);
                $query = $this->db->get('nfw_product_tag_connection');
                $producttag2 = $query->row();
                $productinfo2['price'] = $producttag2->sale_price ? $producttag2->sale_price : $producttag2->price;

                array_push($related, $productinfo2);
            }
        }
        $productinfo['related'] = $related;
        return $productinfo;
    }

    function featurProductTag($product_id = '') {
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

    function getCustomizationDataById($custom_id) {
        $this->db->where('id', $custom_id);
        $query = $this->db->get('nfw_custom_form_data');
        $customdata = $query->row();

        $tempcustom = array("Style Profile" => "", "style" => array(), "extra_price" => array());

        if ($customdata) {
            $customDataArray = array();

            $this->db->where('style_profile', $custom_id);
            $query = $this->db->get('nfw_custom_form_data_attr');
            $customdataattr = $query->result_array();
            $tempcustom["Style Profile"] = $customdata->style_profile;
            foreach ($customdataattr as $key1 => $value1) {
                $tempcustom['style'][$value1['style_key']] = $value1['style_value'];
                if ($value1['extra_price']) {
                    $tempcustom['extra_price'][$value1['style_key']] = $value1['extra_price'];
                }
            }
        }
        return $tempcustom;
    }

    function getCartDataCustom() {
        $query = "SELECT * from nfw_product_cart where user_id = '$this->user_id' and customization_id != '' and measurement_id = '' and !order_id;";
        $query = $this->db->query($query);
        $cartdata = $query->result_array();
        $cartdataid = array();
        foreach ($cartdata as $key => $value) {
            $customdata = $this->getCustomizationDataById($value['customization_id']);
            $cartdataid[$value['id']] = array("item" => $value, "custom_data" => $customdata);
        }
        return $cartdataid;
    }

    function getCartDataCustomOrder($order_id) {
        $query = "SELECT * from nfw_product_cart where user_id = '$this->user_id' and order_id='$order_id';";
        $query = $this->db->query($query);
        $cartdata = $query->result_array();
        $cartdataid = array();
        foreach ($cartdata as $key => $value) {
            $customdata = $this->getCustomizationDataById($value['customization_id']);
            $cartdataid[$value['id']] = array("item" => $value, "custom_data" => $customdata);
        }
        return $cartdataid;
    }

    function phpjsonstyle($data, $data_type) {

        $data = trim(trim($data, "{"), "}");
        $t = explode(",", $data);

        $temp = array();
        foreach ($t as $key => $value) {
            $t1 = explode(':', $value);
            if (count($t1) > 1) {
                $temp3 = $t1[1];
                $temp3 = substr($temp3, 0, -1);
                $temp3 = ltrim($temp3, '"');
                $temp31 = str_replace("++*++", ",", $temp3);
                $temp32 = str_replace("|||||", "'", $temp31);
                $temp[trim($t1[0], '"')] = $temp32;
            }
        }

        if ($data_type == 'php') {
            return $temp;
        }
        if ($data_type == 'json') {
            return json_encode($temp);
        }
    }

    function getCartData() {
        $query = "SELECT * from nfw_product_cart where user_id = '$this->user_id' and  measurement_id = '' and !order_id;";
        $query = $this->db->query($query);
        $cartdata = $query->result_array();
        $productcart = array();
        $productarray2 = array();
        $productTitleIds = array();
        foreach ($cartdata as $key => $value) {
            $producttagid = $value['product_id'] . "_" . $value['tag_id'];
            $productcart[$producttagid] = $value;
            if (isset($productTitleIds[$value['tag_id']])) {
                array_push($productTitleIds[$value['tag_id']], $value);
            } else {
                $productTitleIds[$value['tag_id']] = [$value];
            }
        }
        return array("cartdata" => $productcart, "cartitemids" => $productTitleIds);
    }

    function resultAssociate($query) {
        $fquery = $this->db->query($query);
        $datalist = $fquery->result_array();
        return $datalist ? $datalist : [];
    }

    function getparent($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('nfw_category');
        $texts = array();
        foreach ($query->result_array() as $row) {
            if (isset($row['parent_id'])) {
                $texts = $this->getparent($row['parent_id']);
                array_push($texts, $row);
            }
        }
        return $texts;
    }

    function getChildren($custom_element_id) {
        $row_query = "SELECT * FROM `nfw_custom_element_field` where nfw_custom_element_id = $custom_element_id";
        $resultdata = $this->resultAssociate($row_query);
        $container = array();
        foreach ($resultdata as $key => $value) {
            $tempcontain = array(
                "title" => $value['title'],
                "image" => $value['set_image'],
                "default" => $value['standard'],
                "lable" => $value['child_label'],
                "status" => "1",
                "parent" => "",
                "parenttitle" => ""
            );
            array_push($container, $tempcontain);
        }
        return $container;
    }

    //support function

    function statusTag($ids) {
        //echo $ids;
        $query = "SELECT title FROM `nfw_order_status_tag` where id = $ids ";
        $result = $this->resultAssociate($query);
        return $result;
    }

    function orderSortDetail($order_id) {
        $query = "  SELECT * FROM `nfw_product_cart` where order_id='$order_id' ;";
        $query = $this->db->query($query);
        $cartdata = $query->result_array();

        $this->db->where('id', $order_id);
        $query = $this->db->get('nfw_product_order');
        $orderDetails = $query->row_array();
        $orderDetails['products'] = $cartdata;
        $orderDetails['subtotal'] = 0;
        foreach ($cartdata as $key => $value) {
            $custom_id = $value['customization_id'];
            $customdata = $this->getCustomizationDataById($custom_id);
            $orderDetails['subtotal'] += $value['total_price'];
//            $value['style'] = $customdata;
//            array_push($orderDetails['products'], $value);
        }
        return $orderDetails;
    }

    //end of support


    function shirtCustomElement() {
        $returnData = array();
        $watchoption_style = array(
            'nowatch' => 'No',
            'leftwatch' => 'Right Wrist',
            'rightwatch' => 'Left Wrist'
        );
        $watchoption_container = array();
        foreach ($watchoption_style as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/watch/" . $key . ".jpg",
                "default" => $value == 'No' ? '1' : '',
                "lable" => $value,
                "status" => "1",
                "parent" => "Long Sleeve",
                "parenttitle" => "Sleeve Style",
            );
            array_push($watchoption_container, $tempcontain);
        }
        $returnData['watchoption_container'] = $watchoption_container;

        $cuff_style = array(
            '1' => 'Single Cuff Rounded', '2' => 'Single Cuff Squared',
            '3' => 'Single Cuff Cutaway', '4' => 'French Cuff  Rounded',
            '5' => 'French Cuff Squared', '6' => 'French Cuff Cutaway',
            '7' => 'Convertible  Cuff Rounded', '8' => 'Convertible Cuff Square',
            '9' => 'Convertible Cuff Cutaway', '10' => '2 Buttons Rounded',
            '11' => '2 Buttons Squared', '12' => '2 Buttons Cutaway',
            '13' => 'Milanese Cuff',
        );

        $cuff_style_container = array("Short Sleeve" => [], "Long Sleeve" => []);
        foreach ($cuff_style as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/cuff_shirt/" . $key . ".jpg",
                "default" => $value == 'Single Cuff Rounded' ? '1' : '',
                "lable" => "Long Sleeve " . $value,
                "status" => "1",
                "parent" => "Long Sleeve",
                "parenttitle" => "Sleeve Style",
                "child" => array("Wrist Watch" => "No")
            );
            array_push($cuff_style_container["Long Sleeve"], $tempcontain);
        }

        $shortsleevestyle = [
            array(
                "title" => "Short Sleeve Without Cuff",
                "image" => base_url() . "assets/custom_form_view/shirt/cuff_shirt/withoutcuff_sort.jpg",
                "default" => "1",
                "lable" => "Short Sleeve Without Cuff",
                "parenttitle" => "Sleeve Style",
                "status" => "1",
                "parent" => "Short Sleeve",
            ),
            array(
                "title" => "Short Sleeve With Cuff",
                "image" => base_url() . "assets/custom_form_view/shirt/cuff_shirt/withcuff_sort.jpg",
                "default" => "",
                "lable" => "Short Sleeve With Cuff",
                "status" => "1",
                "parenttitle" => "Sleeve Style",
                "parent" => "Short Sleeve",
            ),
        ];
        foreach ($shortsleevestyle as $key => $value) {
            array_push($cuff_style_container["Short Sleeve"], $value);
        }
        $returnData['cuff_style_container'] = $cuff_style_container;

        $sleevestyle = [
            array(
                "title" => "Short Sleeve",
                "image" => base_url() . "assets/custom_form_view/shirt/cuff_shirt/withoutcuff_sort.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "Short Sleeve",
                "parent" => "",
                "child" => array("Cuff Style" => "Short Sleeve Without Cuff", "Wrist Watch" => "No")
            ),
            array(
                "title" => "Long Sleeve",
                "image" => "https://nitafashions.com/nfw/small/custom_57657134840.jpeg",
                "default" => "1",
                "lable" => "Long Sleeve",
                "status" => "1",
                "parent" => "",
                "child" => "Cuff Style",
                "child" => array("Cuff Style" => "Single Cuff Rounded", "Wrist Watch" => "No")
            ),
        ];
        $returnData['sleevestyle'] = $sleevestyle;

        $tuxedocuff_style = array(
            '4' => 'French Cuff  Rounded',
            '5' => 'French Cuff Squared',
            '6' => 'French Cuff Cutaway',
            '7' => 'Convertible  Cuff Rounded',
            '8' => 'Convertible Cuff Squared',
            '9' => 'Convertible Cuff Cutaway',
        );
        $tuxedocuff = [];
        foreach ($tuxedocuff_style as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/cuff_shirt/" . $key . ".jpg",
                "default" => $value == 'French Cuff  Rounded' ? '1' : '',
                "lable" => "Long Sleeve " . $value,
                "status" => "1",
                "parent" => "Long Sleeve",
                "parenttitle" => "Sleeve Style",
                "child" => array("Wrist Watch" => "No")
            );
            array_push($tuxedocuff, $tempcontain);
        }
        $returnData['tuxedosleevestyle'] = $tuxedocuff;



        $printed = array(
            '1.jpg' => 'P 44 ', '2.jpg' => 'P 45 ', '3.jpg' => 'P 49 ', '4.jpg' => 'P 50 ',
            '5.jpg' => 'P 51 ', '6.jpg' => 'P 58 ', '7.jpg' => 'P 61 ', '8.jpg' => 'P 63 ',
            '9.jpg' => 'P 65 ', '19.jpg' => 'P 67 ', '20.jpg' => 'P 78 ', '21.jpg' => 'P 96 ',
            '22.jpg' => 'P 98 ', '23.jpg' => 'P 99 ', '24.jpg' => 'P 100 ', '25.jpg' => 'P 102 ',
            '26.jpg' => 'P 104 ', '27.jpg' => 'P 105 ', '28.jpg' => 'P 106 ', '29.jpg' => 'P 107 ',
            '30.jpg' => 'P 109 ', '31.jpg' => 'P 110 ', '32.jpg' => 'P 112 ', '33.jpg' => 'P 113 ',
            '34.jpg' => 'P 115 ', '35.jpg' => 'P 135 ', '10.jpg' => 'P 126 ', '11.jpg' => 'P 127 ',
            '12.jpg' => 'P 128 ', '13.jpg' => 'P 129 ', '14.jpg' => 'P 130 ', '15.jpg' => 'P 131 ',
            '16.jpg' => 'P 144 ', '17.jpg' => 'P 145 ', '18.jpg' => 'P 148 ',
        );
        $solid = array(
            '8.jpg' => 'B 153 ', '9.jpg' => 'B 155 ', '10.jpg' => 'B 159 ', '11.jpg' => 'B 162 ',
            '12.jpg' => 'B 165 ', '13.jpg' => 'B 166 ', '14.jpg' => 'B 167 ', '15.jpg' => 'B 171 ',
            '16.jpg' => 'B 174 ', '17.jpg' => 'B 176 ', '18.jpg' => 'B 177 ', '1.jpg' => 'D 692 ',
            '2.jpg' => 'D 694 ', '3.jpg' => 'D 698 ', '4.jpg' => 'D 700 ', '5.jpg' => 'D 701 ',
            '6.jpg' => 'D 703 ', '7.jpg' => 'D 704 ',
        );



        $ccinsert = array("Printed" => [], "Solid" => []);
        foreach ($solid as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/fabric/solid_collar/" . $key,
                "default" => $value == 'No' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "status" => "1",
                "extra_price" => "10",
                "parenttitle" => "",
            );
            array_push($ccinsert['Solid'], $tempcontain);
        }

        foreach ($printed as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/fabric/printed_collar/" . $key,
                "default" => $value == 'No' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "status" => "1",
                "parenttitle" => "",
                "extra_price" => "10"
            );
            array_push($ccinsert['Printed'], $tempcontain);
        }
        $returnData['ccinsert'] = $ccinsert;

        $buttonarray = array(
            'standard' => ['Standard', ''],
            'matching' => ['Matching', ''],
            '1' => ['Thick Mop', '10'],
            '2' => ['Thin Mop', '10'],
            '3' => ['Black Lipshell', '10'],
        );
        $buttoncontainer = [];
        foreach ($buttonarray as $key => $value) {
            $tempcontain = array(
                "title" => $value[0],
                "image" => base_url() . "assets/custom_form_view/shirt/button_shirt/" . $key . ".png",
                "default" => $value[0] == 'No' ? '1' : '',
                "lable" => $value[0],
                "status" => "1",
                "parent" => "",
                "extra_price" => $value[1],
                "parenttitle" => "",
            );
            array_push($buttoncontainer, $tempcontain);
        }
        $returnData['buttoncontainer'] = $buttoncontainer;


        $tuxedobuttonarray = array(
            'black' => 'Black Button',
            'white' => 'White Button',
            'black-stud' => 'Studs With Black Button Strip',
            'white-stud' => 'Studs With White Button Strip',
        );
        $tuxbuttoncontainer = [];
        foreach ($tuxedobuttonarray as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/tuxedo_shirt/button_shirt/" . $key . ".jpg",
                "default" => $value == 'black' ? '1' : '',
                "lable" => $value,
                "status" => "1",
                "parent" => "",
                "extra_price" => "",
                "parenttitle" => "",
            );
            array_push($tuxbuttoncontainer, $tempcontain);
        }
        $returnData['tuxedobuttoncontainer'] = $tuxbuttoncontainer;


        $monogram = array(
            '1' => '1', '3' => '3', '8' => '8', '10' => '10', '13' => '13', '14' => '14', '15' => '15', '16' => '16',
            '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24',
            '27' => '27', '28' => '28', '30' => '30', '31' => '31', '34' => '34', '36' => '36'
        );
        $monogramontainer = [];
        foreach ($monogram as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/monogram_shirt/" . $key . ".jpg",
                "default" => $value == '1' ? '1' : '',
                "lable" => $value,
                "status" => "1",
                "parent" => "",
                "parenttitle" => "",
                "extra_price" => ""
            );
            array_push($monogramontainer, $tempcontain);
        }
        $returnData['monogramontainer'] = $monogramontainer;

        $monogram_placement = array(
            'no_monogram' => 'No Monogram',
            'left_cuff' => 'Left Cuff',
            'left_chest_pocket' => 'Left Chest Pocket',
            'left_sleeve_plocket' => 'Left Sleeve Placket',
            'left_abdomen' => 'Left Abdomen',
            'inside_coller_band' => 'Inside Collar Band',
            'shirt_tail' => 'Shirt Tail',
        );

        $monogram_placementcontainer = [];
        foreach ($monogram_placement as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/monogram_placement/" . $key . ".jpg",
                "default" => $value == 'No Monogram' ? '1' : '',
                "lable" => $value,
                "status" => $value == 'Left Chest Pocket' ? '0' : '1',
                "parent" => "",
                "parenttitle" => "",
            );
            array_push($monogram_placementcontainer, $tempcontain);
        }
        $returnData['monogram_placementcontainer'] = $monogram_placementcontainer;

        $monogram_color = array(
            'Contrast_Thread' => 'Contrast Thread',
            'Matching_Thread' => 'Matching Thread',
        );


        $monogram_colorcontainer = [];
        foreach ($monogram_color as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/shirt/monogram_color/" . $key . ".jpg",
                "default" => $value == 'No Monogram' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "status" => "1",
                "parenttitle" => "",
            );
            array_push($monogram_colorcontainer, $tempcontain);
        }
        $returnData['monogram_colorcontainer'] = $monogram_colorcontainer;
        return $returnData;
    }

    function jacketCustomElement() {
        $returnData = array();
        $febricbanbemberg = ['3201', '3209', '3219', '3241', '3250', '3259', '3269', '3277', '3287', '3298', '3307', '3317', '3385',
            '3202', '3210', '3221', '3234', '3242', '3251', '3260', '3271', '3279', '3289', '3300', '3308', '3318', '3386',
            '3203', '3211', '3222', '3235', '3244', '3252', '3261', '3272', '3280', '3291', '3302', '3309', '3320', '3388',
            '3204', '3212', '3223', '3236', '3245', '3253', '3264', '3273', '3281', '3294', '3303', '3311', '3380', '3389',
            '3205', '3213', '3224', '3237', '3246', '3254', '3266', '3274', '3282', '3295', '3304', '3313', '3382',
            '3206', '3215', '3226', '3238', '3248', '3256', '3267', '3275', '3284', '3296', '3305', '3314', '3383',
            '3208', '3217', '3229', '3239', '3249', '3257', '3268', '3276', '3286', '3297', '3306', '3316', '3384'];
        sort($febricbanbemberg);
        $febricfancy = array(
            'K1' => 'K1', 'K2' => 'K2', 'K3' => 'K3', 'K4' => 'K4', 'K5' => 'K5', 'K6' => 'K6', 'K7' => 'K7', 'K8' => 'K8', 'K9' => 'K9', 'K10' => 'K10', 'K11' => 'K11', 'K12' => 'K12', 'K13' => 'K13', 'K14' => 'K14', 'K15' => 'K15', 'K16' => 'K16', 'K17' => 'K17',
            'K18' => 'K18', 'K19' => 'K19', 'K20' => 'K20', 'K21' => 'K21', 'K22' => 'K22', 'K23' => 'K23', 'K24' => 'K24', 'K25' => 'K25', 'K26' => 'K26', 'K27' => 'K27', 'K28' => 'K28', 'K29' => 'K29', 'K30' => 'K30', 'K31' => 'K31', 'K32' => 'K32', 'K33' => 'K33',
            'K34' => 'K34', 'K35' => 'K35', 'K36' => 'K36', 'K37' => 'K37', 'K38' => 'K38', 'K39' => 'K39', 'K40' => 'K40', 'K41' => 'K41', 'K42' => 'K42', 'K43' => 'K43', 'K44' => 'K44', 'K45' => 'K45', 'K46' => 'K46', 'K48' => 'K48', 'K49' => 'K49', 'K52' => 'K52', 'K54' => 'K54', 'K55' => 'K55',
            'K56' => 'K56', 'K57' => 'K57', 'K58' => 'K58', 'K59' => 'K59', 'K60' => 'K60', 'K61' => 'K61', 'K62' => 'K62', 'K64' => 'K64', 'K65' => 'K65', 'K66' => 'K66', 'K67' => 'K67', 'K68' => 'K68', 'K69' => 'K69', 'K70' => 'K70', 'K71' => 'K71', 'K72' => 'K72',
            'K73' => 'K73', 'K74' => 'K74', 'K75' => 'K75', 'K76' => 'K76', 'K77' => 'K77', 'K78' => 'K78', 'K79' => 'K79', 'K80' => 'K80', 'K81' => 'K81', 'K82' => 'K82', 'K83' => 'K83', 'K84' => 'K84', 'K85' => 'K85', 'K86' => 'K86', 'K87' => 'K87', 'K88' => 'K88',
            'K89' => 'K89', 'K90' => 'K90', 'K91' => 'K91', 'K92' => 'K92', 'K93' => 'K93', 'K94' => 'K94', 'K95' => 'K95', 'K96' => 'K96', 'K97' => 'K97', 'K98' => 'K98', 'K99' => 'K99', 'K100' => 'K100'
        );
//  "Matching" => array("folder" => "", "loop" => [""]),
        $liningstyledirs = array(
            "Fancy" => array("folder" => "fancy", "loop" => $febricfancy),
            "Contrast Bemberg" => array("folder" => "Bemberg", "loop" => $febricbanbemberg)
        );
        $liningstyle = array("Matching" => [], "Fancy" => [], "Contrast Bemberg" => []);
        foreach ($liningstyledirs as $key => $value) {
            foreach ($value['loop'] as $key1 => $value1) {
                $tempcontain = array(
                    "title" => $value1,
                    "image" => base_url() . "assets/custom_form_view/suit/fabric/" . $value['folder'] . "/" . $value1 . ".jpg",
                    "default" => '',
                    "lable" => $value1,
                    "status" => "1",
                    "parent" => "",
                    "parenttitle" => "",
                    "extra_price" => $value['folder'] == 'fancy' ? '30' : ''
                );
                array_push($liningstyle[$key], $tempcontain);
            }
        }
        $tempcontain = array(
            "title" => "Matching",
            "image" => base_url() . "assets/custom_form_view/suit/fabric/matching.jpg",
            "default" => '1',
            "lable" => "Matching",
            "status" => "1",
            "parent" => "",
            "parenttitle" => "",
        );
        array_push($liningstyle["Matching"], $tempcontain);

        $returnData["liningstyle"] = $liningstyle;

        $singlebreasted = [
            array(
                "title" => "1 Button",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/single_breasted/button1.jpg",
                "default" => "",
                "lable" => "1 Button",
                "parenttitle" => "",
                "status" => "1",
                "parent" => "",
            ),
            array(
                "title" => "2 Buttons",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/single_breasted/button2.jpg",
                "default" => "",
                "lable" => "2 Buttons",
                "parenttitle" => "",
                "status" => "1",
                "parent" => "",
            ),
            array(
                "title" => "3 Button",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/single_breasted/button3.jpg",
                "default" => "",
                "lable" => "3 Button",
                "parenttitle" => "",
                "status" => "1",
                "parent" => "",
            ),
            array(
                "title" => "4 Button",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/single_breasted/button4.jpg",
                "default" => "",
                "lable" => "4 Button",
                "parenttitle" => "",
                "status" => "1",
                "parent" => "",
            ),
        ];
        $doublebreasted = [
            array(
                "title" => "4 Buttons 1 Button Fasten",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/double_breasted/button41.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "4 Buttons 1 Button Fasten",
                "parenttitle" => "",
                "parent" => "",
            ),
            array(
                "title" => "4 Buttons 2 Buttons Fasten",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/double_breasted/button42.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "4 Buttons 2 Buttons Fasten",
                "parenttitle" => "",
                "parent" => "",
            ),
            array(
                "title" => "6 Buttons 1 Button Fasten",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/double_breasted/button61.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "6 Buttons 1 Button Fasten",
                "parenttitle" => "",
                "parent" => "",
            ),
            array(
                "title" => "6 Buttons 2 Buttons Fasten",
                "image" => base_url() . "assets/custom_form_view/suit/front_style/double_breasted/button62.jpg",
                "default" => "",
                "lable" => "6 Buttons 2 Buttons Fasten",
                "parenttitle" => "",
                "parent" => "",
                "status" => "1",
            ),
        ];


        $front_Style = array(
            "Single Breasted" => $singlebreasted,
            "Double Breasted" => $doublebreasted
        );
        $returnData["front_Style"] = $front_Style;


        $pantpleat = array(
            "No Pleat" => $this->Product_model->getChildren(40),
            "1 Pleat" => $this->Product_model->getChildren(41),
            "2 Pleats" => $this->Product_model->getChildren(42),
        );
        $returnData["pantpleat"] = $pantpleat;




        $laplestyle = array(
            "Notch Lapel" => $this->Product_model->getChildren(45),
            "Shawl Lapel" => $this->Product_model->getChildren(46),
            "Peak Lapel" => $this->Product_model->getChildren(47),
        );
        $returnData["laplestyle"] = $laplestyle;

        $sleevebuttons = array(
            "4 Buttons" => $this->Product_model->getChildren(54),
            "3 Buttons" => $this->Product_model->getChildren(55)
        );
        $returnData["sleevebuttons"] = $sleevebuttons;


        $allbutton = array(
            'bll' => 'Black Lipshell', 'bul' => 'Blue Lipshell', 'bwl' => 'Brown Liphell', 'eml' => 'Emerald Liphell',
            'rs' => 'River Shell', 'mp' => 'MOP', 'blcn' => 'Blue Corozo Nut', 'ccn' => 'Cream Corozo Nut',
            'horn' => 'Horn', 'lbh' => 'Light Brown Horn',
        );
        $extra_button = array(
            'Gold' => array('1009-8', '1010-8', '1020-8', '1024-8', '1026-8',),
            'Silver' => array('1106-6', '1113-6', '1116-6', '1118-6', '1207-6', '1211-6', '1213-6', '1222-6', '1224-6',),
            'Brass' => array('1312-6', '1316-6', '1330-6', '1335-6', '1337-6',),
            'Leather' => array('1501-8', '1502-8', '1601-3', '1602-3',),
        );
        $buttonslist = [];
        $tempcontain = array(
            "title" => "Standard",
            "image" => base_url() . "assets/custom_form_view/suit/all-button/b9.jpg",
            "default" => '1',
            "lable" => "Standard",
            "parent" => "",
            "status" => "1",
            "parenttitle" => "",
            "extra_price" => "",
        );
        array_push($buttonslist, $tempcontain);
        foreach ($allbutton as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/suit/suitbutton/$key.jpg",
                "default" => '1',
                "lable" => $value,
                "parent" => "",
                "status" => "1",
                "parenttitle" => "",
                "extra_price" => "30",
            );
            array_push($buttonslist, $tempcontain);
        }
        foreach ($extra_button as $key => $value) {
            $tempcontain = array(
                "title" => $value[0],
                "image" => base_url() . "assets/custom_form_view/suit/suitbuttongsbl/",
                "default" => '1',
                "lable" => $key,
                "status" => "1",
                "parent" => "",
                "parenttitle" => "",
                "child" => $value,
                "extra_price" => "30",
            );
            array_push($buttonslist, $tempcontain);
        }
        $returnData["buttonslist"] = $buttonslist;


        //tuxedo suit
        $tuxedo_jacket_button = array(
            'satin' => 'Satin Covered',
            'grosgrain' => 'Grosgrain Covered',
            'standard' => 'Standard'
        );
        $tuxbuttonslist = [];
        foreach ($tuxedo_jacket_button as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => base_url() . "assets/custom_form_view/tuxedo_jacket/buttons/$key.jpeg",
                "default" => $key == 'satin' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "status" => "1",
                "parenttitle" => "",
                "extra_price" => "",
            );
            array_push($tuxbuttonslist, $tempcontain);
        }
        $returnData["tuxbuttonslist"] = $tuxbuttonslist;


        //tuxedo suit


        $contrastbuttonthread = array(
            "Contrast Button Thread" => [],
            "Contrast Button Hole On Lapel" => [],
            "Contrast First Sleeve Button Hole" => [],
        );
        $contrastthread = array(
            'Select An Option' => "-", 'Matching Base Color for Lining' => "Matching Base Color for Lining",
            'Black' => "Black", 'Navy' => "Navy", 'Charcoal' => "Charcoal", 'Silver' => "Silver", 'Red' => "Red", 'Soft Pink' => "Soft Pink", 'Cream' => "Cream", 'Beige' => "Beige",
            'Grey' => "Grey", 'Brown' => "Brown", 'Purple' => "Purple",
        );
        $contrastarray = array(
            "title" => "-",
            "lable" => "-",
            "child" => $contrastthread,
        );
        $returnData["contrastarray"] = $contrastarray;
        return $returnData;
    }

    function waistCustomElement() {
        $returnData = array();
        $waistcoatlaple = array(
            "No Lapel" => $this->Product_model->getChildren(63),
            "Notch Lapel" => $this->Product_model->getChildren(64),
            "Peak Lapel" => $this->Product_model->getChildren(65),
        );
        $returnData["waistcoatlaple"] = $waistcoatlaple;

        $ws_single_breasted = array(
            'button4' => '4 Button',
            'button5' => '5 Buttons',
            'button6' => '6 Buttons',
        );
        $ws_double_breasted = array(
            'button42' => '4 Buttons  2 Buttons Fasten',
            'button63' => '6 Buttons  3 Buttons Fasten',
        );

        $singlebreasted = [
            array(
                "title" => "4 Button",
                "image" => base_url() . "assets/custom_form_view/waistcoat/front_style/single_breasted/button4.jpg",
                "default" => "",
                "lable" => "4 Button",
                "status" => "1",
                "parenttitle" => "",
                "parent" => "",
            ),
            array(
                "title" => "5 Button",
                "image" => base_url() . "assets/custom_form_view/waistcoat/front_style/single_breasted/button5.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "5 Button",
                "parenttitle" => "",
                "parent" => "",
            ),
            array(
                "title" => "6 Button",
                "image" => base_url() . "assets/custom_form_view/waistcoat/front_style/single_breasted/button6.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "6 Button",
                "parenttitle" => "",
                "parent" => "",
            ),
        ];
        $doublebreasted = [
            array(
                "title" => "4 Buttons 2 Buttons Fasten",
                "image" => base_url() . "assets/custom_form_view/waistcoat/front_style/double_breasted/button42.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "4 Buttons 2 Buttons Fasten",
                "parenttitle" => "",
                "parent" => "",
            ),
            array(
                "title" => "6 Buttons 3 Button Fasten",
                "image" => base_url() . "assets/custom_form_view/waistcoat/front_style/double_breasted/button63.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "6 Buttons 3 Button Fasten",
                "parenttitle" => "",
                "parent" => "",
            ),
        ];


        $front_Style = array(
            "Single Breasted" => $singlebreasted,
            "Double Breasted" => $doublebreasted
        );
        $returnData["front_Style"] = $front_Style;


        $febricbanbemberg = ['3201', '3209', '3219', '3241', '3250', '3259', '3269', '3277', '3287', '3298', '3307', '3317', '3385',
            '3202', '3210', '3221', '3234', '3242', '3251', '3260', '3271', '3279', '3289', '3300', '3308', '3318', '3386',
            '3203', '3211', '3222', '3235', '3244', '3252', '3261', '3272', '3280', '3291', '3302', '3309', '3320', '3388',
            '3204', '3212', '3223', '3236', '3245', '3253', '3264', '3273', '3281', '3294', '3303', '3311', '3380', '3389',
            '3205', '3213', '3224', '3237', '3246', '3254', '3266', '3274', '3282', '3295', '3304', '3313', '3382',
            '3206', '3215', '3226', '3238', '3248', '3256', '3267', '3275', '3284', '3296', '3305', '3314', '3383',
            '3208', '3217', '3229', '3239', '3249', '3257', '3268', '3276', '3286', '3297', '3306', '3316', '3384'];
        sort($febricbanbemberg);
        $febricfancy = array(
            'K1' => 'K1', 'K2' => 'K2', 'K3' => 'K3', 'K4' => 'K4', 'K5' => 'K5', 'K6' => 'K6', 'K7' => 'K7', 'K8' => 'K8', 'K9' => 'K9', 'K10' => 'K10', 'K11' => 'K11', 'K12' => 'K12', 'K13' => 'K13', 'K14' => 'K14', 'K15' => 'K15', 'K16' => 'K16', 'K17' => 'K17',
            'K18' => 'K18', 'K19' => 'K19', 'K20' => 'K20', 'K21' => 'K21', 'K22' => 'K22', 'K23' => 'K23', 'K24' => 'K24', 'K25' => 'K25', 'K26' => 'K26', 'K27' => 'K27', 'K28' => 'K28', 'K29' => 'K29', 'K30' => 'K30', 'K31' => 'K31', 'K32' => 'K32', 'K33' => 'K33',
            'K34' => 'K34', 'K35' => 'K35', 'K36' => 'K36', 'K37' => 'K37', 'K38' => 'K38', 'K39' => 'K39', 'K40' => 'K40', 'K41' => 'K41', 'K42' => 'K42', 'K43' => 'K43', 'K44' => 'K44', 'K45' => 'K45', 'K46' => 'K46', 'K48' => 'K48', 'K49' => 'K49', 'K52' => 'K52', 'K54' => 'K54', 'K55' => 'K55',
            'K56' => 'K56', 'K57' => 'K57', 'K58' => 'K58', 'K59' => 'K59', 'K60' => 'K60', 'K61' => 'K61', 'K62' => 'K62', 'K64' => 'K64', 'K65' => 'K65', 'K66' => 'K66', 'K67' => 'K67', 'K68' => 'K68', 'K69' => 'K69', 'K70' => 'K70', 'K71' => 'K71', 'K72' => 'K72',
            'K73' => 'K73', 'K74' => 'K74', 'K75' => 'K75', 'K76' => 'K76', 'K77' => 'K77', 'K78' => 'K78', 'K79' => 'K79', 'K80' => 'K80', 'K81' => 'K81', 'K82' => 'K82', 'K83' => 'K83', 'K84' => 'K84', 'K85' => 'K85', 'K86' => 'K86', 'K87' => 'K87', 'K88' => 'K88',
            'K89' => 'K89', 'K90' => 'K90', 'K91' => 'K91', 'K92' => 'K92', 'K93' => 'K93', 'K94' => 'K94', 'K95' => 'K95', 'K96' => 'K96', 'K97' => 'K97', 'K98' => 'K98', 'K99' => 'K99', 'K100' => 'K100'
        );
//  "Matching" => array("folder" => "", "loop" => [""]),
        $liningstyledirs = array(
            "Fancy" => array("folder" => "fancy", "loop" => $febricfancy),
            "Contrast Bemberg" => array("folder" => "Bemberg", "loop" => $febricbanbemberg)
        );
        $liningstyle = array("Matching" => [], "Fancy" => [], "Contrast Bemberg" => [], "Same Fabric As Vest Front" => []);
        foreach ($liningstyledirs as $key => $value) {
            foreach ($value['loop'] as $key1 => $value1) {
                $tempcontain = array(
                    "title" => $value1,
                    "image" => base_url() . "assets/custom_form_view/suit/fabric/" . $value['folder'] . "/" . $value1 . ".jpg",
                    "default" => '',
                    "lable" => $value1,
                    "status" => "1",
                    "parent" => "",
                    "parenttitle" => "",
                );
                array_push($liningstyle[$key], $tempcontain);
            }
        }
        $tempcontain = array(
            "title" => "Matching",
            "image" => base_url() . "assets/custom_form_view/suit/fabric/matching.jpg",
            "default" => '1',
            "status" => "1",
            "lable" => "Matching",
            "parent" => "",
            "parenttitle" => "",
        );
        array_push($liningstyle["Matching"], $tempcontain);

        $tempcontain = array(
            "title" => "Same Fabric As Vest Front",
            "image" => base_url() . "assets/custom_form_view/suit/fabric/samefront.jpg",
            "default" => '0',
            "status" => "1",
            "lable" => "Same Fabric As Vest Front",
            "parent" => "",
            "parenttitle" => "",
        );
        array_push($liningstyle["Same Fabric As Vest Front"], $tempcontain);

        $returnData["liningstyle"] = $liningstyle;

        return $returnData;
    }

    function overcoatCustomElement() {
        $returnData = array();
        $overcoatlaple = array(
            "Notch Lapel" => $this->Product_model->getChildren(94),
            "Peak Lapel" => $this->Product_model->getChildren(95),
        );
        $returnData["overcoatlaple"] = $overcoatlaple;

        $single_breasted = array(
            'button2' => '2 Buttons',
            'button3' => '3 Buttons',
            'button4' => '4 Buttons',
        );
        $double_breasted = array(
            'button62' => '6 Buttons  2 Buttons Fasten',
        );

        $singlebreasted = [
            array(
                "title" => "2 Buttons",
                "image" => base_url() . "assets/custom_form_view/overcoat/front_style/single_breasted/button2.jpg",
                "default" => "",
                "lable" => "2 Buttons",
                "parenttitle" => "",
                "status" => "1",
                "parent" => "",
            ),
            array(
                "title" => "3 Buttons",
                "image" => base_url() . "assets/custom_form_view/overcoat/front_style/single_breasted/button3.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "3 Buttons",
                "parenttitle" => "",
                "parent" => "",
            ),
            array(
                "title" => "4 Buttons",
                "image" => base_url() . "assets/custom_form_view/overcoat/front_style/single_breasted/button4.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "4 Buttons",
                "parenttitle" => "",
                "parent" => "",
            ),
        ];
        $doublebreasted = [
            array(
                "title" => "6 Buttons 2 Buttons Fasten",
                "image" => base_url() . "assets/custom_form_view/overcoat/front_style/double_breasted/button62.jpg",
                "default" => "",
                "status" => "1",
                "lable" => "6 Buttons 2 Buttons Fasten",
                "parenttitle" => "",
                "parent" => "",
            ),
        ];


        $front_Style = array(
            "Single Breasted" => $singlebreasted,
            "Double Breasted" => $doublebreasted
        );
        $returnData["front_Style"] = $front_Style;
        return $returnData;
    }

}
