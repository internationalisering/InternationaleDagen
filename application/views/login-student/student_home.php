<?php
/**
 * @file student_home.php
 * @author Brend Simons
 * 
 * Pagina die te zien is wanneer de gebruiker ingelogd is als student.
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

            <a href='<?= site_url(); ?>/planning'>Planning</a>
        </div>
    </div>
</div>