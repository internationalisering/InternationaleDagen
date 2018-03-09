<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav"><?php echo $titel ?></h3>
        </div>
    </div>
    <div class="row intro">
        <div class="col-lg-12 col-md-12">
            <?php
            if($edition != null){
                echo nl2br($edition->homepage);
            }else{
                echo "There's currently no edition going on!";
            }
            ?>
        </div>
    </div>
</div>