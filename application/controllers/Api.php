<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->checklogin = $this->session->userdata('logged_in');
        $this->user_id = $this->checklogin ? $this->session->userdata('logged_in')['id'] : 0;
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
        //$query = $this->db->select('title, id, file_name')->from('products')->where("keywords LIKE '%$keyword%' or title LIKE '%$keyword%' ")->get();
        //$searchobj = $query->result_array();
        $pquery = "select nps.id as sid, nps.title as title, nptc.tag_id from nfw_product as nps 
        join nfw_product_tag_connection as nptc on nptc.product_id = nps.id 
        where nps.title  like '%$keyword%' and   nps.publishing='1' group by nps.title limit 0,15";
        $attr_products = $this->Product_model->query_exe($pquery);
        $container = [];
        foreach ($attr_products as $key => $value) {
            if ($value['tag_id'] == "2") {
                $value['tag_id'] = "11";
            }
            array_push($container, $value);
        }
        $this->response($container);
    }

    public function SearchSuggestApiJUI_get() {
        $getdata = $this->get();
        $keyword = $getdata['term'];
        $query = $this->db->select('title, id')->from('products')->where("keywords LIKE '%$keyword%'")->get();
        $searchobj = $query->result_array();
        $this->response($searchobj);
    }

    //ProductList APi
    public function productListPriceUpdateApi_get($category_id, $custom_id) {
        $attrdatak = $this->get();

        $categoriesString = $this->Product_model->stringCategories($category_id) . ", " . $category_id;
        $categoriesString = ltrim($categoriesString, ", ");

        $product_query = "select pt.id as product_id, pt.title
            from nfw_product as pt where pt.product_category in ($categoriesString)   and publishing=1 ";
        $product_result = $this->Product_model->query_exe($product_query);
        foreach ($product_result as $key => $value) {
            // print_r($value);
            $this->db->where(array("product_id" => $value["product_id"], "tag_id" => $custom_id));
            $queryat = $this->db->get("nfw_product_tag_connection");
            $pprice = $queryat->result();
            print_r($pprice);
            $isreal = 0;
            if ($pprice) {
                if ($isreal) {
                    $this->db->set(array("price" => 480));
                    $this->db->where(array("product_id" => $value["product_id"], "tag_id" => $custom_id));
                    $this->db->update("nfw_product_tag_connection");
                }
            }
            echo "<br/>";
        }


        $this->response(array("totalProduct" => count($product_result)));
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
                $message = array("status" => 2, "msg" => "Already In Cart", "type" => "warning", "product" => $productadd);

//                array_push($session_cart['products'], $productadd);
            } else {
                $session_cart = array('products' => array());
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
        if ($cartdataall['total_price'] > 249) {
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

    function parents($parentId) {
        $query = "select id from nfw_category where parent = $parentId";
        $res = $this->Product_model->resultAssociate($query);
        global $arrayChild;
        if ($arrayChild && count($arrayChild)) {
            
        } else {
            $arrayChild = [];
        }
        for ($i = 0; $i < count($res); $i++) {
            $id = $res[$i]['id'];

            array_push($arrayChild, $id);
            $this->parents($res[$i]['id']);
        }
        return $arrayChild;
    }

    function productList_get() {
        $category = "";
        $category_id = $this->get('category');
        if (($this->get('category')) && $this->get('category') != 0) {

            $dataId = $this->parents($category_id);

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
        $colorcount = $colorlistf ? count($colorlistf) : 0;
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

        $searchqury = "";
        if ($this->get("product_id")) {
            $productid = $this->get("product_id");
            $searchqury = " and np.id = $productid";
        }

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
                    where ntc.tag_id = $item_type and publishing = 1 $searchqury $sortt $colorquerycc $category $price group by np.id order by np.id $orderquerycolor ";

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

    function hexrgb($hexstr) {
        $int = hexdec($hexstr);

        return array("red" => 0xFF & ($int >> 0x10),
            "green" => 0xFF & ($int >> 0x8),
            "blue" => 0xFF & $int);
    }

    function createCaptha_get($captchatype = "") {
        //Settings: You can customize the captcha here
        $image_width = 120;
        $image_height = 40;
        $characters_on_image = 6;
        $font = APPPATH . '../assets/monofont.ttf';

//The characters that can be used in the CAPTCHA code.
//avoid confusing characters (l 1 and i for example)
        $possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
        $random_dots = 0;
        $random_lines = 20;
        $captcha_text_color = "0x142864";
        $captcha_noice_color = "0x142864";

        $code = '';

        $i = 0;
        while ($i < $characters_on_image) {
            $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1);
            $i++;
        }

        $font_size = $image_height * 0.75;
        $image = @imagecreate($image_width, $image_height);

//        /* setting the background, text and noise colours here */
        $background_color = imagecolorallocate($image, 255, 255, 255);
        $arr_text_color = $this->hexrgb($captcha_text_color);
        $text_color = imagecolorallocate($image, $arr_text_color['red'],
                $arr_text_color['green'], $arr_text_color['blue']);
//
//        $arr_noice_color = $this->hexrgb($captcha_noice_color);
//        $image_noise_color = imagecolorallocate($image, $arr_noice_color['red'],
//                $arr_noice_color['green'], $arr_noice_color['blue']);
//        /* generating the dots randomly in background */
//        for ($i = 0; $i < $random_dots; $i++) {
//            imagefilledellipse($image, mt_rand(0, $image_width),
//                    mt_rand(0, $image_height), 2, 3, $image_noise_color);
//        }
//        /* generating lines randomly in background of image */
//        for ($i = 0; $i < $random_lines; $i++) {
//            imageline($image, mt_rand(0, $image_width), mt_rand(0, $image_height),
//                    mt_rand(0, $image_width), mt_rand(0, $image_height), $image_noise_color);
//        }
        /* create a text box and add 6 letters code in it */
        $textbox = imagettfbbox($font_size, 0, $font, $code);
        $x = ($image_width - $textbox[4]) / 2;
        $y = ($image_height - $textbox[5]) / 2;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $code);
        $this->session->set_userdata("captchacode$captchatype", $code);
        /* Show captcha image in the page html page */
        header('Content-Type: image/jpeg'); // defining the image type to be shown in browser widow
        imagejpeg($image); //showing the image
    }

    function getUserShippingAddress_get() {
        $query = "SELECT * from `nfw_billing_shipping_address` where  user_id = '$this->user_id'  ";
        $result = $this->Product_model->resultAssociate($query);
        $this->response(array("address" => $result, "user" => $this->checklogin));
    }

    function setDefaultShippingAddress_get($addressid) {
        
    }

    function getOrderProducts_get($order_id) {
        $result = $this->Product_model->getCartDataCustomOrder($order_id);
        $this->response($result);
    }

    function getCustomCartDataOrder_get($order_id) {
        $query = "  SELECT * FROM `nfw_product_cart` where order_id='$order_id' and measurement_id!='';";
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

    function sendRegistrationEmail_get($user_id) {
        $emailurl = "http://email.nitafashions.com/Shop/index";
//                    $emailurl = "http://192.168.1.3/nitafashions/Shop/index";

        echo $url = $emailurl . "?user_id=" . $user_id . "&mail_type=2";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data2 = curl_exec($curl);
        curl_close($curl);
    }

    function orderEmailApi_get($order_id) {
        $url = "http://email.nitafashions.com/Shop/index?order_id=$order_id&user_id=$this->user_id&mail_type=1&mail_set=order";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
//        print_r($data);
        curl_close($curl);
    }

    function product_get($pid, $iid) {
        $prd = $this->Product_model->productItemInformation($pid, $iid);
        print_r($prd);
    }

    function getFeatureProducts_get() {
        $featureproducts = $this->Product_model->featurProductTag();
        $this->response($featureproducts);
    }

    function newsLetterApi_post() {
        if (1) {
            $userid = $this->user_id;
            $feq = $this->post('frequency');
            $subscribe = json_decode($this->post('subscribe'));

            $queryf = "select frequency from nfw_news_letters_frequency where user_id = " . $userid;
            $data = $this->Product_model->resultAssociate($queryf);

            if (count($data)) {
                if ($feq) {
                    //$uquery = "update nfw_news_letters_frequency set frequency = '$feq' where user_id=" . $userid;
                    // $dquery = "delete from nfw_news_letters_unsubscribe where user_id=$userid";
                    $this->db->set("frequency", $feq);
                    $this->db->where("user_id", $userid);
                    $this->db->update("nfw_news_letters_frequency");
                }
            } else {

                $ddquery = "select * from nfw_news_letters_unsubscribe where user_id=$userid";
                $dddata = $this->Product_model->resultAssociate($ddquery);
                if (count($dddata)) {
                    
                } else {
                    
                }
            }
            if ($feq) {
//                $dquery = "delete from nfw_news_letters_unsubscribe where user_id=$userid";
//                 $this->Product_model->resultAssociate($dquery);
//                $uquery = "insert into nfw_news_letters_frequency(user_id, frequency) values($userid, '$feq')";
//                $this->Product_model->resultAssociate($uquery);
            }
            $queryf = "select frequency from nfw_news_letters_frequency where user_id = " . $userid;
            $data = $this->Product_model->resultAssociate($queryf);
            $this->response($data);
        }
    }

    function faq_get() {
        $faq = array(
            "I would like to feel the fabrics before ordering my clothes. What should I do?"
            =>
            "A complimentary set of fabric swatches can be sent to you upon request. Please email us with the fabric numbers of your choice, along with your full name, telephone number and mailing address. ",
            "I just submitted my order but realized that I want to make a few changes. What should I do?"
            =>
            "As orders get processed very quickly (within 24 Hours), it is important that you email us with the changes you would like to make to your order before we cut the fabric.",
            "I would like to order new suits and shirts with the same style and size as my previous order. Would you have those details?"
            =>
            "If you have purchased with us in store or on one of our trunk shows, we have these details saved on our offline database. Whilst making your new online purchase please click the option which reads: “Please follow my most recent size/style from my most recent in store/ trunk show purchase. If more than one style has been selected during your in store/ trunk show purchase, we will email to clarify this information with you.

</br>If you have purchased with us online, please login to your profile on our website to view your previous online purchase.  Your previous style and size is recorded on your profile and you can select which one you wish to use. ",
            "Do you provide the option to purchase gift coupon?"
            =>
            "You may purchase a gift coupon on our website. When purchasing the gift coupon, be sure to enter the name & email address of the person you would like to gift it to, after confirming payment. If you or your friend does not receive the email within 30 minutes after you confirm payment, please email us. 

</br>Note:  Gift coupon amount is nonrefundable and must be used before the expiration date."
            ,
            "Can I save the styles I have designed and placed in my shopping cart?"
            =>
            "Yes your shopping cart will be saved on your profile. Be sure to have logged in to your profile for it to be saved on your account.  The design you have created for your suits and shirts can be saved with a nickname and can be selected when you are ready to make your purchase.",
            "How long does it take for me to receive my order?"
            =>
            "Once your order has been placed, it takes around 4-5 weeks for you to receive, if placed online. Orders placed in person with our chief tailor take 6-8 weeks to be received. All accessories and sample books take 7-10 days for you to receive. We only use shipping companies that are well recognized such as DHL and FedEx to make sure our customer receive the best service. ",
            "What is the shipping cost?"
            =>
            "All prices listed on the website is inclusive of standard shipping where you will receive your customized merchandise within 4-5 weeks. If your order total is less than US$250, then we charge an additional US$30 for shipping.
 </br>You can request for expedited shipping for US$75 per suit and US$ 15 per shirt. Orders placed with expedited shipping will be received within 2-3 weeks. ",
            "Are there different shipping methods to choose from? "
            =>
            "For small items such as accessories, sample books, and measurement tape etc. we always use standard airmail. Your custom made garments will be sent via a courier, such as UPS, FedEx and DHL. "
            ,
            "I received a delivery note/or phone call saying there was no one there to sign for the package on delivery, what do I do?"
            =>
            "Please email us and we will provide you with the tracking information and you will be able to contact the courier to reschedule delivery.",
            "I just received my order and there is a stain on my suit/shirt. What do I do?"
            =>
            "At times there may be some touches of the tailor’s chalk, or a mark caused by the ironing process that was left over. For both suits and shirts, our recommendation is for them to be dry cleaned. If the stain does not disappear, please take a picture of the stain on the garment and email a picture to us."
            ,
            "I just tried on my clothes but everything does not fit, what do I do?"
            =>
            "Please send us pictures of you wearing the garment, including the front, back and side profile. In the email please also let us know what changes you would like to make. ",
            "Can I make a return?"
            =>
            "For custom made garments, as these items have been made specially for you in your size there is a no return policy, however we can make the adjustments for you and mail your garment back to you. If you are not satisfied with your custom made garment please email us and we will do our best to find a solution for you. "
            ,
            "I have chosen my fabrics online, but would like to be measured by your Chief Tailor on his next visit in my city, what do I do?"
            =>
            "Please go to our schedule page to view which dates we will be in a city near you. You may make request for an appointment on the schedule page. "
            ,
            " Can I use my own material to make some suits or shirts?"
            =>
            "On special situations as such, please email us letting us know you would like to use your own materials. If you are a returning customer we will have your measurements on file. For new customers, please email us with your measurements, along with the style of the garment you wish to purchase.  It’s best to let us know how many yards of material you have so we can let you know if it enough to make the garments as per your request. "
            ,
            "How can I pay for my order?"
            =>
            "We accept Visa, MasterCard and American Express only. All orders need to be paid in full at checkout for us to proceed with the order. ",
            "How do I take my measurements?"
            =>
            "When you reach the section to input your measurements, we have step-by-step instructions to guide you through each measurement. If convenient, we recommend that you have a local tailor measure you in order to get a more accurate size.",
            "What is the purpose of creating an online account?"
            =>
            "Once you have created an online account, it is very convenient for you to make a purchase with us. Your measurements will be saved on the account; all styles you have personalized with us will be saved as well. This will make the re-order process very simple and easy. Your shipping address and billing address can be changed using your account. If there are any modifications on your size you can update the measurements on your account as well. ",
        );
        $this->response($faq);
    }
}

?>