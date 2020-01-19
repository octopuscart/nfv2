<?php
$this->load->view('layout/header');

function truncate($str, $len) {
    $tail = max(0, $len - 10);
    $trunk = substr($str, 0, $tail);
    $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len - $tail))));
    return $trunk;
}
?>

<section class="page_title translucent_bg_color_dark image_fixed t_align_c relative wrapper" style="margin-top: 0px;padding: 0px;">
    <div class="container">
        <h1 class="color_light fw_light m_bottom_5" style="    font-size: 22px;
            line-height: 25px;">Styling Tips</h1>
        <!--breadcrumbs-->

    </div>
</section>




<div class="section_offset">
    <div class="container">
        <div class="row">
            <section class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_30">
                <!--post-->
                <article class="clearfix m_bottom_45 m_xs_bottom_30 blog_post">
                    <!--date,category,likes-->


                    <!--post content-->
                    <figure >
                        <div class="thumbnail">
                        <img src="<?php echo base_url(); ?>assets/styletips/<?php echo $styleobj->image; ?>" alt="" class="r_corners m_bottom_20"  >
                        </div>
                        <figcaption>
                            <h3 class="fw_light color_dark"><?php echo $styleobj->title; ?></h3>

                            <p class="fw_light m_bottom_12" style="    white-space: pre-line;">
                                <?php echo $styleobj->description; ?>
                            </p>
                            <!--tags-->
                            <i class="icon-tag-1 color_grey_light_2 d_inline_m m_right_5 fs_large tags_icon"></i>
                            <ul class="d_inline_m fw_light">
                                <?php
                                $tags = $styleobj->tag;
                                $tagarray = explode(", ", $tags);
                                foreach ($tagarray as $key => $value) {
                                    ?>
                                    <li class="d_inline_m" style="    list-style: none;
                                        display: inline-block">
                                        <a href="#" class="" style="    list-style: none;
                                           background: #eeeeee;
                                           font-size: 10px;
                                           font-weight: bold;
                                           text-transform: uppercase;
                                           padding: 10px 15px;
                                           display: inline-block;
                                           margin-bottom: 8px;
                                           margin-right: 8px;
                                           float: left;
                                           font-family: 'Raleway', sans-serif;"><?php echo $value; ?></a>
                                    </li>

                                <?php } ?>
                            </ul>
                        </figcaption>

                    </figure>
                </article>
                <div class="blog_side_container w_sm_auto f_left f_xs_none m_xs_bottom_5">



                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=224707228091621&autoLogAppEvents=1"></script>
                    <div class="fb-share-button" data-href="<?php echo site_url('styleTips/' . $styleobj->id . "/" . $styleobj->title); ?>" data-layout="box_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(site_url('styleTips/' . $styleobj->id . "/royaltailor")); ?>;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

                    <!--likes-->

                    <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo urlencode(site_url('styleTips/' . $styleobj->id . "/royaltailor")); ?>" class="btn btn-default " style="    margin-top: -39px;    background: none;
                       color: green;">
                        <i class="fa fa-whatsapp d_inline_m" style="font-size: 30px;"></i>
                    </a>
                    <!-- AddThis Button BEGIN -->
                    <a target="_blank" href="http://twitter.com/intent/tweet?text=<?php echo urlencode(site_url('styleTips/' . $styleobj->id . "/royaltailor")); ?>" class="btn btn-default " style="    margin-top: -39px;  background: none;
                       color: #007eff;">
                        <i class="fa fa-twitter d_inline_m" style="font-size: 30px;  "></i>
                    </a>

                </div>
            </section>
            <aside class="col-lg-3 col-md-3 col-sm-3 side-bar shop-sidbar">


                <!-- HEADING -->
                <div class="heading">
                    <h6>Recent Posts</h6>
                    <hr class="dotted">
                </div>
                <ul class="papu-post margin-top-20">
                    <?php foreach ($stylebook as $key => $value) { ?>

                        <li class="media">
                            <div class="media-left"> 
                                <a href="#"> 
                                    <img class="media-object" src="<?php echo base_url(); ?>assets/styletips/blank.png" alt="" style="background: url(<?php echo base_url(); ?>assets/styletips/<?php echo $value['image']; ?>);background-size:cover;    background-position: center;">

                                </a> 
                            </div>
                            <div class="media-body"> 
                                <a class="media-heading" href="#." style="width: 150px;
                                   white-space: nowrap;
                                   overflow: hidden;
                                   text-overflow: ellipsis;">
                                   <?php echo truncate($value['title'], 100); ?>
                                </a>
                                <p>
                                    <?php echo truncate($value['description'], 40); ?>
                                </p>
                                <?php
                                $tags = $value['tag'];
                                $tagarray = explode(", ", $tags);
                                foreach ($tagarray as $key => $value) {
                                    ?>
                                    <span>
                                        <a href="#" class="fs_small color_grey">
                                            <i><?php echo $value; ?></i>
                                        </a>
                                    </span>
                                    <?php
                                }
                                ?>
                            </div>
                        </li>
                    <?php } ?> 
                </ul>


                <div class="m_bottom_45 m_xs_bottom_30">
                    <h5 class="fw_light color_dark m_bottom_23">Tags</h5>
                    <!--tags list-->
                    <ul class="tags">
                        <?php foreach ($tagsarray as $key => $value) { ?>
                            <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium"><?php echo $key; ?></a></li>
                            <?php } ?> 
                    </ul>
                </div>


                <!--                advertising area
                                <div class="advertising_area t_align_c bg_light_2 color_grey m_bottom_45 m_xs_bottom_30">
                                    <span class="tt_uppercase translucent">Advertisment</span>
                                    <img src="<?php echo base_url(); ?>assets/images/zeganoffer.jpg" >                </div>
                -->

            </aside>
        </div>
    </div>
</div>



<script src="<?php echo base_url(); ?>assets/theme/plugins/isotope.pkgd.min.js"></script>



<?php
$this->load->view('layout/footer');
?>