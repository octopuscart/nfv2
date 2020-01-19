<?php
$this->load->view('layout/header');
?>
<style>
    .ui-datepicker-trigger{
        text-align: center;
        height: 50px;
        padding-left: 14px;
        width: 45px;
        position: absolute;
    }
</style>

<!-- Slider -->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
        <div class="container">
            <h4>Book An Appointment</h4>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url("/"); ?>">Home</a></li>
                <li><a href="<?php echo site_url("Shop/appointment"); ?>">Appointment</a></li>

            </ol>
        </div>
    </div>
</section>




<!-- Left Background -->
<div class="main-page-section half_left_layout" ng-controller="bookingController">
    <div class="main-half-layout half_left_layout studio-bg"></div>

    <!-- Right Content -->
    <div class="main-half-layout-container half_left_layout pricing">
        <div class="about-us-con">
            <div class="skills padding-top-30"> 

                <article style="padding: 10px;">
                    <!-- Main Heading -->
                    <div class="heading-block left-align margin-bottom-30">
                        <h3 class="text-transform-none text-center letter-space-0" style="display: block">Book An Appointment</h3>
                    </div>

                    <div class="contact">               
                        <!-- Success Msg -->
                        <div id="contact_message" class="success-msg"> <i class="fa fa-paper-plane-o"></i>Thank You. Your Message has been Submitted</div>              
                        <!-- FORM -->
                        <form role="form" id="contact_form" action="#" class="contact-form" method="post" >
                            <ul class="row nolist-style">
                                <li class="col-sm-5">
                                    <label>
                                        <input type="text" class="form-control" name="last_name" id="name" placeholder="Last Name" required="">
                                    </label>
                                </li>
                                <div class="col-sm-1 "></div>
                                <li class="col-sm-6 ">
                                    <label>
                                        <input type="text" class="form-control" name="first_name" id="name" placeholder="First Name" required="">
                                    </label>
                                </li>
                                <li class="col-sm-12">
                                    <label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required="">
                                    </label>
                                </li>
                                <li class="col-sm-12">
                                    <label>
                                        <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No.">
                                    </label>
                                </li>

                                <li class="col-sm-5">
                                    <label>
                                        <input type="hidden" class="form-control" name="select_date"  value="{{selection.date}}"  >

                                        <input type="text" id="datepicker" ng-model="selection.date" class="form-control"  placeholder="Date"  required="" min="<?php echo date('Y-m-d'); ?>" value="{{selection.date}}" disabled="" ng-change="changeTimeSlot()" style="width:90% ">
                                    </label>
                                </li>
                                <div class="col-sm-1 "></div>
                                <li class="col-sm-6">
                                    <label>
                                        <select class="form-control" name="select_time" style=" padding: 0px 20px;   line-height: 50px;
                                                height: 50px;
                                                background: rgba(0,0,0,0.02);">
                                            <option value="{{time}}" ng-repeat="time in selection.time">{{time}}</option>
                                        </select>
                                    </label>
                                </li>




                                <li class="col-sm-12">
                                    <label>
                                        <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" ></textarea>
                                    </label>
                                </li>
                                <li class="col-sm-12 text-left">
                                    <button type="submit"  class="btn btn-inverse" name="submit" value="sendmessage" >SUBMIT</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<div style="clear: both"></div>


<script>

    App.controller('bookingController', function ($scope, $http, $timeout, $interval) {
        $scope.selection = {'date': '<?php echo date('Y-m-d'); ?>', 'time': ''};
        $scope.timeSlot = <?php echo json_encode($timing_data); ?>;
        $("#datepicker").datepicker({
            minDate: new Date('<?php echo date('Y-m-d'); ?>'),
            dateFormat: 'yy-mm-dd',
            showOn: "button",
            buttonText: '<i class="fa fa-calendar"></i>',
            onSelect: function () {
                $scope.changeTimeSlot(this.value);
            }
        });
        $scope.changeTimeSlot = function (cdate) {
            console.log(cdate);
            var day = new Date(cdate);
            var cday = day.getDay();

            var selectedday = "" + cday;
            console.log(cday, typeof (cday))
            if (cday < 6 && cday > 0) {
                selectedday = "mon_fri";
                console.log("positon1");
            } else if (cday == 6) {
                selectedday = "6";
                console.log("positon2");
            } else {
                selectedday = "0";
                console.log("positon3");
            }
            $timeout(function () {
                $scope.selection.time = $scope.timeSlot[selectedday];
            }, 100)


        }
        $scope.changeTimeSlot($scope.selection.date);
    })

</script>

<?php
$this->load->view('layout/footer');
?>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>