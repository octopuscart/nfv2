
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
    var urldatastorestyle = customlink + "/customProfileAttributeInsert";
    $scope.customizationElement = {};
    $scope.cartData = {};
    $scope.cartDataArray = [];
    $scope.defaultvalues = {};
    $scope.cartTitleIds = {};

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

    $(".customblockstart").hide();
    $(".measurementblockstart").hide();

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
        var styleno = $scope.customizationElement.item + "/" + moment().format('YYYY/MM/DD/HMS');
        $scope.insertDataArray['profile'] = styleno;
        var cartidslist = [];
        for (item in $scope.customFabrics) {
            console.log(item)
            var itemobj = $scope.customFabrics[item];
            cartidslist.push(itemobj.item.id);
            $scope.customFabricsArrayDone.push(item);
            $scope.customFabricsDone[item] = {"style": {}, "Style Profile": styleno, "item": itemobj.item};
            $scope.customFabricsDone[item].style = angular.copy($scope.customizationElement.selection);
        }
        $scope.insertDataArray['cart_id'] = cartidslist.join(",");
        for (kv in $scope.customizationElement.selection) {
            var stylev = $scope.customizationElement.selection[kv];
            $scope.insertDataArray['stylekey_' + kv] = stylev;
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
        var form = new FormData()
        for (kv in $scope.insertDataArray) {
            form.append(kv, $scope.insertDataArray[kv]);
        }
        form.append("tag_id", itemidgbl);
        form.append("styletype", "custom");
        $http.post(urldatastorestyle, form).then(function () {
            swal({
                title: "Style Saved",
                type: "sucess",
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

        form.append("styletype", prestyle.id);
        $http.post(urldatastorestyle, form).then(function () {
            $http.post(urldatastorestyle, form).then(function () {
                swal({
                    title: "Style Saved",
                    type: "sucess",
                    html: "",
                    timer: 1500,
                    showConfirmButton: false,
                    animation: true

                })

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
                    type: "sucess",
                    html: "",
                    timer: 1500,
                    showConfirmButton: false,
                    animation: true

                })

            })
        })
    }




    $scope.measurementimagedata = {"Front": {}, "Back": {}, "Left Side": {}, "Right Side": {}};
    $scope.mesurementdata = {"setting": {}, "selection": {}, "posture": {}, "posture_selection": {}, "user_images": []};

    $http.get(customlink + "/customMeausrementApiByItem/" + itemidgbl).then(function (mesdata) {
        console.log(mesdata.data)
        $scope.mesurementdata.setting = mesdata.data.measurementdata;
        $scope.mesurementdata.selection = angular.copy(mesdata.data.standerd);
        $scope.mesurementSelecttion = angular.copy(mesdata.data.standerd);
        $scope.mesurementdata.posture = angular.copy(mesdata.data.posturedata);
        $scope.customProfileArray = angular.copy(mesdata.data.customProfileArray);
        for (post in $scope.mesurementdata.posture) {
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
        var next = jQuery('.nav-tabs > .active').next('li');
        if (next.length) {
            $scope.initAnimate.sumtop += 50;
            next.find('a').trigger('click');
        } else {
            jQuery('#myTabs a:first').tab('show');
        }
    });

    jQuery('body').on('click', '.previous-tab', function () {
        var prev = jQuery('.nav-tabs > .active').prev('li')
        if (prev.length) {
            $scope.initAnimate.sumtop -= 50;
            prev.find('a').trigger('click');
        } else {
            jQuery('#myTabs a:last').tab('show');
        }
    });




    $scope.selectStyle = function (stylep, stylec, style) {
        $scope.customizationElement.selection[stylep] = stylec;
        var next = jQuery('.mainelementtab .nav-tabs > .active').next('li');
        next.find('a').trigger('click');

    }


    $scope.reset = function () {
        window.location.reload();
    }

    $scope.selectFabric = function (item) {
        console.log(item.title)
        if ($scope.customFabrics[item.title]) {
            delete  $scope.customFabrics[item.title];
        } else {
            $scope.customFabrics[item.title] = {"item": item, "style": $scope.customizationElement.selection};
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
            $scope.cartData[cobj.title] = {"item": cobj, "style": ""};
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
            $scope.mesurementSelecttion['Height'] = feetval;
        })

        console.log(feetval);

    });

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



})