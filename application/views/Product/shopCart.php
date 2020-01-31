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
                                <th style="width: 7%;">SKU</th>
                                <th style="width: 7%;">Item</th>
                                <th style="width: 12%;">Qty.</th>
                                <th style="width: 9%;">Price</th>
                                <th style="width: 12%;">Extra Price</th>
                                <th style="width: 9%;">Total</th>
                                <th style="width: 9%;"></th>

                            </tr>





                            <tr class="" ng-repeat="citem in shopCart.cartdata.products">

                                <td>
                                    <div class="col-md-4" style="">
                                        <a href="#" class="r_corners d_inline_b wrapper">
                                            <img src="{{citem.item_image}}" alt="" style="height:74px;width:74px;">
                                        </a>
                                    </div>
                                    <div class="col-md-8 hideonmobile" style="padding: 0px">
                                        <p class="m_bottom_5"><a href="#" class="color_dark tr_all">{{citem.title}}</a></p>
                                        <p class="" style="margin-top: -8px;font-size: 13px" data-toggle="tooltip" data-placement="left" title="Sand ">
                                            {{citem.product_speciality}}  
                                        </p>
                                        <span data-toggle="" data-placement="left" title="View Summary"><a href="#" style="padding: 0px;height: 22px;width: 28px;margin-left:1px" class="btn btn-default btn-xm" data-toggle="modal" data-target="#myModal{{citem.customization_id}}"><i class="icon-eye"></i></a></span>
                                        <span data-toggle="" data-placement="left" title="Save PDF"><a href="#" style="padding: 0px 20px 14px 5px;height: 22px;width: 26px;" class="btn btn-default"><i class="icon-download"></i></a></span>
                                        <span data-toggle="" data-placement="left" title="Send Mail"> <a href="#" style="padding: 0px 20px 14px 5px;height: 22px;width:0px" class="btn btn-default btn-xm"><i class="icon-mail"></i></a></span>
                                        <!-- Summary -->
                                        <div class="modal fade ui-draggable" id="myModal{{citem.customization_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post" action="#" class="ng-pristine ng-valid">
                                                        <div class="modal-header" style="color: white">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                ×
                                                            </button>
                                                            <p class="modal-title" id="myModalLabel">
                                                                Style Id -{{citem.customization_data}}                                                                      </p>
                                                        </div>
                                                        <div class="modal-body">
                                                        
                                                            <table class="table" id="table3" style="border:1px solid #B8B8B8">
                                                                <tbody>
                                                                    <tr style="font-size: 14px;padding-bottom: 0px;padding-top: 0px;border-bottom: 1px solid #B8B8B8;" ng-repeat="(stylek, stylev) in citem.style.style">
                                                                        <td class="tds">{{stylek}}</td>
                                                                        <td class="tds" style="line-height: 13px !important;max-width: 230px;overflow-y: scroll;">{{stylev}}</td>
                                                                    </tr> 
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                                            </button>

                                                        </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                        <!-- End -->
                                    </div>
                                </td>
                                <td data-title="SKU" class="fw_light">{{citem.sku}}  </td>
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

                                <td data-title="Price">{{citem.price|currency}}  </td>
                                <td data-title="Extra Price">
                                    $00.00
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
                            <td colspan="5" rowspan="6">
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

                            <td><span class="spna">Sub Total</span>:</td>
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

                            <td><span class="spna">Coupon Discount</span>:</td>
                            <td>                                             <p id="discount_coupon" style="">$00.00</p>  

                            </td>
                        </tr>
                        <tr class="bg_light_2">

                            <td><span class="spna">Shipping Price</span>:</td>
                            <td> <p style="" id="shipping_amount">
                                    {{shopCart.cartdata.shipping_price|currency}}  

                                </p></td>
                        </tr>
                        <tr class="bg_light_2">

                            <td><span class="spna">My Wallet</span>:</td>
                            <td>
                                <p style="" id="wallet_amount1">
                                    $00.00
                                </p>
                                <form method="post" action="#" class="ng-pristine ng-valid">

                                </form>
                            </td>
                        </tr>
                        <tr class="bg_light_2">

                            <td><span class="spna" style="color:black;font-size: 16px"><b>Grand Total</b></span>:</td>
                            <td><span style="" id="tPrice"> {{shopCart.cartdata.grand_total|currency}} </span></td>
                        </tr>

                        </tbody></table>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="<?php echo base_url(); ?>assets/theme/angular/shopAllCart.js"></script>


<script src="<?php echo base_url(); ?>assets/theme/angular/productcontroller.js"></script>
<?php
$this->load->view('layout/footer');
?>
