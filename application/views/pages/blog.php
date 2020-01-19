<?php
$this->load->view('layout/header');
?>


<!-- Content -->
<div id="content"> 

    <!-- Blog -->
    <section class="new-main blog-posts pad-t-b-60">
        <div class="container"> 
            <div class="heading-block " style="    margin-bottom: 10px;">
                <h3>Our Blog</h3>
                <hr>
            </div>
           
            <!-- News Post -->
            <div class="news-post">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row"> 

                            <!-- POST -->
                            <div class="col-md-6">
                                <article> <img class="img-responsive" src="<?php echo base_url(); ?>assets/theme/images/blogimage1.jpg" alt=""> <span>By Admin</span> <span><?php echo date("d M, Y"); ?></span> <a href="#." class="news-tittle">J Winter Fashion Show 6th Feb 2018 atop Costa neoRomantica cruise</a>
                                    <p>Royal Tailor was invited to collaborate with the iconic J Winter Fashion Show atop Costa neoRomantica cruise ship produced by supermodel Jessica Minh Anh</p>
                                    <a href="#." class="red-more">Read More</a> </article>
                            </div>

                            <!-- POST -->
                            <div class="col-md-6">
                                <article> 
                                    <iframe width="350" height="305" src="https://www.youtube.com/embed/-nTfrtzsup8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                                    <span>By Admin</span> <span><?php echo date("d M, Y"); ?></span> <a href="#." class="news-tittle">How to Suit Up | Men’s Fashion Tips</a>

                                    <p>A well fitted suit is something every man should have in his wardrobe so today I thought I’d share with you my top tips on how to suit up with style.</p>
                                    <a href="#." class="red-more">Read More</a> </article>
                            </div>
                        </div>
                        <div class="row"> 
                            <!-- POST -->
                            <div class="col-md-6">
                                <article> <img class="img-responsive" src="<?php echo base_url(); ?>assets/theme/images/blogimage1.jpg" alt=""> <span>By Admin</span> <span><?php echo date("d M, Y"); ?></span> <a href="#." class="news-tittle">J Winter Fashion Show 6th Feb 2018 atop Costa neoRomantica cruise</a>
                                    <p>Royal Tailor was invited to collaborate with the iconic J Winter Fashion Show atop Costa neoRomantica cruise ship produced by supermodel Jessica Minh Anh</p>
                                    <a href="#." class="red-more">Read More</a> </article>
                            </div>

                            <!-- POST -->
                            <div class="col-md-6">
                                <article> 
                                    <iframe width="350" height="305" src="https://www.youtube.com/embed/-nTfrtzsup8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                                    <span>By Admin</span> <span><?php echo date("d M, Y"); ?></span> <a href="#." class="news-tittle">How to Suit Up | Men’s Fashion Tips</a>

                                    <p>A well fitted suit is something every man should have in his wardrobe so today I thought I’d share with you my top tips on how to suit up with style.</p>
                                    <a href="#." class="red-more">Read More</a> </article>
                            </div>


                        </div>

                        <!-- Pagination -->
                        <ul class="pagination">
                            <li><a class="active" href="#.">1</a></li>
                            <li><a href="#.">2</a></li>
                            <li><a href="#.">3</a></li>
                            <li><a href="#.">..</a></li>
                            <li><a href="#."><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>

                    <!-- Side Bar -->
                    <div class="col-md-3">
                        <div class="side-bar shop-sidbar">


                            <!-- HEADING -->
                            <div class="heading">
                                <h6>Categories</h6>
                                <hr class="dotted">
                            </div>

                            <!-- CATEGORIES -->
                            <ul class="cate">
                                <li><a href="#.">Fashion Tips</a></li>
                                <li><a href="#.">Style Guide</a></li>
                                <li><a href="#.">News & Events</a></li>
                                <li><a href="#.">Offers</a></li>
                                <li><a href="#.">New Fabrics</a></li>
                                <li><a href="#.">Jackets Design</a></li>
                            </ul>

                            <!-- HEADING -->
                            <div class="heading">
                                <h6>Recent Posts</h6>
                                <hr class="dotted">
                            </div>
                            <ul class="papu-post margin-top-20">
                                <li class="media">
                                    <div class="media-left"> <a href="#"> <img class="media-object" src="<?php echo base_url(); ?>assets/theme/images/blogimage1.jpg" alt=""></a> </div>
                                    <div class="media-body"> <a class="media-heading" href="#.">Royal Tailor was invited ..</a><span>By Admin</span> <span>Jul 18, 2015</span> </div>
                                </li>
                                <li class="media">
                                    <div class="media-left"> <a href="#"> <img class="media-object" src="<?php echo base_url(); ?>assets/theme/images/blogimage1.jpg" alt=""></a> </div>
                                    <div class="media-body"> <a class="media-heading" href="#."> Royal Tailor was invited ..</a><span>By Admin</span> <span>Jul 18, 2015</span> </div>
                                </li>
                                <li class="media">
                                    <div class="media-left"> <a href="#"> <img class="media-object" src="<?php echo base_url(); ?>assets/theme/images/blogimage1.jpg" alt=""></a> </div>
                                    <div class="media-body"> <a class="media-heading" href="#.">Royal Tailor was invited ..</a> <span>By Admin</span> <span>11 may, 2018</span> </div>
                                </li>
                            </ul>

                            <!-- HEADING -->
                            <div class="heading">
                                <h6>Archives</h6>
                                <hr class="dotted">
                            </div>

                            <!-- COLORE -->
                            <ul class="cate">
                                <li><a href="#.">October 2018</a></li>
                                <li><a href="#."> May 2018</a></li>
                                <li><a href="#."> February 2018</a></li>
                                <li><a href="#."> October 2018</a></li>
                                <li><a href="#."> January 2018</a></li>
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Content --> 

<?php
$this->load->view('layout/footer');
?>