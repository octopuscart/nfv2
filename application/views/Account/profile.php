<?php
$this->load->view('layout/header');
?>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="  padding-top: 15px;padding-bottom: 0px;box-shadow: 0px 3px 7px -1px #DBDADA;">
    <div class="container">
        <h3 style="color: #000 !important; font-weight: 300; text-transform: capitalize;">Welcome <?php echo $userInfo['first_name']; ?></h3>
        <p style="color:black;margin-top: 10px;">Personal Information</p>
        <div style="margin-top: 10px;"></div>
    </div>
</section>

<style>
    .profile td{
        border:none;
    }
</style>
<style>
    .close{
        opacity: 1;
        color: white;
    }
    .modal-header{
        padding: 3px 19px;
        background: black;
    }
    .tds{
        padding: 8px;
        line-height: 0.42857143 !important;
        vertical-align: top;
        border-bottom: 1px solid;


    }
</style>
<div class="section_offset counter">
    <div class="container">
        <div class="row">
            <aside class="col-lg-3 col-md-3 col-sm-12 m_bottom_50 m_xs_bottom_30 " style=" " >	

                <?php
                $this->load->view('Account/sidebar');
                ?>

            </aside>

            <div class="col-lg-9 col-md-9 col-sm-12 m_bottom_70 m_xs_bottom_30 mobilenopadding" style="">

                <div class="panel panel-default" style="">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon-user"></i> Client Code : <?php echo $userInfo['registration_id'] ?></h3>

                    </div>
                    <div class="panel-body">
                        <div  align="">
                            <form method="post" action="#">
                                <div class="col-md-2"></div>
                                <div class='col-md-8' style="" align="center">

                                    <table class="profile" align="left" style="color:black">
                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">First Name</span>
                                            </td>
                                            <td>
                                                <input type="text" name="first_name" class="form-control" value="<?php echo $userInfo['first_name']; ?>"  style="height: 30px;" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Middle Name</span>
                                            </td>
                                            <td>
                                                <input type="text" name="middle_name" class="form-control" value="<?php echo $userInfo['middle_name']; ?>"  style="height: 30px;"  disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Last Name/Surname</span>
                                            </td>
                                            <td>
                                                <input type="text" name="last_name" class="form-control" value="<?php echo $userInfo['last_name']; ?>"  style="height: 30px;"   disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Profession</span>
                                            </td>
                                            <td>
                                                <select name="profession_id" id="profession_select"  onchange="professionChange()" class="form-control"  style="height: 30px;"  disabled>
                                                    <option value="" >Select Profession</option>
                                                    <?php foreach ($profession_list as $key => $value) { ?>
                                                        <option value="<?php echo $value['id']; ?>" <?php if ($userInfo['profession_id'] == $value['id']) { ?> Selected =' selected' <?php } ?> ><?php echo $value['title']; ?></option>
                                                    <?php } ?>
                                                    <option value="0" <?php if ($userInfo['profession_id'] == '0') { ?> Selected =' selected' <?php } ?>>Other</option>
                                                </select>


                                                <input type="text" value="<?php echo $userInfo['profession_value']; ?>" name="profession_value" id="profession_value" placeholder="Your Profession" class="form-control" style="display: <?php if ($userInfo['profession_id'] == '0') { ?> 'show' <?php
                                                } else {
                                                    echo 'none';
                                                }
                                                ?>;    height: 28px;" disabled>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Birth Date</span>
                                            </td>
                                            <td>
                                                <input type="date" name="birth_date" class="form-control" value="<?php echo $userInfo['birth_date']; ?>"  style="height: 30px;"  disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Gender</span>
                                            </td>
                                            <td>
                                                <select name="gender" class="form-control"  style="height: 30px;"  disabled>
                                                    <option value="Male" <?php if ($userInfo['gender'] == 'male') { ?> Selected =' selected' <?php } ?> >Male</option>
                                                    <option value="Female" <?php if ($userInfo['gender'] == 'female') { ?> Selected =' selected' <?php } ?> >Female</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Mobile No.</span>
                                            </td>
                                            <td>
                                                <input type="text" name="contact_no" class="form-control" value="<?php echo $userInfo['contact_no']; ?>"  style="height: 30px;"   disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Telephone No.</span>
                                            </td>
                                            <td>
                                                <input type="text" name="telephone_no" class="form-control" value="<?php echo $userInfo['telephone_no']; ?>" style="height: 30px;"   disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Email</span>
                                            </td>
                                            <td>
<?php echo $userInfo['email']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span for="name" class="control-label" style="">Fax</span> 
                                            </td>
                                            <td>

                                                <input type="text" name="fax_no" class="form-control" value="<?php echo $userInfo['fax_no']; ?>" style="height: 30px;"   disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>

                                            </td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#myModal1" style="">Change password</a>

                                            </td>
                                        </tr>

                                    </table>
                                    <table  class="profile" align="left" style="color:black">
                                        <tr>
                                            <td> </td>
                                            <td>

                                                <button type="button" name="" class="btn btn-default  edit" style="">
                                                    <i class="icon-edit"></i> Edit 
                                                </button>


                                                <button type="submit" name="updateData" class="btn btn-default  submit" style="display: none">
                                                    <i class="icon-edit"></i> Update
                                                </button>

                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="col-md-2"></div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!--banners-->
</div>
</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 80%;margin: 0px 0px 0px 88px;">
            <div class="modal-header"  style="color: white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">

                    <h5 style="display: none" id="error-msg">Do not match password</h5>
                    <i class="icon-edit"></i> Change Password
                </h4>
            </div>
            <form method="post" action="#">
                <div class="modal-body">



                    <table class="profile" align="center" style="color:black">
<!--                            <tr>
                            <td>
                                <span for="name" class="control-label"><b>Enter Old Password</b></span>
                            </td>
                            <td>
                                <input type="password" name="old_pwd" class="form-control"  style="height:28px;">
                            </td>
                        </tr>-->
                        <tr>
                            <td>
                                <span for="name" class="control-label"><b>Enter New Password</b></span>
                            </td>
                            <td>
                                <input type="password" name="pwd" class="pass form-control"  style="height:28px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span for="name" class="control-label"><b> Confirm New Password</b></span>
                            </td>
                            <td>
                                <input type="password" name="pwd1" class="con_pass form-control"  style="height:28px;">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" name="updatePass" class="btn btn-default btn-xs confirmpass" style="">
                                    <i class="icon-check"></i> Submit changes
                                </button>

                            </td>
                        </tr>
                    </table>
                </div>

            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php
$this->load->view('layout/footer');
?>
<script>
    $(function () {
        $(".woocommerce-MyAccount-navigation-link--dashboard").removeClass("active");
        $(".profile_page").addClass("active");
    })
</script>