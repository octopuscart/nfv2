<?php
$this->load->view('layout/header');
?>

<style>
    .datatable th{
        border: none;
    }
    .datatable td{
        border: none;
    }
    .addr td{
        border: none;
    }
    .updateAddress td{
        border: none;
    }
    input[type="checkbox"] + label:before {
        content: '';
        font-family: "fontello";
        display: block;
        position: absolute;
        background: #F00;
        top: -8px;
        left: 0px;
        width: 22px;
        height: 23px;
        border: 2px solid #cc0000;
    }

</style>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px; box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome <?php echo $userInfo['first_name']; ?></h3>
        <p style="color:black;margin-top: 10px;">Stored Credit</p>
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
                            <p> You have US  <span style="font-weight: bold;font-size: 24px;color: black;"> $0.00 </span> available in stored credit</p>
                        </div>
                        <div style="clear:both"></div>
                        
                        <div class="col-md-12">    
                    
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
