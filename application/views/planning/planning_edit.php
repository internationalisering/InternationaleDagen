
<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Planning</h1>

	  


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

						<div class='button'>Remove</div>
					</div>
				</div>

	        </div>
        </div>
    </div>
</div>

 <script>
	$( function() {
		updateSortable();
		resizeItems();
	} );

 	function updateSortable()
 	{
 		$( ".sortable" ).sortable({
			connectWith: ".sortable",
			stop: resizeItems
		}).disableSelection();
 	}


 	function updateChildren()
 	{
 		$('.child').each(function(index, child)
 		{
 			var child = $(child);

 			child.html( child.data('title') );
 		})
 	}

 	function addRow()
 	{
 		$('.row-buttons').before(`<div class='row-parent' data-row-id="">
						<div class='info'>
							<input type='text' class='time'>:<input type='text' class='time'>
		            	</div>

						<div  class="sortable sortable-row ">
						
						</div>
					</div>`);
 		updateRowIds();
 	}

 	function updateRowIds()
 	{
 		$('.row-parent').each(function(index, object)
 		{
 			$(object).attr('data-row-id', index);
 		});
 	}

 	function checkExcessRows()
 	{




 		// Voeg rij toe indien nodig
 		$('.row-parent').last().each(function(index, row)
 		{	
 			var rowId = $(row).data('row-id');
			var childrenCount = getRowChildCount( $(row).find('.sortable') );
			
			if(childrenCount > 0) // Rij toevoegen
			{
				addRow();
				updateSortable();
			}
 		});

 		// Verwijder overbodige rijen 
 		var eersteElement = true;
 		$('.row-parent').each(function(index, row)
 		{
			var rowId = $(row).data('row-id');
			var childrenCount = getRowChildCount( $(row).find('.sortable') );
				
			if(childrenCount == 0)
			{	
				if(eersteElement)
					eersteElement = false;
				else 
					$(row).remove();
			}

 		});

 		 		// Toon uren van volgende rij al
 		$('.row-parent').each(function(index, row)
 		{
 			var rowId = $(row).data('row-id');
			toggleInfo( rowId, getRowChildCount( $(row).find('.sortable') ) );
 		});

 	}	

 	function toggleInfo(rowId, bool)
 	{
 		var info = $('div[data-row-id='+rowId+'] > .info');
 		if(bool)
 			info.show();
 		else 
 			info.hide();
 	}

 	function addItem(rowId)
 	{
 		$('div[data-row-id='+rowId+'] > div.sortable').append('<div class="child">test</div>');
 	}

 	function addAddButton()
 	{
 		$('.row-buttons').html('');
 		$('.row-buttons').append("<div class='sortable'><div class='new-child button'>Add</div></div><div class='button'>Remove</div>");
		updateSortable();
 	}

 	function getRowChildCount(row) // Geeft count van alle children, zonder de 'info' child bij
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


 	function removeButtons()
 	{
 		$('.row-buttons > div').each(function(index, child)
 		{
 			child = $(child);

 			//if(child.data(''))
 		});
 	}

 	function resizeItems()
 	{
 		// Kijken of er nieuw item toegevoegd is
 		$('.sortable-row div').each(function(index, child)
 		{
 			if($(child).hasClass('new-child'))
 			{
 				var rowId = $(child).parent().parent().data('row-id');
 				if(rowId != 'undefined')
 					addItem(rowId);

 				addAddButton();
 				$(child).remove();
 			}

 		});
 		// Check if rows need to be added / hidden
 		checkExcessRows();



 		// Set widths of all elements
 		$('.sortable').each(function(index, row)
 		{

 			row = $(row);


 			var childrenCount = getRowChildCount(row);
 		 	
 		 	row.children().each(function(i, child)
 		 	{
 		 		var calculatedWidth = (500/childrenCount)-((childrenCount-1)*6);

 		 		child = $(child);

 		 		if(child.hasClass('child'))
 		 			child.css('width', calculatedWidth )

 		 	})
 		});
 		 		updateChildren();

 	}
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
		border-radius: 6px;
		padding: 0px;
		#margin: 12px;
		margin-left:12px;
		font-family: "Open Sans", Arial;

  		background: #3794fe;

  		height: 60px	;
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


</style>