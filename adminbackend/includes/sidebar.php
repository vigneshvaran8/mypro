<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Dashboard</h3>
        <ul class="nav side-menu">
            <li>
                <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
            </li>
            <li>
                <a><i class="fa fa-clone"></i>Network<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo ADMIN_URL.'network.php' ?>">All Network</a></li>
                    <li><a href="<?php echo ADMIN_URL.'addeditnetwork.php' ?>">Add Network</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-clone"></i>Campaign<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo ADMIN_URL.'campaign.php' ?>">All Campaign</a></li>
                    <li><a href="<?php echo ADMIN_URL.'addeditcampaign.php' ?>">Add Campaign</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-clone"></i>Server<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo ADMIN_URL.'server.php' ?>">All Server</a></li>
                    <li><a href="<?php echo ADMIN_URL.'addeditserver.php' ?>">Add Server</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-clone"></i>ISP<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="chartjs.html">All ISP</a></li>
                    <li><a href="chartjs2.html">Add ISP</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-clone"></i>Data Files<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="fixed_sidebar.html">All Data Files</a></li>
                    <li><a href="fixed_footer.html">Add Data Files</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-clone"></i>Users<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="fixed_sidebar.html">All Users</a></li>
                    <li><a href="fixed_footer.html">Add Users</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo ADMIN_URL.'configuration.php' ?>"><i class="fa fa-clone"></i>Configuration<span class="fa fa-chevron-down"></span></a>
            </li>
        </ul>
    </div>


</div>
<!-- /sidebar menu -->
</div>
</div>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="images/img.jpg" alt="">
                        <?= getUserdisplayname() ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li><a href="<?php echo ADMIN_URL.'logout.php'; ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
