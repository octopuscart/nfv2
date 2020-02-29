<?php
$this->load->view('layout/header');
?>   
<style>
    .fw_light{

        color: #000;
    }

    .selectall input[type="checkbox"] + label:before {
        content: "";
        font-family: "fontello";
        display: block;
        position: relative;
        background: #F00 none repeat scroll 0% 0%;
        top: -6px;
        left: -38px;
        width: 22px;
        height: 23px;
        border: 2px solid #C00;
    }

    .lableall:after {
        content: '\e914';
        font-family: "fontello";
        position: absolute;
        left: 11px!important;
        top: -14px!important;
        font-size: 33px;
        display: none;
        color: #fff;
    }
    .title_counter_type:before {
        content: counter(counter);
        font-style: italic;
        color: #fff;
        position: absolute;
        left: 0;
        padding: 7px 0;
        height: 79%;
        width: 38px;
        text-align: center;
        top: 0;
    }



</style>
<style>
    .close{
        opacity: 1;
    }
    .modal-header{
        padding: 3px 19px;
        background: black;
    }
    .tds{
        padding: 8px;
        line-height: 0.42857143 !important;
        vertical-align: top;

    }
    td.measurement_style {
        padding: 0px 5px;
        width: 50%;
    }


</style>
<style>
    .cartTitle{
        color: white;
        padding: 0px 5px;
        margin-top: 8px;
        text-align: center;
        width: 100%;
        background: url("../assets/images/ribbon.png");
        margin-left: -14px;
        font-size: 13px;
        background-size: 130px 44px;
        width: 104px;
        height: 44px;
        position: absolute;
    }
    .cartCustomizeStyle{
        float: left;
        margin-left: 13px;
        width: 95px;
        margin-top: 4px;
    }
    .withoutCustom th{
        border: none;

    }
    .withoutCustom td{
        border: none;

    }
    .withCoustom th{
        border: none;
    }
    .withCoustom td{
        border: none;
    }


    .bg_color_purple, .paginations .active a, .paginations li a:hover, .step:hover .step_counter, .title_counter_type:before, .bg_color_purple_hover:hover, .animation_fill.color_purple:before, .p_table.bg_color_purple_hover.active, [class*="button_type_"].transparent.color_purple:hover, [class*="button_type_"].color_purple:not(.transparent) {
        background: #000000;
    }

    .no_item_found h2{
        font-size: 31px;
        font-weight: 300;
        padding: 8%;
        position: static;
    }

    .no_item_found{
        background-size: cover;
    }
    .no_item_found b{
        color: #B90000;
        font-weight: 400!important;
    }

    .badge {
        display: inline-block;
        min-width: 6px;
        padding: 5px 5px;
        font-size: 11px;
        font-weight: 700;
        line-height: 1;
        color: #FFF;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        background-color: #FD0000;
        border-radius: 15px;
        /* border: 2px solid #484848; */
        float: right;
    }





</style>

<link href="<?php echo base_url(); ?>assets/theme/angular/customform.css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/theme/angular/customstyle.css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/bootstrap.vertical-tabs.css" rel="stylesheet"/>



<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding:15px ">
    <div class="container">

        <h5 style="    font-weight: 300;    margin-bottom: 10px;
            font-size: 46px;">
            <span class="icon-stack">

                <i class="icon-basket icon-light"></i>
            </span> Checkout Now</h5>

        <small style="font-size: 15px"> </small>

    </div>


</section>



