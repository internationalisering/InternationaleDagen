<script>
$(document).ready(function()
{
	µ.planning_edit.initialize( <?= !$editie->gepland; ?> );

});
</script> 

<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Planning&nbsp;<button class='btn btn-success' onclick='µ.planning_edit.trySave();'>Save</button></h1>

			<div class="alert alert-warning" role="alert" id='editing-finished'>
			 	The planning has been finished. Editing is not possible at this time.
			</div>

			<ul class="nav nav-tabs">
			<?php 
				$datumsBereik = new DatePeriod (
						new DateTime($editie->startdatum),
						new DateInterval('P1D'),
						new DateTime($editie->einddatum)
					);

				foreach ($datumsBereik as $datumKey => $date)
				{ 
					$dateISO = $date->format('Y-m-d');
					$datePretty = $date->format('d M Y');
					?>
			  		<li class='<?= ($dateISO == $huidigeDatum ? 'active':'')?>''><a  onclick='µ.planning_edit.showDate("<?= $dateISO; ?>");'><?= $datePretty?></a></li>
			  		
			  	<?php 
				}
				?>
			</ul>

		
			<br/>
			<br/>
		
	        <div class="row">
	            <div class="col-md-12">
    				
	            	<div class='planning-edit-date' data-date='<?= $huidigeDatum ?>'>


	            		<?php 
	            		$rowCount = 0;
	            		foreach($rows as $row)
	            		{
							if(date('Y-m-d', strtotime($row->starttijd)) == $huidigeDatum)
							{
								$rowCount++;
			            		?>
								<div class="planning-edit-row-parent" data-row-id="<?= $rowCount ?>">
					            	<div class="planning-edit-info" style="">
										<input type="text" name="from" class="planning-edit-time"> - <input type="text" name="til" class="planning-edit-time hasTimepicker">
				            		</div>



				            		<?php foreach($row->columns as $column)
				            		{ 
				            			$mandatoryClassesText = "";
				            			$mandatoryClasses = "";

				            			if(isset($column->session->klasgroepen))
				            			{
			            					foreach($column->session->klasgroepen as $klasgroep)
										 	{	
										 		$mandatoryClassesText .= $klasgroep->klas->klasgroep . ", ";
										 		$mandatoryClasses     .= $klasgroep->klas->id . "|";

										 	}
									 	}
									 	$mandatoryClasses     = substr($mandatoryClasses, 0, -1);
										$mandatoryClassesText = substr($mandatoryClassesText, 0, -2);


										?>
										<div class="planning-edit-sortable planning-edit-sortable-row ui-sortable">
																			
											<div data-title="<?= isset($column->session)? $column->session->titel : 'Nog geen sessie ingesteld' ?>"
												 class="planning-edit-child ui-sortable-handle" 
												 title=""
												 data-test="<?= $column->planningRijId;?>" 
												 data-max-amount="<?= $column->maxHoeveelheid; ?>"
												 data-session-id="<?= $column->sessieId; ?>"
												 data-author="<?= (isset($column->session->gebruiker) ? $column->session->gebruiker->voornaam . ' ' . $column->session->gebruiker->achternaam  : 'nvt')?>" 
												 data-mandatory-classes="<?= $mandatoryClasses ?>" 
												 data-mandatory-classes-text="<?= $mandatoryClassesText ?>"
											>
												<p class="planning-edit-session-title"></p>
												<p class="planning-edit-session-author"></p>
												<span class="planning-edit-child-tick" data-column-id="3">
													<img class="img-16" src="http://localhost/InternationaleDagen//resources/images/tick.png">
												&nbsp;</span>  
											</div>
										</div>
									 <?php 
									} ?>
								</div>
								<?php 
							}
						}

						if($rowCount == 0)
	            		{
	            			?>
								<div class="planning-edit-row-parent" data-row-id="0">
					            	<div class="planning-edit-info" style="">
										<input type="text" name="from" class="planning-edit-time"> - <input type="text" name="til" class="planning-edit-time hasTimepicker">
				            		</div>
		            				<div class="planning-edit-sortable planning-edit-sortable-row ui-sortable">
		            				
				            	
				            		</div>
				            	</div>
	            			<?php 
	            		}

	            		?>


					
						            
		
						<div class='planning-edit-row-buttons planning-edit-sortable-row planning-edit-sortable' >
							<div class='planning-edit-new-child planning-edit-add planning-edit-button'>Add Activity</div>
							<div class='planning-edit-new-child planning-edit-break planning-edit-button'>Add Break</div>
							<div class='planning-edit-remove-child planning-edit-button'>Remove</div>
						</div>
					</div>
				</div>

	        </div>
        </div>
    </div>
</div>

