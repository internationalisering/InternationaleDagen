<?php
/**
 * @file reset_menu.php
 * @author Quinten van Casteren
 * 
 * Menu waarmee men terug kan gaan naar de loginpagina.
 * 
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
        <li><a href="<?=site_url() ?>/login">Back to login</a></li>
    </ul>
    <!-- /.navbar-top-links -->
</nav>