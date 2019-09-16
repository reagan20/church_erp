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
                    Ministry Heads
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Ministry Heads
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Assign Ministry Head
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Assign Ministry Head
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('Admin_cont/add_ministryhead');?>">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Ministry:</label>
                                                                <select class="form-control" name="ministry" required>
                                                                    <option value="">~~Select Ministry~~</option>
                                                                    <?php
                                                                    foreach($ministries as $mini){
                                                                        ?>
                                                                        <option value="<?php echo $mini['ministry_id'];?>"><?php echo $mini['ministry_name'];?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Member:</label>
                                                                <select class="form-control" name="member" required>
                                                                    <option value="">~~Select Member~~</option>
                                                                    <?php
                                                                    foreach($members as $mem){
                                                                        ?>
                                                                        <option value="<?php echo $mem['id'];?>"><?php echo $mem['m_firstname'].' '.$mem['m_lastname'];?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Start Date:</label>
                                                                <input value="<?php echo date('Y-m-d');?>" class="form-control" name="start_date" type="date" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <button type="submit" name="ministryhead_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Details</button>
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">S/N </th>
                                            <th class="column-title">Ministry Name </th>
                                            <th class="column-title">Head Name </th>
                                            <th class="column-title">Start Date </th>
                                            <th class="column-title">End Date </th>
                                            <th class="column-title">Status </th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($heads as $h){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count;?>.</td>
                                                <td class=" "><?php echo $h['ministry_name'];?></td>
                                                <td class=" "><?php echo $h['m_firstname'].' '.$h['m_lastname'];?></td>
                                                <td class=" "><?php echo $h['start_date'];?></td>
                                                <td class=" "><?php echo $h['end_date'];?></td>
                                                <td class=" "><?php echo $h['m_status'];?></td>
                                                <td class=" ">
                                                    <?php
                                                    if($h['m_status']=='Active'){
                                                        ?>
                                                        <a data-toggle="modal" data-target="#update_status<?php echo $h['ministry_head_id'];?>" class="btn btn-sm btn-warning" >Deactivate</a>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <a data-toggle="modal" data-target="#update_status<?php echo $h['ministry_head_id'];?>" class="btn btn-sm btn-info" >Activate</a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <a class="btn btn-sm btn-info" >More Details>></a>
                                                </td>
                                            </tr>
                                            <!--Update status modal-->
                                            <div id="update_status<?php echo $h['ministry_head_id'];?>" class="modal fade" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update Status
                                                            </div>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/update_ministry_head_status/'.$h['ministry_head_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>~Status:</label>
                                                                        <select class="form-control" name="status">
                                                                            <option>~~Select Status~~</option>
                                                                            <option value="Active">Active</option>
                                                                            <option value="Inactive">Inactive</option>
                                                                        </select>
                                                                    </div>
                                                                </div><br/>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="updatestatus_btn" class="btn btn-success btn-sm"><i class="fa fa-trash"></i> Update Status</button>
                                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
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
    </div><!-- /.main-content -->
</div>
