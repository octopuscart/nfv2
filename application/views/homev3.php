<?php
$this->load->view('layout/header');
?>
<style>
    .iosSlider {


        height: 500px!important;
    }

</style>
<?php
$sliderlist = [
    array("image" => base_url() . "assets/v3/slider/slider1_v2.jpg", "direction"=>"right", "link"=>site_url("Product/productList?category=0&item_type=11")),
    array("image" => base_url() . "assets/v3/slider/slider2_v2.jpg", "direction"=>"center","link"=>site_url("Product/productList?category=0&item_type=11")),
    array("image" => base_url() . "assets/v3/slider/slider3_v2.jpg", "direction"=>"left","link"=>site_url("Product/productList?category=0&item_type=10"))
];
?>

<section class="relative w_full ">
    <div class="r_slider">
        <ul>
            <?php
            foreach ($sliderlist as $key => $value) {
                ?>
                <li data-transition="fade" data-slotamount="10">
                    <img src="<?php echo $value["image"]?>" alt="" data-bgfit="cover" data-bgposition="center center">
                    <div class="caption sfl str" data-x="<?php echo $value["direction"]?>" data-y="170" data-speed="700"><h1 class="color_light fw_light" style="font-weight: 300;    text-shadow: 2px 2px 5px #000;"> New Arrivals</h1></div>
                    <div class="caption sfl stl color_light" data-x="<?php echo $value["direction"]?>" data-y="243" data-speed="700" data-start="1200" style="font-size: 19px;text-align: <?php echo $value["direction"]?>;    text-shadow: 2px 2px 5px #000;">Over 67 years of tailoring expertise, <br/>you can expect nothing short of spectacular from our <br/>head tailors and fashion stylists at Nita Fashions. </div>
                    <div class="caption sfl stl color_light" data-x="<?php echo $value["direction"]?>" data-y="339" data-speed="700" data-start="1400">
                        <a href="<?php echo $value["link"]?>" role="button" class="tt_uppercase button_type_3 transparent color_light r_corners fs_medium d_block tr_all">SHOP NOW</a>
                    </div>
                </li>
                <?php
            }
            ?>

        </ul>
    </div>
</section>




<!--power statement-->
<section class="section_offset bg_light_3 appear-animation fadeInUp appear-animation-visible powerstatement" data-appear-animation="fadeInUp">
    <div class="container t_align_c">
        <h3 class="color_dark fw_light m_bottom_15">Nita Fashions, Hong Kong’s leading bespoke tailor prides itself on providing the ultimate sartorial experience to customers worldwide.</h3>
    </div>
</section>

<!--about block-->
<section class="section_offset" >
    <div class="container t_align_c">
        <article id="tab-1" data-appear-animation="fadeInUp" data-appear-animation-delay="450">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_xs_bottom_20">
                    <img src="<?php echo base_url(); ?>assets/v3/homev3/image3.jpg" alt="Nita Fashions" style='border-radius: 10px;'>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_top_15 t_align_l aboutsetion" style='    font-size: 16px;
                     color: black;'>
                    <h1 class="big_heading"> tailoring expertise</h1>
                    <h3 class="color_dark fw_light m_bottom_50 heading_1" data-appear-animation="bounceInRight" style='font-weight: 500;'>WHY NITA FASHIONS?</h3>

                    <p class="m_bottom_5 fw_light"  >
                        With over 67 years of tailoring expertise, you can expect nothing short of spectacular from our head tailors and fashion stylists at Nita Fashions.                     </p>

                    <p class="m_bottom_30  fw_light" >
                        We take pride in offering meticulously handcrafted garments at affordable prices, based on your business and lifestyle needs. We are renowned for our impeccable service to our customers and bring the luxury and <b>fit of custom and bespoke clothing</b> to key global cities around the world. The DNA of your bespoke garment begins with the fabric. With that in mind, we have a library of over 11,000 fabric choices, ensuring the one you select will feel like a second skin.                    </p>

                    <p class="fw_light">
                        Join us on your bespoke journey.                    </p>



                </div>
        </article>


    </div>
