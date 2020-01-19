nitaFasions.filter('removeExtraSpace', function () {
    return function (strings) {
        return strings.replace(/\s+/g, ' ').trim();
    };
});

nitaFasions.controller('customizationPage', function ($scope, $http, $filter, $timeout) {
    var urldata = "customizer_api.php?custom_item=" + itemidgbl;
    $scope.customizationElement = {};
    $scope.cartData = {};
    $scope.cartDataArray = [];
    $scope.defaultvalues = {};

    $scope.customFabrics = {};
    $scope.customFabricArraySelect = [];
    $scope.customFabricsDone = {};
    $scope.customFabricsArray = [];
    $scope.customFabricsArrayDone = [];

    $scope.finishCustomisation = function () {
         $scope.customFabricArraySelect = [];
         $scope.customFabricsArrayDone = [];
        var customitems = [];
        for (cart in $scope.customFabrics) {
            $scope.customFabricsDone[cart] = $scope.customFabrics[cart];
            customitems.push($scope.customFabrics[cart].item.id);
            $scope.customFabricsArrayDone.push($scope.customFabrics[cart].item.id);
        }
        var stringitem = customitems.join(",");
        $http.get("customizer_api.php?customizationdon=" + stringitem).then(function () {

        })

        $scope.customFabrics = {};
        $scope.customFabricsArray = [];
        $('#fabricModel').modal('show');
        $timeout(function () {
            console.log($scope.defaultvalues);
            $scope.customizationElement.selection = angular.copy($scope.defaultvalues);
        }, 500)

    }


    $scope.getStyle = function () {
        $http.get(urldata).then(function (rdata) {
            $scope.customizationElement = rdata.data;
            $scope.customizationElement.item;
            $scope.defaultvalues = angular.copy(rdata.data.selection);

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
        })
    }
    $scope.getStyle();



    $(document).on('click', '.prevtrigger', function () {
        $($(this).parents()[2]).find(".owl-carousel").trigger('owl.prev')
    });
    $(document).on('click', '.nexttrigger', function () {
        $($(this).parents()[2]).find(".owl-carousel").trigger('owl.next')
    });


    $('#fabricModel').modal('show')


    $scope.selectStyle = function (stylep, stylec, style) {
        $scope.customizationElement.selection[stylep] = stylec;
        if (style.child) {
            for (ch in style.child) {
                $scope.customizationElement.selection[ch] = style.child[ch];
            }
        }
        for (item in $scope.customFabrics) {
            $scope.customFabrics[item]['style'] = $scope.customizationElement.selection;
        }

    }


    $scope.reset = function () {
        window.location.reload();
    }

    $scope.selectFabric = function (item) {
        
        if ($scope.customFabrics[item.title]) {
            delete  $scope.customFabrics[item.title];
        } else {
             $scope.customFabricArraySelect.push(item);
            $scope.customFabrics[item.title] = {"item": item, "style": $scope.customizationElement.selection};
        }


    }

    $scope.startCustom = function () {
        $scope.customFabricsArray = [];
        for (itm in $scope.customFabrics) {
            $scope.customFabricsArray.push(itm)
        }
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





    $scope.getcartDataGbl().then(function (cdata) {
        for (cd in cdata) {
            var cobj = cdata[cd];
            if (cobj.tag_id == itemidgbl) {
                console.log(cobj.title)
                $scope.cartData[cobj.title] = {"item": cobj, "style": ""};
                console.log($scope.cartData)
                $scope.cartDataArray.push(cobj);
            }

        }
    })

    console.log(itemidgbl);

})