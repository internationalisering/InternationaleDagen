
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

	            	<div class='row-parent' data-row-id="0">
		            	<div class='info'>
							<input type='text' class='time'>:<input type='text' class='time'>
		            	</div>
 
						<div  class="sortable sortable-row ">
							<div class='child' data-title='Item 1' data-session-id='1'></div>
							<div class='child' data-title='Item 1' ></div>
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
					<div class='row-parent' data-row-id="1">
						<div class='info'>
							<input type='text' class='time'>:<input type='text' class='time'>
		            	</div>

						<div  class="sortable sortable-row ">
						  <div class='child' data-title='Item 3'>Item 3</div>
						  <div class='child' data-title='Item 4'>Item 4</div>
						  <div class='child' data-title='Item 5'>Item 5</div>
						</div>
					</div>

					            
	
					<div class='row-buttons sortable-row sortable' >
						<div class="new-child button">Add</div>

						<div class='remove-child button'>Remove</div>
					</div>
				</div>

	        </div>
        </div>
    </div>
</div>

 <script>
	$( document ).ready(function() {
		µ.planning_edit.initialize();
	} );


</script>

<style>
	.sortable-row 
	{
	    width: 90%;
	    min-height: 84px;
	    max-height: 84px;
	    height:84px;
	    margin: 0;
	   #padding: 5px 0 0 0;
	    margin-right: 10px;
	    display:inline-block;
	}

 
  	.child {
  		float:left;
		font-size: 20px;
		color: #FFF;
		text-align: center;
		vertical-align: middle;
		border-radius: 6px;
		#margin: 12px;
		margin-left:12px;
		font-family: "Open Sans", Arial;

  		background: #3794fe;
  		line-height: 60px;
  		height: 60px;
 	 }

  	.info {
	    display: inline-block;

		text-align: center;

		font-family: "Open Sans", Arial;

  		vertical-align: top;
  		padding-top:24px;
 	 }
 	

 	.time 
 	{
 		width:32px;
 	}

 	.row-buttons 
 	{
 		margin-top: 15px;
 	}

 	.button
 	{
 		width: 150px;
 		padding: 15px;
 		height:60px;
 		border: 1px solid black;
 		background-color: grey;
 		float:left;
 		margin-right:15px;
 	}

 	.child-tick 
 	{
 		float: left;
 		left: 50px;
 	}

</style>