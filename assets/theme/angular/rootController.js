
var nitaFasions = angular.module('NitaFashions', ['ngSanitize']).config(function ($httpProvider) {
    $httpProvider.defaults.headers.common = {};
    $httpProvider.defaults.headers.post = {};
});

nitaFasions.directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;
                console.log(model);
                element.bind('change', function () {
                    scope.$apply(function () {
                        function imageIsLoaded(e) {
                     
                           $(element[0]).parents(".thumbnail").find("img").attr('src', e.target.result);
                        }
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(element[0].files[0]);
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }]);


nitaFasions.controller('rootController', function ($scope, $http, $filter, $timeout, $q) {
    $scope.initApp = {"maincart": {}};
    $scope.getCartData = function () {
        var deferred = $q.defer();
        $http.get(urllink + "/getCartData").then(function (rdata) {
            deferred.resolve(rdata.data)
        }, function () {
            deferred.resolve([]);
        })
        return deferred.promise;
    }

    $scope.cartDataGbl = function () {
        $scope.getCartData().then(function (resdata) {
            console.log(resdata.cartdata);
            $scope.initApp.maincart = resdata.cartdata;
        });
    }
    $scope.cartDataGbl();


    $scope.removeCartData = function (cartd) {
        var form = new FormData()
        form.append('product_id', cartd.product_id);
        $http.post(urllink + "/removeCart", form).then(function (rdata) {});
        $scope.cartDataGbl();
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
            $scope.cartDataGbl();

        }, function () {
            swal({
                title: 'Connection Error',
                timer: 1500,
            });
        })

    }

    console.log(urllink)
})
