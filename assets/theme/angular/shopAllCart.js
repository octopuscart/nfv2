nitaFasions.controller('shopAllCart', function ($scope, $http, $filter, $timeout) {

    $scope.shopCart = {
        "data":[],
        "itemslist":{},
        "itemnames": ["Shirt", "Tuxedo Shirt", "Tuxedo Pant", "Tuxedo Suit", "Tuxedo Jacket", "Suit", "3 Piece Suit", "Pant", "Jacket", "Waistcoat", "Sports Jacket", "Overcoat"],
    };

    $scope.getCartData().then(function (resdata) {
        var cartdata = resdata.cartdata.products;
        for(cind in cartdata){
            var cartobj = cartdata[cind];
            var tagname = cartobj.tag_title;
            console.log(cartobj)
            if ($scope.shopCart.itemnames.indexOf(tagname)>(-1)) {
                if($scope.shopCart.itemslist[tagname]){
                    $scope.shopCart.itemslist[tagname].push(cartobj);
                }
                else{
                    $scope.shopCart.itemslist[tagname] = [cartobj];
                }
                
            }
        }
    });




})
