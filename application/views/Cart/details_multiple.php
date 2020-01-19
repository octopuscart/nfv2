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
<div id="content" ng-if="globleCartDatanc.total_quantity"> 

    <!-- Shop Content -->
    <div class="shop-content pad-t-b-30">
        <div class="container"> 
            <!-- Payments Steps -->
            <div class="shopping-cart text-center" >


                <?php

                function createItemBlock($citem_id) {

                    switch ($citem_id) {
                        case 1:
                            $item_array = array("title" => "Shirt(s)", "link"=>site_url("Customization/customizationShirt"));
                            break;
                        case 2:
                            $item_array = array("title" => "Suit(s)", "link"=>site_url("Customization/customizationSuitV2"));
                            break;
                        case 3:
                            $item_array = array("title" => "Pant(s)", "link"=>site_url("Customization/customizationSuitV2"));
                            break;
                        case 4:
                            $item_array = array("title" => "Jacket(s)", "link"=>site_url("Customization/customizationSuitV2"));
                            break;
                        default:
                            $item_array = array("title" => "Shirt(s)", "link"=>site_url("Customization/customizationSuitV2"));
                    }
                    ?>


                    <!-- Cart Details -->
                    <div class="custom_block_item">
                        <h3 class="text-left " style="font-weight:500;    margin-top: 0px;" >
                            <?php echo $item_array['title']; ?>
                            <a href="<?php echo $item_array['link']; ?>" class="btn btn-default pull-right">Customize Now <i class="fa fa-arrow-right"></i></a> 
                        </h3>
                      
                        <div class="row cart-details" >
                            <div class="col-sm-6 col-md-2" ng-repeat="product in globleCartDatanc.products" ng-if="(product.item_id == <?php echo $citem_id; ?>) && (!product.custom_dict)">
                                <div class="thumbnail">
                                    <img src="{{product.file_name}}" alt="" style="height: 140px;width: auto;" alt="...">
                                    <div class="caption">
                                        <h5>{{product.title}}</h5>
                                            <p><span class="price">{{product.price|currency:" "}}</span></p>
                                        <p><a href="#." ng-click="removeCart(product.product_id)"><i class="icon-close"></i></a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                    </div>

                    <?php
                }

                createItemBlock(1);
                createItemBlock(2);
                createItemBlock(4);
                createItemBlock(3);
                ?>



            </div>
        </div>
    </div>

    <!--======= PAGES INNER =========-->
    <section class="pad-t-b-30 light-gray-bg shopping-cart small-cart"  >
        <div class="container"> 
            <!-- SHOPPING INFORMATION -->
            <div class="cart-ship-info margin-top-0"> 
                <div class="row">
                    <!-- SUB TOTAL -->
                    <div class="col-sm-12">

                        <div class="grand-total">
                            <div class="order-detail">
                                <!-- SUB TOTAL -->
                                <p class="all-total">TOTAL COST <span>{{globleCartDatanc.total_price|currency:"<?php echo globle_currency_type; ?>"}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Content --> 

<!-- Content -->
<div id="content"  ng-if="!globleCartDatanc.total_quantity"> 
    <!-- Tesm Text -->
    <section class="error-page text-center pad-t-b-130">
        <div class="container "> 

            <!-- Heading -->
            <h1 style="font-size: 40px">No Product Found</h1>
            <p>Please add product to cart<br>
                You can go back to</p>
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