</section>


<!--featur block-->
<div class="section_offset bg_light_3">
    <h1 class="big_heading"> 11,000 fabric choices</h1>
    <h3 class="color_dark fw_light m_bottom_35 heading_1" data-appear-animation="bounceInLeft" style='font-weight: 500;    text-align: center;'>FEATURED PRODUCTS <?php echo date("Y"); ?></h3>

    <div class="container">

        <div class="row">
            <?php
            $featureproductblock = [
                array(
                    "title" => "SHIRTS",
                    "text" => "
                    Our shirt fabrics are made of 100% Egyptian and Sea Island cotton, sourced from sustainable and renown fabric mills. 
<br/><br/>
These luxurious fabrics are  breathable and comfortable to wear all year round. 

                    ",
                    "imagelist" => [
                        base_url() . "assets/v3/homev3/image5a.jpg",
                        base_url() . "assets/v3/homev3/image5.jpg"
                    ],),
                array(
                    "title" => "SUITS",
                    "text" => "
Our suit fabrics are sourced from premier Italian and English mills that adhere to strict sustainability programmes.<br/><br/>
 We carry superior wool or wool blends, including silk, alpaca, cashmere and linen, insuring that we have you covered for every season and occasion.

                    ",
                    "imagelist" => [
                        base_url() . "assets/v3/homev3/image6.jpg",
                    ],),
                array(
                    "title" => "TUXEDOS",
                    "text" => "
Our Tuxedo fabric collection is both unique and vast.
<br/><br/>
Whether the tuxedo is being worn to a special event or on your wedding day, we will have you looking dapper and ready to seize the moment.
                    ",
                    "imagelist" => [
                        base_url() . "assets/v3/homev3/image7.jpg",
                    ],),
            ];
            foreach ($featureproductblock as $key => $value) {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12  m_bottom_30">
                    <!--post-->
                    <article>
                        <!--post content-->
                        <figure >
                            <div class="m_bottom_20 r_corners wrapper simple_slideshow relative">
                                <ul class="slides">
                                    <?php
                                    foreach ($value["imagelist"] as $ik => $img) {
                                        ?>
                                        <li><img src="<?php echo $img; ?>" alt="" style='border-radius: 10px;'></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <figcaption >
                                <h4 class="fw_light fs_middle m_bottom_5"><a href="#" class="color_dark tr_all"><?php echo $value["title"]; ?></a></h4>
                                <div class="featureblockcontent">
                                    <p class="fw_light m_bottom_12"><?php echo $value["text"]; ?></p>
                                </div>
                                <a href="#" class="button_type_3 color_dark  color_scheme_hover r_corners tr_all tt_uppercase fs_medium d_block f_left m_right_10 darkbutton">Shop Now</a>
                            </figcaption>
                        </figure>
                    </article>
                </div>

                <?php
            }
            ?>

        </div>
    </div>
</div>



<!--appointment block-->
<section class="section_offset image_bg_3" >
    <div class="container t_align_c">
        <article id="tab-1" data-appear-animation="fadeInUp" data-appear-animation-delay="450">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m_xs_bottom_20">

                    <img src="<?php echo base_url(); ?>assets/v3/homev3/image8.jpg" alt="Nita Fashions" style='border-radius: 10px;'>
                </div>
                <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12 t_align_l aboutsetion" style='    font-size: 16px;
                     color: black;'>
                    <h3 class="color_light fw_light m_bottom_20 heading_1" data-appear-animation="bounceInLeft" style='    font-weight: 500;
                        text-transform: uppercase;
                        line-height: 40px;'>
                        Book Your Virtual Appointment<br/>
                        <small style="font-size: 16px;">
                            (via Zoom Video Call)
                        </small>
                    </h3>

                    <form class="create_account_form" method="post" action="#">
                        <ul>


                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="first_name" placeholder="First Name" class="r_corners bg_light w_full border_none" required>
                            </li>

                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="last_name" placeholder="Last Name /Surname" class="r_corners bg_light w_full border_none" required>
                            </li>

                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                              <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="email" name="first_name" placeholder="Email" class="r_corners bg_light w_full border_none" required>
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                                                               <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="date" name="middle_name" placeholder="Select Date" class="r_corners bg_light w_full border_none" >
                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative" style="margin-bottom: 10px;">
                                <select name="profession_id" id="profession_select"  onchange="professionChange()" class="r_corners bg_light w_full border_none" style="width: 100%;height: 40px;padding: 5px;" required >
                                    <option value="" >Select Time</option>
                                    <?php
                                    $timiinglist = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];
                                    foreach ($timiinglist as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value . ":00" ?>"><?php echo $value . ":00" ?></option>
                                        <option value="<?php echo $value . ":30" ?>"><?php echo $value . ":30" ?></option>
                                    <?php } ?>
                                    <option value="0" >Other</option>
                                </select>
                            </li>

                            <li class="m_bottom_20 m_xs_bottom_15 relative" style="margin-bottom: 10px;">
                                <select name="profession_id" id="profession_select"  onchange="professionChange()" class="r_corners bg_light w_full border_none" style="width: 100%;height: 40px;padding: 5px;" required >
                                    <option value="" >Select Timezone</option>
                                    <?php
                                    $timezones = array(
                                        'Pacific/Midway' => "(GMT-11:00) Midway Island",
                                        'US/Samoa' => "(GMT-11:00) Samoa",
                                        'US/Hawaii' => "(GMT-10:00) Hawaii",
                                        'US/Alaska' => "(GMT-09:00) Alaska",
                                        'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
                                        'America/Tijuana' => "(GMT-08:00) Tijuana",
                                        'US/Arizona' => "(GMT-07:00) Arizona",
                                        'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
                                        'America/Chihuahua' => "(GMT-07:00) Chihuahua",
                                        'America/Mazatlan' => "(GMT-07:00) Mazatlan",
                                        'America/Mexico_City' => "(GMT-06:00) Mexico City",
                                        'America/Monterrey' => "(GMT-06:00) Monterrey",
                                        'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
                                        'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
                                        'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
                                        'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
                                        'America/Bogota' => "(GMT-05:00) Bogota",
                                        'America/Lima' => "(GMT-05:00) Lima",
                                        'America/Caracas' => "(GMT-04:30) Caracas",
                                        'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
                                        'America/La_Paz' => "(GMT-04:00) La Paz",
                                        'America/Santiago' => "(GMT-04:00) Santiago",
                                        'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
                                        'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
                                        'Greenland' => "(GMT-03:00) Greenland",
                                        'Atlantic/Stanley' => "(GMT-02:00) Stanley",
                                        'Atlantic/Azores' => "(GMT-01:00) Azores",
                                        'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
                                        'Africa/Casablanca' => "(GMT) Casablanca",
                                        'Europe/Dublin' => "(GMT) Dublin",
                                        'Europe/Lisbon' => "(GMT) Lisbon",
                                        'Europe/London' => "(GMT) London",
                                        'Africa/Monrovia' => "(GMT) Monrovia",
                                        'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
                                        'Europe/Belgrade' => "(GMT+01:00) Belgrade",
                                        'Europe/Berlin' => "(GMT+01:00) Berlin",
                                        'Europe/Bratislava' => "(GMT+01:00) Bratislava",
                                        'Europe/Brussels' => "(GMT+01:00) Brussels",
                                        'Europe/Budapest' => "(GMT+01:00) Budapest",
                                        'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
                                        'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
                                        'Europe/Madrid' => "(GMT+01:00) Madrid",
                                        'Europe/Paris' => "(GMT+01:00) Paris",
                                        'Europe/Prague' => "(GMT+01:00) Prague",
                                        'Europe/Rome' => "(GMT+01:00) Rome",
                                        'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
                                        'Europe/Skopje' => "(GMT+01:00) Skopje",
                                        'Europe/Stockholm' => "(GMT+01:00) Stockholm",
                                        'Europe/Vienna' => "(GMT+01:00) Vienna",
                                        'Europe/Warsaw' => "(GMT+01:00) Warsaw",
                                        'Europe/Zagreb' => "(GMT+01:00) Zagreb",
                                        'Europe/Athens' => "(GMT+02:00) Athens",
                                        'Europe/Bucharest' => "(GMT+02:00) Bucharest",
                                        'Africa/Cairo' => "(GMT+02:00) Cairo",
                                        'Africa/Harare' => "(GMT+02:00) Harare",
                                        'Europe/Helsinki' => "(GMT+02:00) Helsinki",
                                        'Europe/Istanbul' => "(GMT+02:00) Istanbul",
                                        'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
                                        'Europe/Kiev' => "(GMT+02:00) Kyiv",
                                        'Europe/Minsk' => "(GMT+02:00) Minsk",
                                        'Europe/Riga' => "(GMT+02:00) Riga",
                                        'Europe/Sofia' => "(GMT+02:00) Sofia",
                                        'Europe/Tallinn' => "(GMT+02:00) Tallinn",
                                        'Europe/Vilnius' => "(GMT+02:00) Vilnius",
                                        'Asia/Baghdad' => "(GMT+03:00) Baghdad",
                                        'Asia/Kuwait' => "(GMT+03:00) Kuwait",
                                        'Africa/Nairobi' => "(GMT+03:00) Nairobi",
                                        'Asia/Riyadh' => "(GMT+03:00) Riyadh",
                                        'Europe/Moscow' => "(GMT+03:00) Moscow",
                                        'Asia/Tehran' => "(GMT+03:30) Tehran",
                                        'Asia/Baku' => "(GMT+04:00) Baku",
                                        'Europe/Volgograd' => "(GMT+04:00) Volgograd",
                                        'Asia/Muscat' => "(GMT+04:00) Muscat",
                                        'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
                                        'Asia/Yerevan' => "(GMT+04:00) Yerevan",
                                        'Asia/Kabul' => "(GMT+04:30) Kabul",
                                        'Asia/Karachi' => "(GMT+05:00) Karachi",
                                        'Asia/Tashkent' => "(GMT+05:00) Tashkent",
                                        'Asia/Kolkata' => "(GMT+05:30) Kolkata",
                                        'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
                                        'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
                                        'Asia/Almaty' => "(GMT+06:00) Almaty",
                                        'Asia/Dhaka' => "(GMT+06:00) Dhaka",
                                        'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
                                        'Asia/Bangkok' => "(GMT+07:00) Bangkok",
                                        'Asia/Jakarta' => "(GMT+07:00) Jakarta",
                                        'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
                                        'Asia/Chongqing' => "(GMT+08:00) Chongqing",
                                        'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
                                        'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
                                        'Australia/Perth' => "(GMT+08:00) Perth",
                                        'Asia/Singapore' => "(GMT+08:00) Singapore",
                                        'Asia/Taipei' => "(GMT+08:00) Taipei",
                                        'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
                                        'Asia/Urumqi' => "(GMT+08:00) Urumqi",
                                        'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
                                        'Asia/Seoul' => "(GMT+09:00) Seoul",
                                        'Asia/Tokyo' => "(GMT+09:00) Tokyo",
                                        'Australia/Adelaide' => "(GMT+09:30) Adelaide",
                                        'Australia/Darwin' => "(GMT+09:30) Darwin",
                                        'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
                                        'Australia/Brisbane' => "(GMT+10:00) Brisbane",
                                        'Australia/Canberra' => "(GMT+10:00) Canberra",
                                        'Pacific/Guam' => "(GMT+10:00) Guam",
                                        'Australia/Hobart' => "(GMT+10:00) Hobart",
                                        'Australia/Melbourne' => "(GMT+10:00) Melbourne",
                                        'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
                                        'Australia/Sydney' => "(GMT+10:00) Sydney",
                                        'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
                                        'Asia/Magadan' => "(GMT+12:00) Magadan",
                                        'Pacific/Auckland' => "(GMT+12:00) Auckland",
                                        'Pacific/Fiji' => "(GMT+12:00) Fiji",
                                    );
                                    foreach ($timezones as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php } ?>

                                </select>
                            </li>






                            <li class="m_bottom_20 m_xs_bottom_15 relative" style="margin-bottom: 10px;">
                                <select name="country" id="country"  onchange="countryChange()" class="r_corners bg_light w_full border_none" style="width: 100%;height: 40px;padding: 5px;" required >
                                    <option value="" >Select Country</option>
                                    <?php foreach ($country_list as $key => $value) { ?>
                                        <option value="<?php echo $value['country_name']; ?>" ><?php echo $value['country_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </li>








                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-mail-alt login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="email" name="email" placeholder="How did you connect with us?" class="r_corners bg_light w_full border_none" required>
                            </li>

                            <li class="m_bottom_20 m_xs_bottom_15 relative">
                                <img src="<?php echo site_url("Api/createCaptha") ?>" id='captchaimg' style="width: 30%;    height: fit-content;" /> 
                                <input name="captcha" id="captcha" type="text" placeholder="Type the text" class="con_pass r_corners bg_light border_none" style="width: 65%" required>
                                <small class='details color_light'>Can't read the image? click <a href='javascript: refreshCaptcha();' class="color_light">here</a> to refresh</small>

                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative" id="captcha_hide" style="display: none;color: red">
                                Captcha Not Match 
                            </li>

                            <li class="t_align_">
                                <button name="registration" type="submit" class="registration button_type_3 d_inline_b color_black r_corners tr_all fw_light">Book Appointment</button>
                            </li>
                        </ul>
                    </form>



                </div>
        </article>


    </div>
</section>


<!--out haritage-->
<section class="section_offset" >
    <div class="container t_align_c">


        <article id="tab-1" data-appear-animation="fadeInUp" data-appear-animation-delay="450">
            <div class="row">
                <div class="col-lg-6 col-md-6   col-sm-12 col-xs-12 m_bottom_20">

                    <img src="<?php echo base_url(); ?>assets/v3/homev3/image10.jpg" alt="Nita Fashions" style='border-radius: 10px;'>



                </div>
                <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12 t_align_l aboutsetion" style='    font-size: 16px;
                     color: black;'>
                    <h1 class="big_heading"> Since 1953</h1>
                    <h3 class="color_dark fw_light m_bottom_35 heading_1" data-appear-animation="bounceInLeft" style='font-weight: 500;'> OUR HERITAGE</h3>

                    <p class="m_bottom_10 fw_light"  >
                        Between 1950 - 1960, Hong Kong was being restructured from an entrepot to an industrial city. The British colony was particularly enchanted with British Fashion, which seemed like an opportune time for Mr. Murli Daswani to migrate there, after working as an apprentice pattern maker on Savile Row. In 1953, he established a small tailoring operation ‘Nita Fashions,’ who targeted local professionals. 
                    </p>
                    <p class="m_bottom_10 fw_light" >
                        Nita Fashions became a generational business in 1975, when Mr. Peter Daswani joined.  Peter’s pattern making style derives from his early exposure to British fashion, which features roped shoulders and a structured silhouette. Soon after, he decided to take his family operation global and criss crossed the world to serve his loyal clients that he had met at his atelier in Tsim Sha Tsui. As time went by, word of Nita Fashions started to circulate and Peter started to be the tailor for several high profile celebrities and entrepreneurs. 
                    </p>
                    <p class="m_bottom_10 fw_light">
                        Enamoured with the world of <b>bespoke tailoring</b> and excited to take the brand digital, Mr. Anil Daswani decided to join his father, Peter. In 2008, Anil’s paper pattern making style matched the emerging Italian sartorial fashion which leans towards a natural form and modern cut.      
                    </p>

                    <p class="m_bottom_10 fw_light">
                        Together, Mr. Peter Daswani and Mr. Anil Daswani strike a great balance between traditional and <b>contemporary tailoring</b>. Nita Fashions is renowned worldwide for their exceptionally <b>tailored suits, shirts, tuxedos and coats</b> that you will love to wear for a lifetime.                    </p>

                </div>
        </article>


    </div>
</section>



<!--Our Bespoke Products & Services -->
<section class="section_offset bg_light_3" >
    <div class="container t_align_c">


        <article id="tab-1" data-appear-animation="fadeInUp" data-appear-animation-delay="450">
            <div class="row">
                <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12 t_align_l aboutsetion " style='    font-size: 16px;
                     color: black;'>
                    <h1 class="big_heading rotatetext"> contemporary tailoring</h1>
                    <h3 class=" fw_light color_dark m_bottom_35 heading_1" data-appear-animation="bounceInLeft" style='font-weight: 500;text-transform: uppercase; line-height: 40px;'>
                        Our Bespoke<br/> Products & Services 
                    </h3>

                    <p class="m_bottom_10 fw_light "  >
                        Between 1950 - 1960, Hong Kong was being restructured from an entrepot to an industrial city. The British colony was particularly enchanted with British Fashion, which seemed like an opportune time for Mr. Murli Daswani to migrate there, after working as an apprentice pattern maker on Savile Row. In 1953, he established a small tailoring operation ‘Nita Fashions,’ who targeted local professionals. 
                    </p>
                    <p class="m_bottom_10 fw_light " >
                        Nita Fashions became a generational business in 1975, when Mr. Peter Daswani joined.  Peter’s pattern making style derives from his early exposure to British fashion, which features roped shoulders and a structured silhouette. Soon after, he decided to take his family operation global and criss crossed the world to serve his loyal clients that he had met at his atelier in Tsim Sha Tsui. As time went by, word of Nita Fashions started to circulate and Peter started to be the tailor for several high profile celebrities and entrepreneurs. 
                    </p>
                    <p class="m_bottom_10  fw_light">
                        Enamoured with the world of <b>bespoke tailoring</b> and excited to take the brand digital, Mr. Anil Daswani decided to join his father, Peter. In 2008, Anil’s paper pattern making style matched the emerging Italian sartorial fashion which leans towards a natural form and modern cut.      
                    </p>

                    <p class="m_bottom_10  fw_light">
                        Together, Mr. Peter Daswani and Mr. Anil Daswani strike a great balance between traditional and <b>contemporary tailoring</b>. Nita Fashions is renowned worldwide for their exceptionally <b>tailored suits, shirts, tuxedos and coats</b> that you will love to wear for a lifetime.                    </p>

                </div>
                <div class="col-lg-6 col-md-6  col-sm-12 col-xs-12 m_bottom_20">

                    <img src="<?php echo base_url(); ?>assets/v3/homev3/image12.jpg" alt="Nita Fashions" style='border-radius: 10px;'>



                </div>

            </div>
        </article>


    </div>
</section>

<!--Your Bespoke Tailoring Journey-->
<section class="section_offset" >
    <div class="container t_align_c">


        <article id="tab-1" data-appear-animation="fadeInUp" data-appear-animation-delay="450">
            <div class="row">

                <!--accordion-->
                <div class="col-lg-12 col-md-12 col-sm-12 m_bottom_40 m_xs_bottom_30">
                    <h1 class="big_heading ">CUSTOM MADE</h1>
                    <h3 class=" fw_light color_dark m_bottom_55 heading_1" data-appear-animation="bounceInRight" style='font-weight: 500;text-transform: uppercase; line-height: 40px;'>
                        Your Bespoke Tailoring Journey 
                    </h3>



                    <div class="col-md-12">
                        <?php
                        $bespokejourny = [
                            array(
                                "title" => "Style Consultation & Measurements",
                                "image" => base_url() . "assets/v3/homev3/image14b.jpg",
                                "text" => [
                                    "Your initial consultation with us is intimate. We spend a lot of time getting to know your sartorial desires and then hone in to harmonize a look that will best suit (pun intended) your personality and build. ",
                                    "With the choice of over <b>11,000 fabrics</b> to choose from, we can understand how it may feel overwhelming. Our expert stylists and cutters will carefully guide you through our vast selection to discover fabrics that best suit you and its purpose.",
                                    "We then take <b>32 precise measurements and figuration details</b> and commision the your bespoke garment just for you."
                                ],
                            ),
                            array(
                                "title" => "Constructing your garment ",
                                "image" => base_url() . "assets/v3/homev3/image16.jpg",
                                "text" => [
                                    "Our head cutters take these detailed measurements and notations and use them to formulate a unique paper pattern using the ‘rock of eye’ method.",
                                    "Once complete, we craft the <b>basted fitting</b> for you on your fabric of choice, <b>sewing it loosely</b> together to give you the first impressions of your bespoke garment. "
                                ],
                            ),
                            array(
                                "title" => "Baste Fitting ",
                                "image" => base_url() . "assets/v3/homev3/image18.jpg",
                                "text" => [
                                    "There are no shortcuts to the bespoke process.",
                                    "During this step, you will try on a <b>temporary version of your bespoke garment</b> (the basted fitting), that we will chalk & pin, guiding us on what needs to be modified for the final product. ",
                                    "Every detail of your garment is inspected here to ensure that it will feel like a <b>second skin.</b> "
                                ],
                            ),
                            array(
                                "title" => "Final Proof ",
                                "image" => base_url() . "assets/v3/homev3/image20.jpg",
                                "text" => [
                                    "Wearing something that has been carefully assembled for you gives you that boost of confidence and power.",
                                    "During this final step, you proof each aspect of the garment to ensure that it is ready for you to enjoy at every special ocassion or important board meetings that populate your calendar. "
                                ],
                            ),
                        ];
                        foreach ($bespokejourny as $key => $steps) {
                            ?>





                            <?php if ($key % 2 == 1) { ?>
                                <div class="stepoddborder">
                                    <div class="fw_light  color_dark row  ">

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12  m_bottom_20">
                                            <img src="<?php echo $steps["image"]; ?>" alt="Nita Fashions" style='border-radius: 10px;'>
                                        </div>
                                        <div class="col-lg-8  col-md-4 col-sm-12 col-xs-12  m_xs_bottom_20 t_align_l aboutsetion" style='    font-size: 16px;
                                             color: black;'>
                                            <h4 class="stepheadingcustome r_corners wrapper m_bottom_23 bg_light_3  color_dark" style="text-transform: uppercase;font-size: 17px;">  <?php echo $steps["title"]; ?></h4>
                                            <table class="steptable">
                                                <tr>
                                                    <td style="vertical-align: middle"  >
                                                        <?php
                                                        foreach ($steps["text"] as $key1 => $value1) {
                                                            ?>
                                                            <p class="m_bottom_20 fw_light"  >
                                                                <?php
                                                                echo $value1;
                                                                ?>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="hideonmobile">
                                                        <h2 class="stepheadingcustome-counter"><?php
                                                            echo $key + 1;
                                                            ?></h2>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="stepevenborder">
                                    <div class="fw_light color_dark row  ">
                                        <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12  m_xs_bottom_50 t_align_l aboutsetion" style='    font-size: 16px;
                                             color: black;'>
                                            <h4 class="stepheadingcustome r_corners wrapper m_bottom_23 bg_light_3 color_dark"  style="text-transform: uppercase;font-size: 17px;">  <?php echo $steps["title"]; ?></h4>
                                            <table class="steptable">
                                                <tr>
                                                    <td class="hideonmobile">
                                                        <h2 class="stepheadingcustome-counter">
                                                            <?php
                                                            echo $key + 1;
                                                            ?>
                                                        </h2>
                                                    </td>
                                                    <td style="vertical-align: middle">
                                                        <?php
                                                        foreach ($steps["text"] as $key1 => $value1) {
                                                            ?>
                                                            <p class="m_bottom_20 fw_light"  >
                                                                <?php
                                                                echo $value1;
                                                                ?>
                                                            </p>
                                                            <?php
                                                        }
                                                        ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12  m_bottom_20">
                                            <img src="<?php echo $steps["image"]; ?>" alt="Nita Fashions" style='border-radius: 10px;'>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>


            </div>
        </article>



</section>


<section class="section_offset bg_light_3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-9 col-sm-8 col-lg-offset-1 appear-animation fadeInUp appear-animation-visible" data-appear-animation="fadeInUp">
                <h3 class="color_dark fw_light m_bottom_15">What is Bespoke Tailoring?</h3>
                <p class="heading_4">The concept of Bespoke Tailoring originated on Savile Row, London in the early 18th century, where royalty and aristocrats became increasingly obsessed by how clothing portrayed their wealth and status. </p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 appear-animation fadeInUp appear-animation-visible" data-appear-animation="fadeInUp" data-appear-animation-delay="150" style="animation-delay: 150ms;">
                <a href="#" id="get_started" class="button_type_4 r_corners d_inline_b color_dark tt_uppercase fs_large m_top_5 m_sm_top_25 tr_all">Read More</a>
            </div>
        </div>
    </div>
</section>

<!--testimonial section--> 
<section class="section_offset image_bg_4">
    <div class="container">
        <div class="row">
            <section class="col-lg-6 col-md-6 m_bottom_20" data-appear-animation="fadeInUp"></section>
            <!--testimonials-->
            <section class="col-lg-6 col-md-6 m_bottom_20" data-appear-animation="fadeInUp">
                <h3 class="color_light t_align_c m_bottom_15 fw_light">Testimonials</h3>
                <div class="owl-carousel" data-nav="t_nav_" data-plugin-options='{"autoPlay":false,"autoHeight":true,"transitionStyle": "backSlide"}'>
                    <?php
                    $testimonial = [
                        array(
                            "image" => "",
                            "name" => "Ben Rose ",
                            "source" => "Google Review",
                            "review" => "
                            I can’t recommend Anil and his team enough. Very professional from the initial fitting and his knowledge and advice on fabrics and fit makes the experience very easy. <br/>
                            The finishing product from one fitting was great, I had changed my mind on a couple of items of the suit and the team made the alterations without any fuss at all. Thanks Again!
                           "),
                    ];
                    foreach ($testimonial as $key => $value) {
                        ?>

                        <!--item-->
                        <div>
                            <!--quote-->
                            <blockquote class="r_corners relative type_2 fs_large color_dark m_bottom_20">
                                <p class="m_bottom_15">
                                    <i style="word-break: break-word;"><?php echo $value["review"]; ?> </i>
                                </p>
                            </blockquote>
                            <div class="d_table w_full">
                                <div class="d_table_cell">
                                    <!--author photo-->
                                    <div class="d_inline_m circle wrapper m_right_10">
                                        <img src="<?php echo base_url() . "assets/theme/" ?>images/testimonial_img_1.jpg" alt="">
                                    </div>
                                    <!--author name-->
                                    <div class="d_inline_m">
                                        <b class="fs_large d_block color_light"><?php echo $value["name"]; ?></b>
                                        <p class="fs_medium color_light"><?php echo $value["source"]; ?></p>
                                    </div>
                                </div>
                                <div class="d_table_cell t_align_r v_align_m d_mxs_none">
                                    <button class="circle icon_wrap_size_5 color_grey_light d_inline_m color_blue_hover m_right_5 tr_all t_nav_prev">
                                        <i class="icon-left-open-big"></i>
                                    </button>
                                    <button class="circle icon_wrap_size_5 color_grey_light d_inline_m color_blue_hover tr_all t_nav_next">
                                        <i class="icon-right-open-big"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>

        </div>
    </div>
</section>


<?php
$this->load->view('layout/footer');
?>