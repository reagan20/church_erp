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

            <div class="page-header">
                <h1>
                    Admin Accounts
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Admin Accounts
                            </h4>
                            <a href="<?php echo site_url('Super_controller/super_admin_signup');?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Account</a>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <?php
                                        if(isset($_SESSION['message'])){
                                            echo $_SESSION['message'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">S/N </th>
                                            <th class="column-title">Full Name </th>
                                            <th class="column-title">Phone </th>
                                            <th class="column-title">Email</th>
                                            <th class="column-title">National ID</th>
                                            <th class="column-title">Status</th>
                                            <th class="column-title">Created Date</th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($admin as $event){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count; ?>.</td>
                                                <td class=" "><?php echo $event['fname'].' '.$event['lname'];?></td>
                                                <td class=" "><?php echo $event['phone'];?></td>
                                                <td class=" "><?php echo $event['email'];?></td>
                                                <td class=" "><?php echo $event['national_id'];?></td>
                                                <td class=" ">
                                                    <?php
                                                    if($event['status']=='Active'){
                                                        ?>
                                                        <a class="btn btn-xs btn-success">Active</a>
                                                        <?php
                                                    }
                                                    elseif ($event['status']=='Inactive'){
                                                        ?>
                                                        <a class="btn btn-xs btn-warning">Inactive</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class=" "><?php echo $event['dated'];?></td>
                                                <td class=" last">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#more_details<?php echo $event['super_id'];?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                        <!--<a data-toggle="modal" data-target="#update_pass<?php //echo $event['super_id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-lock"></i> Update Password</a>-->
                                                        <button disabled data-toggle="modal" data-target="#delete_event<?php //echo $event['event_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update modal-->
                                            <div class="modal" id="more_details<?php echo $event['super_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update Admin Account
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="" method="post" action="<?php echo site_url('Super_controller/updateSuperDetails1/'.$event['super_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <label>First Name: <span class="required">*</span></label>
                                                                        <input value="<?php echo $event['fname'];?>" name="fname" type="text" required="required" class="form-control" placeholder="First Name">
                                                                    </div>

                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <label>Last Name: <span class="required">*</span></label>
                                                                        <input value="<?php echo $event['lname'];?>" type="text" name="lname" required="required" class="form-control" placeholder="Last Name">
                                                                    </div>

                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <label>National ID: <span class="required">*</span></label>
                                                                        <?php
                                                                        if($event['national_id']==$this->session->userdata['national_id']){
                                                                            ?>
                                                                            <input readonly value="<?php echo $event['national_id'];?>" class="form-control" type="number" name="nationalid2" placeholder="National ID">
                                                                        <?php
                                                                        }
                                                                        else{
                                                                            ?>
                                                                            <input value="<?php echo $event['national_id'];?>" class="form-control" type="number" name="nationalid2" required placeholder="National ID">
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                    </div>

                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <label>Phone Number: <span class="required">*</span></label>
                                                                        <input value="<?php echo $event['phone'];?>" class="form-control" type="text" name="phone" required placeholder="Phone Number">
                                                                    </div>

                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <label>Email Address: <span class="required">*</span></label>
                                                                        <input value="<?php echo $event['email'];?>" class="form-control" type="email" name="email" required placeholder="Email Address">
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <label>Status: <span class="required">*</span></label>
                                                                        <select class="form-control" name="status" required>
                                                                            <?php
                                                                            if($event['status']=='Active'){
                                                                                ?>
                                                                                <option value="Active">Active</option>
                                                                                <option value="Inactive">Inactive</option>
                                                                            <?php
                                                                            }
                                                                            elseif ($event['status']=='Inactive'){
                                                                                ?>
                                                                                <option value="Inactive">Inactive</option>
                                                                                <option value="Active">Active</option>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                    <!--<div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <label>Password: <span class="required">*</span></label>
                                                                        <input class="form-control" required="required" type="password" placeholder="Password">
                                                                    </div>-->
                                                                    <div class="ln_solid"></div>
                                                                </div><br/>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <button type="submit" name="updateSuperDetails" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Submit</button>
                                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Updating password-->
                                            <div class="modal" id="update_pass<?php echo $event['super_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update Account Password
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Super_controller/update_user_pass/'.$event['created_by']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>New Password: </label><span class="required">*</span>
                                                                        <input type="password" class="form-control" name="password" placeholder="New Password" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Confirm Password: </label><span class="required">*</span>
                                                                        <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required>
                                                                    </div>
                                                                </div><br/>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="updatepass_btn" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Update Password</button>
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
                                            <!--Delete modal-->
                                            <div class="modal" id="delete_event<?php //echo $event['event_id'];?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Deleting</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php //echo site_url('Admin_cont/deleteevent/'.$event['event_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="deleteevent_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Event</button>
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

                                <hr />

                                <p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div></div><!-- /.main-content -->

