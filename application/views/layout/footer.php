<!--footer-->

<button type="button" style="display: none" class="btn btn-primary btn-lg Login" data-toggle="modal" data-target="#myLogin">
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
<script src="<?php echo base_url(); ?>assets/theme/plugins/bootstrap.min.js"></script>
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
<script src="<?php echo base_url(); ?>assets/theme/js/jquery-ui-1.10.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/theme.plugins.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/theme.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/toword.js"></script>
<script src="<?php echo base_url(); ?>assets/theme/js/jquery.lazyload.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/theme/sweetalert2-master/dist/sweetalert2.min.js"></script> -->
<!------------End--------------------------------------------------->

<!--<script src="" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/theme/plugins/typeahead/handlebars-v2.0.0.js"></script> 
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

<hr class="divider_type_2" style="margin-bottom:0px;margin-top:0px; ">
<footer role="contentinfo" class="bg_light_3" style="    padding: 0px;">

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 8px 1px 8px 1px;">
        <div class="footerlinks" style="    ">

            <a href="pages_faq.php" class="menu-link  color_dark relative main-menu-link footersociallisnktext">FAQ's</a>  |                             
            <a href="pages_t&amp;c.php" class="menu-link  color_dark relative main-menu-link footersociallisnktext">Terms of Service</a>  |                          
            <a href="pages_policy.php" class="menu-link  color_dark relative main-menu-link footersociallisnktext">Privacy Policy</a>     
            <a href="https://www.youtube.com/channel/UC5inme9JgQVjEBJJj_7VfHA" target="_blank" class="menu-link facebook active icon_wrap_size_1  circle footersociallisnk ">
                <i class="icon-youtube-play fs_small"></i>
            </a>
            <a href="https://www.instagram.com/Nita.fashions" target="_blank" class="menu-link facebook active icon_wrap_size_1  circle  footersociallisnk">
                <i class="icon-instagram fs_small"></i>
            </a>
            <a href="https://twitter.com/nitafashions" target="_blank" class="menu-link twitter icon_wrap_size_1 circle footersociallisnk">
                <i class="icon-twitter fs_small"></i>
            </a>
            <a href="https://www.facebook.com/Nita-Fashions-224017321015214/" target="_blank" class="menu-link facebook active icon_wrap_size_1  circle footersociallisnk">
                <i class="icon-facebook fs_small"></i>
            </a>

        </div>
    </section>
    <section class="footer_bottom_part t_align_c color_grey bg_light_4 fw_light" style="padding: 5px;">
        <p>Copyright © 2020 NitaFashions.com, All rights reserved.</p>
    </section>
</footer>
</div>
</body>
</html>
