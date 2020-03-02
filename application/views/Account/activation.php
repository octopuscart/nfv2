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
        <h3 style="color: #000 !important; font-weight: 300;text-transform: capitalize;">Welcome To Nita Fashions</h3>
        <div style="margin-top: 10px;"> </div>
    </div>
</section>

<div class="section_offset counter" ng-controller="AddressConroller">
    <div class="container">
        <div class="row">  
            <h2 class="text-center text-success" style="font-size: 30px;">
                <?php echo $messsage; ?><br/><br/>
                <?php
                if ($status == '1') {
                    ?>
                    <a href="<?php echo site_url('Account/profile');?>" class="btn btn-success">Enjoy Shopping</a>
                    <?php
                } else {
                    ?>
                    <a href="<?php echo site_url('/');?>" class="btn btn-danger">Go Back</a>
                    <?php
                }
                ?>
            </h2>
        </div>
    </div>

    <!--banners-->
</div>
<script src="<?php echo base_url(); ?>assets/theme/angular/account.js"></script>

<?php
$this->load->view('layout/footer');
?>
