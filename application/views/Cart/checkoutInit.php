<?php
$this->load->view('layout/header');
?>

<style>
    .cartbutton{
        width: 100%;
        padding: 6px;
        color: #fff!important;
    }


    .noti-check1 span{
        color: red;
        color: red;
        width: 111px;
        float: left;
        text-align: right;
        padding-right: 13px;
    }

    .noti-check1 h6{
        font-size: 15px;
        font-weight: 600;
    }

    .address_block{
        background: #fff;
        border: 3px solid #d30603;
        padding: 5px 10px;
        margin-bottom: 20px;

    }
    .checkcart {
        border-radius: 50%;
        position: absolute;
        top: -28px;
        left: -8px;
        padding: 4px;
        background: #fff;
        border: 2px solid green;
    }


    .default{
        border: 2px solid green;
    }

    .default{
        border: 2px solid green;
    }

    .checkcart i{
        color: green;
    }

    .address_button{
        padding: 0px 10px;
        margin-top: 15px;
        font-size: 10px;
    }

    .cartdetail_small {
        float: left;
        width: 203px;
    }

</style>






<!-- Slider -->
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




<!-- Content -->


<div class="cart-page-area">
    <div class="container" ng-if="globleCartData.total_quantity">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span class="fa-stack">
                                    <i class="fa fa-shopping-cart fa-stack-1x"></i>
                                    <i class="ion-bag fa-stack-1x "></i>
                                </span>   My Shopping Bag
                                <span style="float: right; line-height: 29px;" class="ng-binding">Total: {{globleCartData.total_price|currency:"<?php echo globle_currency; ?>"}} ({{globleCartData.total_quantity}})</span> 
                            </a>
                        </h4>
                    </div>
                    <div class="panel-body">

                        <div class="shopping-cart text-center" >





                            <!-- Cart Details -->
                            <div class="custom_block_item">

                                <div class="cart-head">
                                    <ul class="row">
                                        <!-- PRODUCTS -->
                                        <li class="col-sm-6 text-left">
                                            <h6>PRODUCTS</h6>
                                        </li>

                                        <!-- PRICE -->
                                        <li class="col-sm-2">
                                            <h6>PRICE</h6>
                                        </li>
                                        <!-- QTY -->
                                        <li class="col-sm-2">
                                            <h6>QTY</h6>
                                        </li>

                                        <!-- TOTAL PRICE -->
                                        <li class="col-sm-2">
                                            <h6>TOTAL</h6>
                                        </li>

                                    </ul>
                                </div>
                                <ul class="row cart-details" ng-repeat="product in globleCartData.products" >
                                    <li class="col-sm-6">
                                        <div class="media"> 
                                            <!-- Media Image -->
                                            <div class="media-left media-middle"> 
                                                <a href="<?php echo site_url("Product/ProductDetails/"); ?>{{product.product_id}}" class="item-img"> 
                                                    <img class="media-object" src="{{product.file_name}}" alt="" style="height: 100px;width: auto;"> 
                                                </a> 
                                            </div>

                                            <!-- Item Name -->
                                            <div class="media-body">
                                                <div class="position-center-center" style="    text-align: left;">
                                                    <h5>{{product.title}} - {{product.item_name}}</h5>
                                                    <p>{{product.sku}}</p>
                                                    <button type="button" ng-click="viewStyle(product)" class="btn btn-primary btn-xs desing_view_button"  style="margin-top: 10px;">View Design</a>

                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- PRICE -->
                                    <li class="col-sm-2">
                                        <div class="position-center-center"> <span class="price">{{product.price|currency:" "}}<span ng-if="product.extra_price > 0" style="font-size: 12px;
                                          font-weight: 600;
                                          text-align: center;">
                                        <br/>
                                        Price: {{product.price - product.extra_price}} + Extra Price:{{product.extra_price}} 
                                    </span></span> </div>
                                    </li>

                                    <!-- QTY -->
                                    <li class="col-sm-2 quantity_li" style="padding-top: 30px;">
                                        <div class="position-center-center"> <span class="price">{{product.quantity}}</span> </div>

                                    </li>

                                    <!-- TOTAL PRICE -->
                                    <li class="col-sm-2">
                                        <div class="position-center-center"> <span class="price">{{product.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span> </div>
                                    </li>



                                </ul>


                            </div>
                            <div class="proceed-button pull-left " >
                                <a href=" <?php echo site_url("Cart/details"); ?>" class="btn btn-default checkout_button_pre " ><i class="fa fa-arrow-left"></i> Back To Cart</a>
                            </div>
                            <div class="proceed-button pull-right ">
                                <a href=" <?php echo site_url("Cart/checkoutSize"); ?>" class="btn btn-default checkout_button_next " >Your Size <i class="fa fa-arrow-right"></i></a>
                            </div>





                        </div>

                    </div>

                </div>

            <?php
            $this->load->view('Cart/itemblock', array('vtype' => 'size'));
            ?>
            <?php
            $this->load->view('Cart/itemblock', array('vtype' => 'shipping'));
            ?>
            <?php
            $this->load->view('Cart/itemblock', array('vtype' => 'payment'));
            ?>

        </div>

    </div>


    <?php
    $this->load->view('Cart/noproduct');
    ?>

</div>






<!--angular controllers-->
<script src="<?php echo base_url(); ?>assets/theme/angular/productController.js"></script>
<script>
                                                var avaiblecredits = 0;
</script>

<?php
$this->load->view('layout/footer', array('custom_item' => 0, 'custom_id' => 0));
?>