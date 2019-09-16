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
                                                    <form method="post" action="<?php echo site_url('Member_cont/add_offering');?>">
                                                        <div class="row">
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
                                                                    foreach($projects as $cat){
                                                                        ?>
                                                                        <option value="<?php echo $cat['project_id'];?>"><?php echo $cat['project_name'];?></option>
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
                                                                    <option value="MPESA">MPESA</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <label>Transaction Code:</label> <span class="required">*</span>
                                                                <input class="form-control" name="transaction_code" placeholder="Transaction Code">
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
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-striped table-hover table-bordered">
                                                <thead>
                                                <tr class="headings">
                                                    <th class="column-title">S/N </th>
                                                    <th class="column-title">Category </th>
                                                    <th class="column-title">Amount</th>
                                                    <th class="column-title">Pay Mode</th>
                                                    <th class="column-title">Code</th>
                                                    <th class="column-title">Description</th>
                                                    <th class="column-title">Date</th>
                                                    <th class="column-title">Status</th>
                                                    <th class="column-title">Recorded Date </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $count=1;
                                                foreach($offering as $offer){
                                                    ?>
                                                    <tr class="even pointer">
                                                        <td class=" "><?php echo $count;?>.</td>
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
                                                    </tr>
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
                                    <h5 style="color: green; font-weight: bold;" class="">TOTAL CONTRIBUTION: <?php foreach($total_offering as $offer){}; echo number_format($offer['amount'],2);?></h5>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div></div><!-- /.main-content -->
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

