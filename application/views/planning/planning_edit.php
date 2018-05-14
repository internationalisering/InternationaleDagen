<script>
$(document).ready(function()
{
	µ.planning_edit.initialize();
});
</script> 

<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Planning&nbsp;<button class='btn btn-success' onclick='µ.planning_edit.trySave();'>Save</button></h1>
			
			<select name='date'>
				<?php 
				$datumsBereik = new DatePeriod (
					new DateTime($editie->startdatum),
					new DateInterval('P1D'),
					new DateTime($editie->einddatum)
				);
						
				foreach ($datumsBereik as $datumKey => $datum)
				{ 
					echo "<option value='{$datum->format('Y-m-d')}'>".$datum->format('d M Y'); 
				}
				?>
			</select>
			<br/>
			<br/>
		


	        <div class="row">
	            <div class="col-md-12">
    				
	            	<div class='planning-edit-row-parent' data-row-id="0">
		            	<div class='planning-edit-info'>
							<input type='text' name='from' class='planning-edit-time'> - <input type='text' name='til' class='planning-edit-time'>
		            	</div>
 
						<div  class="planning-edit-sortable planning-edit-sortable-row ">
						
						</div>
					</div>



				
					            
	
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

