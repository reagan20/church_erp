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
                    Baptism Records
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Baptism Records
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Add Record
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Add Record
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('Admin_cont/add_baptism');?>">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Member:</label> <span class="required">*</span>
                                                                <select class="form-control" id="personSelect" style="width: 100%;" name="member" required>
                                                                    <option value="">~~Select Member~~</option>
                                                                    <?php
                                                                    foreach($members as $mem){
                                                                        ?>
                                                                        <option value="<?php echo $mem['id'];?>"><?php echo $mem['m_firstname'].' '.$mem['m_lastname'].'('.$mem['member_no'].')';?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Date of Baptism:</label> <span class="required">*</span>
                                                                <input value="<?php echo date('Y-m-d');?>" type="date" name="date_of_baptism" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Comment:</label>
                                                                <textarea class="form-control" name="comment" placeholder="Comment"></textarea>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <button type="submit" name="baptism_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Submit Details</button>
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
                                    <table id="datatable" class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">S/N </th>
                                            <th class="column-title">Member Full name</th>
                                            <th class="column-title">Member Number</th>
                                            <th class="column-title">Date of Birth</th>
                                            <th class="column-title">Date of Baptism</th>
                                            <th class="column-title">Comment</th>
                                            <th class="column-title">Conducted By</th>
                                            <th class="column-title">Recorded Date </th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($baptism as $bap){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count;?>.</td>
                                                <td class=" "><?php echo $bap['m_firstname'].' '.$bap['m_lastname'];?></td>
                                                <td class=" "><?php echo $bap['member_no'];?></td>
                                                <td class=" "><?php echo $bap['m_dob'];?></td>
                                                <td class=" "><?php echo $bap['date_of_baptism'];?></td>
                                                <td class=" "><?php echo $bap['comment'];?></td>
                                                <td class=" "><?php echo $bap['title'].' '.$bap['admin_fname'].' '.$bap['admin_lname'];?></td>
                                                <td class=" "><?php echo $bap['recorded_date'];?></td>
                                                <td class=" ">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#baptism_details<?php echo $bap['baptism_id'];?>" class="btn btn-sm btn-info" href=""><i class="fa fa-edit"></i> Edit</a>
                                                        <a data-toggle="modal" data-target="#generateCert<?php echo $bap['baptism_id'];?>" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Print Certificate</a>
                                                        <a data-toggle="modal" data-target="#delete_record<?php echo $bap['baptism_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update baptism records-->
                                            <div class="modal" id="baptism_details<?php echo $bap['baptism_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update Member Baptism Details
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/update_baptism/'.$bap['baptism_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Member:</label>
                                                                        <select class="form-control" name="member" required>
                                                                            <?php
                                                                            foreach($members as $mem1){
                                                                                ?>
                                                                                <option value="<?php echo $mem1['id'];?>" <?php if($mem1['id']==$bap['member']) echo 'selected="selected"'?> ><?php echo $mem1['m_firstname'].' '.$mem1['m_lastname'];?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Date:</label>
                                                                        <input type="date" name="date" value="<?php echo $bap['date_of_baptism'];?>" class="form-control"/>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Description:</label>
                                                                        <textarea name="comment" class="form-control" value="<?php echo $bap['comment'];?>"><?php echo $bap['comment'];?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row"><br/>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="updatebaptism_btn" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save Updates</button>
                                                                        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Generate Baptism Certificate-->
                                            <div class="modal" id="generateCert<?php echo $bap['baptism_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Generate Baptism Certificate
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/generateBaptism/'.$bap['baptism_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Member:</label>
                                                                        <input name="bap_id" value="<?php echo $bap['baptism_id'];?>" style="display: none;">
                                                                        <input name="member" class="form-control" value="<?php echo $bap['m_firstname'].' '.$bap['m_lastname'];?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Date:</label>
                                                                        <input type="date" name="date" value="<?php echo $bap['date_of_baptism'];?>" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="modal-footer">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <button type="submit" name="generatecert_btn" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Get Certificate</button>
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
                                            <div class="modal" id="delete_record<?php echo $bap['baptism_id'];?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Deleting</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>SURE TO DELETE THE RECORD?</p>
                                                            <form method="post" action="<?php echo site_url('Admin_cont/deleteBaptismRecord/'.$bap['baptism_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="deleteBaptism_btn" class="btn btn-danger btn-md"><i class="fa fa-trash"></i> Delete Record</button>
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
                                <hr />
                                <p>
                                    <strong><h5 style="color: red; font-weight: bold;">Total Baptism Records: <?php echo $baptised_members;?></h5></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div></div><!-- /.main-content -->

