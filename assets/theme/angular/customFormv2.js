
nitaFasions.filter('removeExtraSpace', function () {
    return function (strings) {
        return strings.replace(/\s+/g, ' ').trim();
    };
});

nitaFasions.filter('removeSpace', function () {
    return function (strings) {
        return strings.replace(/\s/g, '_').trim();
    };
});





nitaFasions.controller('customizationPage', function ($scope, $http, $filter, $timeout) {
    var urldata = customlink + "/" + customlinkitem;
    console.log(urldata);
    var urldatastorestyle = customlink + "/customProfileAttributeInsert2";
    $scope.customizationElement = {};
    $scope.cartData = {};
    $scope.cartDataArray = [];
    $scope.defaultvalues = {};
    $scope.cartTitleIds = {};
    $scope.extraPriceSelection = {};

    $scope.initAnimate = {
        "sumtop": 0,
        "startcustom": 0,
    }

    $scope.customFabrics = {};
    $scope.customFabricArraySelect = [];
    $scope.customFabricsDone = {};
    $scope.customFabricsArray = [];
    $scope.customFabricsArrayDone = [];
    $scope.mesurementSelecttion = {};
    $scope.mesurementSelecttionFrc = {};
    $scope.customProfileArray = [];
    $scope.validatiaons = {};

    $(".customblockstart").hide();
    $(".measurementblockstart").hide();

    //spacilaselection option
    $scope.spacialSelection = {"itemstyle": {}, "itemextraprice": {}, "style": {}, "itemid": {}, "activestyle": {"skye": "", "svalue": ""}, "defaultstyle": {}};
    $scope.changeSpacialSelection = function (itemname) {
        $scope.spacialSelection.itemstyle[itemname];
        var activestyle = $scope.spacialSelection.activestyle.skye;
        var activestylevalue = $scope.spacialSelection.activestyle.svalue;
        $scope.spacialSelection.itemstyle[itemname][activestyle] = activestylevalue;
        $scope.spacialSelection.style[activestyle][itemname] = activestylevalue;

    }
//end of spaicalselection


    $scope.insertDataArray = {};


    $scope.setMeasurements = function (title, value) {
        $timeout(function () {
            $scope.mesurementSelecttion[title] = value;
            var frcval = value.split(" ");
            var mainvalue = frcval[0];
            var frcvalue = 0
            if (value.length > 1) {
                frcvalue = frcval[1];
            }
            $scope.mesurementSelecttionFrc[title] = [mainvalue, frcvalue];
        }, 100)
    }


    $scope.setPosture = function (title, value) {
        $scope.mesurementdata.posture_selection[title] = value;
    }

    $scope.finishCustomisation = function () {
        var styleno = $scope.customizationElement.item + "/" + moment().format('YYYY/MM/DD/');
        $scope.insertDataArray['profile'] = styleno;
        var cartidslist = [];

        for (item in $scope.customFabrics) {
            console.log(item)
            var itemobj = $scope.customFabrics[item];
            cartidslist.push(itemobj.item.id);
            $scope.customFabricsArrayDone.push(item);
            //summary Perpose
            $scope.customFabricsDone[item] = {"style": {}, "Style Profile": styleno + itemobj.item.id, "item": itemobj.item, "extra_price": {}};
            $scope.customFabricsDone[item].style = angular.copy($scope.customizationElement.selection);
            $scope.customFabricsDone[item].extra_price = angular.copy($scope.extraPriceSelection);
            //

            //use for database insertion


            var extraitem = $scope.spacialSelection.itemstyle[item];
            for (exk in extraitem) {
                var exv = extraitem[exk];
                $scope.customFabricsDone[item].style[exk] = exv;

                var exppriceobj = $scope.spacialSelection.itemextraprice[item][exk];
                $scope.customFabricsDone[item].extra_price[exk] = exppriceobj;
            }
        }

        var insertObjectArray = {};
        for (sitem in $scope.customFabricsDone) {
            var itemobj = $scope.customFabricsDone[sitem];
            var item_id = itemobj.item.id;
            for (stk  in itemobj.style) {
                var strstk = stk;
                var strstv = itemobj.style[stk];
                var extra_price = itemobj.extra_price[stk];
                insertObjectArray[item_id + "___" + strstk] = strstv + "___" + (extra_price ? extra_price : 0);

            }

        }

        $scope.insertDataArray['cart_id'] = cartidslist.join(",");
        for (kv in $scope.customizationElement.selection) {
            var stylev = $scope.customizationElement.selection[kv];
            var eprice = $scope.extraPriceSelection[kv] ? $scope.extraPriceSelection[kv] : '';
            $scope.insertDataArray['stylekey_' + kv] = stylev + "EXP" + eprice;
        }
        $scope.customFabrics = {};
        $scope.customFabricArraySelect = [];
        $scope.initAnimate.startcustom = 0;
        $(".customblockstart").hide();
        swal({
            title: 'Saving Style...',
            onOpen: function () {
                swal.showLoading()
            }
        });
        insertObjectArray['tag_id'] = itemidgbl;
        insertObjectArray['styletype'] = "custom";
        insertObjectArray['profile'] = styleno;

        var form = new FormData()
        for (kv in insertObjectArray) {
            form.append(kv, insertObjectArray[kv]);
        }

        $http.post(urldatastorestyle, form).then(function () {
            swal({
                title: "Style Saved",
                type: "success",
                html: "",
                timer: 1500,
                showConfirmButton: false,
                animation: true

            })

        });

    }




    $scope.applyPreStyle = function (prestyle) {
        swal({
            title: 'Saving Style...',
            onOpen: function () {
                swal.showLoading()
            }
        });
        var cartidslist = [];
        var form = new FormData();
        var styledict = {};
        for (st in prestyle.style) {
            var stobj = prestyle.style[st];
            styledict[stobj.style_key] = stobj.style_value;
        }

        for (item in $scope.customFabrics) {
            var itemobj = $scope.customFabrics[item];
            $scope.customFabricsArrayDone.push(item);
            cartidslist.push(itemobj.item.id);
            $scope.customFabricsDone[item] = {"style": styledict, "Style Profile": prestyle.profile, "item": itemobj.item, "Measurement Profile": {}};
        }


        $scope.customFabrics = {};
        $scope.customFabrics = {};
        $scope.customFabricArraySelect = [];
        $scope.initAnimate.startcustom = 0;
        $scope.initAnimate.startcustom = 0;
        form.append("cart_id", cartidslist.join(","));
        form.append("tag_id", itemidgbl);
        form.append("profile", prestyle.profile);
        form.append("styleid", prestyle.id);
        form.append("styletype", "previous");
        $http.post(urldatastorestyle, form).then(function () {
            $http.post(urldatastorestyle, form).then(function () {
                swal({
                    title: "Style Saved",
                    type: "success",
                    html: "",
                    timer: 1500,
                    showConfirmButton: false,
                    animation: true

                });
                $timeout(function () {
                    $("#styleModal").modal("hide");
                }, 2500)


            })
        })
    }

    $scope.shopStored = function () {
        swal({
            title: 'Saving Style...',
            onOpen: function () {
                swal.showLoading()
            }
        });
        var cartidslist = [];
        var form = new FormData()
        for (item in $scope.customFabrics) {
            var itemobj = $scope.customFabrics[item];
            $scope.customFabricsArrayDone.push(item);
            cartidslist.push(itemobj.item.id);
            $scope.customFabricsDone[item] = {"style": {}, "Style Profile": "Shop Stored", "item": itemobj.item, "Measurement Profile": {}};
        }
        $scope.customFabrics = {};
        $scope.customFabrics = {};
        $scope.customFabricArraySelect = [];
        $scope.initAnimate.startcustom = 0;
        $scope.initAnimate.startcustom = 0;
        form.append("cart_id", cartidslist.join(","));
        form.append("tag_id", itemidgbl);
        form.append("profile", "Shop Stored");
        form.append("styletype", "shop_stored");
        $http.post(urldatastorestyle, form).then(function () {
            $http.post(urldatastorestyle, form).then(function () {
                swal({
                    title: "Style Saved",
                    type: "success",
                    html: "",
                    timer: 1500,
                    showConfirmButton: false,
                    animation: true

                })

            })
        })
    }




    $scope.measurementimagedata = {"Front": {}, "Back": {}, "Left Side": {}, "Right Side": {}};
    $scope.mesurementdata = {"setting": {}, "selection": {}, "posture": {}, "posture_selection": {}, "user_images": [], "measurementProfile": {}};

    $http.get(customlink + "/customMeausrementApiByItem/" + itemidgbl).then(function (mesdata) {
        console.log(mesdata.data)
        $scope.mesurementdata.setting = mesdata.data.measurementdata;
        $scope.mesurementdata.selection = angular.copy(mesdata.data.standerd);
        $scope.mesurementSelecttion = angular.copy(mesdata.data.standerd);
        $scope.mesurementdata.posture = angular.copy(mesdata.data.posturedata);
        $scope.customProfileArray = angular.copy(mesdata.data.customProfileArray);
        $scope.mesurementdata.measurementProfile = angular.copy(mesdata.data.measurementProfileArray);
        for (post in $scope.mesurementdata.posture) {
            console.log(post)
            $scope.mesurementdata.posture_selection[post] = "-";
        }
        for (mes in $scope.mesurementSelecttion) {
            $scope.mesurementSelecttionFrc[mes] = [$scope.mesurementSelecttion[mes], 0];
        }
        $scope.mesurementSelecttionFrc["Weight"] = $scope.mesurementSelecttion["Weight"].split(" ")[0];
    })


    $scope.getStyle = function () {
        $http.get(urldata).then(function (rdata) {
            $scope.customizationElement = rdata.data;
            $scope.defaultvalues = angular.copy(rdata.data.selection);
            $scope.validatiaons = angular.copy(rdata.data.validation);
            var styleobjdata = rdata.data.navigation
            for (stylep in styleobjdata) {
                var styleobj = styleobjdata[stylep];
                if (styleobj.choice == 'multi') {
                    $scope.spacialSelection.defaultstyle[stylep] = $scope.defaultvalues[stylep]

                }
            }
        })
    }
    $scope.getStyle();


    $(document).on('click', '.prevtrigger', function () {
        $($(this).parents()[2]).find(".owl-carousel").trigger('owl.prev')
    });
    $(document).on('click', '.nexttrigger', function () {
        $($(this).parents()[2]).find(".owl-carousel").trigger('owl.next')
    });


    jQuery('body').on('click', '.next-tab', function () {
        var next = jQuery('.vertialTab > .active').next('li');
        if (next.length) {
            $scope.initAnimate.sumtop += 50;
            next.find('a').trigger('click');
        } else {
            jQuery('#myTabs a:first').tab('show');
        }
    });

    jQuery('body').on('click', '.previous-tab', function () {
        var prev = jQuery('.vertialTab > .active').prev('li')
        if (prev.length) {
            $scope.initAnimate.sumtop -= 50;
            prev.find('a').trigger('click');
        } else {
            jQuery('#myTabs a:last').tab('show');
        }
    });

    $scope.monogramValidation = function () {
        var monogramvalidate = ["Monogram Style", "Monogram Color", "Monogram Initial"];

        if ($scope.customizationElement.selection['Monogram Placement'] == 'No Monogram') {
            for (mn in monogramvalidate) {
                var mnobj = monogramvalidate[mn];
                console.log(mnobj)
                $scope.customizationElement.selection[mnobj] = "-";
            }

        }
    }

    $scope.selectStyle = function (stylep, stylec, style, itemname) {
        console.log(style, stylep);
        $scope.customizationElement.selection[stylep] = stylec;

        $scope.extraPriceSelection[stylep] = Number(style['extra_price']) ? style.extra_price : '';

        if (itemname) {
            $scope.spacialSelection.itemstyle[itemname][stylep] = stylec;
            $scope.spacialSelection.itemextraprice[itemname][stylep] = Number(style['extra_price']) ? style.extra_price : '';
        }

        if ($scope.validatiaons[stylep]) {

            var validation = $scope.validatiaons[stylep].validate;
            var pointer = $scope.validatiaons[stylep].pointer;
            if (validation[stylec]) {
                for (ele in validation[stylec]) {
                    var customelements = $scope.customizationElement.formItems[ele]
                    var subelement = validation[stylec][ele];
                    for (cele in customelements) {
                        var cobj = customelements[cele];
                        var pntv = pointer[ele];
                        $scope.customizationElement.selection[ele] = pntv;
                        if (subelement.indexOf(cobj.title) > (-1)) {
                            cobj.status = 0;

                        }

                    }
                }
            } else {
                for (pnt in pointer) {
                    var pntv = pointer[pnt];
                    var customelements = $scope.customizationElement.formItems[pnt]
                    $scope.customizationElement.selection[pnt] = pntv;
                    for (cele in customelements) {
                        var cobj = customelements[cele];

//                        cobj.status = 1;

                    }
                }

            }
        }
        $timeout(function () {
            $scope.monogramValidation();
        }, 500)
        var next = jQuery('.mainelementtab .nav-tabs > .active').next('li');
//        next.find('a').trigger('click');
    }


    $scope.reset = function () {
        window.location.reload();
    }

    $scope.selectFabric = function (item) {
        if ($scope.customFabrics[item.title]) {
            delete  $scope.customFabrics[item.title];
            delete $scope.spacialSelection.itemstyle[item.title];
            delete $scope.spacialSelection.itemextraprice[item.title];
        } else {
            $scope.spacialSelection.itemextraprice[item.title] = {};
            $scope.spacialSelection.itemstyle[item.title] = angular.copy($scope.spacialSelection.defaultstyle);
            $scope.customFabrics[item.title] = {"item": item, "style": $scope.customizationElement.selection, "extra_price": {}};
        }
        $scope.customFabricArraySelect = Object.keys($scope.customFabrics);
    }



    $scope.startCustom = function () {
        $(".measurementblockstart").hide();
        $scope.customFabricsArray = [];
        $scope.initAnimate.startcustom = 1;
        $(".customblockstart").show();
        $timeout(function () {
            var owl = $(".owlslider");
            owl.owlCarousel({
                pagination: false,
                items: 3, //10 items above 1000px browser width
                itemsDesktop: [1000, 5], //5 items between 1000px and 901px
                itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                itemsTablet: [600, 2], //2 items between 600 and 0
                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
            });
        })
    }

    $scope.backToCustomization = function () {
        $(".measurementblockstart").hide();
        $(".customblockstart").hide();
        $scope.initAnimate.startcustom = 0;
    }

    $scope.startMeasurements = function () {
//        $(".measurementblockstart").show();
        $(".customblockstart").hide();
        $scope.initAnimate.startcustom = 2;
    }

    $scope.$watch("customFabricsArrayDone", function (n, o) {
        console.log(n.length, $scope.cartDataArray.length)
        if (n.length == $scope.cartDataArray.length) {
//             $scope.startMeasurements();
        }
    })

    $scope.startMeasurementsCustom = function () {
        $(".measurementblockstart").show();
        $(".customblockstart").hide();
        $scope.initAnimate.startcustom = 1;
    }


    $scope.getCartData().then(function (resdata) {
        var cdata = resdata.cartcustom2;
        $scope.cartTitleIds = resdata.cartcustom[itemidgbl];
        console.log($scope.cartTitleIds);
        var customfablist = [];
        var cartDataTemp = {};
        for (cd in $scope.cartTitleIds) {
            var cobj = $scope.cartTitleIds[cd];
            $scope.cartDataArray.push(cobj);
            $scope.cartData[cobj.title] = {"item": cobj, "style": "", "extra_price": {}};
        }

    })



    var pipsSliderpips_height = document.getElementById('slider-pips_height');
    noUiSlider.create(pipsSliderpips_height, {
        start: [5],
        connect: true,
        step: 0.1,
        tooltips: [true, ],
        range: {
            'min': 3,
            'max': 8
        }
    });
    pipsSliderpips_height.noUiSlider.on('update', function (values, handle) {
        var value = values[handle];
        var mvalue = ("" + value).split(".")[0];
        var frvalue = ("" + value).split(".")[1];
        var frmvalue = frvalue / 10;
        var inchval = frmvalue ? " " + frmvalue + " Inches" : "";
        var feetval = mvalue + " Feet" + inchval;

        $timeout(function () {
           // $scope.mesurementSelecttion['Height'] = feetval;
        })

        console.log(feetval);

    });
	
	
    $scope.$watch("temp_height_f", function (n, o) {
        var inchval = $scope.temp_height_inc ? " " + $scope.temp_height_inc + " Inches" : "";
        var feetval = $scope.temp_height_f + " Feet" + inchval;
        $scope.mesurementSelecttion['Height'] = feetval;

    })
    
     $scope.$watch("temp_height_inc", function (n, o) {
        var inchval = $scope.temp_height_inc ? " " + $scope.temp_height_inc + " Inches" : "";
        var feetval = $scope.temp_height_f + " Feet" + inchval;
        $scope.mesurementSelecttion['Height'] = feetval;

    })

    $scope.measurementWeightUnit = {'unit': 'KG'};
    $scope.changeWeightUnit = function () {
        $timeout(function () {
            console.log($scope.measurementWeightUnit);
            $scope.mesurementSelecttion['Weight'] = $scope.mesurementSelecttionFrc['Weight'] + " " + $scope.measurementWeightUnit.unit;
        })
    }
    var pipsSliderpips_weight = document.getElementById('slider-pips_weight');
    noUiSlider.create(pipsSliderpips_weight, {
        start: [70],
        connect: true,
        step: 1,
        tooltips: [true, ],
        range: {
            'min': 20,
            'max': 400
        }
    });
    pipsSliderpips_weight.noUiSlider.on('update', function (values, handle) {
        var value = values[handle];
        var mvalue = ("" + value).split(".")[0];
        $timeout(function () {
            console.log($scope.measurementWeightUnit);
            $scope.mesurementSelecttion['Weight'] = mvalue + " " + $scope.measurementWeightUnit.unit;
            $scope.mesurementSelecttionFrc['Weight'] = mvalue;
        })
    });





    var pipsSliderpips_age = document.getElementById('slider-pips_age');
    noUiSlider.create(pipsSliderpips_age, {
        start: [25],
        connect: true,
        step: 1,
        tooltips: [true, ],
        range: {
            'min': 5,
            'max': 110
        }
    });
    pipsSliderpips_age.noUiSlider.on('update', function (values, handle) {
        var value = values[handle];
        var mvalue = ("" + value).split(".")[0];
        $timeout(function () {
            $scope.mesurementSelecttion['Age'] = mvalue;

        })
    });

//    $scope.onloadcheck = function () {
//        console.log("check loading");
//        window.onbeforeunload = function () {
//            return 'Are you sure you want to leave? Your current style will be losted...';
//        };
//    }
//    
//    $timeout(function(){
//         $scope.onloadcheck();
//    },3000)
   



})