<?php
$this->load->view('layout/header');
?>

<style>
    .datatable th{
        border: none;
    }
    .datatable td{
        border: none;
    }
    .addr td{
        border: none;
    }
    .updateAddress td{
        border: none;
    }
    input[type="checkbox"] + label:before {
        content: '';
        font-family: "fontello";
        display: block;
        position: absolute;
        background: #F00;
        top: -8px;
        left: 0px;
        width: 22px;
        height: 23px;
        border: 2px solid #cc0000;
    }

</style>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo['first_name']; ?></h3>
        <p style="color:black;margin-top: 10px;">Address Information</p>
        <div style="margin-top: 10px;"> </div>
    </div>
</section>

<div class="section_offset counter" ng-controller="AddressConroller">
    <div class="container">
        <div class="row">  
            <aside class="col-lg-3 col-md-3 col-sm-12 m_bottom_50 m_xs_bottom_30 " style=" " >	

                <?php
                $this->load->view('Account/sidebar');
                ?>

            </aside>

            <div class="col-lg-9 col-md-9 col-sm-12 m_bottom_70 m_xs_bottom_30 mobilenopadding" style="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="icon-user"></i> Client Code : <?php echo $userInfo['registration_id'] ?> </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="margin: 0px 0px 10px -10px;">
                            <h4 style="font-size:20px;color:black;">If you want to set other address for shipping, please select an address
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addressModal">
                                    Add New
                                </button>
                            </h4>

                        </div>
                        <div style="clear: both"></div>




                        <div class="row" style="margin-top: 20px;">

                            <div class="col-md-6 " ng-repeat="address in userAddress.list">
                                <div class="addressblock {{address.id == userAddress.selected.id?'active':''}}">
                                    <address>
                                        {{address.address1}}<br>
                                        {{address.address2}}<br>
                                        {{address.city}}, {{address.state}}<br>
                                        {{address.country}}, {{address.zip}}<br>
                                    </address>
                                    <div ng-if="address.id == userAddress.selected.id" class="addressbarbottom">
                                        <i class="selectedaddress fa fa-check"></i>
                                    </div>

                                    <div ng-if="address.id != userAddress.selected.id" class="addressbarbottom">
                                        <form action="#" method="post">
                                            <button type="submit" value="{{address.id}}" name="setDefault" class="btn btn-default buttonaddressselect" >Select</button>
                                            <button type="submit" value="{{address.id}}" name="deleteAddress" class="btn btn-danger buttonaddressselect deleteaddress" >Delete</button>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content" style="width: 79%;margin: 0px 0px 0px 61px;">
                <div class="modal-header" style="color: white">
                    <button type="button" class="close" 
                            data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <p class="modal-title" id="myModalLabel">
                        <i class="icon-edit"></i> Fill Address Detail
                    </p>
                </div>
                <form method ="post" action="#">
                    <div class="modal-body">

                        <table class="addr">
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name" class=""><b>Address (Line 1)</b></span>
                                </td>
                                <td>
                                    <input type="text" required name="address1" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>

                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name" class=""><b>Address (Line 2)</b></span>
                                </td>
                                <td>
                                    <input type="text" required required name="address2" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name" class=""><b>Town/City</b></span>

                                </td>
                                <td>
                                    <input type="text" required required name="city" class="form-control" value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name"><b>State</b></span>
                                </td>
                                <td>
                                    <input type="text" required required name="state" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>


                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name"><b>Zip/Postal</b></span>
                                </td>
                                <td>
                                    <input type="text" required  name="zip" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height: 25px;">
                                    <span for="name"><b>Country</b></span>
                                </td>
                                <td>
                                    <input type="text" required required name="country" class="form-control"  value=""  style="height: 10%;">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" id="checkboxs_2" name="ship" class="d_none product_checkBox" value="1">
                                    <label for="checkboxs_2" class="d_inline_m m_right_10" style="line-height: 18px;">Use as shipping address</label>
                                </td>
                            </tr>
    <!--                        <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" id="checkboxs_1" name="bill" class="d_none product_checkBox" value="1">
                                    <label for="checkboxs_1" class="d_inline_m m_right_10" style="line-height: 18px;">Use as billing address</label>
                                </td>
                            </tr>-->


                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success " name="submitAddress" value="cc" style="margin: ">
                            <i class="icon-check"></i> Submit 
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--banners-->
</div>
<script src="<?php echo base_url(); ?>assets/theme/angular/account.js"></script>

<?php
$this->load->view('layout/footer');
?>