<div class=" counter" style=""  ng-controller="shopAllCartCustom">
    <div class="container shopAllCart" style="margin-bottom: 20px"   ng-if="shopCart.cartdata.total_quantity">
        <div class=" tab-content" style="">
            <ul class="nav nav-tabs shippingcartul" role="tablist" style="font-size: 20px">

                <li role="presentation" class="active">
                    <a href="#orderReview" aria-controls="orderReview" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-search"></i></span>Order Review
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#billingShipping" aria-controls="billingShipping" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-map"></i></span>Shipping Address
                    </a>
                </li>
                <li role="presentation">
                    <a href="#paymentMode" aria-controls="paymentMode" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-dollar"></i></span>Payment Method
                    </a>
                </li>
                <li role="presentation">
                    <a href="#confirmOrder" aria-controls="confirmOrder" role="tab" data-toggle="tab">
                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-thumbs-up-1"></i></span>Confirm Order
                    </a>
                </li>

            </ul>
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="orderReview" style="margin-top:0px ;   overflow-x: scroll;">
                <div>
                    <table class="table">

                        <tbody><tr>
                                <th style="width: 25%;"><span style="margin: 0px 0px 0px 13px;">Product</span></th>
                                <th style="width: 25%;">Style Id / Measurement Profile	</th>
                                <th style="width: 7%;">Item</th>
                                <th style="width: 100px;">Qty.</th>
                                <th style="width: 9%;">Price</th>
                                <th style="width: 12%;">Extra Price</th>
                                <th style="width: 9%;">Total</th>
                                <th style="width: 10px;"></th>

                            </tr>





                            <tr class="" ng-repeat="citem in shopCart.cartdata.products">

                                <td>
                                    <div class="col-md-4" style="">
                                        <a href="#" class="r_corners d_inline_b wrapper">
                                            <img src="{{citem.item_image}}" alt="" style="    height: 70px;    width: 70px;;">
                                        </a>
                                    </div>
                                    <div class="col-md-8 hideonmobile" style="padding: 0px">
                                        <p class=""><a href="#" class="color_dark tr_all">{{citem.title}}</a></p>
                                        <p class="textoverflow" style="font-size: 12px" data-toggle="tooltip" data-placement="left" title="Sand ">
                                            {{citem.product_speciality}}  
                                        </p>
                                        <button class="btn btn-xs btn-default" ng-if="citem.customization_id > 0" ng-click="viewStyle(citem.style)">View</button>

                                    </div>
                                </td>
                                <td data-title="SKU" class="fw_light">

                                    <table class="addr measurement_style" style="width: 100%;margin-top: 11px;">
                                        <tbody><tr style="font-size: 13px">
                                                <td class="measurement_style" >Style Id</td>

                                                <td class="measurement_style">{{citem.customization_data}}</td>
                                            </tr>
                                            <tr style="font-size: 13px">
                                                <td class="measurement_style">Measurement Profile</td>

                                                <td class="measurement_style">{{citem.measurement_data}}</td>
                                            </tr>
                                        </tbody></table>


                                </td>
                                <td>

                                    <p>{{citem.tag_title}}  </p>
                                </td>

                                <td data-title="Quantity" style="width: 90px">
                                    <div class="wrapper fs_medium r_corners d_inline_b quantity clearfix" style="border-bottom-left-radius: 0px;
                                         border-bottom-right-radius: 0px;">
                                        <button type="button" class="f_left bg_light_3" data-count="minus" ng-click="subCartData(citem)">
                                            <i class="icon-minus "></i>
                                        </button>
                                        <input type="text" name="quantity1" value="{{citem.quantity}} " class="f_left color_grey bg_light" disabled="">
                                        <button type="button" class="f_left bg_light_3" data-count="plus" ng-click="plusCartData(citem)">
                                            <i class="icon-plus"></i>
                                        </button>
                                    </div>




                                </td>

                                <td data-title="Price">{{(citem.price - citem.extra_price)|currency}}  </td>
                                <td data-title="Extra Price">
                                    {{citem.extra_price|currency}}<br/>
                                    <button class="btn btn-xs btn-default" ng-if="citem.extra_price > 0" ng-click="viewExtraPrice(citem.style)">View</button>
                                </td>
                                <td data-title="Total" class="fw_ex_bold color_dark" style="">
                                    {{citem.total_price|currency}}     

                                </td>

                                <td data-title="Action" class="fw_ex_bold color_dark" style="width:20px">
                                    <button class="color_grey_light_2 color_dark_hover tr_all" ng-click="removeCartData2(citem)">
                                        <i class="icon-cancel-circled-1 fs_medium"></i>
                                    </button>

                                </td>

                            </tr>




                        <input type="hidden" id="no_of_product" value="3">

                        <tr class="bg_light_2">
                            <td colspan="4" rowspan="6">
                                <div class="test1" style="padding: 34px;">
                                    <!-- ################# -->
                                    <div class="d_table w_full" style="margin-bottom: 5px;">
                                        <div class="col-lg-8 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
                                        </div>
                                    </div>
                                    <!-- ################# -->

                                    <div class="d_table w_full" style="">
                                        <div class="col-lg-8 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
    <!--                                            <p class="fw_light d_inline_m m_right_5 d_xs_block"></p>-->
                                            <form method="post" action="#" class="ng-pristine ng-valid">
                                                <input type="hidden" name="total_price" value="">
                                                <span>Coupon Code</span><span style="text-align:right">:</span>
                                                <input type="text" placeholder="Enter your coupon code here" class="color_grey r_corners bg_light fw_light coupon m_xs_bottom_15" name="discount_copon" style="width:40%;height:27px;color: black" autocomplete="off">
                                                <button name="coupon" class="d_inline_b tr_all r_corners button_type_1 color_pink transparent fs_medium mini_side_offset btn btn-default" id="discount" value="" type="submit">
                                                    Submit
                                                </button>


                                            </form>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 7px;height: 0px;margin-bottom: 8px;">
                                    <!-- ################# -->
                                    <div class="d_table w_full" style="display: none">
                                        <div class="col-lg-8 col-md-9 col-sm-11 d_table_cell f_none d_xs_block">
                                            <form method="post" action="#" class="ng-pristine ng-valid">
                                                <span>Available Wallet Amount</span><span style="text-align:right">:                                                        </span>


                                                <input type="hidden" class="r_corners bg_light fw_light coupon m_xs_bottom_15 is_number" placeholder="Enter amount" name="wallet_amount" style="height:27px;width:20%;" value="" onkeyup="checkNet(this)" autocomplete="off">
                                                <button name="wallet" class="d_inline_b tr_all r_corners button_type_1 color_pink transparent fs_medium mini_side_offset" id="" value="gfg" type="submit">
                                                    Submit
                                                </button>

                                            </form>


                                        </div>
                                    </div>

                                    <!-- ################# -->


                                </div>

                            </td>

                            <td colspan="2"><span class="spna">Sub Total</span>:</td>
                            <td>
                                <p style="" id="sub_total">
                                    {{shopCart.cartdata.total_price|currency}} 
                                </p>
                            </td>
                        </tr>
