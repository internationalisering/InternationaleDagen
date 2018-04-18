<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?= $column->sessie->titel; ?></h4>
</div>
<div class="modal-body">
  <p><?= $column->sessie->inhoud ?></p>

  <div class="feedback">
    <p><strong>Feedback:</strong></p>
    <p>
      <textarea rows=5 cols=50 placeholder="Feedback will be reviewed" name="feedback"><?= isset($feedback->inhoud) ? $feedback->inhoud : '' ?></textarea>
    </p>
    <button class="btn btn-primary" onclick="feedbackSubmit()">Submit</button>

  </div>
</div>
<div class="modal-footer">
    <span><?= $aantalIngeschreven ?>/<?= $column->maxHoeveelheid ?>&nbsp;</span>
    <button 
        type="button"
        onclick='feedback(<?= $column->id ?>)'
        class="btn btn-info">Feedback
      </button>

    <?php if($ingeschreven){?>
     
      

      <button 
        type="button" 
        onclick='withdraw(<?= $column->id ?>); $(this).addClass("disabled");'
        class="btn btn-danger" 
       >Withdraw
      </button>

    <?php } else { ?>

      <button 
        type="button" 
        onclick='enroll(<?= $column->id ?>); $(this).addClass("disabled");' 
        class="btn btn-warning"  
       >Enroll
      </button>

    <?php } ?>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
