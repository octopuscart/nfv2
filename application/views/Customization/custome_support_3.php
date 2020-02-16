<div class="col-md-2">
    <button class="btn btn-danger btn-lg bigbuttonspadding" ng-click="reset()" style="    width: 100%;">Reset</button>
    <div class="row bodymax500">
        <div class="col-md-12 selectedfabricscustomup  " ng-repeat="(itemk, cart) in customFabrics" >
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
        <div class="col-sm-5 mainelementtab">
            <button class="btn btn-success btn-lg bigbuttonspadding" ng-click="finishCustomisation()" style="    width: 100%;">Finish</button>

            <ul class="nav nav-tabs tabs-left vertialTab bodymax500" role="tablist" style=" height:700px ">
                <li role="presentation" class="{{$index==0?'active':''}} customtabblock" ng-repeat="(tagname, tagkey) in customizationElement.navigation">
                    <a class="" href="#custom{{$index}}" aria-controls="custom{{$index}}" role="tab" data-toggle="tab">
                        <span class="customtagname"> {{tagname}}  </span>
                        <span class="customtagvalue"> 
                            <span class="" ng-if="tagkey.choice == 'multi'">
                                <table ng-if="spacialSelection.style[tagname]">
                                    <tr ng-repeat="(itemr, itemst) in spacialSelection.itemstyle">
                                        <td>
                                            {{itemr}}
                                        </td>
                                        </td>
                                        <td >
                                            <span ng-if="!itemst[tagname]">
                                                {{customizationElement.selection[tagname]}} 
                                            </span>
                                            <span ng-if="itemst[tagname]">
                                                {{itemst[tagname]}}
                                            </span>
                                            <br/>
                                            <span class="extrapricesummary" ng-if="extraPriceSelection[tagname]">{{extraPriceSelection[tagname]|currency}} Extra</span> 
                                        </td>
                                    </tr>
                                </table>

                                <table ng-if="!spacialSelection.style[tagname]">
                                    <tr>
                                        <td >
                                            {{customizationElement.selection[tagname]}} 
                                            <br/>
                                            <span class="extrapricesummary" ng-if="extraPriceSelection[tagname]">{{extraPriceSelection[tagname]|currency}} Extra</span> 
                                        </td>
                                    </tr>
                                </table>
                            </span>
                            <span class="" ng-if="tagkey.choice != 'multi'">
                                <table>
                                    <tr>

                                        <td >
                                            {{customizationElement.selection[tagname]}} 
                                            <br/>
                                            <span class="extrapricesummary" ng-if="extraPriceSelection[tagname]">{{extraPriceSelection[tagname]|currency}} Extra</span> 
                                        </td>
                                    </tr>

                                </table>
                            </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-7">
            <div class="tab-content">
                <div role="tabpanel" class="custom_form_tables tab-pane {{$index==0?'active':''}} " id="custom{{$index}}" ng-repeat="(subelek, subelev) in customizationElement.navigation">
                    <!--custome element options-->

                    <div class="panel panel-default bodytransection">
                        <div class="panel-heading">{{subelek}}</div>
                        <div class="panel-body {{subelev.maxsize}} ">
                            <div class=" {{subelev.maxsize}} " ng-if='!subelev.view'>

                                <div class="col-md-{{subelev.col}} col-md-padding5 " ng-repeat="ele in customizationElement.formItems[subelek]" >
                                    <div class="thumbnail  style_selection  waves-effect ZoomIn  "  ng-click="selectStyle(subelek, (ele.lable | removeExtraSpace), ele)"  ng-class="(ele.lable | removeExtraSpace) == customizationElement.selection[subelek] ? 'selected' : 'deselect'" style="" >
                                        <img class="pant_controlZoom " src="{{ele.image}}" alt="">
                                        <div class="caption ">
                                            <h3 style="{{subelev.lablestyle}}" ng-bind-html="ele.title"></h3>
                                            <p ng-if="ele.extra_price" class="extrapricetext"> ({{ele.extra_price|currency}} Extra)</p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="  padding: 15px;" ng-if="subelev.view == 'text'">
                                <div class="col-md-3">
                                    <input type="text" id="monogram_1st" ng-model="customizationElement.selection[subelek]" class="form-control style_selection ng-pristine ng-untouched ng-valid" style="
                                           font-size: 21px;
                                           font-family: sans-serif;
                                           font-style: normal;
                                           width: 108px;
                                           ">
                                </div>
                                <div class="col-md-9" style="font-size: 12px;
                                     line-height: 14px;
                                     padding: 0px">

                                    A graphic symbol consisting of 2 or more letters combined (usually your initials)
                                    printed on stationery or embroidered on clothing.
                                </div>
                            </div>

                            <div class=" {{subelev.maxsize}} " ng-if="subelev.view == 'multi'">
                                <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #ddd;">
                                    <li role="presentation" class="{{$index==1?'active':''}}" ng-repeat="(mltkey, multiele) in customizationElement.formItems[subelek]">
                                        <a href="#{{$parent.$index}}{{$index}}" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                                            <img src="{{multiele[0].image}}" class="iconimg">  {{mltkey}}
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="
                                     /*background-color: rgba(232, 232, 232, 0.48);*/
                                     border: 1px solid #000;
                                     /* margin-top: 0px; */
                                     padding: 3px;
                                     margin-bottom: 15px;
                                     ">

                                    <div role="tabpanel" class="tab-pane  {{$index==1?'active':''}}" id="{{$parent.$index}}{{$index}}" ng-repeat="(mltkey, multiele) in customizationElement.formItems[subelek]">
                                        <div class=" owlslider owl-carousel owl-theme ">
                                            <div class="col-md1-{{subelev.col}} col-md-padding5 " ng-repeat="ele in multiele">
                                                <div class="thumbnail  style_selection  waves-effect ZoomIn  "  ng-click="selectStyle(subelek, mltkey + '-' + (ele.lable | removeExtraSpace), ele)"  ng-class="(ele.lable | removeExtraSpace) == customizationElement.selection[subelek] ? 'selected' : 'deselect'" style="" >
                                                    <img class="pant_controlZoom " src="{{ele.image}}" alt="">
                                                    <div class="caption ">
                                                        <h3 style="{{subelev.lablestyle}}" ng-bind-html="ele.title"></h3>
                                                        <p ng-if="ele.extra_price" class="extrapricetext">({{ele.extra_price|currency}} Extra)</p>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <center>
                                            <div class="customNavigation" style="margin-bottom: 10px;" ng-if="multiele.length > 4">
                                                <a class="btn btn-default btn-sm prev prevtrigger" >&larr;</a>
                                                <a class="btn btn-default btn-sm next nexttrigger">&rarr;</a>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>

                            <div class=" {{subelev.maxsize}} " ng-if="subelev.view == 'multicol'">
                                <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #ddd;">
                                    <li role="presentation" class="{{$index==1?'active':''}}" ng-repeat="(mltkey, multiele) in customizationElement.formItems[subelek]">
                                        <a href="#{{$parent.$index}}{{$index}}" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                                            <img src="{{multiele[0].image}}" class="iconimg">  {{mltkey}}
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="
                                     /*background-color: rgba(232, 232, 232, 0.48);*/
                                     border: 1px solid #000;
                                     /* margin-top: 0px; */
                                     padding: 3px;
                                     margin-bottom: 15px;
                                     ">
                                    <div role="tabpanel" class="tab-pane  {{$index==1?'active':''}}" id="{{$parent.$index}}{{$index}}" ng-repeat="(mltkey, multiele) in customizationElement.formItems[subelek]">
                                        <div class="row  ">
                                            <div class="col-md-{{subelev.col}} col-md-padding5 " ng-repeat="ele in multiele">
                                                <div class="thumbnail  style_selection  waves-effect ZoomIn  "  ng-click="selectStyle(subelek, (ele.lable | removeExtraSpace) + ' (' + mltkey + ')', ele)"  ng-class="(ele.lable | removeExtraSpace) == customizationElement.selection[subelek] ? 'selected' : 'deselect'" style="" >
                                                    <img class="pant_controlZoom " src="{{ele.image}}" alt="">
                                                    <div class="caption ">
                                                        <h3 style="{{subelev.lablestyle}}" ng-bind-html="ele.title"></h3>
                                                        <p ng-if="ele.extra_price" class="extrapricetext"> ({{ele.extra_price|currency}} Extra)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" {{subelev.maxsize}} " ng-if="subelev.view == 'multicol2'">
                                <ul class="nav nav-tabs innerSelectionTab" role="tablist" style="    border-bottom: 0px solid #ddd;">
                                    <li role="presentation" class="{{$index==1?'active':''}}" ng-repeat="(mltkey, multiele) in customizationElement.formItems[subelek]">
                                        <a href="#{{$parent.$index}}{{$index}}" aria-controls="contrast" role="tab" data-toggle="tab" style="background: #fff;color: #000;">
                                            <img src="{{multiele[0].image}}" class="iconimg">  {{mltkey}}
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="
                                     /*background-color: rgba(232, 232, 232, 0.48);*/
                                     border: 1px solid #000;
                                     /* margin-top: 0px; */
                                     padding: 3px;
                                     margin-bottom: 15px;
                                     ">
                                    <div role="tabpanel" class="tab-pane  {{$index==1?'active':''}}" id="{{$parent.$index}}{{$index}}" ng-repeat="(mltkey, multiele) in customizationElement.formItems[subelek]">
                                        <div class="row  ">
                                            <div class="col-md-{{subelev.col}} col-md-padding5 " ng-repeat="ele in multiele">
                                                <div class="thumbnail  style_selection  waves-effect ZoomIn  "  ng-click="selectStyle(subelek, (ele.lable | removeExtraSpace), ele)"  ng-class="(ele.lable | removeExtraSpace) == customizationElement.selection[subelek] ? 'selected' : 'deselect'" style="" >
                                                    <img class="pant_controlZoom " src="{{ele.image}}" alt="">
                                                    <div class="caption ">
                                                        <h3 style="{{subelev.lablestyle}}" ng-bind-html="ele.title"></h3>
                                                        <p ng-if="ele.extra_price" class="extrapricetext">({{ele.extra_price|currency}} Extra)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" {{subelev.maxsize}} " ng-if="subelev.view == 'selection'">
                                <div class="col-md-12 col-md-padding5 ">
                                    <div class=" style_selection  waves-effect ZoomIn  "    >
                                        <div class=" ">
                                            <select ng-model="customizationElement.formItems[subelek].title" style="height: 34px;padding: 0px 6px;border: 1px solid #000;"  ng-change="selectStyle(subelek, (customizationElement.formItems[subelek].title | removeExtraSpace), ele)">
                                                <option ng-repeat="(cck, ccv) in customizationElement.formItems[subelek].child" {{$index==0?"selected":""}} value="{{ccv}}">{{cck}}</option>
                                            </select>                                     
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" {{subelev.maxsize}} " ng-if="subelev.view == 'buttonview'">

                                <div class="col-md-{{subelev.col}} col-md-padding5 " ng-repeat="ele in customizationElement.formItems[subelek]" ng-if="!ele.child">
                                    <div class="thumbnail  style_selection  waves-effect ZoomIn  "  ng-click="selectStyle(subelek, (ele.lable | removeExtraSpace), ele)"  ng-class="(ele.lable | removeExtraSpace) == customizationElement.selection[subelek] ? 'selected' : 'deselect'" style="" >
                                        <img class="pant_controlZoom " src="{{ele.image}}" alt="" style="height: 77px;">
                                        <div class="caption ">
                                            <h3 style="{{subelev.lablestyle}}" ng-bind-html="ele.title" ></h3>
                                            <p ng-if="ele.extra_price" class="extrapricetext"> ({{ele.extra_price|currency}} Extra)</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-{{subelev.col}} col-md-padding5 " ng-repeat="ele in customizationElement.formItems[subelek]" ng-if="ele.child">
                                    <div class="thumbnail  style_selection  waves-effect ZoomIn  "  ng-click="selectStyle(subelek, (ele.lable | removeExtraSpace) + ' (' + ele.title + ')', ele)"  ng-class="(ele.lable | removeExtraSpace) == customizationElement.selection[subelek] ? 'selected' : 'deselect'" style="" >
                                        <img class="pant_controlZoom " src="{{ele.image}}{{ele.title}}.jpg" alt="" style="height: 77px;">
                                        <div class="caption " style="color:black">
                                            <div class="caption ">
                                                <h3 style="height: 15px;" ng-bind-html="ele.lable" ></h3>
                                                <p ng-if="ele.extra_price" class="extrapricetext"> ({{ele.extra_price|currency}} Extra)</p>

                                            </div>
                                            <select ng-model="ele.title" style="height:20px;">
                                                <option ng-repeat="btnch in ele.child" selected='{{$index==0?true:""}}' value="{{btnch}}">{{btnch}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end of options-->
                        </div>
                        <div class="panel-footer">

                            <div ng-if="subelev.choice">
                                <?php
                                $this->load->view('Customization/multichoiceblock');
                                ?>
                            </div>


                            <nav aria-label="...">
                                <ul class="pager" ng-if="subelev.prenext == 1">
                                    <li class="previous previous-tab"><a href="javascript:function() { return false; }" ><span aria-hidden="true">&larr;</span> Previous</a></li>
                                    <li class="next next-tab"><a href="javascript:function() { return false; }#">Next <span aria-hidden="true">&rarr;</span></a></li>
                                </ul>
                                <ul class="pager" ng-if="subelev.prenext == 0">
                                    <li class="next next-tab"><a href="javascript:function() { return false; }#">Next <span aria-hidden="true">&rarr;</span></a></li>
                                </ul>
                                <ul class="pager" ng-if="subelev.prenext == 2">
                                    <li class="previous previous-tab"><a href="javascript:function() { return false; }" ><span aria-hidden="true">&larr;</span> Previous</a></li>
                                    <li class="next next-tab"><a href="javascript:function() { return false; }#" style="color: white;    background: green;">Finish</a></li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>