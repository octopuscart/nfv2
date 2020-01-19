<?php
$this->load->view('layout/header');
?>

<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>Look Book</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url("/"); ?>">Home</a></li>
                <li><a href="<?php echo site_url("Shop/lookbook"); ?>">Look Book</a></li>

            </ol>
        </div>
    </div>
</section>



<div class="section_offset" ng-controller="lookBookController">
    <div class="container">
        <div class="content">
            <!--contact-->
            <!--clients area-->
            <div class="latest-w3">
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/GridGallery/css/demo.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/GridGallery/css/component.css" />

                <script src="<?php echo base_url(); ?>assets/theme/GridGallery/js/modernizr.custom.js"></script>

                <div id="grid-gallery" class="grid-gallery" style="    margin-top: 2em;">

                    <section class="grid-wrap">
                        <ul class="grid">
                            <li class="grid-sizer"></li><!-- for Masonry column width -->

                            <?php
                            foreach ($stylearray as $key => $value) {
                                ?>    

                                <li style="    padding: 10px;" >

                                    <div class="panel panel-default" style="border:none;margin: 0px;">
                                        <div class="panel-body" style="    padding: 5px;">
                                            <div class="thumbnail lookbook_thumb" >
                                                <img src="<?php echo base_url(); ?>assets/lookbook/<?php echo $value['image']; ?>" alt="img01" style=""/>
                                                <div class="caption">
                                                    <p>Style#: <?php echo $value['style_no'];?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>

                        </ul>
                        <div style="clear:both"></div>
                    </section><!-- // grid-wrap -->
                    <section class="slideshow" style="z-index: 200000" >
                        <ul>

                            <?php
                            foreach ($stylearray as $key => $value) {
                                ?>    
                                <li >

                                    <div class="thumbnail " style="background: none;border:none">
                                        <center>  <img src="<?php echo base_url(); ?>assets/lookbook/<?php echo $value['image']; ?>" alt="img01"  style="    height:550px;"/></center>

                                    </div>

                                </li>
                                <?php
                            }
                            ?>

                        </ul>

                        <nav>
                            <span class="icon nav-prev"></span>
                            <span class="icon nav-next"></span>
                            <span class="icon nav-close"></span>
                        </nav>

                    </section><!-- // slideshow -->
                </div><!-- // grid-gallery -->


                <!-- // grid-gallery -->
                <script src="<?php echo base_url(); ?>assets/theme/GridGallery/js/imagesloaded.pkgd.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/theme/GridGallery/js/masonry.pkgd.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/theme/GridGallery/js/classie.js"></script>
                <script src="<?php echo base_url(); ?>assets/theme/GridGallery/js/cbpGridGallery.js"></script>
                <script>
                </script>
            </div>
            <!--end of client area-->
            <!--contact-->
        </div>
    </div>


</div>

</div>

<script>

    App.controller('lookBookController', function ($scope, $http, $timeout, $interval) {
        $scope.styleArray = {"title": "", "loading": 1, "style_list": [], "enquery_list": {}};
        $timeout(function () {
            new CBPGridGallery(document.getElementById('grid-gallery'));
        }, 500)



    })

</script>

<?php
$this->load->view('layout/footer');
?>