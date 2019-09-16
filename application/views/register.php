<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>CHURCH ERP SYSTEM</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/ace.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/ace-ie.min.css" />
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
            <div class="col-md-12">
                <div class="center">
                    <h1>
                        <!--<i class="ace-icon fa fa-leaf green"></i>
                        <span class="red">Ace</span>-->
                        <span class="blue" id="id-text2">CHURCH ERP SYSTEM</span>
                    </h1>
                    <h4 class="blue" id="id-company-text">&copy; Robisearch Ltd</h4>
                </div>
            </div>
            <div class="col-md-5 col-sm-offset-1">
                    <!--<div class="center">
                        <h1>
                            <span class="white" id="id-text2">CHURCH ERP SYSTEM</span>
                        </h1>
                        <h4 class="blue" id="id-company-text">&copy; Robisearch Ltd</h4>
                    </div>

                    <div class="space-6"></div>-->

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-user-plus blue"></i>
                                        Please Enter Your Information
                                    </h4>

                                    <div class="space-6"></div>

                                    <form method="post" action="<?php echo site_url('System/admin_account');?>">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <p style="color: green;"><strong>POLITE NOTE:</strong> This section is for Church Administrator account setup.</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <?php
                                                if(isset($_SESSION['message'])){
                                                    echo $_SESSION['message'];
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>First Name:</label> <span class="required">*</span>
                                                    <input name="first_name" class="form-control" placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Last Name:</label> <span class="required">*</span>
                                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>ID Number</label> <span class="required">*</span>
                                                    <input class="form-control" name="national_id" placeholder="ID Number(Used for login)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Phone Number</label> <span class="required">*</span>
                                                    <input name="phone_number" class="form-control" placeholder="Phone Number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input name="email_address" class="form-control" placeholder="Valid Email Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Password:</label> <span class="required">*</span>
                                                    <input class="form-control" type="password" name="password" placeholder="Password(Use strong password)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <button type="submit" name="churchadmin_btn" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Create Account</button>
                                                <a href="<?php echo site_url('System/index');?>" class="btn btn-md btn-info"><i class="fa fa-home"></i> Home</a>
                                                <!--<button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-remove"></i> Reset</button>-->
                                            </div>
                                        </div>
                                    </form>
                                    <div class="social-or-login center">
                                        <span class="bigger-110">CHURCH ERP</span>
                                    </div>

                                    <div class="space-6"></div>
                                </div><!-- /.widget-main -->

                                <!--<div class="toolbar clearfix">
                                    <div>
                                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>I forgot my password
                                        </a>
                                    </div>
                                </div>-->
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->
                    </div><!-- /.position-relative -->

                    <div class="navbar-fixed-top align-right">
                        <br />
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
            <div class="col-md-5 ">
                <div class="position-relative">
                    <div id="login-box" class="login-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header blue lighter bigger">
                                    <i class="ace-icon fa fa-coffee blue"></i>
                                    Church ERP Functionality
                                </h4>

                                <div class="space-6"></div>
                                <div class="panel panel-default">
                                    <!--<div class="panel-heading"><i class="fa fa-flag"></i> Guidelines</div>-->
                                    <div class="panel-body">
                                        <p><h4>Rules & Guidelines</h4></p>
                                        <p>Create an account and start managing your congregation using our Church ERP System. With our ERP System, you will be able to
                                            manage data about your congregation at your finger tips.<br/> The system has several functionality but not limited to the following:<br/>
                                        <ul>
                                            <li>Member registration.</li>
                                            <li>Accounts keeping i.e expenses and income of the church.</li>
                                            <li>Manage projects, keeping records for both completed and ongoing projects.</li>
                                            <li>Keeping church visitors records.</li>
                                            <li>Managing data about Departments and ministries within the church.</li>
                                            <li>Managing Sermons and Calendar of Events.</li>
                                            <li>Managing Baptism data. And many more...</li>
                                        </ul>
                                        </p>
                                        <p>Kindly create a 30 Days free trial account for your church and get to explore the beautiful features of our ERP System. </p>
                                        <p>For any inquiry about the system, kindly contact our Office at +254716413386 or email us at <a href="mailto:robisearch@gmail.com">robisearch@gmail.com</a>/
                                            <a href="mailto:info@robisearch.com">info@robisearch.com</a></p>
                                    </div>
                                </div>

                                <div class="space-6"></div>

                                <div class="social-login center">
                                    <a class="btn btn-primary">
                                        <i class="ace-icon fa fa-facebook"></i>
                                    </a>

                                    <a class="btn btn-info">
                                        <i class="ace-icon fa fa-twitter"></i>
                                    </a>

                                    <a class="btn btn-danger">
                                        <i class="ace-icon fa fa-google-plus"></i>
                                    </a>
                                </div>
                            </div><!-- /.widget-main -->

                            <div class="toolbar clearfix">
                                <!--<div>
                                    <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        I forgot my password
                                    </a>
                                </div>

                                <div>
                                    <a href="#" data-target="#signup-box" class="user-signup-link">
                                        I want to register
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>-->
                            </div>
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
															<input type="email" class="form-control" placeholder="Email" />
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

                    <div id="signup-box" class="signup-box widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header green lighter bigger">
                                    <i class="ace-icon fa fa-users blue"></i>
                                    New User Registration
                                </h4>

                                <div class="space-6"></div>
                                <p> Enter your details to begin: </p>

                                <form>
                                    <fieldset>
                                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                        </label>

                                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
                                        </label>

                                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                        </label>

                                        <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Repeat password" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
                                        </label>

                                        <label class="block">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl">
															I accept the
															<a href="#">User Agreement</a>
														</span>
                                        </label>

                                        <div class="space-24"></div>

                                        <div class="clearfix">
                                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                                <i class="ace-icon fa fa-refresh"></i>
                                                <span class="bigger-110">Reset</span>
                                            </button>

                                            <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                                                <span class="bigger-110">Register</span>

                                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="toolbar center">
                                <a href="#" data-target="#login-box" class="back-to-login-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Back to login
                                </a>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.signup-box -->
                </div><!-- /.position-relative -->

                <div class="navbar-fixed-top align-right">
                    <br />
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
<script src="<?php echo base_url();?>/assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo base_url();?>/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });
    });



    //you don't need this, just used for changing background
    jQuery(function($) {
        $('#btn-login-dark').on('click', function(e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-light').on('click', function(e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function(e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
        });

    });
</script>
</body>
</html>
