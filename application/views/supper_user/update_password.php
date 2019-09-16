<?php
foreach($details as $det){
    $role=$det['role'];
    $fname=$det['fname'];
    $lname=$det['lname'];
    $national=$det['national_id'];
    $phone=$det['phone'];
    $email=$det['email'];
    $signup=$det['dated'];
    $id=$det['super_id'];
}
?>
<?php
foreach($details as $det){
    $super_id=$det['super_id'];
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
                    Update Password
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <i class="fa fa-user"></i> <h4 class="widget-title">Update Password</h4>
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
                                    <div class="col-md-12 col-xs-12">
                                        <form method="post" action="<?php echo site_url('Super_controller/updatePassword/'.$super_id)?>" id="demo-form2" class="form-horizontal form-label-left">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">New Password <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name="password" type="password" required="required" class="form-control col-md-7 col-xs-12" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirm Password <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input  type="password" name="password2" required="required" class="form-control col-md-7 col-xs-12" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button name="updatepass_btn" type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save Changes</button>
                                                    <button type="reset" class="btn btn-warning btn-sm"><i class="fa fa-remove"></i> Cancel</button>
                                                </div>
                                            </div>

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

