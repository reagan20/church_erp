<?php foreach($church as $ch){
    $ch_id=$ch['church_id'];
    $ch_name=$ch['church_name'];
    $ch_phone=$ch['phone'];
    $ch_email=$ch['email'];
    $ch_location=$ch['location'];
    $ch_county=$ch['county'];
    $ch_status=$ch['status'];
    $signup_date=$ch['signup_date'];
    $motto=$ch['motto'];
};?>
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
                    Church Details
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Church Details Setting
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Set The Church Logo
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Set Church Logo
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" enctype="multipart/form-data" action="<?php echo site_url('Admin_cont/upload_logo/'.$this->session->userdata['id']);?>">
                                                        <div class="form-group">
                                                            <label>Logo:</label>
                                                            <input type="file" name="logo" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button name="church_logo" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SUBMIT</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                </div>
                            </div>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="<?php echo site_url('Admin_cont/updateChurchDetails/'.$ch_id)?>">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Church Name:</label>
                                                        <input name="church_name" value="<?php echo $ch_name;?>" class="form-control" placeholder="Church Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Phone Number:</label>
                                                        <input value="<?php echo $ch_phone;?>" name="phone"  class="form-control" placeholder="Phone Number" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Email Address:</label>
                                                        <input name="email" value="<?php echo $ch_email;?>" class="form-control" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>County:</label>
                                                        <select class="form-control" name="county" required>
                                                            <?php
                                                            foreach($county as $count){
                                                                ?>
                                                                <option value="<?php echo $count['county_id'];?>" <?php if($count['county_id']==$ch_county) echo 'selected="selected"';?>><?php echo $count['county_name'];?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Location:</label>
                                                        <input value="<?php echo $ch_location;?>" name="location" class="form-control" placeholder="Location" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Account Status:</label>
                                                        <input value="<?php echo $ch_status; ?>" disabled class="form-control" placeholder="Account Status">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Account Creation Date:</label>
                                                        <input value="<?php echo $signup_date; ?>" disabled class="form-control" placeholder="Account Creation Date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Church Motto:</label>
                                                        <textarea name="motto" class="form-control" value="<?php echo $motto; ?>"><?php echo $motto; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pull-right">
                                                <div class="col-md-4 col-xs-12">
                                                    <button type="submit" name="updateChurch_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <hr />

                                <p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Project Records
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Add New Project
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Add Project
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('Admin_cont/add_project');?>">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Project Name:</label>
                                                                <input class="form-control" name="project_name" placeholder="Project Name" required>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Start Date:</label>
                                                                <input type="date" class="form-control" name="start_date" required>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Project Status:</label>
                                                                <select class="form-control" name="status" required>
                                                                    <option value="">~~Select Status~~</option>
                                                                    <option value="Ongoing">Ongoing</option>
                                                                    <option value="Suspended">Suspended</option>
                                                                    <option value="Completed">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Project Description:</label>
                                                                <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <button type="submit" name="project_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Project</button>
                                                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-remove"></i> Reset</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                </div>
                            </div>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr class="headings">
                                                        <th class="column-title">S/N </th>
                                                        <th class="column-title">Church Name </th>
                                                        <th class="column-title">Phone Number </th>
                                                        <th class="column-title">Email Address </th>
                                                        <th class="column-title">Location</th>
                                                        <th class="column-title">Status</th>
                                                        <th class="column-title">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $count=1;
                                                foreach($church as $ch){
                                                    ?>
                                                    <tr class="even pointer">
                                                        <td class=""><?php echo $count;?></td>
                                                        <td class=""><?php echo $ch['church_name'];?></td>
                                                        <td class=""><?php echo $ch['phone'];?></td>
                                                        <td class=""><?php echo $ch['email'];?></td>
                                                        <td class=""><?php echo $ch['location'];?></td>
                                                        <th class=""><?php echo $ch['status'];?></th>
                                                        <th class=""><?php echo $ch['signup_date'];?></th>
                                                    </tr>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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

