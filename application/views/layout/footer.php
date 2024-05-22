<!--footer-->
<footer role="contentinfo" class="bg_light_3" style="    padding: 0px;margin-top: -20px;">
    <!--top part-->
    <section class="footer_top_part">

        <hr class="m_bottom_45 divider_type_3 m_xs_bottom_30">
        <div class="container-fluid" style="padding: 0px 30px">
            <div class="row">

                <!--contact info--> 

                <div class="">
                    <div class="col-lg-3 col-md-3 col-sm-12 fw_light m_bottom_30">
                        <a href="<?php echo site_url("/") ?>" class="d_inline_m m_xs_top_20 m_bottom_20" style="width: 100%;
                           text-align: center;">
                            <img src="<?php echo base_url(); ?>assets/theme//images/logo/nf_logo_8.png" class="mainlogo" alt="" style="height: 100px;">
                        </a>
                        <p>Nita Fashions, Hong Kong’s leading bespoke tailor prides itself on providing the ultimate sartorial experience to customers worldwide. </p>
                        <hr/>
                        <ul class="fw_light w_break m_xs_bottom_8 m_bottom_20">
                            <h5 class="color_dark m_bottom_20 fw_light">Contact Us</h5>
                            <li class="m_bottom_8">
                                <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                    <i class="icon-phone-1"></i>
                                </div>
                                <a href="tel:+ (852) 2721-9990" class="color_black color_pink_hover">  + (852) 2721-9990 </a>
                            </li>
                            <li class="m_bottom_8">
                                <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                    <i class="icon-mail-alt"></i>
                                </div>
                                <a href="mailto:sales@nitafashions.com" class="color_black color_pink_hover"> sales@nitafashions.com</a>
                            </li>

                        </ul>

                        <span class="addressspan"></span><br/>
                        <ul class="hr_list social_icons m_bottom_30 m_xs_bottom_30">
                            <!--tooltip_container class is required-->
                            <li class="m_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Facebook</span>
                                <a href="https://www.facebook.com/Nita-Fashions-224017321015214/" class="d_block facebook_static_color icon_wrap_size_4 circle color_light">
                                    <i class="icon-facebook fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Twitter</span>
                                <a href="https://twitter.com/nitafashions" class="d_block twitter_static_color icon_wrap_size_4 circle color_light">
                                    <i class="icon-twitter fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container m_sm_right_0 m_xs_right_15">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Instagram</span>
                                <a href="https://www.instagram.com/Nita.fashions" class="d_block instagram_static_color icon_wrap_size_4 circle color_light">
                                    <i class="icon-instagramm fs_small"></i>
                                </a>
                            </li>
                            <li class="m_right_15 m_bottom_15 tooltip_container">
                                <!--tooltip-->
                                <span class="d_block r_corners color_default tooltip fs_small tr_all">Youtube</span>
                                <a href="https://www.youtube.com/channel/UC5inme9JgQVjEBJJj_7VfHA" class="d_block youtube_static_color icon_wrap_size_4 circle color_light">
                                    <i class="icon-youtube-play fs_small"></i>
                                </a>
                            </li>



                        </ul>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 row m_bottom_50 m_xs_bottom_30">

                        <ul class="col-lg-7 col-md-7 col-sm-12 vr_list_type_5">
                            <h5 class="color_dark m_bottom_20 fw_light"> Our Locations:</h5>
                            <li class="color_dark d_inline_b m_bottom_20">
                                <div class="icon_wrap_size_1 color_pink circle f_left">
                                    <i class="icon-location"></i>
                                </div>
                                <span class="addressspan">Our Retail Store</span><br/>

                                <p class="fw_light " style="    font-size: 14px;"> 
                                    16 Mody Road, G/F, T.S.T,</br>
                                    Kowloon, Hong Kong</p>

                            </li>

                            <li class=" color_dark d_inline_b">
                                <div class="icon_wrap_size_1 color_pink circle f_left">
                                    <i class="icon-location"></i>
                                </div>
                                <span class="addressspan">Our Showroom</span><br/>

                                <p class="fw_light " style="    font-size: 14px;"> 
                                    Summit Building,<br/> 30 Man Yue Street,<br/> 7th Floor, Unit B, <br/> Hung Hom, Kowloon	
                                </p>
                            </li>

                        </ul>
                        <div class="col-lg-5 col-md-5 col-sm-12 m_bottom_50 m_xs_bottom_30">
                            <h5 class="color_dark fw_light m_bottom_20">Information</h5>


                            <ul class="vr_list_type_4 color_dark fw_light w_break">
                                <?php
                                $ourlinks = [
                                    array("title" => "About Us", "link" => site_url("Shop/aboutus"), "submenu" => []),
                                    array("title" => "FAQ's", "link" => site_url("Shop/faqs"), "submenu" => []),
                                    array("title" => "Terms of Service", "link" => site_url("term-of-service"), "submenu" => []),
                                    array("title" => "Privacy Policy", "link" => site_url("privacy-policy"), "submenu" => []),
                                    array("title" => "Schedule", "link" => site_url("Shop/schedule"), "submenu" => []),
                                    array("title" => "Contact Us", "link" => site_url("Shop/contactus"), "submenu" => []),
                                ];
                                foreach ($ourlinks as $key => $value) {
                                    ?>
                                    <li class="m_bottom_12">
                                        <a href="<?php echo $value["link"]; ?>" class="color_dark d_inline_b">
                                            <span class="icon_wrap_size_0 circle color_black d_block tr_inherit f_left">
                                                <i class="icon-angle-right"></i>
                                            </span>
                                            <?php echo $value["title"]; ?>

                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!--social buttons-->


                    <!--subscribe-->
                    <div class="col-lg-4 col-md-4 col-sm-12 m_bottom_50 m_xs_bottom_30">
                        <h5 class="color_dark fw_light m_bottom_20">Newsletter</h5>
                        <p class="fw_light m_bottom_25">Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>



                        <form class="" method="post" action="<?php echo site_url("Shop/newsLetters") ?>">
                            <ul>
                                <div class="row">
                                    <div class="col-md-6">
                                        <li class="m_bottom_10">
                                            <input type="text" name="subscribe_first" placeholder="First Name" class="r_corners bg_light w_full fw_light">
                                        </li>
                                    </div>
                                    <div class="col-md-6">
                                        <li class="m_bottom_10">
                                            <input type="text" name="subscribe_last" placeholder="Surname" class="r_corners bg_light w_full fw_light">
                                        </li>
                                    </div>
                                </div>
                                <li class="m_bottom_10">
                                    <input type="email" name="subscribe_email" placeholder="Your email" class="r_corners bg_light w_full fw_light">
                                </li>
                                <li class="m_bottom_10 row ">
                                    <img src="<?php echo site_url("Api/createCaptha/ns") ?>" id='captchaimg' style="   height: 40px;height: 40px;
                                         border-radius: 9px;" class="col-md-4" /> 
                                    <input name="captcha" id="captcha" type="text" placeholder="Type the text" class="con_pass r_corners bg_light border_none col-md-6"  required/>


                                </li>
                                <li class="m_bottom_10  row">
                                    <small class='details color_dark col-sm-12'>
                                        Can't read the image? click <a href='javascript: refreshCaptcha();' class="color_dark">here</a> to refresh
                                    </small>
                                </li>
                                <li>
                                    <button class="fs_medium button_type_2 color_purple transparent r_corners tr_all" name="subscribe" value="Subscribe" type="submit">Subscribe</button>
                                </li>
                            </ul>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>

    <section class="footer_bottom_part t_align_c color_grey bg_light_4 fw_light" style="padding: 5px;">
        <p style="color:black">Copyright © <?php echo date("Y"); ?> nitafashions.com, All rights reserved.</p>
    </section>
</footer>
<button type="button" aria-label="hiddenbutton" style="display: none" class="btn btn-primary btn-lg Login" data-toggle="modal" data-target="#myLogin">
</button>
<style>
    .modal table tr{
        padding: 8px;
        line-height: 0.42857143 !important;
        vertical-align: top;
        /*border-bottom: 1px solid;*/
    }
</style>


<!--Libs-->
<!------------------------------old footer--------------------------------->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery.iosslider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery.appear.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/afterresize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery.easytabs.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/jackbox/js/jackbox-packed.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/twitter/jquery.tweet.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/flickr.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/theme/plugins/isotope.pkgd.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/theme/plugins/jquery.elevateZoom-3.0.8.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/plugins/flexslider/jquery.flexslider-min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/theme/js/jquery-ui-1.10.4.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/theme.plugins.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/theme.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/toword.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/jquery.lazyload.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/theme/sweetalert2-master/dist/sweetalert2.min.js"></script> -->
<!------------End--------------------------------------------------->

<!--<script src="" type="text/javascript"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/theme/plugins/typeahead/handlebars-v2.0.0.js"></script>--> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/theme/plugins/typeahead/typeahead.bundle.js"></script> 

<div class="modal fade ui-draggable" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLogin">
    <div class="modal-dialog modal-sm" role="document" style="margin-top: 10%">
        <div class="modal-content">
            <div class="modal-header">
                <a href="../views/index.php" class="btn close"><span aria-hidden="true">×</span></a>
                <h4 class="modal-title" id="myModalLabel"><i class="icon-lock  tr_inherit"></i> &nbsp; User Login</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="login_form ng-pristine ng-valid" method="post">
                    <ul>
                        <li class="m_bottom_10 relative">
                            <i class="icon-user login_icon fs_medium color_grey_light_2"></i>
                            <input type="text" name="email" placeholder="Email" class="r_corners color_grey w_full fw_light">
                        </li>
                        <li class="m_bottom_10 relative">
                            <i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                            <input type="password" name="pass" placeholder="Password" class="r_corners color_grey w_full fw_light">
                        </li>
                        <!--                                                            <li class="m_bottom_23">
                                                                                        <input type="checkbox"  checked id="checkbox_1" name="check" class="d_none">
                                                                                        <label for="checkbox_1" class="d_inline_m fs_medium fw_light">Remember me</label>
                                                                                    </li>-->
                        <li class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                <input type="submit" name="login" class="btn btn-default btn-xs tr_all color_black transparent  r_corners" value="Login">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 t_align_r lh_medium">
                                <a href="forgetdetail.php" class="fs_small btn btn-xs t_xs_align_c d_inline_b tr_all r_corners" style="color: #000000">Forgot your password?</a>
                            </div>
                        </li>
                    </ul>
                </form>
                <hr style="margin:1% 0;height: 0.001% !important; ">
                <div class="bg_light_2 im_half_container sc_footer ">

                    <p class=" t_align_l fw_light color_dark d_inline_m half_column">New Customer ?</p>

                    <div class="half_column t_align_r d_inline_m">
                        <a href="../views/registration.php" class="btn btn-xs t_xs_align_c d_inline_b tr_all r_corners color_purple transparent fs_medium">Create an Account</a>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <a href="../views/index.php" class="btn btn-default" data-dismiss="modal">Close</a>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<style type="text/css">




    .tt-dropdown-menu,
    .gist {
        text-align: left;
    }




    /*
     site theme 
     ---------- 
    */

    .typeahead,
    .tt-query,
    .tt-hint {
        width: 100%; 
        height: 100% !important;
        padding: 8px 12px;

        line-height: 26px;
        border: 2px solid #ccc;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        outline: none;
    }

    .typeahead {
        background-color: #fff;
    }

    .typeahead:focus {
        border: 2px solid #0097cf;
    }

    .tt-query {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .tt-hint {
        color: #999
    }
    .twitter-typeahead{
        width:100% !important;
    }


    .tt-dropdown-menu {
        width: 98%; 
        margin-left: 6px;
        padding: 8px 0;
        background-color: #fff  !important;
        border: 1px solid #ccc  !important;
        border: 1px solid rgba(0, 0, 0, 0.2)  !important;

        -webkit-border-bottom-left-radius: 8px;
        -moz-border-bottom-left-radius: 8px;
        border-bottom-left-radius: 8px;

        -webkit-border-bottom-right-radius: 8px;
        -moz-border-bottom-right-radius: 8px;
        border-bottom-right-radius: 8px;



        -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
        -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
        box-shadow: 0 5px 10px rgba(0,0,0,.2);
    }

    .tt-dropdown-menu img{
        height: 33px;
        width: 33px;
        border-radius: 50%;
        border: 2px solid #D8D8D8;
    }

    .tt-suggestion {
        padding: 3px 20px;


        line-height: 24px;
    }

    .tt-suggestion.tt-cursor {
        color: #fff;
        background-color: #0097cf;

    }

    .tt-suggestion p {
        margin: 0;
    }


    .typeaheadgroup{

        margin: 0px;
        padding: 3px 5px;
        float: left;
        width: 100%;
        background: #E0E0E0;
        color: #000000;
        border-bottom: 1px solid #ccc;

    }

    .typeahead,
    .tt-query,
    .tt-hint {
        width: 396px;
        height: 30px;
        padding: 8px 12px;
        font-size: 15px;
        line-height: 30px;
        border: 2px solid #ccc;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
        outline: none;
    }

    .typeahead {
        background-color: #fff;
    }

    .typeahead:focus {
        border: 2px solid #000000;
    }

    .tt-query {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .tt-hint {
        color: #999
    }

    .tt-menu {
        width: 300px;
        margin: 0px 19px;
        text-align: left;
        padding: 8px 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
        -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
        box-shadow: 0 5px 10px rgba(0,0,0,.2);
    }
    .tt-menu{
        right: 200px!important;
        left: auto!important;
    }
    @media only screen and (max-width: 768px) {
        .tt-menu{
            right: auto!important;
            left: auto!important;
        }
    }


    .tt-suggestion {
        padding: 3px 20px;
        font-size: 15px;
        line-height: 24px;
    }

    .tt-suggestion:hover {
        cursor: pointer;
        color: #000;
        background-color: #EAEAEA;
    }

    .tt-suggestion.tt-cursor {
        cursor: pointer;
        color: #000;
        background-color: #EAEAEA;

    }
    .tt-suggestion.tt-cursor:hover {
        color: #fff !important;
    }

    .tt_select_link:hover{
        color: #fff !important;
    }

    .tt-suggestion p {
        margin: 0;
    }

    .gist {
        font-size: 14px;
    }
</style>
<script id="result-template" type="text/x-handlebars-template">


    <div class="col-sm-12">

    <div class="col-sm-12">  
    <span class="search_title col-sm-12" style="padding: 0px;margin-top: -5px;">{{title}}</span>
    <small style="font-size: 10px;margin-top: -9px;float: left;">{{sub_title}}</small>

    </div> 

    </div>

</script>

<script>



    $(document).ready(function () {


        var search = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('item_code'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: urllink + "/SearchSuggestApi/%QUERY%",
                wildcard: '%QUERY%'
            }
        });







        $('.searchproduct2').typeahead(
                {highlight: true},
                {
                    name: 'search',
                    displayKey: 'item_code',
                    limit: 8,
                    source: search.ttAdapter(),
                    templates: {
                        header: '<span class="typeaheadgroup"><i class="icon-search"></i> Searched Result</span>',
                        suggestion: Handlebars.compile($("#result-template").html()),
                    },
                }

        ).bind('typeahead:selected', function (obj, select_data) {
            console.log("sdfsdfsd");
            var tag_id = select_data.tag_id;
            var product_id = select_data.sid;
//            $("input[name=searchtag]").val(checkd);
            window.location = "<?php echo site_url("Product/productList?category=0&item_type="); ?>" + tag_id + "&product_id=" + product_id;

        });




    });


</script> 
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-88337196-1', 'auto');
    ga('send', 'pageview');

</script>


</div>
</body>
</html>
