
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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">        <!--libs css-->
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
        <link href="<?php echo base_url(); ?>assets/theme/css/customstylev3.css" rel="stylesheet"/>


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

    <body class="sticky_menu">
        <!--styleswitcher-->


        <div class="wide_layout " ng-controller="rootController">
            <!--header markup-->
            <header role="banner" class="relative type_2">
                <span class="gradient_line"></span>
                <!--top part-->
                <section class="header_top_part m_xs_bottom_20 backgrounddark">
                    <div class="container">
                        <div class="row">
                            <!--contact info-->
                            <div class="col-lg-6 col-md-6 col-sm-6 t_xs_align_c">
                                 <ul class="hr_list fs_small color_grey_light">
                                    <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                                        <span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-phone-1"></i></span> + (852) 2721-9990
                                    </li>
                                    <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                                        <a href="mailto:#" class="color_grey_light d_inline_b color_black_hover"><span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-mail-alt"></i></span> sales@nitafashions.com</a>
                                    </li>
                                  
                                </ul>
                            </div>
                            <!--social icons-->
                            <div class="col-lg-6 col-md-6 col-sm-6 t_align_r t_xs_align_c">
                                 <ul class="hr_list d_inline_b social_icons">
                                    <li class="m_right_8"><a href="#" class="color_grey_light facebook circle icon_wrap_size_1 d_block"><i class="icon-facebook-1"></i></a></li>
                                    <li class="m_right_8"><a href="#" class="color_grey_light twitter circle icon_wrap_size_1 d_block"><i class="icon-twitter-1"></i></a></li>
                                    <li class="m_right_8"><a href="#" class="color_grey_light instagram circle icon_wrap_size_1 d_block"><i class="icon-instagramm"></i></a></li>
                                    <li class="m_right_8"><a href="#" class="color_grey_light youtube circle icon_wrap_size_1 d_block"><i class="icon-youtube-play"></i></a></li>
                             </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!--header bottom part-->
                <section class="header_bottom_part type_3 bg_light">
                    <div class="container">
                       
                        <!--logo-->
                        <div class="t_align_c">
                            
                            <a href="<?php echo site_url("/") ?>" class="d_inline_m m_xs_top_20 m_xs_bottom_20">
                          
                                <img src="<?php echo base_url(); ?>assets/theme//images/logo/nf_logo_8.png" class="mainlogo" alt="">
                            </a>
                        </div>
                    </div>
                </section>

                <section class="header_bottom_part bg_light">
                    <div class="container">
                        <div class="d_table w_full d_xs_block">
                            <!--logo-->


                            <div class="col-lg-9 col-md-9 col-sm-9 t_align_r d_table_cell d_xs_block f_none">
                                <?php
                                include('mainmenu.php');
                                ?>
                                <!--main navigation-->

                                <nav role="navigation" class="d_inline_m d_xs_none m_xs_right_0 m_right_15 t_align_l m_xs_bottom_15">
                                    <ul class="hr_list main_menu fw_light">
                                        <?php
                                        foreach ($menuArrayMain as $mkey => $mvalue) {
                                            ?>
                                            <li class="current container3d relative f_xs_none m_xs_bottom_5">
                                                <a class="color_dark fs_large relative r_xs_corners" href="<?php echo $mvalue['link']; ?>"><?php echo $mvalue['title']; ?>
                                                    <?php
                                                    if (count($mvalue['submenu'])) {
                                                        ?> <i class="icon-angle-down d_inline_m"></i>
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                                <!--sub menu-->
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
                                        <!--searchform-->
                                    <form role="search" class="bg_light animate_ vc_child t_align_r fw_light tr_all trf_xs_none">
                                        <input type="text" name="search" placeholder="Search" class="r_corners d_inline_m">
                                    </form>
                                
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 t_align_r d_table_cell d_xs_block f_none">
                                <div class="relative clearfix t_align_r">





                                    <!--searchform button-->
                                    <div class="relative d_inline_m search_buttons d_xs_none">
                                        <button class="icon_wrap_size_4 circle color_grey_light_2 tr_all color_purple_hover"><i class="icon-cancel"></i></button>
                                        <button class="icon_wrap_size_4 active circle color_grey_light_2 tr_all color_purple_hover"><i class="icon-search"></i></button>
                                    </div>
                            
                                    <div class="f_right clearfix f_xs_none d_inline_m  t_xs_align_l m_xs_bottom_15 loginandcart">
                                        <div class="relative m_right_10 inlineblockicon dropdown_2_container shoppingcart " >
                                            <button class="icon_wrap_size_4 color_grey_light circle tr_all  animated" aria-label="cart">
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
                                            <div class="relative inlineblockicon m_right_10 dropdown_2_container login">
                                                <button class="icon_wrap_size_4 color_grey_light circle tr_all" aria-label="userprofile">
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
                                                                            Last Login <i><?php echo $session_data["lastlogin"] ?></i>
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

                                            <div class="relative inlineblockicon m_right_10 dropdown_2_container login">
                                                <button class="icon_wrap_size_4 color_grey_light circle tr_all" aria-label="login">
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
                                                                    <a href="<?php echo site_url("Account/resetPassword") ?>" class="fs_small" style="color: #000000">Forgot your password?</a><br>
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


                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </header>