<!--                                <tr class="bg_light_2">

                            <td><span class="spna">Tax/Custom</span>:</td>
                            <td><p style="">$00.00</p></td>
                        </tr>-->
                        <tr class="bg_light_2">

                            <td colspan="2"><span class="spna">Coupon Discount</span>:</td>
                            <td>                                             <p id="discount_coupon" style="">$00.00</p>  

                            </td>
                        </tr>
                        <tr class="bg_light_2">

                            <td colspan="2"><span class="spna">Shipping Price</span>:</td>
                            <td> <p style="" id="shipping_amount">
                                    {{shopCart.cartdata.shipping_price|currency}}  

                                </p></td>
                        </tr>
                        <tr class="bg_light_2">

                            <td colspan="2"><span class="spna">My Wallet</span>:</td>
                            <td>
                                <p style="" id="wallet_amount1">
                                    $00.00
                                </p>
                                <form method="post" action="#" class="ng-pristine ng-valid">

                                </form>
                            </td>
                        </tr>
                        <tr class="bg_light_2">

                            <td colspan="2"><span class="spna" style="color:black;font-size: 16px"><b>Grand Total</b></span>:</td>
                            <td><span style="" id="tPrice"> {{shopCart.cartdata.grand_total|currency}} </span></td>
                        </tr>

                        </tbody></table>
                </div>
                <div class="well well-sm">
                    <nav aria-label="...">
                        <ul class="pager">
                            <li class="next next-tab"><a href="javascript:function() { return false; }">Next <span aria-hidden="true">&rarr;</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="billingShipping">
                <div class="inloading" ng-if="userAddress.loader == '1'">
                    <h2>Loading...</h2>
                </div>

                <div class="shippinginfoblock" ng-if="userAddress.loader == '0'">
                    <h2>Choose Address For Shipping

                        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addressModal">
                            Add New
                        </button>
                    </h2>

                </div>
                <div class="nodatafound shippinginfoblock" ng-if="userAddress.loader == '2'">
                    <h2>
                        <span style="color:red">
                            SHIPPING  ADDRESS NOT FOUND! PLEASE ADD YOUR  SHIPPING  ADDRESS
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addressModal">
                                Add New
                            </button>
                        </span>
                    </h2>
                </div>
                <div class="row" style="margin-top: 20px;">

                    <div class="col-md-3 " ng-repeat="address in userAddress.list">
                        <div class="addressblock {{address.id == userAddress.selected.id?'active':''}}">
                            <address>
                                {{address.address1}}<br>
                                {{address.address2}}<br>
                                {{address.city}}, {{address.state}}<br>
                                {{address.country}}, {{address.zip}}<br>
                            </address>
                            <div ng-if="address.id == userAddress.selected.id" class="addressbarbottom">
                                <i class="selectedaddress fa fa-check"></i>
                            </div>

                            <div ng-if="address.id != userAddress.selected.id" class="addressbarbottom">
                                <button class="btn btn-default buttonaddressselect" ng-click="selectAddress(address)">Select</button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="well well-sm">
                    <nav aria-label="...">
                        <ul class="pager">
                            <li class="previous previous-tab"><a href="javascript:function() { return false; }" ><span aria-hidden="true">&larr;</span> Previous</a></li>
                            <li class="next next-tab"><a href="javascript:function() { return false; }">Next <span aria-hidden="true">&rarr;</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>



            <div role="tabpanel" class="tab-pane" id="paymentMode">
                <div class="" style="margin-top: 10px;">
                    <div class="col-lg-6 col-md-6 m_bottom_40 m_xs_bottom_30">
                        <p class="" style="font-size: 28px;font-weight: 300;
                           background-color: #000;
                           padding: 10px;
                           color: #fff;
                           margin-bottom: 20px;
                           "><i class="icon-truck"></i> Shipping Method</p>

                        <ul>
                            <li class="m_bottom_15" style="padding: 0px 25px;    padding: 0px 25px;
                                font-size: 20px;
                                color: #000;
                                font-weight: 300;">
                                <b>Free Shipping</b> - if your shopping is at least US$<b><?php echo $shiping_deduct[0]['min_amount']; ?></b>, <br/>else US$<b><?php echo $shiping_deduct[0]['shipping_amount']; ?></b> will be charged. 
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6  m_bottom_40 m_xs_bottom_30">
                        <p class="" style="   font-size: 28px;
                           font-weight: 300;
                           background-color: #000;
                           padding: 10px;
                           color: #fff; 
                           margin-bottom: 20px;
                           "><i class="icon-dollar"></i> Payment Methods</p>

                        <h5 class="fw_light color_dark m_bottom_23"><i class="icon-money"></i> Manual Payment</h5>
                        <ul> 
                            <li class="m_bottom_15">
                                <input type="radio" checked="" id="radio_131" name="card_id" class="d_none" value="post_pay">
                                <label for="radio_131" class="d_inline_m m_right_15 m_bottom_3 fw_light">
                                    For manual payment mail to <b>sales@nitafashions.com</b>                                  
                                </label>
                            </li>
                        </ul>

                        <hr style="height: 0px;margin-top: 0px;">
                        <?php if ($cardinfo) { ?>
                            <div class="addressblock" style="    height: 200px;
                                 margin-bottom: 11px;">
                                 <?php
                                 echo "<p style='white-space: pre-line;'>" . $cardinfo . "</p>";
                                 ?>
                                <div class="" style="margin-top: 10px;">
                                    <form method ="post" action="#">
                                        <button class="btn btn-danger " type="submit" name="removecard">Remove</button>
                                    </form>
                                </div>
                            </div>
                            <input type="radio" checked id="radio_6_card" name="card_id" class="d_none" value="<?php echo $_SESSION['cardinfo']; ?>">
                            <label for="radio_6_card" class="d_inline_m m_right_15 m_bottom_3 fw_light">Select This Card</label>
                            <!--                                <form method="post" action="#">
                                                                <button type="submit" name="removecard" class=" btn btn-danger btn-xs">Remove Card</button>
                                                            </form>-->
                            <?php
                        } else {
                            ?>
                            <span style="color:red;margin-top: 17px;">TO PAYMENT WITH CREDIT CARD, KINDLY ADD CREDIT CARD DETAILS <i class="icon-right-1"></i></span>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myCardModal" id=""><i class="icon-plus"></i> Add Card Detail</button>

                            <?php
                        }
                        ?>


                    </div>
                </div>
                <div style="clear: both"></div>
                <div class="well well-sm">
                    <nav aria-label="...">
                        <ul class="pager">
                            <li class="previous previous-tab"><a href="javascript:function() { return false; }" ><span aria-hidden="true">&larr;</span> Previous</a></li>
                            <li class="next next-tab"><a href="javascript:function() { return false; }">Next <span aria-hidden="true">&rarr;</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>


            <div role="tabpanel" class="tab-pane" id="confirmOrder">
                <form action="#" method="post">
                    <div class="orderinformation" style="width: 500px;">
                        <address>
                            <strong>Ship To</strong><br/>
                            {{userAddress.selected.address1}}<br>
                            {{userAddress.selected.address2}}<br>
                            {{userAddress.selected.city}}, {{userAddress.selected.state}}<br>
                            {{userAddress.selected.country}}, {{userAddress.selected.zip}}<br>
                            <input type="hidden" name="shipid" value="{{userAddress.selected.id}}" />
                        </address>
                        <hr/>
                        <strong>
                            Payment Methods: <?php echo $cardinfo ? 'Card' : 'Manual Payment'; ?>
                        </strong>
                        <hr/>
                        <table class="table">
                            <tr>
                                <td>
                                    Sub Total 
                                </td>
                                <td>
                                    <input type="hidden" name="totalprice" value="{{shopCart.cartdata.total_price|currency}}" />
                                    {{shopCart.cartdata.total_price|currency}} 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Shipping Price
                                </td>
                                <td>
                                    <input type="hidden" name="shippingprice" value="{{shopCart.cartdata.shipping_price}}" />
                                    {{shopCart.cartdata.shipping_price|currency}} 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Grand Total
                                </td>
                                <td>
                                    <input type="hidden" name="totalquantity" value="{{shopCart.cartdata.total_quantity}}" />
                                    <input type="hidden" name="grandtotal" value="{{shopCart.cartdata.grand_total|currency}}" />
                                    {{shopCart.cartdata.grand_total|currency}} 
                                </td>
                            </tr>
                        </table>
                        <div class="m_bottom_23 check">
                            <input type="checkbox" id="checkbox_71" name="" class="d_none" ng-model="orderProcess.confirmcheck">
                            <label for="checkbox_71" class="d_inline_m fw_light">I agree to the terms of service </label>
                            <p class="d_inline_m fw_light">(<a href="termAndCondition.php" target="_blank" class="tr_all color_dark_hover fw_light">Terms of service</a>)</p>

                        </div>
                        <button type="submit" name="confirm_order" ng-if="orderProcess.confirmcheck"  id="btn1" class="d_inline_b tr_all r_corners button_type_1 color_pink fs_medium mini_side_offset" value="dfjdg" style="margin: 0px 0px 10px;">
                            <i class="icon-check"></i> Confirm Order
                        </button>
                        <button type="button" name="orderConfirm" ng-if="!orderProcess.confirmcheck" disabled id="btn1" class=" disabled d_inline_b tr_all r_corners button_type_1 color_pink fs_medium mini_side_offset" value="dfjdg" style="margin: 0px 0px 10px;opacity: 0.5">
                            <i class="icon-check"></i> Confirm Order
                        </button>
                    </div>
                </form>
                <div style="clear: both"></div>
                <div class="well well-sm">
                    <nav aria-label="...">
                        <ul class="pager">
                            <li class="previous previous-tab"><a href="javascript:function() { return false; }" ><span aria-hidden="true">&larr;</span> Previous</a></li>
                        </ul>
                    </nav>
                </div>
                
                
            </div>

        </div>

    </div>

    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content" style="width: 79%;margin: 0px 0px 0px 61px;">
                <div class="modal-header" style="color: white">
                    <button type="button" class="close" 
                            data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Fill Address Detail
                    </p>
                </div>
                <form method ="post" action="#">
                    <div class="modal-body">

                        <table class="addr">
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name" class=""><b>Address (Line 1)</b></span>
                                </td>
                                <td>
                                    <input type="text" required name="address1" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>

                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name" class=""><b>Address (Line 2)</b></span>
                                </td>
                                <td>
                                    <input type="text" required required name="address2" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name" class=""><b>Town/City</b></span>

                                </td>
                                <td>
                                    <input type="text" required required name="city" class="form-control" value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name"><b>State</b></span>
                                </td>
                                <td>
                                    <input type="text" required required name="state" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>


                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name"><b>Zip/Postal</b></span>
                                </td>
                                <td>
                                    <input type="text" required  name="zip" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name"><b>Country</b></span>
                                </td>
                                <td>
                                    <input type="text" required required name="country" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" id="checkboxs_2" name="ship" class="d_none product_checkBox" value="1">
                                    <label for="checkboxs_2" class="d_inline_m m_right_10" style="line-height: 18px;">Use as shipping address</label>
                                </td>
                            </tr>
    <!--                        <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" id="checkboxs_1" name="bill" class="d_none product_checkBox" value="1">
                                    <label for="checkboxs_1" class="d_inline_m m_right_10" style="line-height: 18px;">Use as billing address</label>
                                </td>
                            </tr>-->


                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success " name="submitAddress" value="cc" style="margin: ">
                            <i class="icon-check"></i> Submit 
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id="myCardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content" style="">
                <div class="modal-header" style="color: white">
                    <button type="button" class="close" 
                            data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Fill Card Detail
                    </p>
                </div>
                <form class="form-horizontal" role="form" method="post" action="#">
                    <div class="modal-body" >


                        <fieldset>

                            <div class="form-group " style="    padding: 0px 50px;">

                                <label class=" control-label" for="card-holder-name">Fill Card Details</label>
                                <div class="">
                                    <textarea class="form-control" name="card-holder-name" id="card-holder-name" style="width: 100%;height: 200px;font-size: 20px;">Name on Card: .&#13;&#10;Card No.: &#13;&#10;Exp. Date: /&#13;&#10;CVV:  &#13;&#10;Card Type:  
                                    </textarea>
                                </div>


                            </div>

                        </fieldset>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success" name="card_submit" value="cc" style="">
                            <i class="icon-check"></i> Submit 
                        </button>


                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</div>


<script src="<?php echo base_url(); ?>assets/theme/angular/shopAllCart.js"></script>


<script src="<?php echo base_url(); ?>assets/theme/angular/productcontroller.js"></script>
<?php
$this->load->view('layout/footer');
?>
