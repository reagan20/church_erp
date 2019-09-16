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
                    <a href="<?php echo site_url('Super_controller/church_accounts');?>">
                        <div class="well well-sm">
                            <div class="left">
                                <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Users" src="<?php echo base_url();?>assets/Users.png" />
                            </div>
                            <div class="infobox-data">
                                <h4 class="blue bolder"><?php echo $church;?></h4>
                                <h4>TOTAL ACCOUNTS</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="">
                        <div class="well well-sm">
                            <div class="left">
                                <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Alexa's Avatar" src="<?php echo base_url();?>assets/dep.png" />
                            </div>
                            <div class="infobox-data">
                                <h4 class="blue bolder"><?php echo $members;?></h4>
                                <h4>CHURCH USERS</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="<?php echo site_url('Super_controller/church_accounts');?>">
                        <div class="well well-sm">
                            <div class="left">
                                <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Alexa's Avatar" src="<?php echo base_url();?>assets/dep.png" />
                            </div>
                            <div class="infobox-data">
                                <h4 class="blue bolder"><?php echo $active;?></h4>
                                <h4>ACTIVE ACCOUNTS</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="<?php echo site_url('Super_controller/church_accounts');?>">
                        <div class="well well-sm">
                            <div class="left">
                                <img class="rounded-circle" style="height: 45px; width: 50px;" alt="Alexa's Avatar" src="<?php echo base_url();?>assets/mini.jpg" />
                            </div>
                            <div class="infobox-data">
                                <h4 class="blue bolder"><?php echo $inactive;?></h4>
                                <h4>INACTIVE ACCOUNTS</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="vspace-12-sm"></div>
            </div>
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-cogs"></i> SYSTEM MODULES</div>
                        <div class="panel-body">
                            <p>
                                The modules includes:<br/>
                            <ol>
                                <li>Supper administrator module.</li>
                                <li>Church administrator module(pastor).</li>
                                <li>Church members module.</li>
                            </ol>
                            </p>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-warning"></i> TERMS & CONDITIONS</div>
                        <div class="panel-body">

                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    function getTime(){
                        $s=strtotime(date('10:29:46'));
                        $e=strtotime(date('11:46:45'));
                        $d=$e-$s;
                        //echo $d;
                        if($d>=60){//&& $d<3600
                            return round($d/60);
                        }
                        /*elseif ($d>=3600 && $d<86400){
                            return round($d/3600, 2);
                        }*/
                    }
                    $hr=round(getTime()/60);//gives hour
                    $result=round(getTime());

                    $min= fmod($result,60);
                    //echo $hr.' '.$min.' '.'mins';

                    ?>
                </div>
            </div>
            <div class="hr hr32 hr-dotted"></div>

        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

