
var nitaFasions = angular.module('NitaFashions', []).config(function ($httpProvider) {
    $httpProvider.defaults.headers.common = {};
    $httpProvider.defaults.headers.post = {};
});
nitaFasions.controller('rootController', function ($scope, $http, $filter, $timeout, $q) {
     $scope.initApp = {"maincart": {}};
    $scope.getCartData = function () {
        $http.get(urllink + "/getCartData").then(function (rdata) {
            $scope.initApp.maincart = rdata.data;
        }, function () {})
    }

   

    var currencyfilter = $filter('currency');

    $scope.addTocart = function (product_id, item_id) {
        swal({
            title: 'Adding to Cart',
            onOpen: function () {
                swal.showLoading()
            }
        });
        var form = new FormData()
        form.append('product_id', product_id);
        form.append('item_id', item_id);
        $http.post(urllink + "/addToCart", form).then(function (rdata) {
            var status = rdata.data;
            var product = rdata.data.product;

            swal({
                title: status.msg,
                type: status.type,
                html: "<p class='swalproductdetail'><span>" + product.title + "</span><br>" + "Total Price: " + currencyfilter(product.total_price, "US$ ") + ", Quantity: " + product.quantity + "</p>",
                imageUrl: product.image,
                imageWidth: 100,
                timer: 1500,
//                 background: '#fff url(//bit.ly/1Nqn9HU)',
                imageAlt: 'Custom image',
                showConfirmButton: false,
                animation: true

            })


        }, function () {})

    }

    console.log(urllink)
})
