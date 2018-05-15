<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Instellen activiteit</h4>
</div>
<div class="modal-body">
	
	<?php if($planned){ ?>
		<p>This planning has now been marked as definitive.</p>
	<?php } else { ?>
		<p>Are you sure you want to mark this planning as definitive? You will no longer be able to edit this page.</p>
	<?php } ?>


</div>

<div class="modal-footer"> 
	<?php if($planned){ ?>
     	<button type="button" class="btn btn-success" data-dismiss="modal" onclick='window.location = site_url()+"/planning/edit/";'>Close</button>
  	 	
    <?php } else { ?>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   	 	<button type="button" class="btn btn-warning" onclick='µ.planning_edit.markAsDefinitive(1);'>Confirm</button>	   
   	<?php } ?>

</div>
