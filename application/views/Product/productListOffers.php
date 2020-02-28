<?php
$this->load->view('layout/header');
?>   
<style>
    .page_navigation{}
    .page_navigation a {
        height: 10px;
        padding: 6px;
        margin: 1px;
        border: 1px solid #CFCFCF;
    }
    .active_page{
        background: #000000;
        color: #fff !important; 
    }
    .fabric_color_list{
        width: 22px;
        margin-top: -33px;
        z-index: 9999999999;
        /* margin-left: 3px; */
        position: absolute;
        margin-top: -12px;
        padding: 0px;
        border: 1px solid #B3B3B3;
    }
    .fabric_color_list_button{
        margin-top: 0px !important;;
        float: left;
        margin-left: 4px;
        height: 10px;
        width: 20px;
        margin-bottom: 0px;
    }
    .color_button {
        border: 1px solid #000;
    }

    .color_button_check {
        border: 1px solid #000;
        height: 26px;
        margin-bottom: 4px;
        margin-right: 4px;
        float: left;
        width: 35px!important;
        padding-left: 0px;
    }
    input[type="checkbox"] + label:before {
        content: '';
        font-family: "fontello";
        display: block;
        position: absolute;
        background: rgba(0, 0, 0, 0);
        top: 0;
        left: 5px;
        width: 22px;
        height: 23px;
        border: 0px solid #cc0000;
        -webkit-border-radius: 0%; 
        -moz-border-radius: 0%;
        border-radius:0%; 
    }
    input[type="checkbox"] + label:after {
        content: '\e914';
        font-family: "fontello";
        position: absolute;
        left: 6px;
        top: -1px;
        display: none;
        color: #FFFFFF;
        text-shadow: 0px 0px 3px #000;
    }

    .color_list input[type="checkbox"] + label {
        width: auto !important;
        position: relative;
        padding-left: 18px;
        cursor: pointer;
        /* padding-bottom: 10px; */
    }

    span.sale_price {
        margin-left: 15px;
    }
    span.cut_price {
        text-decoration: line-through;
        color:#A5A1A1;
    }
    span.filtercolor {
        height: 20px;
        width: 20px;
        float: left;
        margin-left: 4px;
        border: 1px solid rgba(0, 0, 0, 0.15);
    }
    .removecolor {
        margin-top: 1px;
        margin-left: 3px;
        cursor: pointer;
        color: #FFF;
        text-shadow: 0px 1px 1px #000;
    }
    .waves-effect{
        display: inherit;
    }
</style>
    <?php
       $offertitle = array(
           '1'=>'Shirt',
           '2'=>'Pant',
           '5'=>'Jacket',
           '11'=>'Suit',
       );
//       error_reporting(E_ALL); ini_set('display_errors', 1);
       ?>

