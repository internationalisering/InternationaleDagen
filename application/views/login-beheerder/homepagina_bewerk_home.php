<div id="page-wrapper" class="page-wrapper-fullpage">


        
    


    <div class="bewerk">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav">Druk op de rode submitknop als je klaar bent met werken</h3>
            <a href="<?= site_url(); ?>/home/homepagina_update" class="btn btn-danger col-md-4">Submit</a>
        </div>
    </div>
    
    </div>
    <div class="row intro text" contenteditable="true">
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

<style>
.bewerk {
    padding: 3%;
    background-color: #f9f9f9;
}

a {
    padding: -3%;
    text-align: center;
}

.text {
    margin-top: 10px;
}


</style>