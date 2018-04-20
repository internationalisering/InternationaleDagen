<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?= $column->sessie->titel; ?></h4>
</div>
<div class="modal-body">
  <p><?= $column->sessie->inhoud ?></p>

    
    <div class="students">
      <p><strong>Ingeschreven studenten: </strong></p>

      <?php 
        $i = 0; 
        foreach($ingeschrevenStudenten as $student)
        { 
          $i++;
        ?>  
          <p><?= $i . ". " . $student ?></p>  
        <?php 
        } 
        ?>
    </div>

    <div class="modal-footer">
    <span><?= $aantalIngeschreven ?>/<?= $column->maxHoeveelheid ?>&nbsp;</span>
      <button 
        type="button"
        class="btn btn-info">View enrolled students
      </button>


    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
