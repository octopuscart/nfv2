<?php
$this->load->view('layout/header');
?>
<style>
    .calendar {
        background:white !important;
    }
    table tr td:first-child, table tr th:first-child {
        border-left: 1px solid #D3D3D3;
        border-top: 1px solid #D3D3D3;
    }

    table td, table th {

        border: none ;
    }
    table tr td:last-child, table tr th:last-child {
        border-right: 1px solid #D3D3D3;

    }
    table tr:last-child td {
        border-bottom:  1px solid #D3D3D3;
        border-top:  1px solid #D3D3D3;

    }
    .fc-event-title{
        font-weight: 300  ;
        font-size: 24px;
    }

    .fc-event-title small{
        font-weight: 400  ;
        font-size: 12px;
    }
    .fc-event {
        border: 1px solid #fff;
        background-color: #E8E6E6;
        color: #000;
        font-size: .85em;
        cursor: default;
        padding: 0px 10px;
    }
    .fc-header-left{
        padding: 10px !important;
    }
    .fc-header-title h2 {
        margin-top: 0;
        white-space: nowrap;
        font-family: lato;
        font-weight: 300;
    }
    .make_appointment{
        background: red;
        color: white;
        border: 1px solid red;
        margin-bottom: 5px;
    }
    .set_appointment{
        background: red;
        color:white
    }
    #calendar{
        color:black;
    }

    .fc-today {
        background: #FFFFFF;
        color: red;

        font-size: 25px;
    }

    .fc-state-default.fc-corner-right {

        text-transform: capitalize;
    }
    sup{
        line-height: 19px;
    }

</style>
<?php
//ob_start();

error_reporting(-1);
ini_set('display_errors', 1);
if (isset($_REQUEST['mail_type'])) {
    $mailtype = $_REQUEST['mail_type'];
} else {
    $mailtype = '1';
}



$ids = $last_id;
$rquery = ("select sa.*,ts.schedule_date,ts.schedule_start_time,ts.schedule_end_time,au.email,concat(au.first_name,' ',au.last_name) as name from nfw_app_userlist  as au
join nfw_app_time_schedule as ts on au.nfw_time_schedule_id = ts.id
join nfw_app_start_end_date as ase on ts.nfw_app_start_end_date_id = ase.id
join nfw_app_set_appointment as sa on  ase.nfw_set_appointment_id = sa.id
where au.id=  $ids");
$query = $this->db->query($rquery);

$data = $query->result_array();

$email = array($data[0]['email']);
$name = $data[0]['name'];
$dates = $data[0]['schedule_date'];
$time1 = $data[0]['schedule_start_time'];
$time2 = $data[0]['schedule_end_time'];
$location = $data[0]['location'];
$city = $data[0]['city'];
$country = $data[0]['country'];
$address = $data[0]['address'];
$contact_no = $data[0]['contact_no'];

$opdater = date_create($dates);
$opdateapp = date_format($opdater, "l, d F Y");

$left_header = "Appointment Date & Time:  $opdateapp <small>(" . ($time1) . ")</small> ";
$subject = "Nita Fashions Appointment :  $dates (" . ($time1) . ")";
?>

<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
    <div class="">

        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important">
                <a href="#" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <?php echo $left_header; ?>


                </a>
            </li>

        </ul>
    </div>
</section>







<div class="section_offset" style="    padding: 30px 0 67px; " >
    <div class="container clearfix">
        <div class="row page_block" id="DivIdToPrint">
            <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30" style="margin-bottom: 20px;">
                <h1 class="color_dark fw_light m_bottom_15 heading_1 t_align_c font-225-em">Your Appointment</h1>
            </section>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p><h4 >Dear  <?php echo strtoupper($name); ?>,</h4><br/></p>
                <p style="">We have booked your appointment to see our Chief Tailor, Mr. Peter Daswani in <b><?php echo $city; ?></b> on <b><?php echo $opdateapp . " " . strtoupper($time1); ?></b> at the
                    <span><b><?php echo trim($location); ?>.</b></span>
                </p>
                <p style="">On the day of your appointment,<br/> please call Mr. Peter Daswani on his contact no. (<b><?php echo trim($country) ?>:  <?php echo $contact_no ?></b>) and he will give you his suite number.</p>
                </p>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="text-center">
            <button class="btn btn-default" onclick="printDiv()"><i class="fa fa-print"></i> Print</button>
            <a href="<?php echo site_url("/")?>" class="btn btn-default"><i class="fa fa-home"></i> Home</a>
        </div>
    </div>
</div>








<?php
$this->load->view('layout/footer');
?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    function printDiv()
    {

        var divToPrint = document.getElementById('DivIdToPrint');

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }
</script>