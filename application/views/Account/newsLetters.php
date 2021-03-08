<?php
$this->load->view('layout/header');
?>
<style>
    .test th{
        border:none;
    }
    .test td{
        border:none;
    }
    .pagination>.active>a, 
    .pagination>.active>a:focus,
    .pagination>.active>a:hover,
    .pagination>.active>span, 
    .pagination>.active>span:focus, 
    .pagination>.active>span:hover {
        z-index: 2;
        color: #fff;
        cursor: default;
        background-color: #000;
        border-color: #000;
    }  
</style>
<style>

</style>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo['first_name']; ?></h3>
        <p style="color:black;margin-top: 10px;">Newsletter</p>
        <div style="margin-top: 10px;"> </div>
    </div>
</section>

<div class="section_offset counter" ng-controller="AddressConroller">
    <div class="container">
        <div class="row">  
            <aside class="col-lg-3 col-md-3 col-sm-12 m_bottom_50 m_xs_bottom_30 " style=" " >	

                <?php
                $this->load->view('Account/sidebar');
                ?>

            </aside>

            <div class="col-lg-9 col-md-9 col-sm-12 m_bottom_70 m_xs_bottom_30 mobilenopadding" style="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo['registration_id'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <button class="btn btn-default"><i class="icon-plus"> Total message - </i>
                                <?php
                                print_r(count($total_msg));
                                ?>
                            </button>
                            <button class="btn btn-default"><i class="icon-mail-1"> Read - </i>
                                <?php
                                print_r(count($read_msg));
                                ?> 
                            </button>
                            <button class="btn btn-default"><i class="icon-mail-alt"> Unread - </i>
                                <?php
                                print_r(count($unread_msg));
                                ?> 
                            </button>
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                            <table class="table">


                                <?php
                                for ($i = 0; $i < count($maliInfo); $i++) {
                                    if ($maliInfo[$i]['flag'] == 1) {
                                        $class = 'read';
                                    } else {
                                        $class = 'unread';
                                    }
                                    ?>

                                    <tr class="<?php echo $class; ?>" style="">
                                        <td  id="<?php echo $maliInfo[$i]['id']; ?>" onclick="change_status(this)" >
                                            <div class="col-md-6">
                                                <h5 style="color:slateblue;"><?php echo $maliInfo[$i]['title']; ?></h5><br/>
                                                <p><?php echo $maliInfo[$i]['short_description']; ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="post" action="#">
                                                <input type="hidden" value="<?php echo $maliInfo[$i]['id']; ?>" name="newsid"/>

                                                <button value="<?php echo $maliInfo[$i]['id']; ?>" name="deletenews"> <i class="icon-cancel-circled-1 fs_large"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--banners-->
</div>
<script src="<?php echo base_url(); ?>assets/theme/angular/account.js"></script>

<?php
$this->load->view('layout/footer');
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>/assets/theme/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url(); ?>/assets/theme/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>/assets/theme/datatables/dataTables.bootstrap.js"></script>
<script>
                                        $(document).ready(function () {
                                            $('.filterTable').dataTable();
                                            // $("#searchPlace").html($($("#DataTables_Table_0_wrapper label")[1]).find("input").addClass("form-control").attr("type", "text").css("height", "34px"));
                                            $($("#DataTables_Table_0_wrapper label")[1]).remove();
                                            $("select[name='DataTables_Table_0_length']").remove();
                                            $("#DataTables_Table_0_length").remove();
                                        });
</script>
<script>
    $(function () {

        var newsalert = {
            'Full Experience': {'title': 'Full Experience', 'description': 'I want the full Nita Fashions Experience.'},
            'Sales/Promotion': {'title': 'Sales/Promotion', 'description': 'I would like to only know about products that are on Sales/Promotion.'},
            'New Arrival': {'title': 'New Arrival', 'description': 'I would like to only know about products that are New/Trending.'},
            'Monthly': {'title': 'Monthly Subscription', 'description': 'I would like to receive monthly newsletters subscription from Nita Fashions.'},
        }
//         news letter
        function getStatus(a) {
            $.ajax({
                url: '<?php echo site_url("Api/newsLetterApi") ?>',
                method: "post",
                data: {'news_letters_subscribe': 'card', },
                success: function (data) {
                    if (data) {

                        var jdata = (data);
                        console.log(jdata);
                        if (jdata.length) {
                            var fs = jdata[0].frequency;

                            $("input[valuecheck='" + fs + "']")[0].checked = true;
                            $("#block_frequncey").show(100);
                            $("#subscribe_check")[0].checked = true;
                            if (a) {
                                swal(newsalert[fs]['title'], newsalert[fs]['description'], "success");
                            }
                        }

                    }
                    ;
                }
            });
        }


        function setStatus(a) {
            var subs = $("#subscribe_check")[0].checked;

            var feq = $("input[valuecheck]:checked").attr("valuecheck");
            console.log(feq);
            $.ajax({
                url: '<?php echo site_url("Api/newsLetterApi") ?>',
                method: "post",
                data: {'news_letters_subscribe': 'card', 'frequency': feq, 'subscribe': subs},
                success: function (data) {
                    console.log(data);
                    getStatus(a);
                }
            });

        }

        $("input[name='frequency']").click(function () {
            setStatus(1);
        })


        getStatus();
        $("#subscribe_check").click(function () {
            var obj = this;
            if (this.checked) {
                $("#block_frequncey").show(100);
                swal({title: "Welcome",
                    text: "Confirm to subscribe to Nita Fashions newsletter. ",
//                    type: "warning", 
                    imageUrl: "../assets/nf_logoalert.png",
                    showCancelButton: true,
                    confirmButtonColor: "green",
                    confirmButtonText: "Yes, Do it!",
                    closeOnConfirm: false,
                    //closeOnCancel: false
                }, function (isConfirm) {

                    if (isConfirm) {
                        setStatus();
                        swal("Thank You!", "You have subscribed from Nita Fashions newsletters. You can change your newsletters frequency", "success");
                    } else {
                        obj.checked = false;
                        $("#block_frequncey").hide(100)
                    }
                });
            } else {
                $("#block_frequncey").hide(100)
                swal({title: "Are you sure?",
                    text: "You will not be able to receive newsletters form Nita Fashions !",
                    type: "warning", showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Do it!",
                    closeOnConfirm: false,
                    //closeOnCancel: false
                }, function (isConfirm) {

                    if (isConfirm) {
                        $.ajax({
                            url: '<?php echo site_url("Api/newsLetterApi") ?>',
                            method: "post",
                            data: {'news_letters_unsubscribe': 'card'},
                            success: function (data) {
                                console.log(data);
                                swal("Unsubscribed!", "You have unsubscribed from Nita Fashions newsletters.", "success");
                                //getStatus();
                            }
                        });

                    } else {
                        obj.checked = true;
                        $("#block_frequncey").show(100)
                    }
                });
            }
        })

//end of new letter



        $("button[name=delete_measurement]").click(function () {
            var obj = $(this);
            swal({title: "Are you sure?", text: "You will not be able to recover this measurement profile !", type: "warning", showCancelButton: true, confirmButtonColor: "#f00", confirmButtonText: "Yes, delete it !", cancelButtonText: "Cancel", closeOnConfirm: false, closeOnCancel: false}, function (isConfirm) {
                if (isConfirm) {
                    $(obj).attr("type", "submit");
                    swal({title: "Deleted !", text: "", type: "success"}, function () {
                        // setTimeout(function(){ $(obj).parents("form").first().submit();}, 500);
                        $(obj).click();
                    });
                } else {
                    swal("Cancelled", "Your measurement profile is safe :)", "error");
                }
            });
        });
        $("button[name=delete_style]").click(function () {
            var obj = $(this);
            swal({title: "Are you sure?", text: "You will not be able to recover this style !", type: "warning", showCancelButton: true, confirmButtonColor: "#f00", confirmButtonText: "Yes, delete it !", cancelButtonText: "Cancel", closeOnConfirm: false, closeOnCancel: false}, function (isConfirm) {
                if (isConfirm) {
                    $(obj).attr("type", "submit");
                    swal({title: "Deleted !", text: "Your selected style deleted.", type: "success"}, function () {
                        // setTimeout(function(){ $(obj).parents("form").first().submit();}, 500);
                        $(obj).click();
                    });
                } else {
                    swal("Cancelled", "Your style is safe :)", "error");
                }
            });
        });
        $(".d_none").click(function () {
            $(".redButton").removeAttr("disabled");
        });
        //$("#myModal").draggable();





<?php
if (isset($_POST['default_style'])) {
    echo "var style_id = ", $_POST['default_style'], ";";
    ?>
            var tab_id = $("input[type=radio][value=" + style_id + "][name='default_style']").parents(".tab-pane")[1].id;
            $("a[href='#" + tab_id + "']").tab('show')
<?php } ?>



<?php
if (isset($_POST['measurement_style'])) {
    echo "var measurement_id = ", $_POST['measurement_style'], ";";
    ?>
            var tab_id = $("input[type=radio][value=" + measurement_id + "][name='measurement_style']").parents(".tab-pane");
            $(tab_id).each(function () {
                $("a[href='#" + this.id + "']").tab('show')
            })
<?php } ?>



//        var tab_id = $("input[type=radio][value=160][name='measurement_style']").parents(".tab-pane")[0].id


        $("[type=radio]").click(function () {
            $(this).parents("form").first().find("[type='submit']").click();
        })


    });</script>