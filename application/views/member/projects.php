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
                    Project Records
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Project Records
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
                                    <table id="datatable" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">S/N </th>
                                            <th class="column-title">Title </th>
                                            <th class="column-title">Description </th>
                                            <th class="column-title">Start Date</th>
                                            <th class="column-title">End Date</th>
                                            <th class="column-title">Status</th>
                                            <th class="column-title">Added Date</th>
                                            <th class="column-title">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($project as $event){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count; ?>.</td>
                                                <td class=" "><?php echo $event['project_name'];?></td>
                                                <td class=" "><?php echo $event['project_description'];?></td>
                                                <td class=" "><?php echo $event['start_date'];?></td>
                                                <td class=" "><?php echo $event['end_date'];?></td>
                                                <td class=" "><?php echo $event['status'];?></td>
                                                <td class=" "><?php echo $event['created'];?></td>
                                                <td class=" last">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#more_details<?php echo $event['project_id'];?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View More</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update modal-->
                                            <div class="modal" id="more_details<?php echo $event['project_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Project Details
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php //echo site_url('Admin_cont/update_project/'.$event['project_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Project Name:</label>
                                                                        <input value="<?php echo $event['project_name'];?>" class="form-control" name="project_name" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Start Date:</label>
                                                                        <input type="date" value="<?php echo $event['start_date'];?>" class="form-control" name="start_date" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>End Date:</label>
                                                                        <input type="date" value="<?php echo $event['end_date'];?>" class="form-control" name="end_date">
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Project Description:</label>
                                                                        <textarea name="description" class="form-control" value="<?php echo $event['project_description'];?>"><?php echo $event['project_description'];?></textarea>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Project Status:</label>
                                                                        <select class="form-control" name="status">
                                                                            <option value="<?php echo $event['status'];?>"><?php echo $event['status'];?></option>
                                                                            <option value="Ongoing">Ongoing</option>
                                                                            <option value="Suspended">Suspended</option>
                                                                            <option value="Completed">Completed</option>
                                                                        </select>
                                                                    </div>
                                                                </div><br/>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                                                                    </div>
                                                                </div>
                                                            </form>
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

