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
                    Members Data
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
                                <a data-toggle="tab" href="#home4"><i class="fa fa-users"></i> Members</a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#profile4"><i class="fa fa-user-plus"></i> Add Members</a>
                            </li>
                            <li>
                                <a  href="<?php echo base_url('assets/Members.csv');?>" download><i class="fa fa-download"></i> Download Template</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#dropdown14"><i class="fa fa-upload"></i> Bulk Upload</a>
                            </li>
                            <li>
                                <button data-toggle="modal" data-target="#date_range" class="btn btn-sm btn-warning">Search by Date range <i class="fa fa-calendar"></i></button>
                            </li>
                            <!--<li>
                                <a href="<?php //echo site_url('Admin_cont/members');?>" class="btn btn-info btn-sm">Refresh <i class="fa fa-refresh"></i></a>
                            </li>-->
                        </ul>

                        <div class="tab-content">
                            <div id="home4" class="tab-pane in active">
                                <div class="row">
                                 <div class="col-md-6 col-xs-12">
                                        <form method="post" action="">
                                            <div class="col-md-7 col-xs-12">
                                                <input class="form-control" name="search_input" placeholder="Search here" required>
                                            </div>
                                            <div class="col-md-5">
                                                <button type="submit" name="search_btn" class="btn btn-primary btn-sm">Search <i class="fa fa-search"></i></button>
                                                <a href="<?php echo site_url('Admin_cont/members');?>" class="btn btn-info btn-sm">Refresh <i class="fa fa-refresh"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <!--<button data-toggle="modal" data-target="#date_range" class="btn btn-sm btn-warning">Search by Date range <i class="fa fa-calendar"></i></button>-->
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
                                                                    <input value="<?php echo date('Y-m-d');?>" class="form-control" name="start_date" type="date" required>
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label>End Date:</label> <span class="required">*</span>
                                                                    <input value="<?php echo date('Y-m-d');?>" class="form-control" name="end_date" type="date" required>
                                                                </div>
                                                            </div><br/>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button name="daterange_btn" class="btn btn-sm btn-success"><i class="fa fa-search"></i> Search</button>
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
                                </div><br/>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table  table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="center">S/N</th>
                                                    <th class="detail-col">Details</th>
                                                    <th>Fullname</th>
                                                    <th>Gender</th>
                                                    <th>DOB</th>
                                                    <th class="hidden-480">Phone</th>
                                                    <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>County</th>
                                                    <th class="hidden-480">Residence Place</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $count=1;
                                                foreach($members as $mem){
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
                                                        <td><?php echo $mem['m_firstname'].' '.$mem['m_lastname'].' ('.$mem['member_no'].')';?></td>
                                                        <td class=" ">
                                                            <?php
                                                            foreach($gender as $g){
                                                                if($g['gender_id']==$mem['m_gender']){
                                                                    echo $g['gender_name'];
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class=" "><?php echo $mem['m_dob'];?></td>
                                                        <td class=" "><?php echo $mem['m_phone'];?></td>
                                                        <td class=" "><?php echo $mem['county_name'];?></td>
                                                        <td class=" "><?php echo $mem['m_residenceplace'];?></td>
                                                        <td>
                                                            <div class="hidden-sm hidden-xs btn-group">
                                                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete_member<?php echo $mem['id'];?>">
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
                                                                                        <span class="white"><?php echo $mem['m_firstname'].' '.$mem['m_lastname'];?></span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <form method="post" action="<?php echo site_url('Admin_cont/update_member/'.$mem['id']);?>">
                                                                        <div class="col-xs-12 col-sm-5">
                                                                            <div class="space visible-xs"></div>
                                                                            <div class="profile-user-info profile-user-info-striped">
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> First Name: </div>

                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_firstname'];?>" class="form-control" name="first_name" placeholder="First Name" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Middle Name: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_middlename'];?>" class="form-control" name="middle_name" placeholder="Middle Name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Last Name:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_lastname'];?>" class="form-control" name="last_name" placeholder="Last Name" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">Phone Number:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_phone'];?>" class="form-control" name="phone_number" placeholder="Phone Number">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">Email Address: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_email'];?>" class="form-control" name="email_address" placeholder="Email Address">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Gender: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <select class="form-control" name="gender" required>
                                                                                            <option value="">~~Select Gender~~</option>
                                                                                            <?php
                                                                                            foreach($gender as $ge){
                                                                                                ?>
                                                                                                <option value="<?php echo $ge['gender_id'];?>" <?php if($mem['m_gender']==$ge['gender_id']) echo 'selected="selected"'?>><?php echo $ge['gender_name'];?></option>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-5">
                                                                            <div class="space visible-xs"></div>
                                                                            <div class="profile-user-info profile-user-info-striped">
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">National ID:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_nationalid'];?>" class="form-control" name="national_id" placeholder="National ID">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Place of Birth:</div>
                                                                                    <div class="profile-info-value">
                                                                                        <select name="place_of_birth" class="chosen-select form-control" required>
                                                                                            <?php
                                                                                            foreach($county as $c){
                                                                                                ?>
                                                                                                <option value="<?php echo $c['county_id'];?>" <?php if($mem['m_placeofbirth']==$c['county_id']) echo 'selected="selected"' ?>><?php echo $c['county_name'];?></option>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name">Residence Place: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_residenceplace'];?>" class="form-control" name="residence_place" placeholder="Current residence place" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Date of Birth: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_dob'];?>" type="date" class="form-control" name="dob" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Joining Date: </div>
                                                                                    <div class="profile-info-value">
                                                                                        <input value="<?php echo $mem['m_joiningdate'];?>" class="form-control" type="date" name="joining_date" required>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="profile-info-row">
                                                                                    <div class="profile-info-name"> Action:</div>

                                                                                    <div class="profile-info-value">
                                                                                        <button type="submit" name="updatemember_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Changes</button>
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
                                                    <div class="modal" id="delete_member<?php echo $mem['id'];?>">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Confirm Deleting</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>SURE TO DELETE MEMBER?</p>
                                                                    <form method="post" action="<?php echo site_url('Admin_cont/deletemember/'.$mem['id']);?>">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <button type="submit" name="deletemember_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Member</button>
                                                                                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
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
                                <form method="post" action="<?php echo site_url('Admin_cont/add_member');?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong style="color: red;">NOTE</strong> Fields marked <span class="required">*</span> are required.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label>Member Number</label> <span class="required">*</span>
                                            <div class="form-group">
                                                <?php
                                                /*foreach($max as $m);{
                                                    $id=$m['member_no'];
                                                };*/
                                                ?>
                                                <input value="<?php echo $max+1;?>" class="form-control" name="membership_no" id="membership_no" placeholder="Membership Number" required >
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <label>Enable Member</label>
                                            <input type="checkbox" id="myCheck" onchange="myFunction()" name="myCheck">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>First Name:</label> <span class="required">*</span>
                                                <input class="form-control" name="first_name" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Middle Name:</label>
                                                <input class="form-control" name="middle_name" placeholder="Middle Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Last Name:</label> <span class="required">*</span>
                                                <input class="form-control" name="last_name" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Phone Number:</label>
                                                <input class="form-control" name="phone_number" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Email Address:</label>
                                                <input class="form-control" name="email_address" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Gender:</label> <span class="required">*</span>
                                                <select class="form-control" name="gender" required>
                                                    <option value="">~~Select Gender~~</option>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label>National ID:</label>
                                                <input class="form-control" name="national_id" placeholder="National ID">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label>County of Birth:</label> <span class="required">*</span>
                                                <select class="form-control" style="width: 100%;" name="place_of_birth" id="personSelect" required>
                                                    <option>~~Select County~~</option>
                                                    <?php
                                                    foreach($county as $count){
                                                        ?>
                                                        <option value="<?php echo $count['county_id'];?>"><?php echo $count['county_name'].'('.$count['county_id'].')';?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Residence place:</label> <span class="required">*</span>
                                                <input class="form-control" name="residence_place" placeholder="Current residence place" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Date of Birth:</label> <span class="required">*</span>
                                                <input value="<?php echo date('Y-m-d');?>" type="date" class="form-control" name="dob" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Joining Date:</label> <span class="required">*</span>
                                                <input value="<?php echo date('Y-m-d');?>" class="form-control" type="date" name="joining_date" required>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="form-group">
                                                <label>Role:</label> <span class="required">*</span>
                                                <select class="form-control" name="role" required>
                                                    <option>~~Select Role~~</option>
                                                    <option value="Member">Member</option>
                                                    <option value="Admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <button type="submit" name="addmember_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Details</button>
                                            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-remove"></i> Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="dropdown14" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <form method="post" action="<?php echo site_url('Admin_cont/members_bulk_upload');?>" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Upload Members file</label>
                                                <input class="form-control" type="file" name="csv_file" id="csv_file" accept=".csv" required>
                                            </div>
                                            <div class="form-group">
                                                <button name="membersbulk_btn" class="btn btn-md btn-success"><i class="fa fa-upload"></i> Upload File</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-footer" style="text-align: center;">
                            <h5 style="color: red; font-weight: bold;" class="">TOTAL MEMBERS: <?php echo $member_counts;?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.main-content -->
<script type="text/javascript">
    function myFunction()
    {
        if(document.getElementById("myCheck").checked == true)
        {
            document.getElementById("membership_no").disabled = false;
        }
        else if(document.getElementById("myCheck").checked == false)
        {
            document.getElementById("membership_no").disabled = true;
        }
    }
</script>

