<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Dashboard</h3>
        <ul class="nav side-menu">
            <li>
                <a href="<?php echo SITE_URL.'dashboard.php' ?>">
                    <i class="fa fa-home"></i>Home<span class="fa fa-chevron-down"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_URL.'datasuppression.php' ?>">
                    <i class="fa fa-clone"></i>Data Suppression<span class="fa fa-chevron-down"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_URL.'datatransfer.php' ?>">
                    <i class="fa fa-clone"></i>Data Transfer<span class="fa fa-chevron-down"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo SITE_URL.'assets.php' ?>">
                    <i class="fa fa-clone"></i>Assets<span class="fa fa-chevron-down"></span>
                </a>
            </li>
            <li>
                <a><i class="fa fa-clone"></i>Track ID<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo SITE_URL.'trackidgeneration.php' ?>">Create Track Ids</a></li>
                    <li><a href="<?php echo SITE_URL.'viewtrackids.php' ?>">View Track Ids</a></li>
                </ul>
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
                        <?= getUserdisplayname() ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?php echo SITE_URL.'logout.php'; ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
