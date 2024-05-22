<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Order No#</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style>
            .carttable{
                border-color: #fff;
            }

            .carttable td{
                padding: 5px 10px;
                border-color: #9E9E9E;
            }
            .carttable tr{
                /*padding: 0 10px;*/
                border-color: #9E9E9E;
                font-size: 12px
            }

            .detailstable td{
                padding:10px 20px;
            }

            .gn_table td{
                padding:3px 0px;
            }
            .gn_table th{
                padding:3px 0px;
                text-align: left;

            }
            .style_block{
                float: left;
                padding: 1px 1px;
                margin: 2.5px;
                /* background: #000; */
                color: white;
                border: 1px solid #e4e4e4;
                width: 47%;
                font-size: 10px;
            }

            .style_block span {
                background: #fff;
                margin-left: 5px;
                color: #000;
                padding: 0px 5px;
                width: 50%;
            }
            .style_block b {
                width: 46%;
                float: left;
                background: #dedede;
                color: black;
            }
        </style>
    </head>

    <body style="margin: 0;
          padding: 0;
          background: rgb(225, 225, 225);
          font-family: sans-serif;">
        <div class="" style="padding:50px 0px">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;padding: 0 20px">
                <tr>
                    <td >
                        <center><img src="https://www.nitafashions.com/assets/theme/images/logo/nf_logo_8.png" style="margin: 10px;
                                     height: 50px;
                                     width: auto;"/><br/>
                            <h4 style="color: #000;    margin-top: 0px;">  <br>
                                    <small>
                                        <?php echo $singleSchedule['headertitle']; ?>                                    
                                    </small>
                            </h4>
                        </center>
                    </td>

                </tr>


                <tbody>
                    <tr>
                        <td  height="10" style="border-bottom: 1px  solid  #eaedef;">
                            <table style="    width: 100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">

                        </td>
                    </tr>
                    <tr>
                        <td >
                            <span style="
                                  text-align: center;
                                  width: 100%;
                                  font-size: 24px;
                                  float: left;
                                  border-bottom: 1px solid #eaedef;

                                  padding: 20px 0;
                                  background-color: #000;
                                  color: #fff;
                                  font-weight: 300;
                                  "> Your Appointment</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="carttable"  border-color= "#9E9E9E" align="center" border="1" cellpadding="0" cellspacing="0" width="700" style="background: #fff;padding:20px">



                <tr>
                    <td colspan="6" style="font-size: 12px;">





                        <p><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">Dear <?php echo $singleSchedule['name']; ?>,</span><br></p>
                        <p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">We have booked your appointment to see our Chief Tailor, Mr. Peter Daswani in 
                            <b><?php echo $singleSchedule['city']; ?></b> on <b><?php echo $singleSchedule['opdateapp']; ?>, <?php echo $singleSchedule['time1']; ?></b>
                            at the

                            <span><b> <?php echo $singleSchedule['location']; ?>.</b></span><br>

                        </p>

                        <p style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;">On the day of your appointment, please call Mr. Peter Daswani on his contact no. (<b><?php echo $singleSchedule['country']; ?>:  <?php echo $singleSchedule['contact_no']; ?></b>) and he will give you his suite number.</p>
                        <table border=1 style="border-style: dashed;
                               margin-bottom: 10px;">
                            <tr><td colspan=2 style="    background: #000;
                                    color: white;">Contact Details</td></tr>
                            <tr>
                                <td>Name</td><td><?php echo $singleSchedule['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Contact No.</td><td><?php echo $singleSchedule['telephone']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td><td><?php echo $singleSchedule['email']; ?></td>
                            </tr>
                        </table>

                        <br/>
                        <div style="height: 250px;">
                            <?php echo $singleSchedule['emailfooter']; ?>

                        </div>

                    </td>
                </tr>

            </table>

        </div>
    </body>
</html>