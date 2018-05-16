<?php
/**
 * @file docent_home.php
 * @author Brend Simons
 * 
 * Pagina die te zien is wanneer de gebruiker ingelogd is als docent.
 * 
 * @see Home
 */
?>
<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row intro">
        <div class="col-lg-12 col-md-12">
        <?php
            if($edition != null){
                echo nl2br($edition->homepagina);
            }else{
                echo "There's currently no edition going on!";
            }
            ?>
        </div>
    </div>
</div>
