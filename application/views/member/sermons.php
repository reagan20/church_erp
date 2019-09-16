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
                    Sermons Lists
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Sermons Lists
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
                                            <th class="column-title">Title </th>
                                            <th class="column-title">Sermon Description </th>
                                            <th class="column-title">Date </th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($sermons as $ser){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count;?>.</td>
                                                <td class=" "><?php echo $ser['sermon_title'];?></td>
                                                <td class=" "><?php echo $ser['description'];?></td>
                                                <td class=" "><?php echo $ser['added_date'];?></td>
                                                <td class=" ">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#edit_sermon<?php echo $ser['sermon_id'];?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View More</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update modal-->
                                            <div class="modal" id="edit_sermon<?php echo $ser['sermon_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update Sermon
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php //echo site_url('Admin_cont/update_sermon/'.$ser['sermon_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Sermon Title:</label>
                                                                        <input value="<?php echo $ser['sermon_title'];?>" class="form-control" name="sermon_title" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Date:</label>
                                                                        <input type="date" value="<?php echo $ser['added_date'];?>" class="form-control" name="added_date" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Description:</label>
                                                                        <textarea name="description" class="form-control" value="<?php echo $ser['description'];?>"><?php echo $ser['description'];?></textarea>
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
                                            <!--Delete modal-->
                                            <div class="modal" id="delete_sermon<?php echo $ser['sermon_id'];?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Deleting</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/deletesermon/'.$ser['sermon_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="deletesermon_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Sermon</button>
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

