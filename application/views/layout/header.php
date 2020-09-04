
<!DOCTYPE html>
<html dir="ltr" lang="en-US" ng-app="nitaFashions" >
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Stylesheets
        ============================================= -->
        <?php
        meta_tags();
        ?>



        <!--web fonts-->
        <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic' rel='stylesheet' type='text/css'/>
        <!--libs css-->
        <!--<script src="<?php echo base_url(); ?>assets/theme/js/jquery-2.1.0.min.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

        <!--icoinc icon-->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" media="all">

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/theme/plugins/jackbox/css/jackbox.min.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/theme/plugins/owl-carousel/owl.carousel.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/theme/plugins/owl-carousel/owl.transitions.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/theme/plugins/rs-plugin/css/settings.css"/>
        <!--theme css-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/theme/css/animate.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/theme/css/theme-animate.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/theme/css/style.css"/>
        <!--head libs-->
        <script src="<?php echo base_url(); ?>assets/theme/js/angular.min.1.8.js"></script>
        <!--<script src="https://code.angularjs.org/1.8.0/angular.min.js"></script>-->

        <script src="<?php echo base_url(); ?>assets/theme/js/angular-sanitize.min.1.8.js"></script>
        <script src="<?php echo base_url(); ?>assets/theme/plugins/jquery.queryloader2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/theme/plugins/modernizr.js"></script>
        <script src="<?php echo base_url(); ?>assets/theme/angular/moment.min.2.26.js"></script>

        <!--vertical tabs-->
        <!--custom form support css and js-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/sweetalert2/sweetalert2.min.css"/>
        <link href="<?php echo base_url(); ?>assets/theme/css/customstyle.css" rel="stylesheet"/>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js"></script>
        <script>
            var urllink = "<?php echo site_url("Api"); ?>";
            var checklogin = "";
            var registrationurl = "<?php echo site_url("Account/registration"); ?>";
