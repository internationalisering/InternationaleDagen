<!-- TIJDELIJKE STYLE! Moet naar style.css... -->
<style>
    .activity-column 
    {
        background-color: blue;
        color:white;
        
    }
    
    
</style>


<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav"><?php echo $titel ?></h3>
        </div>
    </div>
    <div class="row intro">
        <div class="col-lg-12 col-md-12">
            <?php
            
          
            
            $datumsBereik = new DatePeriod (
                new DateTime($edition->startdatum),
                new DateInterval('P1D'),
                new DateTime($edition->einddatum)
                );
                
            foreach ($datumsBereik as $datumKey => $datum) {  // Voor elke datum 
                echo "<h2>" . $datum->format('l\, d M Y') . "</h2>"; // Titel met datum
                
                
                // Voor elke rij...
                foreach($rows as $row)
                {
                    // Voor elke dag gaan we kijken welke rijen op deze dag vallen.
                    if($datum->format("Y-m-d") == date("Y-m-d", strtotime($row->starttijd)))
                    {
                        // Algemene informatie per rij (starttijd, eindtijd, welke editie etc...)
                        ?>
                           <div class='row'>
                            
                                <div class="col-lg-3 col-md-3">
                                    <p><?= date("H:i", strtotime($row->starttijd)) . "u - " . date("H:i", strtotime($row->eindtijd))  ?>u</p>
                                </div>
                         
                        <?php   
                            // Dan tonen we elke kolom geassocieerd met deze rij
                            
                            foreach($row->columns as $column)
                            {
                                if($row->id == $column->rijId) // Kolom rij id komt overeen met rij id?
                                {
                                    
                                    ?> 
                                    
                                    <div class="col-lg-9 col-md-9 activity-column">
                                        <p>Kolom: <?= $column->id; ?></p>
                                        <p>Max #: <?= $column->maxHoeveelheid; ?></p>
                                        
                                        
                                        <?php if( isset($column->session)){ // Is sessie ingevuld? ?>
                                            <p>Titel: <?= $column->session->titel ?></p>
                                        <?php } ?>
                                    </div>
                                    <p>&nbsp;</p>
                                    <?php 
                                }
                         
                            }
                            
                        ?> </div> <?php  // Sluiten van 'row'
                   }
                    
                }
                
                
                ?>
                <!--
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        Block 1
                    </div>
                </div>-->
                <?php 
            }
            

            ?>
            
            
        </div>
    </div>
</div>