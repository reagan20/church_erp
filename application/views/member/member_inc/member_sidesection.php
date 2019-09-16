
<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <a href="<?php echo site_url('Member_cont/index');?>" class="btn btn-success">
                <i class="ace-icon fa fa-home"></i>
            </a>
            <a href="<?php echo site_url('Member_cont/personal_profile');?>" class="btn btn-info">
                <i class="ace-icon fa fa-user"></i>
            </a>
            <a href="<?php echo site_url('Member_cont/update_password');?>" class="btn btn-warning">
                <i class="ace-icon fa fa-key"></i>
            </a>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="active">
            <a href="<?php echo site_url('Member_cont/index');?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="<?php echo site_url('Member_cont/offerings');?>">
                <i class="menu-icon fa fa-flag-o"></i>
                <span class="menu-text">
                    Givings/Offerings
                </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="<?php echo site_url('Member_cont/events');?>">
                <i class="menu-icon fa fa-calendar"></i>
                <span class="menu-text">
                    Calendar of Events
                    <span class="badge badge-transparent tooltip-error" title="2 Important Events">
                        <i class="ace-icon fa fa-info-circle green bigger-130"></i>
                    </span>
                </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="<?php echo site_url('Member_cont/sermons');?>">
                <i class="menu-icon fa fa-book"></i>
                <span class="menu-text">Sermons Manager</span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="<?php echo site_url('Member_cont/projects');?>">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">Projects  Manager</span>
            </a>
            <b class="arrow"></b>
        </li>
       <!-- <li class="">
            <a href="<?php //echo site_url('Admin_cont/chart');?>">
                <i class="menu-icon fa fa-cog"></i>
                <span class="menu-text"> Chart </span>
            </a>
            <b class="arrow"></b>
        </li>-->
        <li class="">
            <a href="<?php echo site_url('System/logout');?>"><i class="menu-icon fa fa-sign-out danger"></i>
                <span class="menu-text"> Logout </span>
            </a>
            <b class="arrow"></b>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
           data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>