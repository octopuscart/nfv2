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

    $scope.shopCart = {
        "cartdata": {},
        "data": [],
        "itemslist": {},
        "itemnames": ["Shirt", "Tuxedo Shirt", "Tuxedo Pant", "Tuxedo Suit", "Tuxedo Jacket", "Suit", "3 Piece Suit", "Pant", "Jacket", "Waistcoat", "Sports Jacket", "Overcoat"],
    };
    $scope.getCustomData = function () {
        $scope.getCartDataCustom().then(function (resdata) {
            console.log(resdata.cartdata);
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



})
