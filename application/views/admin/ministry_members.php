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
                    Ministry Members
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Ministry Members
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department"
                                            class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Add New Ministry
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Create Ministry
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post"
                                                          action="<?php echo site_url('Admin_cont/add_ministry'); ?>">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Ministry Name:</label>
                                                                    <input name="ministry" class="form-control"
                                                                           placeholder="Enter Ministry" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12">
                                                                <button type="submit" name="ministry_btn"
                                                                        class="btn btn-info btn-sm"><i
                                                                        class="fa fa-save"></i> Submit Details
                                                                </button>
                                                                <button type="reset" class="btn btn-sm btn-warning"><i
                                                                        class="fa fa-remove"></i> Reset
                                                                </button>
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
                                        if (isset($_SESSION['message'])) {
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
                                            <th class="column-title">Member Name </th>
                                            <th class="column-title">Member ID </th>
                                            <th class="column-title">Start Date </th>
                                            <th class="column-title">End Date </th>
                                            <th class="column-title">Status </th>
                                            <th class="column-title">Created Date </th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        if($ministry_members){

                                        }
                                        foreach($ministry_members as $mini){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count;?>.</td>
                                                <td class=" "><?php echo $mini['m_firstname'].' '.$mini['m_middlename'].' '.$mini['m_lastname'];?></td>
                                                <td class=" "><?php echo $mini['member_no'];?></td>
                                                <td class=" "><?php echo $mini['start_date'];?></td>
                                                <td class=" "><?php echo $mini['end_date'];?></td>
                                                <td class=" "><?php echo $mini['member_status'];?></td>
                                                <td class=" "><?php echo $mini['created'];?></td>
                                                <td class=" ">
                                                    <div class="btn-group">
                                                        <?php
                                                        if($mini['member_status']=='Active'){
                                                            ?>
                                                            <a data-toggle="modal" data-target="#more_details<?php echo $mini['ministrymember_id'];?>" class="btn btn-sm btn-warning"><i class="fa fa-warning"></i> Deactivate</a>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <a data-toggle="modal" data-target="#more_details<?php echo $mini['ministrymember_id'];?>" class="btn btn-sm btn-info"><i class="fa fa-bell"></i> Activate</a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update ministry_member modal-->
                                            <div class="modal" id="more_details<?php echo $mini['ministrymember_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Status</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/update_ministry_member_status/'.$mini['ministrymember_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <input style="display: none;" name="ministry_id" value="<?php echo $mini['ministry_id'];?>">
                                                                        <label>Status:</label>
                                                                        <select class="form-control" name="status">
                                                                            <option value="<?php echo $mini['member_status'];?>"><?php echo $mini['member_status'];?></option>
                                                                            <?php
                                                                            if($mini['member_status']=='Active'){
                                                                                ?>
                                                                                <option value="Inactive">Deactivate</option>
                                                                                <?php
                                                                            }
                                                                            else{
                                                                                ?>
                                                                                <option value="Active">Activate</option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="modal-footer">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <button type="submit" name="updateministrymemberstatus_btn" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Update Status</button>
                                                                            <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Delete modal-->
                                            <div class="modal" id="delete_ministry<?php //echo $mini['ministry_id'];?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Deleting</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php //echo site_url('Admin_cont/deleteministry/'.$mini['ministry_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="deleteministry_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Ministry</button>
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

                                <hr/>

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
