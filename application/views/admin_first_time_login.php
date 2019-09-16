<?php
if(!$this->session->userdata('islogged')){
    redirect('System/index');
}
else{}

//foreach ($admin_id as $i){
//    $auto_id = $i['admin_id'];
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>CHURCH ERP SYSTEM</title>

    <meta name="description" content="User login page"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/ace.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/ace-part2.min.css"/>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/ace-rtl.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!--[if lte IE 8]>
    <script src="<?php echo base_url();?>/assets/js/html5shiv.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/respond.min.js"></script>
    <![endif]-->
    <style>
        .required,.error{
            color: red;
        }
    </style>
</head>

<body class="login-layout" style="background-color: white;">
<div class="main-container">
    <div class="main-content">
        <br/><br/><br/><br/>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
<!--                <div class="login-container">-->
                    <div class="center">
                        <h1 style="text-align: center; font-weight: bold;">
                            <span class="blue" id="id-text2">CHURCH ERP SYSTEM</span>
                        </h1>
                        <h4 style="text-align: center; font-weight: bold;" class="blue" id="id-company-text">&copy;
                            Robisearch Ltd</h4>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger"
                                        style="text-align: center; font-weight: bold;">
                                        <i class="ace-icon fa fa-building blue"></i>CHURCH ACCOUNT SETUP
                                    </h4>

                                    <div class="space-6"></div>

                                    <form method="post" action="<?php echo site_url('System/church_account');?>" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                if(isset($_SESSION['message'])){
                                                    echo $_SESSION['message'];
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <input style="display: none;" class="form-control" value="<?php echo $this->session->userdata['id'];?>" name="admin_id" placeholder="Admin ID">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CHURCH NAME:</label> <span class="required">*</span>
                                                    <input name="church_name" type="text" class="form-control" placeholder="Church Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>COUNTY:</label> <span class="required">*</span>
                                                    <select class="form-control" name="county" required>
                                                        <option>~~Select County~~</option>
                                                        <?php
                                                        foreach($county as $count){
                                                            ?>
                                                            <option value="<?php echo $count['county_id'];?>"><?php echo $count['county_name'];?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>P.O Box:</label> <span class="required">*</span>
                                                    <input name="box" type="text" class="form-control" placeholder="e.g 01000" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>LOCATION:</label> <span class="required">*</span>
                                                    <input name="location" type="text" class="form-control" placeholder="Where is the church located?" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CHURCH PHONE:</label>
                                                    <input name="church_phone" type="text" class="form-control" placeholder="Church Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CHURCH EMAIL:</label>
                                                    <input name="church_email" type="text" class="form-control" placeholder="Church Email Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CHURCH LOGO:</label>
                                                    <input name="logo" type="file" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CHURCH MOTTO:</label>
                                                    <input name="motto" type="text" class="form-control" placeholder="Church Motto">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group pull-left">
                                                    <button name="church_btn" type="submit" class="btn btn-md btn-primary"><i class="fa fa-lock"></i> SUBMIT DETAILS</button>
                                                    <a href="<?php echo site_url('System/logout');?>" class="btn btn-md btn-warning"><i class="fa fa-close"></i> CANCEL</a>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="space-6"></div>
                                </div><!-- /.widget-main -->

                                <!--<div class="toolbar clearfix">
                                    <div>
                                        <a href="<?php //echo site_url('System/forgot_password');?>" class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>I forgot my password
                                        </a>
                                    </div>
                                    <div>
                                        <a href="<?php //echo site_url('System/register'); ?>" class="user-signup-link">
                                            Register here
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>-->
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                        <div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="ace-icon fa fa-key"></i>
                                        Retrieve Password
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        Enter your email and to receive instructions
                                    </p>

                                    <form>
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control"
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                    <i class="ace-icon fa fa-lightbulb-o"></i>
                                                    <span class="bigger-110">Send Me!</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        Back to login
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.forgot-box -->
                    </div><!-- /.position-relative -->

                    <div class="navbar-fixed-top align-right">
                        <br/>
                        &nbsp;
                        <a id="btn-login-dark" href="#">Dark</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-blur" href="#">Blur</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-light" href="#">Light</a>
                        &nbsp; &nbsp; &nbsp;
                    </div>
<!--                </div>-->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?php echo base_url(); ?>/assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo base_url();?>/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        $(document).on('click', '.toolbar a[data-target]', function (e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });
    });


    //you don't need this, just used for changing background
    jQuery(function ($) {
        $('#btn-login-dark').on('click', function (e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-light').on('click', function (e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function (e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
        });

    });
</script>
</body>
</html>
