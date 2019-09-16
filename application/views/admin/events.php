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
                    Event Lists
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Event Lists
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Add Event
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Add Event
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('Admin_cont/add_event');?>">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Event Name/Title:</label>
                                                                <input class="form-control" name="event_name" placeholder="Event Title" required>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Start Date:</label>
                                                                <input value="<?php echo date('Y-m-d');?>" type="date" class="form-control" name="start_date" required>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>End Date:</label>
                                                                <input value="<?php echo date('Y-m-d');?>" type="date" class="form-control" name="end_date" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                               <label>Description:</label>
                                                               <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 col-xs-12">
                                                                <button type="submit" name="event_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save Event</button>
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
                                            <th class="column-title">Title </th>
                                            <th class="column-title">Description </th>
                                            <th class="column-title">Start Date</th>
                                            <th class="column-title">End Date</th>
                                            <th class="column-title">Added Date</th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($events as $event){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count; ?>.</td>
                                                <td class=" "><?php echo $event['event_name'];?></td>
                                                <td class=" "><?php echo $event['description'];?></td>
                                                <td class=" "><?php echo $event['start_date'];?></td>
                                                <td class=" "><?php echo $event['end_date'];?></td>
                                                <td class=" "><?php echo $event['created_date'];?></td>
                                                <td class=" last">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#more_details<?php echo $event['event_id'];?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                        <a data-toggle="modal" data-target="#delete_event<?php echo $event['event_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update modal-->
                                            <div class="modal" id="more_details<?php echo $event['event_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update Event
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/update_event/'.$event['event_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Event Title:</label>
                                                                        <input value="<?php echo $event['event_name'];?>" class="form-control" name="event_title" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Start Date:</label>
                                                                        <input type="date" value="<?php echo $event['start_date'];?>" class="form-control" name="start_date" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>End Date:</label>
                                                                        <input type="date" value="<?php echo $event['end_date'];?>" class="form-control" name="end_date" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Description:</label>
                                                                        <textarea name="description" class="form-control" value="<?php echo $event['description'];?>"><?php echo $event['description'];?></textarea>
                                                                    </div>
                                                                </div><br/>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="updateevent_btn" class="btn btn-success btn-sm"><i class="fa fa-trash"></i> Update Events</button>
                                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Delete modal-->
                                            <div class="modal" id="delete_event<?php echo $event['event_id'];?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Deleting</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>SURE TO DELETE THE EVENT?</p>
                                                            <form method="post" action="<?php echo site_url('Admin_cont/deleteevent/'.$event['event_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="deleteevent_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Event</button>
                                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
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

