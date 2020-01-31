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
            font-size: 46px;"> <i class="icon-basket color_grey_light_2 tr_inherit"></i>  Shopping Cart</h5>
        <!--breadcrumbs-->
        <small style="font-size: 15px">Your shopping cart contains <span id="total_cart_quantitys">{{initApp.maincart.total_quantity}} product(s)</span> </small>
    </div>
</section>



<div class=" counter" style="" >
    <div class="container shopAllCart" style="margin-bottom: 20px" ng-controller="shopAllCart">
        <div class=" tab-content" style="">
            <div class="" id="cusmotize_items">
                <div class="col-md-12">
                    
                    <div class="col-sm-2">
                        <ul class="nav nav-tabs tabs-left vertialTab" role="tablist" style="  ">

                            <li role="presentation" class="{{$index==0?'active':''}} " ng-repeat="(tagname, tagkey) in shopCart.itemslist">
                                <a class="" href="#{{$index}}" aria-controls="{{$index}}" role="tab" data-toggle="tab">
                                    {{tagname}}                                           
                                    <span class="badge">{{tagkey.length}}</span>
                                </a>
                            </li>


                        </ul>
                    </div>


                    <div class="col-sm-10" style="    padding-right: 0;">
                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div role="tabpanel" class="custom_form_tables tab-pane {{$index==0?'active':''}} " id="{{$index}}" ng-repeat="(tagname, tagkey) in shopCart.itemslist">

                                <div class="custom_container" style="

                                     color: #000;
                                     border: 1px solid;
                                     background-repeat: no-repeat;
                                     background-size: 935px;
                                     margin-bottom: 10px;
                                     padding-bottom: 10px;
                                     ">
                                    <p style="   
                                       font: 400 60px 'Lato';
                                       color: #FFF;
                                       font-size: 30px;
                                       font-weight: 300;
                                       background-color: #000;
                                       padding: 5px;
                                       ">

                                        {{tagname}}                                                     <a href="product_list.php?category=0&amp;item_type=15">
                                            <span style="
                                                  font-size: 17px;
                                                  font-weight: 500;
                                                  margin-top: 8px;
                                                  float: right;
                                                  /* text-decoration: overline; */
                                                  /* border: 1px solid #000; */
                                                  padding: 1px 10px;
                                                  color: #FFF;
                                                  border-bottom: 1px solid #F00;
                                                  text-align: right;
                                                  background-color: #000000;
                                                  ">&nbsp;Add More   {{tagname}}   To Cart <i class="icon-right-1"></i></span>
                                        </a>
                                    </p>
                                    <form method="post" action="#" style="width: 100%;overflow-x: scroll" class="ng-pristine ng-valid">
                                        <table class="table withoutCustom " style="background:#fff">
                                            <thead>
                                                <tr class="bg_light_2 color_dark">
                                                    <th style="width:30%">Product Information</th>
                                                    <th style="width:12%">SKU</th>
                                                    <th style="width:12%">Price</th>
                                                    <th style="width:12%">Qty.</th>
                                                    <th style="width:12%">Total</th>
                                                    <th style="width:5%"></th>
                                                </tr></thead>
                                            <tbody>
                                                <!-- without customized product list -->
                                                <tr class="tr_delay" ng-repeat="item in tagkey">

                                                    <td>
                                                        <div style="width: 65px;float: left;">
                                                            <a href="#" class="r_corners d_inline_b wrapper">
                                                                <img src="{{item.item_image}}" alt="" style="height:45px;width:42px;">
                                                            </a>
                                                        </div>
                                                        <div class="fabricBlock">                                  
                                                            <p class="m_bottom_5"><a href="#" class="color_dark tr_all">{{item.title}}</a></p>
                                                            <p class="textoverflow" style="margin-top: -8px;font-size: 13px">
                                                                {{item.product_speciality}}      
                                                            </p>
                                                        </div>

                                                    </td>
                                                    <td data-title="SKU" class="">   {{item.sku}}  </td>
                                                    <td data-title="Price" class="">   {{item.price|currency}}  </td>

                                                    <td data-title="Quantity" class="">
                                                        {{item.quantity}} 
                                                    </td>

                                                    <td data-title="Total" class="">
                                                        {{item.total_price|currency}}                                                                    </td>

                                                    <td data-title="Action" class="fw_ex_bold color_dark" style="width:20px">
                                                        <button class="color_grey_light_2 color_dark_hover tr_all" name="deleteCart" value="1381 ">
                                                            <i class="icon-cancel-circled-1 fs_large"></i>
                                                        </button>

                                                    </td>                                                                

                                                </tr>

                                            </tbody>
                                        </table>

                                        <a class="btn btn-danger btn-lg pull-left" href="<?php echo site_url("Customization/start/")?>{{tagkey[0].tag_id}}" type="submit" style="background:#000;    margin-left: 10px;">
                                            <i class="icon-tools"></i> Customize Now
                                        </a>
                                      
                                        <div style="clear: both"></div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>




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
