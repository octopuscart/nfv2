<?php
$this->load->view('layout/header');
?>
<?php
$temp = array(
    "What does ‘bespoke’ mean?" => "The word bespoke means made-to-order or custom-made. It is most known for its centuries-old relationship with tailor-made suits.",
    "What if my order doesn’t fit to my satisfaction?" => "Please contact us and we will do everything possible to handle the case and make you happy with your purchase.",
    "Once I complete the order online, how long does it take to deliver? " => "We will email your order confirmation within 24 hours with expected delivered date. We anticipate delivering all orders within 12-14 days of confirmation.",
    "Can you ship my order internationally? " => "Yes, we can ship orders to anywhere in the world. Delivery times vary by region.",
    "What is your return policy?" => "Upon inspection, if we made an error, we will then make arrangements to receive back the order and have it corrected or redone.",
    "Will you keep a record of my order? " => "Yes, we will keep a record of your online order with all the details. In addition, we will keep your individual paper pattern. ",
    "What if I made a mistake in my order, can I fix it? " => "Yes, send us an email immediately and we will rectify the error.",
    "Can I send you a garment that fits perfectly to copy the measurements?" => "Yes, of course! That will help us to create perfect fit clothing for you.",
    "Are the buttons on jacket sleeves working or artificial?" => "We construct all jackets with working buttons."
);
?>
<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>FAQ's</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url("/"); ?>">Home</a></li>
                <li><a href="<?php echo site_url("Shop/faqs"); ?>">FAQ's</a></li>
            </ol>
        </div>
    </div>
</section>



<div class="section_offset" ng-controller="lookBookController">
    <div class="container">
        <div class="content">
            <div class="accordion" style='padding: 10px 50px;'>

                <?php
                foreach ($temp as $key => $value) {
                    ?>    

                    <dl class="accordion_item  r_corners wrapper m_bottom_5 tr_all" style='background: #ffffffcf;
                        border-radius: 5px;'>
                        <dt class="accordion_link relative color_dark tr_all"><?php echo $key; ?>
                       
                        </dt>
                        <dd class="fw_light color_dark" style='background: #fff'>
                            <?php echo $value; ?>
                        </dd>
                    </dl>

                    <?php
                }
                ?>
            </div> 
        </div>
    </div>


</div>



<?php
$this->load->view('layout/footer');
?>