<?php
foreach($member as $mem){
    $fname=$mem['admin_fname'];
    $lname=$mem['admin_lname'];
    $role='Administrator';
}
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">Chart Platform</li>
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
                    Chart Platform
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-large">
                            <h4 class="widget-title">Start Chart
                            </h4>
                            <div class="widget-toolbar no-border">
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php
                                        if(isset($_SESSION['message'])){
                                            echo $_SESSION['message'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr>
                                                    <!--                                                    <th>S/N</th>-->
                                                    <th>Name</th>
                                                    <th>Comment</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="comment_data">
                                                <?php
                                                $count=1;
                                                if(!empty($chart)){
                                                foreach ($chart as $c){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $c['comment_name'];?></td>
                                                        <td><?php echo $c['comment_content'];?></td>
                                                        <td><img alt="Alexa's Avatar" src="<?php echo base_url();?>assets/images/avatars/avatar1.png" /></td>
                                                        <td>
                                                            <button class="btn btn-xs btn-success reply" type="button" id="<?php echo $c['id'];?>">Reply</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $count++;
                                                }}else{
                                                    ?>
                                                    <tr><td colspan="7">No message(s) found...</td></tr>
                                                <?php
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <div class="pagination-links">
                                                        <?php echo $this->pagination->create_links();?>
                                                        <?php //echo $stude;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                .pagination-links{
                                                    margin: 30px 0;
                                                }
                                                a.pagination-link{
                                                    padding: 8px 13px;
                                                    margin: 5px;
                                                    background: #F4F4F4;
                                                    border: 1px #ccc solid;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <form method="post" id="comment_form">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input class="form-control" name="comment_name" id="comment_name" placeholder="Enter Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Comment:</label>
                                                <textarea class="form-control" name="comment_content" id="comment_comment" placeholder="Type Comment..."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="comment_id" id="comment_id" value="0">
                                                <button type="submit" name="submit" id="submit" class="btn btn-sm btn-info">Post</button>
                                            </div>
                                        </form>
                                        <span id="comment_message"></span><br/>
                                        <div id="display_comment"></div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title lighter smaller">
                                <i class="ace-icon fa fa-comment blue"></i>
                                Conversation
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <div class="dialogs">
                                    <?php if(!empty($chart)){foreach ($chart as $ch){
                                        ?>
                                        <div class="itemdiv dialogdiv">
                                            <div class="user">
                                                <img alt="Alexa's Avatar" src="<?php echo base_url();?>assets/images/avatars/avatar1.png" />
                                            </div>
                                            <div class="body">
                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span class="green"><?php echo $ch['created'];?></span>
                                                </div>
                                                <div class="name">
                                                    <a href="#"><?php echo $fname.' '.$lname;?></a>
                                                </div>
                                                <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.</div>
                                                <a style="border-radius: 20px;" class="btn btn-xs btn-success">Reply <i class="icon-only ace-icon fa fa-reply"></i></a>
                                                <a style="border-radius: 20px;" class="btn btn-xs btn-info">Like <i class="icon-only ace-icon fa fa-hand-o-left"></i></a>
                                                <a style="border-radius: 20px;" class="btn btn-xs btn-danger">Unlike <i class="icon-only ace-icon fa fa-remove"></i></a>
                                                <a>
                                                    <div class="inline dropdown-hover">
                                                        <button style="border-radius: 20px;" class="btn btn-xs btn-primary">Share
                                                            <i class="ace-icon fa fa-share-square icon-on-right bigger-110"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                                            <li class="active">
                                                                <a href="" class="blue" data-action="share/whatsapp/share">
                                                                    <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                                                    Whatsapp
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="">
                                                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                                                    Facebook
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                                <!--<div class="tools">
                                                    <a href="" class="btn btn-minier btn-info">
                                                        <i class="icon-only ace-icon fa fa-share"></i>
                                                    </a>
                                                </div>-->
                                            </div>
                                        </div>
                                    <?php
                                    } }else{
                                        ?>
                                        <p>No message found...</p>
                                    <?php
                                    }

                                    ?>
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <div class="pagination-links">
                                                <?php echo $this->pagination->create_links();?>
                                                <?php //echo $stude;?>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        .pagination-links{
                                            margin: 30px 0;
                                        }
                                        a.pagination-link{
                                            padding: 8px 13px;
                                            margin: 5px;
                                            background: #F4F4F4;
                                            border: 1px #ccc solid;
                                        }
                                    </style>
                                </div>
                                <form method="post" id="chart_form">
                                    <div class="form-actions">
                                        <div class="input-group">
                                            <h5 style="font-weight: bold; color: blue;">Name: <?php echo $fname.' '.$lname;?></h5>
                                        </div>
                                        <div class="input-group">
                                            <input placeholder="Type your message here ..." type="text" class="form-control" name="message" />
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm btn-info no-radius" type="submit" name="submit" id="submit">
                                                    <i class="ace-icon fa fa-share"></i>Send
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div>
            </div><!-- /.page-content -->

        </div>
    </div></div><!-- /.main-content -->