<div ng-controller="productConroller" id="ProductListControllerId">
    <!--end of template-->
  

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
        <div class="">
            <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c" style=" color:white;   margin: 13px auto 0px;font-size: 24px;">Offers - <span ><?php echo $offertitle[$_GET['item_type']]; ?></span></h3>
            <!-- breadcrumbs -->
            <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">

                <li class="m_right_8 f_xs_none" style="    margin: 0 18px;">
                    <a href="<?php echo site_url("Product/productListOffers"); ?>?category=0&item_type=1&sorting=Offers" class="" style="margin-right:0px !important;color:white;">
                        Shirt&nbsp;&nbsp;
                    </a>
                </li>

                <li class="m_right_8 f_xs_none" style="    margin: 0 18px;">
                    <a href="<?php echo site_url("Product/productListOffers"); ?>?category=0&item_type=2&sorting=Offers" class="" style="margin-right:0px !important;color:white;">
                        Pant&nbsp;&nbsp;
                    </a>
                </li>

                <li class="m_right_8 f_xs_none" style="    margin: 0 18px;">
                    <a href="<?php echo site_url("Product/productListOffers"); ?>?category=0&item_type=5&sorting=Offers" class="" style="margin-right:0px !important;color:white;">
                        Jacket&nbsp;&nbsp;
                    </a>
                </li>

                <li class="m_right_8 f_xs_none" style="    margin: 0 18px;">
                    <a href="<?php echo site_url("Product/productListOffers"); ?>?category=0&item_type=11&sorting=Offers" class="" style="margin-right:0px !important;color:white;">
                        Suit&nbsp;&nbsp;
                    </a>
                </li>


            </ul>
        </div>
    </section>

    <!--content-->
    <div class="section_offset" style="padding: 13px 0 67px;">
        <div class="container" style="    ">
            <div class="row">

                <aside class="col-lg-1 col-md-1 col-sm-1 m_bottom_70 m_xs_bottom_30"  style="padding: 0">
                </aside>

                <section class="col-lg-10 col-md-10 col-sm-10 m_bottom_70 m_xs_bottom_30" style="margin-top: -25px;">
                    <!--filter-->
                    <div class="clearfix m_bottom_10">
                        <div class="col-lg-6 col-md-6 col-sm-7 m_bottom_15">
                            <p class="d_inline_m fs_medium m_right_15" style="font-size: 12px;margin: 4px 0px 0px -14px;">

                        </div>

                    </div>
                    <input type="hidden" name="page_no" value="1">
                    <input type="hidden" name="record_per_page" value="3">
                    <!--<hr class="m_bottom_10">-->

                    <div class="row" style="margin-bottom: 20px;">
                     

                        <?php
                        if (isset($_SESSION['colorlist'])) {
                            ?>
                            <div class="pull-left" style="margin-top: -13px; margin-left: 30px;">

                                <span class="pull-left" style="    margin-top: -3px;">Color: </span>

                                <span class='filtercolor' colorfiltercode='{{scl.id}}'  ng-repeat="scl in selectedColorList" style="background: {{scl.color_code}}"><i class='fa  removecolor'></i></span>
                            </div>
                            <?php
                        }
                        ?>

                        <span class="info_text pull-right" style="margin:-15px 20px 0px 0px;color: black;font-size: 12px"></span>
                    </div>


                    </form>
                    <?php
                    //print_r($productList);


                    if (1) {
                        ?>
                        <!--products-->

                        <div class="" ng-if="loader == 0">
                            <div class="page_container" style='display: none'>

                                <div class='page' ng-repeat="pg in pageList"></div>



                            </div>



                            <div ng-if="productList.length > 0" class=" row  t_xs_align_c three_columns m_bottom_15" >

                                <div class="col-md-3 col-sm-6 productitems d_xs_inline_b animated appear-animation bounceIn appear-animation-visible" data-appear-animation="bounceIn" style="" ng-repeat="product in productList" >
                                    <figure class="fp_item t_align_c d_xs_inline_b ">
                                        <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c">
                                            <!--images container-->
                                            <a href="#" class='redirecturl'>
                                                <div class="fp_images relative ">
                                                    <img src="<?php echo IMAGESERVER; ?>{{product.image}}" alt="" class=" tr_all img1 lazy productlistimage" data-original="<?php echo IMAGESERVER; ?>{{product.image}}"  >
                                                    <img src="<?php echo IMAGESERVER; ?>{{product.image}}" alt="" class=" tr_all img2 lazy productlistimage" data-original="<?php echo IMAGESERVER; ?>{{product.image}}"   >

                                                </div>
                                                <div class="fabric_color" style="">

                                                    <center class="fabric_color_list">
                                                        <button ng-repeat="color in product.color.split(',')" 
                                                                class=" tr_delay  bg_color_dark  radio m_bottom_5 
                                                                fabric_color_list_button" 
                                                                value="4" 
                                                                style="background:#{{color.split('#')[1]}};
                                                                margin-left:0px;
                                                                height:{{10 / (product.color.split(',').length)}}px"></button>
                                                    </center>
                                                </div>
                                            </a>
                                            <!--labels-->
                                            <div class="labels_container" ng-switch="product.sort_type">
                                                <a href="#" class="d_block label color_scheme 
                                                   tt_uppercase fs_ex_small circle
                                                   m_bottom_5 vc_child t_align_c product_sort_type1" 
                                                   ng-if="product.sale_price != 0">
                                                    <span class="d_inline_m " >Sale</span>
                                                </a>
                                                <a href="#" class="d_block label color_scheme
                                                   tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c 
                                                   product_sort_type" ng-switch-when="MP">
                                                    <span class="d_inline_m " >MP</span>
                                                </a>
                                                <a href="#" class="d_block label color_scheme
                                                   tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c 
                                                   product_sort_type" ng-switch-when="New">
                                                    <span class="d_inline_m " >NEW</span>
                                                </a>
                                                <div ng-switch-when="MP_SALE">
                                                    <a href="#" class="d_block label color_scheme
                                                       tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c 
                                                       product_sort_type" >
                                                        <span class="d_inline_m " >MP</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <figcaption>
                                            <h6 class="m_bottom_5">
                                                <a href="#" class="color_dark titles" style="font-size: 14px;" id="">
                                                    {{product.title}}
                                                </a>
                                            </h6>

                                            <a href="#" class="fs_medium color_grey d_inline_b m_bottom_3 textoverflow"> 
                                                <i class="product_speciality" data-toggle="tooltip" data-placement="center" title="{{product.product_speciality}}">
                                                    {{product.product_speciality|limitTo:25}} {{product.product_speciality.length>25?'...':''}}
                                                </i>
                                            </a>
                                            <div class="price_pd im_half_container m_bottom_10">
                                                <span ng-if="product.sale_price != 0" class="cut_price">US$ {{product.price}}</span>US$ {{product.price_r}}
                                                <!--                                                <div class="half_column d_sm_block w_sm_full d_xs_inline_m w_xs_half_column t_sm_align_c t_xs_align_r d_inline_m t_align_r tr_all animate_fctr with_ie">
                                                                                                    <ul class="rating_list d_inline_m hr_list tr_all">
                                                                                                        <li class="relative active lh_ex_small">
                                                                                                            <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                                                                            <i class="icon-star-1 color_yellow tr_all"></i>
                                                                                                        </li>
                                                                                                        <li class="relative active lh_ex_small">
                                                                                                            <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                                                                            <i class="icon-star-1 color_yellow tr_all"></i>
                                                                                                        </li>
                                                                                                        <li class="relative active lh_ex_small">
                                                                                                            <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                                                                            <i class="icon-star-1 color_yellow tr_all"></i>
                                                                                                        </li>
                                                                                                        <li class="relative active lh_ex_small">
                                                                                                            <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                                                                            <i class="icon-star-1 color_yellow tr_all"></i>
                                                                                                        </li>
                                                                                                        <li class="relative lh_ex_small">
                                                                                                            <i class="icon-star-empty-1 color_grey_light_2 tr_all"></i>
                                                                                                            <i class="icon-star-1 color_yellow tr_all"></i>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                    <a href="#" class="d_none reviews fs_medium color_dark m_left_5 tr_all">2 Review(s)</a>
                                                                                                </div>-->
                                            </div>

                                            <div class="clearfix fp_buttons">
                                                <div class="hideonmobile half_column w_md_full m_md_bottom_10 animate_fctl tr_all f_left f_md_none with_ie">
                                                    <button class="button_wave btn btn-default add_to_cart_button" price="150" item_type="<?php echo $_GET['item_type']; ?>" ng-click="addTocart(product.id, <?php echo $_GET['item_type']; ?>)" cartaddid="{{product.id}}" style="font-size: 12px;
                                                            height: 26px;    color: #000;
                                                            padding: 0px 6px;
                                                            width: 118px;">
                                                        <span class="d_inline_m clerarfix">
                                                            <i class="icon-basket f_left m_right_10 fs_large" style="line-height: 18px;"></i>
                                                            <span class="fs_medium" style="line-height:19px">
                                                                Add to Cart</span></span>
                                                    </button>
                                                </div>

                                                <div class="showonmobile">
                                                    <button class="button_wave btn btn-default add_to_cart_button d_inline_m_mob" price="150" ng-click="addTocart(product.id, <?php echo $_GET['item_type']; ?>)" item_type="<?php echo $_GET['item_type']; ?>" cartaddid="{{product.id}}" style="font-size: 12px;
                                                            height: 26px;    color: #000;
                                                            padding: 0px 6px;
                                                            width: 118px;">
                                                        <span class="d_inline_m clerarfix">
                                                            <i class="icon-basket f_left m_right_10 fs_large" style="line-height: 18px;"></i>
                                                            <span class="fs_medium" style="line-height:19px">
                                                                Add to Cart</span></span>
                                                    </button>
                                                </div>
                                                <?php
                                                if (isset($_SESSION['user_id'])) {
                                                    ?>
                                                    <div class="half_column w_md_full animate_fctr tr_all f_left f_md_none clearfix with_ie">
                                                        <button class="button_wave button_type_6 relative tooltip_container f_right f_md_none d_md_inline_b d_block color_pink r_corners vc_child tr_all color_purple_hover tr_all t_align_c m_right_5 m_md_right_0 add_to_cart_button" wishlistaddid="{{product.id}}" style="font-size: 12px;
                                                                height: 26px;
                                                                padding: 0px 6px;
                                                                width: 40px;"><i class="icon-heart d_inline_m fs_large"></i><span class="d_block r_corners color_default tooltip fs_small fw_normal tr_all">Add to Wishlist</span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>




                                <!--                                <div class="loader_image" style="    padding-top: 15%;    padding-bottom: 14%;">
                                                                    <center>
                                                                        <img src='http://preloaders.net/preloaders/335/Thin%20broken%20ring-128.gif'>
                                                                    </center>
                                                                    <h3 style="    text-align: center;
                                                                        padding-top: 30px;
                                                                        font-weight: 300;">
                                                                        Loading...
                                                                    </h3>
                                                                </div> -->



                            </div>


                            <div ng-if="productList.length == 0" class="loader_container" >

                                <h1 style="    text-align: center;
                                    margin-top: 9%;
                                    font-weight: 200;
                                    color: #000;">No Product Found.</h1>
                            </div>
                        </div>

                        <div class='loader_image' ng-if="loader == 1" style="    padding-top: 15%;    padding-bottom: 14%;" >
                            <center>
                                <img src='<?php echo base_url(); ?>assets/theme/loading.gif'>
                            </center>
                            <h3 style="    text-align: center;
                                padding-top: 30px;
                                font-weight: 300;">
                                Loading...   

                            </h3>
                        </div> 
                        <div class="page_navigation"  style="text-align: center;"></div>






                    </section>
                <?php } else {
                    ?>

                    <h1 style="    text-align: center;
                        margin-top: 9%;
                        font-weight: 200;
                        color: #000;">No Product Found.</h1>

                <?php } ?>

                <aside class="col-lg-1 col-md-1 col-sm-1 m_bottom_70 m_xs_bottom_30"  style="padding: 0">
                </aside>

            </div>
            <!--banners-->
        </div>
    </div>
</div>
<script>
    var customformdata = <?php echo json_encode($_GET); ?>;</script>
<script src="<?php echo base_url(); ?>assets/theme/angular/productcontroller.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/jquery.pajinate.js"></script>

<?php
$this->load->view('layout/footer');
?>
