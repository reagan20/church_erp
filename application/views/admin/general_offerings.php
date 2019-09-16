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
                    General Offering
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">General Offering
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Add General Offering
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Add General Offering
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('Admin_cont/add_generaloffering');?>">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                               <label>Pick Date:</label> <span class="required">*</span>
                                                               <input type="date" name="date" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                               <label>Enter Amount:</label> <span class="required">*</span>
                                                               <input name="amount" class="form-control" placeholder="Enter Amount" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                              <label>Description:</label>
                                                              <textarea class="form-control" name="comment" placeholder="Enter comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 col-xs-12">
                                                                <button type="submit" name="generaloffering_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Submit Details</button>
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
                                    <div class="col-md-6 col-xs-12">
                                        <button data-toggle="modal" data-target="#date_range" class="btn btn-warning btn-sm">Search by Date <i class="fa fa-calendar"></i></button>
                                        <a href="<?php echo site_url('Admin_cont/general_offering');?>" class="btn btn-info btn-sm">Refresh <i class="fa fa-refresh"></i></a>
                                        <div class="modal" id="date_range">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #1A82C3; color: white;">
                                                        <h4 class="modal-title">Search By Date Range</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action=" ">
                                                            <div class="row">
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label>Start Date:</label> <span class="required">*</span>
                                                                    <input class="form-control" name="start_date" type="date" required>
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <label>End Date:</label> <span class="required">*</span>
                                                                    <input class="form-control" name="end_date" type="date" required>
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">S/N </th>
                                            <th class="column-title">Offering Amount </th>
                                            <th class="column-title">Created Date </th>
                                            <th class="column-title">Comment </th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($general as $mini){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count;?>.</td>
                                                <td class=" "><?php echo number_format($mini['amount'],2);?></td>
                                                <td class=" "><?php echo $mini['payment_date'];?></td>
                                                <td class=" "><?php echo $mini['description'];?></td>
                                                <td class=" ">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#more_details<?php echo $mini['offering_id'];?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                        <a data-toggle="modal" data-target="#delete_category<?php echo $mini['offering_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update offering category modal-->
                                            <div class="modal" id="more_details<?php echo $mini['offering_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header no-padding">
                                                            <div class="table-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                    <span class="white">&times;</span>
                                                                </button>
                                                                Update General Offering
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/update_generaloffering/'.$mini['offering_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Date:</label>
                                                                        <input value="<?php echo $mini['payment_date'];?>" class="form-control" name="date" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <label>Amount:</label>
                                                                        <input value="<?php echo $mini['amount'];?>" class="form-control" name="amount" required>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Description:</label>
                                                                            <textarea class="form-control" name="comment" placeholder="Enter comment" value="<?php echo $mini['description']?>"><?php echo $mini['description']?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <button type="submit" name="updategeneraloffering_btn" class="btn btn-success btn-sm"><i class="fa fa-trash"></i> Update Offering</button>
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
                                            <div class="modal" id="delete_category<?php echo $mini['offering_id'];?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Deleting <i class="fa fa-warning"></i></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>SURE TO DELETE?</h5>
                                                            <form method="post" action="<?php echo site_url('Admin_cont/deletegeneraloffering/'.$mini['offering_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="deleteoffering_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Category</button>
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
                                <h5 style="color: red; font-weight: bold;" class="">TOTAL GENERAL OFFERING: <?php foreach($totalgeneral as $tot){}; echo number_format($tot['amount'],2);?></h5>
                            </div>

                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div>
    <script type="text/javascript">
        function refFunction(val){
            if(val!==''){
                if(val=='CASH'){
                    $("#t_code").hide();
                }
                else if(val=='MPESA'){
                    $("#t_code").show();
                }
                else if(val=='CHEQUE'){
                    $("#t_code").show();
                }
            }
            else{
                $("#t_code").hide();
            }
        }
    </script>
    <script type="text/javascript">
        function projFunction(val){
            if(val!==''){
                if(val=='1'){
                    $("#proj").hide();
                }
                else if(val=='2'){
                    $("#proj").show();
                }
            }
            else{
                $("#proj").hide();
            }
        }
    </script>

