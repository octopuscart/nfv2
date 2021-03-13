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
        <p style="color:black;margin-top: 10px;">Order Summary</p>
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

                        <hr style="margin-top: 6px;margin-bottom: 0px;background: ivory;">
                        <table class="table table-striped table-bordered table-hover filterTable" >
                            <thead>
                                <tr style="font-size: 12px">
                                    <th><b>S. No.</b></th>
                                    <th><b>Order No.</b></th>
                         
                                    <th><b>Date/Time</b></th>
                                    <th><b>Total Price</b></th>
                                    <th><b>Order Status</b></th>
                                    <th style="    width: 90px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($order_data); $i++) {
                                    $orderData = $order_data[$i];
                                    //  print_r($orderData);
                                    ?>

                                    <tr style="font-size: 12px">
                                        <td> 
                                            <?php echo $i + 1 ?>
                                        </td>
                                        <td><?php echo $orderData['order_no'] ?></td>

   

                                        <td>
                                            <?php echo $orderData['op_date'] ?>/<?php echo $orderData['op_time'] ?> 
                                        </td>

                                        <td><?php echo $orderData['total_price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $orderData['title'] ?>
                                        </td>

                                        <td> 
                                            <a href="<?php echo site_url("Order/orderdetails/".$orderData['id']); ?>" class="btn btn-default btn-xs"> Invoice</a>
                                         
                                        </td>  

                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>

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
