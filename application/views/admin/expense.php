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
                    Church Expense
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Church Expense
                            </h4>
                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button data-toggle="modal" data-target="#add_department" class="btn btn-sm btn-primary">
                                        <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                        Record Expense
                                    </button>
                                    <div id="add_department" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <div class="table-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            <span class="white">&times;</span>
                                                        </button>
                                                        Record Expense
                                                    </div>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('Admin_cont/add_expense');?>">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <label>Vote Head:</label> <span class="required">*</span>
                                                                    <select class="form-control" name="expense_head" required>
                                                                        <option value="">~~Select Vote Head~~</option>
                                                                        <?php
                                                                        foreach($expense_head as $head){
                                                                            ?>
                                                                            <option value="<?php echo $head['vote_head_id'];?>"><?php echo $head['vote_head_name'];?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <label>Income:</label> <span class="required">*</span>
                                                                    <input name="expense_amount" class="form-control" placeholder="Enter Amount" required>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <label>Date:</label> <span class="required">*</span>
                                                                    <input value="<?php echo date('Y-m-d');?>" name="date" type="date" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-12 col-xs-12">
                                                                    <label>Description</label>
                                                                    <textarea placeholder="Write comment ..." class="form-control" name="description"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <button type="submit" name="expense_btn" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Save</button>
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
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">S/N </th>
                                            <th class="column-title">Vote Head </th>
                                            <th class="column-title">Amount </th>
                                            <th class="column-title">Description </th>
                                            <th class="column-title">Recorded Date </th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $count=1;
                                        foreach($expense as $i){
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $count;?>.</td>
                                                <td class=" "><?php echo $i['vote_head_name'];?></td>
                                                <td class=" "><?php echo number_format($i['amount'],2);?></td>
                                                <td class=" "><?php echo $i['description'];?></td>
                                                <td class=" "><?php echo $i['date'];?></td>
                                                <td class=" ">
                                                    <div class="btn-group">
                                                        <a data-toggle="modal" data-target="#edit_expense<?php echo $i['expense_id'];?>" class="btn btn-sm btn-info" href=""><i class="fa fa-edit"></i> Edit</a>
                                                        <a data-toggle="modal" data-target="#delete_expense<?php echo $i['expense_id'];?>" class="btn btn-sm btn-danger" href=""><i class="fa fa-edit"></i> Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!--Update income head modal-->
                                            <div class="modal" id="edit_expense<?php echo $i['expense_id'];?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Expense</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo site_url('Admin_cont/update_expense/'.$i['expense_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Vote Head:</label>
                                                                            <select class="form-control" name="expense_head" required>
                                                                                <option value="">~~Select Vote Head~~</option>
                                                                                <?php
                                                                                foreach($expense_head as $head){
                                                                                    ?>
                                                                                    <option value="<?php echo $head['vote_head_id'];?>" <?php if($i['expense_head']==$head['vote_head_id']) echo 'selected="selected"' ?>><?php echo $head['vote_head_name'];?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Expense Amount:</label>
                                                                            <input value="<?php echo $i['amount'];?>" name="expense_amount" class="form-control" placeholder="Enter Amount" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Date:</label>
                                                                            <input value="<?php echo $i['date'];?>" name="date" type="date" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Description:</label>
                                                                            <input value="<?php echo $i['description'];?>" name="comment" type="text" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="modal-footer">
                                                                            <div class="col-md-12 col-xs-12">
                                                                                <button type="submit" name="updateexpense_btn" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Update Expense</button>
                                                                                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Delete modal-->
                                            <div class="modal" id="delete_expense<?php echo $i['expense_id'];?>">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Deleting <i class="fa fa-warning"></i></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>SURE TO DELETE?</h5>
                                                            <form method="post" action="<?php echo site_url('Admin_cont/deleteexpense/'.$i['expense_id']);?>">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12">
                                                                        <button type="submit" name="deleteexpense_btn" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete Expense</button>
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
                                <h5 style="color: red; font-weight: bold;" class="">TOTAL EXPENSES: <?php foreach($totalExpense as $total){}; echo number_format($total['amount'],2);?></h5>
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div></div><!-- /.main-content -->

