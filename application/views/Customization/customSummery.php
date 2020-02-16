<div class="" ng-if="customFabricsArrayDone.length">
    <div class="col-md-12">
        <ul class="nav nav-tabs " role="tablist" style="    border-bottom: 0px solid #ddd;">
            <li role="presentation" class="{{$index==0?'active':''}} " ng-repeat="(cartk, cart) in customFabricsDone">
                <a class="" href="#customdone{{$index}}" aria-controls="customdone{{$index}}" role="tab" data-toggle="tab">{{cartk}} </a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="custom_form_tables tab-pane {{$index==0?'active':''}} " id="customdone{{$index}}" ng-repeat="(cartk, cart) in customFabricsDone">
                <ul class="nav nav-tabs tabs-left vertialTab">
                    <li class="list-group-item summaryelement">
                        <h3>{{cart['Style Profile']}}</h3>
                    </li>
                    <li class=" customtabblock" ng-repeat="(elementk, elementv) in cart.style">
                        <a class="" href="#" role="tab" data-toggle="tab">
                            <span class="customtagname"> {{elementk}}  </span>
                            <span class="customtagvalue"> {{elementv}} <br/>
                            <span class="extrapricesummary" ng-if="cart.extra_price[elementk]">{{cart.extra_price[elementk]|currency}} Extra</span> 
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>