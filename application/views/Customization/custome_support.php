
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
         <div class="col-md-7">
            <div class="tab-content">
                <div role="tabpanel" class="custom_form_tables tab-pane {{$index==0?'active':''}} " id="custom{{$index}}" ng-repeat="(subelek, subelev) in customizationElement.navigation">
                    <div class="" ng-if="subelev.choice != 'multi'">
                        <?php
                        $this->load->view('Customization/customizationBlockSelection', array("mutliview" => 0));
                        ?>
                    </div>
                    <div class="" ng-if="subelev.choice == 'multi'">
                        <div class="" ng-repeat="(item, itemstyle) in spacialSelection.itemstyle">
                            <?php
                            $this->load->view('Customization/customizationBlockSelectionMulti', array("mutliview" => 1));
                            ?>
                        </div>
                    </div>
                    <div class="panel-footer">
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
                                <li class="next next-tab"><a href="javascript:function() { return false; }#" style="color: white;    background: green;" ng-click="finishCustomisation()">Finish</a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5 mainelementtab">

            <ul class="nav nav-tabs tabs-left vertialTab  singletag" role="tablist" style=" ">
                <li role="presentation" class="{{$index==0?'active':''}} customtabblock" ng-repeat="(tagname, tagkey) in customizationElement.navigation">
                    <a class="" href="#custom{{$index}}" aria-controls="custom{{$index}}" role="tab" data-toggle="tab">

                        <div class="" ng-if="tagkey.choice != 'multi'">
                            <span class="customtagname"> {{tagname}}  </span>
                            <span class="customtagvalue"> 
                                {{customizationElement.selection[tagname]}} 
                                <br/>
                                <span class="extrapricesummary" ng-if="extraPriceSelection[tagname]">{{extraPriceSelection[tagname]|currency}} Extra</span> 
                            </span>
                        </div>
                        <div class="" ng-if="tagkey.choice == 'multi'">
                            <div ng-repeat="(item, itemstyle) in spacialSelection.itemstyle">
                                <span class="customtagname">{{item}} - {{tagname}}  </span>
                                <span class="customtagvalue"> 
                                    {{spacialSelection.itemstyle[item][tagname]}} 
                                    <br/>

                                    <span class="extrapricesummary" ng-if="spacialSelection.itemextraprice[item][tagname]">{{spacialSelection.itemextraprice[item][tagname]|currency}} Extra</span> 
                                </span>
                            </div>
                        </div>


                    </a>
                </li>


            </ul>
            <button class="btn btn-success btn-lg bigbuttonspadding" style="    margin-top: 16px;" ng-click="finishCustomisation()" style="    width: 100%;">Finish</button>


        </div>
       
    </div>
</div>