<?php
$this->load->view('layout/header');
?><script src='https://www.google.com/recaptcha/api.js'></script>
<!--page title-->
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
    <div class="">

        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important">
                <a href="#" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <i class="icon-mail-alt"></i> Newsletter Subscription
                </a>
            </li>

        </ul>
    </div>
</section>
<!--content-->
<section class="section_offset">
    <div class="container clearfix">
        <div class="row">
            <p class="fw_light m_bottom_23">
            </p>
            <div class="col-md-3"></div>
            <div class="col-lg-6 col-md-6 col-sm-12 m_xs_bottom_30">


                <h1 class="color_dark fw_light m_bottom_15 heading_1 t_align_c font-225-em">
                    <?php
                    if ($code == "200") {
                        ?>
                        <i class="fa fa-check-circle fa-2x"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa fa-times-circle fa-2x"></i>
                        <?php
                    }
                    ?>
                    <br/>
                    <?php
                    echo $message;
                    ?>   
                </h1>

                <hr/>
                <h1 class="color_dark fw_light m_bottom_15 heading_1 t_align_c " style="font-size: 18px;">
                    If you have any query please contact us.
                </h1>
                <div class="row">
                    <ul class="col-lg-6 col-md-6 col-sm-12 fw_light w_break m_bottom_45 m_xs_bottom_30">
                        <li class="m_bottom_8">
                            <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                <i class="icon-phone-1"></i>
                            </div>
                            + (852) 2721-9990
                        </li>
                        <li class="m_bottom_8">
                            <div class="d_inline_m icon_wrap_size_1 color_pink circle m_right_10">
                                <i class="icon-mail-alt"></i>
                            </div>
                            <a href="mailto:sales@nitafashions.com" class=" color_pink_hover" style="font-size: 18px;
                               color: rgb(122, 125, 127);">sales@nitafashions.com</a>
                        </li>

                    </ul>
                    <ul class="col-lg-6 col-md-6 col-sm-12 m_xs_bottom_30 vr_list_type_5">
                        <li class="m_bottom_8 fw_light">
                            <div class="f_left icon_wrap_size_1 color_pink circle">
                                <i class="icon-location"></i>
                            </div>
                            16 Mody Road, G/F, T.S.T, Kowloon, Hong Kong
                        </li>

                    </ul>
                </div>
                <h5 class="color_dark m_bottom_20 fw_light">Stay Connected</h5>
                <ul class="hr_list social_icons">
                    <!--tooltip_container class is required-->
                    <li class="m_right_15 m_bottom_15 tooltip_container">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Facebook</span>
                        <a href="https://www.facebook.com/Nita-Fashions-224017321015214/" target="_blank" class="d_block facebook icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-facebook fs_small"></i>
                        </a>
                    </li>
                    <li class="m_right_15 m_bottom_15 tooltip_container">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Twitter</span>
                        <a href="https://twitter.com/nitafashions" target="_blank" class="d_block twitter icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-twitter fs_small"></i>
                        </a>
                    </li>
                    <li class="m_right_15 m_bottom_15 tooltip_container m_xs_right_15">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Instagram </span>
                        <a href="https://www.instagram.com/Nita.fashions" target="_blank" class="d_block googleplus icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-instagram fs_small"></i>
                        </a>
                    </li>

                    <li class="m_right_15 m_bottom_15 tooltip_container">
                        <!--tooltip-->
                        <span class="d_block r_corners color_default tooltip fs_small tr_all">Youtube</span>
                        <a href="https://www.youtube.com/channel/UC5inme9JgQVjEBJJj_7VfHA" target="_blank" class="d_block youtube icon_wrap_size_2 circle color_grey_light_2">
                            <i class="icon-youtube-play fs_small"></i>
                        </a>
                    </li>



                </ul>
            </div>
            <div class="col-md-3"></div>

        </div>
    </div>
</section>
<script>
    setTimeout(function () {
        window.location = "<?php echo site_url("/") ?>";
    }, 3000);
</script>


<?php
$this->load->view('layout/footer');
?>