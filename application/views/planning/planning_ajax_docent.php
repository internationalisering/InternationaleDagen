<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?= $column->sessie->titel; ?></h4>
</div>
<div class="modal-body">
  <p><?= $column->sessie->inhoud ?></p>

    
    <div id="enrolledStudents" class="planning-students">
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
        class="btn btn-info"
        onclick="btnEnrolledStudents()">View enrolled students
      </button>
      <?php if($ingeschreven){?>
          <button 
            type="button" 
            title="Als docent kan je je inschrijven als surveillant. Je bent de verantwoordelijke tijdens de lezing en zorgt voor het nemen van aanwezigheden."
            onclick='withdraw(<?= $column->id ?>); $(this).addClass("disabled");'
            class="btn btn-danger" 
           >Withdraw
          </button>

        <?php } else { ?>

          <button 
            type="button" 
            title="Als docent kan je je inschrijven als surveillant. Je bent de verantwoordelijke tijdens de lezing en zorgt voor het nemen van aanwezigheden."
            onclick='enroll(<?= $column->id ?>); $(this).addClass("disabled");' 
            class="btn btn-warning"  
           >Enroll
          </button>

        <?php } ?>

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
