<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->checklogin = $this->session->userdata('logged_in');
        $this->user_id = $this->session->userdata('logged_in')['id'];
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    //function for product list
    function cartOperation_post() {
        $product_id = $this->post('product_id');
        $quantity = $this->post('quantity');
        $item_id = $this->post('custome_id');

        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity, $item_id, $this->user_id);
            $session_cart = $this->Product_model->cartDataCustome($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity, $item_id);
            $session_cart = $this->Product_model->cartDataCustome();
        }

        $this->response($session_cart['products'][$product_id]);
    }

    //multiple customization cart
    function cartOperationMultiple_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartData();
        }

        $tempss = array();
        foreach ($session_cart['products'] as $key => $value) {

            $tempss[$key] = $value;
            print_r($value);
        }
        $session_cart['products'] = $tempss;
        $this->response($session_cart);
    }

    function cartOperationMultiple_post() {
        $product_id = $this->post('product_id');
        $quantity = $this->post('quantity');
        $item_id = $this->post('item_id');
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity, $item_id, $this->user_id);
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity, $item_id);
            $session_cart = $this->Product_model->cartData();
        }
        $this->response($session_cart['products'][$product_id]);
    }

    //end of multiple customization



    function cartOperationNoCustom_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartDataNoCustome($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartDataNoCustome();
        }
        $this->response($session_cart);
    }

    function cartOperationCustom_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartDataCustome($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartDataCustome();
        }
        $this->response($session_cart);
    }

    function cartOperation_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartData();
        }
        $this->response($session_cart);
    }

    function cartOperationDelete_get($product_id) {
        if ($this->checklogin) {
            $cartdata = $this->Product_model->cartData($this->user_id);
            $cid = $cartdata['products'][$product_id]['id'];
            $this->db->where('id', $cid); //set column_name and value in which row need to update
            $this->db->delete('cart'); //
        } else {
            $session_cart = $this->session->userdata('session_cart');
            unset($session_cart['products'][$product_id]);
            $this->session->set_userdata('session_cart', $session_cart);
        }
    }

    function cartOperationPut_get($product_id, $quantity) {
        if ($this->checklogin) {
            $cartdata = $this->Product_model->cartData($this->user_id);
            $total_price = $cartdata['products'][$product_id]['price'] * $quantity;
            $total_quantity = $quantity;
            $cid = $cartdata['products'][$product_id]['id'];
            $this->db->set('quantity', $total_quantity);
            $this->db->set('total_price', $total_price);
            $this->db->where('id', $cid); //set column_name and value in which row need to update
            $this->db->update('cart'); //
        } else {
            $session_cart = $this->session->userdata('session_cart');
            $session_cart['products'][$product_id]['quantity'] = $quantity;
            $price = $session_cart['products'][$product_id]['price'];
            $session_cart['products'][$product_id]['total_price'] = $quantity * $price;
            $this->session->set_userdata('session_cart', $session_cart);
        }
    }

    //Product 
    public function SearchSuggestApi_get($keyword) {
        $query = $this->db->select('title, id, file_name')->from('products')->where("keywords LIKE '%$keyword%' or title LIKE '%$keyword%' ")->get();
        $searchobj = $query->result_array();

        $pquery = "select title, file_name, id from (
                    (SELECT title, file_name, id from products where keywords like '%$keyword%' )
                   union 
                   (SELECT title, file_name, id from products where title like '%$keyword%')
                    ) as search group by id   
                  ";
        $attr_products = $this->Product_model->query_exe($pquery);


        $this->response($searchobj);
    }

    public function SearchSuggestApiJUI_get() {
        $getdata = $this->get();
        $keyword = $getdata['term'];
        $query = $this->db->select('title, id')->from('products')->where("keywords LIKE '%$keyword%'")->get();
        $searchobj = $query->result_array();
        $this->response($searchobj);
    }

    //ProductList APi
    public function productListApi_get($category_id, $custom_id) {
        $attrdatak = $this->get();
        $products = [];
        $countpr = 0;
        $pricequery = "";
        $psearch = "";
        if (($attrdatak["search"])) {
            $searchdata = $attrdatak["search"];
            unset($attrdatak["search"]);
            if ($searchdata) {
                $psearch = " and title like '%$searchdata%' ";
            }
        }

        if (($attrdatak["minprice"])) {
            $mnpricr = $attrdatak["minprice"] - 1;
            $mxpricr = $attrdatak["maxprice"] + 1;
            unset($attrdatak["minprice"]);
            unset($attrdatak["maxprice"]);
            $pricequery = " and (price between '$mnpricr' and '$mxpricr') ";
        }

        foreach ($attrdatak as $key => $atv) {
            if ($atv) {
                $countpr += 1;
                $key = str_replace("a47", "", $key);
                $val = str_replace("-", ", ", $atv);
                $query_attr = "SELECT product_id FROM product_attribute
                           where  attribute_id in (47) and attribute_value_id in ($val)
                           group by product_id";
                $queryat = $this->db->query($query_attr);
                $productslist = $queryat->result();
                foreach ($productslist as $key => $value) {
                    array_push($products, $value->product_id);
                }
            }
        }
        //print_r($products);

        $productdict = [];

        $productcheck = array_count_values($products);


        //print_r($productcheck);

        foreach ($productcheck as $key => $value) {
            if ($value == 1) {
                array_push($productdict, $key);
            }
        }

        $proquery = "";
        if (count($productdict)) {
            $proquerylist = implode(",", $productdict);
            $proquery = " and pt.id in ($proquerylist) ";
        }

        $categoriesString = $this->Product_model->stringCategories($category_id) . ", " . $category_id;
        $categoriesString = ltrim($categoriesString, ", ");

        $product_query = "select pt.id as product_id, pt.*
            from products as pt where pt.category_id in ($categoriesString) $psearch $pricequery $proquery order by display_index desc";
        $product_result = $this->Product_model->query_exe($product_query);

        $productListSt = [];

        $productListFinal = [];

        $pricecount = [];

        foreach ($product_result as $key => $value) {
            $value['attr'] = $this->Product_model->singleProductAttrs($value['product_id']);
            $item_price = $this->Product_model->category_items_prices_id($value['category_items_id'], $custom_id);

            $value['price'] = $item_price ? $item_price->price : 0;
            array_push($productListSt, $value['product_id']);
            array_push($pricecount, $value['price']);
            array_push($productListFinal, $value);
        }

        $attr_filter = array();
        $pricelist = array();
        if (count($productListSt)) {
            $pricelist = array('maxprice' => max($pricecount), 'minprice' => min($pricecount));


            $productString = implode(",", $productListSt);


            $attr_query = "select count(cav.id) product_count, '' as checked, cvv.widget, cav.attribute_value, cav.additional_value, cav.id, pa.attribute, pa.attribute_id from product_attribute as pa
        join category_attribute_value as cav on cav.id = pa.attribute_value_id
        join category_attribute as cvv on cvv.id = cav.attribute_id
        where pa.product_id in ($productString)
        group by cav.id";
            $attr_result = $this->Product_model->query_exe($attr_query);


            foreach ($attr_result as $key => $value) {
                $filter = $value['attribute_id'];
                $attitle = $value['attribute'];
                $widget = $value['widget'];
                if (isset($attr_filter[$filter])) {
                    array_push($attr_filter[$filter], $value);
                } else {
                    $attr_filter[$filter] = array("title" => $attitle, "attrs" => [], "widget" => $widget);
                    array_push($attr_filter[$filter], $value);
                }
            }
        }

        $this->output->set_header('Content-type: application/json');
        $productArray = array('attributes' => $attr_filter,
            'products' => $productListFinal,
            'product_count' => count($product_result),
            'price' => $pricelist);
        $this->response($productArray);
    }

    //ProductList APi
    public function productListSearchApi_get($searchkey) {
        $attrdatak = $this->get();
        $products = [];
        $countpr = 0;
        $searchtext = $searchkey;

        if (isset($attrdatak["minprice"])) {
            $mnpricr = $attrdatak["minprice"] - 1;
            $mxpricr = $attrdatak["maxprice"] + 1;
            unset($attrdatak["minprice"]);
            unset($attrdatak["maxprice"]);
            $pricequery = " and (price between '$mnpricr' and '$mxpricr') ";
        }

        foreach ($attrdatak as $key => $atv) {
            if ($atv) {
                $countpr += 1;
                $key = str_replace("a", "", $key);
                $val = str_replace("-", ", ", $atv);
                $query_attr = "SELECT product_id FROM product_attribute
                           where  attribute_id in ($key) and attribute_value_id in ($val)
                           group by product_id";
                $queryat = $this->db->query($query_attr);
                $productslist = $queryat->result();
                foreach ($productslist as $key => $value) {
                    array_push($products, $value->product_id);
                }
            }
        }
        //print_r($products);

        $productdict = [];

        $productcheck = array_count_values($products);


        //print_r($productcheck);

        foreach ($productcheck as $key => $value) {
            if ($value == $countpr) {
                array_push($productdict, $key);
            }
        }

        $proquery = "";
        if (count($productdict)) {
            $proquerylist = implode(",", $productdict);
            $proquery = " and pt.id in ($proquerylist) ";
        }

        $categoriesString = $this->Product_model->stringCategories($category_id) . ", " . $category_id;
        $categoriesString = ltrim($categoriesString, ", ");

        $product_query = "
                       
    select * from(
    (select pt.id as product_id, pt.* from products as pt where keywords like '%$searchtext%') 
    union
    (select pt.id as product_id, pt.* from products as pt where title like '%$searchtext%' )
        ) as pt where pt.id > 0 

                "
                . " $pricequery $proquery";
        $product_result = $this->Product_model->query_exe($product_query);

        $productListSt = [];

        $productListFinal = [];

        $pricecount = [];

        foreach ($product_result as $key => $value) {
            $value['attr'] = $this->Product_model->singleProductAttrs($value['product_id']);
            array_push($productListSt, $value['product_id']);
            array_push($pricecount, $value['price']);
            array_push($productListFinal, $value);
        }

        $attr_filter = array();
        $pricelist = array();
        if (count($productListSt)) {
            $pricelist = array('maxprice' => max($pricecount), 'minprice' => min($pricecount));


            $productString = implode(",", $productListSt);


            $attr_query = "select count(cav.id) product_count, '' as checked, cav.attribute_value, cav.id, pa.attribute, pa.attribute_id from product_attribute as pa
        join category_attribute_value as cav on cav.id = pa.attribute_value_id
        where pa.product_id in ($productString)
        group by cav.id";
            $attr_result = $this->Product_model->query_exe($attr_query);


            foreach ($attr_result as $key => $value) {
                $filter = $value['attribute'];
                if (isset($attr_filter[$filter])) {
                    array_push($attr_filter[$filter], $value);
                } else {
                    $attr_filter[$filter] = [];
                    array_push($attr_filter[$filter], $value);
                }
            }
        }
        ob_clean();
        $this->output->set_header('Content-type: application/json');
        $productArray = array('attributes' => $attr_filter,
            'products' => $productListFinal,
            'product_count' => count($product_result),
            'price' => $pricelist);
        $this->response($productArray);
    }

    //category list api
    function categoryMenu_get() {
        $categories = $this->Product_model->productListCategories(0);
        $this->response($categories);
    }

    //order detail get
    function orderDetails_get($order_id) {
        $order_details = $this->Product_model->getOrderDetails($order_id);
        $this->response($order_details);
    }

    function order_mail_get($order_id, $order_no) {
        $subject = "Order Confirmation - Your Order with www.bespoketailorshk.com [$order_no] has been successfully placed!";
        $this->Product_model->order_mail($order_id, $subject);
    }

    function order_mailcheck_get($order_id, $order_no) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get('user_order_log');
        $orderlog = $query->result_array();
        if (count($orderlog)) {
            $this->response(array('checkpre' => '1'));
        } else {
            $this->response(array('checkpre' => '0'));
        }
    }

    function order_mailchecksend_get($order_id, $order_no) {
        $subject = "Order Confirmation - Your Order with www.royaltailor.hk [$order_no] has been successfully placed!";
        $this->Product_model->order_mail($order_id, $subject);
    }

    function orderMailVender_get($order_id) {
        $this->Product_model->order_mail_to_vendor($order_id);
        $this->response("hell");
    }

    function cartOperationShirt_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartData();
        }

        $tempss = array();
        foreach ($session_cart['products'] as $key => $value) {

            $tempss[$key] = $value;
            $tempss[$key]['folder'] = $value['folder'];


            $prodct_details = $this->Product_model->productDetails($value['product_id']);
            $tempss[$key]['file_name2'] = $prodct_details['file_name2'];
        }
        $session_cart['products'] = $tempss;
        $this->response($session_cart);
    }

    function cartOperationShirtSingle_get($product_id) {
        $prodct_details = $this->Product_model->productDetails($product_id);
//        $prodct_details['folder'] = $prodct_details['title'];
        $this->response($prodct_details);
    }

    //function for product list
    function cartOperationCustom_post() {
        $product_id = $this->post('product_id');
        $quantity = $this->post('quantity');
        $custome_id = $this->post('custome_id');
        $customekey = $this->post('customekey');
        $customevalue = $this->post('customevalue');
        $extra_cost = $this->post('extra_price');

        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartOperationCustom($product_id, $quantity, $custome_id, $customekey, $customevalue, $extra_cost, $this->user_id);
            $session_cart = $this->Product_model->cartDataCustome($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartOperationCustom($product_id, $quantity, $custome_id, $customekey, $customevalue, $extra_cost);
            $session_cart = $this->Product_model->cartDataCustome();
        }

        $this->response($session_cart['products'][$product_id]);
    }

    //cartOperationCustomMulti
    function cartOperationCustomMulti_post() {
        $product_id = $this->post('product_id');
        $quantity = $this->post('quantity');
        $custome_id = $this->post('custome_id');
        $customekey = $this->post('customekey');
        $customevalue = $this->post('customevalue');
        $extra_cost = $this->post('extra_price');

        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartOperationCustomMulti($product_id, $quantity, $custome_id, $customekey, $customevalue, $extra_cost, $this->user_id);
            $session_cart = $this->Product_model->cartDataCustome($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartOperationCustomMulti($product_id, $quantity, $custome_id, $customekey, $customevalue, $extra_cost);
            $session_cart = $this->Product_model->cartDataCustome();
        }

        $this->response($session_cart['products'][$product_id]);
    }

    function removeCart_post() {
        $product_id = $this->post('cart_id');
        $query = "delete from nfw_product_cart where id = '$product_id' and user_id = '$this->user_id' and order_id='0';";
        $query = $this->db->query($query);
    }

    function changesCart_post() {
        $product_id = $this->post('cart_id');
        $operation = $this->post('oparation');

        $this->db->where('id', $product_id);
        $query = $this->db->get('nfw_product_cart');
        $itemdata = $query->row();

        $quantity = $itemdata->quantity;
        $price = $itemdata->price;
        if ($operation == 'add') {
            $quantity += 1;
        }

        if ($operation == 'sub') {
            if ($quantity > 1) {
                $quantity -= 1;
            }
        }


        $totalprice = $price * $quantity;

        $this->db->set('quantity', $quantity);
        $this->db->set('total_price', $totalprice);
        $this->db->where('id', $product_id); //set column_name and value in which row need to update
        $this->db->update('nfw_product_cart');
    }

    function addToCart_post() {
        $cartdataobj = $this->Product_model->getCartData();
        $cartdata = $cartdataobj['cartdata'];
        $product_id = $this->post('product_id');
        $item_id = $this->post('item_id');
        $productinfo = $this->Product_model->productItemInformation($product_id, $item_id);
        $cartids = $product_id . '_' . $item_id;
        $productadd = array(
            "product_id" => $product_id,
            "op_date" => date('Y-m-d'),
            "op_time" => date('H:i:s'),
            "user_id" => "",
            "quantity" => 1,
            "extra_price" => '0',
            "total_price" => $productinfo['price'],
            "product_speciality" => $productinfo['product_speciality'],
            "title" => $productinfo['title'],
            "sku" => $productinfo['title'],
            "item_code" => $productinfo['title'],
            "item_image" => $productinfo['images'][0]['image'],
            "price" => $productinfo['price'],
            "tag_title" => $productinfo['item_name'],
            "customization_id" => '0',
            "customization_data" => '',
            "customization_data_price" => '',
            "customize_table" => 'No',
            "measurement_id" => '',
            "measurement_data" => '',
            "posture_data" => '',
            "user_images" => '',
            "order_id" => '0',
            "tag_id" => $item_id
        );
        if ($this->checklogin) {
            $productadd["user_id"] = $this->user_id;
            if (isset($cartdata[$cartids])) {
                $message = array("status" => 2, "msg" => "Already In Cart", "type" => "warning", "product" => $productadd);
            } else {
                $message = array("status" => 2, "msg" => "Added To Cart", "type" => "success", "product" => $productadd);
                $this->db->insert('nfw_product_cart', $productadd);
            }
        } else {
            $session_cart = $this->session->userdata('session_cart');
            if (isset($session_cart['products'])) {
                array_push($session_cart['products'], $productadd);
            } else {
                $session_cart = array('products' => araay());
                array_push($session_cart['products'], $productadd);
                $message = array("status" => 2, "msg" => "Added To Cart", "type" => "success", "product" => $productadd);
            }

            $this->session->set_userdata('session_cart', $session_cart);
        }
        $this->response($message);
    }

    function getCartData_get() {
        $cartdata = $this->Product_model->getCartData();
        $cartdatacustom = $this->Product_model->getCartDataCustom();
        $cartdataall = array("products" => [], "total_quantity" => 0, "total_price" => 0);
        $carttemplist = [];
        $carttemparray = array();
        $carttitleids = $cartdata['cartitemids'];
        foreach ($cartdata['cartdata'] as $key => $value) {
            $cartdataall['total_quantity'] += $value['quantity'];
            $cartdataall['total_price'] += $value['total_price'];
            array_push($cartdataall['products'], $value);
        }
        $this->response(array(
            "cartdata" => $cartdataall,
            "cartcustom" => $carttitleids,
        ));
    }

    function getCustomCartData_get() {
        $query = "  SELECT * FROM `nfw_product_cart` where user_id='$this->user_id' and order_id='0' and customization_data !='' and measurement_data !='';";
        $query = $this->db->query($query);
        $cartdata = $query->result_array();
        $cartdataall = array("products" => [], "total_quantity" => 0, "total_price" => 0);
        foreach ($cartdata as $key => $value) {
            $cartdataall['total_quantity'] += $value['quantity'];
            $cartdataall['total_price'] += $value['total_price'];
            $custom_id = $value['customization_id'];
            $customdata = $this->Product_model->getCustomizationDataById($custom_id);
            $value['style'] = $customdata;
            array_push($cartdataall['products'], $value);
        }
        $cartdataall['shipping_price'] = 30;
        if ($cartdataall['total_price'] > 250) {
            $cartdataall['shipping_price'] = 0;
        }

        $cartdataall['grand_total'] = $cartdataall['total_price'] + $cartdataall['shipping_price'];


        $this->response(array(
            "cartdata" => $cartdataall,
        ));
    }

    function get_permutations($inputcolor, $count1) {

        function string_getpermutations($prefix, $characters, &$permutations) {
            if (count($characters) == 1) {


                $permutations[] = $prefix . ',' . array_pop($characters);
            } else {
                for ($i = 0; $i < count($characters); $i++) {
                    $tmp = $characters;
                    unset($tmp[$i]);
                    string_getpermutations($prefix . "," . $characters[$i], array_values($tmp), $permutations);
                }
            }
        }

        $characters = array();
        for ($i = 0; $i < count($inputcolor); $i++)
            $characters[] = $inputcolor[$i];
        $permutations = array();

        string_getpermutations("", $characters, $permutations);

        $temp = array();
        foreach ($permutations as $key => $value) {

            array_push($temp, substr($value, 1));
        }

        $temp1 = array_unique($temp);
        $queryarray = [];

        for ($i = $count1; $i > 1; $i--) {

            foreach ($temp1 as $key => $value) {
                $acval = explode(',', $value);
                $acval = implode(",", array_slice($acval, 0, $i));
                array_push($queryarray, $acval);
            }
        }
        $queryarray = array_merge($queryarray, $inputcolor);
        $colorpermutations = "'" . implode("','", $queryarray) . "'";
        return $colorpermutations;
    }

    function parents($parentId, $arrayChild) {
        $query = "select id from nfw_category where parent = $parentId";
        $res = $this->Product_model->resultAssociate($query);
        for ($i = 0; $i < count($res); $i++) {
            $id = $res[$i]['id'];

            array_push($arrayChild, $id);
            $this->parents($res[$i]['id'], $arrayChild);
        }
        return $arrayChild;
    }

    function productList_get() {
        $category = "";
        $category_id = $this->get('category');
        if (($this->get('category')) && $this->get('category') != 0) {

            $dataId = $this->parents($category_id, array());
            $dataId[] = $category_id;
            $query_data = array();
            $categoryString = implode(',', $dataId);
            $category = " and np.product_category in (" . $categoryString . ") ";
        }

        $item_type = $this->get('item_type');

        $colorlistf = $this->get('colors');
        $color_id = [];
        $colorlist = [];
        if ($colorlistf) {
            $color_id = implode(",", $colorlistf);
            $colorlist = explode(",", $color_id);
        }
        $colorcount = count($colorlistf);
        $colorjoin = "";

        $colorquerycc = "";
        $orderquerycolor = "";

        $selectedColors = array();

        $colorquery = implode(",", $colorlist);


        if ($colorcount > 0) {
            $orderquerycolor = " , FIELD(nc.id, $colorquery )";
            $colorquerycc = " and nc.id in ($colorquery)";
            $selectcolorquery = "select * from nfw_color where id in ($colorquery)";
            $selectedColors = $this->Product_model->resultAssociate($selectcolorquery);
        }
        $fromprice = $this->get('from_price');

        $toprice = $this->get('to_price');



        if (isset($fromprice)) {
            $price = "and if(ntc.sale_price, ntc.sale_price, ntc.price) between '" . $fromprice . "' and '" . $toprice . "'";
        } else {
            $price = '';
        }

        $fabtype = "";
        $color = "";
        $prequery = "";
        $pricesort = " sort_type desc";
        $preselectq = "";
        $sorting = $this->get('sorting');
        $sortquery = "'' as sort_type";
        $sortt = "";

        //        profession sorting
        if (($this->get('profession_check'))) {
            $sorting = str_replace("Fabric 4 ", "", $sorting);
            $profq = $this->Product_model->resultAssociate("select id from nfw_profession where title = '$sorting'");
            if (count($profq)) {
                $sorting = "Profession";
                $profession_id = $profq[0]['id'];
            }
        };
//        end of profession sorting


        if (isset($sorting)) {

            switch ($sorting) {
                case 'Price-Desc':
                    $sort = " order by ntc.price desc";
                    $pricesort = " price_r desc";
                    $sortquery = " '' as sort_type ";
                    break;

                case 'Price-Asc':
                    $sort = " order by ntc.price asc";
                    $pricesort = " price_r asc";
                    $sortquery = "'' as sort_type ";
                    break;

                case 'Most Popular':
                    $sortt = " and np.id in (SELECT product_id FROM `nfw_most_populat_product`)   ";
                    $sortquery = " 'MP' as sort_type  ";
                    break;

                case 'On Sale':
                    $sortt = " and np.id in (SELECT product_id FROM `nfw_on_sale`) and np.publishing = 1  ";
                    $sortquery = "'Sale' as sort_type";
                    break;

                case 'Profession':
                    $sortt = " and np.id in (SELECT nfw_product_id FROM nfw_product_profession where nfw_profession_id = '$profession_id') and np.publishing = 1  ";
                    $sortquery = "'Profession' as sort_type";
                    break;

                case 'New Arrival':
                    $sortt = " and np.id in (SELECT product_id FROM `nfw_new_arrival`) and np.publishing = 1  ";
                    $sortquery = "'New' as sort_type ";
                    break;

                case 'Sale/Most Popular':

                    $sortt = " and np.id in (SELECT npps.product_id FROM nfw_most_populat_product as npps
                                    join nfw_on_sale as nss on nss.product_id = npps.product_id)     ";

                    $sortquery = "'MP_SALE' as sort_type";
                    break;

                case 'Offers':

                    $sortt = " and np.id in (SELECT npps.product_id FROM nfw_offer_product as npps
                                    join nfw_on_sale as nss on nss.product_id = npps.product_id)     ";

                    $sortquery = "'Sale' as sort_type";
                    break;

                default:
                    $prequery = $preselectq . ", '' as sort_type FROM  nfw_product as np $colorjoin  $category $price $color $fabtype";
                    $sort = '';
            }
        } else {
            $sort = '';
            $prequery = $preselectq . ", '' as sort_type FROM  nfw_product as np $colorjoin  $category $price $color $fabtype";
        }





        $query = "SELECT 
                   np.id as id,
                   nc.id  as colorid,
                   np.product_category as category_id,
                   np.title as title,
                   np.product_speciality as product_speciality,
                   publishing, 
            
                  ntc.price as price, ntc.sale_price, if(ntc.sale_price, ntc.sale_price, ntc.price) as price_r, 
                   nfimg.image as image, 
                   $sortquery
                   FROM nfw_product as np 
                   left join nfw_product_images as nfimg on nfimg.nfw_product_id = np.id 
                   join nfw_product_tag_connection as ntc on ntc.product_id = np.id 
                   join nfw_product_color as npc on np.id =  npc.nfw_product_id
                   

                   

                    join nfw_color as nc on npc.nfw_color_id = nc.id
                    where ntc.tag_id = $item_type and publishing = 1 $sortt $colorquerycc $category $price group by np.id order by np.id $orderquerycolor ";





        $result = $this->Product_model->resultAssociate($query);



        $pricelist = [];
        for ($i = 0; $i < count($result); $i++) {
            array_push($pricelist, $result[$i]['price_r']);
        }

        $pricelist = array_unique($pricelist);
        sort($pricelist);
        $productIDS = [];
        $productidstr = implode(",", $productIDS);
        $color_list4 = implode(",", $productIDS);
        $wherequery = "";
        if ($productidstr) {
            $wherequery = "where npc.nfw_product_id in ($productidstr)";
        }
        if (1) {
            $query = "
                                        SELECT nc.id,nc.color_code, nc.title FROM nfw_color as nc
                                          join nfw_product_color as npc on npc.nfw_color_id = nc.id
                                          $wherequery
                                         group by nc.id order by nc.display_index asc
                                            ";
            //  echo $query;
            $colorArray = $this->Product_model->resultAssociate($query);
        } else {
            $colorArray = array();
        }


        $finalResult = array();
        $count = count($result);

        if (count($result)) {

            $fresult = [];
            $fresultindex = [];

            $productliststr = array();
            foreach ($result as $ry => $rv) {
                $productliststr[$rv['id']] = $rv;
            }
            $productkey = array_keys($productliststr);
            $productquery = implode(",", $productkey);

//echo "----------";

            function intersectdata($dataarray) {
                $temp = [];
                $count = count($dataarray);
                for ($i = 0; $i < ($count - 1); $i++) {
                    print_r($dataarray[$i]);
                    print_r($dataarray[$i + 1]);
                    $temp2 = array_intersect($dataarray[$i], $dataarray[$i + 1]);

                    array_push($temp, $temp2);
                }
                return $temp;
            }

            $checkcolorsort = "";
            if (count($colorlist)) {
                $checkcolorsort = ", color ";
            }
            $colorproductmainlist = [];





            if ($colorcount > 0) {
                if ($colorcount > 0) {

                    $temp41a = array();
                    $colortemparray = array_values($colorlist);
                    $colorsorting = $this->get_permutations($colortemparray, $colorcount);

                    $queryc1a = "(select nfw_product_id, colorbunch from(
SELECT nfw_product_id, nfw_color_id, 
(select group_concat(nc.nfw_color_id ) colorbrc from nfw_product_color as nc where nc.nfw_product_id = npc.nfw_product_id group by npc.nfw_product_id ) as colorbunch
 FROM nfw_product_color as npc 
where nfw_color_id in ($colorquery) and nfw_product_id in  (" . $productquery . ") 
group by nfw_product_id
) as a
where colorbunch in ($colorsorting) 
order by FIELD(colorbunch, $colorsorting) )";

                    $temps1 = [];
                    $clllist = $this->Product_model->resultAssociate($queryc1a);

                    foreach ($clllist as $key11 => $value11) {
                        array_push($temps1, $value11['nfw_product_id']);
                    }
                    $temp41a = array_merge($temps1, $temp41a);

                    $temp41a = ($temp41a);
                    $temp41 = $temp41a;
                } else {
                    $queryc1 = "SELECT (select title from nfw_product where id = nfw_product_id) as title, nfw_product_id, nfw_color_id, (select group_concat(nfw_color_id) from nfw_product_color  as nc where nc.nfw_product_id = npc.nfw_product_id group by npc.nfw_product_id) as colorbunch FROM nfw_product_color as npc where nfw_product_id in  (" . $productquery . ") 
    group by nfw_product_id 
    having  nfw_color_id in (" . $colorquery . ") 
order by count(nfw_color_id) asc, colorbunch";

                    $colorproductmainlist1 = $this->Product_model->resultAssociate($queryc1);
                    $temp41 = [];
                    foreach ($colorproductmainlist1 as $key11 => $value11) {
                        array_push($temp41, $value11['nfw_product_id']);
                    }
                }

                $temp6 = array_values(array());
                $temp7 = array_unique(array_merge($temp41, $productkey));
                $resultf = [];
                foreach ($temp7 as $key1 => $value1) {
                    foreach ($result as $key2 => $value2) {
                        if ($value2['id'] == $value1) {
// echo $value2['id'], '-';
                            if ($value1 != '') {
                                $resultf[$key1] = $value2;
                            }
                        }
                    }
                }
            } else {
                $resultf = $result;
            }
            if (($this->get('paginate'))) {
                $pg = $this->get('paginate');
                $pg1 = $pg[0] - 1;
                $pg2 = $this->get('perpage');

                $finalResult = array_slice($resultf, $pg1, $pg2);
            } else {
                $finalResult = $resultf;
            }
        } else {

            $finalResult = array_slice($result, 0, 16);
        }


