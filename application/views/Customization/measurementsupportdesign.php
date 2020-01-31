
<link href="<?php echo base_url(); ?>assets/custom_form_view/static/slider/powerange.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom_form_view/static/slider/powerange.min.js"></script>
<div class="col-md-12">

    <div class="col-md-2">
        <button class="btn btn-danger btn-lg bigbuttonspadding" ng-click="backToCustomization()" style="    width: 100%;"><span aria-hidden="true">&larr;</span>  Back</button>
        <div class="row bodymax500">
            <div class="col-md-12 selectedfabricscustomup  " ng-repeat="(itemk, cart) in customFabricsDone" >
                <div class="thumbnail selectedfabricscustom "  >
                    <div class="caption ">
                        <h3  ng-bind-html="cart.item.title"></h3>
                    </div>

                    <img class="pant_controlZoom " src="{{cart.item.item_image}}" alt="" style="    height: auto;">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <center  ng-if="customFabricsArrayDone.length" >

            <div class="well well-sm">
                <form action="#" method="post">
                    <p>
                        If you have purchased from us before, we have stored your most recent measurement on record.


                    </p>
                    <button class="btn btn-danger button_wave waves-effect waves-button waves-float customoselectbutton" id="start_customization" name="shopStoredMeasurements"  >Confirm Order With Most Recent Offline Purchase
                    </button>
                    <input name="cart_id[]" value="{{cart.item.id}}" ng-repeat="(itemk, cart) in customFabricsDone" type="hidden" />
                </form>
            </div>
            <br/>
            <div class="well well-sm">
                <p>
                    Here you can create a new measurement for a current purchase.

                </p>
                <button class="btn btn-danger button_wave waves-effect waves-button waves-float customoselectbutton" id="start_customization" ng-click="startMeasurementsCustom()" >Create New Measurement Profile?  →
                </button>
            </div>

            <br/>
            <div class="well well-sm">
                <p>
                    Select measurement from previous online purchase, it will apply on all chosen fabric.


                </p>
                <button class="btn btn-danger button_wave waves-effect waves-button waves-float customoselectbutton" id="start_customization2" data-toggle="modal" data-target="#styleModal2" >Select size from Previous Measurement →
                </button>
            </div>


        </center>
    </div>


    <div class="col-md-5">
        <?php
        $this->load->view('Customization/customSummery');
        ?>
    </div>

</div>
