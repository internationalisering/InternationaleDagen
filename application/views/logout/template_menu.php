<?php
/**
 * @file template_menu.php
 * @author Brend Simons
 * 
 * Menu dat gebruikt word wanneer de gebruiker niet ingelogd is.
 * 
 * @see Home
 * @see Login
 */
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?=site_url() ?>/">International Days</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?= site_url(); ?>/login">Login</a></li>
    </ul>
    <!-- /.navbar-top-links -->
</nav>