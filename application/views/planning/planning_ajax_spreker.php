<?php
/**
 * @file planning_ajax_spreker.php
 * 
 * Ajaxpagina voor de spreker.
 */
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?= $column->sessie->titel; ?></h4>
</div>
<div class="modal-body">
  <p><?= $column->sessie->inhoud ?></p>

    
 
    <div class="modal-footer">
    <span><?= $aantalIngeschreven ?>/<?= $column->maxHoeveelheid ?>&nbsp;</span>
    

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
