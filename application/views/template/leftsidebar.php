<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url('adminlte/dist/img') . '/' . $sess['pic'] ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $sess['username'] ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!--
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="header">PRIMARY NAVIGATION</li> 
            <li class="active treeview">
                <?php
                //echo $sess['grade_id']; die();
                if ($sess['grade_id'] == 8) {//admin or 
                    ?>   
                    <a href="<?= base_url('distributor/homeReport') ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="<?= base_url('welcome/homeReport') ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <?php
                }
                ?>
                <!--
                <ul class="treeview-menu">
                    <li class="active"><a href="<?= base_url('index.php/welcome/index') ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>

                </ul>-->
            </li>

            <?php
            $DashboardMenuLinks = '';
            $UserModelMenuLinks = '';
            $LocationModelMenuLinks = '';
            $LoanModelMenuLinks = '';
            $ClientModelMenuLinks = '';
            if (!empty($modules) && isset($modules) && !empty($menu) && isset($menu)) {
                foreach ($modules as $module) {
                    if ($module['ModuleType'] == 1) {
                        $DashboardMenuLinks = '';
                        foreach ($menu as $menuItem) {
                            //echo $menuItem['class'];
                            if ($module['id'] == $menuItem['module_id']) {
                                $DashboardMenuLinks .= '<li><a href="' . base_url($menuItem['url']) . '"><i class="' . $menuItem['class'] . '"></i> ' . $menuItem['display_name'] . '</a></li>';
                            }
                        }

                        if ($DashboardMenuLinks !== '' && $module['name'] != 'Job Module') {
                            ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="<?= $module['fa_icon'] ?>"></i>
                                    <span><?= $module['name'] ?></span><i class="fa fa-angle-left pull-right"></i>                                
                                </a>
                                <ul class="treeview-menu">
                                    <?= $DashboardMenuLinks ?>
                                </ul>
                            </li>
                            <?php
                        }
                    }
                }
            }
            ?>            

            <!--            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users Module</span><i class="fa fa-angle-left pull-right"></i>
                    
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-gears"></i> Create/Modify User Type</a></li>  
                    <li><a href="#"><i class="fa fa-user"></i> Add/Modify User</a></li>
                    <li><a href="#"><i class="fa fa-users"></i> User Access Groups</a></li>
                    <li><a href="#"><i class="fa fa-key"></i> User Authenticate</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Inventory Control </span><i class="fa fa-angle-left pull-right"></i>
                    
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-gears"></i> Locations</a></li>  
                    <li><a href="#"><i class="fa fa-gears"></i> Categories</a></li>  
                    <li><a href="#"><i class="fa fa-wrench"></i> Items</a></li>
                    <li><a href="#"><i class="fa fa-money"></i> Item Price</a></li>
                    <li><a href="#"><i class="fa fa-industry"></i> Made</a></li>
                    <li><a href="#"><i class="fa fa-android"></i> Model</a></li>
                    <li><a href="#"><i class="fa fa-sign-in"></i> GRN</a></li>
                    <li><a href="#"><i class="fa fa-sign-in"></i> I/C Stock Reports</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Order Entry Module </span><i class="fa fa-angle-left pull-right"></i>
                    
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-file"></i> Create Jobs</a></li>  
                    <li><a href="#"><i class="fa fa-pencil-square"></i> Estimate Jobs</a></li>
                    <li><a href="#"><i class="fa fa-users"></i> Repair Jobs</a></li>

                </ul>
            </li>
            -->
            <li class="header">SECONDARY SALES NAVIGATION</li> 
            <?php
            $DashboardMenuLinksSECONDARY = '';
            $UserModelMenuLinks = '';
            $LocationModelMenuLinks = '';
            $LoanModelMenuLinks = '';
            $ClientModelMenuLinks = '';
            if (!empty($modules) && isset($modules) && !empty($menu) && isset($menu)) {

                foreach ($modules as $module) {
                    if ($module['ModuleType'] == 2) {
                        $DashboardMenuLinksSECONDARY = '';
                        foreach ($menu as $menuItem) {
                            //echo $menuItem['class'];
                            if ($module['id'] == $menuItem['module_id']) {
                                $DashboardMenuLinksSECONDARY .= '<li><a href="' . base_url($menuItem['url']) . '"><i class="' . $menuItem['class'] . '"></i> ' . $menuItem['display_name'] . '</a></li>';
                            }
                        }

                        if ($DashboardMenuLinksSECONDARY !== '' && $module['name'] != 'Job Module' && $module['ModuleType'] == 2) {
                            ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="<?= $module['fa_icon'] ?>"></i>
                                    <span><?= $module['name'] ?></span><i class="fa fa-angle-left pull-right"></i>                                
                                </a>
                                <ul class="treeview-menu">
                <?= $DashboardMenuLinksSECONDARY ?>
                                </ul>
                            </li>
                <?php
            }
        }
    }
}
?>  
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
