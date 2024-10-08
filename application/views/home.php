<?php
$this->load->view('layout/header_org');
?>
<section class="relative w_full m_bottom_15">
    <div class="r_slider">
        <ul>

            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/sliders/web10.jpg" alt="Nita Fashions" data-bgfit="cover" data-bgposition="center center">
                

            </li>
            
            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/sliders/v2/old-Gentelmen-2-2020.jpg" alt="Nita Fashions" data-bgfit="cover" data-bgposition="center center">
               

            </li>





            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/sliders/v2/web21.jpg" alt="Nita Fashions" data-bgfit="cover" data-bgposition="center center">
               

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/sliders/web22.jpg" alt="Nita Fashions" data-bgfit="cover" data-bgposition="center center">
               

            </li>



            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/sliders/web12.jpg" alt="Nita Fashions" data-bgfit="cover" data-bgposition="center center">
              

            </li>


            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/sliders/v2/bride-groom1-2020.jpg" alt="Nita Fashions" data-bgfit="cover" data-bgposition="center center">
               

            </li>




            <li data-transition="fade" data-slotamount="10">
                <img src="<?php echo base_url(); ?>assets/sliders/v2/Web12-1-2020.jpg" alt="Nita Fashions" data-bgfit="cover" data-bgposition="center center">
               

            </li>


        </ul>
    </div>
</section>


<!--benifits-->
<section class="section_offset" style='padding:0px;margin-top:10px;'>
    <div class="container t_align_c">
        <h3 class="color_dark fw_light m_bottom_35 heading_1" data-appear-animation="bounceInLeft" style='font-weight: 500;'>About Nita Fashions</h3>


        <article id="tab-1" data-appear-animation="fadeInUp" data-appear-animation-delay="450">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_20">

                    <img src="<?php echo base_url(); ?>assets/images/nitaabout2.jpg" alt="Nita Fashions" style='border-radius: 10px;'>



                </div>
                <div class="col-lg-6 col-md-6 t_align_l aboutsetion" style='    font-size: 18px;'>

                    <p class="m_bottom_5"  >
                        Nita Fashions has been well recognized for its superior fabrics, meticulous hand tailoring, outstanding quality and customer service since 1953.
                    </p>

                    <p class="m_bottom_5" >
                        Its owner and Chief Tailor, Mr. Peter Daswani, recently partnered with his son Anil Daswani giving the business the perfect balance of classic and modern, taking it to its peak. 
                    </p>

                    <p class="m_bottom_5">
                        Nita Fashions’ mission is to equip customers with the knowledge and bespoke wardrobe to attend every event with confidence. They are able to achieve this by working closely with clients and understanding their style and knowing what will flatter their form. 
                    </p>

                    <p class="m_bottom_5" >
                        The roots of Mr. Peter Daswani’s craftsmanship are derived from the pioneer, his father - who began as an apprentice on Saville Row; as a result, his cutting style is both traditional and very British. To contrast, Anil has a very modern Italian style and technique that resembles the current running trends. 
                    </p>

                    <p class="m_bottom_5">
                        His knowledge and understanding stems from being under the guidance of his Father, Mr. Peter Daswani, whilst over the years adding his own twist.   
                    </p>

                </div>
        </article>


    </div>
</section>
<!--end of benifits-->
<hr/>

