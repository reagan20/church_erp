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
                    Tithes/Offerings
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Tithes/Offerings
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Add Offering/Tithe
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Record Offering/Tithe
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('Admin_cont/add_offering');?>">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <label>Member:</label> <span class="required">*</span>
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
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <label>Offering Category:</label> <span class="required">*</span>
                                                                <select class="form-control" name="category" required onchange="projFunction(this.value)";>
                                                                    <option value="">~~Select Category~~</option>
                                                                    <?php
                                                                    foreach($category as $cat){
                                                                        ?>
                                                                        <option value="<?php echo $cat['category_id'];?>"><?php echo $cat['category_name'];?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12" id="proj" style="display: none;">
                                                                <label>Projects:</label> <span class="required">*</span>
                                                                <select class="form-control" name="project">
                                                                    <option value="">~~Select Project~~</option>
                                                                    <?php
                                                                    foreach($active_project as $proj){
                                                                        ?>
                                                                        <option value="<?php echo $proj['project_id'];?>"><?php echo $proj['project_name'];?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                               <label>Amount:</label> <span class="required">*</span>
                                                               <input type="text" name="amount" class="form-control" placeholder="Enter Amount" required>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <label>Payment Mode:</label> <span class="required">*</span>
                                                                <select class="form-control" required name="pay_mode" id="pay_mode" onchange="refFunction(this.value);">
                                                                    <option value="">~~Select Payment Mode~~</option>
                                                                    <option value="CASH">CASH</option>
                                                                    <option value="MPESA">MPESA</option>
                                                                    <option value="CHEQUE">CHEQUE</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12" id="t_code" style="display: none;">
                                                               <label>Transaction Code:</label> <span class="required">*</span>
                                                               <input class="form-control" name="t_code" placeholder="Transaction Code">
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <label>Payment Status:</label> <span class="required">*</span>
                                                                <select class="form-control" required name="status">
                                                                    <option value="Approved">Approved</option>
                                                                    <option value="Pending">Pending</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                               <label>Date:</label> <span class="required">*</span>
                                                               <input value="<?php echo date('Y-m-d');?>" type="date" name="pay_date" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label>Description:</label>
                                                                <textarea class="form-control" name="description" placeholder="Descriprion"></textarea>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <button type="submit" name="offering_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Submit Details</button>
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
                                        <form method="post" action="">
                                            <div class="col-md-8 col-xs-12">
                                                <input class="form-control" name="search_input" placeholder="Search here" required>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" name="randomsearch_btn" class="btn btn-primary btn-sm">Search <i class="fa fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <button data-toggle="modal" data-target="#date_range" class="btn btn-warning btn-sm">Search by Date <i class="fa fa-calendar"></i></button>
                                        <a href="<?php echo site_url('Admin_cont/tithes_givings');?>" class="btn btn-info btn-sm">Refresh <i class="fa fa-refresh"></i></a>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title">S/N </th>
                                                    <th class="column-title">Member </th>
                                                    <th class="column-title">Category </th>
                                                    <th class="column-title">Amount</th>
                                                    <th class="column-title">Pay Mode</th>
                                                    <th class="column-title">Code</th>
                                                    <th class="column-title">Description</th>
                                                    <th class="column-title">Date</th>
                                                    <th class="column-title">Status</th>
                                                    <th class="column-title">Recorded Date </th>
                                                    <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $count=1;
                                                foreach($offering as $offer){
                                                    ?>
                                                    <tr class="even pointer">
                                                        <td class=" "><?php echo $count;?>.</td>
                                                        <td class=" "><?php echo $offer['m_firstname'].' '.$offer['m_lastname'].' ('.$offer['member_no'].')';?></td>
                                                        <td class=" "><?php echo $offer['category_name'];?></td>
                                                        <td class=" "><?php echo number_format($offer['amount'],2);?></td>
                                                        <td class=" "><?php echo $offer['pay_mode'];?></td>
                                                        <td class=" "><?php
                                                            if($offer['transaction_code']!=""){
                                                                echo $offer['transaction_code'];
                                                            }
                                                            else{
                                                                echo 'N/A';
                                                            }
                                                            ?></td>
                                                        <td class=" "><?php echo $offer['description'];?></td>
                                                        <td class=" "><?php echo $offer['payment_date'];?></td>
                                                        <td class=" ">
                                                            <?php
                                                            if($offer['p_status']=='Approved'){
                                                                ?>
                                                                <a class="btn btn-xs btn-success">Approved</a>
                                                                <?php
                                                            }
                                                            elseif ($offer['p_status']=='Pending'){
                                                                ?>
                                                                <a class="btn btn-xs btn-warning">Pending</a>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php //echo $offer['p_status'];?>
                                                        </td>
                                                        <td class=" "><?php echo $offer['created_date'];?></td>
                                                        <td class=" ">
                                                            <div class="btn-group">
                                                                <a data-toggle="modal" data-target="#offering_details<?php echo $offer['offering_id'];?>" class="btn btn-sm btn-info" href=""><i class="fa fa-edit"></i> Edit</a>
                                                                <a data-toggle="modal" data-target="#delete_offering<?php echo $offer['offering_id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!--Update member offering-->
                                                    <div class="modal" id="offering_details<?php echo $offer['offering_id'];?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header no-padding">
                                                                    <div class="table-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                            <span class="white">&times;</span>
                                                                        </button>
                                                                        Update Offering
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="<?php echo site_url('Admin_cont/update_offering/'.$offer['offering_id']);?>">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <label>Member:</label>
                                                                                <select class="form-control" name="member" required>
                                                                                    <?php
                                                                                    foreach($members as $mem1){
                                                                                        ?>
                                                                                        <option value="<?php echo $mem1['id'];?>" <?php if($mem1['id']==$offer['member']) echo 'selected="selected"'?> ><?php echo $mem1['m_firstname'].' '.$mem1['m_lastname'];?></option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <label>Offering Category:</label>
                                                                                <select class="form-control" name="category" required>
                                                                                    <?php
                                                                                    foreach($category as $cat1){
                                                                                        ?>
                                                                                        <option value="<?php echo $cat1['category_id'];?>" <?php if($cat1['category_id']==$offer['category']) echo 'selected="selected"'?> ><?php echo $cat1['category_name'];?></option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <label>Amount:</label>
                                                                                <input value="<?php echo $offer['amount'];?>" class="form-control" name="amount" required/>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <label>Status:</label>
                                                                                <select class="form-control" name="status" required>
                                                                                    <?php
                                                                                    if($offer['p_status']=='Approved'){
                                                                                        ?>
                                                                                        <option value="Approved">Approved</option>
                                                                                        <option value="Pending">Pending</option>
                                                                                        <?php
                                                                                    }
                                                                                    elseif ($offer['p_status']=='Pending'){
                                                                                        ?>
                                                                                        <option value="Pending">Pending</option>
                                                                                        <option value="Approved">Approved</option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>

                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <label>Date:</label>
                                                                                <input value="<?php echo $offer['payment_date'];?>" class="form-control" readonly/>
                                                                            </div>
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <label>Description:</label>
                                                                                <textarea name="description" class="form-control" value="<?php echo $offer['description'];?>"><?php echo $offer['description'];?></textarea>
                                                                            </div>
                                                                        </div><br/>
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <button type="submit" name="updateoffering_btn" class="btn btn-success btn-sm"><i class="fa fa-trash"></i> Update Offering</button>
                                                                                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Delete offering-->
                                                    <div class="modal" id="delete_offering<?php echo $offer['offering_id'];?>">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" style="color: red; font-weight: bold;">Delete offering record <i class="fa fa-warning"></i></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="<?php echo site_url('Admin_cont/deleteoffering/'.$offer['offering_id']);?>">
                                                                        <div class="row">
                                                                            <h5>SURE TO DELETE OFFERING?</h5>
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <button type="submit" name="deleteoffering_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Now</button>
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
                                                <tfoot>
                                                <tr>

                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <hr />
                                <?php
                                if(isset($_POST['randomsearch_btn'])){

                                }
                                elseif (isset($_POST['daterange_btn'])){

                                }
                                else{
                                    ?>
                                    <div class="row" style="height: 50px;">
                                        <div class="col-md-4">
                                            <strong><h4 style="color: green; font-weight: bold;">APPROVED: <?php foreach($total_offering as $tot){}; echo number_format($tot['amount'],2);?></h4></strong>
                                        </div>
                                        <div class="col-md-4">
                                            <strong><h4 style="color: red; font-weight: bold;">PENDING: <?php foreach($total_pendingoffering as $tot){}; echo number_format($tot['amount'],2);?></h4></strong>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
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

