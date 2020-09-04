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


<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="    padding: 0px 1px 8px 1px;background: black;">
    <div class="">

        <!-- breadcrumbs -->
        <ul class="hr_list d_inline_m breadcrumbs" style="margin-top: 10px;">
            <li class="m_right_8 f_xs_none" style="margin-right:0px !important">
                <a href="#" class="color_default d_inline_m m_right_10" style="margin-right:0px !important;color:white;">
                    <i class="icon-calendar"></i>&nbsp;&nbsp;  Schedule Your Next Appointment&nbsp;&nbsp;


                </a>
            </li>

        </ul>
    </div>
</section>







<div class="section_offset" style="    padding: 30px 0 67px;">
    <div class="container clearfix">
        <div class="row page_block">
            <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30" style="margin-bottom: 20px;">
                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Tour Schedule</h3>


            </section>

            <table class="table table-borderd hideonmobile">
                <tr style="    background-color: #000;
                    color: #fff;">
                    <th style="width: 100px">Country</th>
                    <th style="width: 150px">City/State</th>
                    <th style="">Hotel Name & Address</th>

                    <th style="width: 350px">From Date - To Date</th>
                    <th style="width: 200px"></th>

                </tr>
            </table>
            <!--<div id="calendar" class="calendar"></div>-->



            <div class="row showonmobile">

            </div>

        </div>
    </div>
</div>



<button type="button" style="display: none" class="btn btn-primary btn-lg Login" data-toggle="modal" data-target="#myLogin">
</button>
<style>
    .modal table tr{
        padding: 8px;
        line-height: 0.42857143 !important;
        vertical-align: top;
        /*border-bottom: 1px solid;*/
    }
</style>



<?php
$this->load->view('layout/footer');
?>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>