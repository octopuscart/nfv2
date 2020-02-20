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
        <p style="color:black;margin-top: 10px;">Order Tracking</p>
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
                        <?php if ($data) { ?> 

                            <hr style="margin-top: 6px;margin-bottom: 0px;background: ivory;">
                            <table class="table table-striped table-bordered table-hover filterTable" >
                                <thead>
                                    <tr>
                                        <th style="font-size: 11px;text-align:left"><b>S.No.</b></th>
                                        <th style="font-size: 11px;text-align:left"><b>Order No.</b></th>
                                        <th style="font-size: 11px;text-align:left"><b>Invoice No.<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Shipping Date<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Weight<b/></th>
    <!--                                        <th style="font-size: 11px;text-align:left"><b>Sender Company<b/></th>-->
                                        <th style="font-size: 11px;text-align:left"><b>Destination Country<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Tracking No.<b/></th>
                                        <th style="font-size: 11px;text-align:center"><b>Shipping Company<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Date/Time<b/></th>
                                        <th style="font-size: 11px;text-align:left"><b>Status<b/></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        for ($i = 0; $i < count($data); $i++) {

                                            if ($data) {
                                                ?>

                                                <td style="font-size: 12px;text-align: "><?php echo $i + 1 ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['order_no'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['invoice_no'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['shipping_date'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['total_weight'] . ' ' . $data[$i]['weight_unit'] ?></td>
            <!--                                            <td style="font-size: 12px;text-align: "><?php echo $data[$i]['sender_company'] ?></td>-->
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['destination_country'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['tracking_no'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['shipping_company'] ?></td>
                                                <td style="font-size: 12px;text-align: "><?php echo $data[$i]['op_date_time'] ?></td>
                                                <td style="font-size: 12px;text-align: ">
                                                    <?php
                                                    $ids = $data[$i]['status'];
                                                    $stat = $productmodel->statusTag($ids);
                                                    echo $stat[0]['title'];
                                                    ?>

                                                </td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>


                            </table>
                        <?php } else { ?>
                            <center><span style="color: red;font-size: 20px;font-weight: 500;">NO ORDER FOUND FOR TRACKING</span></center>

                        <?php } ?>

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
