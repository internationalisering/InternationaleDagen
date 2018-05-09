<div id="page-wrapper" class="page-wrapper-fullpage">
    
    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav">International Days</h3>
        </div>
    </div>
    
    <a href="/edit"><button type="button" class="btn btn-danger" style="color: white;">Change homepages</button></a>
    
    
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