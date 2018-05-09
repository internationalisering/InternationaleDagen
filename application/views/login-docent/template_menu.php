<?php
/**
 * @file login-docent/template_menu.php
 * @author Brend Simons
 * 
 * Menu voor de docent.
 * 
 * @see Logout
 * @see Home
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
      <li class="nav-item	">
        <a class="nav-link" href="<?= site_url() ?>/home">Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url() ?>/planning">Planning</a>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right nav-custom-left">
        <li><a href="<?= site_url(); ?>/logout">Logout</a></li>
    </ul>
    <!-- /.navbar-top-links -->
</nav>