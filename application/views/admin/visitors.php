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
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </form>
            </div><!-- /.nav-search -->
        </div>

        <div class="page-content">
            <div class="ace-settings-container" id="ace-settings-container">
            </div><!-- /.ace-settings-container -->

            <div class="page-header">
                <h1>
                    Visitors Data
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-md-12">
                    <?php
                    if(isset($_SESSION['message'])){
                        echo $_SESSION['message'];
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                            <li class="active">
                                <a data-toggle="tab" href="#home4"><i class="fa fa-users"></i> Visitors</a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#profile4"><i class="fa fa-user-plus"></i> Add Visitors</a>
                            </li>

                            <!--<li>
                                <a data-toggle="tab" href="#dropdown14"><i class="fa fa-upload"></i> Bulk Upload</a>
                            </li>-->
                        </ul>

                        <div class="tab-content">
                            <div id="home4" class="tab-pane in active">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <button data-toggle="modal" data-target="#date_range" class="btn btn-warning btn-sm">Search by Date <i class="fa fa-calendar"></i></button>
                                        <a href="<?php echo site_url('Admin_cont/visitors');?>" class="btn btn-info btn-sm">Refresh <i class="fa fa-refresh"></i></a>
                                        <div class="modal" id="date_range">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #1A82C3; color: white;">
                                                        <h4 class="modal-title">Search By Date Range</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php //echo site_url('Admin_cont/deletemember/'.$mem['id']);?>">
                                                            <div class="row">
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label>Start Date:</label> <span class="required">*</span>
                                                                    <input class="form-control" name="start_date" type="date" required>
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label>End Date:</label> <span class="required">*</span>
                                                                    <input class="form-control" name="end_date" type="date" required>
                                                                </div>
                                                            </div><br/>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button name="daterange_btn" class="btn btn-md btn-success"><i class="fa fa-search"></i> Search</button>
                                                                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table id="simple-table" class="table  table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="center">S/N</th>
                                                    <th class="detail-col">Details</th>
                                                    <th>Fullname</th>
                                                    <th>Gender</th>
                                                    <th class="hidden-480">Phone</th>
                                                    <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Email</th>
                                                    <th class="hidden-480">Residence Place</th>
                                                    <th>Visit Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $count=1;
                                                foreach($visitors as $mem){
                                                    ?>
                                                    <tr>
                                                        <td class="center"><?php echo $count;?>.</td>

                                                        <td class="center">
                                                            <div class="action-buttons">
                                                                <a href="#" class="blue bigger-140 show-details-btn" title="Show Details">
                                                                    <i class="ace-icon fa fa-angle-double-down">More</i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $mem['v_firstname'].' '.$mem['v_lastname'];?></td>
                                                        <td class=" ">
                                                            <?php
                                                            foreach($gender as $g){
                                                                if($g['gender_id']==$mem['v_gender']){
                                                                    echo $g['gender_name'];
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class=" "><?php echo $mem['v_phone'];?></td>
                                                        <td class=" "><?php echo $mem['v_email'];?></td>
                                                        <td class=" "><?php echo $mem['v_residenceplace'];?></td>
                                                        <td class=" "><?php echo $mem['v_visitingdate'];?></td>
                                                        <td>
                                                            <div class="hidden-sm hidden-xs btn-group">
                                                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete_visitor<?php echo $mem['visitor_no'];?>">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i> Delete
                                                                </button>
                                                                <!--<button class="btn btn-xs btn-warning">
                                                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                                                </button>-->
                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                            <span class="red">
                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                            </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="detail-row">
                                                        <td colspan="8">
                                                            <div class="table-detail">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-2">
                                                                        <div class="text-center">
                                                                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="<?php echo base_url();?>assets/images/avatars/profile-pic.jpg" />
                                                                            <br />
                                                                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                                <div class="inline position-relative">
                                                                                    <a class="user-title-label" href="#">
                                                                                        <i class="ace-icon fa fa-circle light-green"></i>&nbsp;
                                                                                        <span class="white"><?php echo $mem['v_firstname'].' '.$mem['v_lastname'];?></span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <form method="post" action="<?php echo site_url('Admin_cont/update_visitor/'.$mem['visitor_no']);?>">
                                                                        <div class="col-xs-12 col-sm-5">
                                                                            <div class="space visible-xs"></div>
                                                                            <div class="profile-user-info profile-user-info-striped">
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> First Name: </div>

                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['v_firstname'];?>" class="form-control" name="first_name" placeholder="First Name" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Middle Name: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['v_middlename'];?>" class="form-control" name="middle_name" placeholder="Middle Name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Last Name:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['v_lastname'];?>" class="form-control" name="last_name" placeholder="Last Name" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">Phone Number:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['v_phone'];?>" class="form-control" name="phone_number" placeholder="Phone Number">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">Email Address: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['v_email'];?>" class="form-control" name="email_address" placeholder="Email Address">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-5">
                                                                            <div class="space visible-xs"></div>
                                                                            <div class="profile-user-info profile-user-info-striped">
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Gender: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <select class="form-control" name="gender" required>
                                                                                            <option value="">~~Select Gender~~</option>
                                                                                            <?php
                                                                                            foreach($gender as $ge){
                                                                                                ?>
                                                                                                <option value="<?php echo $ge['gender_id'];?>" <?php if($mem['v_gender']==$ge['gender_id']) echo 'selected="selected"'?>><?php echo $ge['gender_name'];?></option>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">Residence Place:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['v_residenceplace'];?>" name="residence_place" class="form-control" placeholder="Current residence place">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">Visiting Date: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['v_visitingdate'];?>" class="form-control" name="visiting_date" type="date">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Action:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <button type="submit" name="updatevisitor_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Changes</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <!--<div class="col-xs-12 col-sm-3">
                                                                        <div class="space visible-xs"></div>
                                                                        <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                                        <div class="space-6"></div>

                                                                        <form>
                                                                            <fieldset>
                                                                                <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                                            </fieldset>

                                                                            <div class="hr hr-dotted"></div>

                                                                            <div class="clearfix">
                                                                                <label class="pull-left">
                                                                                    <input type="checkbox" class="ace" />
                                                                                    <span class="lbl"> Email me a copy</span>
                                                                                </label>

                                                                                <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                                                    Submit
                                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!--Delete modal-->
                                                    <div class="modal" id="delete_visitor<?php echo $mem['visitor_no'];?>">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Confirm Deleting</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="<?php echo site_url('Admin_cont/deletevisitor/'.$mem['visitor_no']);?>">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <button type="submit" name="deletevisitor_btn" class="btn btn-danger btn-md"><i class="fa fa-trash"></i> Delete Visitor</button>
                                                                                <button type="button" class="btn btn-warning btn-md" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="profile4" class="tab-pane">
                                <form method="post" action="<?php echo site_url('Admin_cont/add_visitor');?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong style="color: red;">NOTE</strong> Fields marked <span class="required">*</span> are required.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>First Name:</label> <span class="required">*</span>
                                                <input name="first_name" class="form-control" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Middle Name:</label>
                                                <input name="middle_name" class="form-control" placeholder="Middle Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Last Name:</label> <span class="required">*</span>
                                                <input name="last_name" class="form-control" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Gender:</label> <span class="required">*</span>
                                                <select class="form-control" name="gender" required>
                                                    <option>~~Select Gender~~</option>
                                                    <?php
                                                    foreach($gender as $ge){
                                                        ?>
                                                        <option value="<?php echo $ge['gender_id'];?>"><?php echo $ge['gender_name'];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Town/Location:</label>
                                                <select class="form-control" name="town" required>
                                                    <option>~~Select Town~~</option>
                                                    <option id="Kisumu">Kisumu</option>
                                                    <option id="Nairobi">Nairobi</option>
                                                </select>
                                            </div>
                                        </div>-->
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Residence place:</label>
                                                <input name="residence_place" class="form-control" placeholder="Current residence place">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Phone Number:</label>
                                                <input name="phone_number" class="form-control" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Email Address:</label>
                                                <input name="email_address" class="form-control" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Date:</label> <span class="required">*</span>
                                                <input value="<?php echo date('Y-m-d');?>" class="form-control" name="visiting_date" type="date">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label>How did you know about us?</label> <span class="required">*</span>
                                                <textarea class="form-control" name="about_us" placeholder="How did you know about us?" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <button type="submit" name="addvisitor_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Details</button>
                                            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-remove"></i> Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="dropdown14" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <form method="post">
                                            <div class="form-group">
                                                <label>Upload Visitors file</label>
                                                <input class="form-control" type="file" name="csv_file">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-md btn-success"><i class="fa fa-upload"></i> Upload File</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-footer" style="text-align: center;">
                            <h5 style="color: red; font-weight: bold;" class="">TOTAL VISITORS: <?php echo $visitors_count;?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.main-content -->

