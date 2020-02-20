<?php
$this->load->view('layout/header');
?>

<!-- Content -->
<div id="content" ng-controller="OrderDetailsController"> 



    <style>
        .close{
            opacity: 1;
        }
        .modal-header{
            padding: 3px 19px;
            background: black;
        }
        .tds{
            padding: 8px;
            line-height: 0.42857143 !important;
            vertical-align: top;
            border-bottom: 1px solid;


        }
        .table_type_2 td:not([colspan]){
            padding: 6px;
        }


    </style>
    <style>
        .addr tr{
            border: none;
        }
        .addr td{
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 0px;
            border: none;
            padding-right: 4px !important;
        }
        .hr{
            height: 0px;
        }
        .tb tr{
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left: 0px;
            border: none;
        }
        .tb td{
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left:0px;
            border: none;
            padding-right: 4px !important;
        }
    </style>
    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px; padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
        <div class="container">
            <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo['first_name']; ?></h3>
            <p style="color: black">Order Detail</p>
            <div style="margin-top: 10px;"></div>
        </div>
    </section>

    <div class="section_offset counter">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-3 col-sm-12 m_bottom_50 m_xs_bottom_30 " style=" " >	

                    <?php
                    $this->load->view('Account/sidebar');
                    ?>

                </aside>

                <div class="col-lg-9 col-md-9 col-sm-12 m_bottom_70 m_xs_bottom_30 mobilenopadding" style="">

                    <div style="clear:both"></div>
                    <hr style="margin-top: 6px;margin-bottom: 0px;background: ivory;">

                    <div class=" invoice-info">
                        <div class="col-sm-4 invoice-col">

                            <address>
                                <strong>Shipping Address</strong><br>

                                <?php echo $shipping['address1'] . ',' ?><br/>
                                <?php echo $shipping['address2'] . ',' ?><br/>
                                <?php echo $shipping['city'] . ', ' . $shipping['state'] . ',' ?><br/>
                                <?php echo $shipping['country'] ?><br/>
                                <?php echo $shipping['zip'] ?><br/>
                                <table class="tb">
                                    <tr>
                                        <td>Contact No.</td>
                                        <td>:</td>
                                        <td><?php
                                            echo $userInfo['contact_no'] == 'nul' ? '' : $userInfo['contact_no'];
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>:</td>
                                        <td><?php
                                            echo $userInfo['fax_no'] == 'nul' ? '' : $userInfo['fax_no'];
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo['email'] ?></td>
                                    </tr>
                                </table>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <!--                            <address>
                                                            <strong>Billing Address</strong><br>
                            <?php echo $biling['address1'] . ',' ?><br/>
                            <?php echo $biling['address2'] . ',' ?><br/>
                            <?php echo $biling['city'] . ', ' . $biling['state'] . ',' ?><br/>
                            <?php echo $biling['country'] ?><br/>
                            <?php echo $biling['zip'] ?><br/>
                            
                                                            <table class="tb">
                                                                <tr>
                                                                    <td>Contact No.</td>
                                                                    <td>:</td>
                                                                    <td><?php echo $userInfo['contact_no'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fax</td>
                                                                    <td>:</td>
                                                                    <td><?php echo $userInfo['fax_no'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td>:</td>
                                                                    <td><?php echo $userInfo['email'] ?></td>
                                                                </tr>
                                                            </table>
                            
                            
                                                        </address>-->
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <b>Invoice Information</b><br/>

                            <table class="addr">
                                <tr>
                                    <td>Invoice No.</td>
                                    <td>:</td>
                                    <td><?php echo $invoice_data[0]['invoice_no'] ?><br/></td>
                                </tr>
                                <tr>
                                    <td><span>Date/Time</span></td>
                                    <td>:</td>
                                    <td><?php echo $invoice_data[0]['op_date'] ?><br/>
                                        <?php echo $invoice_data[0]['op_time'] ?></td>
                                </tr>


                                <tr>
                                    <td>Currency</td>
                                    <td>:</td>
                                    <td>US$</td>
                                </tr>
                                <tr>
                                    <td>Order No.</td>
                                    <td>:</td>
                                    <td><?php echo $orderDetail[0]['order_no'] ?></td>
                                </tr>
                                <tr>
                                    <td>Client Code</td>
                                    <td>:</td>
                                    <td><?php echo $userInfo['registration_id']; ?> </td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td>:</td>
                                    <td><?php echo $orderDetail[0]['payment_gateway'] ?></td>
                                </tr>

                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <hr>

                    <div class="col-md-12" style="    padding: 5px 5px;
                         border: 1px solid #000;
                         margin-bottom: 18px;
                         border-radius: 5px;">
                        <p style="    border-bottom: 1px solid #000;">Order Status</p>

                        <style>
                            .orderstatustable th{
                                border: none;
                            }
                            .orderstatustable td{
                                border: none;

                            }
                            .orderstatustable tr{
                                border-bottom: 1px solid #D8D8D8;;
                            }
                        </style>

                        <table class="orderstatustable" style="    width: 100%;">

                            <?php
                            $proccessArray = [];
                            $temp = ($order_status_record);

                            foreach ($temp as $key => $value) {

                                $ht = "<tr '>";
                                $ht .= "<td style='width:170px'>" . $value['date'] . "</td>";
                                $ht .= "<td style='      border-left: 1px solid;padding: 0;width: 1px; padding-top: 12px; '><i class='icon-circle' style='margin-left: -25px;margin-left: -11px;    font-size: 25px;
    margin-top: 11px;'></i></td>";
                                $ht .= '<th>' . $value['order_status'] . ' <br><small style="font-weight:300;font-size:13px">' . ($value['status_tag'] != '7' ? $value['remark'] : '') . '</small> </th>';


                                array_push($proccessArray, $ht);
                            }
                            $proccessStatus = implode('', $proccessArray);
                            echo $proccessStatus;
                            echo "</td></tr>";
                            ?>
                        </table>

                    </div>
                    <div style="clear: both"></div>

                    <div class="panel panel-default" style="margin-bottom: -23px;">

                        <div class="panel-heading">
                            <h3 class="panel-title">Order Description</h3>
                        </div>

                        <div class="row" style=" margin-top:0px;">
                            <div class="col-xs-12 table-responsive">
                                <table class="table">

                                    <tbody><tr>
                                            <th style="width: 25%;"><span style="margin: 0px 0px 0px 13px;">Product</span></th>
                                            <th style="width: 25%;">Style Id / Measurement Profile	</th>
                                            <th style="width: 7%;">Item</th>
                                            <th style="width: 100px;">Qty.</th>
                                            <th style="width: 9%;">Price</th>
                                            <th style="width: 12%;">Extra Price</th>
                                            <th style="width: 9%;">Total</th>
                                            

                                        </tr>





                                        <tr class="" ng-repeat="citem in shopCart.cartdata.products">

                                            <td>
                                                <div class="col-md-4" style="">
                                                    <a href="#" class="r_corners d_inline_b wrapper">
                                                        <img src="{{citem.item_image}}" alt="" style="    height: 70px;    width: 70px;;">
                                                    </a>
                                                </div>
                                                <div class="col-md-8 hideonmobile" style="padding: 0px">
                                                    <p class=""><a href="#" class="color_dark tr_all">{{citem.title}}</a></p>
                                                    <p class="textoverflow" style="font-size: 12px" data-toggle="tooltip" data-placement="left" title="Sand ">
                                                        {{citem.product_speciality}}  
                                                    </p>
                                                    <button class="btn btn-xs btn-default" ng-if="citem.customization_id > 0" ng-click="viewStyle(citem.style)">View</button>

                                                </div>
                                            </td>
                                            <td data-title="SKU" class="fw_light">

                                                <table class="addr measurement_style" style="width: 100%;margin-top: 11px;">
                                                    <tbody><tr style="font-size: 13px">
                                                            <td class="measurement_style" >Style Id</td>

                                                            <td class="measurement_style">{{citem.customization_data}}</td>
                                                        </tr>
                                                        <tr style="font-size: 13px">
                                                            <td class="measurement_style">Measurement Profile</td>

                                                            <td class="measurement_style">{{citem.measurement_data}}</td>
                                                        </tr>
                                                    </tbody></table>


                                            </td>
                                            <td>

                                                <p>{{citem.tag_title}}  </p>
                                            </td>

                                            <td data-title="Quantity" style="width: 90px">
                                            {{citem.quantity}}
                                             



                                            </td>

                                            <td data-title="Price">{{(citem.price - citem.extra_price)|currency}}  </td>
                                            <td data-title="Extra Price">
                                                {{citem.extra_price|currency}}<br/>
                                                <button class="btn btn-xs btn-default" ng-if="citem.extra_price > 0" ng-click="viewExtraPrice(citem.style)">View</button>
                                            </td>
                                            <td data-title="Total" class=" color_dark" style="">
                                                {{citem.total_price|currency}}     

                                            </td>

                                            

                                        </tr>




                                    <input type="hidden" id="no_of_product" value="3">

                                    <tr class="bg_light_2">
                                        <td colspan="2" rowspan="6">
                                            

                                        </td>

                                        <td colspan="4"><span class="spna">Sub Total</span>:</td>
                                        <td>
                                            <p style="" id="sub_total fw_ex_bold">
                                                {{shopCart.cartdata.total_price|currency}} 
                                            </p>
                                        </td>
                                    </tr>
            <!--                                <tr class="bg_light_2">
            
                                        <td><span class="spna">Tax/Custom</span>:</td>
                                        <td><p style="">$00.00</p></td>
                                    </tr>-->
                                    <tr class="bg_light_2">

                                        <td colspan="4"><span class="spna">Coupon Discount</span>:</td>
                                        <td>                                             <p id="discount_coupon fw_ex_bold" style="">$00.00</p>  

                                        </td>
                                    </tr>
                                    <tr class="bg_light_2">

                                        <td colspan="4"><span class="spna">Shipping Price</span>:</td>
                                        <td> <p style="" id="shipping_amount" class="">
                                                {{shopCart.cartdata.shipping_price|currency}}  

                                            </p></td>
                                    </tr>
                                    <tr class="bg_light_2">

                                        <td colspan="4"><span class="spna">My Wallet</span>:</td>
                                        <td>
                                            <p style="" id="wallet_amount1" class="">
                                                $00.00
                                            </p>
                                            <form method="post" action="#" class="ng-pristine ng-valid">

                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="bg_light_2">

                                        <td colspan="4"><span class="spna" style="color:black;font-size: 16px"><b>Grand Total</b></span>:</td>
                                        <td><span style="" id="tPrice" class="fw_ex_bold"> {{shopCart.cartdata.grand_total|currency}} </span></td>
                                    </tr>

                                    </tbody></table>
                                
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div style="clear:both"></div>
                    </div>
                </div>



                <!--banners-->
            </div>
        </div>
    </div>
</div>

<script>
    var order_idgbl = <?php echo $orderDetail[0]['id']; ?>;
</script>
<script src="<?php echo base_url(); ?>assets/theme/angular/shopAllCart.js"></script>


<?php
$this->load->view('layout/footer');
?>