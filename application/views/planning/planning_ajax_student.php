<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?= $column->sessie->titel; ?></h4>
</div>
<div class="modal-body">
  <p><?= $column->sessie->inhoud ?></p>
</div>
<div class="modal-footer">
  <?= $aantalIngeschreven ?>/<?= $column->maxHoeveelheid ?>

  <?php 
  if($ingeschreven)
  {
    ?>
      <button 
        type="button" 
        onclick='withdraw(<?= $column->id ?>);' 
        class="btn btn-danger" 
        data-dismiss="modal">Withdraw
      </button>
    <?php 
  } else {
    ?>
      <button 
      type="button" 
      onclick='enroll(<?= $column->id ?>);' 
      class="btn btn-warning"  
      data-dismiss="modal">Enroll
    </button>
    <?php 
  }
  ?>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
