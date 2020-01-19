<?php
$this->load->view('layout/header');

function truncate($str, $len) {
    $tail = max(0, $len - 10);
    $trunk = substr($str, 0, $tail);
    $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len - $tail))));
    return $trunk;
}
?>

<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>Our Blog</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url("/"); ?>">Home</a></li>
                <li><a href="<?php echo site_url("stylingTips"); ?>">Our Blog</a></li>

            </ol>
        </div>
    </div>
</section>
<!-- Content -->
<div id="content"> 

    <!-- Blog -->
    <section class="new-main blog-posts pad-t-b-60">
        <div class="container pricing"> 

            <!-- News Post -->
            <div class="news-post" id="container">
                <div class="row"> 
                    <?php
                    foreach ($stylebook as $key => $value) {
                        ?>
                        <!-- POST -->
                        <div class="col-md-4 item-mas " >

                            <article style="padding: 10px;"> <img class="img-responsive" src="<?php echo base_url(); ?>assets/styletips/<?php echo $value['image']; ?>" alt="" > 
                                <!--<span>By Admin</span> <span>10 Nov, 2018</span>--> 
                                <a href="<?php echo site_url("styleTips/" . $value['id'] . "/" . $value['title']) ?>" class="news-tittle padding-top-30" style="    padding-bottom: 0px;
                                   margin-bottom: 0px;">
                                   <?php echo truncate($value['title'], 100); ?>
                                </a>
                                <p style="line-height: 24px;
                                   margin: 10px 0px;;">
                                    <?php echo truncate($value['description'], 200); ?>                                    </p>
                                <a class="" href="<?php echo site_url("styleTips/" . $value['id'] . "/" . $value['title']) ?>" class="red-more"><b>Read More</b></a> 
                            </article>

                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>





<script src="<?php echo base_url(); ?>assets/theme/plugins/isotope.pkgd.min.js"></script>



<?php
$this->load->view('layout/footer');
?>