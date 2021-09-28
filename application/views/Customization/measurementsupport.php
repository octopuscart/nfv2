
<link href="<?php echo base_url(); ?>assets/custom_form_view/static/slider/powerange.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/custom_form_view/static/slider/powerange.min.js"></script>


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

<div class="col-md-10">
    <div class=" tab-content row" style="">
        <div class="col-sm-4 mainelementtab">
            <form action="#" method="post">
                <div class="" style="display: none">
                    <input name="measurementkey[]" value="{{itemk}}" ng-repeat="(itemk, cart) in mesurementSelecttion" type="hidden" />
                    <input name="measurementvalue[]" value="{{cart}}" ng-repeat="(itemk, cart) in mesurementSelecttion" type="hidden" />
                    <input name="posturekey[]" value="{{itemk}}" ng-repeat="(itemk, cart) in mesurementdata.posture_selection" type="hidden" />
                    <input name="posturevalue[]" value="{{cart}}" ng-repeat="(itemk, cart) in mesurementdata.posture_selection" type="hidden" />
                    <input name="profile_name" type="hidden" value="{{mesurementSelecttion['Profile']}}">
                    <input name="cart_id[]" value="{{cart.item.id}}" ng-repeat="(itemk, cart) in customFabricsDone" type="hidden" />

                </div>  
                <button class="btn btn-success btn-lg bigbuttonspadding" name="confirm_measurements"  style="    width: 100%;">Confirm Measurements </button>
            </form>
            <ul class="nav nav-tabs tabs-left vertialTab bodymax500" role="tablist" style=" height:700px ">
                <li role="presentation" class="active customtabblock" >
                    <a class="" href="#measurement_profile" aria-controls="measurement_profile" role="tab" data-toggle="tab">
                        <span class="customtagname">Profile </span>
                        <span class="customtagvalue">{{mesurementSelecttion['Profile']}}</span>
                    </a>
                </li>
                <li role="presentation" class=" customtabblock" >
                    <a class="" href="#measurement_profile" aria-controls="measurement_profile" role="tab" data-toggle="tab">
                        <span class="customtagname">Height </span>
                        <span class="customtagvalue">{{mesurementSelecttion['Height']}}</span>
                    </a>
                </li>
                <li role="presentation" class=" customtabblock" >
                    <a class="" href="#measurement_profile" aria-controls="measurement_profile" role="tab" data-toggle="tab">
                        <span class="customtagname">Weight </span>
                        <span class="customtagvalue">{{mesurementSelecttion['Weight']}}</span>
                    </a>
                </li>
                <li role="presentation" class=" customtabblock" >
                    <a class="" href="#measurement_profile" aria-controls="measurement_profile" role="tab" data-toggle="tab">
                        <span class="customtagname">Age </span>
                        <span class="customtagvalue">{{mesurementSelecttion['Age']}}</span>
                    </a>
                </li>

                <?php
                foreach ($measurements as $key => $value) {
                    ?>
                    <li role="presentation" class="customtabblock" >
                        <a class="" href="#measurement<?php echo $key; ?>" aria-controls="measurement<?php echo $key; ?>" role="tab" data-toggle="tab">
                            <span class="customtagname"> <?php echo $value['title']; ?> </span>
                            <span class="customtagvalue">{{mesurementSelecttion['<?php echo $value['title']; ?>']}}"</span>

                        </a>
                    </li>
                    <?php
                }
                ?>


                <li role="presentation" class=" customtabblock" ng-repeat="(mskp, msvp) in  mesurementdata.posture_selection">
                    <a class="" href="#measurement_profile" aria-controls="measurement_profile" role="tab" data-toggle="tab">
                        <span class="customtagname">{{mskp}} </span>
                        <span class="customtagvalue">{{msvp}}</span>
                    </a>
                </li>
                <!--                <li role="presentation" class=" customtabblock">
                                    <a class="" href="#measurement_images" aria-controls="measurement_images" role="tab" data-toggle="tab">
                                        <span class="customtagname">Your Images </span>
                                        <span class="customtagvalue">-</span>
                                    </a>
                                </li>
                -->
                <li role="presentation" class=" customtabblock">

                </li>


               
            </ul>

        </div>
        <div class="col-md-8">
            <div class="tab-content" >
                <div role="tabpanel" class="custom_form_tables tab-pane active " id="measurement_profile" >
                    <!--custome element options-->
                    <div class="panel panel-default bodytransection">
                        <div class="panel-heading">Create Profile</div>
                        <div class="panel-body ">

                            <table class="table table-bordered measurementtable">
                                <tr>
                                    <td colspan="3">
                                        <div class="">
                                            <div class="input-group input-group-lg" style="width: 100%;">
                                                <span class="input-group-addon" id="sizing-addon1">Write Profile Name</span>
                                                <input type="text" class="form-control" placeholder="Profile Name" aria-describedby="sizing-addon1" ng-model="mesurementSelecttion['Profile']">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td  style="width: 150px">
                                        Height<br/>
                                        <span class="smalltext">{{mesurementSelecttion['Height']}}</span>
                                    </td>
                                    <td>
                                        <div class="col-md-12 number_slider_div2 row" >
                                            <div class="input-group input-group-lg col-md-4 pull-left" style="padding-right:10px">
                                                <span class="input-group-addon" id="sizing-addon1">Feet</span>
                                                <input type="number" min="3" max="8" class="form-control" placeholder="5" aria-describedby="sizing-addon1" ng-model="temp_height_f" ng-init="temp_height_f=5">
                                            </div>
                                            <div class="input-group input-group-lg col-md-4 pull-left" style="">
                                                <span class="input-group-addon" id="sizing-addon1">Inch</span>
                                                <input type="number" min="0" max="12" class="form-control" placeholder="0" aria-describedby="sizing-addon1" ng-model="temp_height_inc" ng-init="temp_height_inc=0">
                                            </div>
                                            
                                            <div  type="text" id="slider-pips_height" value="5" minval="3" maxval="8" startval="5" style="display: none"></div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td  >
                                        Weight<br/>
                                        <span class="smalltext">
                                            {{mesurementSelecttionFrc['Weight']}}
                                            <select ng-model="measurementWeightUnit.unit" id="measurementunit" ng-click="changeWeightUnit()">
                                                <option value="KG">KG</option>
                                                <option value="LBS">LBS</option>
                                            </select>
                                        </span>

                                    </td>
                                    <td>
                                        <div class="col-md-12 number_slider_div2" >
                                            <div  type="text" id="slider-pips_weight" value="5" minval="3" maxval="8" startval="5"></div>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td  >
                                        Age<br/>
                                        <span class="smalltext">{{mesurementSelecttion['Age']}}</span>
                                    </td>
                                    <td>
                                        <div class="col-md-12 number_slider_div2" >
                                            <div  type="text" id="slider-pips_age" value="5" minval="3" maxval="8" startval="5"></div>
                                        </div>
                                    </td>

                                </tr>
                            </table>

                            <div class="panel panel-default bodytransection" ng-repeat="(kmes, vmes) in mesurementdata.posture">
                                <div class="panel-heading">{{kmes}}</div>
                                <div class="panel-body">
                                    <div class=" " >

                                        <div class="col-md-2 col-md-padding5 " ng-repeat="ele in vmes" >
                                            <div class="thumbnail  style_selection  waves-effect ZoomIn  "  ng-click="setPosture(kmes, ele.title)"  ng-class="ele.title == mesurementdata.posture_selection[kmes] ? 'selected' : 'deselect'" style="" >
                                                <img class="pant_controlZoom " src="{{ele.image}}" alt="">
                                                <div class="caption ">
                                                    <h3 style="{{subelev.lablestyle}}" ng-bind-html="ele.title"></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="panel-footer">
                                <nav aria-label="...">
                                    <ul class="pager" >
                                        <li class="next next-tab"><a href="javascript:function() { return false; }#">Next <span aria-hidden="true">&rarr;</span></a></li>
                                    </ul>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>





                <?php
                foreach ($measurements as $key => $value) {
                    ?>
                    <div role="tabpanel" class="custom_form_tables tab-pane " id="measurement<?php echo $key; ?>" >
                        <!--custome element options-->
                        <div class="panel panel-default bodytransection">
                            <div class="panel-heading"><?php echo $value['title']; ?></div>
                            <div class="panel-body ">
                                <div class="">

                                    <div class="">
                                        <div class="row measurementblock">
                                            <div class="col-md-6">
                                                <h2>
                                                    <?php echo $value['title']; ?>
                                                </h2>
                                            </div>
                                            <div class="col-md-6">
                                                <h2 class="mesvalue">
                                                    {{mesurementSelecttionFrc['<?php echo $value['title']; ?>'][0]}}
                                                </h2>
                                                <span class="frcvalue">
                                                    {{mesurementSelecttionFrc['<?php echo $value['title']; ?>'][1]?mesurementSelecttionFrc['<?php echo $value['title']; ?>'][1]:''}}"
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12 number_slider_div" >
                                        <div  type="text" id="slider-pips<?php echo $value['id']; ?>" value="<?php echo $value['standard_value']; ?>" minval="<?php echo $value['min_value']; ?>" maxval="<?php echo $value['max_value']; ?>" startval="<?php echo $value['standard_value']; ?>"></div>
                                        <!--<input id="mesid{{mesobj.id}}" targetdiv="mes_4"  number-slider type="text" value="{{mesobj.standard_value}}" minval="{{mesobj.min_value}}" maxval="{{mesobj.max_value}}" startval="{{mesobj.standard_value}}" class="number_slider_fraction" />-->
                                    </div>
                                </div>
                                <div>
                                    <?php echo $value['measurement_text']; ?>
                                </div>

                            </div>
                            <div class="panel-footer">
                                <nav aria-label="...">
                                    <ul class="pager" >
                                        <li class="previous previous-tab"><a href="javascript:function() { return false; }" ><span aria-hidden="true">&larr;</span> Previous</a></li>
                                        <li class="next next-tab"><a href="javascript:function() { return false; }#">Next <span aria-hidden="true">&rarr;</span></a></li>
                                    </ul>

                                </nav>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            var pipsSlider<?php echo $value['id']; ?> = document.getElementById('slider-pips<?php echo $value['id']; ?>');
                            noUiSlider.create(pipsSlider<?php echo $value['id']; ?>, {
                                start: [<?php echo $value['standard_value']; ?>],
                                connect: true,
                                step: 0.125,
                                tooltips: [true, ],
                                range: {
                                    'min': <?php echo $value['min_value']; ?>,
                                    'max': <?php echo $value['max_value']; ?>
                                }
                            });
                            pipsSlider<?php echo $value['id']; ?>.noUiSlider.on('update', function (values, handle) {
                                var value = values[handle];
                                var mvalue = ("" + value).split(".")[0];
                                var frvalue = ("" + value).split(".")[1];
                                var frdict = {13: "1/8", 25: "1/4", 38: "3/8", 50: "1/2", 63: "5/8", 75: "3/4", 88: "7/8"};
                                var frmvalue = frdict[frvalue] ? frdict[frvalue] : '';

                                angular.element(document.getElementById("customizationPage")).scope().setMeasurements("<?php echo $value['title']; ?>", mvalue + ' ' + frmvalue)
                            });
                        })
                    </script>
                    <?php
                }
                ?>
                <div role="tabpanel" class="custom_form_tables tab-pane  " id="measurement_images" >
                    <!--custome element options-->
                    <div class="panel panel-default bodytransection">
                        <div class="panel-heading">Your Images</div>
                        <div class="panel-body ">
                            <div class="">
                                <p>Please insert images of your front & back, so we can get a better idea about your build for best fitting.</p>
                            </div>


                            <div class="col-md-6 col-md-padding5 " ng-repeat="(imgk, imgv) in measurementimagedata">
                                <h3 style="font-size: 19px;background:black;color:white;text-align: center;">{{imgk}}</h3>
                                <div class="thumbnail"   style="" >
                                    <img class="pant_controlZoom "  alt="">
                                    <div class="caption2 ">
                                        <input type="file" name="filemeasurement{{$index}}"  file-model="imgv" accept="image/*">
                                        <span style="font-size: 10px;">  Attach File From Here (JPG, PNG Allowed)</span>
                                        <input type="hidden" name="file_real_name" value="{{imgv.name}}" style="width: 100%;"/>
                                    </div>
                                </div>
                            </div>




                        </div>

                        <div class="panel-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>