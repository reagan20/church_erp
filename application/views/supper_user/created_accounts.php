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
                    Created Accounts
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Church Account Records
                            </h4>
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
                                            <th class="column-title">Church Name </th>
                                            <th class="column-title">Phone </th>
                                            <th class="column-title">Email</th>
                                            <th class="column-title">County</th>
                                            <th class="column-title">Location</th>
                                            <th class="column-title">Status</th>
                                            <th class="column-title">Expiry</th>
                                            <th class="column-title">Created Date</th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($church as $event){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count; ?>.</td>
                                                <td class=" "><?php echo $event['church_name'];?></td>
                                                <td class=" "><?php echo $event['phone'];?></td>
                                                <td class=" "><?php echo $event['email'];?></td>
                                                <td class=" "><?php echo $event['county_name'];?></td>
                                                <td class=" "><?php echo $event['location'];?></td>
                                                <td class=" ">
                                                    <?php
                                                    $today=date('Y-m-d');
                                                    if($event['expiry']<$today){
                                                        ?>
                                                        <a class="btn btn-xs btn-warning">Inactive</a>
                                                        <?php
                                                    }
                                                    elseif ($event['expiry']>=$today){
                                                        ?>
                                                        <a class="btn btn-xs btn-success">Active</a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class=" "><?php echo $event['expiry'];?></td>
                                                <td class=" "><?php echo $event['created_date'];?></td>
                                                <td class=" last">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#more_details<?php echo $event['church_id'];?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                        <a data-toggle="modal" data-target="#update_pass<?php echo $event['church_id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-lock"></i> Update Password</a>
                                                        <button disabled data-toggle="modal" data-target="#delete_event<?php //echo $event['event_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update modal-->
                                            <div class="modal" id="more_details<?php echo $event['church_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update Account Status
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Super_controller/updateStatus/'.$event['church_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Account Status:</label>
                                                                        <?php
                                                                        $today=date('Y-m-d');
                                                                        if($event['expiry']<=$today){
                                                                            ?>
                                                                            <input class="form-control" value="Inactive" readonly>
                                                                            <?php
                                                                        }
                                                                        elseif ($event['expiry']>$today){
                                                                            ?>
                                                                            <input class="form-control" value="Active" readonly>
                                                                            <?php
                                                                        }
                                                                        ?>

                                                                        <!--                                                            <select class="form-control" name="status">-->
                                                                        <!--                                                                <option value="--><?php //echo $event['status'];?><!--">--><?php //echo $event['status'];?><!--</option>-->
                                                                        <!--                                                                --><?php
                                                                        //                                                                if($event['status']=='Active'){
                                                                        //                                                                    ?>
                                                                        <!--                                                                    <option value="Inactive">Deactivate</option>-->
                                                                        <!--                                                                --><?php
                                                                        //                                                                }
                                                                        //                                                                elseif($event['status']=='Inactive'){
                                                                        //                                                                    ?>
                                                                        <!--                                                                    <option value="Active">Activate</option>-->
                                                                        <!--                                                                --><?php
                                                                        //                                                                }
                                                                        //                                                                ?>
                                                                        <!--                                                            </select>-->
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Expiry Date:</label>
                                                                        <input name="expiry" class="form-control" value="<?php echo $event['expiry']?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Adjust Date:</label>
                                                                        <input type="number" class="form-control" name="days_number" placeholder="Enter Number of Days" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12" style="display: none;">
                                                                        <label>Description:</label>
                                                                        <textarea name="description" class="form-control" value=""></textarea>
                                                                    </div>
                                                                </div><br/>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="updatechurch_btn" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Update Status</button>
                                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Updating password-->
                                            <div class="modal" id="update_pass<?php echo $event['church_id'];?>">
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

