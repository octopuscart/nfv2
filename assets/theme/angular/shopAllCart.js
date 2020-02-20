nitaFasions.controller('shopAllCart', function ($scope, $http, $filter, $timeout) {

    $scope.shopCart = {
        "data": [],
        "itemslist": {},
        "itemnames": ["Shirt", "Tuxedo Shirt", "Tuxedo Pant", "Tuxedo Suit", "Tuxedo Jacket", "Suit", "3 Piece Suit", "Pant", "Jacket", "Waistcoat", "Sports Jacket", "Overcoat"],
    };

    $scope.getCartData().then(function (resdata) {
        var cartdata = resdata.cartdata.products;
        console.log(cartdata)
        for (cind in cartdata) {
            var cartobj = cartdata[cind];
            var tagname = cartobj.tag_title;
            console.log(cartobj)
            if ($scope.shopCart.itemnames.indexOf(tagname) > (-1)) {
                if ($scope.shopCart.itemslist[tagname]) {
                    $scope.shopCart.itemslist[tagname].push(cartobj);
                } else {
                    $scope.shopCart.itemslist[tagname] = [cartobj];
                }

            }
        }
    });







})



nitaFasions.controller('shopAllCartCustom', function ($scope, $http, $filter, $timeout) {
    var currencyfilter = $filter('currency');
    $scope.shopCart = {
        "cartdata": {},
        "data": [],
        "itemslist": {},
        "itemnames": ["Shirt", "Tuxedo Shirt", "Tuxedo Pant", "Tuxedo Suit", "Tuxedo Jacket", "Suit", "3 Piece Suit", "Pant", "Jacket", "Waistcoat", "Sports Jacket", "Overcoat"],
    };
    $scope.getCustomData = function () {
        $scope.getCartDataCustom().then(function (resdata) {

            $scope.shopCart.cartdata = resdata.cartdata;
        });
    }
    $scope.getCustomData();


    $scope.subCartData = function (citem) {
        $scope.changeCartData(citem, 'sub').then(function () {
            $scope.getCustomData();
        });
    }

    $scope.plusCartData = function (citem) {
        $scope.changeCartData(citem, 'add').then(function () {
            $scope.getCustomData();
        });
    }

    $scope.removeCartData2 = function (cartd) {
        var form = new FormData()
        form.append('cart_id', cartd.id);
        $http.post(urllink + "/removeCart", form).then(function (rdata) {
            $scope.getCustomData();
        });
    }

    //address block
    $scope.userAddress = {selected: {}, list: [], "loader": "0", "user": {}};
    $scope.getUserAddress = function () {
        $scope.userAddress.loader = "1";
        $http.get(urllink + "/getUserShippingAddress").then(function (rdata) {
            $scope.userAddress.list = rdata.data.address;
            $scope.userAddress.user = rdata.data.user;
            if (rdata.data.address.length > 0) {
                $scope.userAddress.loader = "0";
            } else {
                $scope.userAddress.loader = "2";
            }
            if ($scope.userAddress.list.length == 1) {
                $scope.userAddress.selected = $scope.userAddress.list[0];
            }
            for (adind in rdata.data.address) {
                var addressobj = rdata.data.address[adind];
                if (addressobj.default_shipping_address == 'yes') {
                    $scope.userAddress.selected = addressobj;
                }
            }
        }, function () {
            $scope.userAddress.loader = "0";
        });
    }
    $scope.getUserAddress();
    //end of address block

    $scope.selectAddress = function (addressobj) {
        $scope.userAddress.selected = addressobj;
    }


    $scope.orderProcess = {
        "confirmcheck": false
    };

    $scope.viewStyle = function (objarray) {
        var customhtmlarray = [];
        var objarrayprice = objarray.style;
        for (i in objarrayprice) {
            var ks = i;
            var kv = objarrayprice[i];
            if (kv) {
                var summaryhtml = "<tr><th>" + ks + "</th><td>" + kv + "</td></tr>";
                customhtmlarray.push(summaryhtml);
            }
        }
        customhtmlarray = customhtmlarray.join("");
        var customdiv = "<div class='custome_summary_popup'><table>" + customhtmlarray + "</table></div>";
        swal({
            title: objarray['Style Profile'],
            html: customdiv,
        })
    }

    $scope.viewExtraPrice = function (objarray) {
        var customhtmlarray = [];
        var objarrayprice = objarray.extra_price;
        for (i in objarrayprice) {
            var ks = i;
            var kv = objarrayprice[i];
            if (kv) {
                var summaryhtml = "<tr><th>" + ks + "</th><td>" + currencyfilter(kv) + "</td></tr>";
                customhtmlarray.push(summaryhtml);
            }
        }
        customhtmlarray = customhtmlarray.join("");
        var customdiv = "<div class='custome_summary_popup'><table>" + customhtmlarray + "</table></div>";
        swal({
            title: objarray['Style Profile'],
            html: customdiv,
        })
    }


})