<!--content-->
<section class="section_offset" style="padding-bottom: 50px;padding-top: 50px;">
    <div class="container frontpagecontainer" style="margin-top: -50px;">
        <h3 class="fw_light color_dark m_bottom_35 t_align_c appear-animation bounceInLeft appear-animation-visible" data-appear-animation="bounceInLeft" style="font-size: 30px; font-weight: 500;margin-bottom: 18px;">Featured Products 2020</h3>
        <!--
        <h3 class="fw_light color_dark m_bottom_35 t_align_c appear-animation bounceInLeft appear-animation-visible" data-appear-animation="bounceInLeft" style="font-size: 20px; font-weight: 400;margin-bottom: 18px;">Top 10 Sea Island Cotton Shirt Fabrics of 2019</h3>
        -->
        <div class="relative m_bottom_70 m_xs_bottom_30" style="margin-bottom: 50px;">
            <div class="row">
                <div class="owl-carousel t_xs_align_c featured_products" data-nav="fproducts_nav_" data-plugin-options='{"singleItem":false,"itemsCustom":[[992,5],[768,3],[600,2],[10,2]]}'>
                    <?php
                    foreach ($featuredProducts as $key => $value) {
                        if ($key < 8) {
                            ?>   
                            <!--product-->
                            <figure class="fp_item t_align_c d_xs_inline_b col-lg-12 col-md-12 col-sm-12 animated" data-appear-animation="bounceIn" style="   ">
                                <a href="<?php echo site_url('Product/ProductDetails/' . $value['id'] . '/' . $value['tag_id']) ?>">
                                    <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c animated productimagesfrontpage">
                                        <!--images container-->
                                        <div class="fp_images relative">
                                            <img data-src="<?php echo $value['imagelink'][0]['image']; ?>" alt="NF <?php echo $value['title']; ?>" class="tr_all lazyload" style="width: 100%;"/>
                                            <img data-src="<?php echo $value['imagelink'][0]['image']; ?>" alt="NF <?php echo $value['title']; ?>" class="tr_all lazyload" style="width: 100%;"/>
                                        </div>
                                        <!--labels-->
                                        <div class="labels_container">
                                            <a href="#" class="d_block label color_scheme hideonmobile tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">New</span></a>
                                        </div>
                                    </div>
                                </a>
                                <figcaption>
        <!--                                    <input type="text" name="item_type" value="1" >-->
                                    <h4 class="m_bottom_5"><a href="<?php echo site_url('Product/ProductDetails/' . $value['id'] . '/' . $value['tag_id']) ?>" class="color_dark"><?php echo $value['title']; ?></a></h4>
                                    <a href="<?php echo site_url('Product/ProductDetails/' . $value['id'] . '/' . $value['tag_id']) ?>" class="fs_medium color_grey d_inline_b m_bottom_3 textoverflow" title="<?php echo $value['product_speciality']; ?>">
                                        <i style="color:black"><?php echo $value['product_speciality']; ?></i>
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
                                            <button aria-label="add to cart"  class="btn btn-default add_to_cart_button" ng-click="addTocart(<?php echo $value['id']; ?>, <?php echo $value['tag_id']; ?>)" 
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
                                            <button aria-label="add to cart" class="btn btn-default add_to_cart_button" ng-click="addTocart(<?php echo $value['id']; ?>, <?php echo $value['tag_id']; ?>)" 
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
                    }
                    ?>
                </div>

            </div>
            <?php
            if (!$checkmobile) {
                ?>
                <!--carousel nav-->
                <button aria-label="iconleft" class="icon_wrap_size_4 circle color_grey_light tr_all color_blue_hover fproducts_nav_prev d_md_none" data-appear-animation="fadeIn">
                    <i class="icon-left-open-big"></i>
                </button>
                <button aria-label="iconright" class="icon_wrap_size_4 circle color_grey_light tr_all color_blue_hover fproducts_nav_next d_md_none" data-appear-animation="fadeIn">
                    <i class="icon-right-open-big"></i>
                </button>
                <?php
            }
            ?>
        </div>
        <hr/>
        <!--banners-->
        <section class="row t_xs_align_c">
            <div class="col-lg-4 col-md-4 col-sm-4 featureblock" data-appear-animation="fadeInUp">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block">
                    <div class='insideblock'>
                        <img src="<?php echo base_url(); ?>assets/images/delivery.svg" alt="Nita Fashions" >
                    </div>
                    <h2>Free & Fast Shipping</h2>
                    <p>On all order over US$ 250</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 featureblock" data-appear-animation="fadeInUp" data-appear-animation-delay="200">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block">
                    <div class='insideblock'>
                        <img src="<?php echo base_url(); ?>assets/images/consulting.svg" alt="Nita Fashions">
                    </div>
                    <h2>Need Assistance</h2>
                    <p>Email us at sales@nitafashions.com</p>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 featureblock" data-appear-animation="fadeInUp" data-appear-animation-delay="400">
                <a href="#" class="d_block d_xs_inline_b d_mxs_block">
                    <div class='insideblock'>
                        <img src="<?php echo base_url(); ?>assets/images/fabric.svg" alt="Nita Fashions">
                    </div>
                    <h2>11,000 Fabrics</h2>
                    <p>Nita Fashions carry top brands</p>
                </a>
            </div>
        </section>
        <hr/>
    </div>
</section>

<section class="section_offset" style="padding:0px;margin-top: -40px;">
    <div class="container">
        <h3 class="color_dark fw_light m_bottom_35 heading_1" data-appear-animation="bounceInLeft" style='font-weight: 500;text-align: center;'>Labels We Carry</h3>

        <!--<p class="m_bottom_35 t_align_c" data-appear-animation="bounceInLeft" data-appear-animation-delay="200" style="margin-bottom: 15px;">Nita Fashions is having Numerous Brands.</p>-->
        <div class="relative" data-appear-animation="bounceInLeft" data-appear-animation-delay="400">
            <div class="t_xs_align_c">
                <div class="owl-carousel clients brands t_align_c" data-plugin-options='{"pagination":true,"transitionStyle" : "backSlide"}' data-nav="c_nav_">
                    <!--item-->
                    <div>
                        <div class="row">

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item brandlogo db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/brand/thomasmason.jpg" alt="Nita Fashions">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item brandlogo db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block  tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/brand/vbc.jpg" alt="Nita Fashions">
                                    </a>
                                </div>
                            </div>   
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item brandlogo db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block  tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/brand/loropiana.jpg" alt="Nita Fashions">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item brandlogo db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block  tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/brand/zegna.jpg" alt="Nita Fashions">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item brandlogo db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block  tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/brand/hollandsherry.jpg" alt="Nita Fashions">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                                <div class="clients_item brandlogo db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                    <a href="#" class="d_block  tr_all wrapper r_corners">
                                        <img src="<?php echo base_url(); ?>assets/theme/brand/reda.jpg" alt="Nita Fashions">
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