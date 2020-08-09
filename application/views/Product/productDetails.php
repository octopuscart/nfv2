<?php
$this->load->view('layout/header');
?>





<div class="section_offset counter">
    <div class="container">
        <div class="row">
            <section class="col-lg-10 col-md-9 col-sm-9 m_bottom_70 m_xs_bottom_30">
                <div class="clearfix m_bottom_45 m_xs_bottom_30">
                    <div class="f_left product_view f_sm_none m_sm_bottom_30">
                        <div class="clearfix">
                            <div class="thumbnails_carousel t_align_c f_left m_right_20">
                                <ul id="thumbnails">
                                    <li>
                                        <?php
                                        for ($i = 0; $i < count($product['images']); $i++) {
                                            $img = $product['images'][$i];
                                            $img = $img['image'];
                                            $largeImg = str_replace("small", "large", $img);

                                            $img = str_replace("small", "smaller", $img);
                                            ?>
                                            <a href="#" data-zoom-image="<?php echo $largeImg; ?>" data-image="<?php echo $largeImg; ?>" class="active d_block wrapper r_corners tr_all translucent m_bottom_10"><img src="<?php echo $img; ?>" alt="" class="r_corners" style="    height: 100px;width: 80px;"></a>

                                        <?php } ?>
                                    </li>
                                </ul>
                                <!---->
                                <div class="helper-list"></div>
                            </div>
                            <div class="wrapper r_corners container_zoom_image relative">
                                <img id="img_zoom" src="<?php echo $largeImg; ?>" data-zoom-image="<?php echo $largeImg; ?>" alt="">
                                <div class="labels_container">
