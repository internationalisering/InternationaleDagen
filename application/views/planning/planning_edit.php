
<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Planning</h1>


		    <link rel="stylesheet" href="<?= base_url(); ?>resources/css/gridstack.min.css"/>
		    <link rel="stylesheet" href="<?= base_url(); ?>resources/css/gridstack-extra.min.css"/>
    		<script src="<?= base_url(); ?>resources/js/lodash.min.js"></script>

		    <script src="<?= base_url(); ?>resources/js/gridstack.min.js"></script>
		    <script src="<?= base_url(); ?>resources/js/gridstack.jQueryUI.min.js"></script>

		  

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
	                <div class="grid-stack grid-stack-11" id="grid1">
	                </div>
	            </div>
					
	        </div>
	    </div>


		    <script type="text/javascript">
		        $(document).ready(function() {
		        	function addHoldNode()
		        	{
		        		$('#hold-node-div').append('<div  class="grid-stack-item"><div class="grid-stack-item-content" data-type="new" data-session-id="test" data-id="9">Nieuw element</div></div>');


		        		$('.grid-sidebar .grid-stack-item').draggable({
			                revert: 'invalid',
			                handle: '.grid-stack-item-content',
			                scroll: false,
			                appendTo: 'body',

			            });


		        	}

		            var options = {
		                width: 100,
						disableResize: true,
		                float: false,
		                removable: '.grid-trash',
		                removeTimeout: 100,
		                acceptWidgets: '.grid-stack-item'
		            };
		            $('#grid1').gridstack(options);
					

		            var items = [
		                {x: 0, y: 0, width: 1, height: 1, id: 1, title: 'A'},
		                {x: 3, y: 1, width: 1, height: 1, id: 3, title: 'B'},
		                {x: 4, y: 1, width: 1, height: 1, id: 5, title: 'C'},
		                {x: 2, y: 3, width: 1, height: 1, id: 7, title: 'D'},
		                {x: 2, y: 5, width: 1, height: 1, id: 8, title: 'E'}
		            ];

		            $('.grid-stack').each(function () {
		                var grid = $(this).data('gridstack');
						
						
		                _.each(items, function (node) {
		                    grid.addWidget($('<div><div  data-gs-no-resize="true" class="grid-stack-item-content " data-type="existing" data-session-id="'+1		+'" data-id="'+node.id+'">'+node.title+'</div></div>'),
		                        node.x, node.y, node.width, node.height);
		                }, this);
		            });

		            $('.grid-sidebar .grid-stack-item').draggable({
		                revert: 'invalid',
		                handle: '.grid-stack-item-content',
		                scroll: false,
		                appendTo: 'body',

		            });

		            // Uitgevoerd wanneer er nieuwe item op grid terecht komt
					/*$('#grid1').on('added', function(event, items) {
					    
					    console.log('Nieuw element toegevoegd');
					    addHoldNode()
					});


					$('#grid1').on('removed', function(event, items) {
					    for (var i = 0; i < items.length; i++) {
					      //$(items[i]).parent().toggle( "puff" );
					    }

						$('#delete-node-div').toggle( "puff" ).toggle( "puff" );
					    console.log('Element verwijderd');
					});

					// Uitgevoerd wanneer een item verplaatst zordt
		            $('#grid1').on('dragstop', function(event, ui) {
					  
					    console.log('Bestaand element verplaatst');
					});

		            $('#grid1').on('change', function(event, items) {
                		var grid = $('#grid1').data('gridstack');
/*
						$(items).each(function(index, item)
						{

							$(items).each(function(index2, item2)
							{	
								console.log( item.x, item2.x, item.y, item2.y);
								if(item.x == item2.x && item.y == item2.y)
								{

									console.log('Overlappend element');
								//	grid.move(item2, item2.x + 1, item2.y);
								}

							});
						

						});

						
					   // console.log('Grid is veranderd. Resizing alle items');
					});
*/		        	addHoldNode();

		        });
		    </script>


        </div>
    </div>
