<script>
$(document).ready(function()
{
	µ.planning_edit.initialize();
});
</script> 

<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Planning</h1>
			
			<select name='date'>
				<?php 
				$datumsBereik = new DatePeriod (
					new DateTime($editie->startdatum),
					new DateInterval('P1D'),
					new DateTime($editie->einddatum)
				);
						
				foreach ($datumsBereik as $datumKey => $datum)
				{ 
					echo "<option value='{$datum->format('Y-m-d')}'>".$datum->format('d M Y')      ; 
				}
				?>
			</select>
			<br/>
			<br/>
		


	        <div class="row">
	            <div class="col-md-12">

	            	<div class='planning-edit-row-parent' data-row-id="0">
		            	<div class='planning-edit-info'>
							<input type='text' class='planning-edit-time'>:<input type='text' class='planning-edit-time'>
		            	</div>
 
						<div  class="planning-edit-sortable planning-edit-sortable-row ">
							<div class='planning-edit-child' data-title='Robotics and me[test]' data-session-id='1'></div>
							<div class='planning-edit-child' data-title='Item 1' ></div>
						</div>
					</div>
					<!--
	            	<div class='row-parent' data-row-id="0">
		            	<div class='info'>
							<input type='text' class='time'>:<input type='text' class='time'>
		            	</div>
 
						<div  class="sortable sortable-row ">
							<div class='child' data-title='Item 1' data-session-id='1'></div>
							<div class='child' data-title='Item 1' ></div>
						</div>
					</div>-->


					<!-- Row 2 -->
					<div class='planning-edit-row-parent' data-row-id="1">
						<div class='planning-edit-info'>
							<input type='text' class='planning-edit-time'>:<input type='text' class='planning-edit-time'>
		            	</div>

						<div  class="planning-edit-sortable planning-edit-sortable-row ">
						  <div class='planning-edit-child' data-title='Item 3'>Item 3</div>
						  <div class='planning-edit-child' data-title='Item 4'>Item 4</div>
						  <div class='planning-edit-child' data-title='Item 5'>Item 5</div>
						</div>
					</div>

					            
	
					<div class='planning-edit-row-buttons planning-edit-sortable-row planning-edit-sortable' >
						<div class="planning-edit-new-child planning-edit-button">Add</div>

						<div class='planning-edit-remove-child planning-edit-button'>Remove</div>
					</div>
				</div>

	        </div>
        </div>
    </div>
</div>

