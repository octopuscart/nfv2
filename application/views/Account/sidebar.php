<div class="m_bottom_40 m_xs_bottom_30">
    <p>MY ACCOUNT </P>

    <ul class="categories_list" id="nav" style="margin-top: 10px">

        <li>
            <a href="<?php echo site_url('Account/profile'); ?>" class="color_dark tr_all d_block test">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Profile
            </a>

        </li>
        <li>
            <a href="<?php echo site_url('Account/address'); ?>" class="color_dark tr_all d_block test">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Address
            </a>

        </li>


        <li>
            <a href="#" class="color_dark tr_all d_block">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                My Wallet
            </a>
            <ul class="fw_light d_none">
                <!--                <li>
                                    <a href="mySavedCard.php" class="color_dark tr_all d_block test">
                                        <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                                            <i class="icon-angle-right"></i>
                                        </span>
                                        My Saved Card
                                    </a>
                                </li>-->
                <li>
                    <a href="<?php echo site_url('Account/storCredit'); ?>" class="color_dark tr_all d_block test">
                        <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                            <i class="icon-angle-right"></i>
                        </span>
                        Stored Credit
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="color_dark tr_all d_block">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                All Orders
            </a>
            <ul class="fw_light d_none">
                <li>
                    <a href="<?php echo site_url('Account/orderList'); ?>" class="color_dark tr_all d_block test">
                        <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                            <i class="icon-angle-right"></i>
                        </span>
                        Order Summary
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('Account/orderTracking');?>" class="color_dark tr_all d_block test">
                        <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                            <i class="icon-angle-right"></i>
                        </span>
                        Track Order
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?php echo site_url('Account/invoices');?>" class="color_dark tr_all d_block test">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                All Invoices
            </a>

        </li>
        <li>
            <a href="<?php echo site_url("Account/paymentHistory");?>" class="color_dark tr_all d_block test">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Payment History
            </a>

        </li>


        <li>
            <a href="<?php echo site_url('Account/preferences');?>" class="color_dark tr_all d_block test">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Preferences
            </a>

        </li>

       
        <!--   
                <li>
                    <a href="couponPurchase.php" class="color_dark tr_all d_block test">
                        <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                            <i class="icon-angle-right"></i>
                        </span>
                        Buy Gift Coupon
                    </a>
        
                </li>
              <li>
                    <a href="sitePromote.php" class="color_dark tr_all d_block test">
                        <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                            <i class="icon-angle-right"></i>
                        </span>
                        Refer & Win Coupon
                    </a>
        
                </li>-->

        <li>
            <a href="<?php echo site_url('Account/newsLetters');?>" class="color_dark tr_all d_block test">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Newsletter
            </a>

        </li>



    </ul>
</div>
<script>
    $(function () {
        var activeMenu = window.location.pathname.split("views/")[1];
        // console.log(activeMenu);
        $("a[href='" + activeMenu + "']").parents("li").find("a, span").css("color", "#55c0db")
    })

</script>