</div>
  <style type="text/css">
        #grid1 {
            background: lightgoldenrodyellow;
        }

        #grid2 {
            background: lightcyan;
        }

        .grid-stack-item-content {
            color: #2c3e50;
            text-align: center;
            background-color: #18bc9c;
        }

        #grid2 .grid-stack-item-content {
            background-color: #9caabc;
        }

        .grid-stack-item-removing {
            opacity: 0.5;
        }

        .grid-trash {
         height: 150px;
			width:300px;
            margin-bottom: 20px;
            background: rgba(255, 0, 0, 0.1) center center url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDQzOC41MjkgNDM4LjUyOSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDM4LjUyOSA0MzguNTI5OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTQxNy42ODksNzUuNjU0Yy0xLjcxMS0xLjcwOS0zLjkwMS0yLjU2OC02LjU2My0yLjU2OGgtODguMjI0TDMwMi45MTcsMjUuNDFjLTIuODU0LTcuMDQ0LTcuOTk0LTEzLjA0LTE1LjQxMy0xNy45ODkgICAgQzI4MC4wNzgsMi40NzMsMjcyLjU1NiwwLDI2NC45NDUsMGgtOTEuMzYzYy03LjYxMSwwLTE1LjEzMSwyLjQ3My0yMi41NTQsNy40MjFjLTcuNDI0LDQuOTQ5LTEyLjU2MywxMC45NDQtMTUuNDE5LDE3Ljk4OSAgICBsLTE5Ljk4NSw0Ny42NzZoLTg4LjIyYy0yLjY2NywwLTQuODUzLDAuODU5LTYuNTY3LDIuNTY4Yy0xLjcwOSwxLjcxMy0yLjU2OCwzLjkwMy0yLjU2OCw2LjU2N3YxOC4yNzQgICAgYzAsMi42NjQsMC44NTUsNC44NTQsMi41NjgsNi41NjRjMS43MTQsMS43MTIsMy45MDQsMi41NjgsNi41NjcsMi41NjhoMjcuNDA2djI3MS44YzAsMTUuODAzLDQuNDczLDI5LjI2NiwxMy40MTgsNDAuMzk4ICAgIGM4Ljk0NywxMS4xMzksMTkuNzAxLDE2LjcwMywzMi4yNjQsMTYuNzAzaDIzNy41NDJjMTIuNTY2LDAsMjMuMzE5LTUuNzU2LDMyLjI2NS0xNy4yNjhjOC45NDUtMTEuNTIsMTMuNDE1LTI1LjE3NCwxMy40MTUtNDAuOTcxICAgIFYxMDkuNjI3aDI3LjQxMWMyLjY2MiwwLDQuODUzLTAuODU2LDYuNTYzLTIuNTY4YzEuNzA4LTEuNzA5LDIuNTctMy45LDIuNTctNi41NjRWODIuMjIxICAgIEM0MjAuMjYsNzkuNTU3LDQxOS4zOTcsNzcuMzY3LDQxNy42ODksNzUuNjU0eiBNMTY5LjMwMSwzOS42NzhjMS4zMzEtMS43MTIsMi45NS0yLjc2Miw0Ljg1My0zLjE0aDkwLjUwNCAgICBjMS45MDMsMC4zODEsMy41MjUsMS40Myw0Ljg1NCwzLjE0bDEzLjcwOSwzMy40MDRIMTU1LjMxMUwxNjkuMzAxLDM5LjY3OHogTTM0Ny4xNzMsMzgwLjI5MWMwLDQuMTg2LTAuNjY0LDguMDQyLTEuOTk5LDExLjU2MSAgICBjLTEuMzM0LDMuNTE4LTIuNzE3LDYuMDg4LTQuMTQxLDcuNzA2Yy0xLjQzMSwxLjYyMi0yLjQyMywyLjQyNy0yLjk5OCwyLjQyN0gxMDAuNDkzYy0wLjU3MSwwLTEuNTY1LTAuODA1LTIuOTk2LTIuNDI3ICAgIGMtMS40MjktMS42MTgtMi44MS00LjE4OC00LjE0My03LjcwNmMtMS4zMzEtMy41MTktMS45OTctNy4zNzktMS45OTctMTEuNTYxVjEwOS42MjdoMjU1LjgxNVYzODAuMjkxeiIgZmlsbD0iI2ZmOWNhZSIvPgoJCTxwYXRoIGQ9Ik0xMzcuMDQsMzQ3LjE3MmgxOC4yNzFjMi42NjcsMCw0Ljg1OC0wLjg1NSw2LjU2Ny0yLjU2N2MxLjcwOS0xLjcxOCwyLjU2OC0zLjkwMSwyLjU2OC02LjU3VjE3My41ODEgICAgYzAtMi42NjMtMC44NTktNC44NTMtMi41NjgtNi41NjdjLTEuNzE0LTEuNzA5LTMuODk5LTIuNTY1LTYuNTY3LTIuNTY1SDEzNy4wNGMtMi42NjcsMC00Ljg1NCwwLjg1NS02LjU2NywyLjU2NSAgICBjLTEuNzExLDEuNzE0LTIuNTY4LDMuOTA0LTIuNTY4LDYuNTY3djE2NC40NTRjMCwyLjY2OSwwLjg1NCw0Ljg1MywyLjU2OCw2LjU3QzEzMi4xODYsMzQ2LjMxNiwxMzQuMzczLDM0Ny4xNzIsMTM3LjA0LDM0Ny4xNzJ6IiBmaWxsPSIjZmY5Y2FlIi8+CgkJPHBhdGggZD0iTTIxMC4xMjksMzQ3LjE3MmgxOC4yNzFjMi42NjYsMCw0Ljg1Ni0wLjg1NSw2LjU2NC0yLjU2N2MxLjcxOC0xLjcxOCwyLjU2OS0zLjkwMSwyLjU2OS02LjU3VjE3My41ODEgICAgYzAtMi42NjMtMC44NTItNC44NTMtMi41NjktNi41NjdjLTEuNzA4LTEuNzA5LTMuODk4LTIuNTY1LTYuNTY0LTIuNTY1aC0xOC4yNzFjLTIuNjY0LDAtNC44NTQsMC44NTUtNi41NjcsMi41NjUgICAgYy0xLjcxNCwxLjcxNC0yLjU2OCwzLjkwNC0yLjU2OCw2LjU2N3YxNjQuNDU0YzAsMi42NjksMC44NTQsNC44NTMsMi41NjgsNi41N0MyMDUuMjc0LDM0Ni4zMTYsMjA3LjQ2NSwzNDcuMTcyLDIxMC4xMjksMzQ3LjE3MnogICAgIiBmaWxsPSIjZmY5Y2FlIi8+CgkJPHBhdGggZD0iTTI4My4yMiwzNDcuMTcyaDE4LjI2OGMyLjY2OSwwLDQuODU5LTAuODU1LDYuNTctMi41NjdjMS43MTEtMS43MTgsMi41NjItMy45MDEsMi41NjItNi41N1YxNzMuNTgxICAgIGMwLTIuNjYzLTAuODUyLTQuODUzLTIuNTYyLTYuNTY3Yy0xLjcxMS0xLjcwOS0zLjkwMS0yLjU2NS02LjU3LTIuNTY1SDI4My4yMmMtMi42NywwLTQuODUzLDAuODU1LTYuNTcxLDIuNTY1ICAgIGMtMS43MTEsMS43MTQtMi41NjYsMy45MDQtMi41NjYsNi41Njd2MTY0LjQ1NGMwLDIuNjY5LDAuODU1LDQuODUzLDIuNTY2LDYuNTdDMjc4LjM2NywzNDYuMzE2LDI4MC41NSwzNDcuMTcyLDI4My4yMiwzNDcuMTcyeiIgZmlsbD0iI2ZmOWNhZSIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=) no-repeat;
        }

        .grid-sidebar {
   			 background: rgba(0, 255, 0, 0.1);
            height: 150px;
            padding: 25px 0;
            text-align: center;
        }

        .grid-sidebar .grid-stack-item {
            width: 200px;
            height: 100px;
            border: 2px dashed green;
            text-align: center;
            line-height: 100px;
            z-index: 10;
            background: rgba(0, 255, 0, 0.1);
            cursor: default;
            display: inline-block;
        }

        .grid-sidebar .grid-stack-item .grid-stack-item-content {
            background: none;
        }
    </style>