
<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Planning</h1>

	  

	        <div class="row">
	            <div class="col-md-6">
					<div class="grid-sidebar" id="hold-node-div">
						
					</div>
	            </div>
	            <div class="col-md-6">
	                <div class="grid-trash" id="delete-node-div">
	                </div>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-md-12">


	            	<div class='test'>
		            	<div class='info'>
							<div class='info'>
								<input type='text' class='time'>:<input type='text' class='time'>
							</div>
		            	</div>
 
						<div data-row-id="0" class="sortable sortable-row ">
							<div class='child' data-session-id='1'>Item 1</div>
							<div class='child'>Item 2</div>

						</div>
					</div>


					<!-- Row 2 -->
					<div class='test'>
						<div class='info'>
							<div class='info'>
								<input type='text' class='time'>:<input type='text' class='time'>
							</div>
		            	</div>

						<div data-row-id="1" class="sortable sortable-row ">
						  <div class='child'>Item 3</div>
						  <div class='child'>Item 4</div>
						  <div class='child'>Item 5</div>
						</div>

						<!-- Add/Delete button -->
						<div data-type='new-child' class='sortable'>
						  <div class='new-child'>add</div>
						</div>
					</div>
	            </div>
					
	        </div>
        </div>
    </div>
</div>

 <script>
 $( function() {
    $( ".sortable" ).sortable({
      connectWith: ".sortable",
      stop: resizeItems,
    }).disableSelection();
    resizeItems();
  } );


 


 	function addItem(rowId)
 	{
 		$('div[data-row-id='+rowId+']').append('<div class="child">test</div>');
 	}

 	function addAddButton()
 	{
 		$('div[data-type=new-child]').append('<div class="new-child">add</div>');
 	}

 	function getRowCount(row) // Geeft count van alle children, zonder de 'info' child bij
 	{
 		var count = 0;
 		row.children().each(function(index, object)
 		{
 			object = $(object);
 			if(object.hasClass('child'))
 				count++;
 		});

 		return count;
 	}

 	function resizeItems()
 	{
 		// Kijken of er nieuw item toegevoegd is
 		$('.sortable-row div').each(function(index, child)
 		{
 			if($(child).hasClass('new-child'))
 			{
 				console.log("Nieuw item toegevoegd");
 				addItem($(child).parent().data('row-id'));
 				addAddButton()
 				$(child).remove();
 			}

 		});




 		$('.sortable').each(function(index, row)
 		{

 			row = $(row);


 			var childrenCount = getRowCount(row);
 			console.log(row.data('row-id'), childrenCount);
 		 	
 		 	row.children().each(function(i, child)
 		 	{
 		 		var calculatedWidth = (500/childrenCount)-((childrenCount-1)*6);

 		 		child = $(child);

 		 		if(child.hasClass('child'))
 		 			child.css('width', calculatedWidth )

 		 	})
 		});
 	}
</script>

<style>
	.sortable-row 
	{
		background-color: #cecece;
		border: 1px solid #eee;
	    width: 600px;
	    min-height: 84px;
	    margin: 0;
	    padding: 5px 0 0 0;
	    margin-right: 10px;
	   	display: inline-block;
	}

 
  	.child {
	    display: inline-block;

		font-size: 20px;
		color: #FFF;
		text-align: center;
		border-radius: 6px;
		padding: 0px;
		margin: 12px;
		font-family: "Open Sans", Arial;

  		background: #3794fe;

  		height: 60px	;
 	 }

  	.info {
	    display: inline-block;

		text-align: center;
		border-radius: 6px;

		font-family: "Open Sans", Arial;

  		background: white;
  		
  		height: 60px;
 	 }
 	.new-child
 	{
 		margin:30px;
 		background-color: red;
 		width: 150px;
 		padding: 15px;
 		color:white;
 		height:60px;
 	}

 	.time 
 	{
 		width:32px;
 	}

</style>