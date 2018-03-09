<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav"><?php echo $titel ?></h3>
        </div>
    </div>
    <div class="row intro">
        <div class="col-lg-12 col-md-12">
            <?php
            
          
            
            $period = new DatePeriod (
                new DateTime($edition->startdate),
                new DateInterval('P1D'),
                new DateTime($edition->enddate)
                );
                
            foreach ($period as $key => $value) { 
                echo "<h2>" . $value->format('l\, d M Y') . "</h2>";
                
                //$value->format('Y-m-d')       
            }
            

            ?>
        </div>
    </div>
</div>