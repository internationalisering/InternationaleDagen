<script>
$(document).ready(function()
{
	µ.planning_view.initialize();
});
</script> 


<div id="page-wrapper" class="page-wrapper-fullpage">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="welcomenav"><?= $titel ?>  <button class="btn btn-primary" onclick="µ.planning_view.showHelp();"><i class="fas fa-question-circle"></i></button></h3>
        </div>
    </div>
    <div class="row intro">
        <div class="col-lg-12 col-md-12">
            <div class="planning-flexbox">
               <?php 
                $datumsBereik = new DatePeriod (
                    new DateTime($edition->startdatum),
                    new DateInterval('P1D'),
                    new DateTime($edition->einddatum)
                    );
                    
                foreach ($datumsBereik as $datumKey => $datum) 
                {  // Voor elke datum 
                    ?> 
                    <div class='planning-date'>
                        <h2><?= $datum->format('l\, d M Y') ?></h2>
                    </div>



                    <?php 

                    // Voor elke rij...
                    foreach($rows as $row)
                    {
                        // Voor elke dag gaan we kijken welke rijen op deze dag vallen.
                        if($datum->format("Y-m-d") == date("Y-m-d", strtotime($row->starttijd)))
                        {

                           
                            ?>
                            <div class='planning-line-break'></div> <!-- Zorgt voor expliciete break tussen flexboxes-->
                            <div class='planning-time'>
                                 <p> 
                                    <?= date("H\ui", strtotime($row->starttijd)); ?>
                                    -
                                    <?= date("H\ui", strtotime($row->eindtijd)); ?> 
                                </p>
                                <hr>
                            </div>
                            <?php 



                            foreach($row->columns as $column)
                            {
                                if($row->id == $column->planningRijId) // Kolom rij id komt overeen met rij id?
                                {

                                    if(isset($column->pauze)) // Is het een pauze? 
                                    {
                                        ?> 
                                            <div class='planning-child planning-child-break'>
                                                <p class='planning-session-title'>
                                                    <?= $column->pauze ?>
                                                </p>

                                            </div>
                                        <?php 
                                    } else {
                                        ?> 
                                            <?php 

                                            if(isset($column->session))
                                            {
                                            ?>
                                            <div class='planning-child planning-child-activity planning-child-activity-<?= ($column->ingeschreven || $column->verplicht ?'':'not-')?>enrolled' data-column-id=<?= $column->id ?>>
                                                <div class='planning-session'>
                                                    <p class='planning-session-title'><?= $column->session->titel ?></p>
                                                    <p class='planning-session-author'>
                                                        <?= $column->session->gebruiker->voornaam ?>
                                                        <?= $column->session->gebruiker->achternaam ?>

                                                    </p> 
                                                    <p class='planning-session-author'><?= ($column->verplicht ? 'Verplicht voor uw klas!':'' ) ?>  
                                                    	<span class='planning-child-tick' data-column-id=<?= $column->id ?>>
                                                        	<img class='img-16' src='<?= base_url() ?>/resources/images/tick.png'/>
                                                    	</span>
                                                    </p> 


                                                 
                                                </div>
                                            </div>
                                            <?php 
                                            }
                                            else 
                                            {	
                                            	?>
                                           		<div class='planning-child planning-child-activity planning-child-activity-not-enrolled' data-column-id='0'>
                                                	<div class='planning-session'>
	                                                    <p class='planning-session-title'>Nog geen sessie ingesteld</p>
	                                                    <p class='planning-session-author'>
	                                                        &nbsp;
	                                                    </p>  
                                                	</div>
                                           		</div>
                                            	<?php 
                                            }
                                        
                                    }
                                }
                            }  
                        }
                    }
                }
                ?>       
            </div>
        </div>
    </div>
</div>