<?php
$session_data = $this->session->userdata('logged_in');
if ($session_data) {
    ?>
                var checklogin = "yes";
    <?php
}
?>
        </script>
        <script src="<?php echo base_url(); ?>assets/theme/angular/rootController.js"></script>

        <!-- Document Title
        
        ============================================= -->




    </head>


    <body  style="">
        <style type="text/css">
            #loading {
                position: fixed;
                z-index: 50000;
                height: 500px;

                color: #353231;
                text-indent: -9999px;
                top: 0px;
            }

            .v2 #loading { display: none; }


            #loader {

                /*background:transparent url("") no-repeat center 25%;*/
                height:100%;
                display: block;
                /*opacity: 0.3;*/
                /*background: #000;*/
            }


        </style>

        <script>

            (function ($) {

                $("html").removeClass("v2");
                $("body").ready(function () {
                })

                $("#header").ready(function () {
                    $("#progress-bar").stop().animate({top: "25%", opacity: 0.8}, 1000)
                });
                $("#footer").ready(function () {
                    $("#progress-bar").stop().animate({top: "75%", opacity: 0.5}, 1000)
                });
                $(window).load(function () {

                    $("#progress-bar").stop().animate({top: "100%", opacity: 0}, 500, function () {
                        $("#loading").fadeOut("fast", function () {
                            $(this).remove();
                            $("#price_loader").remove();
                            Waves.attach('.button_wave', ['waves-button', 'waves-float']);
                            Waves.attach('.waves-image1');
                            Waves.init();
                        });
                    });
                });
            })(jQuery);
            $(function () {

            })
        </script>


        <div id='loading' class="" style="width:100%;height: 100% ">
            <div id='progress-bar'>

            </div> 
            <div id='loader'>
                <div class='loaderstyle'>

                </div>
            </div>

        </div> 

        <?php
        include('mainmenu.php');
        ?>

        <?php
        if ($session_data) {
            if ($session_data['status'] == 'Inactive') {
                ?>


                <!--                <h2 style="    font-size: 18px;
                                    text-align: center;
                                    background: red;
                                    color: white;
                                    padding: 10px;">Your account is not active please check your inbox to get the activation link or contact to sales@nitafashions.com</h2>-->

                <?php
            }
        }
        ?>

        <div id="side_menu" class='bg_gradiant'>
            <header class="m_bottom_30 d_table w_full" >
                <!--logo-->
                <div class="d_table_cell half_column v_align_m" style="background: white">
                    <a href="<?php echo site_url("/");?>">
                        <img src="<?php echo base_url(); ?>assets/theme//images/logo/nf_logo_8.png" alt="Nita Fashions Logo">
                    </a>
                </div>
                <!--close sidemenu button-->
                <div class="d_table_cell half_column v_align_m t_align_r">
                    <button class="icon_wrap_size_2 circle color_light _2 d_inline_m" id="close_side_menu" aria-label="menuclose">
                        <i class="icon-cancel"></i>
                    </button>
                </div>
            </header>
            <hr class="divider_type_2 m_bottom_20">
            <!--main menu-->
            <nav>
                <ul class="side_main_menu fw_light">
                    <?php
                    foreach ($menuArrayMain as $mkey => $mvalue) {
                        ?>
                        <li class="container3d relative "  >
                        <li class="has_sub_menu  m_bottom_10">
                            <a href="<?php echo $mvalue['link']; ?>" class="d_block relative  color_black color_blue_hover"><?php echo $mvalue['title']; ?></a>
                            <?php
                            if (count($mvalue['submenu'])) {
                                ?>
                                <ul class="d_none m_top_10"> 
                                    <?php
                                    foreach ($mvalue['submenu'] as $mskey => $msvalue) {
                                        ?>
                                        <li class="m_bottom_10">
                                            <a href="<?php echo $msvalue['link']; ?>" class="d_block relative color_black color_blue_hover"> <?php echo $msvalue['title']; ?> </a>
                                            <?php
                                            if ($msvalue['submenu']) {
                                                ?>
                                                <ul class="d_none m_top_10">
                                                    <?php
                                                    foreach ($msvalue['submenu'] as $msskey => $mssvalue) {
                                                        ?>
                                                        <li class="m_bottom_10">
                                                            <a href="<?php echo $mssvalue['link']; ?>" class="d_block relative color_black color_blue_hover">  <?php echo $mssvalue['title']; ?>  </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>     
            </nav>
        </div>
        <!--side menu-->
        <!--layout-->
        <div class="wide_layout bg_light" style="width: 100%;" ng-controller="rootController">
            <!--header markup-->
            <header role="banner" class="relative type_2 appheaderpart" style="background-color: #fff;">
                <span class="gradient_line"></span>
                <nav class="navbar navbar-default showonmobile mobilemenu">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" aria-label="mobilemenu" id="open_side_menu3" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="position: absolute;
                                    float: right;
                                    right: 0px;
                                    z-index: 2000;
                                    opacity: 1;">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand"  style="color:white;    color: white;
                               text-align: center;
                               width: 100%;
                               float: left;
                               position: absolute;">Nita Fashions - Since 1953</a>
                        </div>


                </nav>

                <section class="header_top_part p_top_0 p_bottom_0 headertopemail topheadermobileposition">
                    <div class="container" >
                        <div class="">
                            <!--contact info-->
                            <!--                        <div class="col-lg-5 col-md-4 col-sm-5 t_xs_align_c">-->
                            <ul class="hr_list fs_small color_grey_light contact_info_list" >
                                <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                                    <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-phone-1"></i></span> + (852) 2721-9990
                                </li>
                                <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                                    <a href="mailto:sales@nitafashions.com" class="color_grey_light d_inline_b color_black_hover" style="color:#000"><span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-mail-alt"></i></span>sales@nitafashions.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                </nav>
                <!--            <hr>-->
                <!--header bottom part-->
                <section class="header_bottom_part type_2 bg_light" style="padding: 0px">
                    <div class="container">
                        <div class="d_table w_full d_xs_block">
                            <!--logo-->
                            <div class="col-lg-3 col-md-3 col-sm-3 d_table_cell d_xs_block f_none v_align_m logo t_xs_align_c">
                                <a href="<?php echo site_url("/");?>" class="d_inline_m m_xs_top_20 m_xs_bottom_20">
                                    <img src="<?php echo base_url(); ?>assets/theme/images/logo/nf_logo_8.png" style="margin-top: -11px; width: 146px; " alt="Nita Fashions Logo">
                                </a>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 t_align_r d_table_cell d_xs_block f_none">

                                <div class="col-lg-12 col-md-12 col-sm-12"  id="loginCartWish">

                                    <div id="AjaxCart"  class="f_right clearfix f_xs_none d_xs_inline_b t_xs_align_l m_xs_bottom_15" style="margin-right: -4%;">



                                        <div class="relative m_right_10 f_right dropdown_2_container shoppingcart " >
                                            <button class="icon_wrap_size_2 color_grey_light circle tr_all  animated" aria-label="cart">
                                                <i class="icon-basket color_grey_light_2 tr_inherit"></i>
                                            </button>
                                            <span id="" class="animated notification_budget cart_budget " >
                                                {{initApp.maincart.total_quantity}}
                                            </span>

                                            <div class="dropdown_2 bg_light shadow_1 tr_all p_top_0 dropdownheader2" style="">
                                                <h5 class="fw_light color_dark m_bottom_23" style="   text-align: left;
                                                    padding: 6px 13px;
                                                    margin-bottom: 9px;
                                                    background: #000000;
                                                    color: #fff;
                                                    margin-left: -15px"><i class="icon-basket  tr_inherit"></i> &nbsp; Your Shopping Cart</h5>

                                                <div class="col-md-6" style="padding: 0px">
                                                    <span class="pull-left" ng-if="initApp.customcart.total_quantity" style="color:navy;font-size:10px">Total {{initApp.customcart.total_quantity}} items waiting for checkout</span><br/>
                                                    <a href="<?php echo site_url("Shop/cart") ?>" class="pull-left" ng-if="initApp.customcart.total_quantity">
                                                        <span style="font-size: 13px;border-radius:3px;background-color: #F1F1F1; font-weight: 500;padding: 0px 10px;">
                                                            Proceed to Checkout
                                                        </span>

                                                    </a>
                                                </div>

                                                <span class="pull-left" style="color:navy;font-size:10px"></span><br/>


                                                <div class="col-md-6 pull-right" style="padding: 0px">
                                                    <div ng-if="initApp.maincart.products.length">
                                                        <span ng-if="initApp.maincart.products.length" class="pull-right" style="color:navy;font-size:10px;margin-top: -24px">Recently added item(s)</span><br/>
                                                        <a href="<?php echo site_url('Product/shopAllCart'); ?>" class="pull-right" style="margin-top: -24px" ng-if="initApp.maincart.products.length">
                                                            <span style="font-size: 13px;border-radius:3px;background-color: #F1F1F1; font-weight: 500;padding: 0px 10px;">
                                                                Go for Customization &rarr;
                                                            </span>

                                                        </a>
                                                        <hr style="height: 0px;margin-top: 6px;margin-bottom: 0px;">
                                                    </div>
                                                </div>
                                                <ul class="added_items_list productCartinfo11" style="max-height: 500px;
                                                    overflow-y: auto;
                                                    padding-right: 10px;
                                                    text-align: center;padding-bottom: 13px;"
                                                    ng-if="initApp.maincart.products.length"
                                                    > 
                                                        <?php
                                                        if ($session_data) {
                                                            ?>
                                                        <li class="clearfix lh_large animated flipInX {{cartd.animate}} m_bottom_20 relative" ng-repeat="cartd in initApp.maincart.products" ng-model="cartd.animate" ng-init="cartd.animate = ''">
                                                            <a href="shop_product.php?product_id={{cartd.id}}&item_type={{cartd.tag_id}}" class="d_block f_left m_right_10">
                                                                <img src="{{cartd.item_image}}" alt="Item Image" class="imageData" style="height:66px;width: 66px">
                                                                <div class="f_left  lh_ex_small" style="text-align: left;">
                                                                    <a href="#" class="color_dark fs_medium d_inline_b m_bottom_3 titleData" style="float: left;width:205px">
                                                                        <span style="float: left">{{cartd.title}}</span>

                                                                        <span class="color_grey" style="float: right"><span class="quantityData">{{cartd.quantity}} x {{cartd.price| currency }}</span></span>
                                                                    </a>
                                                                    <p class="fs_small"><span class="skuData"></span></p>
                                                                    <p class="fs_small">Item: <span class="customData" style="color:black">{{cartd.tag_title}}</span></p>
                                                                    <a href="#" class="fs_small" style="font-size: 11px;">{{cartd.product_speciality|limitTo:30}} {{cartd.product_speciality.length>30?'. . .':''}}</a>
                                                                </div>
                                                                <!--<button ng-click="removeCartData(cartd)">X</button>-->
                                                                <i class="icon-cancel-circled color_grey_light_2 fs_large color_dark_hover tr_al " ng-click="removeCartData(cartd)" ></i>
                                                                <!--cartRemoveid="{{cartd.id}}/{{cartd.tag_id}}"-->
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>

                                                <ul class="added_items_list productCartinfo" ng-if="initApp.maincart.products.length == 0" style="max-height: 500px;
                                                    overflow-y: auto;
                                                    width: 100%;
                                                    text-align: center;padding-bottom: 13px;">
                                                    <i class="icon-frown"></i>  YOUR SHOPPING CART IS EMPTY</ul>

                                                <div class="total_price bg_light_2 t_align_r fs_medium m_bottom_15"   ng-if="initApp.maincart.products.length">
                                                    <ul>
                                                        <li class="color_dark" style="font-weight: 400; "> 
                                                            <span class="">Total:</span> 
                                                            <span class=" d_inline_b m_left_15 price t_align_l color_pink ">  {{ initApp.maincart.total_price | currency}}   <small style="    font-size: 11px;
                                                                                                                                                                                    line-height: 21px;">(Quantity:{{initApp.maincart.total_quantity}})</small></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix border_none p_top_0 sc_footer " ng-if="cart_data.length">
                                                    <a href="shopAllCart.php " >
                                                        <span style="font-size: 13px;
                                                              font-weight: 500;
                                                              margin-left: -5px;
                                                              float: right;
                                                              /* text-decoration: overline; */
                                                              /* border: 1px solid #000; */
                                                              padding: 0px 10px;
                                                              border-radius: 6px;
                                                              background-color: #F1F1F1;"> Go for Customization &rarr;</span>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>






                                        <!--login-->
                                        <?php
                                        if ($session_data) {
                                            ?>
                                            <!--login-->
                                            <div class="relative f_right m_right_10 dropdown_2_container login">
                                                <button class="icon_wrap_size_2 color_grey_light circle tr_all" aria-label="userprofile">
                                                    <i class="icon-user color_grey_light_2 tr_inherit"></i>
                                                </button>
                                                <div class="dropdown_2 bg_light shadow_1 tr_all dropdownheader" style=" padding: 0px 15px 0;">
                                                    <div id="popular" class="active" style="display: block;">
                                                        <!--popular-->
                                                        <article class="clearfix m_bottom_12 m_xs_bottom">
                                                            <h5 class="fw_light color_dark m_bottom_23" style="  text-align: left;
                                                                padding: 6px 13px;
                                                                margin-bottom: 9px;
                                                                background: #000000;

                                                                color: #fff;
                                                                margin-left: -15px;">
                                                                <i class="icon-user color_white_light_2 tr_inherit"></i> 
                                                                &nbsp; Welcome
                                                            </h5>

                                                            <ul class="">
                                                                <li class="clearfix lh_large m_bottom_20 relative">

                                                                    <div class="f_right lh_ex_large">
                                                                        <a href="#" class="color_dark fs_medium d_inline_b m_bottom_3" style="text-transform: capitalize;font-size: 20px;">
                                                                            <?php echo $session_data['first_name']; ?>   
                                                                        </a>
                                                                        <p class="color_dark fs_small"><?php echo $session_data['email']; ?></p>
                                                                        <a href="#" class="fs_small color_grey">
                                                                            Last Login <i>2020-01-15 20:26:18</i>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>


                                                            <ul class="dotted_list color_grey_light_2 article_stats">
                                                                <li class="m_right_15 relative" style="  margin-right: 0px;">
                                                                    <div class="row">
                                                                        <!--<div style="width: 205%">-->
                                                                        <div class="col-lg-6">
                                                                            <a name="logout" href="<?php echo site_url('Account/logout'); ?>" type="submit" class="btn btn-default btn-xs pull-left" style="width: 80px;">
                                                                                <i class="icon-logout"></i> Logout
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-lg-6">

                                                                            <a name="profile" href="<?php echo site_url("Account/profile"); ?>" type="submit" class="btn btn-default btn-xs pull-right" style="">
                                                                                <i class="icon-list"></i> View Account
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                    <!--</div>-->
                                                                </li>
                                                            </ul>

                                                        </article>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            ?>

                                            <div class="relative f_right m_right_10 dropdown_2_container login">
                                                <button class="icon_wrap_size_2 color_grey_light circle tr_all" aria-label="login">
                                                    <i class="icon-lock color_grey_light_2 tr_inherit"></i>
                                                </button>
                                                <div class="dropdown_2 bg_light shadow_1 tr_all dropdownheader" style=" padding: 0px 15px 0;">
                                                    <h5 class="fw_light color_dark m_bottom_23" style="  text-align: left;
                                                        padding: 6px 13px;
                                                        margin-bottom: 9px;
                                                        background: #000000;

                                                        color: #fff;
                                                        margin-left: -15px;"><i class="icon-lock  tr_inherit"></i> &nbsp; User Login</h5>
                                                    <form action="<?php echo site_url('Account/userLogin'); ?>" class="login_form m_bottom_20" method="post" action="#">
                                                        <ul>


                                                            <li class="m_bottom_10 relative">
                                                                <i class="icon-user login_icon fs_medium color_grey_light_2"></i>
                                                                <input type="text" name="email" placeholder="Email" class="r_corners color_grey w_full fw_light">
                                                            </li>
                                                            <li class="m_bottom_10 relative">
                                                                <i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                                                                <input type="password" name="password" placeholder="Password" class="r_corners color_grey w_full fw_light">
                                                            </li>
                                                            <!--                                                            <li class="m_bottom_23">
                                                               <input type="checkbox"  checked id="checkbox_1" name="check" class="d_none">
                                                               <label for="checkbox_1" class="d_inline_m fs_medium fw_light">Remember me</label>
                                                               </li>-->
                                                            <li class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                                                    <input type="submit" name="login" class="btn btn-default btn-xs tr_all color_black transparent r_corners"  value="Login" style="    float: left;">
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 t_align_r lh_medium">
                                                                    <a href="#" class="fs_small" style="color: #000000">Forgot your password?</a><br>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </form>
                                                    <div class="bg_light_2 im_half_container sc_footer">
                                                        <p class=" t_align_l fw_light color_dark d_inline_m half_column">New Customer ?</p>
                                                        <div class="half_column t_align_r d_inline_m">
                                                            <a href="<?php echo site_url('Account/registration'); ?>" class="btn btn-xs t_xs_align_c d_inline_b tr_all r_corners color_purple transparent fs_medium">Create an Account</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                            <?php
                                        }
                                        ?>







                                        <div style="display:none" id="WishListTemplate">
                                            <li class="clearfix lh_large m_bottom_20 relative" >
                                                <a href="#" class="d_block f_left m_right_10"><img src="" alt="Wishlist" class="WishList_imageData" style="height:66px;width: 66px"></a>
                                                <div class="f_left WishList_item_description lh_ex_small" style="text-align: left">
                                                    <a href="#" class="color_dark fs_medium d_inline_b m_bottom_3 WishList_titleData">Duis ac turpis</a>
                                                    <p class="color_grey_light fs_small"><span class="WishList_skuData"></span></p>
                                                    <p class="color_grey_light fs_small">Item: <span class="customData" style="color:black"></span></p>

                                                </div>
                                                <div class="f_right fs_small lh_medium d_xs_none">
                                                    <span class="color_grey"><span class="WishList_quantityData">1</span> x </span><span class="color_dark">$<span class="WishList_PriceData">79.00</span></span>
                                                </div>
                                                <i class="icon-cancel-circled-1 color_grey_light_2 fs_large color_dark_hover tr_al removeWishListData"  WishList_Removeid="ids"></i>
                                            </li>
                                        </div>



                                        <div role="search" class="m_right_10 relative type_2 f_left type_3 f_xs_none t_xs_align_l m_xs_bottom_15 hideonmobile" style="">
                                            <input type="text" placeholder="Search" class="r_corners fw_light bg_light w_full" style="    border-radius: 48px;    border: 1px solid #000000;    width: 100%;" id="searchproduct" data-provide="typeahead">
                                            <button class="color_grey_light color_purple_hover tr_all" style="color: #000000" aria-label="search">
                                                <i class="icon-search"></i>
                                            </button>
                                        </div>



                                        <style>
                                            #cartImages{

                                                /*        -webkit-animation-duration: 0.5s;
                                                        -webkit-animation-delay: 0.5s;
                                                */


                                            }
                                        </style>


                                        <div style="position: fixed">
                                            <div class="cartAjax animated"  style="position: relative;display:none">
                                                <img src="<?php echo base_url(); ?>assets/theme/images/ajaxCart.png" style=" height: 125px;
                                                     z-index: 20000;
                                                     position: relative;" alt="Ajax Cart">
                                                <img src="" id="cartImages" class="animated" style="    width: 69px;
                                                     position: absolute;
                                                     margin-left: -83px;
                                                     z-index: 111;
                                                     display: none;
                                                     margin-top: -150px;">

                                            </div>
                                        </div>






                                    </div>




                                </div>



                            </div>

                        </div>

                    </div>
                    <div  role="search" class="m_right_10 relative type_2  type_3 f_xs_none t_xs_align_l m_xs_bottom_15 showonmobile mobileserach" style="">
                        <input type="text" placeholder="Search" class="r_corners fw_light bg_light w_full " style="   width: 100%;border-radius: 0px;" id="searchproduct2" data-provide="typeahead">
                        <button class="color_grey_light color_purple_hover tr_all" style="color: #000000" aria-label="search">
                            <i class="icon-search"></i>
                        </button>
                    </div>
                </section>

                <!--            <hr class="d_xs_none" style="margin-top: 7px;">-->



                <!--side menu-->




                <hr style = "margin-bottom: 0px;margin-top: 5px;">
                <section class="sticky_part bg_light desktopmenu hideonmobile" style="">
                    <div class="container">
                        <!--main navigation-->
                        <button aria-label="menuitems" id="menu_button" class="r_corners tr_all color_blue db_centered m_bottom_20 d_none d_xs_block">
                            <i class="icon-menu"></i>
                        </button>
                        <!--main navigation-->

                        <nav role="navigation" class="  d_inline_m d_xs_none m_xs_right_0 m_right_15 m_sm_right_5 t_align_l m_xs_bottom_15">
                            <ul class="hr_list main_menu type_2 fw_light true">   
                                <?php
                                foreach ($menuArrayMain as $mkey => $mvalue) {
                                    ?>
                                    <li class="container3d relative "  >
                                        <a href="<?php echo $mvalue['link']; ?>" class="menu-link d_block color_dark relative main-menu-link"><?php echo $mvalue['title']; ?></a>
                                        <?php
                                        if (count($mvalue['submenu'])) {
                                            ?>
                                            <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">
                                                <?php
                                                foreach ($mvalue['submenu'] as $mskey => $msvalue) {
                                                    ?>
                                                    <li class="container3d relative ">
                                                        <a href="<?php echo $msvalue['link']; ?>" class="menu-link d_block color_dark relative main-menu-link"> <?php echo $msvalue['title']; ?> </a>
                                                        <?php
                                                        if ($msvalue['submenu']) {
                                                            ?>
                                                            <ul class="sub_menu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">

                                                                <?php
                                                                foreach ($msvalue['submenu'] as $msskey => $mssvalue) {
                                                                    ?>
                                                                    <li class="container3d relative ">
                                                                        <a href="<?php echo $mssvalue['link']; ?>" class="menu-link d_block color_dark relative main-menu-link">  <?php echo $mssvalue['title']; ?>  </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>           
                        </nav>



                        <!--end of main menu-->
                    </div>
                </section>
                <script>
                    $(function () {
                        $(".searchButtonMnl").click(function () {
                            $(this).parents("div").first().animate({"margin-left": "285px"});
                            if ($("form").hasClass("horizontal_animate_finished")) {
                                $(this).parents("div").first().animate({"margin-left": "31px"});
                            }
                            ;
                        })
                    })
                </script>
            </header>

            <script src="<?php echo base_url(); ?>assets/theme/sweetalert2/sweetalert2.min.js"></script>


            <!--wave js-->
            <script src="<?php echo base_url(); ?>assets/theme/wavejs/waves.min.js"></script>
            <link href="<?php echo base_url(); ?>assets/theme/wavejs/waves.min.css" rel="stylesheet"/>

            <!--end of wave js-->
            <!--revolution slider-->
