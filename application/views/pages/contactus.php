<?php

$this->load->view('layout/header');
?>
<style>
    .shop_timing{
        float: left;
        width: 135px;
    }
</style>

<!-- MAP -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="google-map-area">
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyA319S-ZyrzBQNhbYmjGedtOfl8wm6tY0Y&v=3.exp'></script><div style='overflow:hidden;height:338px;width:100%;'>
            <div id='gmap_canvas' style='height:338px;width:100%;'></div><div><small><a href="http://embedgooglemaps.com">									embed google maps							</a></small></div><div><small>

                </small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
        </div><script type='text/javascript'>
            function init_map() {
                //22.2968045,114.1687551  22.2969039,114.1623853
                var myOptions = {zoom: 17, center: new google.maps.LatLng(22.2974065, 114.1715963),
                    mapTypeId: google.maps.MapTypeId.ROADMAP};
                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(22.297284, 114.172686)});


                infowindow = new google.maps.InfoWindow({content: '<strong>HONG KONG WOOLEN TEXTILE CO.</strong><br>Flat D3 11/F, Mirador Mansion,<br/> 54-64B Nathan Rd, Kowloon, Hong Kong'});

                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
                infowindow.open(map, marker);




            }
            google.maps.event.addDomListener(window, 'load', init_map);</script>

    </div>
</div>
<div style="clear: both"></div>
<!-- Content -->
<div id="contactus"> 
    <!-- Contact Us -->
    <section class="lets-talk pad-t-b-30">
        <div class="container"> 
            <!-- Cantact Us -->
            <div class="row">
                <div class="col-md-6 contact-social"> 

                    <!-- Main Heading -->
                    <div class="heading-block margin-bottom-30">
                        <h3 class="text-transform-none letter-space-0">Our Location</h3>
                    </div>
                    <ul class="studio-loc padding-right-100">
                        <div class="widget clearfix">
                            <div>
                                <h5><i class='icon-map-marker'></i> Address:</h5>
                                <address class="nobottommargin">
                                    <div class="text-muted">
                                        <p class="nobottommargin">
                                            Flat D3 11/F, Mirador Mansion,<br/>
                                            54-64B Nathan Rd,<br/>
                                            Kowloon, 
                                            Hong Kong
                                        </p>
                                    </div>
                                </address>
                            </div>
                        </div>
                        <div class="widget clearfix">
                            <div>
                                <h5><i class='icon-phone-sign'></i> Contact:</h5>
                                <address class="nobottommargin">
                                    <abbr title="Phone Number"><strong class="telprefix">MOB:</strong></abbr> +(852) 6388 6067<br>
                                    <abbr title="Phone Number"><strong class="telprefix">TEL:</strong></abbr> +(852) 3619 7454<br>
                                    <abbr title="Phone Number"><strong class="telprefix">FAX:</strong></abbr> +(852) 3619 7453<br>
                                    <abbr title="Email Address"><strong class="telprefix">EMAIL:</strong></abbr> sales@hkwoolentextile.com 
                                </address>
                            </div>
                        </div>  
                    </ul>

                    <!-- Main Heading -->
                    <div class="heading-block margin-bottom-20 margin-top-30">
                        <h3 class="text-transform-none letter-space-0">Follow Us</h3>
                    </div>
                    <div class="social-links">
                        <div class="topmargin-sm clearfix">
                            <a href="#" class="social-icon si-small si-colored si-facebook">
                                <i class="icon-facebook"></i>
                                <i class="icon-facebook"></i>
                            </a>

                            <a href="#" class="social-icon si-small si-colored si-twitter">
                                <i class="icon-twitter"></i>
                                <i class="icon-twitter"></i>
                            </a>

                            <a href="#" class="social-icon si-small si-colored si-instagram">
                                <i class="icon-instagram"></i>
                                <i class="icon-instagram"></i>
                            </a>


                            <a href="#" class="social-icon si-small si-colored si-pinterest">
                                <i class="icon-pinterest"></i>
                                <i class="icon-pinterest"></i>
                            </a>



                            <a href="#" class="social-icon si-small si-colored si-youtube">
                                <i class="icon-youtube"></i>
                                <i class="icon-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-sm-6">
                    <!-- Main Heading -->
                    <div class="heading-block left-align margin-bottom-30">
                        <h3 class="text-transform-none letter-space-0">Conatct Us</h3>
                    </div>

                    <div class="postcontent nobottommargin" style="width: 100%;">



                        <div class="contact-widget">

                            <div class="contact-form-result"></div>

                            <form class="nobottommargin" id="template-contactform" name="template-contactform" action="#" method="post">

                                <div class="form-process"></div>

                                <div class="col_half">
                                    <label for="template-contactform-name">First Name <small>*</small></label>
                                    <input type="text" id="template-contactform-name" name="first_name" value="" class="sm-form-control required" />
                                </div>

                                <div class="col_half col_last">
                                    <label for="template-contactform-email">Last Name <small>*</small></label>
                                    <input type="text" id="template-contactform-email" name="last_name" value="" class="required email sm-form-control" />
                                </div>
                                <div class="clear"></div>
                                <div class="col_half ">
                                    <label for="template-contactform-phone">Contact No.</label>
                                    <input type="tel" id="template-contactform-phone" name="contact" value="" class="sm-form-control" />
                                </div>


                                <div class="col_half col_last">
                                    <label for="template-contactform-phone">Email</label>
                                    <input type="email" id="template-contactform-phone" name="email" value="" required="" class="required sm-form-control" />
                                </div>
                                <div class="clear"></div>
                                <div class="col_full">
                                    <label for="template-contactform-phone">Subject</label>
                                    <input type="text" id="template-contactform-phone" name="subject" value="" class="sm-form-control" />
                                </div>
                                <div class="clear"></div>





                                <div class="clear"></div>

                                <div class="col_full">
                                    <label for="template-contactform-message">Message <small>*</small></label>
                                    <textarea class="required sm-form-control" id="template-contactform-message" required="" name="message" rows="6" cols="30"></textarea>
                                </div>


                                <div class="col_full">
                                    <button class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="sendmessage" value="submit">Send Message</button>
                                </div>

                            </form>
                        </div>

                    </div><!-- .postcontent end -->
                </div>
            </div>
            <div class="goldline2 " style="margin-bottom: 30px;"></div>
        </div>

    </section>
</div>

<?php

$this->load->view('layout/footer');
?>