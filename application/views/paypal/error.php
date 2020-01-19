<?php
$this->load->view('layout/header');
?>

<!-- Inner Page Banner Area Start Here -->
<section class="sub-bnr" data-stellar-background-ratio="0.5" style="margin-bottom: 10px;">
    <div class="position-center-center">
        <div class="container">
            <h4>Checkout</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Checkout</li>
            </ol>
        </div>
    </div>
</section>
<!-- Inner Page Banner Area End Here -->
<!-- Cart Page Area Start Here -->
<div class="cart-page-area">
 

    <!-- Content -->
    <div id="content"  > 
        <!-- Tesm Text -->
        <section class="error-page text-center pad-t-b-130">
            <div class="container "> 

                <!-- Heading -->
                <h1 style="font-size: 40px">Payment Error </h1>
                <p>You have cancelled payment using PayPal try to make payment using other method. </p>
                <?php echo $error;?>
                <hr class="dotted">
                <a href="<?php echo site_url("Cart/checkoutPayment"); ?>" class="btn btn-default "> <i class="fa fa-arrow-left"></i> OTHER PAYMENT METHOD </a>
            </div>
        </section>
    </div>
    <!-- End Content --> 


</div>
<!-- Cart Page Area End Here -->
<!--angular controllers-->
<script src="<?php echo base_url(); ?>assets/theme/angular/productController.js"></script>


<?php
$this->load->view('layout/footer');
?>