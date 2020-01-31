nitaFasions.controller('productConroller', function ($scope, $http, $filter, $timeout) {
    $scope.productResult = {
        "status": 1,
        "colors": [],
    };
    var productlistapi = urllink + "/productList";
    $http({
        url: productlistapi,
        method: "GET",
        params: customformdata
    }).then(function (rdata) {
        var response = rdata.data;
        $scope.productResult.colors = response.colors;
    });


    $(function () {
        $('.select_list li').click(function () {
            setTimeout(function () {
                $("#filterform").submit();
            }, 600);
        });



    });
    var requestobj = customformdata;
    $scope.loader = 1;
    $scope.getProductData = function (timecheck) {
        $scope.loader = 1;
        var countdata = $(".info_text").text().split(" ")[1];
        if (countdata) {
            countdata = countdata.split("-");
        } else {
            countdata = [1, 16];
        }
        requestobj['paginate'] = countdata;
        requestobj['perpage'] = '16';
        requestobj['getproductlistpage_v1'] = 'searching';
        var url = productlistapi + "?" + $.param(requestobj);
        $scope.productList = [];
        $scope.pageList = [];
        $http.get(url).then(function (rdata) {
            $scope.loader = 0;
            $scope.productList = rdata.data.productdata;
            var count = rdata.data.count;
            if (timecheck) {
                for (i = 0; i < count; i++) {
                    $scope.pageList.push(i);
                }
            }
            if (timecheck) {
                $scope.colorList = rdata.data.colors;
                $scope.selectedColorList = rdata.data.selected_colors;
                $scope.priceList = rdata.data.pricelist;

                var from_price = $scope.priceList[0];
                var to_price = $scope.priceList[ $scope.priceList.length - 1];
                $("#from_price").val(from_price);
                $("#to_price").val(to_price);



                $("#price_loader").remove();
                $("#pricerange").slider(
                        {
                            min: 0,
                            max: 2000,
                            values: ['', ''],
                            slide: function (event, ui) {
                                $(this).next().find('.first_limit').val(ui.values[0]);
                                $(this).next().find('.last_limit').val(ui.values[1]);
                            },
                            change: function () {
                                var fp = $("#from_price").val();
                                var tp = $("#to_price").val();

                                setTimeout(function () {
                                    $("#filterform").submit()
                                }, 500);
                                //$("#filterform").submit();
                            },
                        }
                );


            }
            $timeout(function () {

                for (i in $scope.selectedColorList) {
                    var scl = $scope.selectedColorList[i];
                    $("#shop_style" + scl.id)[0].checked = true;
                }

                $(document).on("click", ".selected_colors", function () {
                    $("#filterform").submit();
                });


                $("img.lazy").lazyload({
                    //                            placeholder: "../assets/nf_load_default.png"
                });
                if (timecheck) {
                    var page_data = $('.section_offset').pajinate({
                        items_per_page: 16,
                        item_container_id: '.page_container',
                        nav_panel_id: '.page_navigation',
                        num_page_links_to_display: 5,
                        nav_label_info: 'Showing {0}-{1} of {2} results',
                        nav_info_id: '.info_text'
                    });
                    $(".page_navigation a").click(function () {
                        $("body").animate({
                            "scrollTop": 100
                        });
                        $scope.getProductData(0);
                    });
                }
                Waves.attach('.button_wave', ['waves-button', 'waves-float']);
                Waves.attach('.waves-image1');
                Waves.init();

            }, 500)
        });

    }
    $scope.getProductData(1);
})
