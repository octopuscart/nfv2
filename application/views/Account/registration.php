<?php
$this->load->view('layout/header');
?> 
<section class="image_bg_8 darkness type_4 relative"  >

    <div class="container" onload="new_captcha();"> 
        <div >
            <div class="col-lg-6 col-md-6  f_none d_table_cell v_align_m d_xs_block t_align_c" style="float:right">
                <div class="create_account_form_wrap r_corners d_inline_b w_xs_full">
                    <h4 class="fw_light color_dark m_bottom_23">Sign Up </h4>
                    <form class="create_account_form" method="post" action="#">
                        <ul>

                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="first_name" placeholder="First Name" class="r_corners bg_light w_full border_none" required>
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="middle_name" placeholder="Middle Name" class="r_corners bg_light w_full border_none" >
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="last_name" placeholder="Last Name /Surname" class="r_corners bg_light w_full border_none" required>
                            </li>

                            <li class="m_bottom_20 m_xs_bottom_15 relative" style="margin-bottom: 10px;">
                                <select name="profession_id" id="profession_select"  onchange="professionChange()" class="r_corners bg_light w_full border_none" style="width: 100%;height: 40px;padding: 5px;" required >
                                    <option value="" >Select Profession</option>
                                    <?php foreach ($professionlist as $key => $value) { ?>
                                        <option value="<?php echo $value['id']; ?>" ><?php echo $value['title']; ?></option>
                                    <?php } ?>
                                    <option value="0" >Other</option>
                                </select>
                            </li>

                            <li class="m_bottom_10 m_xs_bottom_15 relative" style="display: none;" id="professionother">
<!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="text" name="profession_value" id="profession_value" placeholder="Your Profession" class="r_corners bg_light w_full border_none" >
                            </li>

                            <li class="m_bottom_20 m_xs_bottom_15 relative" style="margin-bottom: 10px;">
                                <select name="country" id="country"  onchange="countryChange()" class="r_corners bg_light w_full border_none" style="width: 100%;height: 40px;padding: 5px;" required >
                                    <option value="" >Select Country</option>
                                    <?php foreach ($country_list as $key => $value) { ?>
                                        <option value="<?php echo $value['country_name']; ?>" ><?php echo $value['country_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </li>




                            <li class="m_bottom_20 m_xs_bottom_15 relative" style="text-align: left;color:#fff;    margin-top: 30px; ">
                                <input type="radio" checked id="radio_1" name="gender" class="d_none" value="male">
                                <label for="radio_1" class="d_inline_m m_right_15 m_bottom_3 fw_light" style="font-size: 22px;font-weight: 600;">Male</label>
                                <span style="margin: 3%">&nbsp;</span>
                                <input type="radio" id="radio_2" name="gender" class="d_none" value="female">
                                <label for="radio_2" class="d_inline_m m_right_15 m_bottom_3 fw_light" style="font-size: 22px;font-weight: 600;">Female</label>
                            </li>

                            <li class="m_bottom_20 m_xs_bottom_15 relative">
                                <label class="birthdaylabel" for="birth" style="">Birth Date</label>
                                <br>
                                <select name="birth_year" class="r_corners bg_light w_full border_none" style="width: 36%;height:30px" required >
                                    <option value="" >-YYYY-</option>
                                    <?php
                                    $year = date('Y');
                                    foreach (range(1920, $year) as $number) {
                                        ?>
                                        <option value="<?php echo $number; ?>" ><?php echo $number; ?></option>
                                    <?php } ?>
                                </select>

                                <select name="birth_month" class="r_corners bg_light w_full border_none" style="width: 30%;height:30px" required >
                                    <option value="" >-MM-</option>
                                    <?php foreach (range(1, 12) as $number) { ?>
                                        <option value="<?php echo $number; ?>" ><?php echo $number; ?></option>
                                    <?php } ?>
                                </select> 
                                <select name="birth_date" class="r_corners bg_light w_full border_none" style="width: 30%;height:30px" required >
                                    <option value="" >-DD-</option>
                                    <?php foreach (range(1, 31) as $number) { ?>
                                        <option value="<?php echo $number; ?>" ><?php echo $number; ?></option>
                                    <?php } ?>
                                </select>
                            </li>



                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-mail-alt login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="email" name="email" placeholder="Email as Username" class="r_corners bg_light w_full border_none" required>
                            </li>
                            <li class="m_bottom_10 m_xs_bottom_15 relative">
                                <!--<i class="icon-user login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="password" name="pass"  placeholder="Password" class="r_corners bg_light w_full border_none pass" required>
                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative">
                                <!--<i class="icon-lock login_icon fs_medium color_grey_light_2"></i>-->
                                <input type="password" name="con_pass" placeholder="Confirm Password" class="con_pass r_corners bg_light w_full border_none" required>
                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative">
                                <img src="<?php echo site_url("Api/createCaptha") ?>" id='captchaimg' style="width: 30%;    height: fit-content;" /> 
                                <input name="captcha" id="captcha" type="text" placeholder="Type the text" class="con_pass r_corners bg_light border_none" style="width: 65%" required>
                                <small class='details'>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>

                            </li>
                            <li class="m_bottom_20 m_xs_bottom_15 relative" id="captcha_hide" style="display: none;color: red">
                                Captcha Not Match 
                            </li>

                            <li class="t_align_c">
                                <button name="registration" type="submit" class="registration button_type_3 d_inline_b color_purple r_corners tr_all fw_light">Create An Account</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script language='JavaScript' type='text/javascript'>
    function refreshCaptcha()
    {
        var img = document.images['captchaimg'];
        img.src = img.src;
    }

<?php
if ($msg != "") {
    ?>
        $(document).ready(function () {
            swal({
                type: '<?php echo $msgtype; ?>',
                title: '<?php echo $msg; ?>',
                timer: 2500,
                onClose: () => {

                    $.get('<?php echo base_url(); ?>index.php/Api/sendRegistrationEmail/<?php echo $user_id; ?>',
                                            function () {
                                                window.location = '<?php echo $link; ?>';
                                            })
                                }
                            })
                        })
    <?php
}
?>

</script>
<?php
$this->load->view('layout/footer');
?>
