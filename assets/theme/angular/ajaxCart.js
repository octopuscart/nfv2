nitaFasions.filter('CartTotal', function () {
    return function (data, key) {
        if (angular.isUndefined(data) && angular.isUndefined(key))
            return 0;
        var sum = 0;
        angular.forEach(data, function (value) {

            if (value) {
                if (key == 'price') {
                    sum = sum + (parseInt(value[key]) * parseInt(value['quantity']));
                } else {
                    sum = sum + parseInt(value[key]);
                }
            }
        });
        return sum;
    }
});
nitaFasions.controller('AjaxCart', function ($scope, $http, $filter, $timeout, $q) {
    $scope.cartDataGbl = {
        "cartproducts": [],
        "itemcart": {},
        "itemnames":["Shirt", "Tuxedo Shirt", "Tuxedo Pant", "Tuxedo Suit", "Tuxedo Jacket", "Suit", "3 Piece Suit", "Pant", "Jacket", "Waistcoat", "Sports Jacket", "Overcoat"],
    };
    var urlcarturl = 'ajaxController.php?session_id=1';
    if (checklogingbl) {
        var urlcarturl = 'ajaxController.php?checkCart=nfw_product_cart&user_id=' + checklogingbl;
    }

    $scope.getcartDataGbl = function () {
        var deferred = $q.defer();
        $http.get(urlcarturl).then(function (rdata) {
            $scope.cartDataGbl.cartproducts = rdata.data
             deferred.resolve($scope.cartDataGbl.cartproducts);
           
        })
        return deferred.promise;
    }
})
