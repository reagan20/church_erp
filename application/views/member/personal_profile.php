<?php
foreach($member_details as $det){
    $role=$det['role'];
    $fname=$det['m_firstname'];
    $mname=$det['m_middlename'];
    $lname=$det['m_lastname'];
    $national=$det['m_nationalid'];
    $phone=$det['m_phone'];
    $email=$det['m_email'];
    $signup=$det['m_joiningdate'];
    $id=$det['id'];
    $gender=$det['gender_name'];
    $dob=$det['m_dob'];
    $county=$det['county_name'];
    $residence=$det['m_residenceplace'];
}
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input"
                               autocomplete="off"/>
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Personal Details
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <i class="fa fa-user"></i> <h4 class="widget-title">Personal Details</h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <?php
                                        if (isset($_SESSION['message'])) {
                                            echo $_SESSION['message'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="<?php// echo site_url('Admin_cont/updateChurchAdminDetails/'.$id);?>" id="demo-form2" class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="fname" value="<?php echo $fname;?>" type="text" required="required" class="form-control col-md-7 col-xs-12" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Middle Name: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="title" value="<?php echo $mname;?>" type="text" required="required" class="form-control col-md-7 col-xs-12" placeholder="Title e.g (Mr,Mrs,Rev e.t.c)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $lname;?>" type="text" name="lname" required="required" class="form-control col-md-7 col-xs-12" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date of Birth: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="dob" value="<?php echo $dob;?>" type="text" required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gender: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $gender;?>" type="text" name="gender" required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">National ID:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $national;?>" readonly class="form-control col-md-7 col-xs-12" type="number" name="national_id" placeholder="National ID">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $phone;?>" class="form-control col-md-7 col-xs-12" type="text" name="phone" placeholder="Phone Number">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Address:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $email;?>" class="form-control col-md-7 col-xs-12" type="email" name="email" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Place of Birth:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $county;?>" class="form-control col-md-7 col-xs-12" type="email" name="email" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Place of Residence:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $residence;?>" class="form-control col-md-7 col-xs-12" type="email" name="email" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Role:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $role;?>" class="form-control col-md-7 col-xs-12" required="required" type="text" placeholder="Role" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sign Up Date:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input value="<?php echo $signup;?>" class="form-control col-md-7 col-xs-12" required="required" type="text" placeholder="Sign up date" readonly>
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <!--<div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button name="updateadminDetails" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                                                </div>
                                            </div>-->

                                        </form>
                                    </div>
                                </div>
                                <hr/>

                                <p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div></div><!-- /.main-content -->

