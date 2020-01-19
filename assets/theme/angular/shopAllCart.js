nitaFasions.controller('shopAllCart', function ($scope, $http, $filter, $timeout) {
    console.log("shop all cart")
    console.log(gbltagnames)
    $scope.shopCart = {
        "itemslist": {},
        "itemsname": gbltagnames,
    }
    
    


    $scope.getcartDataGbl().then(function(cdata){
         for (cartd in cdata) {
            var cartobj = cdata[cartd];
            var tagname = cartobj.tag_name;
            if (gbltagnames.indexOf(tagname)>(-1)) {
                console.log(tagname, gbltagnames.indexOf(tagname))
                if($scope.shopCart.itemslist[tagname]){
                    $scope.shopCart.itemslist[tagname].push(cartobj);
                }
                else{
                    $scope.shopCart.itemslist[tagname] = [cartobj];
                }
                
            }
        }
        console.log($scope.shopCart.itemslist)
    })
    

})
