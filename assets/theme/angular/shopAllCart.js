nitaFasions.controller('shopAllCart', function ($scope, $http, $filter, $timeout) {

    $scope.shopCart = {
        "data": [],
        "itemslist": {},
        "itemnames": ["Shirt", "Tuxedo Shirt", "Tuxedo Pant", "Tuxedo Suit", "Tuxedo Jacket", "Suit", "3 Piece Suit", "Pant", "Jacket", "Waistcoat", "Sports Jacket", "Overcoat"],
    };

    $scope.getCartData().then(function (resdata) {
        var cartdata = resdata.cartdata.products;
        var templist = {};
        for (cind in cartdata) {
            var cartobj = cartdata[cind];
            var tagname = cartobj.tag_title;
            if ($scope.shopCart.itemnames.indexOf(tagname) > (-1)) {
                if (templist[tagname]) {
                    templist[tagname].push(cartobj);
                } else {
                    templist[tagname] = [cartobj];
                }
            }
        }

        for (cin in $scope.shopCart.itemnames) {
            var ciname = $scope.shopCart.itemnames[cin];
            if (templist[ciname]) {
                var cartobj = templist[ciname];

                $scope.shopCart.itemslist[ciname] = cartobj;

            }
        }


    });

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


    jQuery('body').on('click', '.next-tab', function () {
        var next = jQuery('.nav-tabs > .active').next('li');
        if (next.length) {

            next.find('a').trigger('click');
        } else {
            jQuery('#myTabs a:first').tab('show');
        }
    });

    jQuery('body').on('click', '.previous-tab', function () {
        var prev = jQuery('.nav-tabs > .active').prev('li')
        if (prev.length) {

            prev.find('a').trigger('click');
        } else {
            jQuery('#myTabs a:last').tab('show');
        }
    });


    $scope.cardHolder = {
        "name": "",
        "card_no": "",
        "exp_date": "",
        "cvv": "",
        "card_type": "",
    }

    var CardType = {'amex': 'American Express',
        'dankort': 'Dankort',
        'dinersclub': 'Diners Club',
        'discover': 'Discover',
        'jcb': 'JCB',
        'laser': 'Laser',
        'maestro': 'Maestro',
        'mastercard': 'Master Card',
        'unionpay': 'Union Pay',
        'visa': 'VISA',
        'visaelectron': 'VISA Electron',
        'elo': 'Elo'};

    var cardss = new Card({
        form: '#create_form',
        formSelectors: {
            numberInput: 'input#card-number', // optional — default input[name="number"]
            expiryInput: 'input#exp_year', // optional — default input[name="expiry"]
            cvcInput: 'input#cvv', // optional — default input[name="cvc"]
            nameInput: 'input#card-holder-name' // optional - defaults input[name="name"]
        },
        container: '.card-wrapper'
    });
    $("#card-number").keyup(function () {
        console.log(cardss);
        $scope.cardHolder.card_type = CardType[cardss.cardType];
    });

})


nitaFasions.controller('OrderDetailsController', function ($scope, $http, $timeout, $interval) {
    $scope.shopCart = {};

    $http.get(urllink + "/getCustomCartDataOrder/" + order_idgbl).then(function (rdata) {
        $scope.shopCart = rdata.data;
    }, function () {
        $scope.userAddress.loader = "0";
    });
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