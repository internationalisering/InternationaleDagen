<?php
/**
 * @file beheerder_gebruiker_verwijder.php
 * @author Brend Simons
 * 
 * Pagina die te zien is wanneer de beheerder een gebruiker wil verwijderen.
 * 
 * @see Gebruiker
 */
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Delete User</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <p>Are you sure that you want to delete <b><?php echo $user->voornaam . " " . $user->achternaam; ?></b>?</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="POST">
                <div class="btn-group">
                    <button type="submit" class="btn btn-danger" name="submit" value="submit">Delete</button>
                </div>
                <div class="btn-group">
                    <a href="<?= site_url(); ?>/gebruiker" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>