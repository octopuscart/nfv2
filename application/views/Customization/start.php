<?php
$this->load->view('layout/header');
?>
<link href="<?php echo base_url(); ?>assets/bootstrap.vertical-tabs.css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/theme/angular/customform.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/theme/angular/customstyle.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets/theme/noslider/nouislider.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/theme/noslider/nouislider.min.js"></script>

<div ng-controller="customizationPage" id="customizationPage">

    <section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="padding:15px ">
        <div class="container">
            <h5 style="    font-weight: 300;    margin-bottom: 10px;      font-size: 46px;"> <i class="icon-basket color_grey_light_2 tr_inherit"></i>  {{customizationElement.title}}</h5>
            <!--breadcrumbs-->
            <small style="font-size: 20px;
                   color: red;">Your shopping cart contains <span id="total_cart_quantitys">{{ cartDataArray.length}} {{customizationElement.item}}(s)</span> </small>
        </div>
    </section>

    <div class=" counter custmo_form_setup custom_form_style" style="" >
        <div class="container customformv1" style="margin-bottom: 20px;    width: 100%;" >



            <div class="row customblockstart">

                <?php
                $this->load->view('Customization/custome_support');
                ?>

            </div>


            <div class="row measurementblockstart">
                <?php
                $this->load->view('Customization/measurementsupport');
                ?>
            </div>



            <!--model ask-->
            <div class="row" ng-if="initAnimate.startcustom == 0">


                <div class="col-md-7">

                    <h3 style="
                        font-weight: 300;
                        margin-bottom: 20px;

                        font-size:50px;
                        text-align: center;

                        ">Design  Your {{customizationElement.item}}<br>


                    </h3>
                    <p style="text-align: center">Click the fabric image and select</p><br/>

                    <div class="row" style="text-align: center; ">


                        <!-- ngRepeat: product in productStyleArrayNg -->
                        <div class="fabriciconfront" style="display:inline-block" ng-repeat="(cark, cart) in cartData" ng-click="selectFabric(cart.item)" ng-if="!customFabricsDone[cart.item.title]">
                            <div class="thumbnail style_selection  waves-effect ZoomIn " style="opacity: 1" ng-class="cart.item.title == customFabrics[cart.item.title].item.title ? 'selected' : 'deselect'">
                                <img src="{{cart.item.item_image}}" alt="">
                                <div class="caption">
                                    <h5 style="margin:0;font-size: 15px;    text-align: center;" data-title="SKU" class="ng-binding">{{cark}} {{cart.item.id}}</h5>

                                </div>
                            </div>
                        </div><!-- end ngRepeat: product in productStyleArrayNg -->

                    </div>
                    <center  ng-if="customFabricArraySelect.length" >
                        <button class="btn btn-danger button_wave waves-effect waves-button waves-float customoselectbutton" id="start_customization" ng-click="startCustom()" >Create New Style →
                        </button>
                        <br/>
                        <button class="btn btn-danger button_wave waves-effect waves-button waves-float customoselectbutton" id="start_customization" ng-click="shopStored()"  >Most Recent Offline Purchase
                        </button>
                        <br/>
                        <button class="btn btn-danger button_wave waves-effect waves-button waves-float customoselectbutton" id="start_customization" data-toggle="modal" data-target="#styleModal" >Select From Previous Style →
                        </button>


                    </center>




                </div>
                <div class="col-md-5">
                    <div class="" style="min-height:450px;height:100%;background: url(custom_form_view/background_new_custom/1.jpg);   background-position-y: center;
                         background-size: contain;    background-repeat: no-repeat;" ng-if="customFabricsArrayDone.length == 0">

                    </div>
                    <div class="" ng-if="customFabricsArrayDone.length">
                        <div class="col-md-12">

                            <div class="measurementprocess">
                                <button class="btn btn-danger button_wave waves-effect waves-button waves-float" ng-click="startMeasurements()" id="start_customization"  style="background:red;border-color: red;color:white">Proceed For Measurements →
                                </button>
                            </div>
                            <ul class="nav nav-tabs " role="tablist" style="    border-bottom: 0px solid #ddd;">
                                <li role="presentation" class="{{$index==0?'active':''}} " ng-repeat="(cartk, cart) in customFabricsDone">
                                    <a class="" href="#customdone{{$index}}" aria-controls="customdone{{$index}}" role="tab" data-toggle="tab">{{cartk}} </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="custom_form_tables tab-pane {{$index==0?'active':''}} " id="customdone{{$index}}" ng-repeat="(cartk, cart) in customFabricsDone">

                                    <ul class="list-group">
                                        <li class="list-group-item summaryelement">
                                            <h3>{{cart['Style Profile']}}</h3>
                                        </li>
                                        <li class="list-group-item summaryelement" ng-repeat="(elementk, elementv) in cart.style">
                                            {{elementk}}<br/>
                                            <span>{{elementv}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>






        </div>


        <!-- Modal -->
        <div class="modal fade" id="styleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Choose From Previous Styles</h4>
                    </div>
                    <div class="modal-body">
                        Select Style from previous online purchase.
                        Please Note: You must select which style you wish to select for each fabric by choosing fabric icon.
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" ng-repeat="preprofile in customProfileArray">
                                <div class="panel-heading" style="height: 50px;">
                                    <h4 class="panel-title" style="    line-height: 32px;">
                                        <a data-toggle="collapse" data-parent="#accordion{{preprofile.id}}" href="#collapse{{preprofile.id}}" style="color:white;font-size: 12px; ">
                                            Style No. {{preprofile.profile}}
                                            <button class="btn btn-success btn-sm pull-right" ng-click="applyPreStyle(preprofile)">Choose Style</button>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{preprofile.id}}" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <ul class="" role="tablist" style=" height:700px ">
                                            <li role="presentation  customtabblock" ng-repeat="style in preprofile.style">
                                                <a class="" href="#custom{{$index}}" aria-controls="custom{{$index}}" role="tab" data-toggle="tab" style="font-size: 12px;">
                                                    <span class="customtagname"> {{style.style_key}}  </span>
                                                    <span class="customtagvalue"> {{style.style_value}} </span>

                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>
</div>-
<script>
    var customlink = "<?php echo site_url("CustomApi"); ?>";
    var itemidgbl = <?php echo $item_id; ?>;
    var customlinkitem = "<?php echo $customlink; ?>";
</script>

<script src="<?php echo base_url(); ?>assets/theme/angular/customFormv1.js"></script>
<?php
$this->load->view('layout/footer');
?>