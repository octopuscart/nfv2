<?php
$this->load->view('layout/header');
?>

<style>
    .cartbutton{
        width: 100%;
        padding: 6px;
        color: #fff!important;
    }

    .custom_block_item{
        padding:10px;
        border:3px solid #000;
        margin:10px;
    }
</style>

<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>Cart</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Cart</li>
            </ol>
        </div>
    </div>
</section>

<!-- Content -->
<div id="content" ng-if="globleCartData.total_quantity"> 

    <!-- Shop Content -->
    <div class="shop-content pad-t-b-30">
        <div class="container"> 
            <!-- Payments Steps -->
            <div class="shopping-cart text-center" >





                <!-- Cart Details -->
                <div class="custom_block_item">

                    <div class="cart-head">
                        <ul class="row">
                            <!-- PRODUCTS -->
                            <li class="col-sm-5 text-left">
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
                            <li class="col-sm-1"> </li>
                        </ul>
                    </div>
                    <ul class="row cart-details" ng-repeat="product in globleCartData.products" >
                        <li class="col-sm-5">
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
                            <div class="position-center-center"> 
                                <span class="price">
                                    {{product.price|currency:" "}}
                                    <span ng-if="product.extra_price > 0" style="font-size: 12px;
                                          font-weight: 600;
                                          text-align: center;">
                                        <br/>
                                        Price: {{product.price - product.extra_price}} + Extra Price:{{product.extra_price}} 
                                    </span>
                                </span> 
                            </div>
                        </li>

                        <!-- QTY -->
                        <li class="col-sm-2 quantity_li" style="padding-top: 30px;">
                            <input type="text" name='quantity' class="form-control quantity-input" value="{{product.quantity}}"  placeholder="1" readonly="">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default quantity-plus cart_button" type="button" ng-click="updateCart(product, 'add')"><i class="fa fa-plus" aria-hidden="true" ></i></button>
                                </span>
                                <span class="input-group-btn">
                                    <button class="btn btn-default quantity-minus cart_button" type="button" ng-click="updateCart(product, 'sub')"><i class="fa fa-minus" aria-hidden="true" ></i></button>
                                </span>
                            </div><!-- /input-group -->
                        </li>

                        <!-- TOTAL PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price">{{product.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span> </div>
                        </li>

                        <!-- REMOVE -->
                        <li class="col-sm-1">
                            <div class="position-center-center"> <a href="#." ng-click="removeCart(product.product_id)"><i class="icon-close"></i></a> </div>
                        </li>

                    </ul>


                </div>





            </div>
        </div>
    </div>

    <!--======= PAGES INNER =========-->
    <section class="pad-t-b-30 light-gray-bg shopping-cart small-cart"  >
        <div class="container"> 
            <!-- SHOPPING INFORMATION -->
            <div class="cart-ship-info margin-top-0" style="    margin-bottom: 10px;"> 
                <div class="row">
                    <!-- SUB TOTAL -->
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <a href="<?php echo site_url("Cart/details"); ?>" class="btn btn-primary pull-left" ><i class=" fa fa-arrow-left"></i> Customize More </a>

                        </div>
                        <div class="col-md-4">

                            <!-- SUB TOTAL -->
                            <h2 class=" text-center" style="font-size: 20px;
                                margin-top: 10px;">TOTAL: <span>{{globleCartData.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span></h2>

                        </div>
                        <div class="col-md-4">
                            <a href="<?php echo site_url('Cart/checkoutInit') ?>" class="btn btn-primary pull-right" >Proceed To Checkout <i class=" fa fa-arrow-right"></i></a>

                        </div>






                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Content --> 

<!-- Content -->
<div id="content"  ng-if="!globleCartData.total_quantity"> 
    <!-- Tesm Text -->
    <section class="error-page text-center pad-t-b-130">
        <div class="container "> 

            <!-- Heading -->
            <h1 style="font-size: 40px">No Product Found</h1>
            <p>To view in cart first customize the product</p>
            <hr class="dotted">
            <a href="<?php echo site_url(); ?>" class="btn btn-inverse">BACK TO HOME</a>
        </div>
    </section>
</div>
<!-- End Content --> 


<!--angular controllers-->
<script src="<?php echo base_url(); ?>assets/theme/angular/productController.js"></script>


<?php
$this->load->view('layout/footer');
?>