//        $pg = $this->get('paginate');
//                $pg1 = $pg[0] - 1;
//                $pg2 = $this->get('perpage');
//                $finalResult =  array_slice($result, $pg1, $pg2);
        $productlists = array();
        foreach ($finalResult as $key => $value) {
            $productid = $value['id'];
            $tempquery = "   SELECT group_concat(snc.id, snc.color_code) as color FROM nfw_color as snc  
         left join nfw_product_color as snpc on snpc.nfw_color_id = snc.id
         where snpc.nfw_product_id = $productid order by snc.id asc";
            $resulttempuery = $this->Product_model->resultAssociate($tempquery);
            $value['color'] = $colorsbunch = end($resulttempuery)['color'];

//            print_r($value);
            array_push($productlists, $value);
        }
        $selectedColors = array_reverse($selectedColors);
        $this->response(array('count' => $count, 'productdata' => $productlists, 'colors' => $colorArray, 'selected_colors' => $selectedColors, 'pricelist' => $pricelist));
    }

    function shirtCustomization_get() {

        $watchoption_style = array(
            'nowatch' => 'No',
            'leftwatch' => 'Right Wrist',
            'rightwatch' => 'Left Wrist'
        );

        $watchoption_container = array();
        foreach ($watchoption_style as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => "./custom_form_view/shirt/watch/" . $key . ".jpg",
                "default" => $value == 'No' ? '1' : '',
                "lable" => $value,
                "parent" => "Long Sleeve",
                "parenttitle" => "Sleeve Style",
            );
            array_push($watchoption_container, $tempcontain);
        }

        $cuff_style = array(
            '1' => 'Single Cuff Rounded',
            '2' => 'Single Cuff Squared',
            '3' => 'Single Cuff Cutaway',
            '4' => 'French Cuff  Rounded',
            '5' => 'French Cuff Squared',
            '6' => 'French Cuff Cutaway',
            '7' => 'Convertible  Cuff Rounded',
            '8' => 'Convertible Cuff Square',
            '9' => 'Convertible Cuff Cutaway',
            '10' => '2 Buttons Rounded',
            '11' => '2 Buttons Squared',
            '12' => '2 Buttons Cutaway',
            '13' => 'Milanese Cuff',
        );

        $cuff_style_container = array();
        foreach ($cuff_style as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => "./custom_form_view/shirt/cuff_shirt/" . $key . ".jpg",
                "default" => $value == 'Single Cuff Rounded' ? '1' : '',
                "lable" => $value,
                "parent" => "Long Sleeve",
                "parenttitle" => "Sleeve Style",
                "child" => array("Wrist Watch" => "No")
            );
            array_push($cuff_style_container, $tempcontain);
        }

        $shortsleevestyle = [
            array(
                "title" => "Short Sleeve Without Cuff",
                "image" => "./custom_form_view/shirt/cuff_shirt/withoutcuff_sort.jpg",
                "default" => "1",
                "lable" => "Short Sleeve Without Cuff",
                "parenttitle" => "Sleeve Style",
                "parent" => "Short Sleeve",
            ),
            array(
                "title" => "Short Sleeve With Cuff",
                "image" => "./custom_form_view/shirt/cuff_shirt/withcuff_sort.jpg",
                "default" => "",
                "lable" => "Short Sleeve With Cuff",
                "parenttitle" => "Sleeve Style",
                "parent" => "Short Sleeve",
            ),
        ];
        foreach ($shortsleevestyle as $key => $value) {
            array_push($cuff_style_container, $value);
        }




        $sleevestyle = [
            array(
                "title" => "Long Sleeve",
                "image" => "https://nitafashions.com/nfw/small/custom_57657134840.jpeg",
                "default" => "1",
                "lable" => "Long Sleeve",
                "parent" => "",
                "child" => "Cuff Style",
                "child" => array("Cuff Style" => "Single Cuff Rounded", "Wrist Watch" => "No")
            ),
            array(
                "title" => "Short Sleeve",
                "image" => "./custom_form_view/shirt/cuff_shirt/withoutcuff_sort.jpg",
                "default" => "",
                "lable" => "Short Sleeve",
                "parent" => "",
                "child" => array("Cuff Style" => "Short Sleeve Without Cuff", "Wrist Watch" => "No")
            ),
        ];



        $printed = array(
            '1.jpg' => 'P 44 ',
            '2.jpg' => 'P 45 ',
            '3.jpg' => 'P 49 ',
            '4.jpg' => 'P 50 ',
            '5.jpg' => 'P 51 ',
            '6.jpg' => 'P 58 ',
            '7.jpg' => 'P 61 ',
            '8.jpg' => 'P 63 ',
            '9.jpg' => 'P 65 ',
            '19.jpg' => 'P 67 ',
            '20.jpg' => 'P 78 ',
            '21.jpg' => 'P 96 ',
            '22.jpg' => 'P 98 ',
            '23.jpg' => 'P 99 ',
            '24.jpg' => 'P 100 ',
            '25.jpg' => 'P 102 ',
            '26.jpg' => 'P 104 ',
            '27.jpg' => 'P 105 ',
            '28.jpg' => 'P 106 ',
            '29.jpg' => 'P 107 ',
            '30.jpg' => 'P 109 ',
            '31.jpg' => 'P 110 ',
            '32.jpg' => 'P 112 ',
            '33.jpg' => 'P 113 ',
            '34.jpg' => 'P 115 ',
            '35.jpg' => 'P 135 ',
            '10.jpg' => 'P 126 ',
            '11.jpg' => 'P 127 ',
            '12.jpg' => 'P 128 ',
            '13.jpg' => 'P 129 ',
            '14.jpg' => 'P 130 ',
            '15.jpg' => 'P 131 ',
            '16.jpg' => 'P 144 ',
            '17.jpg' => 'P 145 ',
            '18.jpg' => 'P 148 ',
        );
        $solid = array(
            '8.jpg' => 'B 153 ',
            '9.jpg' => 'B 155 ',
            '10.jpg' => 'B 159 ',
            '11.jpg' => 'B 162 ',
            '12.jpg' => 'B 165 ',
            '13.jpg' => 'B 166 ',
            '14.jpg' => 'B 167 ',
            '15.jpg' => 'B 171 ',
            '16.jpg' => 'B 174 ',
            '17.jpg' => 'B 176 ',
            '18.jpg' => 'B 177 ',
            '1.jpg' => 'D 692 ',
            '2.jpg' => 'D 694 ',
            '3.jpg' => 'D 698 ',
            '4.jpg' => 'D 700 ',
            '5.jpg' => 'D 701 ',
            '6.jpg' => 'D 703 ',
            '7.jpg' => 'D 704 ',
        );



        $ccinsert = array("Printed" => [], "Solid" => []);
        foreach ($solid as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => "./custom_form_view/shirt/fabric/solid_collar/" . $key,
                "default" => $value == 'No' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "parenttitle" => "",
            );
            array_push($ccinsert['Solid'], $tempcontain);
        }

        foreach ($printed as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => "./custom_form_view/shirt/fabric/printed_collar/" . $key,
                "default" => $value == 'No' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "parenttitle" => "",
            );
            array_push($ccinsert['Printed'], $tempcontain);
        }



        $buttonarray = array(
            'standard' => 'Standard',
            'matching' => 'Matching',
            '1' => 'Thick Mop',
            '2' => 'Thin Mop',
            '3' => 'Black Lipshell'
        );
        $buttoncontainer = [];
        foreach ($buttonarray as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => "./custom_form_view/shirt/button_shirt/" . $key . ".png",
                "default" => $value == 'No' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "parenttitle" => "",
            );
            array_push($buttoncontainer, $tempcontain);
        }

        $monogram = array(
            '1' => '1',
            '3' => '3',
            '8' => '8',
            '10' => '10',
            '13' => '13',
            '14' => '14',
            '15' => '15',
            '16' => '16',
            '17' => '17',
            '18' => '18',
            '19' => '19',
            '20' => '20',
            '21' => '21',
            '22' => '22',
            '23' => '23',
            '24' => '24',
            '27' => '27',
            '28' => '28',
            '30' => '30',
            '31' => '31',
            '34' => '34',
            '36' => '36'
        );


        $monogramontainer = [];
        foreach ($monogram as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => "./custom_form_view/shirt/monogram_shirt/" . $key . ".jpg",
                "default" => $value == '1' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "parenttitle" => "",
            );
            array_push($monogramontainer, $tempcontain);
        }

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
                "image" => "./custom_form_view/shirt/monogram_placement/" . $key . ".jpg",
                "default" => $value == 'No Monogram' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "parenttitle" => "",
            );
            array_push($monogram_placementcontainer, $tempcontain);
        }


        $monogram_color = array(
            'Contrast_Thread' => 'Contrast Thread',
            'Matching_Thread' => 'Matching Thread',
        );


        $monogram_colorcontainer = [];
        foreach ($monogram_color as $key => $value) {
            $tempcontain = array(
                "title" => $value,
                "image" => "./custom_form_view/shirt/monogram_color/" . $key . ".jpg",
                "default" => $value == 'No Monogram' ? '1' : '',
                "lable" => $value,
                "parent" => "",
                "parenttitle" => "",
            );
            array_push($monogram_colorcontainer, $tempcontain);
        }




        $shirtCustomization = array(
            'Body Fit' => getChildren(10),
            'Collar Style' => getChildren(11),
            'Add 2 Buttons On The Collar Band' => getChildren('13'),
            'Collar & Cuff Stiffness' => getChildren('14'),
            'Collar Stays' => getChildren('15'),
            'Sleeve Style' => $sleevestyle,
            'Cuff Style' => $cuff_style_container,
            'Wrist Watch' => $watchoption_container,
            'Front Style' => getChildren('16'),
            'Back Style' => getChildren('17'),
            'Darts' => getChildren('18'),
            'Pocket Style' => getChildren('19'),
            'Bottom Style' => getChildren('20'),
            'Collar & Cuff Feature' => getChildren('21'),
            'Inner Collar Insert' => $ccinsert,
            'Inner Cuff Insert' => $ccinsert,
            'Inner Front Placket Insert' => $ccinsert,
            'Label' => getChildren('24'),
            'Button' => $buttoncontainer,
            'Monogram Placement' => $monogram_placementcontainer,
            'Monogram Style' => $monogramontainer,
            'Monogram Initial' => array(),
            'Monogram Color' => $monogram_colorcontainer,
        );


        $selectelements = array(
            'Body Fit' => "Loose Fit",
            'Collar Style' => 'Medium Spread (1 5/8" x 3 ")',
            'Add 2 Buttons On The Collar Band' => "No",
            'Collar & Cuff Stiffness' => "Standard",
            'Collar Stays' => "Permanent",
            'Sleeve Style' => "Long Sleeve",
            'Cuff Style' => "Single Cuff Rounded",
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
            "Body Fit" => array(
                "icon" => "body_fit",
                "child" => ['Body Fit' => array("col" => "4"),],
            ),
            "Collar" => array(
                "icon" => "body_fit",
                "child" => [
                    'Collar Style' => array("col" => "4", "lablestyle" => "height:60px", "maxsize" => "bodymax400"),
                    'Add 2 Buttons On The Collar Band' => array("col" => "3"),
                    'Collar & Cuff Stiffness' => array("col" => "3"),
                    'Collar Stays' => array("col" => "3"),
                ]
            ),
            "Sleeve & Cuff Style" => array(
                "icon" => "body_fit",
                "child" => [
                    'Sleeve Style' => array("col" => "4", "lablestyle" => "",),
                    'Cuff Style' => array("col" => "4", "lablestyle" => "", "maxsize" => "bodymax400", "depandent" => "Sleeve Style"),
                    'Wrist Watch' => array("col" => "4", "lablestyle" => "", "depandent" => "Sleeve Style")
                ],
            ),
            "Front & Back" => array(
                "icon" => "body_fit",
                "child" => [
                    'Front Style' => array("col" => "3", "lablestyle" => "",),
                    'Back Style' => array("col" => "4", "lablestyle" => "",),
                    'Darts' => array("col" => "4", "lablestyle" => "",),
                ]
            ),
            "Pocket" => array(
                "icon" => "body_fit",
                "child" => ['Pocket Style' => array("col" => "4", "lablestyle" => "height:60px",),],
            ),
            "Bottom" => array(
                "icon" => "body_fit",
                "child" => ['Bottom Style' => array("col" => "4", "lablestyle" => "height:60px",),],
            ),
            "Collar & Cuff Feature" => array(
                "icon" => "body_fit",
                "child" => [
                    'Collar & Cuff Feature' => array("col" => "4", "lablestyle" => "",),
                    'Inner Collar Insert' => array("col" => "4", "lablestyle" => "", "view" => "multi"),
                    'Inner Cuff Insert' => array("col" => "4", "lablestyle" => "", "view" => "multi"),
                    'Inner Front Placket Insert' => array("col" => "4", "lablestyle" => "", "view" => "multi"),
                ],
            ),
            "Button & Lable" => array(
                "icon" => "body_fit",
                "child" => ['Label' => array("col" => "4", "lablestyle" => "",),
                    'Button' => array("col" => "4", "lablestyle" => "",)],
            ),
            "Monogram" => array(
                "icon" => "body_fit",
                "child" => [
                    'Monogram Placement' => array("col" => "4", "lablestyle" => "",),
                    'Monogram Style' => array("col" => "4", "lablestyle" => "",),
                    'Monogram Initial' => array("col" => "4", "lablestyle" => "", "view" => "text"),
                    'Monogram Color' => array("col" => "4", "lablestyle" => "",),
                ],
            ),
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

}

?>