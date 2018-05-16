<?php
/**
 * @file login-beheerder/template_menu.php
 * @author Brend Simons
 * 
 * Menu voor de beheerder.
 * 
 * @see Logout
 * @see Gebruiker
 * @see Email
 * @see Home
 * @see Wensen
 * @see Planning
 * @see Zoeken
 */
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= site_url(); ?>/home">International Days</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?= site_url(); ?>/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?= site_url(); ?>/home"><i class="fa fa-tachometer fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/gebruiker"><i class="fas fa-users"></i> Manage Users</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/email"><i class="fas fa-at"></i> Manage Emails</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/home/homepagina_lijst"><i class="fas fa-align-justify"></i> View Editions</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/wensen/beheer"><i class="fas fa-star"></i> Manage Wishes</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/planning/edit"><i class="fas fa-calendar-alt"></i> Manage Planning</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/zoeken"><i class="fas fa-search"></i> Search</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/tables"><i class="fas fa-database"></i> Manage  Tables</a>
                </li>
                <li>
                    <a href="<?= site_url(); ?>/certificates"><i class="fas fa-certificate"></i> Certificates</a>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>