<?php
$this->load->view('layout/header');
?>
<section class="relative w_full m_bottom_15">
    <div class="r_slider">
        <ul>
           
            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/theme/images/web10.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>         </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>    </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>



            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/theme/images/web13.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/theme/images/web21.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="left" data-y="109" data-speed="700" data-start="1500">
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small'>New</p>
                    <h1 class='fw_ex_light color_light slider_title_3 tt_uppercase m_bottom_10 m_sm_bottom_0' style="color: #1FB8C6 !important;">Arrivals</h1>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'>Meticulous hand tailoring, and quality <br>
                        that is becoming harder and harder to find.</p>

                </div>

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/theme/images/web22.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>



            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/theme/images/web12.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/theme/images/slide_04.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>The biggest</h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>Sale</p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>Nita Fashions carry over 11,000 fabrics</b></p>

                </div>

            </li>




            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/theme/images/web23.jpg" alt="" data-bgfit="cover" data-bgposition="center center">
                <div class="caption sfl str" data-x="right" data-y="108" data-speed="700">
                    <h1 class='fw_ex_light color_light tt_uppercase'>        </h1>
                    <p class='slider_title_1 fw_ex_bold color_light tt_uppercase lh_ex_small m_bottom_23 m_sm_bottom_5'>     </p>
                    <p class='color_light m_bottom_25 m_sm_bottom_5'><b>      </b></p>

                </div>

            </li>


        </ul>
    </div>
