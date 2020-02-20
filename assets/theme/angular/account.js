

nitaFasions.controller('AddressConroller', function ($scope, $http, $filter, $timeout) {


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







})


