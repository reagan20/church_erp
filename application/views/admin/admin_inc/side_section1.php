<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <a href="<?php echo site_url('Admin_cont/index');?>" class="btn btn-success">
                <i class="ace-icon fa fa-home"></i>
            </a>

            <a href="<?php echo site_url('Admin_cont/personal_details');?>" class="btn btn-info">
                <i class="ace-icon fa fa-user"></i>
            </a>

            <a href="<?php echo site_url('Admin_cont/update_password');?>" class="btn btn-warning">
                <i class="ace-icon fa fa-key"></i>
            </a>

            <a href="<?php echo site_url('Admin_cont/setting');?>" class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
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
            <a href="<?php echo site_url('Admin_cont/index');?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i>
                <span class="menu-text"> Manage Users </span><b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/members');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Members Data
                    </a><b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?php echo site_url('Admin_cont/visitors');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Visitors Data
                    </a><b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Departments </span><b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/departments');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Departments
                    </a><b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?php echo site_url('Admin_cont/department_heads');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Department Heads
                    </a><b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Ministry </span><b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/ministries');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Ministries
                    </a><b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/ministry_heads');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Ministry Heads
                    </a><b class="arrow"></b>
                </li>
                <!--<li class="">
                    <a href="<?php //echo site_url('Admin_cont/ministry_members');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Ministry Members
                    </a><b class="arrow"></b>
                </li>-->
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i>
                <span class="menu-text"> Offerings/Tithes </span><b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/tithes_givings');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Tithes/Contributions
                    </a><b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?php echo site_url('Admin_cont/general_offering');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        General Offering
                    </a><b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i>
                <span class="menu-text"> Manage Accounts </span><b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/vote_heads');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Vote Heads
                    </a><b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/income');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Income
                    </a><b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('Admin_cont/expense');?>"><i class="menu-icon fa fa-caret-right"></i><i class="menu-icon fa fa-caret-right"></i>
                        Expense
                    </a><b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="<?php echo site_url('Admin_cont/events');?>">
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
            <a href="<?php echo site_url('Admin_cont/baptism');?>">
                <i class="menu-icon fa fa-flag-checkered"></i>
                <span class="menu-text">Manage Baptism</span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="<?php echo site_url('Admin_cont/sermons');?>">
                <i class="menu-icon fa fa-book"></i>
                <span class="menu-text"> Manage Sermons </span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="<?php echo site_url('Admin_cont/projects');?>">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Manage Projects </span>
            </a>
            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="<?php echo site_url('Admin_cont/setting');?>">
                <i class="menu-icon fa fa-cog"></i>
                <span class="menu-text"> System Configuration </span>
            </a>
            <b class="arrow"></b>
        </li>
        <!--<li class="">
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