</section>
<!--content-->
<section class="section_offset" style="padding-bottom: 50px;padding-top: 50px;">
    <div class="container frontpagecontainer" style="margin-top: -50px;">
        <h3 class="fw_light color_dark m_bottom_35 t_align_c appear-animation bounceInLeft appear-animation-visible" data-appear-animation="bounceInLeft" style="font-size: 20px; font-weight: 400;margin-bottom: 18px;">Featured Products 2020</h3>
        <!--
        <h3 class="fw_light color_dark m_bottom_35 t_align_c appear-animation bounceInLeft appear-animation-visible" data-appear-animation="bounceInLeft" style="font-size: 20px; font-weight: 400;margin-bottom: 18px;">Top 10 Sea Island Cotton Shirt Fabrics of 2019</h3>
        -->
        <div class="relative m_bottom_70 m_xs_bottom_30" style="margin-bottom: 50px;">
            <div class="row">
                <div class="owl-carousel t_xs_align_c featured_products" data-nav="fproducts_nav_" data-plugin-options='{"singleItem":false,"itemsCustom":[[992,5],[768,3],[600,2],[10,2]]}'>
                    <?php
                    foreach ($featuredProducts as $key => $value) {
                        ?>   
                        <!--product-->
                        <figure class="fp_item t_align_c d_xs_inline_b col-lg-12 col-md-12 col-sm-12 animated" data-appear-animation="bounceIn" style="   ">
                            <a href="<?php echo site_url('Product/ProductDetails/'.$value['id'].'/'. $value['tag_id'])?>">
                                <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c animated productimagesfrontpage">
                                    <!--images container-->
                                    <div class="fp_images relative">
                                        <img src="<?php echo $value['imagelink'][0]['image'];?>" alt="" class="tr_all" style ="width: 250px"/>
                                        <img src="<?php echo $value['imagelink'][0]['image'];?>" alt="" class="tr_all"style ="width: 250px"/>
                                    </div>
                                    <!--labels-->
                                    <div class="labels_container">
                                        <a href="#" class="d_block label color_scheme hideonmobile tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">New</span></a>
                                    </div>
                                </div>
                            </a>
                            <figcaption>
    <!--                                    <input type="text" name="item_type" value="1" >-->
                                <h4 class="m_bottom_5"><a href="<?php echo site_url('Product/ProductDetails/'.$value['id'].'/'. $value['tag_id'])?>" class="color_dark"><?php echo $value['title'];?></a></h4>
                                <a href="<?php echo site_url('Product/ProductDetails/'.$value['id'].'/'. $value['tag_id'])?>" class="fs_medium color_grey d_inline_b m_bottom_3 textoverflow" title="<?php echo $value['product_speciality'];?>">
                                    <i><?php echo $value['product_speciality'];?></i>
                                </a>
                                <div class="im_half_container m_bottom_10 hideonmobile">
                                    <p class="color_dark  half_column  t_align_c tr_all animate_fctl fp_price with_ie">Shirt - $95</p>	
                                    <div class="half_column d_inline_m t_align_r tr_all animate_fctr with_ie hideonmobile">
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
                                    </div>
                                </div>
                                <div class="clearfix hideonmobile">
                                    <div class=" w_md_full m_md_bottom_10 animate_fctl tr_all f_left f_md_none with_ie">
                                        <button aria-label="add to cart"  class="btn btn-default add_to_cart_button" ng-click="addTocart(<?php echo $value['id'];?>, <?php echo $value['tag_id'];?>)" 
                                                style="font-size: 12px;
                                                height: 26px;
                                                padding: 0px 6px;
                                                width: 118px;">
                                            <span class="d_inline_m clerarfix" style="padding-top: 4px;"><i class="fa fa-shopping-cart"></i><span class="fs_medium">   Add to Cart</span></span>
                                        </button>
                                    </div>
                                    <div class="half_column w_md_full animate_fctr tr_all f_left f_md_none clearfix with_ie ">
                                    </div>
                                </div>
                                <div class="clearfix showonmobile">
                                    <div class="">
                                        <button aria-label="add to cart" class="btn btn-default add_to_cart_button" ng-click="addTocart(<?php echo $value['id'];?>, <?php echo $value['tag_id'];?>)" 
                                                style="font-size: 12px;
                                                height: 26px;
                                                padding: 0px 6px;
                                                width: 118px;">
                                            <span class="d_inline_m clerarfix" style="padding-top: 4px;"><i class="fa fa-shopping-cart"></i><span class="fs_medium">   Add to Cart</span></span>
                                        </button>
                                    </div>
                                    <div class="">

                                    </div>
                                </div>


                            </figcaption>
                        </figure>
                        <?php
                    }
                    ?>
                </div>

            </div>

            <!--carousel nav-->
            <button aria-label="iconleft" class="icon_wrap_size_4 circle color_grey_light tr_all color_blue_hover fproducts_nav_prev d_md_none" data-appear-animation="fadeIn">
                <i class="icon-left-open-big"></i>
            </button>
            <button aria-label="iconright" class="icon_wrap_size_4 circle color_grey_light tr_all color_blue_hover fproducts_nav_next d_md_none" data-appear-animation="fadeIn">
                <i class="icon-right-open-big"></i>
            </button>
        </div>
        <!--banners-->
        <section class="row t_xs_align_c">
            <div class="col-lg-4 col-md-4 col-sm-4 m_bottom_12 m_xs_bottom_30" data-appear-animation="fadeInUp">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="<?php echo base_url(); ?>assets/theme/images/banner_1.jpg" alt=""  width="371" height="141"></a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 m_bottom_12 m_xs_bottom_30" data-appear-animation="fadeInUp" data-appear-animation-delay="200">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="<?php echo base_url(); ?>assets/theme/images/banner_2.jpg" alt=""  width="371" height="141"></a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 m_bottom_12 m_xs_bottom_0" data-appear-animation="fadeInUp" data-appear-animation-delay="400">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block"><img src="<?php echo base_url(); ?>assets/theme/images/banner_4.jpg" alt=""  width="371" height="141"></a>
            </div>
        </section>
    </div>
</section>

<section class="section_offset" style="padding:0px;margin-top: -40px;">
    <div class="container">

        <h3 class="color_dark fw_light m_bottom_15 t_align_c" data-appear-animation="bounceInLeft" style="font-size: 20px; font-weight: 400;">Labels We Carry</h3>
        <!--<p class="m_bottom_35 t_align_c" data-appear-animation="bounceInLeft" data-appear-animation-delay="200" style="margin-bottom: 15px;">Nita Fashions is having Numerous Brands.</p>-->
        <div class="relative" data-appear-animation="bounceInLeft" data-appear-animation-delay="400">
            <div class="t_xs_align_c">
                <div class="owl-carousel clients brands t_align_c" data-plugin-options='{"pagination":true,"transitionStyle" : "backSlide"}' data-nav="c_nav_">
                    <!--item-->
                    <div>
                        <div class="row">

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/images/images/ThomasMasonShort-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/images/images/1_4-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>   
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/images/images/1_5-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/images/images/1_6-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/images/images/1_Holland-Sherry2-170x100.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/images/images/reda.jpg" alt="">
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>
            </div>

        </div>
    </div>
</section>


<?php
$this->load->view('layout/footer');
?>