<!--                                    <a href="#" class="d_block label color_pink color_pink_hover tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">Sale</span></a>-->
                                </div>
                            </div>
                            <!--                            <a href="#" class="open_product f_right button_type_6 d_block r_corners tr_all t_align_c">
                                                            <i class="icon-resize-full"></i>
                                                        </a>-->
                        </div>
                        <!--share buttons-->

                    </div>
                    <div class="f_right product_info f_sm_none w_sm_full">
                        <div class="clearfix m_bottom_15">
                            <a class="reviews fs_medium f_left color_dark tr_all lh_ex_small" href="#">
                                <h4 style="color:black"><?php echo $product['title']; ?></h4>
                            </a>
                        </div>

                        <hr class="hr_clss">
                        <p class="color_grey fs_medium m_bottom_15">
                            <?php echo $product['short_description']; ?>
                        </p>
                        <hr class="hr_clss">
                        <table class="fw_light table_type_9 m_bottom_15">
                            <tr>
                                <td>Category</td>

                                <td><?php echo $product['category_name']; ?></td>
                            </tr>
                            <tr>

                                <td>
                                    SKU
                                </td>

                                <td class="color_dark">
                                    <?php echo $product['sku']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Feature</td>

                                <td><?php echo $product['product_speciality']; ?></td>
                            </tr>
                            <tr class="color_dark" style="font-weight: initial;font-weight: initial;
                                padding-top: 15px;
                                height: 0px;
                                line-height: 72px;
                                /* font-size: 25px; */
                                font-size: 1.375em;">
                                <td>
                                    Price
                                </td>

                                <td>

                                    <span class="color_dark">
                                        <?php
                                        if ($product['sprice']) {
                                            echo '<span class="cut_price">$' . $productInfo['rprice'] . "</span>$" . $productInfo['sprice'];
                                        } else {
                                            echo '$' . $product['price'];
                                        }
                                        ?> 

                                        <small style="font-weight: 300;margin-left: 10px;font-size:15px"><b>(<?php echo $product['item_name']; ?>)</b></small>
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <hr class="hr_clss">
                        <table class="fw_light table_type_9 m_bottom_20">

                            <tr>
                                <td class="v_align_m">
                                    Color
                                </td>
                                <td class="color_dark">
                                    <ul class="hr_list m_top_10 m_bottom_12">
                                        <?php
                                        //print_r($colors);
                                        for ($i = 0; $i < count($product['productColor']); $i++) {
                                            $value = $product['productColor'][$i];
                                            ?>  
                                            <li class="m_right_10 m_sm_bottom_5">
                                                <button class="color_button tr_delay  bg_color_dark circle radio m_bottom_5" value="<?php echo $value['id']; ?>" style="background:<?php echo $value['color_code']; ?>;margin-top:auto"></button>
                                            </li>
                                        <?php } ?>  
                                    </ul>
                                </td>
                            </tr>

                        </table>
                        <hr class="hr_clss">
                        <a href="#" class="button_type_6 m_mxs_bottom_5 d_inline_b m_right_2 tt_uppercase color_pink r_corners vc_child tr_all add_to_cart_button" cartaddid="<?php echo $product['id']; ?>"  ng-click="addTocart(<?php echo $product['id']; ?>, <?php echo $item_id; ?>)">
                            <span class="d_inline_m clerarfix"><i class="icon-basket f_left m_right_10 fs_large"> </i>
                                <span class="fs_medium">Add to Cart</span>

                            </span>
                        </a>

                    </div>
                </div>


            </section>



            <?php
            if ($product['related']) {
                ?>
                <aside class="col-lg-2 col-md-3 col-sm-3 m_bottom_70 m_xs_bottom_30">
                    <!--bestsellers-->


                    <!--related products-->
                    <div class="m_bottom_50 m_xs_bottom_30">
                        <!--title & nav-->
                        <div class="clearfix m_bottom_25 m_xs_bottom_20">
                            <h5 class="fw_light f_left f_sm_none f_xs_left color_dark m_sm_bottom_5 m_xs_bottom_0">Related Products</h5><br>

                        </div>
                        <div class="owl-carousel t_xs_align_c" data-plugin-options='{"transitionStyle":"backSlide","autoPlay" : true}' data-nav="specials_">
                            <?php
                                            foreach ($product['related'] as $key => $prd) {
                                                
                                            
                                        ?>
                                    <!--product-->
                                    <figure class="fp_item t_align_c d_xs_inline_b">
                                        <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23">
                                            <!--images container-->
                                            <div class="fp_images relative" style="height:200px">
                                                <a href="<?php echo site_url('Product/ProductDetails/'.$prd['id'].'/'.$item_id);?>">
                                                    <img src="<?php echo $prd['images'][0]['image']; ?>" alt="" class="tr_all" style ="height:270px; width: 270px">
                                                    <img src="<?php echo $prd['images'][1]['image']; ?>" alt="" class="tr_all"style ="height:270px; width: 270px">
                                                </a>
                                            </div>
                                            <!--labels-->

                                        </div>
                                        <figcaption>
                                            <h6 class=""><a href="<?php echo site_url('Product/ProductDetails/'.$prd['id'].'/'.$item_id);?>" class="color_dark"><?php echo $prd['title']; ?> </a></h6>
                                            <i><?php echo $prd['product_speciality']; ?></i>                       
                                            <div class="">
                                                <p>
                                                <div class="price_pd im_half_container m_bottom_10 ng-binding">
                                                   
                                                    <?php echo 'US$ ' . $prd['price']; ?> 
                                                </div>


                                                </p>		

                                            </div>
                                            <div class="t_align_c">
                                                <button class="btn btn-default add_to_cart_button"   ng-click="addTocart(<?php echo $prd['id']; ?>, <?php echo $item_id; ?>)"
                                                        style="font-size: 12px;
                                                        height: 26px;
                                                        padding: 0px 6px;
                                                        width: 118px;">
                                                    <span class="d_inline_m clerarfix" style="padding-top: 4px;"><i class="fa fa-shopping-cart"></i><span class="fs_medium">   Add to Cart</span></span>
                                                </button>

                                            </div>
                                        </figcaption>
                                    </figure>
                                    <?php
                                
                            }
                            ?>
                        </div>
                    </div>


                </aside>
                <hr class="hr_clss">
                <?php
            }
            ?>







        </div>

    </div>
</div>

<?php
$this->load->view('layout/footer');
?>