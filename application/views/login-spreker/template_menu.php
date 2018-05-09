<?php
/**
 * @file spreker_template_menu.php
 * @author Brend Simons
 * 
 * Menu voor de spreker.
 * 
 * @see Logout
 * @see Wensen
 * @see Lectures
 * @see Planning
 */
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?= site_url(); ?>/">International Days</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-nav  nav-custom-left">
        <li><a href="<?= site_url(); ?>/planning/">Planning</a></li>
        <li><a href="<?= site_url(); ?>/wensen/invullen">Wishes</a></li>
        <li><a href="<?= site_url(); ?>/lectures">My Lectures</a></li>
    </ul>
	<ul class="nav navbar-nav  nav-custom-left">
        <li><a href="<?= site_url(); ?>/logout">Logout</a></li>
	</ul>
    <!-- /.navbar-top-links -->
</nav>