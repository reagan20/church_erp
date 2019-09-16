<div class="main-content">
    <?php
    foreach($church as $ch){
        $logo=$ch['logo'];
        $name=$ch['church_name'];
        $phone=$ch['phone'];
        $email=$ch['email'];
        $motto=$ch['motto'];
        $church_id=$ch['church_id'];
        $expiry=$ch['expiry'];
    }
    ?>
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
                        Dashboard
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            overview &amp; stats
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="space-6"></div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <a href="<?php echo site_url('Admin_cont/members');?>">
                            <div class="well well-sm">
                                <div class="left">
                                    <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Users" src="<?php echo base_url();?>assets/Users.png" />
                                </div>
                                <div class="infobox-data">
                                    <h4 class="blue bolder"><?php echo $member_counts;?></h4>
                                    <h4>CHURCH MEMBERS</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <a href="<?php echo site_url('Admin_cont/departments');?>">
                            <div class="well well-sm">
                                <div class="left">
                                    <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Alexa's Avatar" src="<?php echo base_url();?>assets/dep.png" />
                                </div>
                                <div class="infobox-data">
                                    <h4 class="blue bolder"><?php echo $department_counts;?></h4>
                                    <h4>CHURCH DEPARTMENTS</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <a href="<?php echo site_url('Admin_cont/ministries');?>">
                            <div class="well well-sm">
                                <div class="left">
                                    <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Alexa's Avatar" src="<?php echo base_url();?>assets/dep.png" />
                                </div>
                                <div class="infobox-data">
                                    <h4 class="blue bolder"><?php echo $ministry_counts;?></h4>
                                    <h4>CHURCH MINISTRIES</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <a href="<?php echo site_url('Admin_cont/projects');?>">
                            <div class="well well-sm">
                                <div class="left">
                                    <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Alexa's Avatar" src="<?php echo base_url();?>assets/mini.jpg" />
                                </div>
                                <div class="infobox-data">
                                    <h4 class="blue bolder"><?php echo $project_counts;?></h4>
                                    <h4>CHURCH PROJECTS</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="vspace-12-sm"></div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12"><!--height="150px"-->
                        <div class="text-center">
                            <img  style="width: 200px; height: 200px;" class="thumbnail inline no-margin-bottom" alt="Church Logo" src="<?php echo base_url();?>assets/uploads/<?php echo $logo;?>" />
                            <br />
                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                <div class="inline position-relative">
                                    <a class="user-title-label" href="#">
                                        <i class="ace-icon fa fa-circle light-green"></i>&nbsp;
                                        <span class="white">
                                            <a data-toggle="modal" data-target="#logo<?php echo $church_id;?>" class="btn btn-xs btn-danger">SET CHURCH LOGO</a>
                                            <?php// echo $mem['m_firstname'].' '.$mem['m_lastname'];?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-6"></div><div class="space-6"></div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <p>
                        <h3>CHURCH NAME: <?php echo $name;?></h3>
                        <h4>PHONE NUMBER: <?php echo $phone;?></h4>
                        <h4>EMAIL ADDRESS: <?php echo $email;?></h4>
                        <h5>CHURCH MOTTO: <?php echo $motto;?></h5>
                        </p>
                        <div class="modal" id="logo<?php echo $church_id;?>">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Church Logo</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" enctype="multipart/form-data" action="<?php echo site_url('Admin_cont/upload_indexlogo/'.$this->session->userdata['id']);?>">
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12">
                                                    <label>Upload Logo:</label>
                                                    <input type="file" class="form-control" name="logo" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="modal-footer">
                                                        <div class="col-md-12 col-xs-12">
                                                            <button type="submit" name="church_logo" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Upload</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              <div class="hr hr32 hr-dotted"></div>

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

